<?php
require_once 'header.php';
$poduct_id = get_safe_value($conn, $_GET['pid']);


$query = mysqli_query($conn, "SELECT * FROM `product` WHERE `status` = 1 AND `id` = $poduct_id");
$row = mysqli_num_rows($query);
if ($row > 0) {
    $get_product = get_product($conn, '', '', $poduct_id);
} else {
    header("location:index.php");
}
?>
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
                                <span class="breadcrumb-item active"><?= $get_product[0]['category'] ?></span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="htc__product__details bg__white ptb--100">
    <!-- Start Product Details Top -->
    <div class="htc__product__details__top">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                    <div class="htc__product__details__tab__content">
                        <!-- Start Product Big Images -->
                        <div class="product__big__images">
                            <div class="portfolio-full-image tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                    <img src="./assets/backend/upload/product/<?= $get_product[0]['image'] ?>" alt="full-image">
                                </div>
                            </div>
                        </div>
                        <!-- End Product Big Images -->

                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="ht__product__dtl">
                        <h2><?= $get_product[0]['name'] ?></h2>
                        <ul  class="pro__prize">
                            <li class="old__prize">MRP <?= $get_product[0]['mrp'] ?></li>
                            <li><?= $get_product[0]['price'] ?> TK</li>
                        </ul>
                        <?php
                        $totalProductIdBuy = totalProductIdBuy($conn, $get_product[0]['id']);
                        $totalProductIdQty = totalProductIdQty($conn, $get_product[0]['id']);
                        $pending_qty = $totalProductIdQty - $totalProductIdBuy;
                        $cart_show = 'yes';

                        if ($get_product[0]['qty'] > $totalProductIdBuy) {
                            $stock = 'In Stock';
                        } else {
                            $stock = 'Not In Stock';
                            $cart_show = '';
                        }
                        ?>
                        <div class="ht__pro__desc">
                            <div class="sin__desc">
                                <p class="pro__info d-block"><?= $get_product[0]['short_dec'] ?></p><br />
                                <p><span>Availability:</span> <?= ($stock) ? $stock : '' ?></p>
                            </div>

                            <div class="sin__desc">
                                <?php
                                if ($cart_show != '') {
                                    ?>
                                    <p><span>Qty:</span> 
                                        <select  id="qty" class="form-control" >
                                            <?php
                                            for ($i = 1; $i <= $pending_qty; $i++) {
                                                ?>
                                            <option ><?=$i?></option>

                                                <?php
                                            }
                                            ?>

                                        </select>

                                        <span class="feild_error" id="stock_in_qty"></span>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>


                            <div class="sin__desc align--left">
                                <p><span>Categories:</span></p>
                                <ul class="pro__cat__list">
                                    <li><a href="category.php?<?= $get_product[0]['category_id'] ?>"><?= $get_product[0]['category'] ?></a></li>
                                </ul>
                            </div>
                            <br />
                            <?php
                            if ($cart_show != '') {
                                ?>
                                <div class="cr__btn mt-3">
                                    <a href="javascript:void(0)" onclick="add_to_cat('<?= $get_product[0]['id'] ?>', 'add')">Add to Cart </a>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Details Top -->
</section>
<!-- End Product Details Area -->
<!-- Start Product Description -->
<section class="htc__produc__decription bg__white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- Start List And Grid View -->
                <ul class="pro__details__tab" role="tablist">
                    <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                </ul>
                <!-- End List And Grid View -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="ht__pro__details__content">
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                        <div class="pro__tab__content__inner">
                            <p>Formfitting clothing is all about a sweet spot. That elusive place where an item is tight but not clingy, sexy but not cloying, cool but not over the top. Alexandra Alvarez’s label, Alix, hits that mark with its range of comfortable, minimal, and neutral-hued bodysuits.</p>
                            <h4 class="ht__pro__title">Description</h4>
                            <p class="lead"><?= $get_product[0]['description'] ?></p>

                        </div>
                    </div>
                    <!-- End Single Content -->

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Description -->

<!-- Start Footer Area -->

<?php require_once 'footer.php'; ?>
    