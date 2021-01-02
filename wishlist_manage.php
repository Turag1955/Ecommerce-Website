<?php

require_once './connection.php';
require_once './function.php';

if (isset($_POST)) {
    $pid = get_safe_value($conn, $_POST['pid']);
   
    if (isset($_SESSION['users_id'])) {
        $user_id = $_SESSION['users_id'];
        $added_on = date('d-M-Y h:i:s');
     
        if (mysqli_num_rows(mysqli_query($conn, "select * from wishlist where user_id = $user_id and product_id = $pid")) > 0) {
           // echo 'wishlist exit';
        } else {
           // mysqli_query($conn, "insert into wishlist (user_id,product_id,added_on) values('$user_id','$pid','$added_on')");
            wishlist($conn,$user_id,$pid,$added_on);
        }
      echo   $total = mysqli_num_rows(mysqli_query($conn,"select * from wishlist where user_id = $user_id"));
    } else {
        $_SESSION['wpid'] = $pid;
        echo 'not_login';
    }
}
?>