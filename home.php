<?php
    include "post.php";

    $sql = "SELECT * FROM 'Content' ORDER BY 'id' DESC LIMIT 20";
    $res = mysqli_query($sql);
                    
    if($res && mysqli_num_rows($res) > 0) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
                
        // Retrieve individual field value
        $user = $row["UserID"];
        $post = $row["Content"];
        $like = $row["Likes"];
    } else {
        echo "
            <div class="post">
            <h1>No Post Found</h1>
            </div>"
    }
?>
<!DOCTYPE html>
<html>
    <?php
        require_once("src/components/imports.php");
        render_head();
    ?>
    <body>
        <section>
           <div class="content">
               <div class="user">
                    <p><?php echo $row["UserID"]; ?></p>
               </div>
               <div class="content">
                    <p><?php echo post($row["Content"]); ?></p>
               </div>
               <div class="likes">
                    <p><?php echo $row["Likes"]; ?></p>
               </div>
           </div>
        </section>
    </body>
</html>