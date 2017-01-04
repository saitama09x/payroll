<?= $this->assign('modal_id', 'modal_pic') ?>
<?= $this->start('modal-body') ?>
<div id="pic_container">
    <div id="upload_files">
        <div class="row">
            <div class="col-md-4">
            <?= $this->Html->image('avatar.png', ['alt' => 'avatar', 'width' => '200px', 'id' => 'pro_pic']); ?>                        
            <?= $this->Form->create(null, ['url' => ['controller' => 'Employees', 'action' => 'updatepropic']]); ?>
            <div id="append_tag"></div>
            <br /><br />
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-md btn-success']); ?>
            <?= $this->Form->end ?>            
            </div>
            <div class="col-md-8">
            <a id="pic_btn" href="javascript:;" class="btn btn-sm btn-success col-sm-offset-2">Select Files</a>	    
            <div id="upload_progress">            
            </div>           
            </div>          
        </div>
    </div>
</div>
<?= $this->end() ?>