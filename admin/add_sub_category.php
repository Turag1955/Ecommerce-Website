<?php
require_once './header.php';
vendorexist();
if (isset($_POST['submit_category'])) {
    
    $category_id = get_safe_value($conn, $_POST['category']);
    $sub_category = get_safe_value($conn, $_POST['sub_category']);
    $check_insert = mysqli_query($conn, " SELECT * FROM `sub_category` WHERE `sub_category` = '$sub_category' ");
    $row = mysqli_num_rows($check_insert);
    if ($row > 0) {
        $msg = 'this sub category allready exits';
    } else {
        $insert_sql = "INSERT INTO `sub_category`( `category_id`, `sub_category`,`status`) VALUES ('$category_id','$sub_category','1') ";
        $query = mysqli_query($conn, $insert_sql);
        if ($query) {
            header("location:sub_category.php");
        }
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Add Sub Category</strong><small> Form</small></div>
                    <a  class=""href="sub_category.php"> <div class="card-header"><strong>Sub Category <i class="fa fa-arrow-circle-right"></i></strong> </div></a>
                    <div class="card-body card-block">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="category" class=" form-control-label">Country</label>
                                <select name="category" id="category" class="form-control" required="">
                                    <option value="">Select Category</option>
                                    <?php
                                    $res = mysqli_query($conn, "select * from category where status = 1 ");
                                    $row = mysqli_num_rows($res);
                                    if ($row > 0) {
                                        while ($assoc = mysqli_fetch_assoc($res)) {
                                            ?>
                                            <option value="<?= $assoc['id'] ?>"><?= $assoc['category'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category" class=" form-control-label">Sub Category</label>
                                <input type="text" id="sub_category" placeholder="Sub category " class="form-control" name="sub_category" required="">
                            </div>
                            <button  type="submit" class="btn btn-lg btn-info btn-block" name="submit_category">
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