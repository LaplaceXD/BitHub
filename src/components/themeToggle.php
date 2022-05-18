<?php 
  function render_theme_toggle() {
    ob_start();
    include("src/img/icons/sun.svg");
    $light_icon = ob_get_clean();
    
    ob_start();
    include("src/img/icons/moon.svg");
    $dark_icon = ob_get_clean();

    echo '<button class="theme theme__btn">
            <span class="light-icon">'.$light_icon.'</span>
            <span class="dark-icon">'.$dark_icon.'</span>
          </button>';
  }
?>