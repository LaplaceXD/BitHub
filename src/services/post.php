<?php
   function post($conn) {
       $sql = "SELECT Content FROM Content";

       return mysqli_query($conn, $sql);
   }
?>