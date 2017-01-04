<?= $this->start('title') ?>
<h1>Dashboard</h1>
<?= $this->Flash->render() ?>
<div class="clearfix"></div>
<?= $this->end() ?>
<?php
$this->start('content_no_box');
?>
<div id="bar_chart"></div>
<?php $this->end() ?>
<?= $this->start('box-title') ?>
<?= $this->Html->link('Add Schedule', ['action' => 'add'], ['class' => 'btn btn-md btn-info']) ?>
<?= $this->end() ?>
<?php
$this->start('content_with_box');
?>
<div class="clearfix"></div>
<h4>Scheduling Calendar</h4>
<div class="form-group">
<div id='calendar'></div>
</div>
<?php 
$this->end();
$this->start('js_footer');
?>
<script>
	$(document).ready(function(){
		$.ajax({
            url : "<?php echo $this->Url->build(['controller' => 'dashboard', 'action' => 'ajaxTotalTime']) ?>",
            type : "POST",
            dataType : "JSON",
            success : function(data){                 
                $('#bar_chart').highcharts(data);	
            },
            error : function(xhr, textStatus, errorThrown) {
                alert('An error occurred! ' + textStatus + ' ' + errorThrown);
            }
        }); 

        $.ajax({
            url : "<?= $this->Url->build(['controller' => 'dashboard', 'action' => 'schedulingcalender']) ?>",
            type : "POST",
            dataType : "JSON",
            success : function(data){
                 $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listMonth'
                    },
                    defaultDate: "<?= date("Y-m-d", time()) ?>",
                    navLinks: true, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    events: data,
                    eventRender: function(event, element) { 
                        element.find('.fc-title').html("<br/>Teacher: " + event.title); 
                        element.find('.fc-list-item-title').html("<br/>Teacher: " + event.title); 
                    } 
                });
            }
        });
    });
</script>
<?php 
$this->end();
?>
<?php
$this->start('header_adds')
?>
<?= $this->Html->css('/fullcalendar/fullcalendar.min') ?>
<?= $this->Html->css(['/fullcalendar/fullcalendar.print.min'], ['media' => 'print']) ?>
<?= $this->Html->script('/js/moment') ?>
<?= $this->Html->script('/fullcalendar/fullcalendar.min') ?>
<?= $this->Html->script('/fullcalendar/locale-all') ?>
<?php echo $this->Html->css('/datatables/jquery.dataTables.min.css') ?>
<?php echo $this->Html->script('/datatables/jquery.dataTables.min.js'); ?>
<?php echo $this->Html->script('/highchart/highcharts.js') ?>
<?php echo $this->Html->script('/highchart/themes/dark-blue.js') ?>
<?php $this->end() ?>
