<?= $this->start('header_adds') ?>
<?php echo $this->Html->css('/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>
<?php echo $this->Html->css('/clockpicker/bootstrap-clockpicker.min.css') ?>
<?php echo $this->Html->script('/js/moment.js') ?>
<?php echo $this->Html->script('/clockpicker/bootstrap-clockpicker.min.js') ?>
<?php echo $this->Html->script('/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>
<?= $this->end() ?>
<?php $this->start("title") ?>
<a href="#">Register</a>
<?php $this->end() ?>
<?php $this->start('page'); ?>
    <?= $this->Form->create($emp); ?>
        <div class="form-group">
             <?= $this->Form->input('fname', ['label' => 'First Name', 'div' => false, 'class' => 'form-control'])   ?>
        </div>
        <div class="form-group">
             <?= $this->Form->input('lname', ['label' => 'Last Name', 'div' => false, 'class' => 'form-control'])   ?>
        </div><div class="form-group">
        <label>Birthday</label>
            <div class='input-group date' id='datepicker'>
            <input type='text' class="form-control" name="dob" />
            <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
            </span>
            </div>
        </div>
        
        <div class="form-group">
             <?= $this->Form->input('gender_id', ['label' => 'Gender', 'div' => false, 'type' => 'select', 
                 'options' => $gender->toArray(), 'class' => 'form-control'])   ?>
        </div>
        <div class="form-group">
             <?= $this->Form->input('address', ['label' => 'Address', 'div' => false, 'class' => 'form-control'])   ?>
        </div>
        <div class="form-group">
             <?= $this->Form->input('position_id', ['label' => 'Position', 'type' => 'select', 
                 'options' => $pos->toArray(), 'class' => 'form-control']) ?>
        </div>
        <div class="form-group">
             <?= $this->Form->input('username', ['label' => 'Username', 'type' => 'text', 
                 'class' => 'form-control']) ?>
        </div>
        <div class="form-group">
             <?= $this->Form->input('password', ['label' => 'Password', 'type' => 'password', 
                 'class' => 'form-control']) ?>
        </div>
        <div class="form-group">
             <?= $this->Form->button(__('Submit'), ['div' => false, 'class' => 'btn btn-md btn-success']);   ?>
        </div>
    <?= $this->Form->end() ?>
<?php $this->end() ?>
<?= $this->start('js_footer') ?>
<script>
$(document).ready(function() {
$('#datepicker').datetimepicker({
                 format: 'YYYY-MM-DD'
            });
});
</script>
<?= $this->end() ?>

