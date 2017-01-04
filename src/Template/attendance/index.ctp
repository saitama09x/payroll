<?= $this->start('header_adds') ?>
<?php echo $this->Html->css('/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>
<?php echo $this->Html->css('/clockpicker/bootstrap-clockpicker.min.css') ?>
<?php echo $this->Html->script('/js/moment.js') ?>
<?php echo $this->Html->script('/clockpicker/bootstrap-clockpicker.min.js') ?>
<?php echo $this->Html->script('/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>
<?= $this->end() ?>

<?= $this->start('content_with_box') ?>
<?= $this->Form->create(null, ['templates' => ['formGroup' => '{{input}}', 'inputContainer' => '{{content}}'], 'type' => 'GET', 'hiddenField' => false]) ?>
<div class="form-group">
<div class="row">
<div class="col-md-2">
<label>Date From:</label>
<div class='input-group date datepicker' id='datepicker'>
<?= $this->Form->input('from', ['class' => 'form-control', 'type' => 'text', 'value' => false]) ?>
<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
</span>
</div>
</div>

<div class="col-md-2">
<label>Date To:</label>
<div class='input-group date datepicker' id='datepicker'>
<?= $this->Form->input('to', ['class' => 'form-control', 'type' => 'text', 'value' => false]) ?>
<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
</span>
</div>
</div>
<div class="col-md-2">
<label>&nbsp;</label>
<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-success form-control']) ?>
</div>
</div>
</div>
<?= $this->Form->end() ?>
<table class="table">
<thead><tr>
<th>Employee Name</th>
<th>Date</th>
<th>Time In</th>
<th>Time In Pic.</th>
<th>Time Out</th>
<th>Time Out Pic.</th>
<th>Late</th>
<th>OverTime</th>
<th>UnderTime</th>
<th>Action</th>
</tr></thead>
<tbody>
<?php
foreach($attend as $row) :
?>
<tr>
	<td><?= $row->employee->fname ?> <?= $row->employee->lname ?></td>
	<td><?= date('Y-m-d', strtotime($row->date_created)) ?></td>
	<td><?= date('H:i:s', strtotime($row->start_time)) ?></td>
	<td><img src="<?= $row->attendance_start_pic ?>" width="70px" /></td>
	<td><?= date('H:i:s', strtotime($row->end_time)) ?></td>
	<td><img src="<?= $row->attendance_end_pic ?>" width="70px" /></td>
	<?php
		$shifting_start = date_create(date('H:i:s', strtotime($row->shifting->start_time)));
		$shifting_end = date_create(date('H:i:s', strtotime($row->shifting->end_time)));
		$start_time = date_create(date('H:i:s', strtotime($row->start_time)));
		$end_time = date_create(date('H:i:s', strtotime($row->end_time)));
	?>
	<td><?= date_diff($shifting_start, $start_time)->format("%h:%i:%s") ?></td>
	<td><?= date_diff($shifting_end, $end_time)->format("%h:%i:%s")  ?></td>
	<td><?= date_diff($end_time, $shifting_end)->format("%h:%i:%s")  ?></td>
	<td><?= $this->Html->link('View', ['action' => 'view', $row->id], ['class' => 'btn btn-sm btn-info']) ?></td>
</tr>
<?php
endforeach;
?>
</tbody>
</table>
<?= $this->end() ?>
<?= $this->start('js_footer') ?>
<script>
$(document).ready(function() {
$('.datepicker').datetimepicker({
				 format: 'YYYY-MM-DD'
			});
});
</script>
<?= $this->end() ?>