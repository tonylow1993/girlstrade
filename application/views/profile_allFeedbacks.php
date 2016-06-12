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
              <!-- Nav tabs -->
<<<<<<< HEAD
              <ul class="nav nav-tabs add-tabs">
                <li <?php if(strcmp($activeTab, "allAds")==0) echo "class=\"active\""; ?>><a href="<?php echo base_url().MY_PATH.'home/viewAllFeedback/'.$userID.'/1/'.$sortTypeID.'/'.$sortByDate.'/'.$sortByType.'/allAds?prevURL='.$previousCurrent_url;?>" id="allFb" name="allFb">
=======
              <ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
              <?php echo $activeTab;?>
                <li <?php if(strcmp($activeTab, "allAds")==0) echo "class=\"active\""; ?>><a href="<?php echo base_url().MY_PATH.'home/viewAllFeedback/'.$userID.'/1/'.$sortTypeID.'/'.$sortByDate.'/'.$sortByType.'/allAds?prevURL='.$previousCurrent_url;?>" >
>>>>>>> origin/master
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
<<<<<<< HEAD
                <li <?php if(strcmp($activeTab, "sellerAds")==0) echo "class=\"active\""; ?>><a href="<?php echo base_url().MY_PATH.'home/viewAllFeedback/'.$userID.'/1/'.$sortTypeID.'/'.$sortByDate.'/'.$sortByType.'/sellerAds?prevURL='.$previousCurrent_url;?>" id="sellerFb" name="sellerFb">
=======
                <li <?php if(strcmp($activeTab, "sellerAds")==0) echo "class=\"active\""; ?>><a href="<?php echo base_url().MY_PATH.'home/viewAllFeedback/'.$userID.'/1/'.$sortTypeID.'/'.$sortByDate.'/'.$sortByType.'/sellerAds?prevURL='.$previousCurrent_url;?>" >
>>>>>>> origin/master
                <?php echo $lblSellerInfo;?>
                <?php 
                  		if(SHOW_BRACKETS_PROFILE_PAGE==1){
                  			
                  		?>
                <span class="badge"><?php 
                $rowCount=0;
                if($result<>null && sizeof($result)>0)
						foreach($result as $id=>$item)
					{
						if(strcmp($item["typeID"], "seller")==0)
							continue;
						$rowCount=$rowCount+1;
					}
                	echo $rowCount;
                ?></span>
                <?php }?></a></li>
<<<<<<< HEAD
                <li <?php if(strcmp($activeTab, "buyerAds")==0) echo "class=\"active\""; ?>><a href="<?php echo base_url().MY_PATH.'home/viewAllFeedback/'.$userID.'/1/'.$sortTypeID.'/'.$sortByDate.'/'.$sortByType.'/buyerAds?prevURL='.$previousCurrent_url;?>" id="buyerFb" name="buyerFb">
=======
                <li <?php if(strcmp($activeTab, "buyerAds")==0) echo "class=\"active\""; ?>><a href="<?php echo base_url().MY_PATH.'home/viewAllFeedback/'.$userID.'/1/'.$sortTypeID.'/'.$sortByDate.'/'.$sortByType.'/buyerAds?prevURL='.$previousCurrent_url;?>"  >
