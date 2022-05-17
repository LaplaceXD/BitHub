<?php 
  function render_post(
    $username,
    $post_id,
    $post_date,
    $post_content,
    $likes = 0,
    $liked = false,
    $edited = false,
    $user_img = "src/img/placeholder.jpeg"
  ) {
    $edited = $edited ? " (edited)" : "";

    ob_start();
    include "src/img/icons/comment.svg";
    $comment_icon = ob_get_clean();
    
    ob_start();
    include "src/img/icons/comment.svg";
    $likes_icon = ob_get_clean();
    
    ob_start();
    include "src/img/icons/trash.svg";
    $delete_icon = ob_get_clean();
    
    echo '<section class="post">
        <div class="user">
          <div class="user__img">
            <img src="'.$user_img.'" alt="'.$username.' picture"/>  
          </div>
          <div class="user__data">
            <h2 class="user__name">'.$username.'</h2>
            <p>'.$post_date.$edited.'</p>
          </div>
        </div>
        <p class="post__content">'.$post_content.'</p> 
        <div class="post__btns">
          <a href="comment.php?id='.$post_id.'" class="post__btn">'.$comment_icon.'</a>
          <div class="btn__container '.($liked ? "active" : "").'">
            <button id="likes" class="post__btn">'.$likes_icon.'</button>  
            <p>'.$likes.'</p>
          </div>
          <a href="delete.php?id='.$post_id.'" class="post__btn">'.$delete_icon.'</a>  
        </div>
      </section>';
  }
?>