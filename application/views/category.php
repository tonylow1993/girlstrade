<?php $title = "Search Page";  include("header.php"); ?>
<!-- CSS WHEEL SLIDER -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/noUiSlider/jquery.nouislider.min.css">
<div id="wrapper">
  
  <!-- /.header -->
  <!-- <div class="search-row-wrapper">-->
  <br/>
  <div class="search-row-wrapper">
    <div class="container ">
      <form  id="myForm"  onSubmit="return setup()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/'.$sortByID_;?>" method="POST">
            <div class="col-lg-3 col-sm-3 search-col relative"> <i class="icon-docs icon-append"></i>
                <input type="text" name="ads"  id="ads" class="form-control has-icon" placeholder="Keywords" value="<?php if($keywords<>'0') echo trim($keywords);?>">
              </div>
            
            <div class="col-sm-3">
          <select class="form-control selecter" name="category" id="search-category" >
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
        <div class="col-sm-3"> 
          <select class="form-control selecter" name="location" id="id-location"> 
            <?php 
             $str="";
             if($locID_==null or $locID_=="" or $locID_=='0')
             	$str=" selected='selected' ";
             echo "<option ".$str." value='0'> ".$lblAllLocations." </option>";
            
             foreach ($resLoc as $id=>$value)
             {
             if(!isset($lang_label))
 	            		$lang_label="";
             	$name=$value[0]->name;
             	if($lang_label<>"english")
             		$name=$value[0]->nameCN;
             	if($value[0]->level==1){
             		$str="";
             		if(strcmp($locID_,$id)==0)
             			$str=" selected='selected' ";
             		echo "<option ".$str." value='".$id."' style='background-color:#E9E9E9;font-weight:bold;'>".$name."</option>";
             	}else if($value[0]->level==2)
             	{
             		$str="";
             		if($locID_==$id)
             			$str=" selected='selected' ";
             		echo "<option ".$str." value='".$id."' style='background-color:#E9E9E9;'>--".$name." </option>";
             	}else if($value[0]->level==3)
             	{
             		$str="";
             		if($locID_==$id)
             			$str=" selected='selected' ";
             		echo "<option ".$str." value='".$id."'>----".$name." </option>";
             	}
             }
             ?>
           </select>
           </div>
          <!-- <div class="col-sm-3">
              <select class="form-control selecter"  id="sortByPrice" name="sortByPrice"  >
                  <option value="0"   <?php if(strcmp($sortByID_,"0")==0 or $sortByID_==0 or $sortByID_=='') echo " selected='selected' ";?> ><?php echo $lblSearchSortBy;?></option>
                  <option value="1"   <?php if(strcmp($sortByID_,"1")==0)  echo " selected='selected' ";?> > <?php echo $lblPriceLowToHigh;?></option>
                  <option value="2"   <?php if(strcmp($sortByID_,"2")==0)  echo " selected='selected' ";?> > <?php echo $lblPriceHighToLow;?></option>
                </select>
            </div>-->
           <div class="col-sm-3">
            	<button class="btn btn-primary btn-block btn-pink"> <i class="fa fa-search"></i> Search</button>  	
