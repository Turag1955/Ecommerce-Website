<?php
require_once 'header.php';
if (!isset($_SESSION['users_id'])) {
    ?>
    <script type="text/javascript">
        window.location.href = 'index.php';
    </script>
    <?php
}
$user_id = $_SESSION['users_id'];

$query = mysqli_query($conn, "SELECT product.name,product.price,product.mrp,product.image,wishlist.id FROM wishlist,product WHERE wishlist.product_id = product.id AND wishlist.user_id = '$user_id' ");
?>
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($assoc = mysqli_fetch_assoc($query)) {
                                    ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="./assets/backend/upload/product/<?= $assoc['image'] ?>" alt="product img" /></a></td>
                                        <td class="product-name"><a href="#"><?= $assoc['name'] ?></a>
                                            <ul  class="pro__prize">
                                                <li class="old__prize"></li>
                                                <li><?= $assoc['mrp'] ?></li>
                                            </ul>
                                        </td>
                                        <td class="product-price"><span class="amount"><?= $assoc['price'] ?> Tk</span></td>
                                        <td class="product-remove"><a href="?id=<?= $assoc['id'] ?>" ><i class="icon-trash icons"></i></a></td>
                                    </tr>
    <?php
}
?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="#">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">

                                    <a href="checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>