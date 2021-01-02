<?php

require_once './connection.php';
require_once './function.php';
if (isset($_POST)) {
    $pid = get_safe_value($conn, $_POST['pid']);
    $delete = get_safe_value($conn, $_POST['remove']);
    
    if($delete == 'remove'){
        $query = mysqli_query($conn, "delete from wishlist where product_id = '$pid' ");
        if($query){
            echo 'success';
        }
    } else {
        echo 'no remove';
    }
}
?>