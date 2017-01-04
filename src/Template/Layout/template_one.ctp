<!DOCTYPE html>
<html  xmlns:th="http://www.thymeleaf.org">
<head>
<meta charset="ISO-8859-1" />

<?php echo $this->Html->css('/bootstrap/css/bootstrap.min.css'); ?>
<?php echo $this->Html->css('/css/custom.css') ?>
<!-- Font Awesome -->
<?php echo $this->Html->css('/font-awesome/css/font-awesome.min.css') ?>
<!-- Ionicons -->
<?php echo $this->Html->css('/fonts/ionicons.min.css') ?>
<!-- jvectormap -->  
<!-- Theme style -->
<?php echo $this->Html->css('/dist/css/AdminLTE.min.css') ?>
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<?php echo $this->Html->css('/dist/css/skins/_all-skins.min.css') ?>

<?php echo $this->Html->script('/js/jquery.min.js') ?>
<?php echo $this->Html->script('/bootstrap/js/bootstrap.min.js') ?>

<?php echo $this->fetch("header_adds") ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php echo $this->element('header/header'); ?>
  <?php echo $this->element('sidebar/sidebar'); ?>
  <!--Side bar -->
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
<?php echo $this->fetch("title") ?>
</h1>
<?php echo $this->element('breadcrumbs/breadcrumbs'); ?>
</section>
<section class="content">
<?php echo $this->fetch("content_no_box") ?>
<div class="box box-info">
<div class="box-header with-border">
<?php echo $this->fetch('box-header') ?>
<h3 class="box-title"><?php echo $this->fetch("box-title") ?></h3>
</div>
<div class="box-body">
<?php echo $this->fetch("content_with_box") ?>
</div>
</div>
</div>
</section>
<?php echo $this->fetch('modals') ?>
<footer class="main-footer">
<div class="pull-right hidden-xs">
<b>Version</b> 1.0.0
</div>
<strong>Copyright &copy; 2016 <a href="#">Guimaras State College</a>.</strong> All rights
reserved.
</footer>
</div>
<?php echo $this->fetch('js_footer') ?>

<?php echo $this->Html->script('/plugins/fastclick/fastclick.js') ?>
<!-- AdminLTE App -->
<?php echo $this->Html->script('/dist/js/app.min.js') ?>
<!-- Sparkline -->
<?php echo $this->Html->script('/plugins/sparkline/jquery.sparkline.min.js') ?>
<!-- jvectormap -->
<!-- SlimScroll 1.3.0 -->
<?php echo $this->Html->script('/plugins/slimScroll/jquery.slimscroll.min.js') ?>
<!-- ChartJS 1.0.1 -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<?php echo $this->Html->script('/dist/js/demo.js') ?>

</body>
</html>