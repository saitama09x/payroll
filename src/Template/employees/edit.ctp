<?php $this->start('box-title') ?>
Edit
<?php $this->end() ?>
<?php $this->start('content_with_box') ?>
<?php
    echo $this->Form->create($emp);
    echo $this->Form->input('fname', array('label' => 'First Name', 'div' => false, 'class' => 'form-control'));
    echo $this->Form->input('lname', array('label' => 'Last Name', 'div' => false, 'class' => 'form-control'));

    echo $this->Form->input('gender_id', array('type'=>'select', 'options'=> $gender->toArray(), 'class' => 'form-control'));

    echo $this->Form->input('dob', array('label' => 'Date of Birth', 'div' => false, 'class' => 'form-control', 'type' => 'text'));

    echo $this->Form->input('address', array('label' => 'Address', 'div' => false, 'class' => 'form-control'));
    echo $this->Form->input('position', array('type'=>'select', 'options'=> $pos->toArray(), 'class' => 'form-control'));

    echo "<p></p>";
    echo $this->Form->button(__('Update'), ['class' => 'btn btn-md btn-success']);
    echo $this->Form->end();
?>
<?php $this->end() ?>