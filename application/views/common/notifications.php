<?php if (@$function == 'notification') : ?>
    <?php if (!empty($message)): ?>
        <?php if ($message['notice'] != ""): ?>
            <div class="alert alert-info text-center fixed">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>Heads up!</strong> <?php echo $message['notice']; ?>
            </div>
        <?php endif; ?>
        <?php if ($message['error'] != ""): ?>
            <div class="alert alert-danger text-center fixed">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>Oh snap!</strong> <?php echo $message['error']; ?>
            </div>
        <?php endif; ?>
        <?php if ($message['success'] != ""): ?>
            <div class="alert alert-success text-center fixed">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>Well done!</strong> <?php echo $message['success']; ?>
            </div>
        <?php endif; ?>
        <?php if ($message['warning'] != ""): ?>
            <div class="alert alert-warning text-center fixed">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <p><?php echo $message['warning']; ?></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>