<?php
    $_SESSION["contenttype"] = 'P'; //homepage
?>
<!DOCTYPE html>
<html>
    <?php
        require_once("src/components/imports.php");
        render_head();
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
                        $result = get_content($conn);
                        // foreach($result as $flower){
                        //     var_dump($flower);
                        // }

                        if(!$result) {
                            echo "Error: ".mysqli_error($conn);
                        } elseif($result->num_rows === 0) {
                            echo "<h2>No Post to show!</h2>";
                        } else {
                            while($row = mysqli_fetch_assoc($result)) {
                                $id = $row["ContentID"];
                                echo 
                                "<a href='comment.php?id=$id' target='_self' style='text-decoration:none; color:black'>
                                    <div class='mb-3' style='border:1px solid black'>
                                        <h5>".$row["Username"]."</h5>
                                        <p>".$row["Content"]."</p>
                                        <p style='font-size:10px;'>".$row["Likes"]." Likes</p>
                                        <p style='font-size:9px;'>".$row["DatePosted"]."</p>
                                    </div>
                                </a>";
                            }
                        }
                    }
                    mysqli_close($conn);
               ?>

               
           </div>
        </section>
    </body>
</html>
<script>
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
    }
    };
    xmlhttp.open("GET", "src/services/post.php?q=" + new Date().getTime(), true);
    xmlhttp.send();
</script>