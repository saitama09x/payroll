<?= $this->assign('modal_id', 'allowance') ?>
<?= $this->start('modal-body') ?>
<?= $this->Form->create(null, ['url' => ['controller' => 'Employees', 'action' => 'addallowance', $id]]) ?>
<div class="form-group">
<?= $this->Form->input('details', array('label' => 'Details', 'type' => 'text', 'class' => 'form-control') ); ?>
</div>
<div class="form-group">
<?= $this->Form->input('amount', array('label' => 'Amount', 'type' => 'text', 'class' => 'form-control') ); ?>
</div>
<div class="form-group">
<?= $this->Form->hidden('id') ?>
<?= $this->Form->button(__('Add'), ['class' => 'btn btn-md btn-success']); ?>
</div>
<?= $this->Form->end() ?>
<?= $this->end(); ?>
