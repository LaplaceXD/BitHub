<!DOCTYPE html>
<html>
  <?php
    require_once("src/components/imports.php");
    session_start();

    render_head(array("form", "pages/register"));
    echo "\n";
  ?>
  <body>
    <div class="reg">
      <div class="reg__img">
        <img src="src/img/register_bg.jpg" />
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
            } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
              $msg = "Input a valid email.";
            } else {
              $conn = connect_to_db();
              if(!$conn) {
                $msg = "We apologize for the inconvenience. An unexpected error occured.";
                goto error;
              }
  
              $result = register_user(
                $conn,
                test_input($_POST["user"]),
                test_input($_POST["pass"]),
                test_input($_POST["email"])
              );
              if(!$result) {
                $error = "Error: ".mysqli_error($conn);
                goto error;
              }
  
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