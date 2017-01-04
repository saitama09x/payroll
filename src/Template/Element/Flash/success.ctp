<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message success alert alert-success text-center" onclick="this.classList.add('hidden')"><strong><?= $message ?></strong></div>
