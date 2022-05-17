<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <?php
    require_once("src/components/imports.php");
    if(isset($_SESSION["userID"])) {
      header("Content-Type: text/html; charset=utf-8");
      header("Location:home.php");
    }

    render_head(array("form", "pages/register"));
    echo "\n";
  ?>
  <body>
    <div class="reg">
      <div class="reg__img">
        <img src="src/img/register_bg.jpg" alt="Register Background"/>
      </div>
      <section class="reg__content">
        <div class="reg__head">
          <a href="index.php" class="logo" /><?php include "src/img/icons/Bithub.svg"; ?></a>
          <?php render_theme_toggle(); ?>
        </div>
        <h1 class="reg__title">Register</h1>
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST") {
            $fields = array("user", "email", "pass", "confpass");
            $msg = "";
  
            if(array_any($fields, function ($field) { return !isset($_POST[$field]); })) {
              $msg = "Please fill up all the fields.";
            } elseif ($_POST["pass"] !== $_POST["confpass"]) {
              $msg = "Your passwords do not match.";
            } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !test_input($_POST["email"])) {
              $msg = "Input a valid email.";
            } elseif(!test_input($_POST["user"])) {
              $msg = "Input a valid username."; 
            } else {
              $conn = connect_to_db();
              if(!$conn) {
                $msg = "We apologize for the inconvenience. An unexpected error occured.";
                goto error;
              }
  
              $result = register_user(
                $conn,
                test_input($_POST["user"]),
                $_POST["pass"],
                test_input($_POST["email"])
              );
              if(!$result) {
                $error = mysqli_error($conn);
                goto error;
              }
              
              mysqli_close($conn);
              
              $msg = "Successfully registered!";
              render_registration_form("", "","success:".$msg);
              goto end;
            }
  
            error:
            render_registration_form($_POST["user"], $_POST["email"], "error:".$msg); 
            end:  
          } else {
            render_registration_form();
          }
        ?>
        <p>Already have an account? <a href="index.php">Login.</a></p>
      </section>
    </div>
  </body>
</html>