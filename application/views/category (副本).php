<?php $title = "Search Page";  include("header.php"); ?>

<div id="wrapper">
  
  <!-- /.header -->
  <!-- <div class="search-row-wrapper">-->
  <br/>
    <div class="container ">
      <form  id="myForm"  onSubmit="return setup()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/'.$sortByID_;?>" method="POST">
            <div class="col-lg-3 col-sm-3 search-col relative"> <i class="icon-docs icon-append"></i>
                <input type="text" name="ads"  id="ads" class="form-control has-icon" placeholder="Keywords" value="<?php if($keywords<>'0') echo trim($keywords);?>">
              </div>
            
            <div class="col-sm-3">
          <select class="form-control    " name="category" id="search-category" >
        	<?php 
        	$str="";
        	if($catID_==null or $catID_=="" or $catID_==0)
        		$str=" selected='selected' ";
        	echo "<option ".$str." value='0'>".$lblAllCategories."</option>";
            foreach ($result as $id=>$value)
            {
            	if(!isset($lang_label))
	            		$lang_label="";
            	$name=$value[0]->name;
            	$postCount="(".$value[0]->postCount.")";
            	if($lang_label<>"english")
            		$name=$value[0]->nameCH;
            	if($value[0]->level==1)
            	{
            		$str="";
            		if(strcmp($catID_,$id)==0)
            			$str=" selected='selected' ";
            		 echo "<option value='".$id."' ".$str." style='background-color:#E9E9E9;font-weight:bold;' > ".$name.$postCount." </option>";
            	}else 
            	{
            		$str="";
            		if(strcmp($catID_,$id)==0)
            			$str=" selected='selected' ";
            		echo "<option ".$str." value='".$id."'> &nbsp;&nbsp;&nbsp;&nbsp;".$name.$postCount." </option>";
            	}
            }
            ?>
          </select>
        </div>
<!--         <div class="col-sm-3"> -->
<!--           <select class="form-control    " name="location" id="id-location"> -->
            <?php 
//             $str="";
//             if($locID_==null or $locID_=="" or $locID_=='0')
//             	$str=" selected='selected' ";
//             echo "<option ".$str." value='0'> ".$lblAllLocations." </option>";
            
//             foreach ($resLoc as $id=>$value)
//             {
//             if(!isset($lang_label))
// 	            		$lang_label="";
//             	$name=$value[0]->name;
//             	if($lang_label<>"english")
//             		$name=$value[0]->nameCN;
//             	if($value[0]->level==1)
//             		echo "<option value='".$id."' style='background-color:#E9E9E9;font-weight:bold;' disabled='disabled'> -".$name." - </option>";
//             	else 
//             	{
//             		$str="";
//             		if($locID_==$id)
//             			$str=" selected='selected' ";
//             		echo "<option ".$str." value='".$id."'> ".$name." </option>";
//             	}
//             }
//             ?>
<!--           </select> -->
<!--           </div> -->
          <div class="col-sm-3">
              <select class="form-control    "  id="sortByPrice" name="sortByPrice"  >
                  <option value="0"   <?php if(strcmp($sortByID_,"0")==0 or $sortByID_==0 or $sortByID_=='') echo " selected='selected' ";?> ><?php echo $lblSearchSortBy;?></option>
                  <option value="1"   <?php if(strcmp($sortByID_,"1")==0)  echo " selected='selected' ";?> > <?php echo $lblPriceLowToHigh;?></option>
                  <option value="2"   <?php if(strcmp($sortByID_,"2")==0)  echo " selected='selected' ";?> > <?php echo $lblPriceHighToLow;?></option>
                </select>
            </div>
           <div class="col-sm-3">
            	<button class="btn btn-primary btn-block btn-pink"> <i class="fa fa-search"></i> </button>  	
