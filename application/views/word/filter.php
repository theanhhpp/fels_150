<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><div><label><input type="checkbox" id="checkAll"></label></div></th>
                <th><?= lang('word'); ?></th>
                <th><?= lang('category'); ?></th>
                <th><?= lang('created_at'); ?></th>
                <th><?= lang('updated_at'); ?></th>
                <th>ID</th>
                <th><?= lang('learn'); ?></th>
                <th><?= lang('action'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($list_word) && count($list_word)) {
                foreach ($list_word as $key => $value) { ?>
                    <tr>
                        <td>
                            <input type="checkbox" class = "ch" name= "checkbox[]" value = "<?= $value['word_id']; ?>"/>
                        </td>
                        <td><a href="word/show/<?= $value['word_id']; ?>"><?= $value['content']; ?></a></td>
                        <td><a href="category/show/<?= $value['category_id']; ?>"><?= $value['category_name']; ?></td>
                        <td><?= $value['created_at']; ?></td>
                        <td><?= $value['updated_at']; ?></td>
                        <td><?= $value['word_id']; ?></td>
                        <?php if($this->Learned_Word_Model->total(['word_id' => $value['word_id'],'user_id' => $this->authentication['id']]) == 0) { ?>
                            <td><a href="learned_word/learn/<?= $value['word_id']; ?>?redirect= <?= current_url(); ?>"><?= lang('unlearn'); ?></a></td>
                        <?php } else { ?>
                            <td><?= lang('learned'); ?></td>
                        <?php } ?>
                        <td>
                            <a href= "word/edit/<?= $value['word_id'];?>"><?= lang('edit'); ?></a> | 
                            <a class = "delete"  href= "word/delete/<?= $value['word_id']; ?>"><?= lang('delete'); ?></a>
                        </td>
                    </tr>
                <?php }
            } else {
                echo '<tr><td colspan="8">' . lang('no_data') . '</td></tr>';    
            } ?>
        </tbody>
    </table>
</div>
