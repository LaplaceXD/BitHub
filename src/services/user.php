<?php
  function register_user(
    $conn,
    $user,
    $pass,
    $email
  ) {
    $sql = "INSERT INTO `user` (`Username`, `Password`, `Email`) 
    VALUES ('".$user."', '".password_hash($pass, PASSWORD_DEFAULT)."', '".$email."')";

    return mysqli_query($conn, $sql);
  }
  
  function get_user($conn, $user) {
    $sql = "SELECT ID, Username, Password FROM `user` WHERE Username = '".$user."'";
    return mysqli_query($conn, $sql);
  }

  function get_post_user ($conn, $post_id) {
    $sql = "SELECT UserID FROM Content WHERE $post_id = id;";
    return mysqli_query($conn, $sql);
  }
?>