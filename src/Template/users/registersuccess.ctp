<?php $this->start("title") ?>
Successfully Created<br />
<small style="font-size:20px;">return to login page <?= $this->Html->link('click here', ['action' => 'login'], ['style' => 'color:red;']) ?></small>
<?php $this->end() ?>
<?php $this->start('page'); ?>
<div class="form-group text-center">
    <label>First Name</label>
    <h4><?= $emp->fname ?></h4>
</div>
<hr />
<div class="form-group text-center">
    <label>last Name</label>
    <h4> <?= $emp->lname ?></h4>
</div>
<hr />
<div class="form-group text-center">
    <label>Birthday</label>
    <h4> <?= $emp->dob ?></h4>
</div>
<hr />
<div class="form-group text-center">
    <label>Gender</label>
    <h4> <?= $emp->gender->type ?></h4>
</div>
<hr />
<div class="form-group text-center">
    <label>Address</label>
    <h4> <?= $emp->address ?></h4>
</div>
<hr />
<div class="form-group text-center">
    <label>Position</label>
    <h4> <?= $emp->position->name ?></h4>
</div>
<hr />
<div class="form-group text-center">
    <label>Username</label>
    <h4> <?= $emp->user->username ?></h4>
</div>
<hr />
<div class="form-group text-center">
    <label>Password</label>
    <h4>**************</h4>
</div>
<?= $this->end() ?>
