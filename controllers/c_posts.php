<?php
		/*if(!$user) {
           Router::redirect('/users/login');
        }*/ //Tried Susan & Johanna's suggestion but will send all users including logged in users back to login screen. 

class posts_controller extends base_controller{
	
	public function add() {

		#Sets up the view
		$this->template->title = "Mi2Du Add Task"; 
        //Add task title to post **
		$this->template->task = View::instance("v_posts_add");
		//Add task details to post **
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
         "/js/jquery.form.js",
         "/js/posts_edit.js"
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
			
			$priority = $crossout =0;
			if (isset($_POST['priority'])) {
       		$priority = $_POST['priority'];
			}
			if (isset($_POST['crossout'])) {
	        $crossout = $_POST['crossout'];
			}
			
			# Update their row in the DB with the new token
			$data = Array(
				'task' => $task,
				'content' => $content,
				'priority'=> $priority,
				'crossout'=> $crossout
			);
			$post_id = DB::instance(DB_NAME)->update('posts',$data, 'WHERE post_id ='.$post_id); //**
		
			# Set up the view **
    		$view = View::instance('v_posts_p_edit');
			 
			$view->edited = $_POST['edited'];
			$view->postid = $post['post_id'];
		
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
#######################################

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

public function processsortable(){
       foreach ($_GET['postItem'] as $ranking => $post_id) {
               $data = Array('ranking'=> $ranking);              
			   $post[] = DB::instance(DB_NAME)->update('posts',$data, 'WHERE post_id ='.$post_id);
       }
       #echo "DEBUGGING:<br />";
       #echo "GET['postItem']<br /><pre>";
       #print_r ($_GET);
       #echo "</pre><br />";
       #echo "post[]<br /><pre>";
       #print_r ($post);
       #echo "</pre>";
	   if (!$post) {
		   echo 'error';
	   }
}
   		
	public function index() {
		/*if(!$user) {
           Router::redirect('/users/login');
        }*/ //Tried Susan & Johanna's suggestion but will send all users including logged in users back to login screen. 
		
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
			   posts.ranking,
               posts.crossout,
               users.first_name,
               users.last_name
        FROM posts

        INNER JOIN users 
           ON posts.user_id = users.user_id
        WHERE users.user_id = '.$this->user->user_id.'
		ORDER BY 
			posts.ranking ASC,
			posts.created DESC';		
		
		//Only allow logged in user to see his/her own tasks (line 267).  Join will connect posts to the user id. We will arrange the order by rank and date created. 	

	    #Runs the query
		$posts = DB::instance(DB_NAME)->select_rows($q);
		#Pass data to the view
		$this->template->content->posts = $posts;
		#Render the view
		echo $this->template;
	}	
}
