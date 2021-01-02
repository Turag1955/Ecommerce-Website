<?php
require_once './header.php';
vendorexist();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($conn, $_GET['type']);

    if ($type == 'update') {
        $id = get_safe_value($conn, $_GET['id']);
        $operation = get_safe_value($conn, $_GET['operation']);
        if ($operation == 'best_selle') {
            $status = 1;
        } else {
            $status = 0;
        }
        echo $update_sql = "UPDATE `product` SET `best_seller`='$status' where id = '$id' ";
        $query = mysqli_query($conn, $update_sql);
    }
}



$sql = "SELECT DISTINCT orderdetails.product_id,product.name,product.image,product.best_seller
            FROM orderdetails,product
            WHERE orderdetails.product_id = product.id 
             ";
$query = mysqli_query($conn, $sql);
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
                            <h4 class="box-title">Contact </h4>

                        </div>

                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Buy(product)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $desc = [];
                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                        $totalProductIdBuy = totalProductIdBuy($conn, $assoc['product_id']);
                                        ?>
                                        <tr>
                                            <td><?= $assoc['name'] ?></td>
                                            <td><img src="../assets/backend/upload/product/<?= $assoc['image'] ?>" width="100" alt="" /></td>
                                            <td><?= $totalProductIdBuy ?> item</td>
                                            <td>
                                                <?php
                                                if ($assoc['best_seller'] == 1) {
                                                    ?>
                                                    <a href="?type=update&operation=no_best_seller&id=<?= $assoc['product_id'] ?>" class="btn btn-success"><i class="fa fa-check"></i></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="?type=update&operation=best_selle&id=<?= $assoc['product_id'] ?>" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                                        <?php
                                                    }
                                                    ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once './footer.php'; ?>