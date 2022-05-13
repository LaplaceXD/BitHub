<?php 
  include_once("src/components/head.php");
  include_once("src/components/forms.php");

  include_once("src/services/db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <?php render_head(); ?>
  <body>
    <section class="container mt-5">
      <h1 class="text-primary text-center">Welcome to BitHub!</h1>
      <h2 class="text-center">Sign up</h2>
      <?php render_registration_form(); ?>
    </section>
  </body>
</html>