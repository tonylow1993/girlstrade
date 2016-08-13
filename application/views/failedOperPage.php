<?php $title = "Page Not Found - GirlsTrade";  include("header.php"); ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/failedOperations/css/style.css">
<link href='http://fonts.googleapis.com/css?family=Condiment' rel='stylesheet' type='text/css'>
<div id="wrapper">
   <div class="main-container" style="padding: initial;">
	<div id="errorPage">
	<div class="wrap">
	<div class="main">
		<div class="banner">
			<img src="<?php echo base_url(); ?>assets/failedOperations/images/banner.png" alt="" />
		</div>
		<div class="text">
			<h1><?php echo $this->lang->line("operationFailed");?></h1>
			<p><?php echo $this->lang->line("goBackTryAgain");?></p>
		</div>
	</div>
</div>
<br />
<br />

<?php include "footer1.php"; ?>


<?php include "footer2.php"; ?>