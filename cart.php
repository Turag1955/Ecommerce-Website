<?php
require_once 'header.php';
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    ?>
        <script type="text/javascript">
            window.location.href = 'index.php';
        </script>
        <?php
    }

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
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($_SESSION['cart']as $key => $val) {
                                    $product = get_product($conn, '', '', $key);
                                    $pname = $product[0]['name'];
                                    $mrp = $product[0]['mrp'];
                                    $price = $product[0]['price'];
                                    $image = $product[0]['image'];
                                    $qty = $val['qty'];
                                    ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="./assets/backend/upload/product/<?= $image ?>" alt="product img" /></a></td>
                                        <td class="product-name"><a href="#"><?= $pname ?></a>
                                            <ul  class="pro__prize">
                                                <li class="old__prize"></li>
                                                <li><?= $mrp ?> MRP</li>
                                            </ul>
                                        </td>
                                        <td class="product-price"><span class="amount"><?= $price ?> Tk</span></td>
                                        <td class="product-quantity"><input type="number" id="<?= $key ?>qty" value="<?= $qty ?>" /><br />
                                            <span class="feild_error" id="stock_in_qty"></span>
                                            <a href="javascript:void(0)" onclick="add_to_cat('<?= $key ?>', 'update')">Update</a>

                                        </td>
                                        <td class="product-subtotal"><?= $price * $qty ?> Tk</td>
                                        <td class="product-remove"><a href="javascript:void(0)" onclick="add_to_cat('<?= $key ?>', 'remove')"><i class="icon-trash icons"></i></a></td>
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