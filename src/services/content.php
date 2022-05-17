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

  function create_content($conn, $userID, $content, $contenttype, $postID = "") {
    //if post, postID must be ""
    //if comment, postID must have value

    //Reflect to Content Table
    $sql = "INSERT INTO `Content` (`UserID`, `Content`, `ContentType`, `Likes`)
    VALUES ('".$userID."', '".$content."', '".$contenttype."', '0')";
    $result = mysqli_query($conn, $sql);

    if(empty($result)){
      return mysqli_error($conn);
    }else{
      if($contenttype == 'P'){
        //Reflect to Post Table
        $postedID = mysqli_insert_id($conn);
        $sql= "INSERT INTO `Post` (`ContentID`,`Interested`) VALUES ('".$postedID."', '0');";
        return mysqli_query($conn, $sql);
      }else{ 
        //Reflect to Comment Table
        $contentID = mysqli_insert_id($conn);
        $sql= "INSERT INTO `Comment` (`PostID`,`ContentID`) VALUES ('".$postID."', '".$contentID."');";
        return mysqli_query($conn, $sql);
      }
    }
  }

  function delete_content($conn, $post_id) {
    $delete = "DELETE FROM content WHERE $post_id = id;";
    return mysqli_query($conn, $delete);
  }
?>