<?php
    function get_content($conn, $id="") {
        $and = $id ? " AND Content.ID=".$id."" : "";

        $sql = "
        SELECT * FROM Content as Content
        LEFT JOIN Post as Post ON Content.ID=Post.ContentID
        LEFT JOIN User as User ON Content.UserID=User.ID
        WHERE Content.ContentType='P'
        ".$and."
        ORDER BY Post.DatePosted DESC
        ";
        
        return mysqli_query($conn, $sql);
    }

    function get_comment($conn, $id="") {
        $sql = "
        SELECT * FROM Comment 
        LEFT JOIN Content ON Content.ID=Comment.PostID
        LEFT JOIN User ON User.ID=Content.UserID
        WHERE Comment.ContentID = ".$id."
        ";

        return mysqli_query($conn, $sql);
    }
?>