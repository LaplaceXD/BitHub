<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <?php
    require_once("src/components/imports.php");
    render_head(array("pages/home"));
    echo "\n";
  ?>
  <body>
    <main class="posts">
      <?php 
        render_theme_toggle();
        render_post(
          "Username",
          "2022-12-01",
          "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus optio mollitia iure odit voluptatem deleniti a quas dignissimos iste, sapiente omnis eum quaerat molestias, dolor velit porro laudantium aliquam ipsam.",
          1000,
          1000,
        )  
      ?>
      

    </main>
  </body>
</html>