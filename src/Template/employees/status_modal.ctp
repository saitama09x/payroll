<?= $this->assign('modal_id', 'status_modal') ?>
<?= $this->start('modal-body') ?>
<?= $this->Form->input('status', ['label' => 'Status', 'type' => 'select', 'options' => $status->toArray(), 
    'class' => 'form-control']); ?>
<?= $this->end() ?>