<h2><?= lang('title_lessons_words_of_category'); ?></h2>
    <?php
        $message_flashdata = $this->session->flashdata('message_flashdata');

        if(isset($message_flashdata) && count($message_flashdata)) {

            if($message_flashdata['type'] == 'successful') {
            ?>
                <p style="color:#5cb85c;"><?= $message_flashdata['message'];?></p>
                <?php
            } else if($message_flashdata['type'] == 'error') {
            ?>
                <p style="color:red;"><?= $message_flashdata['message'];?></p>
            <?php
        }
    }
    ?>
<div class="container">
    <div class="row">
        <form method="post" action="">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?= lang('id_lesson'); ?></th>
                            <th><?= lang('lesson'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <h4><?= lang('title_category'); ?> : <?= $category['name']; ?></h4>
                        <?php
                            if(isset($lesson_of_category) && count($lesson_of_category)) {
                                foreach ($lesson_of_category as $key => $value) {
                                ?>
                                    <tr>
                                        <td><a href = "lesson/show/<?= $value['id'];?>"> <?= $value['id'];?></a></td>
                                        <td><a href = "lesson/show/<?= $value['id'];?>"> <?= $value['lesson_name'];?></a></td>
                                    </tr>
                                <?php
                                }
                            } else {
                               echo '<tr><td colspan="3">' . lang('no_data_message') . ' </td></tr>';
                            }
                        ?>
                    <thead>
                        <tr>
                            <th><?= lang('id_word'); ?></th>
                            <th><?= lang('word'); ?></th>
                        </tr>
                    </thead>
                        <?php
                            if(isset($word_of_category) && count($word_of_category)) {
                                foreach ($word_of_category as $key => $value) {
                        ?>
                                    <tr>
                                        <td><a href = "word/show/<?= $value['id'];?>"> <?= $value['id'];?></a></td>
                                        <td><a href = "word/show/<?= $value['id'];?>"> <?= $value['word_content'];?></a></td>
                                    </tr>
                                <?php
                                }
                            } else {
                               echo '<tr><td colspan="3">' . lang('no_data_message') . ' </td></tr>';
                            }
                                ?>
                    </tbody> 
                </table>
            </div>    
            <div class="col-sm-3">
                <?php echo isset($list_pagination) ? $list_pagination : ''; ?>    
            </div>
        </form>
    </div>
</div>
