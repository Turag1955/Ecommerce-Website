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

function totalProductIdBuy($conn, $pid) {
    $sql = "SELECT SUM(orderdetails.qty) as qty 
                    FROM orderdetails,orders 
                    WHERE orderdetails.order_id = orders.id AND orders.orderstatus !=4 AND orderdetails.product_id ='$pid' 
                    ORDER by orderdetails.qty DESC ";
    //echo $sql;
    // die();
    $query = mysqli_query($conn, $sql);
    $assoc = mysqli_fetch_assoc($query);
    $qty = $assoc['qty'];
    return $qty;
}

function vendorexist() {
    if ($_SESSION['user_role'] == 1) {
        ?>
        <script type="text/javascript">
            window.location.href = 'product.php';
        </script>
        <?php

    }
}
