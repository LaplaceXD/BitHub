<!DOCTYPE html>
<html>
    <?php
        require_once("src/components/imports.php");
        render_head();
    ?>
    <body>
        <section>
           <div class="content">
               <h1>Posts</h1>
               <?php
                    $conn = connect_to_db();
                    if(!$conn) {  
                      echo "We apologize for the inconvenience. An unexpected error occured.";
                    } else {
                        $result = post($conn);
                    }
               ?>
           </div>
        </section>
    </body>
</html>