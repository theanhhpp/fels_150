<div class="container">
    <div class="row col-sm-4">   
        <form class="form-signin" action="" method="post">
            <h3><b><?= lang('title_add_word'); ?></b></h3>
            <?= validation_errors(); ?>
            <div class="form-group">
                <label for="exampleInputEmail1"><?= lang('content_word'); ?>:</label>
                <input type="text" class="form-control"  name="content" placeholder="<?= lang('content_word'); ?>" value="<?= set_value('content', ''); ?>">
            </div>
            <div class="form-group">
                <?= form_dropdown('category', $list_category, 1, 'class = "form-control"'); ?>
            </div>
            <input type="submit" class="btn btn-default" name="add_word" value="<?= lang('title_add_word'); ?>" />
        </form>
    </div>
</div> <!-- /container -->
