
<?php

require_once './connection.php';
require_once './function.php';
$order_id = $_GET['id'];
//echo "select orders.*,users.name from orders,users where orders.users_id = users.id and orders.id = $order_id";
$query = mysqli_query($conn, "select orders.*,users.usersname from orders,users where orders.users_id = users.id and orders.id = $order_id");
$assoc = mysqli_fetch_assoc($query);

$html = '<!DOCTYPE HTML>
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
echo $html;
?>

