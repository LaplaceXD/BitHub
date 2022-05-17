<?php
    $_SESSION["contenttype"] = 'C'; //viewing page
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
                        // Initialize URL to the variable
                        $url = $_SERVER['REQUEST_URI'];
                            
                        // Use parse_url() function to parse the URL 
                        // and return an associative array which
                        // contains its various components
                        $url_components = parse_url($url);
                        
                        // Use parse_str() function to parse the
                        // string passed via URL
                        parse_str($url_components['query'], $params);

                        $content = get_content($conn, $params['id']);

                        if(!$content) {
                            echo "Error: ".mysqli_error($conn);
                        } elseif($content->num_rows === 0) {
                            echo "<h2>No Post to show!</h2>";
                        } else {
                            while($row = mysqli_fetch_assoc($content)) {
                                $id = $row["ContentID"];
                                echo "
                                <div class='mb-3' style='border:1px solid black'>
                                    <h5>".$row["Username"]."</h5>
                                    <p>".$row["Content"]."</p>
                                    <p style='font-size:10px;'>".$row["Likes"]." Likes</p>
                                    <p style='font-size:9px;'>".$row["DatePosted"]."</p>
                                </div>
                                <div style='border:1px solid black; width:fit-content'>
                                    <a href='createcontent.php' target='_self' style='text-decoration:none; color:black'>Add Comment</a>
                                </div>
                                ";
                            }
                        }

                        $comment = get_comment($conn, $params['id']);

                        if(!$comment) {
                            echo "Error: ".mysqli_error($conn);
                        } elseif($comment->num_rows === 0) {
                            echo "<br><h2>No Comments to show!</h2>";
                        } else {
                            echo "<h1 class='text-primary text-center'>COMMENTS</h1>";
                            while($row = mysqli_fetch_assoc($comment)) {
                                //var_dump($row);
                                echo 
                                "<div class='mb-3' style='border:1px solid black'>
                                    <h5>".$row["Username"]."</h5>
                                    <p>".$row["Content"]."</p>
                                    <p style='font-size:10px;'>".$row["Likes"]." Likes</p>
                                </div>";
                            }
                        }

                    }
                    mysqli_close($conn);
               ?>
           </div>
        </section>
    </body>
</html>