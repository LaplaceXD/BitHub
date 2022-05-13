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
?>