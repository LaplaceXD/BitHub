<?php
  function get_content($conn, $id="") {
      $where = $id ? "WHERE Content.ID=".$id."" : "";

      $sql = "
      SELECT * FROM Content as Content
      LEFT JOIN Post as Post ON Content.ID=Post.ContentID
      LEFT JOIN User as User ON Content.UserID=User.ID
      ".$where."
      ORDER BY Post.DatePosted DESC
      ";

      return mysqli_query($conn, $sql);
  }
?>