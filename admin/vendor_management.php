<?php
require_once './header.php';
vendorexist();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($conn, $_GET['type']);
    if ($type == 'status') {
        $operation = get_safe_value($conn, $_GET['operation']);
        $id = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }
        $update_statuus = " UPDATE `admin_users` SET `status`= '  $status' WHERE `id` = '$id' ";
        $query = mysqli_query($conn, $update_statuus);
    }
    if ($type == 'delete') {
        $id = get_safe_value($conn, $_GET['id']);
        $delete_sql = "DELETE FROM `admin_users` WHERE `id` = '$id' ";
        $query = mysqli_query($conn, $delete_sql);
    }
}



$sql = "SELECT * FROM `admin_users` where role =  1 order by id asc ";
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
                            <h4 class="box-title">vendor Management </h4>
                            <h4 class="box-title"><a href="add_vendor_management.php">Add vendor Management  <i class="fa fa-arrow-circle-right"></i></a></h4>
                        </div>

                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($assoc = mysqli_fetch_assoc($query)) {
                                        ?>
                                        <tr>
                                            <td><?= $assoc['usersname'] ?></td>
                                            <td><?= $assoc['email'] ?></td>
                                            <td><?= $assoc['password'] ?></td>
                                            <td><?= $assoc['mobile'] ?></td>
                                            <td>
                                                <?php
                                                if ($assoc['status'] == 1) {
                                                    ?>
                                                    <a href="?type=status&operation=deactive&id=<?= $assoc['id'] ?>" class="btn btn-success"> Active</a>&nbsp;
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="?type=status&operation=active&id=<?= $assoc['id'] ?>" class="btn btn-danger"> Deactive</a>

                                                    <?php
                                                }
                                                ?>
                                                <a href="?type=delete&id=<?= $assoc['id'] ?>" class="btn btn-warning">Delete</a>
                                                <?php
                                                ?>
                                                <a href="update_vendor_management.php?id=<?= base64_encode($assoc['id']) ?>" class="btn btn-primary">Update</a>
                                                <?php
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