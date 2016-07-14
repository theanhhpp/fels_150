<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><div><label><input type="checkbox" id="checkAll"></label></div></th>
                <th><?= lang('lesson'); ?></th>
                <th><?= lang('category'); ?></th>
                <th><?= lang('created_at'); ?></th>
                <th><?= lang('updated_at'); ?></th>
                <th>ID</th>
                <th><?= lang('action'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($list_lesson) && count($list_lesson)) {
                foreach ($list_lesson as $key => $value) { ?>
                    <tr>
                        <td>
                            <input type="checkbox" class = "ch" name= "checkbox[]" value = "<?= $value['lesson_id']; ?>"/>
                        </td>
                        <td><a href= "lesson/show/<?= $value['lesson_id'];?>"><?= $value['lesson_name']; ?></a></td>
                        <td><a href= "category/show/<?= $value['category_id'];?>"><?= $value['category_name']; ?></td>
                        <td><?= $value['created_at']; ?></td>
                        <td><?= $value['updated_at']; ?></td>
                        <td><?= $value['lesson_id']; ?></td>
                        <td>
                            <a href= "lesson/edit/<?= $value['lesson_id'];?>"><?= lang('edit'); ?></a> | 
                            <a class = "delete"  href= "lesson/delete/<?= $value['lesson_id']; ?>"><?= lang('delete'); ?></a>
                        </td>
                    </tr>
                <?php } 
            } else {
                echo '<tr><td colspan="4">' . lang('no_data') . '</td></tr>';    
            } ?>
        </tbody>
    </table>
</div>
