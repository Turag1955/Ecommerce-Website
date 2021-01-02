<?php
require_once 'header.php';

if (isset($_POST['search_submit'])) {
    $user_search = $_POST['search'];
    $search = get_product($conn, '', '', '', $user_search);
    if (count($search) == 0) {
        $search_msg = 'Search Not Found';
    }
}






/*
  $cat_id = get_safe_value($conn, $_GET['id']);
  if($cat_id>0){
  $get_product = get_product($conn, '', $cat_id);
  } else {
  ?>
  <script type="text/javascript">
  window.location.href="index.php";
  </script>
  <?php
  }
 * 
 */
?>



<div class="body__overlay"></div>
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__wrap ">
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
            <div class = "col-lg-12  col-md-12  col-sm-12 col-xs-12">
                <div class = "htc__product__rightidebar">
                    <div class = "htc__grid__top">
                    </div>
                    <!--Start Product View-->
                    <div class = "row">
                        <div class = "shop__grid__view__wrap">
                            <div role = "tabpanel" id = "grid-view" class = "single-grid-view tab-pane fade in active clearfix">

                                <!--Start Single Product-->
                                <?php
                                if (isset($search_msg)) {
                                    ?>
                                    <div class="alert alert-danger text-center"><?= $search_msg ?></div>
                                    <?php
                                }
                                foreach ($search as $search_product) {
                                    ?>
                                    <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                                        <div class="category">
                                            <div class="ht__cat__thumb">
                                                <a href="product.php?id=<?= $search_product['id'] ?>">
                                                    <img src="assets/upload/product/<?= $search_product['image'] ?>" width="50" height="250" alt="product images">
                                                </a>
                                            </div>
                                            <div class="fr__hover__info">
                                                <ul class="product__action">
                                                    <li><a href="javascript:void(0)" onclick="wishlist_manage('<?= $search_product['id'] ?>')"><i class="icon-heart icons"></i></a></li>

                                                    <li><a href="javascript:void(0)" onclick="add_to_cat('<?= $search_product['id'] ?>', 'add', 'qty')"><i class="icon-handbag icons"></i></a></li>

                                                    <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="fr__product__inner">
                                                <h4><a href="product.php?id=<?= $search_product['id'] ?>"><?= $search_product['name'] ?></a></h4>
                                                <ul class="fr__pro__prize">
                                                    <li class="old__prize">MRP <?= $search_product['mrp'] ?></li>
                                                    <li><?= $search_product['price'] ?> TK</li>
                                                </ul>
                                            </div>
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
    