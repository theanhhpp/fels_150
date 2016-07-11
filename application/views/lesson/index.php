<h2 class=""><?= lang('title_lesson'); ?></h2>
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
<div class="container row">
    <form method="post" action="">
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
                        echo '<tr><td colspan="7">' . lang('no_data') . '</td></tr>';    
                    } ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-2" style="padding-left:0px;">
            <a href="lesson/add" class="btn btn-default"><?= lang('title_add_lesson'); ?></a>
        </div>
        <div class="col-sm-5">
            <input type="submit" class="btn btn-default delete" name="delete_more" value="<?= lang('delete'); ?>" /> 		
        </div>   
        <div class="col-sm-3">
            <?= isset($list_pagination) ? $list_pagination : ''; ?>    
        </div>
    </form>	
</div>
