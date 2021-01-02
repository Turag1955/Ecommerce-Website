<?php
require_once 'header.php';

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    ?>
    <script type="text/javascript">
        window.location.href = 'index.php';
    </script>
    <?php
}
$total = 0;
foreach ($_SESSION['cart']as $key => $val) {
    $product = get_product($conn, '', '', $key);
    $price = $product[0]['price'];
    $qty = $val['qty'];
    $total = $total + ($price * $qty);
}
if (isset($_POST['submit'])) {
    $address = get_safe_value($conn, $_POST['address']);
    $city = get_safe_value($conn, $_POST['city']);
    $pincode = get_safe_value($conn, $_POST['pincode']);
    $payment_type = get_safe_value($conn, $_POST['payment_type']);
    $user_id = $_SESSION['users_id'];
    $total_price = $total;
    if ($payment_type == 'COD') {
        $payment_status = 'success';
    }
    if (isset($_SESSION['COUPON_ID'])) {
        $id = $_SESSION['COUPON_ID'];
        $coupon_name = $_SESSION['COUPON_name'];
        $less_discount = $_SESSION['DISCOUNT_LESS'];
        $discount_price = $_SESSION['DISCOUNT_PRICE'];
        $total_price = $less_discount-$total_price;
        unset($_SESSION['COUPON_ID']);
        unset($_SESSION['COUPON_name']);
        unset($_SESSION['DISCOUNT_LESS']);
        unset($_SESSION['DISCOUNT_PRICE']);
    } else {
        $id = '';
        $coupon_name = '';
        $less_discount = '';
        $discount_price = '';
    }

    $order_status = '1';
    $sql = "INSERT INTO `orders`( `users_id`, `address`, `city`, `pincode`, `pyment_type`, `total_price`, `pyment_status`, `orderstatus`,`coupon_id`,`coupon_name`,`discount_less`,`discount_price`)     
                     VALUES ('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$id','$coupon_name','$less_discount','$discount_price')";

    $query = mysqli_query($conn, $sql);
    $order_id = mysqli_insert_id($conn);

    foreach ($_SESSION['cart'] as $key => $val) {
        $product = get_product($conn, '', '', $key);
        $price = $product[0]['price'];
        $qty = $val['qty'];
        $order_qury = mysqli_query($conn, "INSERT INTO `orderdetails`(`order_id`, `product_id`, `qty`, `price`) VALUES ('$order_id','$key','$qty','$price')");
    }

    unset($_SESSION['cart']);
   //sentInvoice($conn,$order_id);
    ?>
    <script type="text/javascript">
        window.location.href = 'thanks.php';
    </script>
    <?php
}
?>
<div class="ht__bradcaump__area" style="">

    <div class="ht__bradcaump__wrap" style="background-image: url('maxresdefault.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item text-dark" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                        ?>
                        <div class="accordion">

                            <?php
                            $accordion = 'accordion__title';
                            if (!isset($_SESSION['users_email'])) {
                                $accordion = 'accordion__hide';
                                ?>
                                <div class="accordion__title">
                                    Checkout Method
                                </div>
                                <div class="accordion__body">
                                    <div class="accordion__body__form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form id="contact-form"  method="post">
                                                        <div class="single-contact-form">
                                                            <div class="contact-box name">
                                                                <input type="email" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
                                                            </div>
                                                            <span class="feild_error" id="login_email_error"></span>
                                                        </div>
                                                        <div class="single-contact-form">
                                                            <div class="contact-box name">
                                                                <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                                            </div>
                                                            <span class="feild_error" id="login_password_error"></span>
                                                        </div>

                                                        <div class="contact-btn">
                                                            <button type="button" onclick="login()" class="fv-btn">Login</button>
                                                        </div>
                                                    </form>
                                                    <div class="form-output login login">
                                                        <p class="form-messege"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form id="contact-form" method="post">
                                                        <div class="single-contact-form">
                                                            <div class="contact-box name">
                                                                <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                                            </div>
                                                            <span class="feild_error" id="name_error"></span>
                                                        </div>
                                                        <div class="single-contact-form">
                                                            <div class="contact-box name">
                                                                <input type="email" name="email" id="email" placeholder="Your Email*" style="width:100%">
                                                            </div>
                                                            <span class="feild_error" id="email_error"></span>
                                                        </div>
                                                        <div class="single-contact-form">
                                                            <div class="contact-box name">
                                                                <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
                                                            </div>
                                                            <span class="feild_error" id="mobile_error"></span>
                                                        </div>
                                                        <div class="single-contact-form">
                                                            <div class="contact-box name">
                                                                <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
                                                            </div>
                                                            <span class="feild_error" id="password_error"></span>
                                                        </div>
                                                        <div class="contact-btn">
                                                            <button type="button" onclick="register_submit()" class="fv-btn">Register</button>
                                                        </div>
                                                    </form>
                                                    <div class="form-output register">
                                                        <p class="form-messege"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="<?= $accordion ?>">
                                Address Information
                            </div>
                            <form method="post">   
                                <div class="accordion__body">
                                    <div class="bilinfo">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" placeholder="Apartment/Block/House" name="address" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" placeholder="City/State" name="city" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" placeholder="Post code/ zip" name="pincode"required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="<?= $accordion ?>">
                                    payment information
                                </div>
                                <div class="accordion__body">
                                    <div class="paymentinfo">
                                        <div class="single-method">
                                            COD    <input type="radio" name="payment_type" value="COD" required=""/>
                                            PayU    <input type="radio" name="payment_type" value="PayU" required=""/>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-warning" value="Submit" />
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $key => $val) {
                            $product = get_product($conn, '', '', $key);
                            $pname = $product[0]['name'];
                            $mrp = $product[0]['mrp'];
                            $price = $product[0]['price'];
                            $image = $product[0]['image'];
                            $qty = $val['qty'];
                            $total = $total + ($price * $qty);
                            ?>
                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="./assets/backend/upload/product/<?= $image ?>" alt="ordered item">
                                </div>
                                <div class="single-item__content">
                                    <a href="#"><?= $pname ?></a>
                                    <span class="price"><?= $price * $qty ?></span>
                                </div>
                                <div class="single-item__remove">
                                    <a href="javascript:void(0)" onclick="add_to_cat('<?= $key ?>', 'remove')"><i class="zmdi zmdi-delete"></i></a>
                                </div>
                            </div>

                        <?php } ?>
                    </div>

                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price"><?= $total ?> Tk</span>
                    </div>
                    <div class="coupon-table">
                        <div class="ordre-details__total">
                            <h5>Discount</h5>
                            <span class="price" id="discount_less"> Tk</span>
                        </div>
                        ---------------------------------------------------------------------------
                        <div class="ordre-details__total">
                            <h5>ToTal</h5>
                            <span class="price" id="discount_total"> Tk</span>
                        </div>
                    </div>
                    <div class="bilinfo coupon-p"  >
                        <div class="single-input" >
                            <input type="text" placeholder="Enter Coupon Code" name="coupon_name" id="coupon_name" required="" style="width:50%">
                            <button onclick="set_coupon()" type="submit" class="fv-btn coupon-btn">Submit</button>
                        </div>
                        <span class="feild_error" id="coupon_error"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['COUPON_ID'])) {
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_name']);
    unset($_SESSION['DISCOUNT_LESS']);
    unset($_SESSION['DISCOUNT_PRICE']);
}

require_once 'footer.php';
?>