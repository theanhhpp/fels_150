<div class="container">
    <h2 class=""><?= lang('title_lesson'); ?></h2>
    <div class="row col-sm-6">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?= lang('number'); ?></th>
                        <th><?= lang('lesson'); ?></th>
                        <th><?= lang('category'); ?></th>
                        <th><?= lang('action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($list_lesson) && count($list_lesson)) {
                        $i = 1;
                        foreach ($list_lesson as $key => $value) { ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value['lesson_name']; ?></td>
                                <td><a href= "category/show/<?= $value['category_id'];?>"><?= $value['category_name']; ?></td>
                                <td><a href= "lesson/show/<?= $value['lesson_id']; ?>" class="btn btn btn-success"><?= lang('start_lesson'); ?></a></td>
                            </tr>
                            <?php $i ++; 
                        }
                    } else {
                        echo '<tr><td colspan="7">' . lang('no_data') . '</td></tr>';    
                    } ?>
                </tbody>
            </table>
        </div>  
        <div>
            <?= isset($list_pagination) ? $list_pagination : ''; ?>    
        </div>
    </div>	
</div>
