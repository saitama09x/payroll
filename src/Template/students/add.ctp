<?php $this->start('content_with_box') ?>
<div class="row">
<div class="col-md-5 col-md-offset-3">
<?= $this->Form->create($student); ?>
<div class="form-group">
<?= $this->Form->input('fname', array('label' => 'First Name', 'div' => false, 'class' => 'form-control')); ?>
</div>
<div class="form-group">
<?= $this->Form->input('lname', array('label' => 'Last Name', 'div' => false, 'class' => 'form-control')); ?>
</div>
<div class="form-group">
<?= $this->Form->input('gender', array('type'=>'select', 'options'=> $gender->toArray(), 'class' => 'form-control')); ?>
</div>
<div class="form-group">
<?=  $this->Form->input('dob', array('label' => 'Date of Birth', 'div' => false, 'class' => 'form-control')); ?>
</div>
<div class="form-group">
<?=  $this->Form->input('address', array('label' => 'Address', 'div' => false, 'class' => 'form-control')); ?>
</div>
<div class="form-group">
<?=  $this->Form->input('school', array('label' => 'School', 'div' => false, 'class' => 'form-control')); ?>
</div>
<div class="form-group">
<?=  $this->Form->button(__('Add'), ['class' => 'btn btn-md btn-success']); ?>
</div>
<?=  $this->Form->end(); ?>
</div>
</div>
<?php $this->end() ?>