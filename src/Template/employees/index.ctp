<?php 
$this->start('box-title')
?>
<?php echo $this->Html->link('Add', ['action' => 'add'], ['class' => 'btn btn-sm btn-info']) ?>
<?php $this->end() ?>

<?php
$this->start('content_with_box');
?>
<br />
<table class="table">
<thead><tr><th>Id</th><th>Full Name</th><th>Birthday</th>
        <th>Gender</th><th>Address</th><th>Status</th><th>Action</th></tr></thead>
<tbody>
<?php
foreach($emps as $emp){
	echo "<tr>";
	echo "<td>$emp->id</td>";
	echo "<td>{$emp->fname} {$emp->lname}</td>";
	echo "<td>$emp->dob</td>";
	echo "<td>{$emp->gender->type}</td>";
	echo "<td>$emp->address</td>";
    echo "<td>{$emp->status->status}</td>";
	echo "<td>".$this->Html->link('View', ['action' => 'view', $emp->id], ['class' => 'btn btn-sm btn-info']). " " . $this->Html->link('Edit', ['action' => 'edit', $emp->id], ['class' => 'btn btn-sm btn-warning']) .' '. $this->Form->postLink('Delete', ['action' => 'delete', $emp->id], ['class' => 'btn btn-sm btn-danger']) ."</td>";
	echo "</tr>";
}
?>
</tbody>
</table>
<?php
$this->end()
?>