<?php
    if( isset($list_result) && count($list_result)) {
        foreach ($list_result as $key => $value) {
            echo '<p>' . lang('lesson') . ':' . $value['name'] . ' ';
            echo lang('result') . ': ' . $value['result'] . ' (' . $value['updated_at'] .')</p>';
        }	
    }
?>
