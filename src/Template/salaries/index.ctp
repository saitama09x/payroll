<?= $this->start('header_adds') ?>
<?php echo $this->Html->script('/js/moment.js') ?>
<?php echo $this->Html->script('/clockpicker/bootstrap-clockpicker.min.js') ?>
<?php echo $this->Html->script('/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>
<?= $this->end() ?>
<?= $this->start('content_with_box') ?>
<div class="row">
    <div class="col-md-9">
    <?= $this->Form->create(null, ['url' => ['controller' => 'Salaries', 
        'action' => 'date'], 'class' => 'form-inline', 'type' => 'GET']) ?>
    <div class="form-group">    
     <label>From:</label>
        <div class='input-group date datepicker'>
        <input type='text' class="form-control" name="from" />
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
</div>
<div class="form-group">
    <label>To:</label>
    <div class='input-group date datepicker'>
    <input type='text' class="form-control" name="to" />
    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
    </span>
    </div>
</div>
<div class="form-group">
    <label>&nbsp;</label>
    <?= $this->Form->button(__('Create'), ['class' => 'btn btn-md btn-success']); ?>
</div>
    <?= $this->Form->end() ?>
     </div>
</div>

    <?= $this->start('js_footer') ?>
        <script type="text/javascript">     
        $(document).ready(function() {
            $('.datepicker').datetimepicker({
                format : 'YYYY-MM-DD'
            });
        });
        </script>
    <?= $this->end() ?>
</div>
<?= $this->end() ?>

