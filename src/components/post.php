<?php 
  function render_post(
    $username,
    $post_date,
    $post_content,
    $likes = 0,
    $interested = 0,
    $liked = false,
    $is_interested = false,
    $user_img = "src/img/placeholder.jpeg"
  ) {
    ob_start();
    include "src/img/icons/comment.svg";
    $comment_icon = ob_get_clean();
    
    ob_start();
    include "src/img/icons/comment.svg";
    $likes_icon = ob_get_clean();
    
    ob_start();
    include "src/img/icons/comment.svg";
    $interested_icon = ob_get_clean();
    
    echo '<section class="post">
        <div class="user">
          <div class="user__img">
            <img src="'.$user_img.'" alt="'.$username.' picture"/>  
          </div>
          <div class="user__data">
            <h2 class="user__name">'.$username.'</h2>
            <p>'.$post_date.'</p>
          </div>
        </div>
        <p class="post__content">'.$post_content.'</p> 
        <div class="post__btns">
          <button class="post__btn">'.$comment_icon.'</button>
          <div class="btn__container '.($liked ? "active" : "").'">
            <button id="likes" class="post__btn">'.$likes_icon.'</button>  
            <p>'.$likes.'</p>
          </div>
          <div class="btn__container '.($is_interested ? "active" : "").'">
            <button id="interested" class="post__btn">'.$interested_icon.'</button>  
            <p>'.$interested.'</p>
          </div>
        </div>
      </section>';
  }
?>