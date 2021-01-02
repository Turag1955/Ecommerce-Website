<?php
require_once './header.php';
vendorexist();
if (isset($_GET)) {
    $id = get_safe_value($conn, base64_decode($_GET['id']));
    $sql = mysqli_query($conn, " SELECT * FROM `category` WHERE `id` = '$id' ");
    $check = mysqli_num_rows($sql);
    if ($check > 0) {
        $assoc = mysqli_fetch_assoc($sql);
        $category = $assoc['category'];
    } else {
        header("location:category.php");
        die();
    }
}




if (isset($_POST['submit_category'])) {
    $id = get_safe_value($conn, base64_decode($_GET['id']));
    $category = get_safe_value($conn, $_POST['add_category']);
    $check_update = mysqli_query($conn, " SELECT * FROM `category` WHERE `category` = '$category' ");
    $row = mysqli_num_rows($check_update);
    if ($row > 0) {
        $msg = 'this allready exits';
    } else {
        $insert_sql = "UPDATE `category` SET `category`= '$category' WHERE `id` = '$id'";
        $query = mysqli_query($conn, $insert_sql);
        if ($query) {
            header("location:category.php");
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
                                <input required="" type="text" id="category" placeholder="category " class="form-control" name="add_category" value="<?= (isset($category) ? $category : '') ?>">
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