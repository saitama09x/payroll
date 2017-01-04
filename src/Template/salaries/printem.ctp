<?php echo $this->Html->css('/bootstrap/css/bootstrap.min.css'); ?>
<style>
body{
	font-size:12px;
}
table td{
	font-size:12px;
}
</style>
<div class="form-group">
<h4>Employee Name: <?= $payslip->employee->fname . " " . $payslip->employee->lname ?></h4>
</div>
<div class="form-group">
<h4>Cut off from: <?= $payslip->cutoff_from ?></h4>
<h4>Cut off to: <?= $payslip->cutoff_to ?></h4>
</div>
<div class="form-group">
<div class="row">
<div class="col-md-3">Basic Compensation</div>
<div class="col-md-3">
<p><?= $payslip->gross_pay ?></p>
</div>
</div>

<div class="form-group">Absences</div>
<h4>Less:</h4>
<div class="form-group">
<div class="row">
<div class="col-md-4 col-md-offset-1">
<table class="table">
<?php foreach($payslip->deduct as $row): ?>
<tr>
<td><?= $row->names->name ?></td>
<td><?= $row->percentage * $payslip->gross_pay ?></td>
</tr>
<?php endforeach ?>
</table>
</div>
</div>
</div>

<div class="form-group">
<h4>Adds:</h4>
Allowances and Deminimis benefits
<div class="row">
<div class="col-md-4 col-md-offset-1">
<table class="table">
<?php foreach($payslip->allowance as $row): ?>
<tr>
<td><?= $row->details ?></td>
<td><?= $row->amount ?></td>
</tr>
<?php endforeach ?>
</table>
</div>
</div>
</div>

<div class="row">
<div class="col-md-2 col-md-offset-2">
<div class="pull-left">
<h3>Net Pay:</h3>			
</div>
<div class="pull-right" style="margin-right: 10px;">
<h3><?= $payslip->net_pay ?></h3>	
</div>
<div class="clearfix"></div>
</div>								
</div>

</div>