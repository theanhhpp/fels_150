<div class="container">
    <div class="row">
        <dir class="col-sm-3">
            <div class="row">
                <div class="col-sm-5">
                   <p class="image"><img src="uploads/<?= $user['picture_url']; ?> " alt="" width="90" height="90"/></p>
                   <p><?= lang('learned_word'); ?> <?= $this->Learned_Word_Model->total(['user_id' => $this->authentication['id']]) ;?> <?= lang('user_learn'); ?></p>
                </div>
                <div class="col-sm-7">
                    <p><?= $user['first_name']; ?> <?= $user['last_name']?></p>
                    <section class="stats">
                        <div class="stats">
                            <a href= "user/show/<?= $user['id']; ?>/following">
                                <strong id="following" class="stat">
                                <?= $this->Relationship_Model->count_followings($user['id']) ;?>
                                </strong>
                                <?= lang('following'); ?>
                            </a>
                            <a href= "user/show/<?= $user['id']; ?>/followers">
                                <strong id="followers" class="stat">
                                <?= $this->Relationship_Model->count_followers($user['id']) ;?>
                                </strong>
                                <?= lang('followers'); ?>
                            </a>
                        </div>
                    </section>

                    <?php if ($authentication['id'] != $user['id']) { 
                        if ($this->Relationship_Model->is_following($authentication['id'], $user['id'])) { ?>
                            <form action = "relationships/delete" method = "post">
                              <input type="hidden" name="method" value="<?= $user['id']; ?>" />
                              <input type="submit" name="unfollow" value="Unfollow" class="btn" />
                            </form>
                        <?php } else { ?>
                            <form action = "relationships/create" method = "post">
                              <input type="hidden" name="method" value="<?= $user['id'];?>" />
                              <input type="submit" name="follow" value="follow" class="btn btn-primary" />
                            </form>
                        <?php } 
                    } ?>   
                </div>
            </div>
        </dir>
        <div class="col-sm-9" >
            <h2><b><?= lang('result'); ?></b></h2>    
            <?php if (isset($list_result) && count($list_result)) { ?>
                <div id = "content">
                    <?php foreach ($list_result as $key => $value) {
                        $user = $this->User_Model->get(['id' => $value['user_id'] ]); ?>
                        <p><?= $user['first_name']; ?> <?= $user['last_name']; ?> <?= lang('lesson'); ?> : <?= $value['name']; ?> <?= lang('result'); ?> : <?= $value['result']?>
                        (<?= $value['updated_at']?>)</p>
                    <?php } ?>
                    <div class="col-sm-3">
                        <input type="button" class = "btn btn-link" onclick="load_ajax()" value="<?= lang('load_more')?>"/>    
                    </div>     
                    <?php } ?>        
                </div>
        </div>
        <div class="col-sm-9" >
            <?php if (isset($word_same_date) && count($word_same_date)) { ?>
                <div id = "content">
                    <?php foreach ($word_same_date as $key => $value) {?>
                       <p><?= lang('learned_word'); ?> <?= $value['number_word'] ?> <?= lang('user_learn'); ?> <?= lang('on_date'); ?> <?= $value['time']?></p>
                    <?php } ?>                           
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script language="javascript">
    var $page = 1;
    var $id = <?= $user['id']; ?>;
    function load_ajax()
    {   
        $page++
        $.ajax({
            url : "user/getAll", 
            type : "get", 
            dateType:"text", 
            data : { 
                page : $page,
                id : $id,
            },
            success : function (result){
                $('#content').html(result);
            }
        });
    } 
</script>
