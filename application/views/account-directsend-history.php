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
            <h2 class="title-2"><i class="icon-hourglass"></i><?php  if(strcmp($DirectSendType,"Seller")==0)  echo $this->lang->line("directsend_history_seller"); else echo $this->lang->line("directsend_history"); ?></h2>
            <div class="table-responsive">
              
              <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                  	
                    <th data-type="numeric" data-sort-initial="true"> </th>
                    <th> <?php echo $this->lang->line("To");?> </th><th> <?php echo $this->lang->line("Photo");?> </th>
                    <th data-sort-ignore="true">  <?php echo $this->lang->line("Item_Detail");?>  </th>
                    <th><?php echo $this->lang->line("status")?> </th>
                                 </tr>
                </thead>
                <tbody>
                  <?php 
                  if($result<>null)
            	{
            		$rowCount=0;
                  	foreach($result as $id=> $row)
                  	{
                  		$from=$row['from'];
                  		$reply=$row['reply'];
                  		$replyUserID=$row["replyUserID"];
                  		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
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
                    	echo "<td style=\"width:5%\" class=\"add-img-selector\"><div class=\"checkbox\">";
                        echo "<label>";
                        echo "  <input type=\"checkbox\">";
                        echo "</label>";
                      	echo "</div></td>";
                      	echo "<td style=\"width:10%\"><a href=$userPath>$reply</a></td>";
                    	echo "<td style=\"width:20%\" class=\"add-image\">";
                      	echo "<a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                    	echo "</td>";
                      	echo "<td style=\"width:55%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                    echo "<h5><div class=\"add-title-girlstrade\"><a href=$viewItemPath>".$this->lang->line("lblTitle").$previewTitle."</a></div><a href=$viewItemPath>".$previewDesc."</a>";
                          echo "<br/>Posted On: ". $createDate."</h5>";
                     	  if(strcmp($statusRP, 'A')==0)
                                   echo "Seller email: $sellerEmail";
                      	echo "</div></td>";
                      	echo "<td style=\"width:10%\">$status</td>";
                      	
                  		echo "</tr>";
                  	}
            	}
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
            	if($pageNum<>1)
            		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev\">Previous</a></li>";
            	echo "<li  class=\"active\"><a href=\"$url_path/$pageNum\">$pageNum</a></li>";
            	echo "<li><a href=\"$url_path/$pageNum2\">$pageNum2</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum3\">$pageNum3</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum4\">$pageNum4</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum5\">$pageNum5</a></li>";
              
               echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext\">Next</a></li>";
            ?>
                </ul>
          </div>
                </tbody>
              </table>
            </div>
            <!--/.row-box End--> 
            
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

<!-- /.wrapper --> 

<!-- Le javascript
================================================== --> 

 
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


</div>
<?php include "footer2.php"; ?>

