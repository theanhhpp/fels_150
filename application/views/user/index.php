<?php
    $message_flashdata = $this->session->flashdata('message_flashdata');
    
    if (isset($message_flashdata) && count($message_flashdata)) {
        
        if ($message_flashdata['type'] == 'seccessful') {
        ?>
            <p style="color:#5cb85c;"><?= $message_flashdata['message']; ?></p>
            <?php
        } elseif ($message_flashdata['type'] == 'error') {
        ?>
            <p style="color:red;"><?= $message_flashdata['message']; ?></p>
        <?php
        }
    }
?>
