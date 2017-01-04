<?= $this->assign('modal_id', 'modal') ?>
<?= $this->start('modal-body') ?>
<?= $this->Form->create($deductionform, ['url'=>['action' => 'submitdeduction', $id]]); ?>
<div class="form-group">
<?= $this->Form->input('deduction_id', array('type'=>'select', 'options'=> $deductionlist->toArray(), 'class' => 'form-control')); ?>
</div>
<div class="form-group">
<?= $this->Form->input('details', array('label' => 'Details', 'type' => 'text', 'class' => 'form-control') ); ?>
</div>
<div class="form-group">
<?= $this->Form->input('percentage', array('label' => 'Percentage', 'type' => 'text', 'class' => 'form-control') ); ?>
</div>
<div class="form-group">
<?= $this->Form->button(__('Add'), ['class' => 'btn btn-md btn-success']); ?>
</div>
<?= $this->Form->end() ?>
<?= $this->end() ?>