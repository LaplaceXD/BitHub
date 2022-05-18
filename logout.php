<?php
  session_start();
  require_once("src/components/imports.php");
  if(!isset($_SESSION["userID"])) {
    header("Location:index.php");
  }
  
  unset($_SESSION["userID"]);
  unset($_SESSION["username"]);

  header("Location:index.php");
?>