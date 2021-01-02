<?php

require_once './connection.php';
require_once './function.php';
unset($_SESSION['COUPON_ID']);
unset($_SESSION['COUPON_name']);
unset($_SESSION['DISCOUNT_LESS']);
unset($_SESSION['DISCOUNT_PRICE']);

$coupon_name = get_safe_value($conn, $_POST['coupon_name']);

$coupon_query = mysqli_query($conn, "SELECT * FROM `coupon_master` WHERE `coupon_name`= '$coupon_name' and status = '1' ");
$row = mysqli_num_rows($coupon_query);
$coupon_array = array();
if ($row > 0) {
    $coupon_assoc = mysqli_fetch_assoc($coupon_query);
    $id = $coupon_assoc['id'];
    $coupon_amount = $coupon_assoc['coupon_amount'];
    $coupon_type = $coupon_assoc['coupon_type'];
    $cart_min_total_amount = $coupon_assoc['cart_min_total_amount'];
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $val) {
        $product = get_product($conn, '', '', $key);
        $price = $product[0]['price'];
        $qty = $val['qty'];
        $total = $total + ($price * $qty);
    }
    if ($cart_min_total_amount > $total) {
        $coupon_array = array('is_error' => 'yes', 'result' => 'Must be Total more' . ' ' . $cart_min_total_amount);
    } else {
        if ($coupon_type == 'parcent') {
            $discount_price = $total - (($total * $coupon_amount) / 100);
        }
        if ($coupon_type == 'amount') {
            $discount_price = $total - $coupon_amount;
        }
        $less_discount = $total - $discount_price;
        $_SESSION['COUPON_ID'] = $id;
        $_SESSION['COUPON_name'] = $coupon_name;
        $_SESSION['DISCOUNT_LESS'] = $less_discount;
        $_SESSION['DISCOUNT_PRICE'] = $discount_price;
        $coupon_array = array('is_error' => 'no', 'less_discount' => $less_discount, 'discount_price' => $discount_price);
    }
} else {
    $coupon_array = array('is_error' => 'yes', 'result' => 'coupon not abailavle');
}
echo json_encode($coupon_array);
?>