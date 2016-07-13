<?php
    if( isset($list_result) && count($list_result)) {
        foreach ($list_result as $key => $value) {
        	echo '<p>' . $user['first_name'];
        	echo ' '. $user['last_name'];
            echo ' '. lang('lesson') . ' : ' . $value['name'] . ' ';
            echo lang('result') . ' : ' . $value['result'] . ' (' . $value['updated_at'] .')</p>';
        }	
    }

    if ($total > count($list_result)) { ?>
    	<div class="col-sm-3">
		    <input type="button" class = "btn btn-link" onclick="load_ajax()" value="<?= lang('load_more')?>"/>    
		</div> 
    <?php }
?>