<!--            	        	 <button class="btn btn-block btn-primary  "> <i class="fa fa-search"></i> </button> -->
           	</div>
            
            <!--/.tab-box-->
       
      </form>
    </div>
  <!--  </div> -->
  <!-- /.search-row -->
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 page-sidebar">
          <aside>
            <div class="inner-box">
              
              <!--/.categories-list-->
              
              <div class="locations-list  list-filter">
                <h5 class="list-title"><strong><a href="#"><?php echo $lblLocation;?></a></strong></h5>
                <ul class="browse-list list-unstyled long-list">
                <?php 
	            foreach ($resLoc as $id=>$value)
	            {
	            	$postCount="(".$value[0]->postCount.")";
	            	if(!isset($lang_label))
	            		$lang_label="";
	            	$name=$value[0]->name;
	            	$basePath=base_url().MY_PATH."getCategory/getAll/1/".$catID_.'/'.$id.'/'.$keywords.'/'.$sortByID_;
	            	if($lang_label<>"english")
	            		$name=$value[0]->nameCN;
	            	if($value[0]->level==1)
	            		echo "<li> <a href=\"$basePath\">$name.$postCount</a></li>";
	            	
	            	}
	            ?>
                </ul>
              </div>
              
              <!--/.locations-list-->
              
              <div class="locations-list  list-filter">
                <h5 class="list-title"><strong><a href="#"><?php echo $lblPriceRange;?></a></strong></h5>
                <form role="form"  id="priceForm" class="form-inline "  onSubmit="return priceSetup()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/'.$sortByID_;?>" method="POST">  
                  <div class="form-group col-sm-4 no-padding">
                    <input type="number" placeholder="100"   value=<?php echo $minPrice;?>  id="minPrice"   name="minPrice"  min="0"  max="90000" class="form-control">
                  </div>
                  <div class="form-group col-sm-1 no-padding text-center margin-top-10">To</div>
                  <div class="form-group col-sm-4 no-padding">
                    <input type="number" placeholder="1000 " id="maxPrice"  value=<?php echo $maxPrice;?>  name="maxPrice" min="0" max="90000"   class="form-control">
                  </div>
                  <div class="form-group col-sm-3 no-padding">
                    <button class="btn btn-default pull-right" type="submit">GO</button>
                  </div>
                </form>
                <div style="clear:both"></div>
              </div>
              <!--/.list-filter
              <div class="locations-list  list-filter">
                <h5 class="list-title"><strong><a href="#"><?php echo $lblPaymentOptions;?></a></strong></h5>
                <ul class="browse-list list-unstyled long-list">
                  <li> <a href="#"><strong>All</strong> <span class="count">228,705</span></a></li>
                  <li> <a href="#">Local Pickup<span class="count">28,705</span></a></li>
                  <li> <a href="#">International Shipping<span class="count">18,705</span></a></li>
                </ul>
              </div>
              /.list-filter-->
              
              <div style="clear:both"></div>
            </div>
            
            <!--/.categories-list--> 
          </aside>
        </div>
        <!--/.page-side-bar-->
        <div class="col-sm-9 page-content col-thin-left">
          <div class="category-list">
           <div class="listing-filter">
              <div class="pull-left col-xs-6">
               </div>
              <div class="pull-right col-xs-6 text-right listing-view-action"> <span class="list-view active"><i class="  icon-th"></i></span> <span class="compact-view"><i class=" icon-th-list  "></i></span> <span class="grid-view "><i class=" icon-th-large "></i></span> </div>
              <div style="clear:both"></div>
            </div>
              
            <div class="adds-wrapper">
              <div class="tab-content">
                <div class="tab-pane active" id="allAds">
                	<?php
             $basePath=base_url().MY_PATH;
             $encodeCurrentURL=urlencode(current_url());
              if($itemList<>null && sizeof($itemList)>0)
              {
              	$rowCount=0;
              foreach($itemList as $id=>$item)
				{
					$rowCount=$rowCount+1;
				  $viewBasePath=$basePath."viewItem/index/".$id."?prevURL=".$encodeCurrentURL;
              		$locationName=$item["locationName"];
					$categoryName=$item["categoryName"];
					$postCurrency=$item['postCurrency'];
					$postItemPrice=$item['postItemPrice'];
					$postDescription=$item['postDescription'];
					$postTitle=$item['postTitle'];
					$postCreateDate=$item['postCreateDate'];
					$picCount=$item["picCount"];
					$thumbnail=base_url().$item['thumbnailPath'].'/'.$item['thumbnailName'];
					$postTypeAds=$item["postTypeAds"];	
					echo  "<div class=\"item-list\"> ";
					
					if($postTypeAds=='topAds')
					{
					echo "<div class=\"cornerRibbons topAds\">";
 					echo  " <a href=\"#\"> Top Ads</a>";
					echo "</div>";
					}
					else if($postTypeAds=='featuredAds')
					{
					echo "<div class=\"cornerRibbons featuredAds\"> ";
					echo "<a href=\"#\"> Featured Ads</a>";
					echo "</div>";
					}
					else if($postTypeAds=='urgentAds')
					{
					echo "<div class=\"cornerRibbons urgentAds\">";
					echo "<a href=\"#\"> Urgent</a>";
					echo "</div>";
					}			
					
					echo  "<div class=\"col-sm-2 no-padding photobox\">";
// 						echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";              			
					echo "<div class=\"add-image\" ><div style=\"height:100px;padding:0px; margin: 0px;\" ><span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span>";
						$sizeimage=getimagesize($thumbnail);
						// 	                  		echo "<p style=\"font-size:8px;padding:0px; margin: 0px;\">image size: ".$sizeimage[0]."x".$sizeimage[1]."</p>";
						echo "<p style=\"font-size:8px;padding:0px; margin: 0px;\">image size: ".$sizeimage[0]."x".$sizeimage[1]."</p>";
						
						if($sizeimage[1]>90)
						{
							$widthSize=$sizeimage[0]* 90/ $sizeimage[1];
							if($sizeimage[0]>70* 90/ $sizeimage[1])
								echo "<a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\"  style=\"height:100%; width:".$widthSize."px; padding:0px; margin:0px;\"  src=$thumbnail alt=\"img\"></a> </div></div>";
							else
								echo "<a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\"   style=\"height:100%; width:auto; padding:0px; margin:0px;\"   src=$thumbnail alt=\"img\"></a> </div></div>";
							}else{
							echo "<a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\"  style=\"height:auto; width:100%; padding:0px; margin:0px;\"   src=$thumbnail alt=\"img\"></a> </div></div>";
							// 		              		echo "<li><img src=$imagePath alt=\"img\"  /></li>";
						}
						
						
						
						
						
						
						
						
              		$ctrlName="AjaxLoad".$rowCount;
              		$errorctrlName="ErrAjaxLoad".$rowCount;
              		$ctrlValue="post".$rowCount;
              		$postID2=$id;
              		$clickLink="clickLink".$rowCount;
              		$title=$this->lang->line("lblTitle");
				echo "</div>";
			    echo "<div class=\"col-sm-7 add-desc-box\">";
                  echo "<div class=\"ads-details\">";
                   echo "<h5><div class=\"add-title-girlstrade\"> <a href=\"$viewBasePath\">$title $postTitle </a></div><a href=\"$viewBasePath\">$postDescription</a></h5>";
                   echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $postCreateDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h2 class=\"item-price\"> $postCurrency $postItemPrice</h2>";
                echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
                echo "[<a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>]  [<a href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL>View Details</a>]</div>";
               echo "</div>";
               }
                         
              }else{
              	echo "<div align='center'><h2>".$this->lang->line("NoRecordsFound")."</h2></div>";
              }
				
              ?>  
                
                
                
                </div>
               
              </div>
            </div>
            <!--/.adds-wrapper-->
            
