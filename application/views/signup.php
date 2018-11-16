<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="shortcut icon" href="assets/images/favicon_1.ico">
        <title>F11 Password Manager</title>
        <?php echo getCss('bootstrap.min.css'); ?>
        <?php echo getCss('icons.css'); ?>
        <?php echo getCss('style.css'); ?>
        <?php echo getCss('custom.css'); ?>
        <?php echo getJs('jquery.min.js'); ?>
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="card-box">
                <div class="panel-heading">
                    <h4 class="text-center"> Sign Up to <strong>F11 Password Manager</strong></h4>
                    <?php echo getNotification(); ?>
                </div>
                <div class="p-20">
                    <form class="form-horizontal m-t-20" action="#" method="post">

                        <div class="form-group">
                            <input type="email" class="form-control" id="user-email" name="email" required="required" autocomplete="off" placeholder="Email" />
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" id="user-password" name="pass" required="required" autocomplete="off" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="cpassword" name="cpassword" required="required" placeholder="Confirm Password" />
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox" checked="checked">
                                    <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center m-t-40">
                            <div class="col-12">
                                <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit" name="register" value="register">Register</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p>Already have account? <a href="<?php echo site_url(); ?>" class="text-info m-l-5"><b>Sign In</b></a>
                    </p>

                </div>
            </div>
        </div>
        
        <!-- jQuery  -->
        <?php echo getJs('popper.min.js'); ?>
        <?php echo getJs('bootstrap.min.js'); ?>
        <?php echo getJs('notifyjs/notify.js'); ?>
        <?php echo getJs('notifications/notify-metro.js'); ?>
        <?php echo getJs('jquery.core.js'); ?>
    </body>
</html>