<?php
  session_start();
?>

<!DOCTYPE html>
<html>
    <?php
        require_once("src/components/imports.php");
        render_head();
        $_SESSION["contenttype"] = "P";
    ?>
    <body>
        <section>
           <div class="container mt-5">
           <h1 class="text-primary text-center">POSTS</h1>
               <?php
                    $conn = connect_to_db();
                    if(!$conn) {  
                      echo "We apologize for the inconvenience. An unexpected error occured.";
                    } else {
                        $result = post($conn);

                        if(!$result) {
                            echo "Error: ".mysqli_error($conn);
                        } elseif($result->num_rows === 0) {
                            echo "<h2>No Post to show!</h2>";
                        } else {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                    <div class='mb-3' style='border:1px solid black;'>
                                        <h6>".$row["Username"]."</h6>
                                        <p>".$row["Content"]."</p>
                                        <p>".$row["DatePosted"]."</p>
                                    </div>";
                            }
                        }
                    }
               ?>

               
           </div>
        </section>
        <a href="createcontent.php"><h1>Create a Post.</h1></a>
    </body>
</html>