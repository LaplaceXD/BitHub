<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <?php
    require_once("src/components/imports.php");
    render_head(array("form", "pages/home"));
    echo "\n";
  ?>
  <body>
    <?php render_header(); ?>
    <main class="posts">
      <?php
        render_post_form();
        
        $conn = connect_to_db();
        if(!$conn) {  
          echo "We apologize for the inconvenience. An unexpected error occured.";
        } else {
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