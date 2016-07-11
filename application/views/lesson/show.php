<div class="container">
    <?php
        $message_flashdata = $this->session->flashdata('message_flashdata');

        if(isset($message_flashdata) && count($message_flashdata)) {

            if($message_flashdata['type'] == 'successful') { ?>
                <p style="color:#5cb85c;"><?= $message_flashdata['message'];?></p>
            <?php } else if($message_flashdata['type'] == 'error') { ?>
                <p style="color:red;"><?= $message_flashdata['message'];?></p>
            <?php }
        } 
    ?>
    <div class="row">
        <div class="col-sm-4">
            <h3><b><?= lang('title_lesson_word'); ?></b></h3>           
            <h2><?= lang('lesson'); ?> <?= $lesson['name']; ?></h2>
            <h4><?= lang('category'); ?> : <?= $category['name']; ?></h4>
            <a href="lesson_word/add?lesson_id=<?= $lesson['id']; ?>" class="btn btn-default"><?= lang('title_add_word'); ?></a>
        </div>
        <div class="col-sm-8">
            <h3><b><?= lang('test'); ?></b></h3>
            <form action="" method="post">
                <div class="form-group">
                <?php $i = 1;
                if (isset($list_word) && count($list_word)) { ?>
                    <ol>
                        <?php foreach ($list_word as $key => $value) { ?>
                            <li>
                                <b><?= $value['content']; ?></b>
                                <a href ="lesson_word/delete/<?= $value['lesson_word_id']; ?>" class ="delete"><?= lang('delete'); ?></a>
                            </li>
                            <ul class = "list-unstyled" style = "margin-left: 30px;">
                                <?php foreach ($value['word_anser'] as $key => $val) { ?>                                
                                    <li class = "checkbox">
                                        <input type="checkbox" class= "checkbox-<?= $i; ?>" name = "check[]" value="<?= $val['id']; ?>"><?= $val['content']; ?>
                                    </li>       
                                <?php } ?> 
                            </ul>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $(".checkbox-<?= $i;?>").change(function() {
                                        var checked = $(this).is(':checked');
                                        $(".checkbox-<?= $i; ?>").prop('checked', false);
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
