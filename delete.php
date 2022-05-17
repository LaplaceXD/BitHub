<?php 

function get_post_user ($conn, $post_id) {
    $sql = "SELECT UserID FROM Content WHERE $post_id = id;";
    $user_id = return mysqli_query($conn, $sql);

    $sql = "SELECT Username FROM User WHERE $user_id = id;";
    return mysqli_query($conn, $sql);
}

function verify_user ($conn, $user) {
    if ($_SESSION["user"] == get_post_user($conn, $user)) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

function delete_post ($conn, $post_id) {
    if verify_user($conn, $post_id) {
        $delete = "DELETE FROM content WHERE $post_id = id;";
        return mysqli_query($conn, $delete);
    }
    else {
        return FALSE;
    }
}

?>
