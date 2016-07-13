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
        <div class="col-sm-6">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= lang('number'); ?></th>
                            <th><?= lang('lesson'); ?></th>
                            <th><?= lang('action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <h4><?= lang('title_category'); ?> : <?= $category['name']; ?></h4>
                        <?php
                            $i = 1;
                            if(isset($lesson_of_category) && count($lesson_of_category)) {
                                foreach ($lesson_of_category as $key => $value) { ?>
                                    <tr>
                                        <td><?= $i;?></td>
                                        <td><?= $value['lesson_name'];?></td>
                                        <td><a href= "lesson/show/<?= $value['id']; ?>" class="btn btn btn-success"><?= lang('start_lesson'); ?></a></td>
                                    </tr>
                                    <?php $i ++; 
                                }
                            } else {
                               echo '<tr><td colspan="3">' . lang('no_data_message') . ' </td></tr>';
                            }
                        ?>
                    </tbody> 
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= lang('number'); ?></th>
                            <th><?= lang('word'); ?></th>
                            <th><?= lang('learn'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <h4><?= lang('title_category'); ?> : <?= $category['name']; ?></h4>
                        <?php
                            $i = 1;
                            if(isset($word_of_category) && count($word_of_category)) {
                                foreach ($word_of_category as $key => $value) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><a href = "word/show/<?= $value['id'];?>"> <?= $value['word_content'];?></a></td>
                                        <?php if($this->Learned_Word_Model->total(['word_id' => $value['id'],'user_id' => $this->authentication['id']]) == 0) { ?>
                                        <td><a href="learned_word/learn/<?= $value['id']; ?>?redirect= <?= current_url(); ?>"><?= lang('unlearn'); ?></a></td>
                                        <?php } else { ?>
                                        <td><?= lang('learned'); ?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php $i ++;
                                }
                            } else {
                               echo '<tr><td colspan="3">' . lang('no_data_message') . ' </td></tr>';
                            }
                        ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
