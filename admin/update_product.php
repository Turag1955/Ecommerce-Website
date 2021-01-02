<?php
require_once './header.php';
$added_id = '';
$added_id1 = '';
if ($_SESSION['user_role'] == 1) {
    $added_id = "and product.added_id = ' " . $_SESSION['user_id'] . " ' ";
    $added_id1 = " and added_id = '" . $_SESSION['user_id'] . "' ";
}
if (isset($_GET['id'])) {
    $id = get_safe_value($conn, base64_decode($_GET['id']));
    $sql = mysqli_query($conn, " SELECT * FROM `product` WHERE `id` = '$id' $added_id1 ");
    $check = mysqli_num_rows($sql);
    if ($check > 0) {
        $assoc = mysqli_fetch_assoc($sql);
        $sub_category = $assoc['sub_category'];
    } else {
        header("location:category.php");
        die();
    }
}
if (isset($_POST['submit_product'])) {
    $errors = [];
    $category_id = get_safe_value($conn, $_POST['category']);
    $name = get_safe_value($conn, $_POST['name']);
    $mrp = get_safe_value($conn, $_POST['mrp']);
    $price = get_safe_value($conn, $_POST['price']);
    $qty = get_safe_value($conn, $_POST['qty']);
    $short_dec = get_safe_value($conn, $_POST['short_dec']);
    $description = get_safe_value($conn, $_POST['description']);
    $meta_title = get_safe_value($conn, $_POST['meta_title']);
    $meta_description = get_safe_value($conn, $_POST['meta_description']);
    $meta_keyword = get_safe_value($conn, $_POST['meta_keyword']);
    $imagof = $assoc['image'];

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

        $sql = "UPDATE `product` SET 
                                                  
                                                    `category_id`='$category_id',
                                                     `name`='$name',
                                                    `mrp`='$mrp',
                                                    `price`='$price',
                                                    `qty`='$qty',
                                                    `image`='$newimagename',
                                                    `short_dec`='$short_dec',
                                                    `description`='$description',
                                                    `meta_title`='$meta_title',
                                                    `meta_description`='$meta_description',
                                                    `meta_keyword`='$meta_keyword'
                                                      WHERE id = '$id' $added_id1 ";

        $query = mysqli_query($conn, $sql);
        if ($query) {
            move_uploaded_file($image_tmp, "../assets/upload/product/" . $newimagename);
            //header("location:product.php");
            ?>
            <script type="text/javascript">
             window.location.href = 'product.php';
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
                    <div class="card-header"><strong>Update product</strong></div>
                    <a  class=""href="product.php.php"> <div class="card-header"><strong>product <i class="fa fa-arrow-circle-right"></i></strong> </div></a>
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
                                <label for="category" class=" form-control-label">category</label>
                                <select class="form-control" name="category" id="sub_category" required="" onchange="get_sub_category(' ')">
                                    <option value="">category</option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM `category`");
                                    while ($category_assoc = mysqli_fetch_assoc($sql)) {
                                        if ($category_assoc['id'] == $assoc['category_id']) {
                                            ?>
                                            <option selected="" value="<?= $category_assoc['id'] ?>"><?= $category_assoc['category'] ?></option>

                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?= $category_assoc['id'] ?>"><?= $category_assoc['category'] ?></option>

                                            <?php
                                        }
                                        ?>

                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_category" class="form-control-label">sub category</label>
                                <select name="sub_category" id="sub_get_category" class="form-control">
                                    <option value="">Select sub category</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="" value="<?= (isset($assoc['name'])) ? $assoc['name'] : '' ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="mrp" class="form-control-label">Mrp</label>
                                <input type="text" class="form-control" id="mrp" placeholder="Mrp" name="mrp" required="" value="<?= (isset($assoc['mrp'])) ? $assoc['mrp'] : '' ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="price" class="form-control-label">price</label>
                                <input type="text" class="form-control" id="price" placeholder="price" name="price"  required="" value="<?= (isset($assoc['price'])) ? $assoc['price'] : '' ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="qty" class="form-control-label">qty</label>
                                <input type="text" class="form-control" id="qty" placeholder="qty" name="qty" required="" value="<?= (isset($assoc['qty'])) ? $assoc['qty'] : '' ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="short_dec" class="form-control-label">Short description</label>
                                <textarea class="form-control" name="short_dec" id="short_dec"  rows="2" required=""><?= (isset($assoc['short_dec'])) ? $assoc['short_dec'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-control-label">description</label>
                                <textarea class="form-control" name="description" id="description"  rows="2" ><?= (isset($assoc['description'])) ? $assoc['description'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_title" class="form-control-label">meta title</label>
                                <textarea class="form-control" name="meta_title" id="meta_title"  rows="2"><?= (isset($assoc['meta_title'])) ? $assoc['meta_title'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_description" class="form-control-label">meta description</label>
                                <textarea class="form-control" name="meta_description" id="meta_description"  rows="2"><?= (isset($assoc['meta_description'])) ? $assoc['meta_description'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword" class="form-control-label">meta keyword</label>
                                <textarea class="form-control" name="meta_keyword" id="meta_keyword"  rows="2" ><?= (isset($assoc['meta_keyword'])) ? $assoc['meta_keyword'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-control-label">image</label>
                                <input type="file" class="form-control" id="image" name="image" />
                            </div>
                            <button  type="submit" class="btn btn-lg btn-info btn-block" name="submit_product">
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
<script type="text/javascript">
<?php
if (isset($_GET['id'])) {
    ?>
        get_sub_category(<?= $sub_category ?>);
    <?php
}
?>

</script>

?>