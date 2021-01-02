<?php

require_once './connection.php';
require_once './function.php';


$user_email = get_safe_value($conn, $_POST['email']);
$user_password = get_safe_value($conn, $_POST['password']);


$sql = "SELECT * FROM `users` WHERE `email`= '$user_email'  AND `password` = '$user_password' ";
$query = mysqli_query($conn, $sql);
$row = mysqli_num_rows($query);


if ($row > 0) {
    $users = mysqli_fetch_assoc($query);
    $_SESSION['users_login'] = 'yes';
    $_SESSION['users_id'] = $users['id'];
    $_SESSION['users_name'] = $users['usersname'];
    $_SESSION['users_email'] = $user_email;

    if (isset($_SESSION['wpid']) && $_SESSION['wpid'] != "") {
        $added_on = date('d-M-Y h:i:s');
        wishlist($conn, $_SESSION['users_id'], $_SESSION['wpid'], $added_on);
        unset($_SESSION['wpid']);
    }
    echo 'valid';
} else {
    echo 'invalid';
}
?>