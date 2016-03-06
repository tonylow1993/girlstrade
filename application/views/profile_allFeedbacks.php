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
           <div class="tab-box "> 
                 <div class="pull-right backtolist margin-right-10"><a href=<?php echo $previousCurrent_url;?>> <i class="fa fa-angle-double-left"></i> Back to Results</a></div>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
                <li <?php if(strcmp($activeTab, "allAds")==0) echo "class=\"active\""; ?>><a href="#allAds"  role="tab" data-toggle="tab">
                <?php echo $lblConditionAll;?>
                <?php 
                  		if(SHOW_BRACKETS_PROFILE_PAGE==1){
                  			
                  		?>
                <span class="badge"><?php 
                $rowCount=0;
                if($result<>null && sizeof($result)>0)
					$rowCount=sizeof($result);
                echo $rowCount;
                ?></span>
                <?php }?></a></li>
                <li <?php if(strcmp($activeTab, "sellerAds")==0) echo "class=\"active\""; ?>><a href="#sellerAds"  role="tab" data-toggle="tab">
                <?php echo $lblSellerInfo;?>
                <?php 
                  		if(SHOW_BRACKETS_PROFILE_PAGE==1){
                  			
                  		?>
                <span class="badge"><?php 
                $rowCount=0;
                if($result<>null && sizeof($result)>0)
						foreach($result as $id=>$item)
					{
						if(strcmp($item["typeID"], "buyer")==0)
							continue;
						$rowCount=$rowCount+1;
					}
                	echo $rowCount;
                ?></span>
                <?php }?></a></li>
                <li <?php if(strcmp($activeTab, "buyerAds")==0) echo "class=\"active\""; ?>><a href="#buyerAds"  role="tab" data-toggle="tab">
                <?php echo $lblBuyerInfo;?> 
                <?php 
                  		if(SHOW_BRACKETS_PROFILE_PAGE==1){
                  			
                  		?><span class="badge">
	                <?php 
	                $rowCount=0;
	                if($result<>null && sizeof($result)>0)
						foreach($result as $id=>$item)
						{
							if(strcmp($item["typeID"], "buyer")<>0)
								continue;
							$rowCount=$rowCount+1;
						}
	                	echo $rowCount;
	                ?></span>
	                <?php }?></a></li>
              </ul>
              </div>
            <div class="adds-wrapper">
            <div class="tab-content">
               <div class="tab-pane fade <?php if(strcmp($activeTab, "allAds")==0) echo "in active"; ?>" id="allAds">
               
              <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr style="height:50px;">
                    <th style="border: none;"> <?php echo $this->lang->line("Photo");?> </th>
                    <th data-sort-ignore="true" style="border: none;"> <?php echo $this->lang->line("Ads_Detail");?> </th>
                  </tr>
                </thead>
                <tbody>
                	<?php 
                	if($result<>null)
            	{
            		foreach($result as $id=>$row)
                  	{
                  		
						echo "<tr>";
                      	echo "<td style=\"width:20%;height:150px;padding:0px; margin: 0px; border: none;\">";
                      	echo "<p>$type</p> <p>$fromUser</p>";
						echo "</td>";
					  	echo "<td style=\"width:55%; border: none;\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                         echo "<h5><div class=\"add-title-girlstrade\">$feedback</div>";
                          echo "<br/>Posted On: ". $createDate;
                        echo "</h5></div></td>";
                      	
                  		echo "</tr>";
                  	}
            	}
                  ?>
                   <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$url_path=base_url().MY_PATH."home/viewAllFeedback/$userID";
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
            
            <div class="tab-pane <?php if(strcmp($activeTab, "sellerAds")==0) echo "active"; ?>" id="sellerAds">
               <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr style="height:50px;">
                    <th style="border: none;"> <?php echo $this->lang->line("Photo");?> </th>
                    <th data-sort-ignore="true" style="border: none;"> <?php echo $this->lang->line("Ads_Detail");?> </th>
                  </tr>
                </thead>
                <tbody>
                	<?php 
                	if($result<>null)
            	{
            		foreach($result as $id=>$row)
            		{
            			if(strcmp($row["typeID"],"buyer")<>0){
	            			echo "<tr>";
	                      	echo "<td style=\"width:20%;height:150px;padding:0px; margin: 0px; border: none;\">";
	                      	echo "<p>$type</p> <p>$fromUser</p>";
							echo "</td>";
						  	echo "<td style=\"width:55%; border: none;\" class=\"ads-details-td\">";
	                    	echo "<div class=\"ads-details\">";
	                         echo "<h5><div class=\"add-title-girlstrade\">$feedback</div>";
	                          echo "<br/>Posted On: ". $createDate;
	                        echo "</h5></div></td>";
	                      	
	                  		echo "</tr>";
            			}
                  	}
            	}
                  ?>
                   <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$url_path=base_url().MY_PATH."home/viewAllFeedback/$userID";
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
               <div class="tab-pane <?php if(strcmp($activeTab, "buyerAds")==0) echo "active"; ?>" id="buyerAds">
              <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr style="height:50px;">
                    <th style="border: none;"> <?php echo $this->lang->line("Photo");?> </th>
                    <th data-sort-ignore="true" style="border: none;"> <?php echo $this->lang->line("Ads_Detail");?> </th>
                  </tr>
                </thead>
                <tbody>
                	<?php 
                	if($result<>null)
            	{
            		foreach($result as $id=>$row)
            		{
            			if(strcmp($row["typeID"],"buyer")==0){
	            			echo "<tr>";
	                      	echo "<td style=\"width:20%;height:150px;padding:0px; margin: 0px; border: none;\">";
	                      	echo "<p>$type</p> <p>$fromUser</p>";
							echo "</td>";
						  	echo "<td style=\"width:55%; border: none;\" class=\"ads-details-td\">";
	                    	echo "<div class=\"ads-details\">";
	                         echo "<h5><div class=\"add-title-girlstrade\">$feedback</div>";
	                          echo "<br/>Posted On: ". $createDate;
	                        echo "</h5></div></td>";
	                      	
	                  		echo "</tr>";
            			}
                  	}
            	}
            	?>
                   <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$url_path=base_url().MY_PATH."home/viewAllFeedback/$userID";
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
  </div>
  </div>
  


  
  <!-- /.main-container -->
  
  <?php include "footer1.php"; ?>
</div>


    <?php include "footer2.php"; ?>

