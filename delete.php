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

  $conn = connect_to_db();
  if(!$conn) {  
    $msg = "error:We apologize for the inconvenience. An unexpected error occured.";
  } else {
    $result = get_post_user($conn, $post_id);
    if(!$result) {
      $msg = "error:".mysqli_error($conn);
      goto end;
    }

    $user_id = mysqli_fetch_assoc($result)["UserID"];
    if($user_id != $_SESSION["userID"]) {
      $msg = "error:You are not allowed to delete other people's posts.";
      goto end;
    }

    $result = delete_content($conn, $post_id);
    if(!$result) {
      $msg = "error:".mysqli_error($conn);
      goto end;
    }

    $msg = "success:Successfully deleted post.";
    mysqli_close($conn);
  }

  end:
  $_SESSION["msg"] = $msg;
  header("Location:home.php");
?>