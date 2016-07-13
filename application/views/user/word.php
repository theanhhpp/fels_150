<div class="container">
    <h2 class=""><?= lang('title_word'); ?></h2>
    <div class = "row col-sm-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?= lang('number'); ?></th>
                        <th><?= lang('word'); ?></th>
                        <th><?= lang('learn'); ?></th>
                        <th><?= lang('category'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($list_word) && count($list_word)) {
                        $i = 1;
                        foreach ($list_word as $key => $value) { ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><a href="word/show/<?= $value['word_id']; ?>"><?= $value['content']; ?></a></td>
                                <td><a href= "category/show/<?= $value['category_id'];?>"><?= $value['category_name']; ?></td>
                                <?php if($this->Learned_Word_Model->total(['word_id' => $value['word_id'],'user_id' => $this->authentication['id']]) == 0) { ?>
                                <td><a href="learned_word/learn/<?= $value['word_id']; ?>?redirect= <?= current_url(); ?>"><?= lang('unlearn'); ?></a></td>
                                <?php } else { ?>
                                <td><?= lang('learned'); ?></td>
                                <?php } ?>
                            </tr>
                            <?php $i ++; 
                        }
                    } else {
                        echo '<tr><td colspan="4">' . lang('no_data') . '</td></tr>';    
                    } ?>
                </tbody>
            </table>
        </div> 
        <div>
            <?= isset($list_pagination) ? $list_pagination : ''; ?>    
        </div>
    </div>	
</div>
