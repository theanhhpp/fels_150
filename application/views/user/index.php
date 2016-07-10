<div class="container">
    <h3><b><?= lang('users');?></b></h3>
    <div class="row">
        <div class="col-sm-6">
            <?php
                $message_flashdata = $this->session->flashdata('message_flashdata');
                if(isset($message_flashdata) && count($message_flashdata)) {
                	
                    if($message_flashdata['type'] == 'successful') { ?>
                        <p style="color:#5cb85c;"><?php echo $message_flashdata['message']; ?></p>
                    <?php } else if($message_flashdata['type'] == 'error') { ?>
                        <p style="color:red;"><?php echo $message_flashdata['message']; ?></p>
                    <?php }
                } ?>
            <?php
            $i = 1;
                foreach ($list_user as $key => $value) { ?>
                    <p>
                        <?= $i; ?>. 
                        <a href= "user/show/<?= $value['id']; ?> "><?= $value['first_name']; ?> <?= $value['last_name']; ?></a>
                        <?php if ($authentication['admin'] == 1) { ?>
                            <a class = "delete"  href= "user/delete/<?= $value['id']; ?>"><?= lang('delete'); ?></a>
                        <?php } ?>
                    </p>
                    <?php $i ++;
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= isset($list_pagination) ? $list_pagination : ''; ?>    
        </div>           
    </div>
</div>
