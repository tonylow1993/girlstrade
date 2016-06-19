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
		<div class="sidebar">
			<?php include("account_sidebar.php");?>
		</div>
        <!--/.page-sidebar-->
		
		<div id="rootwizard" class="col-sm-9">
			<ul class="nav nav-pills">
				<li class="active"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line("AccountTabName");?></a></li>
				<li><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line("SellerTabName");?></a></li>
				<li><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line("BuyerTabName");?></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<div class="col-sm-6 page-content">
						<div class="inner-box profile-panel setting-panel panel-bevel">
							<a href="http://www.girlstrade.com/home/getAccountPage/4" class="row white-icon">
								<i class="fa fa-user fa-5"></i><br>
								<p class="panel-title">EDIT PROFILE</p>
							</a>
						</div>
						
						<div class="inner-box profile-panel inbox-panel panel-bevel">
							<a href="http://www.girlstrade.com/home/getAccountPage/13" class="row white-icon">
								<i class="fa fa-inbox fa-5"></i><br>
								<p class="panel-title">INBOX
								<?php
									echo "<span class=\"badge badge-profile\">$inboxMsgCount</span>";
								?>
								</p>
							</a>
						</div>
					</div>
				
					<div class="col-sm-6 page-content">
						<div class="inner-box profile-panel myads-panel panel-bevel">
							<a href="http://www.girlstrade.com/home/getAccountPage/12" class="row white-icon">
								<i class="fa fa-envelope-o fa-5"></i><br>
								<p class="panel-title">Email Config.</p>
							</a>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab2">
				  <div class="col-sm-6 page-content">
						<div class="inner-box profile-panel setting-panel panel-bevel">
							<a href="http://www.girlstrade.com/home/getAccountPage/6" class="row white-icon">
								<i class="fa fa-user fa-5"></i><br>
								<p class="panel-title">MY ADS.</p>
							</a>
						</div>
					</div>
				
					<div class="col-sm-6 page-content">
						<div class="inner-box profile-panel buyer-panel panel-bevel">
							<a href="http://www.girlstrade.com/home/getAccountPage/2" class="row white-icon">
								<i class="fa fa-shopping-cart fa-5"></i><br>
								<p class="panel-title">BUYER LIST</p>
							</a>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab3">
					<div class="col-sm-6 page-content">
						<div class="inner-box profile-panel setting-panel panel-bevel" style="background-color: #8c3988">
							<a href="http://www.girlstrade.com/home/getAccountPage/6" class="row white-icon">
								<i class="fa fa-compress fa-5"></i><br>
								<p class="panel-title">SELLER LIST</p>
							</a>
						</div>
					</div>
				
					<div class="col-sm-6 page-content">
						<div class="inner-box profile-panel buyer-panel panel-bevel" style="background-color: #ff5f5f">
							<a href="http://www.girlstrade.com/home/getAccountPage/5" class="row white-icon">
								<i class="fa fa-heart fa-5"></i><br>
								<p class="panel-title">FAV. ITEMS</p>
							</a>
						</div>
					</div>
				</div>
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

