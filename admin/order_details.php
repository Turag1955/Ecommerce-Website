<?php
require_once './header.php';
$order_id = get_safe_value($conn, $_GET['id']);
$coupon_assoc = mysqli_fetch_assoc(mysqli_query($conn, "select * from orders where id = $order_id"));
$coupon_name = $coupon_assoc['coupon_name'];
$discount_less = $coupon_assoc['discount_less'];

if (isset($_POST['status_update'])) {
    $order_id = get_safe_value($conn, $_GET['id']);
    $update_order_statuus = get_safe_value($conn, $_POST['order_status']);
    $updat_query = mysqli_query($conn, "UPDATE `orders` SET `orderstatus`='$update_order_statuus' WHERE id  = '$order_id' ");
}
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                    </div>
                    <div class="card-body--">
                        <div class="p-2 text-dark">
                            <h4 class="box-title">Orders details</h4>
                            <a href="orders.php"> <h4 class="box-title">Orders page <i class="fa fa-arrow-right"></i></h4></a>
                        </div>

                        <div class="table-stats order-table ov-h">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="wishlist-content">
                                    <div class="wishlist-table table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
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
                                               // $uid = $_SESSION['users_id'];

                                                $sql = "SELECT orderdetails.*,product.name,product.image,orders.address,orders.city,orders.pincode,orders.orderstatus
                                                FROM orderdetails,product,orders
                                                WHERE orderdetails.product_id = product.id AND  orderdetails.order_id = orders.id AND orderdetails.order_id = '$order_id' ";
                                                $query = mysqli_query($conn, $sql);
                                                $toral_price = 0;
                                                while ($assoc = mysqli_fetch_assoc($query)) {

                                                    $toral_price = $toral_price + ($assoc['qty'] * $assoc['price']);
                                                    $order_status = $assoc['orderstatus'];
                                                    $address = $assoc['address'] . '/' . $assoc['city'] . '/' . $assoc['pincode'];
                                                    ?>
                                                    <tr>
                                                        <td class="product-name"><?= $assoc['name'] ?></td>
                                                        <td class="product-name"> <img src="../assets/backend/upload/product/<?= $assoc['image'] ?>" width="100"alt=""/></td>
                                                        <td class="product-name"><?= $assoc['qty'] ?></td>
                                                        <td class="product-name"><?= $assoc['price'] ?> Tk</td>
                                                        <td class="product-name"><?= $assoc['qty'] * $assoc['price'] ?> Tk</td>

                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td>Total Price</td>
                                                    <td><?= $toral_price ?> Tk</td>
                                                </tr>
                                                <?php
                                                if ($coupon_name != '') {
                                                    ?>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td>Discount Name</td>
                                                        <td><?= $coupon_name ?></td>
                                                    </tr>
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
                                        <?php 
                                        if( $_SESSION['user_role']  !=1){
                                        ?>
                                        <div>
                                            <strong>Address:-</strong>
                                            <span><?= $address ?></span> 
                                            <br />
                                            <?php
                                            $order_status_table = mysqli_query($conn, "SELECT * FROM `order_status` WHERE id = $order_status");
                                            $orders_status_assoc = mysqli_fetch_assoc($order_status_table);
                                            $order_status = $orders_status_assoc['name'];
                                            ?>
                                            <strong>order status:-</strong>
                                            <span><?= $order_status ?></span>
                                        </div>
                                        <div>
                                            <br />
                                            <form action="" method="post">
                                                <div class="col-3 pl-0">
                                                    <span><strong>Order Status Update</strong></span> 
                                                    <select name="order_status" class="form-control">
                                                        <option>Select</option>
                                                        <?php
                                                        $status_query = mysqli_query($conn, "SELECT * FROM `order_status`");
                                                        while ($assoc_status = mysqli_fetch_assoc($status_query)) {
                                                            ?>
                                                            <option value="<?= $assoc_status['id'] ?>"><?= $assoc_status['name'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <input type="submit" value="Update" name="status_update" class="btn btn-warning mt-2" />
                                            </form>
                                        </div>
                                        <?php } ?>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once './footer.php'; ?>