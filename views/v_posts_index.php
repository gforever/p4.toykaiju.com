<?php  if(!$user) {
	   Router::redirect('/users/login');
	} ?>
    
<?php foreach($posts as $post): ?>


<p>                       

 <!--Displays the user's name -->
 <!--      <span class="uName">
		   < ?=$post['first_name'] .': '?> 
         </span> -->
 <!--Displays the post -->
           <div id="post">  
			   <span class="postTitle">
                <?=$post['title']?>  <!--NEW -->
               </span>
               <span class="postContent">
			<!-- only display content (aka details) when not blank -->
              <!-- < ?php if($post['content'] != '')?> -->
                <?=" : ".$post['content']?> 
              <!-- < ?php endif; ?> -->
               </span>       
            </div>          
            

    <?php if($post['priority'] == 'urgent')
		echo "<script> $('#post').css(color: red); </script>";		
		echo "This is urgent"; 
    ?> 

       <!--If the user id  matches with the user who made the post, then provide the option of editing or deleting entry -->
        <span class="editDel">
		<?php if($user->user_id == $post['post_user_id']): ?>                
         <a href=/posts/edit/<?=$post['post_id']?>>Edit</a> - 
         <a href=/posts/delete/<?=$post['post_id']?>>Delete</a>               
        <?php endif; ?>                         
        </span>
  <!--Displays the time -->
    <span class="postDate"> 
	    <?=Time::display($post['created'])?><br /> 
    </span> <br />
</p>     
<?php endforeach; ?>