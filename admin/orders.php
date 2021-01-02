<?php require_once './header.php'; ?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                    </div>
                    <div class="card-body--">
                        <div class="p-2 text-dark">
                            <h4 class="box-title">Orders </h4>

                        </div>

                        <div class="table-stats order-table ov-h">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="wishlist-content">
                                    <form action="#">
                                        <div class="wishlist-table table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <?php
                                                    if ($_SESSION['user_role'] == 1) {
                                                        ?>
                                                        <tr>
                                                            <th class="product-name"><span class="nobr">Order id </span></th>
                                                            <th class="product-price"><span class="nobr"> Date </span></th>
                                                            <th class="product-stock-stauts"><span class="nobr"> Payment type </span></th>
                                                            <th class="product-stock-stauts"><span class="nobr"> Payment status </span></th>
                                                            <th class="product-stock-stauts"><span class="nobr"> order status </span></th>
                                                            <th class="product-add-to-cart"><span class="nobr">Order Details  </span></th>

                                                        </tr>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <th class="product-name"><span class="nobr">Order id </span></th>
                                                            <th class="product-add-to-cart"><span class="nobr">address</span></th>
                                                            <th class="product-price"><span class="nobr"> Date </span></th>
                                                            <th class="product-stock-stauts"><span class="nobr"> Payment type </span></th>
                                                            <th class="product-stock-stauts"><span class="nobr"> Payment status </span></th>
                                                            <th class="product-stock-stauts"><span class="nobr"> order status </span></th>
                                                            <th class="product-add-to-cart"><span class="nobr">vendor product   </span></th>
                                                            <th class="product-add-to-cart"><span class="nobr">Order Details  </span></th>

                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($_SESSION['user_role'] == 1) {
                                                        
                                                        $query = mysqli_query($conn, " select DISTINCT orders.id, orders.pyment_type,orders.total_price,orders.pyment_status,orders.orderstatus,orders.insertdate,order_status.name "
                                                                . "from product,orders,orderdetails,order_status "
                                                                . "where product.id = orderdetails.product_id and orders.id = orderdetails.order_id "
                                                                . "and orders.orderstatus = order_status.id "
                                                                . "and product.added_id = ' " . $_SESSION['user_id'] . " '
                                                                                                         ");
                                                    } else {
                                                        $query = mysqli_query($conn, "select DISTINCT orders.id, orders.pyment_type,orders.total_price,orders.pyment_status,
                                                                                                        orders.orderstatus,orders.insertdate,orders.address,orders.city,orders.pincode,order_status.name,
                                                                                                        product.added_id 
                                                                                                        from product,orders,orderdetails,order_status 
                                                                                                        where product.id = orderdetails.product_id and orders.id = orderdetails.order_id
                                                                                                        and orders.orderstatus = order_status.id 
                                                                                                         ");
                                                    }

                                                    if ($_SESSION['user_role'] == 1) {
                                                        while ($assoc = mysqli_fetch_assoc($query)) {
                                                            ?>
                                                            <tr>
                                                                <td class="product-name"><?= $assoc['id'] ?></td>
                                                                <td class="product-name"><?= date('d-M-Y - h:i:m', strtotime($assoc['insertdate'])) ?></td>
                                                                <td class="product-name"><?= $assoc['pyment_type'] ?></td>
                                                                <td class="product-name"><?= $assoc['pyment_status'] ?></td>
                                                                <td class="product-name"><?= $assoc['name'] ?></td>
                                                                <td class=" mt-5 btn btn-warning"><a href="order_details.php?id=<?= $assoc['id'] ?>"> Show Details</a></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        while ($assoc = mysqli_fetch_assoc($query)) {
                                                            //prx($assoc);
                                                            ?>
                                                            <tr>
                                                                <td class="product-name"><?= $assoc['id'] ?></td>
                                                                <td class="product-name">
                                                                    <?= $assoc['address'] ?><br>
                                                                    <?= $assoc['city'] ?><br>
                                                                    <?= $assoc['pincode'] ?>
                                                                </td>
                                                                <td class="product-name"><?= date('d-M-Y - h:i:m', strtotime($assoc['insertdate'])) ?></td>
                                                                <td class="product-name"><?= $assoc['pyment_type'] ?></td>
                                                                <td class="product-name"><?= $assoc['pyment_status'] ?></td>
                                                                <td class="product-name"><?= $assoc['name'] ?></td>
                                                                <td class="product-name">
                                                                    <?php
                                                                    if ($assoc['added_id'] != 0) {
                                                                        ?>
                                                                        <button class="btn btn-success"><i class="fa fa-check"></i></button>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <button class="btn btn-secondary">No</button>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td class=" mt-5 btn btn-warning"><a href="order_details.php?id=<?= $assoc['id'] ?>"> Show Details</a></td>
                                                            </tr>
        <?php
    }
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
            </div>
        </div>
    </div>
</div>
<?php require_once './footer.php'; ?>