<?= $this->start('box-title') ?>
<div class="clearfix"></div>
<h2 class='box-title pull-left'>View</h2>
<h2 class="box-title pull-right"><small><a href="#" data-toggle="modal" data-target="#status_modal">Change</a></small>&nbsp;Status: <?= $emp->status->status ?></h2>
<div class="clearfix"></div>
<?= $this->end() ?>
<?php $this->start('content_with_box') ?>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<h4  class="control-label"><u>First Name</u></h4>
<h3>
<?= strtoupper($emp->fname) ?>
</h3>
</div>
<div class="form-group">
<h4 class="control-label"><u>Last Name</u></h4>
<h3><?= strtoupper($emp->lname) ?></h3>
</div>
<div class="form-group">
<h4 class="control-label"><u>Birthday</u></h4>
<h3><?= date('M d, Y', strtotime($emp->dob)) ?></h3>
</div>
<div class="form-group">
<h4 class="control-label"><u>Gender</u></h4>
<h3><?= $emp->gender->type ?></h3>
</div>
<div class="form-group">
<h4 class="control-label"><u>Position</u></h4>
<h3><?= $emp->position->name ?></h3>
</div>
</div>
<div class="col-md-5">
<div class="form-group">
    <div class="row">
    <h4><u class="col-md-9">Salary:</u></h4><a href="#" class="btn btn-sm btn-info col-md-2" data-target="#modal_salary" data-toggle="modal">Add</a>
    </div>
    <table class="table table-condensed table-responsive">
        <thead><tr><th>Type</th><th>Amount</th><th>Date Created</th><th>Action</th></tr></thead>
        <tbody>
            <?php foreach($salary as $row): ?>
            <tr>
                <td><?= $row->saltype->name ?></td>
                <td><?= $row->amount ?></td>
                <td><?= date('Y-m-d', strtotime($row->date_created)) ?></td>
                <td><?= $this->Form->postLink('Delete', ['action' => 'deletesalary', $row->id, $id], ['class' => 'btn btn-sm btn-danger']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
   </table>
</div>
<div class="form-group">
<div class="row">
<h4 class="col-md-9"><u>Deductions</u></h4><a href="#" class="btn btn-sm btn-info col-md-2" data-target="#modal" data-toggle="modal">Add</a>
</div>
<table class="table table-condensed table-responsive">
<thead><tr><th>Names</th><th>Details</th><th>Percentage</th><th>Action</th></tr></thead>
<tbody>
<?php foreach($percent as $row): ?>
<tr>
<td><?= $row->name ?></td>
<?php if(isset($row->deduction->details)): ?>
<td><?= $row->deduction->details ?></td>
<?php else: ?>
<td></td>
<?php endif; ?>
<?php if(isset($row->deduction->percentage)): ?>
<td><?= $row->deduction->percentage * 100 ."%" ?></td>
<td><?= $this->Form->postLink('Delete', ['action' => 'deletededuction', $row->deduction->id, $row->deduction->emp_id], ['class' => 'btn btn-sm btn-danger']) ?></td>
<?php else: ?>
<td></td>
<td></td>
<?php endif; ?>
</tr>
<?php endforeach ?>
</tbody>
</table>
</div>
<div class="form-group">
<div class="row">
<h4 class="col-md-9"><u>Allowances</u></h4><a href="#" class="btn btn-sm btn-info col-md-2"  data-target="#allowance" data-toggle="modal">Add</a>
</div>
<table class="table table-condensed table-responsive">
<thead><tr><th style="width:200px;">Names</th><th style="width:150px;">Amount</th><th>Action</th></tr></thead>
<tbody>
    <?php foreach($allowance as $row): ?>
    <tr>
        <td><?= $row->details ?></td>
        <td><?= $row->amount ?></td>
        <td><?= $this->Form->postLink('delete', ['action' => 'deleteallowance', $row->id, $id], ['class' => 'btn btn-sm btn-danger']) ?></td>
    </tr>
    <?php endforeach ?>
</tbody>
</table>
</div>
</div>
<div class="col-md-3 col-md-offset-1"> 
<label>Profile Picture</label><br />
<?php if($emp->pro_pic != null): ?>
<?= $this->Html->image($emp->pro_pic, ['alt' => 'avatar', 'width' => '170px']); ?><br />
<?php else: ?>
<?= $this->Html->image('avatar.png', ['alt' => 'avatar', 'width' => '170px']); ?><br />
<?php endif; ?>
<br />
<a href="javascript:;" data-toggle="modal" data-target="#modal_pic" class="btn btn-sm btn-success col-sm-offset-2">Edit</a>	
</div>
</div>   
<?= $this->end() ?>
<?= $this->start('modals') ?>
<?= $this->element('employee/modals/allowance_modal') ?>
<?= $this->element('modals/modal') ?>
<?= $this->element('employee/modals/salary_modal') ?>
<?= $this->element('modals/modal') ?>
<?= $this->element('employee/modals/deduction_modal') ?>
<?= $this->element('modals/modal') ?>
<?= $this->element('employee/modals/uploadpic_modal') ?>
<?= $this->element('modals/modal') ?>
<?= $this->end() ?>
<?= $this->start('js_footer') ?>
<?= $this->Html->script('/plupload/js/plupload.full.min.js') ?>
<?= $this->Html->script('/plupload/js/jquery.plupload.queue/jquery.plupload.queue.min.js') ?>
<script>
    $(document).ready(function(){
       $(function(){
        plup = function(files_con, container, name){			
                var file_con = files_con;
                var container = container;
                var name = name;
                this.init = function(btn){
                var uploader = new plupload.Uploader({
                        runtimes : 'html5,flash,html4',
                        browse_button : btn, // you can pass in id...
                        container: container, // ... or DOM Element itself
                        url :  "<?= $this->Url->build(['controller' => 'Employees', 'action' => 'uploadfiles']) ?>",
                        resize: {
                        width: 400,
                        height: 400
                        },
                        chunk_size : '50kb',												
                        filters : {
                        max_file_size : '10mb',
                        mime_types: [
                        {title : "Image files", extensions : "jpg,gif,png"},
                        {title : "Zip files", extensions : "zip"}
                        ]
                        }
                        });				
        return uploader;
        }
        //End Initialization
        //FileAdded
        this.FilesAdded = function(uploader){
                uploader.bind("FilesAdded", function(up, files){
                        plupload.each(files, function(file) {				
                        var div = '<div class="row"><div id="' + file.id + '" class="col-md-9"><div class="col-md-10">' + file.name + ' (' + plupload.formatSize(file.size) + ')</div>';
                        div += '<div class="col-md-9"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"">0%';
                        div += '</div></div></div></div></div><p></p>';
                        $("#upload_progress").append(div);
                        });	
                        uploader.start();
                });								
        }
        //End fileAdded	
        //UploadProgress	
        this.UploadProgress = function(uploader){
                uploader.bind("UploadProgress", function(up, file){
                        file_con.find("#"+file.id).find(".progress-bar").css({"width" : file.percent + "%"});
                        file_con.find("#"+file.id).find(".progress-bar").html(file.percent + "%");	
                });
        }	
        //End UploadProgress	
        //FileUploaded
        this.FileUploaded = function(uploader){
                uploader.bind("FileUploaded", function(up, file, info){
                if(file.status == 5 && file.percent == 100){
                        var arr = JSON.parse(info.response);
                        file_con.find("#"+file.id).find(".progress-bar").html("completed");
                        var input = '<input type="hidden" value="'+arr.filename+'" name="'+ name +'"/>';
                        var orig_name = '<input type="hidden" value="'+arr.original_name+'" name="orig_name_'+ name +'"/>';
                        var img_show = '<img src="' + arr.file_path + '" width="300px" />';
                        file_con.find("#append_tag").append(input);
                        file_con.find("#append_tag").append(orig_name);
                        file_con.find("#pro_pic").attr("src", arr.file_path);
                }	
                });			
        }
        //End FileUploaded
                this.start = function(uploader){
                        uploader.init();
                }		
        }

});

	$(function(){
            var file = $("#pic_container #upload_files");		
            var container = document.getElementById("pic_container");									
            var chunk_load = new plup(file, container, "pic_btn");
            var uploader = chunk_load.init(pic_btn);										
            chunk_load.FilesAdded(uploader);									
            chunk_load.UploadProgress(uploader);
            chunk_load.FileUploaded(uploader);
            chunk_load.start(uploader);
	});        
    });
</script>    
<?= $this->end() ?>

