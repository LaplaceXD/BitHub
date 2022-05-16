<?php

    $conn = connect_to_db();
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    function post($post) {
        $post = explode($post, "\n");
        $buffer = ' ';

        foreach($post as $p) {
            $buffer .= '<p>'.$p.'</p>';
        }

        return $buffer;
    }

?>