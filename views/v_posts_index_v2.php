<?php  if(!$user) {
           Router::redirect('/users/login');
        } ?>    
    
  <script>
  $(function() {
//    $( "#sortable" ).sortable();
	$("#sortable").sortable({
    update: function(event, ui) {
        $.post("ajax.php", { pages: $('#sortable').sortable('serialize') } );
    }
});
	
    $( "#sortable" ).disableSelection();
  });
  </script>

<div class="postCanvas">

<?php foreach($post_order['post'] as $post => $value){
	mysql_query("UPDATE postorder SET `order` = '$post' WHERE `post_id` =$value'") or die(mysql_error());
	} ?>
                       
<ul class "postorder" id="sortable">
<!-- < ?php foreach($posts as $post): ?> -->

 <!--Displays the post -->
 <?php 
 	  $result = mysql_query("SELECT post_id, post_order FROM postorder ORDER BY `order`ASC") or die(mysql_error());
	  while($row = mysql_fetch_array($result)){
       printf('<li id="post_id_%s" class="ui-state-default">  
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
      </li>', $row['post_id'], $row['post_order']);
	  }
	  ?>
    <?php if($post['priority'] == 'urgent')
                echo "<script> $('#post".$post['post_id']."').css('color', 'red'); </script>";
    ?>
    <?php if($post['crossout'] == '1')
                echo "<script> $('#post".$post['post_id']."').css('text-decoration', 'line-through'); </script>";
    ?> 

<?php endforeach; ?>
      
</ul>
</div>     