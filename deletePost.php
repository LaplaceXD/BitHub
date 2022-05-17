<?php

session_start();

$post_id = $_GET["id"];


if delete_post($conn, $post_id) {
    echo "Post was successfully deleted.";
}
else {
    echo "An unexpected error occured.";
}

header("location: home.php");
exit();

?>