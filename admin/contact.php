<?php
require_once './header.php';
vendorexist();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($conn, $_GET['type']);

    if ($type == 'delete') {
        $id = get_safe_value($conn, $_GET['id']);
        $delete_sql = "DELETE FROM `contact` WHERE `id` = '$id' ";
        $query = mysqli_query($conn, $delete_sql);
    }
}



$sql = "SELECT * FROM `contact`  ";
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                        ?>
                                        <tr>
                                            <td><?= $assoc['id'] ?></td>
                                            <td><?= $assoc['name'] ?></td>
                                            <td><?= $assoc['email'] ?></td>
                                            <td><?= $assoc['mobile'] ?></td>
                                            <td><?= $assoc['comment'] ?></td>
                                            <td><?= $assoc['insertdate'] ?></td>
                                            <td>
                                                <a href="?type=delete&id=<?= $assoc['id'] ?>" class="btn btn-warning">Delete</a>
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