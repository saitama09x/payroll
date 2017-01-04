<?php
$this->start('box-title')
?>
<?php echo $this->Html->link('Add', ['action' => 'add'], ['class' => 'btn btn-sm btn-success']) ?>
<?php
$this->end();
?>
<?php
$this->start('content_with_box')
?>
<table class="table">
<thead><tr><th>Id</th><th>ClassRoom</th><th>Date Created</th><th>Action</th></tr></thead>
<tbody>
<?php
foreach($rooms as $room){
	echo "<tr>";
	echo "<td>{$room->id}</td>";
	echo "<td>{$room->name}</td>";
	echo "<td>" . date("Y-m-d", strtotime($room->date_created)) . "</td>";
	echo "<td>" . $this->Html->link('Edit', ['action'=>'edit', $room->id], ['class' => 'btn btn-sm btn-info']) . "</td>";
	echo "</tr>";
}
?>
</tbody>
</table>
<?php
$this->end()
?>