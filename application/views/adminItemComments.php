<?php $title = "Girls' Trading Platform"; 
  include("header.php"); ?>
<div id="wrapper">
  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <?php include("admin_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
           <div class="inner-box">
            <h2 class="title-2"><i class="icon-star-circled"></i> <?php echo $this->lang->line("approveitemComment"); ?> </h2>
            <form name="myForm" action="<?php echo base_url().MY_PATH;?>getAdmin/updateItemComments" method="POST">
             
             <div class="table-responsive">
             <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                    <tr>
                    <th data-type="numeric" data-sort-initial="true"> </th>
                    <th> <?php echo $this->lang->line("From");?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Preview");?>  </th>
                    <th> <?php echo $this->lang->line("Action");?>  </th>
                   </tr>
                </thead>
                <tbody>
                <?php 
                $Num=0;
                
                if($itemList<>null)
            	{
            		foreach($itemList as $id=>$row)
                  	{
                  		$Num=$Num+1;
                  		$from=$row['from'];
                  		$to=$row["to"];
                  		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
                  		$previewTitle=$row['previewTitle'];
                  		$preview=trim($row["preview"]);
                  		
                  		$preview=trimLongText($preview);
                  		
                  		$previewDesc=trim($row["previewDesc"]);
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		//$status=$row['status'];
                  		$commentID=$row['commentID'];
                  		//$NoOfDaysPending=$row['NoOfDaysPending'];
						//$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
						$postID=$row['postID'];
                		echo "<tr>";
                    	echo "<td style=\"width:5%\" class=\"add-img-selector\"><div class=\"checkbox\">";
                        echo "<label>";
                        echo "  <input type=\"checkbox\">";
                        echo "</label>";
                      	echo "</div></td>";
                    	echo "<td style=\"width:20%\">user: $from, postman: $to</td>";
                    	echo "<td style=\"width:60%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                       echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
                          echo "<br/>".$preview."<br/>Posted On: ". $createDate."</h5>";
                      	 	echo "</div></td>";
                      	 	echo "<td style=\"width:10%\" class=\"action-td\"><div>";
                      	 	 $actionType="actionType".$Num;
                 $postIDCtrl="postID".$Num;
                $commentIDCtrl="commentID".$Num;
                $rejectReason="rejectReason".$Num;
                $rejectSpecifiedReason="rejectSpecifiedReason".$Num;
                echo "<input type='hidden' name='".$postIDCtrl."' value='".$postID."' />";
                echo "<input type='hidden' name='".$commentIDCtrl."' value='".$commentID."' />";
          
                echo "<select id='".$actionType."' name='".$actionType."'   style='font-size:1.3em'>";
                echo "<option selected='selected' value='A'>Approve</option>";
                echo "<option value='R'>Reject</option>";
                echo "<option value='U'>Unverified</option>";
                echo "</select>";
                echo "<br/><select id='".$rejectReason."' name='".$rejectReason."' style='font-size:1.3em' >";
                echo "<option selected='selected' value='Reject Reason 1'>Reject Reason 1</option>";
                echo "<option value='Reject Reason 2'>Reject Reason 2</option>";
                echo "</select>";
                echo "<br/><input type='text' id='".$rejectSpecifiedReason."' name='".$rejectSpecifiedReason."' maxlength='100' style='width:200px'></input>";
                echo "</div></div>";
                  echo "</td></tr>";
				}
               
            	}
				echo "<br/><input type='hidden' name='NumRec' value='".$Num."' ></input>";
              ?>  
                   <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
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
             <br/><button  type="submit" value="Submit" >Submit</button>
             </form>   
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



<?php include "footer2.php"; ?>
