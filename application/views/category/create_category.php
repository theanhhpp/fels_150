<div class="container">
    <div class="row col-sm-5 col-sm-offset-4">   
        <form class="form-signin" action="" method="post">
            <h3><b><?= lang('title_create_category'); ?></b></h3>
            <?= validation_errors();?>
            <div class="form-group">
            <label for="exampleInputEmail1"><?= lang('category_name'); ?></label>
                <input type="text" class="form-control"  name="name" placeholder="<?= lang('category_name'); ?>" value=
                "<?= set_value('name', ''); ?>">
            </div>
            <input type="submit" class="btn btn-default" name="create-category" value="<?= lang('title_create_category'); ?>" />
        </form>
    </div>
</div> 
