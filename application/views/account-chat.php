<?php $title = "Inbox Detail - GirlsTrade"; 
  include("header.php"); ?>
<link href="<?php echo base_url();?>assets/css/chatroom.css" rel="stylesheet">
<div id="wrapper">
  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <?php include("account_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
			
			<a class="pull-right back-btn margin-5" href=<?php  echo $prevURL;?>> 
			<i class="fa fa-angle-double-left"></i> <?php echo $profileBackToResult;?></a>
     
			<div class="col-md-12 bg-white panel-bevel">
				<div class="chat-message">
				<ul style="text-align: center;">
				<?php 
					echo "<h2><a href='".base_url().MY_PATH."viewProfile/viewByUserID/".$userID."/1' style=\"font-weight: 500;color:#1c688e;\">";
						if($result<>null)
		            	{
		            		$rowCount=0;
		                  	foreach($result as $id=>$row)
		                  	{
		                  		$fromusername=$row["fromusername"];
		                  		echo $fromusername;
								break;
		                  	}
		                  	
		            	}	
						echo "</a></h2>";
				?>
				</ul>
					<ul class="chat">
<!-- 						<li class="left clearfix">  -->
<!-- 							<span class="chat-img pull-left">  -->
<!-- 								<img src="http://bootdey.com/img/Content/user_3.jpg" alt="User Avatar">  -->
<!-- 							</span> -->
<!-- 							<div class="chat-body clearfix"> -->
<!-- 							<div class="header">  -->
<!-- 							<strong class="primary-font">John Doe</strong>  -->
<!-- 							<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small> -->
<!-- 							</div><p> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div> -->
<!-- 						</li> -->
						<?php 
						if($result<>null)
		            	{
		            		$rowCount=0;
		                  	foreach($result as $id=>$row)
		                  	{
		                  		$createDate=$row['createDate'];
		                  		$userID=$row["userID"];
		                  		$fromUserID=$row["fromUserID"];
		                  		$username=$row["username"];
		                  		$fromusername=$row["fromusername"];
		                  		$fromEmail=$row["fromEmail"];
		                  		$content=$row["content"];
		                  		$readflag=$row["readflag"];
		                  		$msgType=$row["type"];
		                  		if(strcmp($msgType, "Inbox")==0){
		                  			echo "<li class=\"left clearfix\"> <span class=\"chat-img pull-left\"> 
									<img src=$fromUserPhotoPath alt=\"User Avatar\"> 
									</span><div class=\"chat-body clearfix\"><div class=\"header\"> <strong class=\"primary-font secondary-font\">$fromusername </strong>  <small class=\"pull-right text-muted\"><i class=\"fa fa-clock-o\"></i>".date('Y-m-d h:i A', strtotime($createDate))."</small></div><p class=\"secondary-font\"> $content</p></div></li>";
		                  		}else{
		                  			echo "<li class=\"right clearfix\"> <span class=\"chat-img pull-right\"> 
									<img src=$userPhotoPath alt=\"User Avatar\"> 
									</span><div class=\"chat-body clearfix\" style=\"background-color:#e0edff\"><div class=\"header\" style=\"background-color:#e0edff\">  <strong class=\"primary-font secondary-font\">$username </strong><small class=\"pull-right text-muted\"><i class=\"fa fa-clock-o\"></i>".date('Y-m-d h:i A', strtotime($createDate))."</small></div><p class=\"secondary-font\"> $content</p></div></li>";
		                  		}
		                  		
		                  	}
		                  	
		            	}
								
								
						
						?>
						
					</ul>
				</div>
				<form role="form" class="form-horizontal" id="item" method="post" enctype="multipart/form-data" action="<?php echo base_url(); echo MY_PATH;?>home/insertBuyerMessage/Inbox">
					<div class="form-group">
	          		<input type="hidden" id="userID_1" name="userID_1" value="<?php echo $sendToUserID;?>"/>
	          		<input type="hidden" id="pageNum_1" name="pageNum_1" value="<?php echo $pageNum;?>"/>
	          		
	          		</div>
					<div class="chat-box"><div class="input-group"> <input id="message-text_1" name="message-text_1" class="form-control border no-shadow no-rounded" placeholder="Type your message here"> <span class="input-group-btn"> <button class="btn btn-success no-rounded" type="submit">Send</button> </span></div></div>
				</form>
			</div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
	</div>
  <!-- /.main-container -->
  </div>
  <!-- Modal contactAdvertiser -->
  </div>

  <?php include "footer1.php"; ?>
  <!--/.footer--> 
  
</div>
<!-- /.wrapper --> 

<?php include "footer2.php"; ?>

