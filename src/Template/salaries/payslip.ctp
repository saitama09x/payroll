<?= $this->append('title', 'PaySlip') ?>
<?= $this->start('content_with_box') ?>
<div class="form-group">
<div class='row'>
<form>
<div class='col-md-3'>
<label>Select Employees</label>
<?= $this->Form->select('empid', $emps->toArray(), ['class' => 'form-control']) ?>
</div>
<div class="col-md-2">
<label>&nbsp;</label>
<?= $this->Form->button(__('Select'), ['class' => 'btn btn-sm btn-success form-control', 'id' => 'select']) ?>
</div>
</form>
</div>
</div>
<div class="form-group">
<?php if(!empty($payslip)): ?>
<table class="table">
<thead><tr><th>Date Issued</th><th>Cut-off From</th><th>Cut-off To</th>
<th>Gross</th><th>Deduction</th><th>Allowance</th><th>Net Pay</th><th>Action</th></tr></thead>
<tbody>
<?php foreach($payslip as $row): ?>
<tr>
<td><?= $row->date_created ?></td>
<td><?= $row->cutoff_from ?></td>
<td><?= $row->cutoff_to ?></td>
<td><?= $row->gross_pay ?></td>
<td><?= $row->deductions ?></td>
<td><?= $row->allowances ?></td>
<td><?= $row->net_pay ?></td>
<td><?= $this->Html->link('View', ['action' => 'view', $row->id], ['class' => 'btn btn-sm btn-info']) ?></td>
</tr>
<?php endforeach ?>
</tbody>
</table>
<?php endif; ?>
</div>
<?= $this->end() ?>
