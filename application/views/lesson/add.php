<div class="container">
    <div class="row col-sm-4">   
        <form class="form-signin" action="" method="post">
            <h3><b><?= lang('title_add_lesson'); ?></b></h3>
            <?= validation_errors(); ?>
            <div class="form-group">
                <label for="exampleInputEmail1"><?= lang('lesson'); ?>:</label>
                <input type="text" class="form-control"  name="name" placeholder="<?= lang('content_lesson'); ?>" value="<?= set_value('name', ''); ?>">
            </div>
            <div class="form-group">
                <?= form_dropdown('category', $list_category, 0, 'class = "form-control"'); ?>
            </div>
            <input type="submit" class="btn btn-default" name="add_lesson" value="<?= lang('title_add_lesson'); ?>" />
        </form>
    </div>
</div> <!-- /container -->
