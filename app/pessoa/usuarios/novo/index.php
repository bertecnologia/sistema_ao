<?php
ob_start("ob_gzhandler");
require_once '../../../../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
include_once(CONTROL);
?>
<!DOCTYPE html>
<html lang="pt-br" data-ng-app="app">
<head>
    <meta charset="utf-8" />
    <title><?php echo $empresa;?> - Cadastro de Usuário</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASEURL;?>images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASEURL;?>images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASEURL;?>images/favicon-16x16.png">
    <link rel="mask-icon" href="<?php echo BASEURL;?>images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#bbbfbe">
    <link rel="stylesheet" href="<?php echo BASEURL;?>bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo BASEURL;?>bower_components/animate.css/animate.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo BASEURL;?>bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo BASEURL;?>bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo BASEURL;?>css/font.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo BASEURL;?>css/app.css" type="text/css" />
</head>
<body>
<div class="app ng-scope app-header-fixed app-aside-fixed">

    <!-- header -->
    <?php include_once(ABSPATH . '/blocks/header.php');?>
    <!-- / header -->

    <!-- aside -->
    <?php include_once(ABSPATH . '/blocks/aside.php');?>
    <!-- / aside -->

    <!-- content -->
    <?php include_once(ABSPATH . '/content/pessoaUsuarioNovo.php');?>
    <!-- / content -->

    <!-- footer -->
    <?php include_once(ABSPATH . '/blocks/footer.php');?>
    <!-- / footer -->

</div>
<script src="<?php echo BASEURL;?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo BASEURL;?>bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="<?php echo BASEURL;?>js/ui-load.js"></script>
<script src="<?php echo BASEURL;?>js/ui-jp.config.js"></script>
<script src="<?php echo BASEURL;?>js/ui-jp.js"></script>
<script src="<?php echo BASEURL;?>js/ui-nav.js"></script>
<script src="<?php echo BASEURL;?>js/ui-toggle.js"></script>
<script src="<?php echo BASEURL;?>js/jquery.flot.min.js"></script>
<script src="<?php echo BASEURL;?>js/jquery.flot.orderBars.js"></script>
</body>
</html>