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
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="card-box">
                <div class="panel-heading">
                    <h4 class="text-center"> Sign In to <strong>F11 Password Manager</strong></h4>
                    <?php echo getNotification(); ?>
                </div>
                <div class="p-20">
                    <form class="form-horizontal m-t-20" action="<?php echo site_url('login'); ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" required="required" autocomplete="off" placeholder="Email" />
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" id="user-password" name="pass" required="required" autocomplete="off" placeholder="Password" />
                        </div>

                        <div class="form-group text-center m-t-40">
                            <div class="col-12">
                                <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit" name="login" value="login">Log In</button>
                            </div>
                        </div>

                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-12">
                                <a href="<?php echo site_url('forgot'); ?>" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot
                                    your password?</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p>Don't have an account? <a href="<?php echo site_url('register'); ?>" class="m-l-5"><b>Sign Up</b></a>
                    </p>

                </div>
            </div>
        </div>
        
        <!-- jQuery  -->
        <?php echo getJs('jquery.min.js'); ?>
        <?php echo getJs('popper.min.js'); ?>
        <?php echo getJs('bootstrap.min.js'); ?>
    </body>
</html>