<div class="container">
    <div class="row col-sm-4">
        <h2><?= lang('title_edit_word'); ?></h2> </br>
        <?php echo  validation_errors();?>  
        <form class="form-signin" action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1"><?= lang('content_word'); ?>:</label>
                <input type="text" class="form-control"  name="content" placeholder="<?= lang('content_word'); ?>" value="<?= $word['content']; ?>">
            </div>
            <div class="form-group">
                <?= form_dropdown('category', $list_category, $word['category_id'], 'class = "form-control"'); ?>
            </div>
            <input type="submit" class="btn btn-default" name="edit_word" value="<?= lang('title_edit_word'); ?>" />
        </form>
    </div>
</div>
