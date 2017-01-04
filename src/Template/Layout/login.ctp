<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>

  <?php

    echo $this->Html->css('/bootstrap/css/bootstrap.min.css');
    echo $this->Html->css('/fonts/font-awesome.min.css');
    echo $this->Html->css('/fonts/ionicons.min.css');
    echo $this->Html->css('/dist/css/AdminLTE.min.css');
    echo $this->Html->css('/plugins/iCheck/square/blue.css');
    echo $this->Html->script('/js/jquery.min.js');
    echo $this->Html->script('/bootstrap/js/bootstrap.min.js');
    echo $this->fetch('header_adds');
  ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
      <?php echo $this->fetch('title'); ?>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">   
    <?php echo $this->fetch('page'); ?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?= $this->fetch('js_footer') ?>
</body>
</html>