<?php 
  function render_theme_toggle() {
    ob_start();
    include("src/img/icons/sun.svg");
    $light_icon = ob_get_clean();
    
    ob_start();
    include("src/img/icons/moon.svg");
    $dark_icon = ob_get_clean();

    echo '<button class="theme theme__btn">
            <div class="light-icon">'.$light_icon.'</div>
            <div class="dark-icon">'.$dark_icon.'</div>
          </button>';
  }
?>