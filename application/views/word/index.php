<h2 class=""><?= lang('title_word'); ?></h2>
<?php
    $message_flashdata = $this->session->flashdata('message_flashdata');;

    if(isset($message_flashdata) && count($message_flashdata)) {

        if($message_flashdata['type'] == 'successful') {
        ?>
            <p style="color:#5cb85c;"><?php echo $message_flashdata['message'];?></p>
            <?php
        } else if($message_flashdata['type'] == 'error') {
        ?>
            <p style="color:red;"><?php echo $message_flashdata['message'];?></p>
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
                        <th><?= lang('content_word'); ?></th>
                        <th><?= lang('category'); ?></th>
                        <th><?= lang('created_at'); ?></th>
                        <th><?= lang('updated_at'); ?></th>
                        <th>ID</th>
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
                                <td><a href="category/show/<?= $value['word_id']; ?>"><?= $value['category_name']; ?></td>
                                <td><?= $value['created_at']; ?></td>
                                <td><?= $value['updated_at']; ?></td>
                                <td><?= $value['word_id']; ?></td>
                                <td>
                                    <a href= "word/edit/<?= $value['word_id'];?>"><?= lang('edit'); ?></a> | 
                                    <a class = "delete"  href= "word/delete/<?= $value['word_id']; ?>"><?= lang('delete'); ?></a>
                                </td>
                            </tr>
                        <?php }
                    } else {
                        echo '<tr><td colspan="7">'. lang('no_data') .'</td></tr>';    
                    } ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-2" style="padding-left:0px;">
            <a href="word/add" class="btn btn-default"><?= lang('title_add_word'); ?></a>
        </div>
        <div class="col-sm-7">
            <input type="submit" class="btn btn-default delete" name="delete_more" value="<?= lang('delete'); ?>" /> 		
        </div>   
        <div class="col-sm-3">
            <?= isset($list_pagination) ? $list_pagination : ''; ?>    
        </div>
    </form>	
</div>
