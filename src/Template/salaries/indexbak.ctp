<?= $this->start('header_adds') ?>
<?php echo $this->Html->script('/js/moment.js') ?>
<?php echo $this->Html->script('/clockpicker/bootstrap-clockpicker.min.js') ?>
<?php echo $this->Html->script('/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>
<?= $this->end() ?>
<?= $this->start('content_with_box') ?>
<div class="row">
    <div class="col-md-9">
    <?= $this->Form->create(null, ['url' => ['controller' => 'Salaries', 
        'action' => 'payrolllist'], 'class' => 'form-inline']) ?>
    <div class="form-group">    
     <label>From:</label>
        <div class='input-group date datepicker'>
        <input type='text' class="form-control" name="date_from" />
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
</div>
<div class="form-group">
    <label>To:</label>
    <div class='input-group date datepicker'>
    <input type='text' class="form-control" name="date_to" />
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
<div class="form-group">
    <?php if(isset($emps)): ?>
    
    <table class="table table-responsive table-striped">
        <thead>
            <tr><th></th><th></th><th colspan='4' style='text-align:center;'>Totals</th><th></th></tr>
            <tr><th>ID</th><th>Name</th><th>Working HRS</th><th>Late</th><th>OverTime</th>
                <th>UnderTime</th><th>Alowance</th>
                <th>Gross Pay</th><th>Total Deductions</th>
                <th>Net Pay</th><th>Action</th></tr></thead>
        <tbody>
            <?php foreach($emps as $emp): ?>
            <?php if(array_key_exists($emp->id, $total_work)): ?>
            <tr>
                <td><?= $emp->id ?></td>
                <td><?= $emp->fname . " " . $emp->lname ?></td>                
                <td><?= $total_work[$emp->id]['total_work_hr'] . ":" . $total_work[$emp->id]['total_work_mins'] ?></td>
                <td>
                    <?= $total_work[$emp->id]['total_late_hr'] . ":" . $total_work[$emp->id]['total_late_mins'] ?>
                </td>
                <td>
                     <?= $total_work[$emp->id]['total_over_hr'] . ":" . $total_work[$emp->id]['total_over_mins'] ?>
                </td>
                <td>
                    <?= $total_work[$emp->id]['total_under_hr'] . ":" . $total_work[$emp->id]['total_under_mins'] ?>
                </td>
                <td><?php  
                        $total_allowance = 0;
                        foreach($emp->allowance as $amount){
                            $total_allowance += $amount->amount;
                        }                                       
                        echo number_format($total_allowance, 2, ".", ",");
                    ?></td>
                <td>
                    <?= number_format($gross[$emp->id]['salaries'], 2, ".", ",") ?>
                </td>
                <td>
                    <?= number_format($gross[$emp->id]['total_deduction'], 2, ".", ",") ?>
                </td>    
                <td>
                    <?= number_format(($gross[$emp->id]['net_pay'] + $total_allowance), 2, ".", ",") ?>
                </td>
                <td>
                    <?= $this->Form->create(null, ['url' => ['controller' => 'Salaries', 'action' => 'generate_payslip']]) ?>
                        <?= $this->Form->hidden('emp_id', ['value' => $emp->id]) ?>
                        <?= $this->Form->hidden('gross_pay', ['value' => $gross[$emp->id]['salaries']]) ?>
                    <?= $this->Form->end() ?>
                    <?= $this->Html->link('View', ['action' => 'view', $emp->id], ['class' => 'btn btn-sm btn-info']) ?>
                </td>
            </tr>
            <?php 
            endif;
            endforeach; ?>
        </tbody>
    </table>
    
    <?php endif; ?>
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

