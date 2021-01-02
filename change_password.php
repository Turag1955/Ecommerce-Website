<?php

require_once 'header.php';
if (!isset($_SESSION['users_id'])) {
    ?>
    <script type="text/javascript">
        window.location.href = 'index.php';
    </script>

    <?php
  
}
?>
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Change password</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="contact-form"  method="post">
                            <div class="single-contact-form">
                                <label class="change_password_label"for="current_password">Current password</label>
                                <div class="contact-box name">
                                    <input type="text" name="current_password" id="current_password" placeholder=" Current password*" style="width:100%">
                                </div>
                                <span class="feild_error" id="current_password_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <label class="change_password_label"for="new_password">New password</label>
                                <div class="contact-box name">
                                    <input type="text" name="new_password" id="new_password" placeholder="New password*" style="width:100%">
                                </div>
                                <span class="feild_error" id="new_password_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <label class="change_password_label"for="confirm_password">Confirm password</label>
                                <div class="contact-box name">
                                    <input type="text" name="confirm_password" id="confirm_password" placeholder="confirm password*" style="width:100%">
                                </div>
                                <span class="feild_error" id="confirm_password_error"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" onclick="change_password()" class="fv-btn">Submit</button>
                            </div>
                        </form>
                        <div class="form-output login ">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div> 

            </div>


        </div>
</section>
<?php require_once 'footer.php'; ?>