<div class="container">
    <h2 class=""><?= lang('title_word'); ?></h2>
    <div class = "row col-sm-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?= lang('number'); ?></th>
                        <th><?= lang('word'); ?></th>
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
                            </tr>
                            <?php $i ++; 
                        }
                    } else {
                        echo '<tr><td colspan="7">'. lang('no_data') .'</td></tr>';    
                    } ?>
                </tbody>
            </table>
        </div> 
        <div>
            <?= isset($list_pagination) ? $list_pagination : ''; ?>    
        </div>
    </div>	
</div>
