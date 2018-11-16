<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Dashboard</title>
        <?php echo getCss(array('bootstrap.min.css', 'icons.css', 'style.css')); ?>
        <?php echo getCss('custom.css'); ?>
        <?php if (@!empty($cssArray)) echo getCss($cssArray); ?>   
        <?php echo getJs('modernizr.min.js'); ?>
        <?php echo getJs('jquery.min.js'); ?>
        <script type="text/javascript">var baseUrl = '<?php echo site_url(); ?>';</script>
    </head>
    <?php $this->load->view('common/header'); ?>