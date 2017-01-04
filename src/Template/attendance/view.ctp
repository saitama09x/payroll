<?= $this->start('box-title') ?>
Overview
<?= $this->end() ?>
<?= $this->start('content_with_box') ?>
<div class="form-group">
<h3>Employee Name: <?= strtoupper($attend->employee->fname) . " " . strtoupper($attend->employee->lname)?></h3>
<h3>Status: <?= $attend->employee->status->status ?></h3>
</div>
<div class="form-group">
<div class="row">
<div class="col-md-3">
<h3>Time In: <?= date("h:i a", strtotime($attend->start_time)) ?></h3>
<img src="<?= $attend->attendance_start_pic ?>" width="200px" />
</div>
<div class="col-md-3">
<h3>Time Out: <?= date("h:i a", strtotime($attend->start_time)) ?></h3>
<img src="<?= $attend->attendance_end_pic ?>" width="200px" />
</div>
<div class="col-md-5">
<table class="table">
<thead><tr><th><h3>Late</h3></th><th><h3>Undertime</h3></th><th><h3>Overtime</h3></th></tr></thead>
<tbody>
<tr>
	<?php
		$shifting_start = date_create(date('H:i:s', strtotime($attend->shifting->start_time)));
		$shifting_end = date_create(date('H:i:s', strtotime($attend->shifting->end_time)));
		$start_time = date_create(date('H:i:s', strtotime($attend->start_time)));
		$end_time = date_create(date('H:i:s', strtotime($attend->end_time)));
	?>
	<td><h3><?= date_diff($shifting_start, $start_time)->format("%h:%i:%s") ?></h3></td>
	<td><h3><?= date_diff($shifting_end, $end_time)->format("%h:%i:%s")  ?></h3></td>
	<td><h3><?= date_diff($end_time, $shifting_end)->format("%h:%i:%s")  ?></h3></td>	
</tr>
</tbody>
</table>
</div>
</div>
</div>
<?= $this->end() ?>