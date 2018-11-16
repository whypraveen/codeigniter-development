<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Reset Password</title>

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
            <div class=" card-box">
                <div class="panel-heading">
                    <h4 class="text-center"> Reset Password </h4>
                    <?php echo getNotification(); ?>
                </div>

                <div class="p-20">
                    <form method="post" action="<?php echo site_url('reset'); ?>" role="form" method="post">
                        <div class="form-group m-t-40">
                            <input type="password" class="form-control" id="nPass" name="nPass" required="required" placeholder="New Password" />
                        </div>
                        <div class="form-group m-t-40">
                            <input type="password" class="form-control" id="cnPass" name="cnPass" required="required" placeholder="Confirm New Password" />
                        </div>

                        <div class="form-group text-center m-t-20">
                            <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit" name="reset" value="reset">Reset</button>
                        </div>
                    </form>
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