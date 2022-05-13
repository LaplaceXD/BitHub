<?php
  function register_user(
    mysqli $conn,
    string $user,
    string $pass,
    string $fname,
    string $lname,
    string $gender,
    string $dob
  ): mysqli_result | bool {
    $sql = "INSERT INTO `user` (`Username`, `Password`, `FirstName`, `LastName`, `BirthDate`, `Gender`) 
    VALUES ('".$user."', '".password_hash($pass, PASSWORD_DEFAULT)."', '".$fname."', '".$lname."', '".$dob."', '".$gender."')";

    return mysqli_query($conn, $sql);
  }
  
  function get_user(mysqli $conn, string $user): mysqli_result | bool {
    $sql = "SELECT Username, Password FROM `user` WHERE Username = '".$user."'";
    return mysqli_query($conn, $sql);
  }
?>