<?php

require_once './connection.php';
require_once './function.php';

$name = get_safe_value($conn, $_POST['name']);
$email = get_safe_value($conn, $_POST['email']);
$mobile = get_safe_value($conn, $_POST['mobile']);
$comment = get_safe_value($conn, $_POST['comment']);
$date = date('d-m-y h:i:s');

$query = mysqli_query($conn, "INSERT INTO `contact`(`name`, `email`, `mobile`, `comment`, `insertdate`) VALUES ('$name','$email','$mobile','$comment','$date')");
if($query){
    echo 'thank you';
   
}
?>