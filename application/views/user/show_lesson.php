<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h3><b><?= lang('title_lesson_word'); ?></b></h3>           
            <h2><?= lang('lesson'); ?> <?= $lesson['name']; ?></h2>
            <h4><?= lang('category'); ?> : <?= $category['name']; ?></h4>
        </div>
        <div class="col-sm-8">
            <h3><b><?= lang('test'); ?></b></h3>
            <form action="" method="post">
                <div class="form-group">
                <?php if (isset($list_word) && count($list_word)) { ?>
                    <ol>
                        <?php foreach ($list_word as $key => $value) { ?>
                            <li>
                                <b><?= $value['content']; ?></b>
                            </li>
                            <ul class = "list-unstyled" style = "margin-left: 30px;">
                                <?php foreach ($value['word_anser'] as $key => $val) { ?>              
                                    <li class = "checkbox">
                                        <input type="checkbox" class= "checkbox-<?= $value['id']; ?>" name = "check[]" value="<?= $val['id']; ?>"><?= $val['content']; ?>
                                    </li>       
                                <?php } ?> 
                            </ul>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $(".checkbox-<?= $value['id'] ;?>").change(function() {
                                        var checked = $(this).is(':checked');
                                        $(".checkbox-<?= $value['id']; ?>").prop('checked', false);
                                        if(checked) {
                                            $(this).prop('checked',true);
                                        }
                                    });
                                });
                            </script>
                        <?php } ?>
                    </ol>
                    <input type="submit" name = "submit" class="btn btn-default" value="<?= lang('submit'); ?>">
                <?php } ?>                      
                </div>               
            </form>
        </div>
    </div>
</div>
