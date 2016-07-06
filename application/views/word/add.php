<div class="container"> 
    <form class="form-signin" action="" method="post">
        <div class="row">
            <div class="col-sm-4">  
                <h3><b><?= lang('title_add_word'); ?></b></h3>
                <?= validation_errors(); ?>
                <div class="form-group">
                    <label><?= lang('word'); ?>:</label>
                    <input type="text" class="form-control"  name="content" placeholder="<?= lang('content_word'); ?>" value="<?= set_value('content', ''); ?>">
                </div>
                <div class="form-group">
                    <?= form_dropdown('category', $list_category, 0, 'class = "form-control"'); ?>
                </div>
            </div>
            <div class="col-sm-4 col-sm-offset-2">  
                <h3><b><?= lang('add_answer'); ?></b></h3>
                <?php for ($i=0; $i < 4; $i++) { ?>
                    <label for="exampleInputEmail1"><?= lang('answer')." ".($i + 1); ?></label>
                    <div class = "row">   
                        <div class="radio col-sm-1">
                            <label>
                                <input type="radio" name="checkbox[]" id="optionsRadios1" checked value = "<?= $i?>">
                            </label>
                        </div> 
                        <div class="form-group col-sm-10">
                            <input type="text" class="form-control"  name="answer[]" placeholder="<?= lang('answer'); ?>" value="<?= set_value('answer[]', ''); ?>">
                        </div> 
                    </div>               
                <?php } ?>
            </div>
        </div>
        <input type="submit" class="btn btn-default" name="add_word" value="<?= lang('title_add_word'); ?>" />
    </form>
</div> <!-- /container -->
