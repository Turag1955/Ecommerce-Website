<?php
require_once './header.php';
vendorexist();
if (isset($_GET['id']) && $_GET['id'] != '') {
    $coupon_id = get_safe_value($conn, base64_decode($_GET['id']));
    $check_query = mysqli_query($conn, "select * from coupon_master where status = 1 and id = '$coupon_id' ");
    $check = mysqli_num_rows($check_query);
    if ($check > 0) {
        $assoc = mysqli_fetch_assoc($check_query);
    } else {
        header("location:coupon.php");
    }
}


if (isset($_POST['submit_coupon'])) {
    $coupon_name = get_safe_value($conn, $_POST['coupon_name']);
    $coupon_amount = get_safe_value($conn, $_POST['coupon_amount']);
    $coupon_type = get_safe_value($conn, $_POST['coupon_type']);
    $cat_min_amount = get_safe_value($conn, $_POST['cat_min_amount']);
    $insert_sql = "UPDATE `coupon_master`
                                                SET 
                                                `coupon_name`='$coupon_name',
                                                `coupon_amount`= '$coupon_amount',
                                                `coupon_type`= '$coupon_type',
                                                `cart_min_total_amount`= '$cat_min_amount'
                                                WHERE 
                                                id = '$coupon_id'
                                                ";
    $update_query = mysqli_query($conn, $insert_sql);
    if ($update_query) {
        ?>
        <script type="text/javascript">
            window.location.href = 'coupon.php';
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
                    <div class="card-header"><strong>Add Coupon</strong><small> Form</small></div>
                    <a  class=""href="coupon.php"> <div class="card-header"><strong>Coupon <i class="fa fa-arrow-circle-right"></i></strong> </div></a>
                    <div class="card-body card-block">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="coupon_name" class=" form-control-label">coupon name</label>
                                <input type="text" id="coupon_name" placeholder="coupon name " class="form-control" name="coupon_name" value="<?= (isset($assoc['coupon_name']) ? $assoc['coupon_name'] : '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="coupon_amount" class=" form-control-label">coupon amount</label>
                                <input type="text" id="coupon_amount" placeholder="coupon amount " class="form-control" name="coupon_amount" value="<?= (isset($assoc['coupon_amount']) ? $assoc['coupon_amount'] : '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="coupon_type" class=" form-control-label">coupon type</label>
                                <select name="coupon_type" id="coupon_type" class="form-control">
                                    <option value="">Select coupon type</option>
                                    <?php
                                    $query = mysqli_query($conn, "select * from coupon_master where status = 1");
                                    while ($coupon_select = mysqli_fetch_assoc($query)) {
                                        if ($coupon_select['id'] == $coupon_id) {
                                            ?>
                                            <option selected="" value="<?= $coupon_select['coupon_type'] ?>"><?= $coupon_select['coupon_type'] ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option selected="" value="<?= $coupon_select['coupon_type'] ?>"><?= $coupon_select['coupon_type'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cat_min_amount" class=" form-control-label">cat min amount</label>
                                <input type="text" id="cat_min_amount" placeholder="cat min amount" class="form-control" name="cat_min_amount" value="<?= (isset($assoc['cart_min_total_amount']) ? $assoc['cart_min_total_amount'] : '') ?>">
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