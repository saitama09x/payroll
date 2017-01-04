<?= $this->start('box-title') ?>
<div class="clearfix"></div>
<div class="pull-right">
    <?= $this->Form->create(null, ['url' => ['controller' => 'Salaries', 
        'action' => "date?from={$from}&to={$to}",], 'class' => 'form-inline']) ?>     
     <?= $this->Form->select('emps', $emps->toArray(), ['class' => 'form-control']) ?>     
    <label>&nbsp;</label>
    <?= $this->Form->button(__('Generate'), ['class' => 'btn btn-md btn-success']); ?>
    <?= $this->Form->end() ?>     
</div>
<div class="clearfix"></div>
<?= $this->end() ?>
<?= $this->start('content_with_box') ?>
<div class="form-group">
<h4>Employee Name: <?= $emp_name ?></h4>
</div>
<div class="form-group">
<table class="table">
<thead><tr><th>Total Working Hrs</th><th>Gross Pay</th>
<th>Deductions</th><th>Net Pay</th><th>Allowance</th><th>Action</th></tr></thead>
<tbody>
<?php if($gross): ?>
<tr><td><?= $total_work ?></td><td><?= $gross ?></td><td>
  <?php foreach($deductpercent as $row)  {
        echo $row->names->name . ": " . $row->percentage * $gross . "<br />";
  }
?>
</td>
<td><?= $net ?></td>
<td><?= $allowance ?></td>
<td>
<form method="post">
<input type="hidden" name="emps" value="<?= $emp_id ?>" />
<input type="hidden" name="print" value="1" />
<?= $this->Form->button('Save', ['class' => 'btn btn-sm btn-info']) ?>
</form>
</td>
</tr>
<?php endif; ?>
</tbody>
</table>
<table class="table">
<thead><tr><th>Date</th><th>Check In</th><th>Picture</th><th>Check Out</th><th>Picture</th><th>Total Working Hrs</th><th>Late</th><th>OverTime</th><th>UnderTime</th></tr></thead>
<tbody>
<?php
	if(!empty($log_arr)):
		foreach($log_arr as $row):
?>	

<tr>
<td><?= $row->date ?></td>
<td><?= $row->check_in ?></td>
<td><img src="<?= $row->start_pic ?>" width="100px"/></td>
<td><?= $row->check_out ?></td>
<td><img src="<?= $row->end_pic ?>" width="100px"/></td>
<td><?= $row->work_hr ?></td>
<td><?= $row->late ?></td>
<td><?= $row->overtime ?></td>
<td><?= $row->undertime ?></td>
</tr>

<?php endforeach; endif; ?>
</tbody></table>
</div>
<?= $this->end() ?>