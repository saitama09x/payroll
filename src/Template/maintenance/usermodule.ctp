<?= $this->append('box-title', 'User Module') ?>
<?= $this->start('content_with_box') ?>
<div class="form-group">
<?= $this->Form->create(null, ['url' => ['action' => 'addusermodule']]) ?>
<div class="row">
<div class="col-md-3">
<label>User</label>
<?= $this->Form->select('emp_id', $emps->toArray(), ['class' => 'form-control']) ?>
</div>
<div class="col-md-3">
<label>Modules</label>
<?= $this->Form->select('modcode', $mod_arr, ['class' => 'form-control']) ?>
</div>
<div class="col-md-2">
<label>&nbsp;</label>
<?= $this->Form->button(__('Add Module'), ['class' => 'btn btn-sm btn-success form-control']) ?>	
</div>
</div>
<?= $this->Form->end() ?>
</div>
<div class="form-group">
<table class="table">
<thead><tr><th>Users</th><th>Modules</th></tr></thead>
<?php foreach($usermod as $row): ?>
<tr>
<td>
<?= $row->fname . " " . $row->lname ?>
</td>
<td>
<table class="table">
<?php foreach($row->usermod as $mod): ?>
<tr>
<td>
<?= $mod->mod->modname ?>
</td>
<td>
<?= $this->Form->postLink('Delete', ['action' => 'deletemod', $mod->id], ['class' => 'btn btn-sm btn-danger']) ?>
</td>
</tr>
<?php endforeach ?>	
</table>
</td>
</tr>
<?php endforeach ?>
</table>
</div>
<?= $this->end() ?>