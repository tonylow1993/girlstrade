<?php $title = "Girls' Trading Platform";  include("header.php");?>
<style>
.add-title-girlstrade {
	padding: 0px;
	margin: 0px;
	border:0px;
  color: blue;
  font-weight: bold;
}
</style>
<script type="text/javascript">
function sendIt() {

// var i = document.getElementById("sortByPrice").value;
 var info = document.getElementById("sortHref").value;
   document.location.href=info; //.concat(i);
}
</script>

<div id="wrapper">
  <div class="main-container">
    <div class="container">   
      <div class="row">
        
        <div class="col-sm-9 page-content col-thin-left">
          <div class="category-list">
          
 			
               <div class="pull-right backtolist margin-right-10"><a href=<?php echo $previousCurrent_url;?>> <i class="fa fa-angle-double-left"></i> Back to Results</a></div>
               
            <div class="adds-wrapper">
              <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr style="height:50px;">
<!--                <th height="50px" data-type="numeric" data-sort-initial="true" style="border: none;"> </th>-->
                    <th style="border: none;"> <?php echo $this->lang->line("Photo");?> </th>
                    <th data-sort-ignore="true" style="border: none;"> <?php echo $this->lang->line("Ads_Detail");?> </th>
                    <th class="price-td" data-type="numeric" style="border: none;"> <?php echo $this->lang->line("Price");?> </th>
                  </tr>
                </thead>
                <tbody>
                	<?php 
                	if($result<>null)
            	{
            		$rowCount=0;
                  	foreach($result as $id=>$row)
                  	{
                  		$from=$row['from'];
                  		$reply=$row['reply'];
                  		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
                  		$preview=$row['preview'];
                  		$previewTitle=$row['previewTitle'];
                  		$previewDesc=$row["previewDesc"];
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		$messageID=$id;
                  		$status=$row["status"];
                  		$userID=$row['userID'];
                  		$rejectReason=$row['rejectReason'];
                  		$rejectSpecifiedReason=$row['rejectSpecifiedReason'];
                  		$NoOfDaysPending=$row['NoOfDaysPending'];
						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
						$NoOfSoldUsers=0;
						$enableMarkSoldBtn= $row["enableMarkSoldBtn"];
                  		$soldUsers=$row["soldUsers"];
						$soldUsersstr="  <select required=\"true\" class=\"form-control selecter\" name=\"soldUser\" id=\"soldUser\">  ";
						if($soldUsers!=null){
							$NoOfSoldUsers=count($soldUsers);
							foreach($soldUsers as $row){
								$soldUserID=$row->soldUserID;;
								$soldUsername=$row->soldUsername;
									$soldUsersstr=$soldUsersstr."  <option  value='".$soldUserID."'  style='background-color:#E9E9E9;font-weight:bold;' > ".$soldUsername." </option>  ";
							}
						}
						 $soldUsersstr=$soldUsersstr."  </select>  ";
						 $soldUsersstr=base64_encode($soldUsersstr);
						echo "<tr>";
//                    	echo "<td style=\"width:5%; border: none;\" class=\"add-img-selector\"><div class=\"checkbox\">";
//                        echo "<label>";
//                        echo "  <input type=\"checkbox\">";
//                        echo "</label>";
//                      	echo "</div></td>";
                      	echo "<td style=\"width:20%;height:150px;padding:0px; margin: 0px; border: none;\"  class=\"add-image\">";
//                       	echo  "<div class=\"col-sm-2 no-padding photobox\">";
// 						echo "<div style=\"position:relative; height:75px; width: 100%; overlfow:hidden;\">";
                      	$sizeimage=getimagesize($imagePath);
                      	echo "<p style=\"font-size:8px;padding:0px; margin: 0px;\">image size: ".$sizeimage[0]."x".$sizeimage[1]."</p>";
                      	if($sizeimage[1]>300)
                      	{
                      		$ratio= 100*300/ $sizeimage[1];
                      		if($sizeimage[0]>90* 300/ $sizeimage[1])
                      			echo "<a href=$viewItemPath  style=\"padding:0px; margin: 0px;\" ><img style=\"height:100%; width:".$ratio."%; padding:0px; margin:0px;\"  class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                      		else 
                      		echo "<a href=$viewItemPath  style=\"padding:0px; margin: 0px;\" ><img style=\"height:100%; width:auto; padding:0px; margin:0px;\"  class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                      	}else 
								echo "<a href=$viewItemPath  style=\"padding:0px; margin: 0px;\" ><img style=\"height:auto; padding:0px; margin:0px;\"  class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
						
//                       	echo "</div>";
                      	
//                       	echo "<a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                    	echo "<p class=\"price-hide\">$price</p>";
						echo "<div class=\"action-hide\">";
						$editPath=base_url().MY_PATH."newPost/showEditPost/".$messageID."?prevURL=".urlencode(current_url());
						$sharePath=base_url().MY_PATH."messages/shareMyAds/".$messageID."/".$userID;
						$deletePath=base_url().MY_PATH."messages/deleteMyAds/".$messageID."/".$userID;
						
						$rowCount=$rowCount+1;
						$ctrlName1="AjaxLoad".$rowCount;
						$errorctrlName1="ErrAjaxLoad".$rowCount;
						$ctrlValue1="messageID".$rowCount;
						$ctrlValue2="userID".$rowCount;
						$clickLink="clickLink".$rowCount;
						$shareLink=base_url()."home/index/".$messageID;
						//echo "<p><a class=\"btn btn-primary btn-xs\" href=$editPath> <i class=\"fa fa-edit\"></i> ".$this->lang->line('Edit')." </a></p>";
                        echo "<p> <a class=\"btn btn-info btn-xs\" href=\"#shareAds\"  data-toggle=\"modal\" shareLink='$shareLink'> <i class=\"fa fa-mail-forward\"></i>".$this->lang->line('Share')." </a></p>";
                        echo "<p>";
                        		
                        echo " <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
                    	echo "<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$messageID' />";
                    	echo "<input name='$ctrlValue2' id='$ctrlValue2' type='hidden' value='$userID' />";
                    	
                    	echo "<div class=\"user-ads-action\"><a class=\"btn btn-danger btn-xs\"  href=\"#deleteAdsPopup\" data-toggle=\"modal\" id='$clickLink' data-id=\"$messageID\" data-userID=\"$userID\"> <i class=\" fa fa-trash\"></i> ".$this->lang->line('Delete')." </a></div></p>";
                    	
                        //echo "<a class=\"btn btn-danger btn-xs\"  href=\"javascript:deleteAds('$ctrlValue1','$ctrlValue2', '$ctrlName1', '$errorctrlName1)'\" id='$clickLink'> <i class=\" fa fa-trash\"></i> ".$this->lang->line('Delete')." </a></p>";
                     	if($enableMarkSoldBtn)
                        	echo "<p><div class=\"user-ads-action\"><a class=\"btn btn-info btn-xs\"  data-toggle=\"modal\"   href=\"#markSoldAds\"  data-id=\"$messageID\"  data-soldusers=\"$soldUsersstr\"> <i class=\"fa fa-mail-forward\"></i>".$this->lang->line('MarkSold')." </a></div></p>";
                        
                        echo "</div>";
						echo "</td>";
                      	echo "<td style=\"width:55%; border: none;\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                         echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc."<br/>".$preview;
                          echo "<br/>Posted On: ". $createDate."<br/>Status: ".$status;
                   	  echo "<br/>Interest persons count:  $NoOfSoldUsers";
                        if(strcmp($status, "Rejected")==0){
                        	echo "<br/>Reject Reason: ".$rejectReason." with ".$rejectSpecifiedReason;
                        }
                        echo "</div></h5></td>";
                      	echo "<td style=\"width:10%; border: none;\" class=\"price-td\">$price</td>";
						
                  		echo "</tr>";
                  	}
            	}
                  ?>
                   <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$url_path=base_url().MY_PATH."home/viewAllComments/$userID";
            	$pageNumPrev=$pageNum-1;
            	$pageNum2=$pageNum+1;
            	$pageNum3=$pageNum+2;
            	$pageNum4=$pageNum+3;
            	$pageNum5=$pageNum+4;
            	$pageNumNext=$pageNum+5;
            	if($pageNum<>1)
            		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev?prevURL=$previousCurrent_url;\">Previous</a></li>";
            	echo "<li  class=\"active\"><a href=\"$url_path/$pageNum?prevURL=$previousCurrent_url;\">$pageNum</a></li>";
            	echo "<li><a href=\"$url_path/$pageNum2?prevURL=$previousCurrent_url;\">$pageNum2</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum3?prevURL=$previousCurrent_url;\">$pageNum3</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum4?prevURL=$previousCurrent_url;\">$pageNum4</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum5?prevURL=$previousCurrent_url;\">$pageNum5</a></li>";
              
               echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext?prevURL=$previousCurrent_url;\">Next</a></li>";
            ?>
                </ul>
          </div>
                </tbody>
              </table>
            
         	  </div>
       		</div>
       		
       		
          
      
      </div>
    </div>
  </div>
  </div>
  


  
  <!-- /.main-container -->
  
  <?php include "footer1.php"; ?>
</div>


    <?php include "footer2.php"; ?>

