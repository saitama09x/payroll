<?php $this->start('content_with_box') ?>
<?php
    echo $this->Form->create($student);
    echo $this->Form->input('fname', array('label' => 'First Name', 'div' => false, 'class' => 'form-control'));
    echo $this->Form->input('lname', array('label' => 'Last Name', 'div' => false, 'class' => 'form-control'));

    echo $this->Form->input('gender_id', array('type'=>'select', 'options'=> $gender->toArray(), 'class' => 'form-control'));

    echo $this->Form->input('dob', array('label' => 'Date of Birth', 'div' => false, 'class' => 'form-control'));
    echo $this->Form->input('address', array('label' => 'Address', 'div' => false, 'class' => 'form-control'));
    echo $this->Form->input('school', array('label' => 'School', 'div' => false, 'class' => 'form-control'));
    echo "<p></p>";
    echo $this->Form->button(__('Edit'), ['class' => 'btn btn-md btn-success']);
    echo $this->Form->end();
?>
<?php $this->end() ?>