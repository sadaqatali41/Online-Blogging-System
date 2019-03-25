<?php echo doctype('html5'); ?>
<html lang="eng">
<head>
	<title>Blogging System</title>
	<style type="text/css">
		.main_container{
			min-height: 1150px;
		}
	</style>
	<?php echo meta('viewport','width=device-width'), meta('Content-type', 'text/html; charset=utf-8', 'equiv'); 
    ?>
    <?php echo link_tag('styles/css/bootstrap.min.css?v=1'); 
    echo link_tag('styles/css/login.css?v=1');
    ?>
    <script src="<?php echo base_url('styles/js/jquery.min.js?v=1'); ?>"></script>
	<script src="<?php echo base_url('styles/js/bootstrap.min.js?v=1'); ?>"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="<?php echo base_url('styles/js/jquery.gotop.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('styles/js/bootstrap-switch.js') ?>"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</head>
<body>
	<div id="gotop" title="BACK TO TOP"></div>
	<div class="container main_container">
		<div class="jumbotron">
			<h2 class="text-center"><u>Codeigniter Blogging System</u></h2>
		</div>
	