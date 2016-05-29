<?php $title = "Girls' Trading Platform"; 
  include("header.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-tagsinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-tagsinput.js"></script>
  
  
  
<div id="wrapper">
    <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <?php include("account_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-4 page-content">
			<div class="inner-box profile-panel setting-panel panel-bevel">
				<a href="http://www.girlstrade.com/home/getAccountPage/4" class="row white-icon">
					<i class="fa fa-user fa-5"></i><br>
					<p class="panel-title">PROFILE</p>
				</a>
			</div>
			
			<div class="inner-box profile-panel inbox-panel panel-bevel">
				<a href="http://www.girlstrade.com/home/getAccountPage/13" class="row white-icon">
					<i class="fa fa-inbox fa-5"></i><br>
					<p class="panel-title">INBOX</p>
				</a>
			</div>
        </div>
		
		<div class="col-sm-4 page-content">
			<div class="inner-box profile-panel myads-panel panel-bevel">
				<a href="http://www.girlstrade.com/home/getAccountPage/3" class="row white-icon">
					<i class="fa fa-buysellads fa-5"></i><br>
					<p class="panel-title">MY ADS</p>
				</a>
			</div>
			
			<div class="inner-box profile-panel buyer-panel panel-bevel">
				<a href="http://www.girlstrade.com/home/getAccountPage/6" class="row white-icon">
					<i class="fa fa-shopping-cart fa-5"></i><br>
					<p class="panel-title">BUYER</p>
				</a>
			</div>
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
  <!-- /.main-container -->
  
  <?php include "footer1.php"; ?>
  <!--/.footer--> 
<?php include "footer2.php"; ?>