<!--             <div class="tab-box  save-search-bar text-center"> <a href=""> <i class=" icon-star-empty"></i> Save Search </a> </div> -->
          </div>
          <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$url_path=base_url().MY_PATH."getCategory/getAll";
            	
            	if($keywords<>'0' && $keywords<>0)
            		$keywords=base64_encode($keywords);
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
	            		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev/$catID_/$locID_/$keywords/$sortByID_\">Previous</a></li>";
	            	if($NoOfItemCount > 0)
	              		echo "<li  class=\"active\"><a href=\"$url_path/$pageNum/$catID_/$locID_/$keywords/$sortByID_\">$pageNum</a></li>";
	            	if($NoOfItemCount > ($pageNum*$itemPerPage))
	              		echo "<li><a href=\"$url_path/$pageNum2/$catID_/$locID_/$keywords/$sortByID_\">$pageNum2</a></li>";
	              	if($NoOfItemCount > ($pageNum2*$itemPerPage))
	              		echo "<li><a href=\"$url_path/$pageNum3/$catID_/$locID_/$keywords/$sortByID_\">$pageNum3</a></li>";
	              	if($NoOfItemCount > ($pageNum3*$itemPerPage))
	              		echo "<li><a href=\"$url_path/$pageNum4/$catID_/$locID_/$keywords/$sortByID_\">$pageNum4</a></li>";
	              	if($NoOfItemCount > ($pageNum4*$itemPerPage))
	              		echo "<li><a href=\"$url_path/$pageNum5/$catID_/$locID_/$keywords/$sortByID_\">$pageNum5</a></li>";
	             	if($NoOfItemCount > ($pageNum5*$itemPerPage))
	              		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext/$catID_/$locID_/$keywords/$sortByID_\">Next</a></li>";
            	}
             ?>
                </ul>
          </div>
          
          
        </div>
        
      </div>
    </div>
  </div>
  <!-- /.main-container -->

<?php include "footer1.php"; ?>
  <!-- /.footer --> 
  <script>
function setup(){
	var catID=document.getElementById("search-category").value;
// 	var locID=document.getElementById("id-location").value;
	var locID=0;
	var sortByID=document.getElementById("sortByPrice").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	document.getElementById("myForm").action="http://www.girlstrade.com/index.php/getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat(sortByID);
	document.getElementById("myForm").submit();
}
function priceSetup(){
	var catID=document.getElementById("search-category").value;
// 	var locID=document.getElementById("id-location").value;
var locID=0;
	var sortByID=document.getElementById("sortByPrice").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var minPrice=document.getElementById("minPrice").value;
	   var maxPrice=document.getElementById("maxPrice").value;
	document.getElementById("priceForm").action="http://www.girlstrade.com/index.php/getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat(sortByID).concat("/").concat(minPrice).concat("/").concat(maxPrice);
	document.getElementById("priceForm").submit();
}
function savedAds(ctrlValue, ctrlName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>getCategory/savedAds",
		data: { postID: $( "#".concat(ctrlValue) ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#Err".concat(ctrlName)).html(result.message);
	    	}
	});
};
</script>
<!-- /.wrapper --> 

<!-- Modal Change City -->



<!-- /.modal --> 


<?php include "footer2.php"; ?>

</div>