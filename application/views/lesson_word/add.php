<div class="container row">
    <div class="col-sm-4">          
        <h2><b><?= lang('lesson'); ?> <?= $lesson['name']; ?></b></h2>
        <h4><?= lang('category'); ?> : <?= $category['name']; ?></h4>
        <a href="lesson/show/<?= $lesson['id']; ?>" class="btn btn-default"><?= lang('back'); ?></a>    
    </div>
    <div class="col-sm-8">
        <h3><b><?= lang('title_word'); ?></b></h3>
        <div class="table-responsive">
            <form method="post" action="">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><div><label><input type="checkbox" id="checkAll"></label></div></th>
                            <th><?= lang('word'); ?></th>
                            <th><?= lang('category'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($list_word) && count($list_word)) {
                            foreach ($list_word as $key => $value) { ?>
                                <tr class = "category-<?= $value['category_id']; ?>">
                                    <td>
                                    <input type="checkbox" class = "ch" name= "checkbox[]" value = "<?= $value['word_id']; ?>"/>
                                    </td>
                                    <td><a href="word/show/<?= $value['word_id']; ?>"><?= $value['content']; ?></a></td>
                                    <td><?= $value['category_name']; ?></td>
                                </tr>
                            <?php }
                        } else {
                        echo '<tr><td colspan="7">'. lang('no_data') .'</td></tr>';    
                        } ?>
                    </tbody>
                </table>
                <input type="submit" class="btn btn-default" value="<?= lang('title_add_word'); ?>" name = "add_word" />
            </form> 
        </div>
    </div>
</div>
