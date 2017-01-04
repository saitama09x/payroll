<?= $this->start('content_with_box'); ?>
<?php
    echo $this->Form->create($room);
    echo $this->Form->input('name', array('label' => 'Room Name', 'div' => false, 'class' => 'form-control'));
    echo $this->Form->button(__('Add'), ['class' => 'btn btn-md btn-success']);
    echo $this->Form->end();
?>

<?= $this->end(); ?>