<?php

function prx($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function pr($array) {
    echo '<pre>';
    print_r($array);
    die();
}

function get_safe_value($conn, $str) {
    if ($str != '') {
        $str = trim($str);
        return mysqli_real_escape_string($conn, $str);
    }
}

function get_product($conn, $limit = ' ', $cat_id = '', $poduct_id = '', $user_search = '', $order = '', $best_seller = '', $sub_cat = '') {
    $sql = "SELECT product.*,category.category FROM product,category WHERE product.status = 1 ";
    if ($cat_id != '') {
        $sql .= "  AND product.category_id = $cat_id ";
    }
    if ($sub_cat != '') {
        $sql .= "  AND product.sub_category = $sub_cat ";
    }
    if ($poduct_id != '') {
        $sql .= "  AND product.id = $poduct_id ";
    }
    if ($user_search != '') {
        $sql .= "  AND (product.name like '%$user_search%' or product.description like '%$user_search%') ";
    }
    if ($best_seller != '') {
        $sql .= "  AND product.best_seller = $best_seller ";
    }
    $sql .= " AND product.category_id = category.id  ";
    if ($order != '') {
        $sql .= "  $order ";
    }
    if ($limit != '') {
        $sql .= "  limit $limit ";
    }
    // echo $sql;
    $query = mysqli_query($conn, $sql);

    $product_arr = [];
    while ($assoc = mysqli_fetch_assoc($query)) {
        $product_arr[] = $assoc;
    }
    return $product_arr;
}

function get_category($conn) {
    $sql = "select * from category where status =1 order by category asc";
    $query = mysqli_query($conn, $sql);
    $array_category = [];
    while ($assoc = mysqli_fetch_assoc($query)) {
        $array_category [] = $assoc;
    }
    return$array_category;
}

function wishlist($conn, $user_id, $pid, $added_on) {
    mysqli_query($conn, "insert into wishlist (user_id,product_id,added_on) values('$user_id','$pid','$added_on')");
}

function totalProductIdBuy($conn, $pid) {
    $sql = "SELECT SUM(orderdetails.qty) as qty FROM orderdetails,orders
                WHERE
                orderdetails.order_id = orders.id AND orders.orderstatus !=4 AND orderdetails.product_id ='$pid' ";
    $query = mysqli_query($conn, $sql);
    $assoc = mysqli_fetch_assoc($query);
    $qty = $assoc['qty'];
    return $qty;
}

function totalProductIdQty($conn, $pid) {
    $sql = "select qty from product where id = '$pid' ";
    $query = mysqli_query($conn, $sql);
    $assoc = mysqli_fetch_assoc($query);
    $qty = $assoc['qty'];
    return $qty;
}

function sentInvoice($conn, $order_id) {
    $query = mysqli_query($conn, "select orders.*,users.usersname,users.email from orders,users where orders.users_id = users.id and orders.id = $order_id");
    $assoc = mysqli_fetch_assoc($query);

    $html='<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            body{
                font-family: "Roboto";
                font-size : 15px;
            }
            .amount-due{
                background: #e3e2e4;
                padding: 15px;
            }
            .order-details {
                background: #f4f4f4;
                width: 500px;
                margin: 0px 350px;
                margin-top: 20px;
            }

            .order-details .order-details__title {
                padding: 30px 0;
                margin: 0 15px;
                border-bottom: 1px solid #ebebeb;
                text-transform: uppercase;
                text-align: center;
                letter-spacing: 1px;
                font-family: "poppins";
                font-size: 16px;
                font-weight: 600;
                color: #3f3f3f;
            }
            .order-details .order-details__item {
                padding: 15px 0;
                margin: 0 30px;
                border-bottom: 1px solid #ebebeb;
            }
            .order-details .ordre-details__total {
                margin: 0 30px;
                padding: 30px 0;
                display: -moz-flex;
                display: -ms-flex;
                display: -o-flex;
                display: flex;
                -ms-align-items: center;
                align-items: center;
                justify-content: space-between;
            }
        </style>
    </head>
    <body>
        <div class="order-details">
            <h5 class="order-details__title">Invoice</h5>
            <div class="order-details__item">
                <table  width="100%" cellpadding="5" cellspacing="8" role="presentation">
                    <h3>Hi ' . $assoc['usersname'] . ' </h3>
                    <p>Thanks for using our website.This is invoice for your recent purchase</p>
                    <h4 class="amount-due">Amount Due : ' . $assoc['total_price'] . ' Tk</h4>
                    <tr>
                        <td><strong>ID - ' . $assoc['id'] . '</strong> </td>
                        <td><strong>Date :' . $assoc['insertdate'] . '</strong></td>
                    </tr>

                    <tr>
                        <td>Total Price</td>
                        <td>' . $assoc['total_price'] . ' </td>
                    </tr>';

    if ($assoc['coupon_name'] != '') {
        $html .= '<tr>
                                        <td>Discount</td>
                                        <td>' . $assoc['discount_less'] . ' </td>
                                    </tr>
                                   ';
    }



    $html .= '</table><br />
<p>If you have any question about this invoice.simply to this email or reach out to our <a href = "">support teame</a> for help</p>

</div>
</div>
</body>
</html>';
    $user_email = $assoc['email'];
    $subject = 'Your parchase invoice';
    $header =  'From: fatimaakter44532@gmail.com' . "\r\n" .
                    'Reply-To: fatimaakter44532@gmail.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion() . "\r\n" .
                    'Content-type: text/html; charset=iso-8859-1';


    mail($user_email, $subject,$html, $header);
}

?>