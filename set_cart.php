<?php

require_once './connection.php';
require_once './function.php';
require_once './add_to_cart.php';


$pid = get_safe_value($conn, $_POST['pid']);
$qty = get_safe_value($conn, $_POST['qty']);
$type = get_safe_value($conn, $_POST['type']);

$totalProductIdBuy = totalProductIdBuy($conn,$pid);
$totalProductIdQty = totalProductIdQty($conn,$pid);
$pending_qty = $totalProductIdQty- $totalProductIdBuy;


if($qty > $pending_qty){
    echo 'no_enough_qty';
    die();
}

$obj = new add_to_cart();
if ($type == 'add') {
    $obj->addproduct($pid, $qty);
}
if ($type == 'update') {
    $obj->updateproduct($pid,$qty);
   
}
if ($type == 'remove') {
    $obj->removeproduct($pid);
   
}

echo $obj->totalproduct();
?>