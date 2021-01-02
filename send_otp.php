<?php

require_once './connection.php';
require_once './function.php';



$type = get_safe_value($conn, $_POST['type']);

if ($type == 'email') {
    $user_email = get_safe_value($conn, $_POST['email']);
    $otp = rand(1111, 9999);
    $_SESSION['otp'] = $otp;
    $body = "$otp is your otp";
    $subject = "New OTP";
    $header = "From: fatimaakter44532@gmail.com";
    if (mail($user_email, $subject, $body, $header)) {
        echo 'done';
    }
}
?>