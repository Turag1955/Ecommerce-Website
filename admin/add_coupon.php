<?php
require_once './header.php';
vendorexist();
if (isset($_POST['submit_coupon'])) {
    $coupon_name = get_safe_value($conn, $_POST['coupon_name']);
    $coupon_amount = get_safe_value($conn, $_POST['coupon_amount']);
    $coupon_type = get_safe_value($conn, $_POST['coupon_type']);
    $cat_min_amount = get_safe_value($conn, $_POST['cat_min_amount']);
 
    
   $check_insert = mysqli_query($conn, "SELECT * FROM `coupon_master` WHERE `coupon_name` = '$coupon_name' ");
    $row = mysqli_num_rows($check_insert);
    if ($row > 0) {
        $msg = 'this coupon name allready exits';
    } else {
        $insert_sql = "INSERT INTO `coupon_master`(`coupon_name`,`coupon_amount`,`coupon_type`,`cart_min_total_amount`,`status`) VALUES ('$coupon_name','$coupon_amount','$coupon_type','$cat_min_amount','1') ";
        $query = mysqli_query($conn, $insert_sql);
        if ($query) {
                   ?>
                    <script type="text/javascript">
                        window.location.href = 'coupon.php';
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
                    <div class="card-header"><strong>Add Coupon</strong><small> Form</small></div>
                    <a  class=""href="coupon.php"> <div class="card-header"><strong>Coupon <i class="fa fa-arrow-circle-right"></i></strong> </div></a>
                    <div class="card-body card-block">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="coupon_name" class=" form-control-label">coupon name</label>
                                <input type="text" id="coupon_name" placeholder="coupon name " class="form-control" name="coupon_name">
                            </div>
                            <div class="form-group">
                                <label for="coupon_amount" class=" form-control-label">coupon amount</label>
                                <input type="text" id="coupon_amount" placeholder="coupon amount " class="form-control" name="coupon_amount">
                            </div>
                            <div class="form-group">
                                <label for="coupon_type" class=" form-control-label">coupon type</label>
                                <select name="coupon_type" id="coupon_type" class="form-control">
                                    <option value="">Select coupon type</option>
                                    <option value="parcent">parcent</option>
                                    <option value="amount">amount</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cat_min_amount" class=" form-control-label">cat min amount</label>
                                <input type="text" id="cat_min_amount" placeholder="cat min amount" class="form-control" name="cat_min_amount">
                            </div>
                            <button  type="submit" class="btn btn-lg btn-info btn-block" name="submit_coupon">
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