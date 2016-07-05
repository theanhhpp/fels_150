<div class="container">
    <div class="row col-sm-4">
        <h2><?= lang('title_edit_lesson'); ?></h2> </br>
        <?php echo  validation_errors();?>  
        <form class="form-signin" action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1"><?= lang('lesson'); ?>:</label>
                <input type="text" class="form-control"  name="name" placeholder="<?= lang('content_lesson'); ?>" value="<?= $lesson['name']; ?>">
            </div>
            <div class="form-group">
                <?= form_dropdown('category', $list_category, $lesson['category_id'], 'class = "form-control"'); ?>
            </div>
            <input type="submit" class="btn btn-default" name="edit_lesson" value="<?= lang('title_edit_lesson'); ?>" />
        </form>
    </div>
</div>
