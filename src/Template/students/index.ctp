<?php $this->start('box-title') ?>
<?php echo $this->Html->link('Add', ['controller' => 'students', 'action' => 'add'], ['class' => 'btn btn-md btn-success']); ?>
<?php $this->end() ?>
<?php
$this->start('content_with_box');
?>
<table class="table">
<thead><tr><th>Student Name</th><th>gender</th><th>Birthday</th>
<th>Address</th><th>School</th><th>Date Created</th><th>Action</th></tr></thead>
<tbody>
<?php 		
	foreach($stud as $a){
		echo "<tr>";
		echo "<td>{$a->fname} {$a->lname}</td>";
		echo "<td>{$a->gender->type}</td>";
		echo "<td>$a->dob</td>";
		echo "<td>$a->address</td>";
		echo "<td>$a->school</td>";
		echo "<td>" . date('Y-m-d', strtotime($a->date_created)) . "</td>";		
		echo "<td>" . $this->Html->link('Edit', ['action' => 'edit', $a->id], ['class' => 'btn btn-sm btn-info']) . " " . $this->Form->postLink('Delete', ['action' => 'delete', $a->id], ['class' => 'btn btn-sm btn-danger']) . "</td>";
		echo "</tr>";
	}	
?>
</tbody>
</table>
<?php
$this->end();
?>