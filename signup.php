<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <?php
    require_once("src/components/imports.php");
    render_head();
  ?>
  <body>
    <section class="container mt-5">
      <h1 class="text-primary text-center">Welcome to BitHub!</h1>
      <h2 class="text-center">Sign up</h2>
      <?php
        $fields = array("username", "password", "confirm-password", "firstname", "lastname", "email", "gender", "dob");
        $error = "";
        
        $min_age = 13;
        $age_of_consent = isset($_POST["dob"]) && date("Y-m-d", strtotime($_POST["dob"]."+ $min_age years"));

        if(array_any($fields, function ($field) { return !isset($_POST[$field]); })) {
          render_registration_form();
          goto end;
        } elseif ($_POST["password"] !== $_POST["confirm-password"]) {
          $error = "Your passwords do not match.";
        } elseif($age_of_consent > date("Y-m-d")) {
          $error = "You must at least be $min_age years old to create an accoount.";
        } else {
          $conn = connect_to_db();
          if(!$conn) {
            $error = "We apologize for the inconvenience. An unexpected error occured.";
            goto errorForm;
          }
          
          $result = register_user(
            $conn,
            $_POST["username"],
            $_POST["password"],
            $_POST["firstname"],
            $_POST["lastname"],
            $_POST["gender"],
            $_POST["dob"]
          );

          if(!$result) {
            $error = "Error: ".mysqli_error($conn);
            goto errorForm;
          }

          mysqli_close($conn);

          $error = "Hooray!";
          render_registration_form();
          goto end;
        }
        
        errorForm:
        render_registration_form($_POST["username"], $_POST["firstname"], $_POST["lastname"], $_POST["gender"], $_POST["dob"], $error);
        end:
      ?>
      <div class="row w-100 mb-3">
        <div class="col-6"><p class="w-100 mt-2" style="max-width: 768px;">Already have an account? <a href="index.php">Log in!</a></p>  </div>
        <div class="col-6"></div>
      </div>
      
    </section>
  </body>
</html>