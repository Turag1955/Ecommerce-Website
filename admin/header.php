<?php
require_once '../connection.php';
require_once './function.php';
if (!isset($_SESSION['user_login'])) {
    header("location:index.php");
}

$link = $_SERVER['PHP_SELF'];
$explode = explode('/', $link);
$page = end($explode);
//pr($_SESSION['user_role']);
?>

<!doctype html>
<html class="no-js" lang="">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/backend/css/normalize.css">
        <link rel="stylesheet" href="../assets/backend/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/backend/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/backend/css/themify-icons.css">
        <link rel="stylesheet" href="../assets/backend/css/pe-icon-7-filled.css">
        <link rel="stylesheet" href="../assets/backend/css/flag-icon.min.css">
        <link rel="stylesheet" href="../assets/backend/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="../assets/backend/css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="menu-title">Menu</li>
                        <li class="menu-item-has-children dropdown <?= ($page == 'product.php') ? 'active' : '' ?> <?= ($page == 'add_product.php') ? 'active' : '' ?> <?= ($page == 'update_product.php') ? 'active' : '' ?>">
                            <a href="product.php" > product  Master</a>
                        </li>
                        <li class="menu-item-has-children dropdown <?= ($page == 'orders.php') ? 'active' : '' ?> ">
                            <a href="orders.php" >Orders </a>
                        </li>
                        <?php
                        if ($_SESSION['user_role'] != 1) {
                            ?>
                            <li class="menu-item-has-children dropdown <?= ($page == 'category.php') ? 'active' : '' ?> <?= ($page == 'add_category.php') ? 'active' : '' ?><?= ($page == 'update_category.php') ? 'active' : '' ?> ">
                                <a href="category.php" > category Master</a>
                            </li>
                            <li class="menu-item-has-children dropdown <?= ($page == 'sub_category.php') ? 'active' : '' ?> <?= ($page == 'sub_category.php') ? 'active' : '' ?><?= ($page == 'update_sub_category.php') ? 'active' : '' ?> ">
                                <a href="sub_category.php" > Sub category Master</a>
                            </li>

                            <li class="menu-item-has-children dropdown <?= ($page == 'slider.php') ? 'active' : '' ?>">
                                <a href="slider.php" > Slide Show</a>
                            </li>

                            <li class="menu-item-has-children dropdown <?= ($page == 'coupon.php') ? 'active' : '' ?> ">
                                <a href="coupon.php" >Coupon Master </a>
                            </li>
                            <li class="menu-item-has-children dropdown <?= ($page == 'users.php') ? 'active' : '' ?> ">
                                <a href="users.php" >Users </a>
                            </li>
                            <li class="menu-item-has-children dropdown <?= ($page == 'best_seller.php') ? 'active' : '' ?> ">
                                <a href="best_seller.php" > Best seller </a>
                            </li>
                            <li class="menu-item-has-children dropdown <?= ($page == 'vendor_management.php') ? 'active' : '' ?> ">
                                <a href="vendor_management.php" > vendor management  </a>
                            </li>
                            <li class="menu-item-has-children dropdown <?= ($page == 'contact.php') ? 'active' : '' ?> ">
                                <a href="contact.php" > contact us </a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </nav>
        </aside>
        <div id="right-panel" class="right-panel">
            <header id="header" class="header">
                <div class="top-left">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.html"><img src="../images/logo.png" alt="Logo"></a>
                        <a class="navbar-brand hidden" href="index.html"><img src="../images/logo2.png" alt="Logo"></a>
                        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <div class="top-right">
                    <div class="header-menu">
                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome <?= $_SESSION['user_login'] ?></a>
                            <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>