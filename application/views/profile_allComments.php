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
                  <tr>
                    <th data-type="numeric" data-sort-initial="true"> </th>
                    <th> <?php echo $this->lang->line("Reply"); ?> </th><th> <?php echo $this->lang->line("Photo"); ?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Ads_Detail"); ?> </th>
        	           
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if($result<>null)
            	{
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
                  		$commentID=$row["commentID"];
                  		$enableMarkSoldBtn=$row["enableMarkSoldBtn"];
//                   		$NoOfDaysPending=$row['NoOfDaysPending'];
// 						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
                		echo "<tr>";
                    	echo "<td style=\"width:5%\" class=\"add-img-selector\"><div class=\"checkbox\">";
                        echo "<label>";
                        echo "  <input type=\"checkbox\">";
                        echo "</label>";
                      	echo "</div></td>";
                      	echo "<td style=\"width:10%\">$reply</td>";
                    	echo "<td style=\"width:20%\" class=\"add-image\">";
                      	echo "<a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                    	echo "</td>";
                      	echo "<td style=\"width:55%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                       echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
                          echo "<br/>Posted On: ". $createDate;
                          echo "<br/>".$preview."</h5>";
                    		echo "</div></td>";
//                      	
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
            		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev.'?prevURL='.$previousCurrent_url;\">Previous</a></li>";
            	echo "<li  class=\"active\"><a href=\"$url_path/$pageNum.'?prevURL='.$previousCurrent_url;\">$pageNum</a></li>";
            	echo "<li><a href=\"$url_path/$pageNum2.'?prevURL='.$previousCurrent_url;\">$pageNum2</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum3.'?prevURL='.$previousCurrent_url;\">$pageNum3</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum4.'?prevURL='.$previousCurrent_url;\">$pageNum4</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum5.'?prevURL='.$previousCurrent_url;\">$pageNum5</a></li>";
              
               echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext.'?prevURL='.$previousCurrent_url;\">Next</a></li>";
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

