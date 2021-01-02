<?php
require_once './header.php';
vendorexist();
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($conn, base64_decode($_GET['id']));
    $check_query = mysqli_query($conn, "select * from admin_users where status = 1 and id = '$id' and role = 1 ");
    $check = mysqli_num_rows($check_query);
    if ($check > 0) {
        $assoc = mysqli_fetch_assoc($check_query);
    } else {
        header("location:vendor_management.php");
    }
}


if (isset($_POST['submit_vendor'])) {
    $usersname = get_safe_value($conn, $_POST['usersname']);
    $email = get_safe_value($conn, $_POST['email']);
    $password = get_safe_value($conn, $_POST['password']);
    $mobile = get_safe_value($conn, $_POST['mobile']);
    $insert_sql = "UPDATE `admin_users`
                                                SET 
                                                `usersname`='$usersname',
                                                `email`= '$email',
                                                `password`= '$password',
                                                `mobile`= '$mobile'
                                                WHERE 
                                                id = '$id'
                                                ";
    $update_query = mysqli_query($conn, $insert_sql);
    if ($update_query) {
        ?>
        <script type="text/javascript">
            window.location.href = 'vendor_management.php';
        </script>
        <?php
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Add vendor Management</strong><small> Form</small></div>
                    <a  class=""href="vendor_management.php"> <div class="card-header"><strong>vendor management <i class="fa fa-arrow-circle-right"></i></strong> </div></a>
                    <div class="card-body card-block">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="usersname" class=" form-control-label"> usersname</label>
                                <input type="text" id="usersname" placeholder="usersname  " class="form-control" name="usersname" value="<?= (isset($assoc['usersname'])) ? $assoc['usersname'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class=" form-control-label">email </label>
                                <input type="email" id="email" placeholder="email  " class="form-control" name="email" value="<?= (isset($assoc['email'])) ? $assoc['email'] : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="password" class=" form-control-label">password  </label>
                                <input type="password" id="password" placeholder="  password" class="form-control" name="password" value="<?=(isset($assoc['password']))?$assoc['password']:''?>">
                            </div>
                            <div class="form-group">
                                <label for="mobile" class=" form-control-label">mobile  </label>
                                <input type="text" id="mobile" placeholder="  mobile" class="form-control" name="mobile" value="<?=(isset($assoc['mobile']))?$assoc['mobile']:''?>">
                            </div>
                            <button  type="submit" class="btn btn-lg btn-info btn-block" name="submit_vendor">
                                <span>Submit</span>
                            </button>
                        </form>
                        <?= (isset($msg) ? $msg : '') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>