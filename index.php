<!DOCTYPE html>
<html lang="en">
  <?php
    require_once("src/components/imports.php");
    render_head();
  ?>
  <body>
    <section class="container mt-5">
      <h1 class="text-primary text-center">Welcome to BitHub!</h1>
      <h2 class="text-center">Login</h2>
      <div class="w-100 container" style="max-width: 768px">
        <?php 
          $fields = array("username", "password");
          $error = "";
          
          if(array_any($fields, function ($field) { return !isset($_POST[$field]); })) {
            render_login_form();
            goto end;
          } else {
            $conn = connect_to_db();
            if(!$conn) {  
              $error = "We apologize for the inconvenience. An unexpected error occured.";
              goto errorForm;
            }

            $result = get_user($conn, $_POST["username"]);
            
            if(!$result) {
              $error = "Error: ".mysqli_error($conn);
              goto errorForm;
            } elseif($result->num_rows === 0) {
              $error = "Invalid user credentails.";
              goto errorForm;
            }

            mysqli_close($conn);
            $user = mysqli_fetch_assoc($result);
            
            if(hash_equals($_POST["password"], $user["Password"])) {
              $error = "Invalid user credentials.";
              goto errorForm;
            }
            
            echo "Successful Login.";
            goto end;
          }

          errorForm:
          render_login_form($_POST["username"], $error);
          end:
        ?>
        <p class="w-100 mt-2" style="max-width: 768px;">Don't have an account? <a href="signup.php">Sign up!</a></p>  
      </div>
    </section>
  </body>
</html>