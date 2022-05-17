<?php 
  session_start();
?>

<!DOCTYPE html>
<html>
  <?php
    include "src/services/db.php";
    include "src/services/user.php";
    $conn = connect_to_db();
    $contenttype = $_SESSION["contenttype"];
    
    function create_content($conn, $content, $contenttype, $postID) {
      //if post, postID must be ""
      //if comment, postID must have value
      
      //Reflect to Content Table
      $userID = $_SESSION["userID"];
      $sql = "INSERT INTO `Content` (`UserID`, `Content`, `ContentType`, `Likes`) VALUES ('".$userID."', '".$content."', '".$contenttype."', '0')";
      $result = mysqli_query($conn, $sql);
      if(empty($result)){
        return("Error: ".mysqli_error($conn));
        echo"Error in posting content.";
      }else{
        if($contenttype == 'P'){
          //Reflect to Post Table
          $postedID = mysqli_insert_id($conn);
          $sql= "INSERT INTO `Post` (`ContentID`,`Interested`) VALUES ('".$postedID."', '0');";
          mysqli_query($conn, $sql);
        }else{ 
          //Reflect to Comment Table
          $contentID = mysqli_insert_id($conn);
          $sql= "INSERT INTO `Comment` (`PostID`,`ContentID`) VALUES ('".$postID."', '".$contentID."');";
          mysqli_query($conn, $sql);
        }
      }
      return mysqli_query($conn, $sql);
    }

    function test_input($data) { // check user input
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
  ?>
    
  <h1>Create a</h1>
  <?php 
    if($contenttype == 'P'){
      echo "<h1>Post</h1><br>";
    }else{
      echo "<h1>Comment</h1><br>";
    }
  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Content<br>
    <input type="text" name="content" required/>
    <input type="submit" name="submit" value="Submit">
  </form>

  <?php
    $content = test_input($_POST["content"]);
    if(isset($_POST['submit'])){
      if(!$content){
        echo "Please input content";
      }else{
        $postID = $_GET["post"];
        if($contenttype == 'P'){
          $return = create_content($conn, $content, $contenttype, "");//for post table
        }else{
          $return = create_content($conn, $content, $contenttype, $postID);//for comment table
        }
        if(empty($return)){
          echo "Post unsuccessful";
        }else{
          echo "Posted successfully";
          //header("Location: home.php", TRUE, 301);//redirect if posted successfully
          //exit();
        }
      }
    }
  ?>

  <a href="home.php"><h1>Return to homepage.</h1></a>
  
</html>