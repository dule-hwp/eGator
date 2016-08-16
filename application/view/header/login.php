<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;" xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-circle" id="img_logo" src="<?php echo IMG_STATIC_FOLDER_URL . "eGator.jpg"; ?>">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>

            <!-- Begin # DIV Form -->
            <div id="div-forms">

                <!-- Begin # Login Form -->
                <form id="login-form">
                    <div class="modal-body">
                        <div id="div-login-msg">
                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-login-msg">Type your username and password.</span>
                        </div>
                        <input id="login_username" class="form-control" type="text"
                               placeholder="Username " required>
                        <input id="login_password" class="form-control" type="password" placeholder="Password" required>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                        </div>
                        <div>
<!--                            <button id="login_lost_btn" type="button" class="btn btn-link">Lost Password?</button>-->
                            <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                        </div>
                    </div>
                </form>
                <!-- End # Login Form -->

                <!-- Begin | Lost Password Form -->
                <form id="lost-form" style="display:none;">
                    <div class="modal-body">
                        <div id="div-lost-msg">
                            <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-lost-msg">Type your e-mail.</span>
                        </div>
                        <input id="lost_email" class="form-control" type="text"
                               placeholder="E-Mail (type ERROR for error effect)" required>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
                        </div>
                        <div>
                            <button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
                            <button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
                        </div>
                    </div>
                </form>
                <!-- End | Lost Password Form -->

                <!-- Begin | Register Form -->
                <form id="register-form" style="display:none;">
                    <div class="modal-body">
                        <div id="div-register-msg">
                            <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-register-msg">Register an account.</span>
                        </div>
                        <input id="register_first_name" class="form-control" type="text" placeholder="First name"
                               required>
                        <input id="register_last_name" class="form-control" type="text" placeholder="Last name"
                               required>
                        <input id="register_email" class="form-control" type="text" placeholder="E-Mail" required>
                        <input id="register_sfsu_id" class="form-control" type="number" placeholder="SFSU Id" required>
                        <input id="register_username" class="form-control" type="text" placeholder="Username" required>
                        <input id="register_password" class="form-control" type="password" placeholder="Password"
                               required>
                            <input id="register_terms_conditions" type="checkbox" onclick="openTermsAndConditionsDlg()">
<!--                            <span onclick="openTermsAndConditionsDlg()">-->
                                Read terms and conditions
<!--                            </span>-->
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                            <a class="btn btn-primary btn-lg registration-button-style" onclick="onCancelRegistration()">Cancel</a>
                            <a href="#" class="btn btn-primary btn-lg registration-button-style" role="button" type="submit"
                               onclick="submitForm('#register-form')">Register</a>
                        </div>
                        <div>
                            <button id="register_btn" type="submit" class="btn btn-primary btn-lg btn-block hidden" >Register</button>
                        </div>
                        <div>
                            <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                        </div>
                    </div>
                </form>
                <!-- End | Register Form -->

            </div>
            <!-- End # DIV Form -->

        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->
