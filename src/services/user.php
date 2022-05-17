<?php
  function register_user(
    $conn,
    $user,
    $pass,
    $fname,
    $lname,
    $gender,
    $dob
  ) {
    $sql = "INSERT INTO `user` (`Username`, `Password`, `FirstName`, `LastName`, `BirthDate`, `Gender`) 
    VALUES ('".$user."', '".password_hash($pass, PASSWORD_DEFAULT)."', '".$fname."', '".$lname."', '".$dob."', '".$gender."')";

    return mysqli_query($conn, $sql);
  }
  
  function get_user($conn, $user) {
    $sql = "SELECT Username, Password FROM `user` WHERE Username = '".$user."'";
    return mysqli_query($conn, $sql);
  }

  function get_user_id($conn, $username) {
    $sql = "SELECT id FROM user WHERE username = '".$username."';";
    return mysqli_query($conn, $sql);
  }
?>