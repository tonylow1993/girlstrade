<?php $title = "GirlsTrade - Page Not Found";  include("header.php"); ?>
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
					<p>Sorry, the page you were looking for could not be found!</p>
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
					<h4>Not what you were looking for?</h4>
					<p>If the page is not what you are looking for, why not start finding out other new things?</p>
					<a class="btn-u btn-brd btn-u-light" href="<?php echo base_url().MY_PATH.'getCategory/getAll/1';?>"> Search Now!</a>
				</div>
			</div>

			<div class="col-md-4">
				<div class="service-block-in service-or">
					<div class="service-bg"></div>
					<i class="icon-home"></i>
					<h4>Possible cause of the problem</h4>
					<p>The page you requested could not be found. Why not start from the beginning.</p>
					<a class="btn-u btn-brd btn-u-light" href="<?php echo base_url().MY_PATH;?>"> Go back to Home Page</a>
				</div>
			</div>

			<div class="col-md-4">
				<div class="service-block-in service-or">
					<div class="service-bg"></div>
					<i class="icon-help-circled-1"></i>
					<h4>Get In Touch</h4>
					<p>If you have a problem with GirlsTrade, please contact us right away.</p>
					<a class="btn-u btn-brd btn-u-light" href="<?php echo base_url().MY_PATH.'footer/getContactUS';?>"> Contact Us</a>
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