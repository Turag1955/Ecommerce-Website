<?php
require_once './connection.php';
require_once './function.php';
require_once './add_to_cart.php';
$obj = new add_to_cart();
$totalcart = $obj->totalproduct();

if (isset($_SESSION['users_id'])) {
    $user_id = $_SESSION['users_id'];

    if (isset($_GET['id'])) {
        $wid = get_safe_value($conn, $_GET['id']);
        mysqli_query($conn, "delete from wishlist where user_id = '$user_id' and id = '$wid' ");
    }

    $count = mysqli_num_rows(mysqli_query($conn, "SELECT product.name,product.price,product.mrp,product.image,wishlist.id FROM wishlist,product WHERE wishlist.product_id = product.id AND wishlist.user_id = '$user_id' "));
}
$title = 'A to Z shop';
$meta_description = 'A to Z shop';
$meta_keyword = 'A to Z shop';
if (isset($_GET['pid']) && $_GET['pid'] != '') {
    $poduct_id = get_safe_value($conn, $_GET['pid']);

    $link = $_SERVER['PHP_SELF'];
    $explode = explode('/', $link);
    $page = end($explode);
    if ($page == 'product.php') {
        $meta_assoc = mysqli_fetch_assoc(mysqli_query($conn, "select * from product where id = '$poduct_id' "));
        $title = $meta_assoc['meta_title'];
        $meta_description = $meta_assoc['meta_description'];
        $meta_keyword = $meta_assoc['meta_keyword'];
    }
}
?>



<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= $title ?> </title>
        <meta name="description" content="<?= $meta_description ?>">
        <meta name="keyword" content="<?= $meta_keyword ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">


        <!-- All css files are included here. -->
        <!-- Bootstrap fremwork main css -->
        <link rel="stylesheet" href="./assets/fontEnd/css/bootstrap.min.css">
        <!-- Owl Carousel min css -->
        <link rel="stylesheet" href="./assets/fontEnd/css/owl.carousel.min.css">
        <link rel="stylesheet" href="./assets/fontEnd/css/owl.theme.default.min.css">
        <!-- This core.css file contents all plugings css file. -->
        <link rel="stylesheet" href="./assets/fontEnd/css/core.css">
        <link rel="stylesheet" href="./assets/fontEnd/css/navbar-fixed.css">
        
        <!-- Theme shortcodes/elements style -->
        <link rel="stylesheet" href="./assets/fontEnd/css/shortcode/shortcodes.css">
        <!-- Theme main style -->
        <link rel="stylesheet" href="./assets/fontEnd/css/style.css">
        <!-- Responsive css -->
        <link rel="stylesheet" href="./assets/fontEnd/css/responsive.css">
        <!-- User style -->
        <link rel="stylesheet" href="./assets/fontEnd/css/custom.css">



        <!-- Modernizr JS -->
        <script src="./assets/fontEnd/js/vendor/modernizr-3.5.0.min.js"></script>
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->  

        <!-- Body main wrapper start -->
        <div class="wrapper">
            <!-- Start Header Style -->
            <header id="htc__header" class="htc__header__area header--one">
                <!-- Start Mainmenu Area -->
                <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                    <div class="container">
                        <div class="row">
                            <div class="menumenu__container clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                    <div class="logo">
                                        <a href="index.php"><img src="./assets/fontEnd/images/logo/4.png" alt="logo images"></a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-4 col-xs-2">
                                    <nav class="main__menu__nav hidden-xs hidden-sm">
                                        <ul class="main__menu">
                                            <li class=""><a href="index.php">Home</a></li>
                                            <?php
                                            $get_category = get_category($conn);

                                            foreach ($get_category as $category) {
                                                ?>
                                                <li class="drop"><a href="category.php?id=<?= base64_encode($category['id']) ?>"><?= $category['category'] ?>
                                                        <?php
                                                        $catgory_id = $category['id'];
                                                        $sub_cat_query = mysqli_query($conn, "select * from sub_category where status = 1 and category_id = '$catgory_id' ");
                                                        if (mysqli_num_rows($sub_cat_query) > 0) {
                                                            ?>
                                                            <ul class="dropdown">
                                                                <?php
                                                                while ($sub_cat_assoc = mysqli_fetch_assoc($sub_cat_query)) {
                                                                    //pr($sub_cat_assoc);
                                                                    ?>
                                                                    <li><a href="category.php?subid=<?= $sub_cat_assoc['id'] ?>"><?= $sub_cat_assoc['sub_category'] ?></a></li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        <?php }
                                                        ?>
                                                    </a> </li>
                                                <?php
                                            }
                                            ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>

                                    <div class="mobile-menu clearfix visible-xs visible-sm">
                                        <nav id="mobile_dropdown">
                                            <ul>
                                                <li><a href="index.php">Home</a></li>
                                                <?php
                                                $get_category = get_category($conn);
                                                foreach ($get_category as $list) {
                                                    ?>
                                                    <li><a href=""><?= $list['category'] ?></a></li>

                                                    <?php
                                                }
                                                ?>
                                                <li><a href="contact.html">contact</a></li>
                                            </ul>
                                        </nav>
                                    </div>  
                                </div>




                                <div class="col-md-4 col-lg-4 col-sm-5 col-xs-5">
                                    <div class="header__right">
                                        <div class="header__search search search__open">
                                            <a href="#"><i class="icon-magnifier icons"></i></a>
                                        </div>
                                        <div class="header__account">

                                            <?php
                                            if (isset($_SESSION['users_email'])) {
                                                $user_name = $_SESSION['users_name'];
                                                ?>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><?= ucwords($user_name) ?></a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="my_order.php">Order</a>
                                                        <a class="dropdown-item" href="profile.php">Profile</a>
                                                        <a class="dropdown-item" href="logout.php">Logout</a>

                                                    </div>
                                                </li>
                                                <?php
                                                // echo '<a class="foat-left" href="logout.php">Logout</a><a href="my_order.php">order</a>';
                                            } else {
                                                echo '<a href="login.php">Login/Register</a>';
                                            }
                                            ?>
                                        </div>
                                        <div class="htc__shopping__cart">
                                            <?php
                                            if (isset($_SESSION['users_id'])) {
                                                ?>
                                                <a class="cart__menu" href="javascript:void(0)"><i class="icon-heart icons"></i></a>
                                                <a href="wishlist.php"><span class="htc__qua wishlist"><?= $count ?></span></a>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="htc__shopping__cart">
                                            <a class="cart__menu" href="javascript:void(0)"><i class="icon-handbag icons"></i></a>
                                            <a href="cart.php"><span class="htc__qua"><?= $totalcart ?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mobile-menu-area"></div>
                    </div>
                </div>
                <!-- End Mainmenu Area -->
            </header>
            <!-- End Header Area -->


            <!-- Start Offset Wrapper -->
            <div class="offset__wrapper">
                <!-- Start Search Popap -->
                <div class="search__area">
                    <div class="container" >
                        <div class="row" >
                            <div class="col-md-12" >
                                <div class="search__inner">
                                    <form action="search.php" method="post">
                                        <input placeholder="Search here... " type="text" name="search">
                                        <button type="submit" name="search_submit"></button>
                                    </form>
                                    <div class="search__close__btn">
                                        <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Search Popap -->

            </div>