<?php 
  function render_theme_toggle() {
    echo '<button class="theme theme__btn">
            <div class="light-icon"><?php include "src/img/icons/sun.svg"; ?></div>
            <div class="dark-icon"><?php include "src/img/icons/moon.svg"; ?></div>
          </button>';
  }
?>