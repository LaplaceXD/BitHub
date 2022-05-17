<?php
    function post($conn){
        $sql = "SELECT * FROM Content
        LEFT JOIN Post ON Content.ID = Post.ContentID
        LEFT JOIN User ON User.ID=Content.UserID
        ";
        return mysqli_query($conn, $sql);
    }
?>