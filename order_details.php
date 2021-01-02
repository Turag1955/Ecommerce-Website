<?php
require_once './header.php';
if(!isset($_GET['id']) && $_GET['id'] == ''){
    header("location:index.php");
}
$order_id = get_safe_value($conn, $_GET['id']);
$coupon_assoc = mysqli_fetch_assoc(mysqli_query($conn, "select * from orders where id = $order_id"));
$coupon_name = $coupon_assoc['coupon_name'];
$discount_less = $coupon_assoc['discount_less'];
?>

<div class="ht__bradcaump__wrap " style="background-image: url('maxresdefault.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="bradcaump__inner">
                    <nav class="bradcaump-inner">
                        <a class="breadcrumb-item text-dark" href="index.html">Home</a>
                        <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                        <span class="breadcrumb-item active">My order</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table table-responsive">
                            <table>
                                <thead>
                                    <tr>


                                        <th class="product-name"><span class="nobr"> Name  </span></th>
                                        <th class="product-price"><span class="nobr"> Image </span></th>
                                        <th class="product-price"><span class="nobr"> Qty </span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Price</span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Total Price  </span></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $uid = $_SESSION['users_id'];
                                    $sql = "SELECT orderdetails.*,product.name,product.image 
                                                FROM orderdetails,product
                                                WHERE orderdetails.product_id = product.id AND orderdetails.order_id = '$order_id' ";
                                    $query = mysqli_query($conn, $sql);
                                    $toral_price = 0;
                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                        $toral_price = $toral_price + ($assoc['qty'] * $assoc['price']);
                                        ?>
                                        <tr>
                                            <td class="product-name"><?= $assoc['name'] ?></td>
                                            <td class="product-name"> <img src="assets/backend/upload/product/<?= $assoc['image'] ?>" width="100"alt=""/></td>
                                            <td class="product-name"><?= $assoc['qty'] ?></td>
                                            <td class="product-name"><?= $assoc['price'] ?> Tk</td>
                                            <td class="product-name"><?= $assoc['qty'] * $assoc['price'] ?> Tk</td>

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>Total price</td>
                                        <td><?= $toral_price ?> Tk</td>
                                    </tr>
                                    <?php
                                    if ($coupon_name != '') {
                                        ?>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Discount</td>
                                            <td><?= $discount_less ?> Tk</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Total</td>
                                            <td><?= $discount_less - $toral_price ?> Tk</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once './footer.php'; ?>