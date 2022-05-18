<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <?php
    require_once("src/components/imports.php");
    if(isset($_SESSION["userID"])) {
      header("Location:home.php");
    }

    render_head(array("form", "pages/login"));
    echo "\n";
  ?>
  <body>
    <div class="login">
      <section class="login__content">
        <div class="login__head">
          <a href="index.php" class="logo"><?php include "src/img/icons/Bithub.svg"; ?></a>
          <?php render_theme_toggle(); ?>
        </div>
        <h1 class="login__title">Register</h1>
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST") {
            $fields = array("user", "pass");
            $msg = "";
  
            if(array_any($fields, function ($field) { return !isset($_POST[$field]); })) {
              $msg = "Please fill up all the fields.";
            } elseif(!test_input($_POST["user"])) {
              $msg = "Invalid username."; 
            } else {
              $conn = connect_to_db();
              if(!$conn) {
                $msg = "We apologize for the inconvenience. An unexpected error occured.";
                goto error;
              }
  
              $result = get_user($conn, test_input($_POST["user"]));
              if(!$result) {
                $msg = mysqli_error($conn);
                goto error;
              } elseif($result->num_rows === 0) {
                $msg = "Invalid User Credentials.";
                goto error;
              } 
              
              $user_details = mysqli_fetch_assoc($result);
              if(!password_verify($_POST["pass"], $user_details["Password"])) {
                $msg = "Invalid User Credentials.";
                goto error;
              }

              mysqli_close($conn);
            
              $_SESSION["userID"] = $user_details["ID"];
              $_SESSION["username"] = $user_details["Username"];
              
              if (headers_sent()) {
                echo("<script>location.href = 'home.php';</script>");
              } else {
                header("Location:home.php");
              }
              goto end;
            }
  
            error:
            render_login_form($_POST["user"], "error:".$msg); 
            end:  
          } else {
            render_login_form();
          }
        ?>
        <p>Don&apos;t have an account? <a href="register.php">Sign up.</a></p>
      </section>
      <div class="login__bg">
        <img src="src/img/login_bg.jpg" alt="Login Background" />
      </div>
    </div>
  </body>
</html>