<!--            	        	 <button class="btn btn-block btn-primary  "> <i class="fa fa-search"></i> </button> -->
           	</div>
            
            <!--/.tab-box-->
       
      </form>
      </div>
    </div>
  <!--  </div> -->
  <!-- /.search-row -->
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div id="leftMenuSearchPage" class="col-sm-3 page-sidebar">
          <aside>
            <div class="inner-box panel-bevel">
              
              <!--/.categories-list-->
              
              <div class="locations-list  list-filter">
                <h5 class="list-title"><strong>
                <a href="javascript:void(0);">
                <i class="icon-location-circled"></i><?php echo trim($lblLocation);?></a></strong></h5>
                <ul class="browse-list list-unstyled long-list">
                
                
               <?php  
              $level=0;
               $locationID=1;
               foreach ($resLoc as $id=>$value)
               {
               	if($value[0]->locationID==0)
               		continue;
               	if(!isset($lang_label))
               		$lang_label="";
               		$name=$value[0]->name." (".$value[0]->viewCount.")";
               		if($lang_label<>"english")
               			$name=$value[0]->nameCN." (".$value[0]->viewCount.")";
               			$path=base_url().MY_PATH."getCategory/getAll/1/0/".$value[0]->locationID;
               			if($value[0]->level==1){
               				
               				if($level==2){
               				
               				}else if($level==3){
               					echo "</ul></div></ul>
               					</div>";
               					if($value[0]->locationID==2){
               						$locationID=2;
               						echo "<li>
               						<a id=\"bigCatHK\" class=\"openCat\" data-toggle=\"collapse\" data-target=\"#hongkongDist\" href=\"#hongkongDist;javascript:void(0);\" onclick='return openCat(this.id);'>
               						<span class=\"badge openCat\">
               						<i class=\"glyphicon glyphicon-plus\"></i>
               						</span>
               						</a>
               						<a id=\"searchCriteria\" style=\"background-color: green;color: white;\" class=\"listForOpenCat\" href=\"$path\">$name</a>
               						</li>
               						
               						<div id=\"hongkongDist\" class=\"panel-collapse collapse\">
               						<ul class=\" list-unstyled long-list\">
               							<li>
               							<a id=\"smallCatKTArea\" class=\"openCat\" data-toggle=\"collapse\" data-target=\"#hkArea\"
               								href=\"#hkArea;javascript:void(0);\" onclick='return openCat(this.id);'>
               								<span class=\"badge openSubCat\">
               								<i class=\"glyphicon glyphicon-plus\"></i>
               								</span>
               								</a>";
               					}else if($value[0]->locationID==3){
               						$locationID=3;
               						echo "<li>
               						<a id=\"bigCatNewTerr\" class=\"openCat\" data-toggle=\"collapse\" data-target=\"#newTerrDist\"
               								href=\"#newTerrDist;javascript:void(0);\" onclick='return openCat(this.id);'>
               								<span class=\"badge openCat\">
               								<i class=\"glyphicon glyphicon-plus\"></i>
               								</span>
               								</a>
               								<a id=\"searchCriteria\" style=\"background-color: red;color: white;\" class=\"listForOpenCat\" href=\"$path\">
               								$name</a>
               								</li>
               						
               								<div id=\"newTerrDist\" class=\"panel-collapse collapse\">
               								<ul class=\" list-unstyled long-list\">
               									<li>
               									<a id=\"smallCatKTArea\" class=\"openCat\" data-toggle=\"collapse\" data-target=\"#ntArea\"
               										href=\"#ntArea;javascript:void(0);\" onclick='return openCat(this.id);'>
               										<span class=\"badge openSubCat\">
               										<i class=\"glyphicon glyphicon-plus\"></i>
               										</span>
               										</a>";
               					}
               				}else if($level==0){
               			
	               				if($value[0]->locationID==1){	
	               				echo "<li>
	               				<a id=\"bigCatKowloon\" class=\"openCat\" data-toggle=\"collapse\" data-target=\"#kowloonDist\"
	               						href=\"#kowloonDist;javascript:void(0);\" onclick='return openCat(this.id);'>
	               						<span class=\"badge openCat\">
	               						<i class=\"glyphicon glyphicon-plus\"></i>
	               						</span>
	               						</a>
	               						<a id=\"searchCriteria\" style=\"background-color: blue;color: white;\" class=\"listForOpenCat\" href=\"$path\">
	               						$name
	               						</a>
	               						</li>
	               						<div id=\"kowloonDist\" class=\"panel-collapse collapse\">
	               						<ul class=\" list-unstyled long-list\">
	               						<li>
	               						<a id=\"smallCatKTArea\" class=\"openCat\" data-toggle=\"collapse\" data-target=\"#ktArea\"
	               								href=\"#ktArea;javascript:void(0);\" onclick='return openCat(this.id);'>
	               								<span class=\"badge openSubCat\">
	               								<i class=\"glyphicon glyphicon-plus\"></i>
	               								</span>
	               								</a>";
	               				}
               				}
               				$level=1;
               			}else if($value[0]->level==2)
               			{
               				if($level==1){
               					
               					
               					if($locationID==1){
               						echo "<a id=\"searchCriteria\" style=\"color:blue;\" class=\"listForOpenCat\" href=\"$path\">
               						$name
               						</a>
               						</li>";
	               					echo "<div id=\"ktArea\" class=\"panel-collapse collapse\">
	               					<ul class=\" list-unstyled long-list\">";
	               					
               					}
               					else if($locationID==2){
               						echo "<a id=\"searchCriteria\" style=\"color:green;\" class=\"listForOpenCat\" href=\"$path\">
               						$name
               						</a>
               						</li>";
               						echo "<div id=\"hkArea\" class=\"panel-collapse collapse\">
               					<ul class=\" list-unstyled long-list\">";
               					}else if($locationID==3){
               						echo "<a id=\"searchCriteria\" style=\"color:red;\" class=\"listForOpenCat\" href=\"$path\">
               						$name
               						</a>
               						</li>";
               						echo "<div id=\"ntArea\" class=\"panel-collapse collapse\">
               					<ul class=\" list-unstyled long-list\">";
               					}
               					
               				}else if($level==3){
               					$areaID="";
               					$style="";
               					if($locationID==1){
               						$areaID="ktArea".$value[0]->locationID;
               						$style="style=\"color:blue;\"";
               					}
               					else if($locationID==2){
               						$areaID="hkArea".$value[0]->locationID;
               						$style="style=\"color:green;\"";
               					}else if($locationID==3){
               						$areaID="ntArea".$value[0]->locationID;
               						$style="style=\"color:red;\"";
               					}
               					$areaIDsamll="smallCatKTArea".$value[0]->locationID;
               					
               					echo "
               					</ul>
               					</div>
               					<li>
	               					<a id=\"$areaIDsamll\" class=\"openCat\" data-toggle=\"collapse\" data-target=\"#$areaID\"
	               					href=\"#$areaID;javascript:void(0);\" onclick='return openCat(this.id);'>
	               					<span class=\"badge openSubCat\">
	               					<i class=\"glyphicon glyphicon-plus\"></i>
	               					</span>
	               					</a>
               					
               					<a id=\"searchCriteria\" $style class=\"listForOpenCat\" href=\"$path\">
               					$name
               					</a>
               					</li><div id=\"$areaID\" class=\"panel-collapse collapse\">
               					<ul class=\" list-unstyled long-list\">";
               					
               				}else if($level==2){
               					$areaID="";
               					$style="";
               					if($locationID==1){
               						$areaID="ktArea".$value[0]->locationID;
               						$style="style=\"color:blue;\"";
               					}
               					else if($locationID==2){
               						$areaID="hkArea".$value[0]->locationID;
               						$style="style=\"color:green;\"";
               					}else if($locationID==3){
               						$areaID="ntArea".$value[0]->locationID;
               						$style="style=\"color:red;\"";
               					}
               					$areaIDsamll="smallCatKTArea".$value[0]->locationID;
               					
               					echo "</ul></div>
               					<li>
               						<a id=\"$areaIDsamll\" class=\"openCat\" data-toggle=\"collapse\" data-target=\"#$areaID\"
	               					href=\"#$areaID;javascript:void(0);\" onclick='return openCat(this.id);'>
	               					<span class=\"badge openSubCat\">
	               					<i class=\"glyphicon glyphicon-plus\"></i>
	               					</span>
	               					</a>
               					<a id=\"searchCriteria\" $style class=\"listForOpenCat\" href=\"$path\">
               					$name
               					</a>
               					</li><div id=\"$areaID\" class=\"panel-collapse collapse\">
               					<ul class=\" list-unstyled long-list\">";
               					
               				}
               				$level=2;
               				
               			}else if($value[0]->level==3)
               			{
               				$style="";
               				if($locationID==1){
               					$style="style=\"color:blue;\"";
               				}
               				else if($locationID==2){
               					$style="style=\"color:green;\"";
               				}else if($locationID==3){
               					$style="style=\"color:red;\"";
               				}
               				
               				if($level==2){
               					echo "<li>
               					<a id=\"searchCriteria\" $style class=\"listForOpenCat\" href=\"$path\">
               					$name
               					</a>
               					</li>";
               					
               				}else if($level==3){
               					echo "<li>
               					<a id=\"searchCriteria\" $style class=\"listForOpenCat\" href=\"$path\">
               					$name
               					</a>
               					</li>";
               				}
               				$level=3;
               			}
           	    }
               
               

               
                
                ?>
                 </ul>
        		</div>
              </ul>
        		</div> 
               </ul>
        		</div>
              <!--/.locations-list-->
              <div class="locations-list  list-filter margin-top-30">
                <h5 class="list-title"><strong><a href="javascript:void(0);"><i class="icon-money"></i><?php echo $lblPriceRange;?></a></strong></h5>
                <form role="form"  id="priceForm" class="form-inline "  onSubmit="return priceSetup()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/'.$sortByID_;?>" method="POST">  
                  <div class="margin-top-30">
                      <input type="number" placeholder="100" id="minPrice"
                      value=<?php if($minPrice>0)echo $minPrice;?>     
                      name="minPrice"  min="0"  max="90000" class="form-control price">
                      <span id="menubarTitle"> - </span>
                      <input type="number" placeholder="1000 " id="maxPrice"  
                      value=<?php if($minPrice>0) echo $maxPrice;?>  
                      name="maxPrice" min="0" max="90000"   class="form-control price">
                  </div>
                  <div>
                    <div class="form-group no-padding">
                    <button class="btn btn-primary btn-block btn-pink"> <i class="icon-search-2"></i> Filter</button>
                 <!--      <button id="priceRangeBtn" class="btn btn-default btn-pink btn-80 margin-top-10 " 
                      type="submit">Filter<i class="icon-search-2"></i></button> -->
                    </div>
                  </div>
                </form>
                <div style="clear:both"></div>
              </div>
             
              
              
              <div class="locations-list  list-filter">
                <h5 class="list-title"><strong><a href="javascript:void(0);"><i class="icon-bag"></i><?php echo $lblCondition;?></a></strong></h5>
                <ul class="browse-list list-unstyled long-list">
                 <li> <a id="searchCriteria" href="#"><?php echo $lblConditionAll;?>
                  
                  		<span class="count">28,705</span></a></li>
                  <li> <a id="searchCriteria" href="#"><?php echo $lblConditionNew;?>
                  
                  		<span class="count">28,705</span></a></li>
                  <li> <a id="searchCriteria" href="#"><?php echo $lblConditionUsed;?>
                  
                  		<span class="count">18,705</span></a></li>
                </ul>
              </div>
              
              
              <div style="clear:both"></div>
            </div>
            
            <!--/.categories-list--> 
          </aside>
       </div>
        <!--/.page-side-bar-->
        
        <div class="col-sm-9 page-content col-thin-left">
          <div class="category-list">
          <div class="tab-box "> 
              <!-- Nav tabs -->
              <ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
                <li <?php if(strcmp($activeTab, "allAds")==0) echo "class=\"active\""; ?>><a href="#allAds"  role="tab" data-toggle="tab">
                <?php echo $lblConditionAny;?>
                <span class="badge">228,705</span></a></li>
                <li <?php if(strcmp($activeTab, "newAds")==0) echo "class=\"active\""; ?>><a href="#newAds"  role="tab" data-toggle="tab">
                <?php echo $lblConditionNew;?>
                <span class="badge">22,805</span></a></li>
                <li <?php if(strcmp($activeTab, "usedAds")==0) echo "class=\"active\""; ?>><a href="#usedAds"  role="tab" data-toggle="tab">
                <?php echo $lblConditionUsed;?> 
                <span class="badge">18,705</span></a></li>
              </ul>
              <div id="mobileFilter">
              
              <a class="btn btn-sm btn-searchCat" href="#selectCategory" data-toggle="modal"> 
				<i class="icon-book-open"> </i> 
				Category 
              </a>
              <a class="btn btn-sm btn-searchCat2" href="#selectLocation" data-toggle="modal"> 
				<i class="icon-compass"> </i> 
				Location 
              </a>
              <a class="btn btn-sm btn-searchCat3" href="#selectPriceRange" data-toggle="modal"> 
				$ Price Range
              </a>
              </div>
              <div class="tab-filter">
              <select class="selectpicker" data-style="btn-select" data-width="auto" id="sortByPrice" name="sortByPrice"  >
                  <option value="0"   <?php if(strcmp($sortByID_,"0")==0 or $sortByID_==0 or $sortByID_=='') echo " selected='selected' ";?> ><?php echo $lblSearchSortBy;?></option>
                  <option value="1"   <?php if(strcmp($sortByID_,"1")==0)  echo " selected='selected' ";?> > <?php echo $lblPriceLowToHigh;?></option>
                  <option value="2"   <?php if(strcmp($sortByID_,"2")==0)  echo " selected='selected' ";?> > <?php echo $lblPriceHighToLow;?></option>
                </select>
             <!--    <select class="selectpicker" data-style="btn-select" data-width="auto">
                  <option>Relevance</option>
                  <option>Price: Low to High</option>
                  <option>Price: High to Low</option>
                  <option>Newest</option>
                </select> -->
              </div>
           </div>
           <!--/.tab-box-->
          
          
           <div class="listing-filter">
           	  <div class="pull-left col-xs-6">
                <div class="breadcrumb-list"> 
                <a href="#" class="current"> 
                <span>All ads</span> </a>
                 in Hong Kong
                <a href="#selectLocation" id="dropdownMenu1"  data-toggle="modal"> 
                <span class="caret"></span> </a> </div>
              </div>
              <div class="pull-left col-xs-6">
               </div>
              <div class="pull-right col-xs-6 text-right listing-view-action"> 
              <span class="list-view active"><i class="  icon-th"></i>
              </span> <span class="compact-view"><i class=" icon-th-list  "></i>
              </span> <span class="grid-view "><i class=" icon-th-large "></i></span> 
              </div>
              <div style="clear:both"></div>
            </div>
              
            <div class="adds-wrapper">
              <div class="tab-content">
                <div class="tab-pane fade <?php if(strcmp($activeTab, "allAds")==0) echo "in active"; ?>" id="allAds">
                @Html.Partial("allAds")
                	<?php
                	/*
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
					$postDescription=trim($item['postDescription']);
					
					try{
					$postDescription=trimLongText($postDescription);
					} catch(Exception $ex){
						
					}
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
					
				echo  "<div class=\"col-sm-3 no-padding photobox\">";
						echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";              			
		              		
						
              		$ctrlName="AjaxLoad".$rowCount;
              		$errorctrlName="ErrAjaxLoad".$rowCount;
              		$ctrlValue="post".$rowCount;
              		$postID2=$id;
              		$clickLink="clickLink".$rowCount;
              		$title=$this->lang->line("lblTitle");
				echo "</div>";
			    echo "<div class=\"col-sm-6 add-desc-box\">";
                  echo "<div class=\"ads-details\">";
                   echo "<h5><div class=\"add-title-girlstrade\"> <a href=\"$viewBasePath\">$title $postTitle </a></div><a href=\"$viewBasePath\">$postDescription</a></h5>";
                   echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $postCreateDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h2 class=\"item-price\"> $postCurrency $postItemPrice</h2>";
                echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
                if($item["getDisableSavedAds"])
               		 echo "[<a style=\"pointer-events: none; cursor: default;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>]";
                else
             	   echo "[<a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>]";
                
                echo "[<a href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL>View Details</a>]</div>";
               echo "</div>";
               }
                         
              }else{
              	echo "<div align='center'><h2>".$this->lang->line("NoRecordsFound")."</h2></div>";
              }
				*/
              ?>  
                
                
                
                </div>
               <div class="tab-pane <?php if(strcmp($activeTab, "newAds")==0) echo "active"; ?>" id="newAds">
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
					$postDescription=trim($item['postDescription']);
					
					try{
					$postDescription=trimLongText($postDescription);
					} catch(Exception $ex){
						
					}
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
					
				echo  "<div class=\"col-sm-3 no-padding photobox\">";
						echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";              			
		              		
						
              		$ctrlName="AjaxLoad".$rowCount;
              		$errorctrlName="ErrAjaxLoad".$rowCount;
              		$ctrlValue="post".$rowCount;
              		$postID2=$id;
              		$clickLink="clickLink".$rowCount;
              		$title=$this->lang->line("lblTitle");
				echo "</div>";
			    echo "<div class=\"col-sm-6 add-desc-box\">";
                  echo "<div class=\"ads-details\">";
                   echo "<h5><div class=\"add-title-girlstrade\"> <a href=\"$viewBasePath\">$title $postTitle </a></div><a href=\"$viewBasePath\">$postDescription</a></h5>";
                   echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $postCreateDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h2 class=\"item-price\"> $postCurrency $postItemPrice</h2>";
                echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
                if($item["getDisableSavedAds"])
               		 echo "[<a style=\"pointer-events: none; cursor: default;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>]";
                else
             	   echo "[<a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>]";
                
                echo "[<a href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL>View Details</a>]</div>";
               echo "</div>";
               }
                         
              }else{
              	echo "<div align='center'><h2>".$this->lang->line("NoRecordsFound")."</h2></div>";
              }
				
              ?>  
                
                
                
                </div>
                <div class="tab-pane <?php if(strcmp($activeTab, "usedAds")==0) echo "active"; ?>" id="usedAds">
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
					$postDescription=trim($item['postDescription']);
					
					try{
					$postDescription=trimLongText($postDescription);
					} catch(Exception $ex){
						
					}
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
					
				echo  "<div class=\"col-sm-3 no-padding photobox\">";
						echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";              			
		              		
						
              		$ctrlName="AjaxLoad".$rowCount;
              		$errorctrlName="ErrAjaxLoad".$rowCount;
              		$ctrlValue="post".$rowCount;
              		$postID2=$id;
              		$clickLink="clickLink".$rowCount;
              		$title=$this->lang->line("lblTitle");
				echo "</div>";
			    echo "<div class=\"col-sm-6 add-desc-box\">";
                  echo "<div class=\"ads-details\">";
                   echo "<h5><div class=\"add-title-girlstrade\"> <a href=\"$viewBasePath\">$title $postTitle </a></div><a href=\"$viewBasePath\">$postDescription</a></h5>";
                   echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $postCreateDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h2 class=\"item-price\"> $postCurrency $postItemPrice</h2>";
                echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
                if($item["getDisableSavedAds"])
               		 echo "[<a style=\"pointer-events: none; cursor: default;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>]";
                else
             	   echo "[<a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>]";
                
                echo "[<a href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL>View Details</a>]</div>";
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
 </div>
  <script>
  
  
