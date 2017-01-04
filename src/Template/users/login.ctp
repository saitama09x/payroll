<?php $this->start("title") ?>
<a href="#">Columbus English Academy</a>
<?php $this->end() ?>

<?php $this->start('page'); ?>
<?= $this->Flash->render('auth') ?>
 <p class="login-box-msg">Sign in to start your session</p>
    <?php echo $this->Form->create(); ?>
      <div class="form-group has-feedback">
        <?php echo $this->Form->input('username', array('div' => false, 'class' => 'form-control')); ?>        
      </div>
      <div class="form-group has-feedback">
        <?php echo $this->Form->input('password', array('div' => false, 'class' => 'form-control')); ?>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <?= $this->Form->button(__('Login'), ['class' => 'btn btn-md btn-primary']); ?>
      </div>
        <div class="col-xs-3 pull-right">
          <?= $this->Html->link(__('Register'), ['action' => 'register'], ['style' => 'color:red;']); ?>
      </div>
          <?php echo $this->Form->end(); ?>
        <!-- /.col -->
      </div>
    </form>
<?php $this->end() ?>