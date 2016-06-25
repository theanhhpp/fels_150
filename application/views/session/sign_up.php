<div class="container">
    <div class="row col-sm-5 col-sm-offset-4">   
        <form class="form-signin" action="" method="post">
            <h3><b><?= lang('title_sign_up'); ?></b></h3>
            <?= validation_errors();?>
            <div class="form-group">
                <label for="exampleInputEmail1"><?= lang('first_name'); ?></label>
                <input type="text" class="form-control"  name="first_name" placeholder="<?= lang('first_name'); ?>" value="<?= set_value('first_name', ''); ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><?= lang('last_name'); ?></label>
                <input type="text" class="form-control"  name="last_name" placeholder="<?= lang('last_name'); ?>" value="<?= set_value('last_name', ''); ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><?= lang('mail'); ?></label>
                <input type="email" class="form-control"  name="email" placeholder="<?= lang('mail'); ?>" value="<?= set_value('email', ''); ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"><?= lang('password'); ?></label>
                <input type="password" class="form-control"  name="password" placeholder="<?= lang('password'); ?>" value="<?= set_value('password', ''); ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"><?= lang('password_confirmation'); ?></label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="<?= lang('password_confirmation'); ?>" value="<?= set_value('password_confirmation', ''); ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputFile"><?= lang('avatar'); ?></label>
                <input type="file" name="avatar" value="<?php echo set_value('avatar', ''); ?>">
            </div>
            <input type="submit" class="btn btn-default" name="sign-up" value="<?= lang('title_sign_up'); ?>" />
        </form>
    </div>
</div> <!-- /container -->
