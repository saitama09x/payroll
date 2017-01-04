<?= $this->assign('modal_id', 'modal_salary') ?>
<?= $this->start('modal-body') ?>
<?= $this->Form->create(null, ['url' => ['controller' => 'Employees', 'action' => 'addsalary', $id]]) ?>
<div class="form-group">
<?= $this->Form->input('type', array('type'=>'select', 'options'=> $salarytype->toArray(), 'class' => 'form-control')); ?>
</div>
<div class="form-group">
<?= $this->Form->input('amount', array('label' => 'Amount', 'type' => 'text', 'class' => 'form-control')) ?>
</div>
<div class="form-group">
<?= $this->Form->button(__('Add'), ['class' => 'btn btn-md btn-success']); ?>
</div>
<?= $this->Form->end() ?>
<?= $this->end(); ?>