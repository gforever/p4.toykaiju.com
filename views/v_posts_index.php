<?php  if(!$user) {
	   Router::redirect('/users/login');
	} ?>    
    
<?php foreach($posts as $post): ?>

<div class="postCanvas">
                       
<ul id="sortable">
 <!--Displays the user's name -->
 <!--      <span class="uName">
		   < ?=$post['first_name'] .': '?> 
         </span> -->
 <!--Displays the post -->
       <li id="post<?=$post['post_id']?>" class="ui-state-default">  
		  <span class="postTitle">
              <?=$post['task']?>  <!--NEW -->
          </span>
          <span class="postContent">
              <?=" : ".$post['content']?> 
          </span>                                   
       <!--If the user id  matches with the user who made the post, then provide the option of editing or deleting entry -->
		<?php if($user->user_id == $post['post_user_id']): ?>                
         <a href=/posts/edit/<?=$post['post_id']?> class="editDel">Edit</a> - 
         <a href=/posts/delete/<?=$post['post_id']?> class="editDel">Delete</a>               
        <?php endif; ?> 
                                  
  <!--Displays the time -->
  <!--  <div class="postDate"> 
	    <?=Time::display($post['created'])?><br /> 
    </div> <br /> -->
      </li> 
</ul>
</div>     

    <?php if($post['priority'] == 'urgent')
		echo "<script> $('#post".$post['post_id']."').css('color', 'red'); </script>";
    ?> 

<?php endforeach; ?>
