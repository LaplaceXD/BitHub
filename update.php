<?php
  session_start();
  require_once("src/components/imports.php");
  if(!isset($_SESSION["userID"])) {
    header("Location:index.php");
  } elseif(!isset($_GET["id"])) {
    header("Location:home.php");
  }

  $post_id = $_GET["id"];
  $msg = "";
?>
<!DOCTYPE html>
<html>
  <?php
    require_once("src/components/imports.php");
    if(!isset($_SESSION["userID"])) {
      header("Location:home.php");
    }

    render_head(array("form", "pages/home"));
    echo "\n";
  ?>
  <body>
    <?php render_header(); ?>
    <main class="posts">
      <h1>Hi, <?php echo $_SESSION["username"];?></h1>
      <?php
        $conn = connect_to_db();
        if(!$conn) {  
          $msg = "error:We apologize for the inconvenience. An unexpected error occured.";
          goto end;
        }

        $sql = "SELECT Content FROM Content WHERE ID = $post_id";
        $result = mysqli_query($conn, $sql);
        if(!$result) {
          $msg = "error:".mysqli_error($conn);
          goto end;
        }

        $post_content = mysqli_fetch_assoc($result)["Content"];
        render_post_form($post_content);

        if($_SERVER["REQUEST_METHOD"] == "POST") {
          $result = get_post_user($conn, $post_id);
          if(!$result) {
            $msg = "error:".mysqli_error($conn);
            goto end;
          }

          $user_id = mysqli_fetch_assoc($result)["UserID"];
          if($user_id != $_SESSION["userID"]) {
            $msg = "error:You are not allowed to edit other people's posts.";
            goto end;
          }

          $result = update_content($conn, $_POST["content"], $post_id);
          if(!$result) {
            $msg = "error:".mysqli_error($conn);
            goto end;
          }

          $msg = "success:Successfully Edited post.";
          mysqli_close($conn);
  
          end:
          $_SESSION["msg"] = $msg;
          if (headers_sent()) {
            echo("<script>location.href = 'home.php';</script>");
          } else {
            header("Location:home.php");
          }
        }
      ?>
    </main>
  </body>
</html>