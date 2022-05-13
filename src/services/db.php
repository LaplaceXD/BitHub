<?php
  function connect_to_db(): mysqli | false | null {
    $credentials = file(".htsecret", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    if(!file_exists($credentials)) return null;    

    list($servername, $username, $password, $dbname) = explode(":", $credentials[0]);

    return @mysqli_connect($servername, $username, $password, $dbname);
  }
?>