<h2>Danh sách category</h2>
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
<div class="container">
    <div class="row">
        <form method="post" action="">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><div><label><input type = "checkbox" id = "checkAll"></label></div></th>
                            <th><?= lang('category'); ?></th>
                            <th><?= lang('category_name'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($list_category) && count($list_category)) {
                        foreach ($list_category as $key => $value) {
                        ?>
                        <tr>
                            <td><input type="checkbox" class = "ch" name = "checkbox[]" value = "<?php echo $value['id'];?>"/></td>
                            <td><a href = ""> <?php echo $value['id'];?></a></td>
                            <td><a href = ""> <?php echo $value['name'];?></a></td>
                        </tr>
                        <?php
                        }
                    } else {
                       echo '<tr><td colspan="3">' .lang('no_data_message'). ' </td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>  
            <div class="col-sm-3">
                <?php echo isset($list_pagination) ? $list_pagination : ''; ?>    
            </div>
        </form>
    </div>
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
