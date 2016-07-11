<div class="container">
    <div class="row">
        <dir class="col-sm-3">
            <div class="row">
                <div class="col-sm-6">
                    <p>ảnh</p>
                </div>
                <div class="col-sm-6">
                    <p><?= $user['first_name']; ?> <?= $user['last_name']?></p>
                </div>
            </div>
        </dir>
        <div class="col-sm-9" >
            <h2><b><?= lang('result'); ?></b></h2>    
            <?php if(isset($list_result) && count($list_result)) { ?>
                <div id = "content">  
                    <?php foreach ($list_result as $key => $value) { ?>
                        <p><?= lang('lesson'); ?> : <?= $value['name']; ?> <?= lang('result'); ?> : <?= $value['result']?>
                        (<?= $value['updated_at']?>)</p>
                    <?php } ?>        
                </div>
                <div class="col-sm-3">
                    <input type="button" class = "btn btn-link"onclick="load_ajax()" value="<?= lang('load_more')?>"/>    
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
