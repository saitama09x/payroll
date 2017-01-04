<?= $this->append('title', 'Scheduling Tutorial') ?>
<?= $this->append('box-title', 'Student and Teacher - Status: ' . $this->Cform->schedule_status($tutor->status)) ?>
<?= $this->start('content_with_box') ?>
<div class="form-group">
<?= $this->Html->link('Edit', ['action' => 'edit', $id], ['class' => 'btn btn-sm btn-info']) ?>
&nbsp;
<?= $this->Html->link('Cancel', ['action' => 'cancel', $id], ['class' => 'btn btn-sm btn-danger']) ?>
&nbsp;
<?= $this->Cform->schedule_btn($tutor->status, $id) ?>
</div>
<div class="col-md-offset-2">
<!--first row-->
<div class="row">
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>Teacher Name</h3>
<h4><?= $tutor->emps->fname . " " . $tutor->emps->lname ?></h4>
</div>
</div>

</div>
<div class="col-md-4">
<div class="box box-success">
<div class="form-group text-center">
<h3>Student Name</h3>
<h4><?= $tutor->stud->fname . " " . $tutor->stud->lname ?></h4>
</div>
</div>
</div>
</div>
<!-- end row-->
<!-- second row-->
<div class="row">
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>Assign Date</h3>
<h4><?= $tutor->assign_date ?></h4>
</div>
</div>

</div>
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>Assign Time</h3>
<h4><?= $tutor->assign_time ?></h4>
</div>
</div>

</div>
</div>
<!-- end row-->
<!-- third row-->
<div class="row">
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>Start Date</h3>
<h4><?= $tutor->start_date ?></h4>
</div>
</div>

</div>
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>Start Time</h3>
<h4><?= $tutor->start_time ?></h4>
</div>
</div>

</div>

</div>
<!-- end row-->
<!-- third row-->
<div class="row">
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>End Date</h3>
<h4><?= $tutor->end_date ?></h4>
</div>
</div>

</div>
<div class="col-md-4">

<div class="box box-success">
<div class="form-group text-center">
<h3>End Time</h3>
<h4><?= $tutor->end_time ?></h4>
</div>
</div>

</div>

</div>
<!-- end row-->
<div class="row">
<div class="col-md-8">
<div class="form-group">
<div class="box box-success">
<h3>Student Rating:</h3>
<?= $this->element('dashboard/ratingsview') ?>
</div>
</div>
</div>
</div>
</div>
<?= $this->end() ?>
<?= $this->start('modals') ?>
<?= $this->append('modal_id', "rating_modal") ?>
<?= $this->append('modal-title', 'Rate Your Tutorial Experience') ?>
<?= $this->start('modal-body') ?>
<?= $this->element('dashboard/ratings') ?>
<?= $this->end() ?>
<?= $this->element('modals/modal') ?>
<?= $this->end() ?>