<?php

require_once 'header.php';
if (isset($_SESSION['users_id'])) {
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
                            <h2 class="title__line--6">Forgot password</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="contact-form"  method="post">
                          
                            <div class="single-contact-form">
                                <label class="change_password_label"for="email">Email </label>
                                <div class="contact-box name">
                                    <input type="email" name="email" id="email" placeholder="Email *" style="width:100%">
                                </div>
                                <span class="feild_error" id="email_error"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" onclick="forgot_password()" class="fv-btn forgot_btn">Submit</button>
                            </div>
                        </form>
                             <span class="feild_error" id="result_error"></span>
                        <div class="form-output login ">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div> 

            </div>


        </div>
</section>
<?php require_once 'footer.php'; ?>