function setup(){
	var catID=document.getElementById("search-category").value;
 	var locID=document.getElementById("id-location").value;
	//var locID=0;
	var sortByID=document.getElementById("sortByPrice").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var minPrice=document.getElementById("minPrice").value;
	   var maxPrice=document.getElementById("maxPrice").value;
	
	document.getElementById("myForm").action="http://girlstrade.zapto.org:8888/girlstrade/index.php/getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat(sortByID).concat("/").concat(minPrice).concat("/").concat(maxPrice);
	document.getElementById("myForm").submit();
}
function priceSetup(){
	var catID=document.getElementById("search-category").value;
 	var locID=document.getElementById("id-location").value;
	//var locID=0;
	var sortByID=document.getElementById("sortByPrice").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var minPrice=document.getElementById("minPrice").value;
	   var maxPrice=document.getElementById("maxPrice").value;
	document.getElementById("priceForm").action="http://girlstrade.zapto.org:8888/girlstrade/index.php/getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat(sortByID).concat("/").concat(minPrice).concat("/").concat(maxPrice);
	document.getElementById("priceForm").submit();
}
function priceSetup1(){
	var catID=document.getElementById("search-category").value;
 	var locID=document.getElementById("id-location").value;
//var locID=0;
	var sortByID=document.getElementById("sortByPrice").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var minPrice=document.getElementById("minPrice1").value;
	   var maxPrice=document.getElementById("maxPrice1").value;
	document.getElementById("priceForm1").action="http://girlstrade.zapto.org:8888/girlstrade/index.php/getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat(sortByID).concat("/").concat(minPrice).concat("/").concat(maxPrice);
	document.getElementById("priceForm1").submit();
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
<script>
  $('.tabs').bind('change', function (e) {
	    var now_tab = e.target // activated tab

	    // get the div's id
	    var divid = $(now_tab).attr('href').substr(1);

		   $(".tab-pane").each(function () {
		       $(this).empty();
		   });

		   alert("<?php echo base_url().MY_PATH; ?>/getCategory/" + divid);
		   $.ajax({
		        url: "<?php echo base_url().MY_PATH; ?>/getCategory/" + divid,
		        cache: false,
		        type: "get",
		        dataType: "html",
		        success: function (result) {
		            $("#" + divid).html(result);
		        }
		    });
		   //$(this).tab('show')
		});
  </script>
<script>

// $('#tabstrip a').click(function (e) {
//    e.preventDefault()
//    var tabID = $(this).attr("href").substr(1);
//    $(".tab-pane").each(function () {
//        $(this).empty();
//    });
//    $.ajax({
 //       url: "<?php echo base_url().MY_PATH; ?>getCategory/" + tabID,
//         cache: false,
//         type: "get",
//         dataType: "html",
//         success: function (result) {
//             $("#" + tabID).html(result);
//         }
//     });
//    $(this).tab('show')
// });
</script>
<!-- /.wrapper --> 



<!-- Modal Change City -->

<div class="modal fade" id="selectLocation" tabindex="-1" role="dialog" aria-labelledby="countryPopup" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="countryPopup"><i class=" icon-map"></i> Select your region </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
        	
            <p>
            <div class="searchCat2">
            <i class="icon-location-circled"></i>
            Districts of <strong>Hong Kong</strong>
            </div>
            </p>

<div style="clear:both"></div>            
            <div class="col-sm-6 no-padding">
        <select  class="form-control selecter  " id="region-state" name="region-state">
		<option value="">All Districts</option>
		<option value="4">中西區</option>
		<option value="5">東區</option>
		<option value="6">南區</option>
		<option value="7">灣仔區</option>
		<option value="8">深水埗區</option>
		<option value="9">九龍城區</option>
		<option value="10">觀塘區</option>
		
		<option value="11">黃大仙區</option>
		<option value="12">油尖旺區</option>
		<option value="13">離島區</option>
		<option value="14">葵青區</option>
		<option value="15">北區</option>
		<option value="16">西貢區</option>
		<option value="17">沙田區</option>
		<option value="18">大埔區</option>
		<option value="19">荃灣區</option>
		<option value="20">屯門區</option>
		<option value="21">元朗區</option>
		
		</select>
            </div>
           <div style="clear:both"></div>            

            <hr class="hr-thin">
          </div>
          <div class="col-md-4">
            <ul  class="list-link list-unstyled">
              <li> 
              <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/69"?>" title="Wan Chai">
              <font color="blue">
              Wan Chai
              </font>
              </a> </li>
		 <li> 
		 
		 <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/70"?>" title="Bauseway Bay">
		 <font color="blue">
		 Causeway Bay
		 </font>
		 </a> </li>
		 <li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/63"?>" title="Admirty">
		 <font color="blue">
		 Admirty
		 </font>
		 </a> </li>
		 <li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/64"?>" title="Central">
		 <font color="blue">
		 Central
		 </font>
		 </a> </li>
		
	
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-link list-unstyled">
              <li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/43"?>" title="WongTaiSin">
              <font color="green">
              Wong Tai Sin
              </font>
              </a> </li>
		 <li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/48"?>" title="KwunTong">
		 <font color="green">
		 Kwun Tong
		 </font></a> </li>
		 <li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/47"?>" title="NgauTauKok">
		 <font color="green">
		 Ngau Tau Kok
		 </font>
		 </a> </li>
		 <li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/46"?>" title="KowloonBay">
		 <font color="green">
		 Kowloon Bay
		 </font>
		 </a> </li>
		 

	
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-link list-unstyled">
               <li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/104"?>" title="MaOnShan">
               <font color="red">
               Ma On Shan
               </font>
               </a> </li>
		 	<li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/97"?>" title="YuenLong">
		 	<font color="red">
		 	Yuen Long
		 	</font>
		 	</a> </li>
			 <li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/95"?>" title="TinShuiWai">
			 <font color="red">
			 Tin Shui Wai
			 </font>
			 </a> </li>
         	<li> <a  href="<?php echo base_url().MY_PATH."getCategory/getAll/1/0/92"?>" title="TsuengKwanO">
         	<font color="red">
         	Tsueng Kwan O
         	</font>
         	</a> </li>

	
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
<!-- Modal Price Range-->

<div class="modal fade" id="selectPriceRange" tabindex="-1" role="dialog" aria-labelledby="pricePopup" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="pricePopup"><i class=" icon-money"></i> 
        Select your price range </h4>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="locations-list  list-filter margin-top-30">
                <h5 class="list-title">
                <div class="modalBody">
                <strong><a href="javascript:void(0);">
                $ <?php echo $lblPriceRange;?>
                </a></strong>
                </div>
                </h5>
               <form role="form"  id="priceForm1" class="form-inline modalBody"  onSubmit="return priceSetup1()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/'.$sortByID_;?>" method="POST">  
                  <div class="margin-top-30">
                      <input type="number" placeholder="100" id="minPrice1"
                      value=<?php  if($minPrice>0)echo $minPrice;?>     
                      name="minPrice1"  min="0"  max="90000" class="form-control price">
                      <span id="menubarTitle"> - </span>
                      <input type="number" placeholder="1000 " id="maxPrice1"  
                      value=<?php if($minPrice>0) echo $maxPrice;?>  
                      name="maxPrice1" min="0" max="90000"   class="form-control price">
                  </div>
                  <div>
                    <div class="form-group no-padding">
                      <button id="priceRangeBtn1" class="btn btn-default btn-pink btn-80 margin-top-10 " 
                      type="submit">Filter<i class="icon-search-2"></i></button>
                    </div>
                  </div>
                </form>
                <div style="clear:both"></div>
              </div>
              <!--PRICING MODEL-->
                    </div>

        </div>
      </div>
    </div>
  </div>

<!-- /.modal -->
<!-- Modal Category -->

<div class="modal fade" id="selectCategory" tabindex="-1" role="dialog" aria-labelledby="categoryPopup" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="countryPopup"><i class=" icon-book-open"></i> Filter with selected category </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
        	
            <p>
            <div class="searchCat">
            <strong><i class="icon-th"></i>Category</strong>
            </div>
            </p>

			<div style="clear:both"></div>            
            <div class="col-sm-6 no-padding">
        <select  class="form-control selecter  " id="region-state" name="region-state">
		<option value="">All Categories</option>
		<?php 
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
						echo "<option value='".$id."'  style='background-color:#E9E9E9;font-weight:bold;' > ".$name.$postCount." </option>";
					}
		}		
		?>
		
		
		
		
		</select>
            </div>
           <div style="clear:both"></div>            

            <hr class="hr-thin">
          </div>
          <div class="locations-list  list-filter modalBody">
          <ul class="browse-list list-unstyled">
          <li>
          <a id="searchCriteria" class="listForOpenCat" href="<?php echo base_url().MY_PATH."getCategory/getAll/1/1";?>"><strong>Dress</strong></a>
          </li>
          <li>
	          <ul class="list-unstyled">
	          <li>
	          <a id="searchCriteria" class="listForOpenCat" href="<?php echo base_url().MY_PATH."getCategory/getAll/1/19";?>">Long Dress</a>
	          </li>
	          <li>
	          <a id="searchCriteria" class="listForOpenCat" href="<?php echo base_url().MY_PATH."getCategory/getAll/1/20";?>">Short Dress</a>
	          </li>
	          <li>
	          <a id="searchCriteria" class="listForOpenCat" href="<?php echo base_url().MY_PATH."getCategory/getAll/1/21";?>">Formal Dress</a>
	          </li>
	          </ul>
	      </li>
          <li>
          <a id="searchCriteria" class="listForOpenCat" href="<?php echo base_url().MY_PATH."getCategory/getAll/1/2";?>"><strong>Tops</strong></a>
          </li>
          </ul>
          
          </div>
      	</div>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->




 <!--  WHEEL PART -->
<script src="<?php echo base_url();?>assets/plugins/noUiSlider/jquery.nouislider.all.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/mouse-wheel.js"></script>
<script src="<?php echo base_url();?>assets/js/shop.app.js"></script>


<script>

function openCat(id) { 
	
	
    var thisitem = document.getElementById(id);
    
    var plusIcon = 'glyphicon glyphicon-plus';
    var minusIcon = 'glyphicon glyphicon-minus';
    /*
    if(thisitem.childNodes[1] == plusIcon)
    {
    	thisitem.innerHTML = thisitem.innerHTML.replace(plusIcon, minusIcon);
    }else if (thisitem.childNodes[1] == minusIcon)
    {
    	thisitem.innerHTML = thisitem.innerHTML.replace(minusIcon, plusIcon);
    }*/
    var elms = document.getElementById(id).getElementsByTagName("I");
        
   	//console.log(elms[0].tagName);
    var x = elms[0].className;
    if(x == plusIcon)
    {
    	elms[0].className = "glyphicon glyphicon-minus";
    }else if (x == minusIcon)
    {
    	elms[0].className = "glyphicon glyphicon-plus";
    }
    //console.log(x);
    
    return true;
}
</script>
<?php include "footer2.php"; ?>

