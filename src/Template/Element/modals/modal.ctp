<div class="modal fade" tabindex="-1" role="dialog" id="<?php echo $this->fetch('modal_id') ?>">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><?php echo $this->fetch('modal-title') ?></h4>
	      </div>
	      <div class="modal-body">
	        <?= $this->fetch('modal-body') ?>
	      </div>
	      <div class="modal-footer">	        	       
	      </div>	      
	    </div><!-- /.modal-content -->
	    </form>
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->