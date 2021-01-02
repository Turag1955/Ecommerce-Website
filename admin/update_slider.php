<?php
require_once './header.php';
vendorexist();
if (isset($_GET)) {
    $id = get_safe_value($conn, base64_decode($_GET['id']));
    $sql = mysqli_query($conn, " SELECT * FROM `slide` WHERE `id` = '$id' ");
    $check = mysqli_num_rows($sql);
    if ($check > 0) {
        $assoc = mysqli_fetch_assoc($sql);
    } else {
        header("location:slider.php");
        die();
    }
}




$errors = [];
if (isset($_POST['submit_slider'])) {
    $name = get_safe_value($conn, $_POST['name']);

    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp = $image['tmp_name'];
    $image_size = $image['size'];

    if ($image_name != '') {
        $explode = explode('.', $image_name);
        $extention = strtolower(end($explode));
        $formate = ['jpg', 'jpeg', 'png'];

        if (!in_array($extention, $formate)) {
            $errors [] = 'please upload image with jpeg/jpg/png';
        }
        if ($image_size > 1024 * 1024 * 3) {
            $errors [] = 'please upload 3Mb size image';
        }
        if (!$errors) {
            $newimagename = $name . '-' . date('d-m-y') . '.' . $extention;
        }
    } else {
        $newimagename = $imagof;
    }
    if (!$errors) {
        $newimagename = $name . '-' . date('d-m-y') . '.' . $extention;
        $check_insert = mysqli_query($conn, " SELECT * FROM `slide` WHERE `image` = '$newimagename' ");
        $row = mysqli_num_rows($check_insert);
        if ($row > 0) {
            $msg = 'this image allready exits';
        } else {
            $insert_sql = "UPDATE `slide` SET `image_product_name`= '$name',`image`= '$newimagename' WHERE `id` = '$id'";
            $query = mysqli_query($conn, $insert_sql);
            if ($query) {
                move_uploaded_file($image_tmp, "../assets/upload/slider/" . $newimagename);
                header("location:slider.php");
            }
        }
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong> Slider image Add</strong><small> </small></div>
                    <a  class=""href="slider.php"> <div class="card-header"><strong>Slider <i class="fa fa-arrow-circle-right"></i></strong> </div></a>
                    <div class="card-body card-block">
                        <?php
                        if (isset($errors)) {
                            foreach ($errors as $error) {
                                ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                                <?php
                            }
                        }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Image Product Name</label>
                                <input type="text" id="name" placeholder="Product Name " class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="image" class=" form-control-label">Image Product Name</label>
                                <input type="file" id="image"  class="form-control" name="image">
                            </div>
                            <button  type="submit" class="btn btn-lg btn-info btn-block" name="submit_slider">
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