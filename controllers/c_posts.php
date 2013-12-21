<?php

class posts_controller extends base_controller{
	
	#public function __construct() {
	#	parent::__construct();
	#    if(!$this->user) {
	#		die("Members only");
	#	}
	#}
	public function add() {
		
		#Sets up the view
		$this->template->title = "Mi2Du Add Task"; 
        //Add task title to post in database /////////// NEW P4////////////////////
		$this->template->task = View::instance("v_posts_add");
		$this->template->content = View::instance("v_posts_add");

		#Loads the JS files
		$client_files_body = Array(
			"/js/jquery.form.js",
			"/js/posts_add.js"
		);

		$this->template->client_files_body = Utils::load_client_files($client_files_body);

		#Renders the template
		echo $this->template;
	}

	public function p_add() {
		#Sets up the data
		# Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		#Sets the task title
		$_POST['task'] = $_POST['task'];

		#Inserts the post
		//DB::instance(DB_NAME)->insert('posts', $_POST);///////////////
		$new_post_id = DB::instance(DB_NAME)->insert('posts',$_POST); //**
		
		#Set up the view **
		$view = View::instance ('v_posts_p_add'); 
		
		#Pass data to the view **
		$view->created = $_POST['created'];
		$view->new_post_id = $new_post_id;
		
		#Render the view **
		echo $view;
		
	   //Sends a simple message back to user
	    #echo "Your task was added";
	   
	    #Then send user back to view posts
        //Router::redirect('/posts'); //////////////////
	}
#####################################################################
	public function delete($post_id) {
		$q= 'SELECT
			*
			FROM posts
			WHERE post_id = '.$post_id;
		$post = DB::instance(DB_NAME)->select_row($q);
		$poster_id = $post['user_id'];
		if ($this->user->user_id == $poster_id) {
			#delete the post when post id match is found
			DB::instance(DB_NAME)->delete('posts','WHERE post_id ='.$post_id);
			
			#Then send user back to view posts
			Router::redirect('/posts');
		}
		else {
			echo 'no permission';
		}
	} 
	
	public function edit($post_id = 0) {
		 # Set up view
		 $this->template->title = "Mi2Du Edit Task"; 
         $this->template->content = View::instance("v_posts_edit");
         #Check to see if the post id exists
		 if($post_id < 1) {  
                die('Post not found. Please go back to view <a href="/posts">here.</a>');
		 }
		 
		 else {
		 # Set up query to get all users
         $q = 'SELECT * FROM posts WHERE post_id = '.$post_id;
				
         # Run query
         $post = DB::instance(DB_NAME)->select_row($q);

         # Pass data to the view
         $this->template->content->post = $post;
		 
		 
		 # Load JS files ********
    	 $client_files_body = Array(
         "/js/jquery.form.js"//,
         //"/js/posts_edit.js"
    	  );
		  
  	     $this->template->client_files_body = Utils::load_client_files($client_files_body);
				
         # Render view
         echo $this->template;
		}
    }        
    
