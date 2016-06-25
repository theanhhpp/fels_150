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
            <div>
            <?php
                if (!empty($authUrl) && !empty($authUrlfb)) {
                    echo '<a href="'.$authUrlfb.'"><img src="assets/images/fb_btn.png" style = "width: 50%; "></a>';
                    echo '<a href="'.$authUrl.'"><img src="assets/images/gg_btn.png" style = "width: 50%; "></a></br>';
                }
            ?>
            </div>
            <input type="submit" class="btn btn-default" style="margin-top: 10px;" name="login" value="<?= lang('login'); ?>">
        </form>
    </div>  
</div>
