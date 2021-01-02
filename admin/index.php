<?php
require_once '../connection.php';
require_once './function.php';

if (isset($_SESSION['user_login'])) {
    header("location:category.php");
}

$msg = '';
if (isset($_POST['usersubmit'])) {
    $username = get_safe_value($conn, $_POST['username']);
    $userpassword = get_safe_value($conn, $_POST['userpassword']);

    $sql = "SELECT * FROM `admin_users` WHERE `usersname` = '$username' AND `password` = '$userpassword' ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($query);
    if ($row > 0) {
        $assoc = mysqli_fetch_assoc($query);
        $status = $assoc['status'];
        if ($status == 1) {
            $_SESSION['user_id'] = $assoc['id'];
            $_SESSION['user_login'] = $username;
            $_SESSION['user_role'] = $assoc['role'];
            header("Location:product.php");
        } else {
            $msg = 'Your id is Deactive';
        }
    } else {
        $msg = 'your information wrong';
    }
}
?>



<!doctype html>
<html class="no-js" lang="">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/normalize.css">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/themify-icons.css">
        <link rel="stylesheet" href="../assets/css/pe-icon-7-filled.css">
        <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
        <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    </head>
    <body class="bg-dark">
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    <div class="login-form mt-150">

                        <form action="" method="post">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" placeholder="Username" name="username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="userpassword">
                            </div>
                            <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="usersubmit">Sign in</button>
                        </form>
                        <?= $msg ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="assets/js/popper.min.js" type="text/javascript"></script>
        <script src="assets/js/plugins.js" type="text/javascript"></script>
        <script src="assets/js/main.js" type="text/javascript"></script>
    </body>
</html>