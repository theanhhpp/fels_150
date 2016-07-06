<div class="container">
    <form class="form-signin" action="" method="post">
        <div class="row">
            <div class="row col-sm-4">
                <h2><?= lang('title_edit_word'); ?></h2> </br>
                <?php echo  validation_errors();?>              
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?= lang('word'); ?>:</label>
                        <input type="text" class="form-control"  name="content" placeholder="<?= lang('content_word'); ?>" value="<?= $word['content']; ?>">
                    </div>
                    <div class="form-group">
                        <?= form_dropdown('category', $list_category, $word['category_id'], 'class = "form-control"'); ?>
                    </div>
            </div>
            <div class="col-sm-4 col-sm-offset-2">  
                <h3><b><?= lang('edit_answer'); ?></b></h3>
                <?php for ($i=0; $i < 4; $i++) { ?>
                    <label><?= lang('answer')." ".($i + 1); ?></label>
                    <div class = "row">   
                        <div class="radio col-sm-1">
                            <label>
                                <?php if(isset($list_word_answer) && count($list_word_answer)) {
                                    if ($list_word_answer[$i]['correct'] == 1) { ?>
                                        <input type="radio" name="checkbox[]" id="optionsRadios1" checked ="" value = "<?= $i?>">    
                                    <?php } else { ?>
                                        <input type="radio" name="checkbox[]" id="optionsRadios1" value = "<?= $i?>">
                                    <?php } 
                                }   else { ?>
                                    <?= lang('no_data')?>              
                                <?php } ?>
                            </label>
                        </div> 
                        <div class="form-group col-sm-10">
                            <input type="text" class="form-control"  name="answer[]" placeholder="<?= lang('answer'); ?>" value = "<?= $list_word_answer[$i]['content']; ?>">
                        </div> 
                    </div>               
                <?php } ?>
            </div>
        </div>
        <input type="submit" class="btn btn-default" name="edit_word" value="<?= lang('title_edit_word'); ?>" />
    </form>
</div>
