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
    $sql = "SELECT Username, Password FROM `user` WHERE Username = '".$user."'";
    return mysqli_query($conn, $sql);
  }
?>