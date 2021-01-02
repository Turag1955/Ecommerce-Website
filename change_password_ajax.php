<?php

require_once './connection.php';
require_once './function.php';


$current_password = get_safe_value($conn, $_POST['current_password']);
$new_password = get_safe_value($conn, $_POST['new_password']);
 $uid = $_SESSION['users_id'];

$row = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `password`= '$current_password' and id = '$uid' "));

if($row>0){
    mysqli_query($conn, "UPDATE `users` SET `password`='$new_password' WHERE id = '$uid' ");
    echo 'Confirm password is Set';
    
} else {
    echo 'This passowd incorrect';
}











?>