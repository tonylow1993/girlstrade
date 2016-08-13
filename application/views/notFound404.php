<?php $title = "Page Not Found - GirlsTrade";  include("header.php"); ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/missingPage/css/style.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/missingPage/plugins/font-awesome/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/missingPage/css/page_error3_404.css">
<div id="wrapper" style="background:rgb(238, 238, 238);">
   <div class="main-container" style="padding: 10px 0; padding-bottom:  50px;">
   <div id="errorBody">
	<!--=== Error V3 ===-->
	<div class="container content valign__middle">
		<!-- Error Block -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="error-v3">
					<h2><i class="icon-cancel-circled"></i></h2>
					<p><?php echo $NotFoundHeading;?></p>
				</div>
			</div>
		</div>
		<!-- End Error Block -->

		<!-- Begin Service Block V2 -->
		<div class="row service-block-v2">
			<div class="col-md-4">
				<div class="service-block-in service-or">
					<div class="service-bg"></div>
					<i class="icon-lamp"></i>
					<h4><?php echo $NotFoundFirst1;?></h4>
					<p><?php echo $NotFoundFirst2;?></p>
					<a class="btn-u btn-brd btn-u-light" href="<?php echo base_url().MY_PATH.'getCategory/getAll/1';?>"> 
						<?php echo $NotFoundFirst3;?>
					</a>
				</div>
			</div>

			<div class="col-md-4">
				<div class="service-block-in service-or">
					<div class="service-bg"></div>
					<i class="icon-home"></i>
					<h4><?php echo $NotFoundSecond1;?></h4>
					<p>
					<?php echo $NotFoundSecond2;?>
					</p>
					<a class="btn-u btn-brd btn-u-light" href="<?php echo base_url().MY_PATH;?>"> 
					<?php echo $NotFoundSecond3;?>
					</a>
				</div>
			</div>

			<div class="col-md-4">
				<div class="service-block-in service-or">
					<div class="service-bg"></div>
					<i class="icon-help-circled-1"></i>
					<h4><?php echo $NotFoundThird1;?></h4>
					<p>
					<?php echo $NotFoundThird2;?>
					</p>
					<a class="btn-u btn-brd btn-u-light" href="<?php echo base_url().MY_PATH.'footer/getContactUS';?>"> 
					<?php echo $NotFoundThird3;?>
					</a>
				</div>
			</div>
		</div>
		<!-- End Service Block V2 -->
	</div>
	<!--=== End Error-V3 ===-->
   	</div>
   
   
   
   
   
   <!-- JS Global Compulsory -->
    <script type="text/javascript" src="assets/missingPage/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="assets/missingPage/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript" src="assets/missingPage/plugins/back-to-top.js"></script>
	<!-- <script type="text/javascript" src="assets/missingPage/plugins/backstretch/jquery.backstretch.min.js"></script>
	<script type="text/javascript">
		$.backstretch([
			"assets/missingPage/img/blur/img1.jpg"
			])
	</script>-->
   
   
   
	</div>
</div>
<?php include "footer1.php"; ?>


<?php include "footer2.php"; ?>