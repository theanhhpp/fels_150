<div class = "container">
    <div class = "row col-sm-4 col-sm-offset-4">
        <form action="" method="post">
            <?= validation_errors(); ?>
            <div class="form-group">
                <label><?= lang('mail'); ?></label>
                <input type="email" class="form-control" name="email" placeholder="<?= lang('mail'); ?>" value="<?= set_value('email', ''); ?>">
            </div>
            <div class="form-group">
                <label><?= lang('password'); ?></label>
                <input type="password" class="form-control" name="password" placeholder="<?= lang('password'); ?>">
            </div>
            <input type="submit" class="btn btn-default" name="login" value="<?= lang('login'); ?>">
        </form>
    </div>  
</div>
