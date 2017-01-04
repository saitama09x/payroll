<?= $this->start('box-title') ?>
Accounts
<?= $this->end() ?>
<?= $this->start('content_with_box') ?>
<div class="row">
<div class="col-md-8">
<div class="form-group">

<div class="box box-success">
<h4>Personal Info</h4>
<div class="row">
<div class="col-md-7">
<table class="table">
<tbody>
<tr><th>Employee Name</th><th>Gender</th></tr>
<tr><td><h4><?= strtoupper($user->fname) . " " . strtoupper($user->lname) ?></h4></td>
<td><h4><?= $user->gender->type ?></h4></td></tr>
<tr><th>Office Position</th><th>Date Employed</th></tr>
<tr><td><h4><?= strtoupper($user->position->name) ?></h4></td>
<td><h4><?= strtoupper(date('M d, Y', strtotime($user->date_created))) ?></h4></td></tr>
<tr><th>Status</th><th>Account Username</th></tr>
<tr><td><h4><?= strtoupper($user->status->status) ?></h4></td><td><h4><?= strtoupper($user->user->username) ?></h4></td></tr>
</tbody>
</table>
</div>
<div class="col-md-2">
<label>Profile Picture</label>
<?= $this->Html->image($user->pro_pic, ['alt' => 'avatar', 'width' => '170px']); ?>
<br /><br />
<div class="form-group col-md-offset-4">
<?= $this->Html->link('Change Pic', ['action' => 'user#'], ['class' => 'btn btn-sm btn-info','data-toggle' => 'modal', 'data-target' => '#modal_pic']) ?>
</div>
</div>
</div>
<div class="form-group  col-md-offset-2">
<?= $this->Html->link('Change Login Access', ['action' => 'user#'], ['class' => 'btn btn-sm btn-success', 'data-toggle' => 'modal', 'data-target' => '#login']) ?>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="box box-warning">
<h4>Performance Status</h4>
<hr />
<div class="form-group">
<label>Ratings: <?= number_format($performace_rating, 2) ?>%</label>
</div>
<div class="form-group">
<h4>Last Recent Student</h4>
<table class="table">
<thead><tr><th>Student</th><th>Date</th><th>Total Hrs</th></tr></thead>
<tbody>
<?php foreach($tutor as $row): ?>
<?php if($row->start_date != "0000-00-00"): ?>
<tr><td><?= $row->stud->fname . " " . $row->stud->lname ?></td>
<td><?= $row->start_date ?></td>
<td><?= date_diff(date_create($row->start_time), date_create($row->end_time))->format("%h:%i:%s") ?></td>
</tr>
<?php endif; ?>
<?php endforeach ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?= $this->end() ?>
<?= $this->start('modals') ?>
<?= $this->append("modal_id", "login") ?>
<?= $this->append("modal-title", "Change Login Access") ?>
<?= $this->start("modal-title") ?>
Change Login Access
<?= $this->end() ?>
<?= $this->start('modal-body') ?>
<div class="form-group">
<?= $this->Form->create(null, ['url' => ['action' => 'changelogin']]) ?>
<div class="form-group">
<?= $this->Form->input('username', ['class' => 'form-control']) ?>
</div>
<div class="form-group">
<?= $this->Form->input('password', ['class' => 'form-control']) ?>
</div>
<div class="form-group">
<?= $this->Form->button(__('Save'), ['class' => 'btn btn-sm btn-success']) ?>
</div>
<?= $this->Form->end() ?>
</div>
<?= $this->end() ?>
<?= $this->element("modals/modal") ?>
<?= $this->element('profile/modals/uploadpic_modal') ?>
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
