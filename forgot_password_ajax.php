<?php

require_once './connection.php';
require_once './function.php';


$email = get_safe_value($conn, $_POST['email']);


$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`= '$email' ");
$row = mysqli_num_rows($query);

if ($row > 0) {
    $assoc = mysqli_fetch_assoc($query);
    $password = $assoc['password'];
    $body = "Your password is $password";
    $subject = "Your password";
    $header = "From: fatimaakter44532@gmail.com";
    
    if(mail($email, $subject, $body,$header)){
        echo 'Check Your Mail';
    } else {
        echo 'try again';
    }
    
} else {
    echo 'This email incorrect';
}
?>