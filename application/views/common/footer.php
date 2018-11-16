<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                © <?php echo date('Y'); ?> Password Manager
            </div>
        </div>
    </div>
</footer>

<!-- jQuery  -->
<?php echo getJs('popper.min.js'); ?>
<?php echo getJs('bootstrap.min.js'); ?>
<?php echo getJs('jquery.slimscroll.js'); ?>
<?php echo getJs('waves.js'); ?>
<?php echo getJs('jquery.scrollTo.min.js'); ?>
<?php if (@!empty($jsArray)) echo getJs($jsArray); ?>   
<?php echo getJs('jquery.core.js'); ?>
<?php echo getJs('jquery.app.js'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        if ($('#datatable').length > 0) {
            $('#datatable').DataTable();
        }
    });
</script>
</body>
</html>