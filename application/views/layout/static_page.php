<?php
    $message_flashdata = $this->session->flashdata('message_flashdata');
    
    if (isset($message_flashdata) && count($message_flashdata)) {
        
        if ($message_flashdata['type'] == 'successful') { ?>
            <p style="color:#5cb85c;"><?= $message_flashdata['message']; ?></p>
        <?php } elseif ($message_flashdata['type'] == 'error') { ?>
            <p style="color:red;"><?= $message_flashdata['message']; ?></p>
        <?php }
    }
?>
<div class="container">
    <div class="row">
        <dir class="col-sm-3">
            <div class="row">
                <div class="col-sm-5">
                    <p class="image"><img src="uploads/<?= $authentication['picture_url']; ?> " alt="" width="90" height="90"/></p>
                    <p>
                        <?= lang('learned_word'); ?> 
                        <?= $this->Learned_Word_Model->total(['user_id' => $this->authentication['id']]) ;?>
                        <?= lang('user_learn'); ?>
                    </p>
                </div>
                <div class="col-sm-7 ">
                    <p><?= $authentication['first_name']; ?> <?= $authentication['last_name']?></p>
                    <section class="stats">
                        <div class="stats">
                            <a href= "user/show/<?= $authentication['id']; ?>/following">
                                <strong id="following" class="stat">
                                <?= $this->Relationship_Model->count_followings($authentication['id']) ;?>
                                </strong>
                                <?= lang('following'); ?>
                            </a>
                            <a href= "user/show/<?= $authentication['id']; ?>/followers">
                                <strong id="followers" class="stat">
                                <?= $this->Relationship_Model->count_followers($authentication['id']) ;?>
                                </strong>
                                <?= lang('followers'); ?>
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </dir>
        <div class="col-sm-9" >
            <h2><b><?= lang('result'); ?></b></h2>    
            <?php if(isset($list_result) && count($list_result)) { ?>
                <div id = "content">  
                    <?php foreach ($list_result as $key => $value) { 
                        $user = $this->User_Model->get([ 'id' => $value['user_id'] ]); ?>
                        <p><?= $user['first_name']; ?> <?= $user['last_name']; ?> <?= lang('lesson'); ?> : <?= $value['name']; ?> <?= lang('result'); ?> : <?= $value['result']?>
                        (<?= $value['updated_at']?>)</p>
                    <?php } ?>        
                </div>
                <div>
                    <?= isset($list_pagination) ? $list_pagination : ''; ?>   
                </div>
            <?php } ?>
        </div>
    </div>
</div>
