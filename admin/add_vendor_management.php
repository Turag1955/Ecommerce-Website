<?php
require_once './header.php';
vendorexist();
if (isset($_POST['submit_vendor'])) {
    $usersname = get_safe_value($conn, $_POST['usersname']);
    $email = get_safe_value($conn, $_POST['email']);
    $password= get_safe_value($conn, $_POST['password']);
    $mobile = get_safe_value($conn, $_POST['mobile']);


    $check_insert = mysqli_query($conn, "SELECT * FROM `admin_users` WHERE `usersname` = '$usersname' ");
    $row = mysqli_num_rows($check_insert);
    if ($row > 0) {
        $msg = 'this  usersname allready exits';
    } else {
        $insert_sql = "INSERT INTO `admin_users`(`usersname`,`email`,`password`,`mobile`,`role`,`status`) VALUES ('$usersname','$email','$password','$mobile','1','1') ";
        $query = mysqli_query($conn, $insert_sql);
        if ($query) {
            ?>
            <script type="text/javascript">
                window.location.href = 'vendor_management.php';
            </script>
            <?php
        }
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
                                <input type="text" id="usersname" placeholder="usersname  " class="form-control" name="usersname">
                            </div>
                            <div class="form-group">
                                <label for="email" class=" form-control-label">email </label>
                                <input type="email" id="email" placeholder="email  " class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label for="password" class=" form-control-label">password  </label>
                                <input type="password" id="password" placeholder="  password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="mobile" class=" form-control-label">mobile  </label>
                                <input type="text" id="mobile" placeholder="  mobile" class="form-control" name="mobile">
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