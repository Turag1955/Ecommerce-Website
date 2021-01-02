<?php
require_once 'header.php';
$cat_id = '';
$sub_cat_id = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $cat_id = get_safe_value($conn, base64_decode($_GET['id']));
}
if (isset($_GET['subid']) && $_GET['subid'] != '') {
    $sub_cat_id = get_safe_value($conn, $_GET['subid']);
}
$order = '';
if (isset($_GET['sot'])) {

    $soting = get_safe_value($conn, $_GET['sot']);

    if ($soting == 'default') {
        $order = 'order by product.name desc';
    } else if ($soting == 'hight_price') {
        $order = 'order by product.price desc';
        $hight_price = 'selected';
    } else if ($soting == 'low_price') {
        $order = 'order by product.price asc';
        $low_price = 'selected';
    } else if ($soting == 'new') {
        $order = 'order by product.id desc';
        $new = 'selected';
    } else if ($soting == 'old') {
        $order = 'order by product.id asc';
        $old = 'selected';
    }
}
$row = mysqli_num_rows(mysqli_query($conn, "select * from category where id = $cat_id "));
if ( $row> 0) {
    if ($cat_id > 0) {
        $get_product = get_product($conn, '', $cat_id, '', '', $order, '');
    } else if ($sub_cat_id > 0) {
        $get_product = get_product($conn, '', $cat_id, '', '', $order, '', $sub_cat_id);
    } else {
        ?>
        <script type="text/javascript">
            window.location.href = "index.php";
        </script>
        <?php
    }
} else {
    ?>
    <script type="text/javascript">
        window.location.href = "index.php";
    </script>
    <?php
}
?>

<div class="body__overlay"></div>
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__wrap " style="background-image: url('maxresdefault.jpg');">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="index.html">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active">Product</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Grid -->
<section class="htc__product__grid bg__white ptb--100">
    <div class="container">

        <div class = "row">
            <?php
            if ($row> 0) {
                ?>
                <div class = "col-lg-12  col-md-12  col-sm-12 col-xs-12">
                    <h2></h2>
                    <div class = "htc__product__rightidebar">
                        <div class = "htc__grid__top">
                            <div class = "htc__select__option">
                                <select class = "ht__select" onchange="product_soting(<?= $cat_id ?>)" id="soting_select" >
                                    <option value="default">Default soting</option>
                                    <option <?php
            if (isset($hight_price)) {
                echo $hight_price;
            }
                ?> value="hight_price">High Price</option>
                                    <option <?php
                                if (isset($low_price)) {
                                    echo $low_price;
                                }
                ?> value="low_price">Low Price</option>
                                    <option <?php
                                if (isset($new)) {
                                    echo $new;
                                }
                ?> value="new">New</option>
                                    <option <?php
                                if (isset($old)) {
                                    echo $old;
                                }
                ?> value="old">Old</option>
                                </select>
                            </div>

                            <!--Start List And Grid View-->
                            <ul class = "view__mode" role = "tablist">
                                <li role = "presentation" class = "grid-view active"><a href = "#grid-view" role = "tab" data-toggle = "tab"><i class = "zmdi zmdi-grid"></i></a></li>
                                <li role = "presentation" class = "list-view"><a href = "#list-view" role = "tab" data-toggle = "tab"><i class = "zmdi zmdi-view-list"></i></a></li>
                            </ul>
                            <!--End List And Grid View-->
                        </div>
                        <!--Start Product View-->
                        <div class = "row">
                            <div class = "shop__grid__view__wrap">
                                <div role = "tabpanel" id = "grid-view" class = "single-grid-view tab-pane fade in active clearfix">

                                    <!--Start Single Product-->
                                    <?php
                                    foreach ($get_product as $product) {
                                        ?>
                                        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                                            <div class="category">
                                                <div class="ht__cat__thumb">
                                                    <a href="product.php?pid=<?= $product['id'] ?>">
                                                        <img src="assets/backend/upload/product/<?= $product['image'] ?>" width="50" height="250" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="fr__hover__info">
                                                    <ul class="product__action">
                                                        <li><a href="javascript:void(0)" onclick="wishlist_manage('<?= $product['id'] ?>')"><i class="icon-heart icons"></i></a></li>

                                                        <li><a href="javascript:void(0)" onclick="add_to_cat('<?= $product['id'] ?>', 'add', 'qty')"><i class="icon-handbag icons"></i></a></li>

                                                        <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="fr__product__inner">
                                                    <h4><a href="product.php?pid=<?= $product['id'] ?>"><?= $product['name'] ?></a></h4>
                                                    <ul class="fr__pro__prize">
                                                        <li class="old__prize">MRP <?= $product['mrp'] ?></li>
                                                        <li><?= $product['price'] ?> TK</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>

                                    <!-- End Single Product -->

                                </div>
                                <div role="tabpanel" id="list-view" class="single-grid-view tab-pane fade clearfix">
                                    <?php
                                    foreach ($get_product as $product) {
                                        ?>
                                        <div class="col-xs-12">
                                            <!-- Start List Product -->                 
                                            <div class="ht__list__wrap">

                                                <div class="ht__list__product">
                                                    <div class="ht__list__thumb">
                                                        <a href="product.php?id=<?= $product['id'] ?>"><img src="./assets/backend/upload/product/<?= $product['image'] ?>" width="50" height="250" alt="product images"></a>
                                                    </div>
                                                    <div class="htc__list__details">
                                                        <h2><a href="product.php?id=<?= $product['id'] ?>"> <?= $product['name'] ?></a></h2>
                                                        <ul  class="pro__prize">
                                                            <li class="old__prize">MRP <?= $product['mrp'] ?></li>
                                                            <li><?= $product['price'] ?> TK</li>
                                                        </ul>
                                                        <ul class="rating">
                                                            <li><i class="icon-star icons"></i></li>
                                                            <li><i class="icon-star icons"></i></li>
                                                            <li><i class="icon-star icons"></i></li>
                                                            <li class="old"><i class="icon-star icons"></i></li>
                                                            <li class="old"><i class="icon-star icons"></i></li>
                                                        </ul>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisLorem ipsum dolor sit amet, consec adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqul Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                        <div class="fr__list__btn">
                                                            <a class="fr__btn" href="cart.html">Add To Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End List Product -->
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- End Product View -->
                    </div>
                </div>
                <?php
            } else {
                echo 'product Not found';
            }
            ?>
        </div>



    </div>
</section>
<!-- End Product Grid -->

<!-- Start Banner Area -->
<div class="htc__banner__area">
    <ul class="banner__list owl-carousel owl-theme clearfix">
        <li><a href="product-details.html"><img src="images/banner/bn-3/1.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/2.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/3.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/4.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/5.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/6.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/1.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/2.jpg" alt="banner images"></a></li>
    </ul>
</div>
</div>
<?php require_once 'footer.php'; ?>
    