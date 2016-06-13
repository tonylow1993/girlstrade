<?php $title = "Girls' Trading Platform"; 
  include("header.php"); ?>
<div id="wrapper">
  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <?php include("account_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
          <?php include("profile_header.php");?>
          <div class="inner-box">
          	  <?php include("profile_visit.php");?>
            <h2 class="title-2"><i class="icon-star-circled"></i> <?php echo $this->lang->line("ApproveReject"); ?> </h2>
             <div>
<!--               <div class="table-action"> -->
<!--                 <label for="checkAll"> -->
 <!--                  <input type="checkbox" onclick="checkAll(this)" id="checkAll"> -->
<!--                   Select: All | <a href="#" class="btn btn-xs btn-danger">Approve <i class="fa fa-reply "></i></a>  -->
<!--                   | <a href="#" class="btn btn-xs btn-danger">Reject <i class="fa fa-trash "></i></a> -->
<!--                   </label> -->
<!--                 <div class="table-search pull-right col-xs-7"> -->
<!--                   <div class="form-group"> -->
                    
<!--                   </div> -->
<!--                 </div> -->
<!--               </div> -->
             <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line("From");?> </th>
                    <th data-sort-ignore="true" class="small-table-right"> <?php echo $this->lang->line("Ads_Detail");?></th>
                    </tr>
                </thead>
                <tbody>
            <?php 
            	if($result<>null)
            	{
            		$rowCount=0;
                  	foreach($result as $id=>$row)
                  	{
                  		if(strcmp($row['recordType'],"DirectSend")==0){
                  			$from=$row['from'];
                  			$reply=$row['reply'];
                  			$replyUserID=$row["replyUserID"];
                  			$viewItemPath=$row['viewItemPath']."?prevItem_Url=".urlencode(current_url());
                  			$imagePath=$row['imagePath'];
                  			$checkImgFile=$row['checkImgFile'];
                  			$previewTitle=$row['previewTitle'];
                  			$previewDesc=$row["previewDesc"];
                  			$createDate=$row['createDate'];
                  			$itemStatus=$row['itemStatus'];
                  			$statusRP=$row["statusRP"];
                  			$messageID=$id;
                  			$NoOfDaysPending=$row['NoOfDaysPending'];
                  			$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
                  			$price=$row['price'];
                  			$sellerEmail=$row["sellerEmail"];
                  			$status="";
                  			if(strcmp($statusRP, 'A')==0)
                  				$status="Approved";
                  				else if(strcmp($statusRP, 'R')==0){
                  					$status="Rejected";
                  					$sellerEmail="";
                  				}
                  			
                  				$userPath=base_url().MY_PATH."viewProfile/viewByUserID/".$replyUserID."/1?prevURL=".urlencode(current_url());
                  				echo "<tr>";
                  				echo "<td style=\"width:30%\" class=\"add-image\"><a href=$userPath>$reply</a>";
								echo "<p class=\"price-td\">";
                  				/*if (is_file_exists($checkImgFile)) {
                  					echo "<p class=\"price-td\"><br/><a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                  				}else
                  				{
                  					$imagePath = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
                  					echo "<p class=\"price-td\"><br/><a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                  				}*/
                  				if(strcmp($statusRP, 'A')==0)
                  					echo "<br/><i class=\"fa fa-envelope\"></i> Buyer email: $sellerEmail";
                  				echo "<br/><i class=\"fa fa-signal\"></i> Status: $status</p>";
                  				echo "</td>";
                  				echo "<td style=\"width:55%\" class=\"ads-details-td small-table-right\">";
                  				echo "<div class=\"ads-details\">";
                  				echo "<h5><div class=\"add-title-girlstrade\"><a href=$viewItemPath>".$this->lang->line("lblTitle").$previewTitle."</a></div><a href=$viewItemPath>".$previewDesc."</a>";
                  				echo "<br/>Posted On: ". $createDate."</h5>";
                  				echo "</div></td>";
                  				echo "</tr>";
                  			
                  		}else{
                  		$from=$row['from'];
                  		$reply=$row['reply'];
                  		$viewItemPath=$row['viewItemPath']."?prevItem_Url=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
                  		$previewTitle=$row['previewTitle'];
                  		$previewDesc=$row["previewDesc"];
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		$messageID=$id;
                  		$userID=$row['userID'];
                  		$NoOfDaysPending=$row['NoOfDaysPending'];
						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
                		echo "<tr>";
                    	echo "<td style=\"width:20%\" class=\"add-image\">$from";
                    	echo "<br/><a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
						
						echo "<div class=\"ads-details small-table-left margin-10\">";
						echo "<h5><div class=\"add-title-girlstrade\"><a href=$viewItemPath>".$this->lang->line("lblTitle").$previewTitle."</a></div>";
						echo "Posted On: ". $createDate."</h5>";
						echo "</div>";
						
						
                    	echo "<p class=\"price-td\">".$this->lang->line("DaysExpiry")." :".$NoOfDaysb4ExpiryContact;
                    	$approvePath=base_url().MY_PATH."messages\approveSavedAds\$messageID\$userID";
                    	$rejectPath=base_url().MY_PATH."messages\rejectSavedAds\$messageID\$userID";
                    	$rowCount=$rowCount+1;
                    	$ctrlName1="AjaxLoad".$rowCount;
                    	$errorctrlName1="ErrAjaxLoad".$rowCount;
                    	$ctrlValue1="messageID".$rowCount;
                    	$ctrlValue2="userID".$rowCount;
                    	$ctrlName2="AjaxLoad2_".$rowCount;
                    	$errorctrlName2="ErrAjaxLoad2_".$rowCount;
                    	$clickLink="clickLink".$rowCount;
                    	$clickLink2="clickLink2_".$rowCount;
                    	echo " <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
                    	echo "<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$messageID' />";
                    	echo "<input name='$ctrlValue2' id='$ctrlValue2' type='hidden' value='$userID' />";
                    	echo "<a class=\"btn btn-success btn-xs btn-120\" href=\"javascript:approve('$ctrlValue1','$ctrlValue2', '$ctrlName1', '$errorctrlName1')\" id='$clickLink'> <i class=\"fa fa-check\"></i> ".$this->lang->line('Approve')." </a></p>";
                    	echo "<div id='$ctrlName2' name='$ctrlName2' class='center'></div><div id='$errorctrlName2' name='$errorctrlName2' class='center'></div>";
                    	echo "<a class=\"btn btn-danger btn-xs btn-120\" href=\"javascript:reject('$ctrlValue1','$ctrlValue2', '$ctrlName2', '$errorctrlName2')\" id='$clickLink2'><i class=\"fa fa-times\"></i>  ".$this->lang->line('Reject')."</a></p>";
                    	echo "</div>";
                    	
                    	echo "</td>";
                      	echo "<td style=\"width:55%\" class=\"ads-details-td small-table-right\">";
                    	echo "<div class=\"ads-details\">";
						echo "<h5><div class=\"add-title-girlstrade\"><a href=$viewItemPath>".$this->lang->line("lblTitle").$previewTitle."</a></div><a href=$viewItemPath>".$previewDesc."</a>";
						echo "<br/>Posted On: ". $createDate."</h5>";
						echo "</div></td>";
                  		echo "</tr>";
                  		}
                  	}
            	}
            ?>
            <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$encodeCurrentURL=urlencode(current_url());
            	$url_path=base_url().MY_PATH."home/getAccountPage/".$activeNav;
            	$pageNumPrev=$pageNum-1;
            	$pageNum2=$pageNum+1;
            	$pageNum3=$pageNum+2;
            	$pageNum4=$pageNum+3;
            	$pageNum5=$pageNum+4;
            	$pageNumNext=$pageNum+5;
            	$itemPerPage=ITEMS_PER_PAGE;
            	 
            	if($NoOfItemCount>0)
            	{
            		if($pageNum<>1)
            		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev\">Previous</a></li>";
            		if($NoOfItemCount > 0)
            		echo "<li  class=\"active\"><a href=\"$url_path/$pageNum\">$pageNum</a></li>";
            		if($NoOfItemCount > ($pageNum*$itemPerPage))
            		echo "<li><a href=\"$url_path/$pageNum2\">$pageNum2</a></li>";
            		if($NoOfItemCount > ($pageNum2*$itemPerPage))
            		echo "<li><a href=\"$url_path/$pageNum3\">$pageNum3</a></li>";
            		if($NoOfItemCount > ($pageNum3*$itemPerPage))
            		echo "<li><a href=\"$url_path/$pageNum4\">$pageNum4</a></li>";
            		if($NoOfItemCount > ($pageNum4*$itemPerPage))
            		echo "<li><a href=\"$url_path/$pageNum5\">$pageNum5</a></li>";
            		
            		if($NoOfItemCount > ($pageNum5*$itemPerPage))
            		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext\">Next</a></li>";
            		 
            		}
             ?>
                </ul>
          </div>
             
            	 </tbody>
              </table>
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
</div>
<!-- /.wrapper --> 
<script>

function approve(ctrlValue1, ctrlValue2, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/approveSavedAds",
		data: { messageID: $( "#".concat(ctrlValue1) ).val(),
		userID: $( "#".concat(ctrlValue2) ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
};
function reject(ctrlValue1, ctrlValue2, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/rejectSavedAds",
		data: { messageID: $( "#".concat(ctrlValue1) ).val(),
		userID: $( "#".concat(ctrlValue2) ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
};
</script>

<!-- include custom script for ads table [select all checkbox]  --> 
<script>
     
function checkAll(bx) {
  var chkinput = document.getElementsByTagName('input');
  for(var i=0; i < chkinput.length; i++) {
    if(chkinput[i].type == 'checkbox') {
      chkinput[i].checked = bx.checked;
    }
  }
}

</script> 


<?php include "footer2.php"; ?>
