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
                        <th><?= lang('category_id'); ?></th>
                        <th><?= lang('created_at'); ?></th>
                        <th><?= lang('updated_at'); ?></th>
                        <th>ID</th>
                        <th><?= lang('action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($list_word) && count($list_word)) {
                        foreach ($list_word as $key => $value) {
                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class = "ch" name= "checkbox[]" value = "<?= $value['id']; ?>"/>
                                </td>
                                <td><a href="word/show/<?= $value['id']; ?>"><?= $value['content']; ?></a></td>
                                <td><?= $value['category_id']; ?></td>
                                <td><?= $value['created_at']; ?></td>
                                <td><?= $value['updated_at']; ?></td>
                                <td><?= $value['id']; ?></td>
                                <td>
                                    <a href= "word/edit/<?= $value['id'];?>"><?= lang('edit'); ?></a> | 
                                    <a class = "delete"  href= "word/delete/<?= $value['id']; ?>"><?= lang('delete'); ?></a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        echo '<tr><td colspan="7">'. lang('no_data') .'</td></tr>';    
                    }
                    ?>
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
            <?php echo isset($list_pagination) ? $list_pagination : ''; ?>    
        </div>
    </form>	
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".delete").click(function(){
            var r = confirm("Press a button!");
            if (r) {
                return true;
            } else {
                return false;
            } 
        });

        $("#checkAll").change(function () {
            $(".ch").prop('checked', $(this).prop("checked"));
        });
    });
</script>