	public function p_edit($post_id) {
		#Sets up the data **		
		$_POST['edited']  = Time::now();
		$_POST['modified'] = Time::now();
		
		#Finds the post with matching Post ID
		$q= 'SELECT
			*
			FROM posts
			WHERE post_id = '.$post_id;
			
		$post = DB::instance(DB_NAME)->select_row($q);
		$poster_id = $post['user_id'];
		# If the user id matches with the user who made the post, then allow editing 
		if ($this->user->user_id == $poster_id) {
			$task = $_POST['task'];
			$content = $_POST['content'];
			$priority = $_POST['priority'];
			$crossout = $_POST['crossout'];
			# Update their row in the DB with the new token
			$data = Array(
				'task' =>$task,
				'content' => $content,
				'priority'=> $priority,
				'crossout'=> $crossout
			);
			$post_id = DB::instance(DB_NAME)->update('posts',$data, 'WHERE post_id ='.$post_id); //**
		
			# Set up the view **
    		$view = View::instance('v_posts_p_edit');
			
			 # Pass data to the view **
			 $view->task  = $_POST['task'];
			 $content = $_POST['content'];
  			 $priority = $_POST['priority'];
			 $crossout = $_POST['crossout'];
			 $view->edited = $_POST['edited'];
			 $view->post_id = $post_id;		
		
			// Send a simple message back**
		    #echo "Your post was edited";
			//Router::redirect('/posts');
			 # Render the view
		     echo $view;
		}
		else {
			die('No Permission to edit. Please login <a href="/users/login">here.</a>');
		}
	}  
###############################################################

public function control_panel() {

    # Setup view
        $this->template->content = View::instance('v_posts_control_panel');
        $this->template->title   = "Control Panel";

    # JavaScript files
        $client_files_body = Array(
            '/js/jquery.form.js', 
            '/js/posts_control_panel.js');
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

    # Render template
        echo $this->template;
}

public function p_control_panel() {

    $data = Array();

    # Find out how many posts there are
    $q = "SELECT count(post_id) FROM posts";
    $data['post_count'] = DB::instance(DB_NAME)->select_field($q);

    # Find out how many users there are
    $q = "SELECT count(user_id) FROM users";
    $data['user_count'] = DB::instance(DB_NAME)->select_field($q);

    # Find out when the last post was created
    $q = "SELECT created FROM posts ORDER BY created DESC LIMIT 1";
    $data['most_recent_post'] = Time::display(DB::instance(DB_NAME)->select_field($q));

    # Send back json results to the JS, formatted in json
    echo json_encode($data);
}
###############################################################
		
	public function index() {
		$this->template->title = "Mi2Du View Tasks"; 
        $this->template->content = View::instance('v_posts_index');
		//ADD ITEMS HERE to display
		$q= 'SELECT 
               posts.post_id,
               posts.content,
               posts.created,
               posts.user_id AS post_user_id,
			   posts.task,
			   posts.priority,
               posts.crossout,
               users.first_name,
               users.last_name
        FROM posts

        INNER JOIN users 
           ON posts.user_id = users.user_id
        WHERE users.user_id = '.$this->user->user_id; //Only allow logged in user to see his/her own tasks. 

	    #Runs the query
		$posts = DB::instance(DB_NAME)->select_rows($q);
		#Pass data to the view
		$this->template->content->posts = $posts;
		#Render the view
		echo $this->template;
	}	
	
	public function users() {
		# Set up view
		$this->template->content = View::instance("v_posts_users");
		
		# Set up query to get all users
		$q = 'SELECT *
			FROM users';
			
		# Run query
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		# Set up query to get all connections from users_users table
		$q = 'SELECT *
			FROM users_users
			WHERE user_id = '.$this->user->user_id;
			
		# Run query
		$connections = DB::instance(DB_NAME)->select_array($q,'user_id_followed');
		
		# Pass data to the view
		$this->template->content->users       = $users;
		$this->template->content->connections = $connections;
		
		# Render view
		echo $this->template;
	}
	
	/*-------------------------------------------------------------------------------------------------
	Creates a row in the users_users table representing that one user is following another
	-------------------------------------------------------------------------------------------------*/
	public function follow($user_id_followed) {
	
	    # Prepare the data array to be inserted
	    $data = Array(
	        "created"          => Time::now(),
	        "user_id"          => $this->user->user_id,
	        "user_id_followed" => $user_id_followed
	        );
	
	    # Do the insert
	    DB::instance(DB_NAME)->insert('users_users', $data);
	
	    # Send them back
	    Router::redirect("/posts/users");
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	Removes the specified row in the users_users table, removing the follow between two users
	-------------------------------------------------------------------------------------------------*/
	public function unfollow($user_id_followed) {
	
	    # Set up the where condition
	    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
	    
	    # Run the delete
	    DB::instance(DB_NAME)->delete('users_users', $where_condition);
	
	    # Send them back
	    Router::redirect("/posts/users");
	
	}
}
