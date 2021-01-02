<?php

require_once 'header.php';
if (isset($_SESSION['users_id'])) {
    ?>
    <script type="text/javascript">
        window.location.href = 'my_order.php';
    </script>

    <?php

}
?>
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Login</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="contact-form"  method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="email" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
                                </div>
                                <span class="feild_error" id="login_email_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                </div>
                                <span class="feild_error" id="login_password_error"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" onclick="login()" class="fv-btn">Login</button>
                            </div>
                          
                        </form>
                        <div class="forgot_password">
                              <span>If you forgot password then  <a href="forgot_password.php"> Click Here</a></span>
                        </div>
                        <div class="form-output login login">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div> 

            </div>

            <!--register form-->
            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Register</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="contact-form" action="#" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                </div>
                                <span class="feild_error" id="name_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="email" name="email" id="email" placeholder="Your Email*" style="width:45%">
                                    <button type="button" onclick="email_sent_otp()" class="fv-btn email_sent_otp height">Sent OTP</button>

                                    <input type="text" id="otp" placeholder=" OTP*" style="width:45%" class="email_otp_varify">
                                    <button type="button" onclick="email_otp_varify()" class="fv-btn height email_otp_varify">veripay</button>
                                    <span class="email_verypied" id="email_verypied">Email varified</span>
                                </div>
                                <span class="feild_error" id="email_error"></span>
                                <span class="feild_error" id="otpl_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
                                </div>
                                <span class="feild_error" id="mobile_error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
                                </div>
                                <span class="feild_error" id="password_error"></span>
                            </div>
                            <div class="contact-btn">
                                <button type="button" onclick="register_submit()" class="fv-btn">Register</button>
                            </div>
                        </form>
                        <div class="form-output register">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div> 

            </div>

        </div>
</section>
<?php require_once 'footer.php'; ?>