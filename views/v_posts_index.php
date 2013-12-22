<pre>
<div id="info">DEBUGGING: Waiting for update</div>
</pre>
                       
<ul id="sortable">
<?php foreach($posts as $post): ?>
 <!--Displays the user's name -->
 <!--      <span class="uName">
                   < ?=$post['first_name'] .': '?> 
         </span> -->
 <!--Displays the post                     class="ui-state-default"--> 
       <li id="postItem_<?=$post['post_id']?>">
       <img src="/imgs/drag.png" alt="move" width="20" height="20" class="handle" />   
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
  <!--<div class="postDate"> 
        <?=Time::display($post['created'])?><br /> 
      </div> <br /> -->
      </li> 
    <?php if($post['priority'] == 'urgent')
                echo "<script> $('#postItem_".$post['post_id']."').css('color', 'red'); </script>";
    ?>
    <?php if($post['crossout'] == '1')
                echo "<script> $('#postItem_".$post['post_id']."').css('text-decoration', 'line-through'); </script>";
    ?> 

<?php endforeach; ?>
      
</ul>  

<form action="process-sortable.php" method="post" name="sortables">
	<input type="hidden" name="test-log" id="test-log" />
</form>