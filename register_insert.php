<?php 
    require_once 'connection.php';
    require_once 'function.php';
    
    $name = get_safe_value($conn, $_POST['name']);
    $email = get_safe_value($conn, $_POST['email']);
    $mobile = get_safe_value($conn, $_POST['mobile']);
    $password = get_safe_value($conn, $_POST['password']);
    $date = date('d-m-y h:i:s');
    $email_check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `email` ='$email' "));
    if($email_check>0){
        echo 'email';
    } else {
        mysqli_query($conn, "INSERT INTO `users`( `usersname`, `email`, `mobile`, `password`, `insertdate`) VALUES ('$name','$email','$mobile','$password','$date')");
        echo 'insert';
}

?>