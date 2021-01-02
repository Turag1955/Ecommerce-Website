<?php
require_once '../connection.php';
require_once './function.php';

$category_id = get_safe_value($conn, $_POST['category_id']);
$sub_cat_id = get_safe_value($conn, $_POST['sub_cat_id']);
$query = mysqli_query($conn, "select * from sub_category where category_id = '$category_id' ");
$row = mysqli_num_rows($query);
if($row>0){
    while ($assoc = mysqli_fetch_assoc($query)){
        $html = '';
        if($sub_cat_id == $assoc['id']){
             $html.= "<option selected value=".$assoc['id'].">".$assoc['sub_category']."</option>";
        } else {
              $html.= "<option value=".$assoc['id'].">".$assoc['sub_category']."</option>";
        }
      
        echo $html;
    }
} else {
    echo "<option>No Found sub category</option>";
}


?>