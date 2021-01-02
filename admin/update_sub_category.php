<?php
require_once './header.php';
vendorexist();
if (isset($_GET)) {
    $category_option = [];
    $id = get_safe_value($conn, base64_decode($_GET['id']));
    $sql = mysqli_query($conn, " SELECT * FROM `sub_category` WHERE  `id` = '$id' ");
    $check = mysqli_num_rows($sql);
    if ($check > 0) {
        $assoc_sub = mysqli_fetch_assoc($sql);
        $category_id = $assoc_sub['category_id'];
        $sub_category = $assoc_sub['sub_category'];
        $sub_category_id = $assoc_sub['id'];
    }
}




if (isset($_POST['submit_category'])) {
    $id = get_safe_value($conn,$_POST['sub_category_id']);
    $category_id = get_safe_value($conn, $_POST['category']);
    $sub_category = get_safe_value($conn, $_POST['sub_category']);
    $check_update = mysqli_query($conn, " SELECT * FROM `sub_category` WHERE `sub_category` = '$sub_category' ");
    $row = mysqli_num_rows($check_update);
    if ($row > 0) {
        $msg = 'this allready exits';
    } else {
        $insert_sql = "UPDATE `sub_category` SET `category_id`= '$category_id',`sub_category`= '$sub_category' WHERE `id` = '$id'";
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
                    <div class="card-header"><strong>Category update</strong><small> Form</small></div>
                    <a  class=""href="category.php"> <div class="card-header"><strong>Category  <i class="fa fa-arrow-circle-right"></i></strong> </div></a>
                    <div class="card-body card-block">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="category" class=" form-control-label">Category</label>
                                <select name="category" id="" class="form-control" required="">
                                    <option value="">select category</option>
                                    <?php
                                    $query = mysqli_query($conn, "select * from category where status = '1' ");
                                    $row = mysqli_num_rows($query);
                                    if ($row > 0) {
                                        while ($assoc = mysqli_fetch_assoc($query)) {
                                            // prx($assoc);
                                            if ($assoc['id'] == $category_id) {
                                                ?>
                                                <option selected="" value="<?= $assoc['id'] ?>"><?= $assoc['category'] ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?= $assoc['id'] ?>"><?= $assoc['category'] ?></option>
                                                <?php
                                            }
                                        }
                                    } else {
                                        header("location:sub_category.php");
                                        die();
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden"   name="sub_category_id" value="<?= ($sub_category_id) ? $sub_category_id : '' ?>" required="">
                            <div class="form-group">
                                <label for="category" class=" form-control-label">Sub Category</label>
                                <input type="text" id="sub_category" placeholder="Sub category " class="form-control" name="sub_category" value="<?= ($sub_category) ? $sub_category : '' ?>" required="">
                            </div>
                            <button  type="submit" class="btn btn-lg btn-info btn-block" name="submit_category">
                                <span>Update</span>
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