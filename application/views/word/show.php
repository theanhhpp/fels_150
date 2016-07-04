<?php if (isset($word_answer) && count($word_answer)) { ?>
    <p><?= $word['content'] .' : '. $word_answer[0]['content']; ?></p>
<?php } else { ?>
    <p><?= $word['content']; ?>
<?php } ?>
