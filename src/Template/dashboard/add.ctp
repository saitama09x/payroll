<?= $this->start('title') ?>
<h1>Schedule Tutorial</h1>
<?= $this->end() ?>
<?= $this->start('box-title') ?>
<h3 class="box-title">Add Schedule</h3>
<?= $this->end() ?>
<?= $this->start('header_adds') ?>
<?php echo $this->Html->css('/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>
<?php echo $this->Html->css('/clockpicker/bootstrap-clockpicker.min.css') ?>
<?php echo $this->Html->script('/js/moment.js') ?>
<?php echo $this->Html->script('/clockpicker/bootstrap-clockpicker.min.js') ?>
<?php echo $this->Html->script('/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>
<?= $this->end() ?>

<?= $this->start('content_with_box') ?>
<?= $this->Flash->render() ?>
<?= $this->Form->create($tutor, ['templates' => ['formGroup' => '{{input}}', 'inputContainer' => '{{content}}']]) ?>
<div class="col-md-offset-2">
<div class="row">
<div class="col-md-8">
<div class="form-group">
<h3>Subject</h3>
<?= $this->Form->input('subject', ['class' => 'form-control', 'type' => 'text', 'label' => false]) ?>
</div>
</div>
</div>
<!--first row-->
<div class="row">
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>Teacher Name</h3>
<?= $this->Form->select('emp_id', $teacher->toArray(), ['class' => 'form-control']) ?>
</div>
</div>

</div>
<div class="col-md-4">
<div class="box box-success">
<div class="form-group text-center">
<h3>Student Name</h3>
<?= $this->Form->select('stud_id', $student->toArray(), ['class' => 'form-control']) ?>
</div>
</div>
</div>
</div>
<!-- end row-->
<!-- second row-->
<div class="row">
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>Assign Date</h3>
<div class='input-group date datepicker' id='datepicker'>
<?= $this->Form->input('assign_date', ['class' => 'form-control', 'type' => 'text', 'value' => false]) ?>
<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
</span>
</div>
</div>
</div>

</div>
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>Assign Time</h3>
<div class='input-group date timepicker' id='timepicker'>
<?= $this->Form->input('assign_time', ['class' => 'form-control', 'type' => 'text', 'value' => false]) ?>
<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span>
</span>
</div>
</div>
</div>

</div>
</div>
<!-- end row-->
<div class="row">
<div class="col-md-4">
<div class="box box-success">
<h3>Choose Room</h3>
<?= $this->Form->select('room_id', $room->toArray(), ['class' => 'form-control']) ?>
</div>
</div>
</div>

<div class="row">
<div class="col-md-8">
<div class="form-group">
<div class="box box-success">
&nbsp;
<?= $this->Form->button(__('Save'), ['class' => 'btn btn-sm btn-success form-control']) ?>
</div>
</div>
</div>
</div>
<?= $this->Form->end() ?>
<?= $this->end() ?>
<?= $this->start('js_footer') ?>
<script>
$(document).ready(function() {
$('#datepicker').datetimepicker({
				 format: 'YYYY-MM-DD'
			});

$('#timepicker').clockpicker({
				placement: 'top',
			    align: 'left',
			    donetext: 'Done'
			});
});
</script>
<?= $this->end() ?>