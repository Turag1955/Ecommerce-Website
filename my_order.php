<?php require_once './header.php'; ?>

<div class="ht__bradcaump__wrap "style="background-image: url('maxresdefault.jpg');">
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


                                        <th class="product-name"><span class="nobr">Order id </span></th>
                                        <th class="product-price"><span class="nobr"> Address </span></th>
                                        <th class="product-price"><span class="nobr"> Date </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment type </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment status </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> order status </span></th>
                                        <th class="product-add-to-cart"><span class="nobr">Add To Cart</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $uid = $_SESSION['users_id'];
                                    $query = mysqli_query($conn, "SELECT orders.*,order_status.name
                                                                                    FROM orders,order_status
                                                                                    WHERE orders.orderstatus = order_status.id
                                                                                    AND orders.users_id = '$uid' ");
                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                        ?>
                                        <tr>
                                            <td class="product-name"><?= $assoc['id'] ?></td>
                                            <td class="product-name">
                                                <?= $assoc['address'] ?><br />
                                                <?= $assoc['city'] ?><br />
                                                <?= $assoc['pincode'] ?>
                                            </td>
                                           <td class="product-name"><?= $assoc['insertdate'] ?></td>
                                          <td class="product-name"><?= $assoc['pyment_type'] ?></td>
                                            <td class="product-name"><?= $assoc['pyment_status'] ?></td>
                                            <td class="product-name"><?= $assoc['name'] ?></td>
                                            <td class="product-add-to-cart"><a href="order_details.php?id=<?=$assoc['id']?>"> Show Details</a></td>
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