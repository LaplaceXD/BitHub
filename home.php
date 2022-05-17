<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <?php
    require_once("src/components/imports.php");
    if(!isset($_SESSION["userID"])) {
      header("Location:index.php");
    }

    render_head(array("form", "pages/home"));
    echo "\n";
  ?>
  <body>
    <?php render_header(); ?>
    <main class="posts">
      <?php
        render_post_form();
        if(isset($_SESSION["msg"])) {
          echo "<p class='msg'>".$_SESSION["msg"]."</p>";
          unset($_SESSION["msg"]);
        }
        
        $conn = connect_to_db();
        if(!$conn) {  
          echo "We apologize for the inconvenience. An unexpected error occured.";
        } else {
          if($_SERVER["REQUEST_METHOD"] == "POST") {
            $content = test_input($_POST["content"]);
            
            if(!isset($_POST["content"]) || !test_input($_POST["content"])) {
              echo "<p class='msg'>error:Unfortunately, posts can not be empty.</p>";
            } else {
              $result = create_content($conn, $_SESSION["userID"], $content, "P");

              if(!$result) {
                echo "<p class='msg'>error:".mysqli_error($conn)."</p>";
              } else {
                echo "<p class='msg'>success:Post was successfully posted.</p>";
                unset($_POST["content"]);
              }
            }
          }

          $result = get_content($conn);

          if(!$result) {
              echo "<p class='msg'>error:".mysqli_error($conn)."</p>";
          } elseif($result->num_rows === 0) {
              echo "<h2 style='text-align: center; margin-top: 12px;'>No posts to show!</h2>";
          } else {
            while($row = mysqli_fetch_assoc($result)) {
              $id = $row["ContentID"];
              render_post(
                $row["Username"],
                $id,
                $row["DatePosted"],
                $row["Content"],
                $row["Likes"],
              );
            }
          }
        }

        mysqli_close($conn);
      ?>
    </main>
  </body>
</html>