>>>>>>> origin/master
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
              	 <div class="sortByDiv">
              <form style="margin-top: 5px;" action="<?php $basePath=base_url();
    			$path=$basePath.MY_PATH."home/viewAllFeedback/$userID/1?prevURL=".urlencode(current_url())."&prevViewFeedBack_Url=".urlencode(current_url());
    			echo $path;
               ?>"  method="POST" id="sortfrm" class="tab-filter" role="form"> 
                    	<input type="hidden" name="paneActiveTab" id="paneActiveTab" value="<?php echo $activeTab;?>" >
             
               <div  style="width:150px; display:inline-block">
               		<select class="form-control     "   name="selectSortType"   id="selectSortType" data-width="auto">
					  <option value="0" <?php if(strcmp($sortTypeID,"0")==0 or $sortTypeID==0) echo " selected='selected' ";?> >Sort type by...</option>
					  <option value="1" <?php if(strcmp($sortTypeID,"1")==0)  echo " selected='selected' ";?>>Date</option>
					  <option value="2" <?php if(strcmp($sortTypeID,"2")==0)  echo " selected='selected' ";?>>Type</option>
					</select>
                </div> 
            	<div id="sortByDateDiv" style="width:150px;display:none;">
					<select class="form-control     "   name="sortByDate"   id="sortByDate" data-width="auto" onchange="beginSort();">
					  <option value="0" <?php if(strcmp($sortByDate,"0")==0 or $sortByDate==0) echo " selected='selected' ";?> >Sort by...</option>
					  <option value="3" <?php  if(strcmp($sortByDate,"3")==0)   echo " selected='selected' ";?>>Date: Most Recent</option>
					  <option value="4" <?php  if(strcmp($sortByDate,"4")==0)   echo " selected='selected' ";?>>Date: Oldest</option>
					</select>
				</div> 
				<div id="sortByTypeDiv" style="width:150px;display:none;">
					<select class="form-control     "   name="sortByType"   id="sortByType" data-width="auto" onchange="beginSort();">
					  <option value="0" <?php if(strcmp($sortByType,"0")==0 or $sortByType==0) echo " selected='selected' ";?> >Sort type by...</option>
					  <option value="1" <?php  if(strcmp($sortByType,"1")==0)   echo " selected='selected' ";?>>Good</option>
					  <option value="2" <?php  if(strcmp($sortByType,"2")==0)   echo " selected='selected' ";?>>Bad</option>
					  <option value="3" <?php  if(strcmp($sortByType,"3")==0)   echo " selected='selected' ";?>>Average</option>
					</select>
				</div> 
					<noscript><input type="submit" value="Submit"></noscript>
			
			</form></div>
                  <div class="pull-right backtolist margin-5"><a href=<?php echo $prevViewFeedBack_Url;?>> <i class="fa fa-angle-double-left"></i> Back to Results</a></div>
            
              </div>
            <div class="adds-wrapper inner-box no-shadow">
             
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
                  		
                  		$type=$row["type"];
                  		$fromUser=$row["fromUser"];
                  		$feedback=$row["feedback"];
                  		$createDate=$row["createDate"];
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
                  		if(strcmp($row["typeID"], "buyer")==0)
                  			continue;
                  		$type=$row["type"];
                  		$fromUser=$row["fromUser"];
                  		$feedback=$row["feedback"];
                  		$createDate=$row["createDate"];
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
                  		if(strcmp($row["typeID"], "seller")==0)
                  			continue;
                  		$type=$row["type"];
                  		$fromUser=$row["fromUser"];
                  		$feedback=$row["feedback"];
                  		$createDate=$row["createDate"];
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
                
                </tbody>
              </table>
              
       		
               </div>
            	<div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$encodeCurrentURL=urlencode(current_url());
            	$url_path=base_url().MY_PATH."home/viewAllFeedback/$userID";
            	$pageNumPrev=$pageNum-1;
            	$pageNum2=$pageNum+1;
            	$pageNum3=$pageNum+2;
            	$pageNum4=$pageNum+3;
            	$pageNum5=$pageNum+4;
            	$pageNumNext=$pageNum+5;
            	$itemPerPage=ITEMS_PER_PAGE;
            	$activeTabpage3=$activeTab;
            	 
            	if($NoOfItemCount>0)
            	{
            		if($pageNum<>1)
            			echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev/$sortTypeID/$sortByDate/$sortByType/$activeTabpage3?prevURL=$previousCurrent_url;\">Previous</a></li>";
            		if($NoOfItemCount > 0)
            			echo "<li  class=\"active\"><a href=\"$url_path/$pageNum/$sortTypeID/$sortByDate/$sortByType/$activeTabpage3?prevURL=$previousCurrent_url;\">$pageNum</a></li>";
            		if($NoOfItemCount > ($pageNum*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum2/$sortTypeID/$sortByDate/$sortByType/$activeTabpage3?prevURL=$previousCurrent_url;\">$pageNum2</a></li>";
              		if($NoOfItemCount > ($pageNum2*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum3/$sortTypeID/$sortByDate/$sortByType/$activeTabpage3?prevURL=$previousCurrent_url;\">$pageNum3</a></li>";
              		if($NoOfItemCount > ($pageNum3*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum4/$sortTypeID/$sortByDate/$sortByType/$activeTabpage3?prevURL=$previousCurrent_url;\">$pageNum4</a></li>";
              		if($NoOfItemCount > ($pageNum4*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum5/$sortTypeID/$sortByDate/$sortByType/$activeTabpage3?prevURL=$previousCurrent_url;\">$pageNum5</a></li>";
              		if($NoOfItemCount > ($pageNum5*$itemPerPage))
            	 	   echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext/$sortTypeID/$sortByDate/$sortByType/$activeTabpage3?prevURL=$previousCurrent_url;\">Next</a></li>";
           		}
             ?>
                </ul>
          </div>
            
            </div>
            
            
            
            
         	  </div>
       		</div>
       		
          
      
      </div>
    </div>
  </div>
  </div>
  <script>

function beginSort(){
	var selectSortType=document.getElementById("selectSortType").value;
	var sortByType=document.getElementById("sortByType").value;
	var sortByDate=document.getElementById("sortByDate").value;
	var sortByDate=document.getElementById("sortByDate").value;
	 var activeTab=document.getElementById("paneActiveTab").value;
		
	var actionpath="<?php echo base_url().MY_PATH.'home/viewAllFeedback/'.$userID.'/1';?>".concat("/").concat(selectSortType).concat("/").concat(sortByDate).concat("/").concat(sortByType).concat("/").concat(activeTab).concat("<?php echo '?prevURL='.urlencode(current_url()).'&prevViewFeedBack_Url='.urlencode(current_url());?>");
	
		document.getElementById("sortfrm").action=actionpath;
		document.getElementById("sortfrm").submit();
	
}

$( document ).ready(function() {
    var sortType=document.getElementById('selectSortType').value;
    if(sortType=="2"){
 	   document.getElementById('sortByDateDiv').style.display = 'none';
 	   document.getElementById('sortByTypeDiv').style.display = 'inline-block';
 	  }
 	  else if(sortType=="1"){
 		  document.getElementById('sortByDateDiv').style.display = 'inline-block';
 	   document.getElementById('sortByTypeDiv').style.display = 'none';
 		  
 	  }else
 		  {
 		   document.getElementById('sortByDateDiv').style.display = 'none';
 		   document.getElementById('sortByTypeDiv').style.display = 'none';
 		  }
});

$('#selectSortType').change(function() {
	  if($(this).val()=="2"){
	   document.getElementById('sortByDateDiv').style.display = 'none';
	   document.getElementById('sortByTypeDiv').style.display = 'inline-block';
	  }
	  else if($(this).val()=="1"){
		  document.getElementById('sortByDateDiv').style.display = 'inline-block';
	   document.getElementById('sortByTypeDiv').style.display = 'none';
		  
	  }else
		  {
		   document.getElementById('sortByDateDiv').style.display = 'none';
		   document.getElementById('sortByTypeDiv').style.display = 'none';
		  }
});

</script>


  
  <!-- /.main-container -->
  
  <?php include "footer1.php"; ?>
</div>


    <?php include "footer2.php"; ?>

