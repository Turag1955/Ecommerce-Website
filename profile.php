<?php require_once 'header.php'; ?>
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__wrap ">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="index.html">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active">Profile</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">

                <h2 class="text-center mb-4">Your Profile</h2>
                <br />
                <div class="table-content table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                            $uid = $_SESSION['users_id'];
                            $assoc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = $uid "));
                            ?>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><strong><?= $assoc['usersname'] ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><strong><?= $assoc['email'] ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Password</strong></td>
                                <td><a href="change_password.php" class="btn btn-warning">Change Password</a></td>
                            </tr>
                            <tr>
                                <td><strong>Mobile</strong></td>
                                <td><strong><?= $assoc['mobile'] ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>sing up date</strong></td>
                                <td><strong><?= $assoc['insertdate'] ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>