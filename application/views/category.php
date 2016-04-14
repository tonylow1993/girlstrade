<?php $title = "Search Page";  include("header.php"); ?>
<!-- CSS WHEEL SLIDER -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/noUiSlider/nouislider.css">
<script src="<?php echo base_url();?>assets/plugins/noUiSlider/nouislider.js"></script>

<style id="jsbin-css">
.progress-bar[aria-valuenow="1"],
.progress-bar[aria-valuenow="2"] {
  min-width: 3%;
}

.progress-bar[aria-valuenow="0"] {
  color: gray;
  min-width: 100%;
  background: transparent;
  box-shadow: none;
}

.progress-bar[aria-valuenow^="9"]:not([aria-valuenow="9"]) {
  background: red;
}
</style>

<div id="wrapper">
  
  <!-- /.header -->
  <!-- <div class="search-row-wrapper">-->
  <br/>
  <div class="search-row-wrapper">
    <div class="container ">
      <form  id="myForm"  onSubmit="return setup()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/0/'.$minPrice.'/'.$maxPrice.'/'.$activeTab.'/'.$sortByType.'/'.$sortByPrice.'/'.$sortByDate;?>" method="POST">
            <div class="col-lg-3 col-sm-3 search-col relative"> <i class="icon-docs icon-append"></i>
                <input type="text" name="ads"  id="ads" class="form-control has-icon" placeholder="Keywords" value="<?php if($keywords<>'0') echo trim($keywords);?>">
              	<input type="hidden" name="paneActiveTab" id="paneActiveTab" value="<?php echo $activeTab;?>" >
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
            	if(SHOW_BRACKETS_SEARCH_PAGE==0)
            		$postCount="";
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
             	$postCount="(".$value[0]->postCount.")";
             	if(SHOW_BRACKETS_SEARCH_PAGE==0)
             		$postCount="";
             	if($lang_label<>"english")
             		$name=$value[0]->nameCN;
             	if($value[0]->level==1){
             		$str="";
             		if(strcmp($locID_,$id)==0)
             			$str=" selected='selected' ";
             		echo "<option ".$str." value='".$id."' style='background-color:#E9E9E9;'>".$name.$postCount."</option>";
             	}else if($value[0]->level==2)
             	{
             		$str="";
             		if($locID_==$id)
             			$str=" selected='selected' ";
             		echo "<option ".$str." value='".$id."' style='background-color:#E9E9E9;'>&nbsp;&nbsp;".$name.$postCount." </option>";
             	}else if($value[0]->level==3)
             	{
             		$str="";
             		if($locID_==$id)
             			$str=" selected='selected' ";
             		echo "<option ".$str." value='".$id."'>&nbsp;&nbsp;&nbsp;&nbsp".$name.$postCount." </option>";
             	}
             }
             ?>
           </select>
           </div>
       
           <div class="col-sm-3">
            	<button class="btn btn-primary btn-block btn-pink"> <i class="fa fa-search"></i> Search</button>  	
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
                <a class="not-active">
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
               		$postCount=" (".$value[0]->postCount.")";
               		if(SHOW_BRACKETS_SEARCH_PAGE==0)
               			$postCount="";
               		$name=$value[0]->name.$postCount;
               		if($lang_label<>"english")
               			$name=$value[0]->nameCN.$postCount;
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
               						<a id=\"searchCriteria\" style=\"color: green;\" class=\"listForOpenCat\" href=\"$path\">$name</a>
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
               								<a id=\"searchCriteria\" style=\"color: red;\" class=\"listForOpenCat\" href=\"$path\">
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
	               						<a id=\"searchCriteria\" style=\"color: blue;\" class=\"listForOpenCat\" href=\"$path\">
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
                <h5 class="list-title"><strong><a class="not-active"><i class="icon-money"></i><?php echo $lblPriceRange;?></a></strong></h5>
                <form role="form"  id="priceForm" class="form-inline "  onSubmit="return priceSetup()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/0/'.$minPrice.'/'.$maxPrice.'/'.$activeTab.'/'.$sortByType.'/'.$sortByPrice.'/'.$sortByDate;?>" method="POST">  
                  <div class="margin-top-30">
					  <div id="price-slider" class="price-slider"></div>
                      <input type="number" placeholder="20" id="minPrice"
                      value=<?php if($minPrice>0) echo $minPrice;?>     
                      name="minPrice"  min="20" class="form-control price">
                      <span id="menubarTitle"> — </span>
                      <input type="number" placeholder="5000 " id="maxPrice"  
                      value=<?php if($maxPrice>0) echo $maxPrice;?>  
                      name="maxPrice" max="5000"   class="form-control price">
					  
					  <script type="text/javascript">
						var html5Slider = document.getElementById('price-slider');

						noUiSlider.create(html5Slider, {
							start: [ <?php if($minPrice>0) echo $minPrice; else echo 20;?>, <?php if($maxPrice>0) echo $maxPrice; else echo 5000;?> ],
							connect: true,
							range: {
								'min': 20,
								'max': 5000
							}
						});
						
						var minPrice = document.getElementById('minPrice');
						var maxPrice = document.getElementById('maxPrice');
						
						html5Slider.noUiSlider.on('update', function( values, handle ) {

							var value = values[handle];
							if ( handle ) {
								maxPrice.value = Math.round(value);
							} else {
								minPrice.value = Math.round(value);
							}
						});

						minPrice.addEventListener('change', function(){
							console.log(this.value);
							html5Slider.noUiSlider.set([this.value, null]);
						});

						maxPrice.addEventListener('change', function(){
							console.log(this.value);
							html5Slider.noUiSlider.set([null, this.value]);
						});
					</script>
                  </div>
                  <div>
                    <div class="form-group no-padding margin-top-20">
                    <button class="btn btn-primary btn-block btn-pink"> <i class="icon-search-2"></i> Filter</button>
                 <!--      <button id="priceRangeBtn" class="btn btn-default btn-pink btn-80 margin-top-10 " 
                      type="submit">Filter<i class="icon-search-2"></i></button> -->
                    </div>
                  </div>
                </form>
                <div style="clear:both"></div>
              </div>
             
              
               
              <div class="locations-list list-filter margin-top-30">
                <h5 class="list-title"><strong><a class="not-active"><i class="icon-bag"></i><?php echo $lblCondition;?></a></strong></h5>
                <ul class="browse-list list-unstyled long-list">
                 <li> <a id="allAds1" href="#allAds" ><?php echo $lblConditionAll;?>
             <!--     <li> <a id="searchCriteria" href="#allAds" onclick="return setupTab('allAds', 'allAds1');" ><?php echo $lblConditionAll;?>
                  -->
                  		<?php 
                  		if(SHOW_BRACKETS_SEARCH_PAGE==1){
                  			
                  		?>
                  		<span class="count">
                  		<?php 
			                $rowCount=0;
			                if($itemList<>null && sizeof($itemList)>0)
			                	$rowCount=sizeof($itemList);
			                echo $rowCount;
			                ?>
                  		</span>
                  		<?php }?>
                  		
                  		</a></li>
                  <li> <a id="newAds1" name="newAds1"  href="#newAds" ><?php echo $lblConditionNew;?>
                  
                  <?php 
                  		if(SHOW_BRACKETS_SEARCH_PAGE==1){
                  			
                  		?>
                  		<span class="count">
                  		<?php 
			                $rowCount=0;
			                if($itemList<>null && sizeof($itemList)>0)
			                	foreach($itemList as $id=>$item)
								{
									if(strcmp($item["newUsed"], "N")<>0)
										continue;
									$rowCount=$rowCount+1;
								}
			                	echo $rowCount;
			                ?>
                  		</span>
                  		<?php }?>
                  		</a></li>
                  <li> <a id="usedAds1" name="usedAds1" href="#usedAds" ><?php echo $lblConditionUsed;?>
                  		<?php 
                  		if(SHOW_BRACKETS_SEARCH_PAGE==1){
                  			
                  		?>
                  		<span class="count"><?php 
			                $rowCount=0;
			                if($itemList<>null && sizeof($itemList)>0)
			                	foreach($itemList as $id=>$item)
								{
									if(strcmp($item["newUsed"], "U")<>0)
										continue;
									$rowCount=$rowCount+1;
								}
			                	echo $rowCount;
			                ?></span>
			                <?php }?>
			                </a></li>
                </ul>
              </div>
              
              
              <div style="clear:both"></div>
            </div>
            
            <!--/.categories-list--> 
          </aside>
       </div>
        <!--/.page-side-bar-->
        
        <div class="col-sm-12 col-md-9 page-content col-thin-left" style="margin-bottom: 30px;">
          <div class="category-list">
          <div class="tab-box "> 
              <!-- Nav tabs -->
              <ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
                <li <?php if(strcmp($activeTab, "allAds")==0) echo "class=\"active\"";?>>
                <!-- <a href="#allAds"  id="allAds2" name="allAds2"  role="tab" data-toggle="tab" onclick="return setupTab('allAds', 'allAds2');"> -->
                <a href="#allAds"  id="allAds2" name="allAds2"  role="tab" data-toggle="tab">
                <?php echo $lblConditionAny;?>
                <?php 
                  		if(SHOW_BRACKETS_SEARCH_PAGE==1){
                  			
                  		?>
                <span class="badge"><?php 
                $rowCount=0;
                if($itemList<>null && sizeof($itemList)>0)
                	$rowCount=sizeof($itemList);
                echo $rowCount;
                ?></span>
                <?php }?>
                </a></li>
                <li <?php if(strcmp($activeTab, "newAds")==0) echo "class=\"active\""; ?>>
                <!-- <a href="#newAds" id="newAds2" name="newAds2"  role="tab" data-toggle="tab" onclick="return setupTab('newAds', 'newAds2');"> -->
                <a href="#newAds" id="newAds2" name="newAds2"  role="tab" data-toggle="tab">
                <?php echo $lblConditionNew;?>
                <?php 
                  		if(SHOW_BRACKETS_SEARCH_PAGE==1){
                  			
                  		?>
                <span class="badge"><?php 
                $rowCount=0;
                if($itemList<>null && sizeof($itemList)>0)
                	foreach($itemList as $id=>$item)
					{
						if(strcmp($item["newUsed"], "N")<>0)
							continue;
						$rowCount=$rowCount+1;
					}
                	echo $rowCount;
                ?></span>
                <?php }?>
                </a></li>
                <li <?php if(strcmp($activeTab, "usedAds")==0) echo "class=\"active\""; ?>>
                <!-- <a href="#usedAds" id="usedAds2" name="usedAds2"  role="tab" data-toggle="tab" onclick="return setupTab('usedAds', 'usedAds2');"> -->
                <a href="#usedAds" id="usedAds2" name="usedAds2"  role="tab" data-toggle="tab" >
                <?php echo $lblConditionUsed;?> 
                	<?php 
                  		if(SHOW_BRACKETS_SEARCH_PAGE==1){
                  			
                  		?><span class="badge">
	                <?php 
	                $rowCount=0;
	                if($itemList<>null && sizeof($itemList)>0)
						foreach($itemList as $id=>$item)
						{
							if(strcmp($item["newUsed"], "U")<>0)
								continue;
							$rowCount=$rowCount+1;
						}
	                	echo $rowCount;
	                ?></span>
	                <?php }?></a>
	            </li>
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
              <div class="sortByDiv">
              <form role="form" method="POST" action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/0/'.$minPrice.'/'.$maxPrice.'/'.$activeTab.'/'.$sortByType.'/'.$sortByPrice.'/'.$sortByDate;?>"
         	     id="sortfrm" class="tab-filter"> 
			   <div class="form-group sort-group" style="width:150px;">
				  <select class="form-control sort-select selecter" name="selectSortType"   id="selectSortType" data-width="auto">
					  <option value="0" <?php if(strcmp($sortByType,"0")==0 or $sortByType==0) echo " selected='selected' ";?> >Sort by...</option>
					  <option value="1" <?php if(strcmp($sortByType,"1")==0)  echo " selected='selected' ";?>>Price</option>
					  <option value="2" <?php if(strcmp($sortByType,"2")==0)  echo " selected='selected' ";?>>Date</option>
					</select>
			    </div>
			   
			   	<div id="sortByPriceDiv" style="display:none;width:150px">
					<select class="form-control selecter "   name="sortByPrice"   id="sortByPrice" data-width="auto"  onchange="beginSort();">
					  <option value="0" <?php if(strcmp($sortByPrice,"0")==0 or $sortByPrice==0) echo " selected='selected' ";?> >Sort by...</option>
					  <option value="1" <?php if(strcmp($sortByPrice,"1")==0)  echo " selected='selected' ";?>>Low to High</option>
					  <option value="2" <?php if(strcmp($sortByPrice,"2")==0)  echo " selected='selected' ";?>>High to Low</option>
					</select>
				</div>
				
				<div id="sortByDateDiv" style="display:none;width:150px">
					<select class="form-control selecter "   name="sortByDate"   id="sortByDate" data-width="auto" onchange="beginSort();">
					  <option value="0" <?php if(strcmp($sortByDate,"0")==0 or $sortByDate==0) echo " selected='selected' ";?> >Sort by...</option>
					  <option value="1" <?php if(strcmp($sortByDate,"1")==0)  echo " selected='selected' ";?>>Most Recent</option>
					  <option value="2" <?php if(strcmp($sortByDate,"2")==0)  echo " selected='selected' ";?>>Oldest</option>
					</select>
				</div> 
				
				<noscript><button value="Submit"></button></noscript>
			</form></div>
          
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
                <div class="tab-pane <?php if(strcmp($activeTab, "allAds")==0) echo "active"; ?>" id="allAds">
                	<?php
                	
             $basePath=base_url().MY_PATH;
             $encodeCurrentURL=urlencode(current_url());
              if($itemList<>null && sizeof($itemList)>0)
              {
              	$rowCount=0;
              foreach($itemList as $id=>$item)
				{
					$rowCount=$rowCount+1;
				  $viewBasePath=$basePath."viewItem/index/".$id."?prevURL=".$encodeCurrentURL."&prevItem_Url=".urlencode(current_url());
              		$locationName=$item["locationName"];
					$categoryName=$item["categoryName"];
					$postCurrency=$item['postCurrency'];
					$postItemPrice=$item['postItemPrice'];
					$postDescription=trim($item['postDescription']);
					$isloginedIn=$item['isloginedIn'];
					$isPendingRequest=$item['isPendingRequest'];
					$isPostAlready=$item['isPostAlready'];
					$isSameUser=$item['isSameUser'];
					$username=$item['username'];
					$userRating=$item['userRating'];
					try{
					$postDescription=trimLongText($postDescription);
					} catch(Exception $ex){
						
					}
					$postTitle=$item['postTitle'];
					$postCreateDate=$item['postCreateDate'];
					$picCount=$item["picCount"];
					$thumbnail=base_url().$item['thumbnailPath'].'/'.$item['thumbnailName'];
					$checkImgFile=$item['thumbnailPath'].'/'.$item['thumbnailName'];
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
				if (!is_file_exists($checkImgFile)) {
					$thumbnail = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
				}
						echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";              			
		              		
						
              		$ctrlName="AjaxLoad".$rowCount;
              		$errorctrlName="ErrAjaxLoad".$rowCount;
              		$ctrlValue="post".$rowCount;
              		$postID2=$id;
              		$clickLink="clickLink".$rowCount;
              		$title=$this->lang->line("lblTitle");
				$showSellerName="";
				if(strcmp(SHOWSELLERNAMEINSEARCHBUTTON,"Y")==0)
                	$showSellerName=$username;
                else {
                	$showSellerName="seller";
                }
				$imgRatingPath=base_url()."images/".$userRating;
                echo "</div>";
			    echo "<div class=\"col-sm-6 add-desc-box\">";
                  echo "<div class=\"ads-details\">";
                   echo "<h5><div class=\"add-title-girlstrade\"> <a href=\"$viewBasePath\">$postTitle </a></div><a href=\"$viewBasePath\">$postDescription</a></h5>";
                   echo "<span class=\"info-row\"> <span class=\"user\"><img class=\"ratingIcon-xs\" src=$imgRatingPath> $username </span> - <span class=\"date\"><i class=\"icon-clock\"> </i> $postCreateDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span></span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h2 class=\"item-price\"> $postCurrency $postItemPrice</h2>";
                echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
                //if(!$item["getDisableSavedAds"])
               	//	 echo "<a class=\"btn btn-primary btn-block btn-pink\" style=\"pointer-events: none; cursor: default;color:yellow;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName', '$clickLink')\" id='$clickLink' name='$clickLink'><i class=\"fa fa-check-circle\"></i>  Saved</a>";
                //else
             	//   echo "<a class=\"btn btn-primary btn-block btn-pink\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName', '$clickLink')\" id='$clickLink' name='$clickLink'><i class=\"fa fa-heart\"></i>  Save</a>";
                echo "<a class=\"btn btn-primary btn-block btn-pink\" href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL&prevItem_Url=".urlencode(current_url())."><i class=\"fa fa-info-circle\"></i>  View Details</a>";
                if(!$isloginedIn and $isSameUser==false){
                	$imgRatingPath=base_url()."images/".$userRating;
                
                	echo "<a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
                
                }
                if(($isloginedIn) && $isPendingRequest==false && ($isPostAlready==false or $isSameUser==false))
                {
                	if($isPostAlready == false and $isSameUser ==false ){
                		
                		$imgRatingPath=base_url()."images/".$userRating;
                		echo "<a class=\"btn btn-primary btn-block btn-pink\" href=";
                		echo base_url().MY_PATH."messages/directSend/".$id."?prevURL=".urlencode(current_url()); //."&prevprevURL=".urlencode($previousCurrent_url);
                		echo " data-toggle=\"modal\" >";
                		echo "<i class=\"icon-right-hand\"></i>Contact Seller</a>";
                	}
                }
                if(($isloginedIn) &&($isPendingRequest==true && $isSameUser==false) )
                {
                	echo "<a class=\"btn btn-primary btn-block btn-pink\" href=\"\" >";
                	echo "<i class=\" icon-info\"></i>Pending for Approval</a>";
                }
                                  
                
               echo "</div></div>";
               }
                         
              }else{
              	echo "<div align='center'><h2>".$this->lang->line("NoRecordsFound")."</h2></div>";
              }
				
              ?>  
                
                
                
                </div>
               <div class="tab-pane  <?php if(strcmp($activeTab, "newAds")==0) echo "active"; ?>" id="newAds">
                	<?php
             $basePath=base_url().MY_PATH;
             $encodeCurrentURL=urlencode(current_url());
              if($itemList<>null && sizeof($itemList)>0)
              {
              	$rowCount=0;
              foreach($itemList as $id=>$item)
				{
					if(strcmp($item["newUsed"], "N")<>0)
						continue;
					
					$rowCount=$rowCount+1;
				  $viewBasePath=$basePath."viewItem/index/".$id."?prevURL=".$encodeCurrentURL."&prevItem_Url=".urlencode(current_url());
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
					$checkImgFile=$item['thumbnailPath'].'/'.$item['thumbnailName'];
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
				if (!is_file_exists($checkImgFile)) {
					$thumbnail = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
				}
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
                   echo "<h5><div class=\"add-title-girlstrade\"> <a href=\"$viewBasePath\">$postTitle </a></div><a href=\"$viewBasePath\">$postDescription</a></h5>";
                   echo "<span class=\"info-row\"> <span class=\"user\"><img class=\"ratingIcon-xs\" src=$imgRatingPath> $username </span> - <span class=\"date\"><i class=\"icon-clock\"> </i> $postCreateDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span></span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h2 class=\"item-price\"> $postCurrency $postItemPrice</h2>";
                echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
                echo "<a class=\"btn btn-primary btn-block btn-pink\" href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL&prevItem_Url=".urlencode(current_url())."><i class=\"fa fa-info-circle\"></i>  View Details</a>";
                if(!$isloginedIn and $isSameUser==false){
                	$imgRatingPath=base_url()."images/".$userRating;
                
                	echo "<a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
                
                }
                if(($isloginedIn) && $isPendingRequest==false && ($isPostAlready==false or $isSameUser==false))
                {
                	if($isPostAlready == false and $isSameUser ==false ){
                		
                		$imgRatingPath=base_url()."images/".$userRating;
                		echo "<a class=\"btn btn-primary btn-block btn-pink\" href=";
                		echo base_url().MY_PATH."messages/directSend/".$id."?prevURL=".urlencode(current_url()); //."&prevprevURL=".urlencode($previousCurrent_url);
                		echo " data-toggle=\"modal\" >";
                		echo "<i class=\"icon-right-hand\"></i>Contact Seller</a>";
                	}
                }
                if(($isloginedIn) &&($isPendingRequest==true && $isSameUser==false) )
                {
                	echo "<a class=\"btn btn-primary btn-block btn-pink\" href=\"\" >";
                	echo "<i class=\" icon-info\"></i>Pending for Approval</a>";
                }
                                  
                
                echo "</div></div>";
               }
                    
               if($rowCount==0)
               	echo "<div align='center'><h2>".$this->lang->line("NoRecordsFound")."</h2></div>";
               	
               
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
					if(strcmp($item["newUsed"], "U")<>0)
						continue;
					$rowCount=$rowCount+1;
				  $viewBasePath=$basePath."viewItem/index/".$id."?prevURL=".$encodeCurrentURL."&prevItem_Url=".urlencode(current_url());
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
					$checkImgFile=$item['thumbnailPath'].'/'.$item['thumbnailName'];
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
				if (!is_file_exists($checkImgFile)) {
					$thumbnail = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
				}
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
                   echo "<h5><div class=\"add-title-girlstrade\"> <a href=\"$viewBasePath\">$postTitle </a></div><a href=\"$viewBasePath\">$postDescription</a></h5>";
                   echo "<span class=\"info-row\"> <span class=\"user\"><img class=\"ratingIcon-xs\" src=$imgRatingPath> $username </span> - <span class=\"date\"><i class=\"icon-clock\"> </i> $postCreateDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span></span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h2 class=\"item-price\"> $postCurrency $postItemPrice</h2>";
                echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
                if(!$isloginedIn and $isSameUser==false){
                	$imgRatingPath=base_url()."images/".$userRating;
                
                	echo "<a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
                
                }
                if(($isloginedIn) && $isPendingRequest==false && ($isPostAlready==false or $isSameUser==false))
                {
                	if($isPostAlready == false and $isSameUser ==false ){
                		
                		$imgRatingPath=base_url()."images/".$userRating;
                		echo "<a class=\"btn btn-primary btn-block btn-pink\" href=";
                		echo base_url().MY_PATH."messages/directSend/".$id."?prevURL=".urlencode(current_url()); //."&prevprevURL=".urlencode($previousCurrent_url);
                		echo " data-toggle=\"modal\" >";
                		echo "<i class=\"icon-right-hand\"></i>Contact Seller</a>";
                	}
                }
                if(($isloginedIn) &&($isPendingRequest==true && $isSameUser==false) )
                {
                	echo "<a class=\"btn btn-primary btn-block btn-pink\" href=\"\" >";
                	echo "<i class=\" icon-info\"></i>Pending for Approval</a>";
                }
                                  
                echo "<a class=\"btn btn-primary btn-block btn-pink\" href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL&prevItem_Url=".urlencode(current_url())."><i class=\"fa fa-info-circle\"></i>  View Details</a></div>";
                echo "</div>";
               }
               if($rowCount==0)
               	echo "<div align='center'><h2>".$this->lang->line("NoRecordsFound")."</h2></div>";
               	 
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
	            		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev/$catID_/$locID_/$keywords/0/$minPrice/$maxPrice/$activeTab/$sortByType/$sortByPrice/$sortByDate\">Previous</a></li>";
	            	if($NoOfItemCount > 0)
	              		echo "<li  class=\"active\"><a href=\"$url_path/$pageNum/$catID_/$locID_/$keywords/0/$minPrice/$maxPrice/$activeTab/$sortByType/$sortByPrice/$sortByDate\">$pageNum</a></li>";
	            	if($NoOfItemCount > ($pageNum*$itemPerPage))
	              		echo "<li><a href=\"$url_path/$pageNum2/$catID_/$locID_/$keywords/0/$minPrice/$maxPrice/$activeTab/$sortByType/$sortByPrice/$sortByDate\">$pageNum2</a></li>";
	              	if($NoOfItemCount > ($pageNum2*$itemPerPage))
	              		echo "<li><a href=\"$url_path/$pageNum3/$catID_/$locID_/$keywords/0/$minPrice/$maxPrice/$activeTab/$sortByType/$sortByPrice/$sortByDate\">$pageNum3</a></li>";
	              	if($NoOfItemCount > ($pageNum3*$itemPerPage))
	              		echo "<li><a href=\"$url_path/$pageNum4/$catID_/$locID_/$keywords/0/$minPrice/$maxPrice/$activeTab/$sortByType/$sortByPrice/$sortByDate\">$pageNum4</a></li>";
	              	if($NoOfItemCount > ($pageNum4*$itemPerPage))
	              		echo "<li><a href=\"$url_path/$pageNum5/$catID_/$locID_/$keywords/0/$minPrice/$maxPrice/$activeTab/$sortByType/$sortByPrice/$sortByDate\">$pageNum5</a></li>";
	             	if($NoOfItemCount > ($pageNum5*$itemPerPage))
	              		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext/$catID_/$locID_/$keywords/0/$minPrice/$maxPrice/$activeTab/$sortByType/$sortByPrice/$sortByDate\">Next</a></li>";
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
  $('.nav-tabs a').click(function(){
	    $(this).tab('show');
	})
$('#allAds1').click(function(){
	$('.nav-tabs a[href="#allAds"]').tab('show')
	})	
$('#newAds1').click(function(){
	$('.nav-tabs a[href="#newAds"]').tab('show')
	})	
$('#usedAds1').click(function(){
	$('.nav-tabs a[href="#usedAds"]').tab('show')
	})	
$( document ).ready(function() {
	    var sortType=document.getElementById('selectSortType').value;
	    if(sortType=="2"){
	  		  document.getElementById('sortByDateDiv').style.display = 'inline-block';
	  		   document.getElementById('sortByPriceDiv').style.display = 'none';
	  		  }
	  	  else if(sortType=="1"){
	  		  document.getElementById('sortByDateDiv').style.display = 'none';
	  		   document.getElementById('sortByPriceDiv').style.display = 'inline-block';
	  		  }else{
	  		  document.getElementById('sortByDateDiv').style.display = 'none';			  
	  		  document.getElementById('sortByPriceDiv').style.display = 'none';
	  		  
	  	  }
	});
  $('#selectSortType').change(function() {
	  if($(this).val()=="2"){
		  document.getElementById('sortByDateDiv').style.display = 'inline-block';
		   document.getElementById('sortByPriceDiv').style.display = 'none';
		  }
	  else if($(this).val()=="1"){
		  document.getElementById('sortByDateDiv').style.display = 'none';
		   document.getElementById('sortByPriceDiv').style.display = 'inline-block';
		  }else{
		  document.getElementById('sortByDateDiv').style.display = 'none';			  
		  document.getElementById('sortByPriceDiv').style.display = 'none';
		  
	  }
});	
	
function beginSort(){
	  var catID=document.getElementById("search-category").value;
	 	var locID=document.getElementById("id-location").value;
		var sortByType=document.getElementById("selectSortType").value;
	var sortByPrice=document.getElementById("sortByPrice").value;
	var sortByDate=document.getElementById("sortByDate").value;
	var keywords=document.getElementById("ads").value;
		   if(keywords.trim()=='')
			   keywords='0';
		   var activeTab=document.getElementById("paneActiveTab").value;
		   
		   var minPrice=document.getElementById("minPrice").value;
		   if(minPrice.trim()=='')
			   minPrice=0;
		   var maxPrice=document.getElementById("maxPrice").value;
		   if(maxPrice.trim()=='')
			   maxPrice=0;
		

		document.getElementById("sortfrm").action="<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/0/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab).concat("/").concat(sortByType).concat("/").concat(sortByPrice).concat("/").concat(sortByDate);
		document.getElementById("sortfrm").submit();
	}
	
  function setupTab(activeTab, activeCtrl){
		var catID=document.getElementById("search-category").value;
	 	var locID=document.getElementById("id-location").value;
		//var locID=0;
		var sortByType=document.getElementById("selectSortType").value;
	var sortByPrice=document.getElementById("sortByPrice").value;
	var sortByDate=document.getElementById("sortByDate").value;
	var keywords=document.getElementById("ads").value;
		   if(keywords.trim()=='')
			   keywords='0';
		   var minPrice=document.getElementById("minPrice").value;
		   if(minPrice.trim()=='')
			   minPrice=0;
		   var maxPrice=document.getElementById("maxPrice").value;
		   if(maxPrice.trim()=='')
			   maxPrice=0;
		
 //		   $('#pleaseWaitDialog').modal('show');
 		  	
//           setForm(function(data)
//            {
//                if(data == true)
//                {
// 					$.ajax({
// 						xhr: function()
// 						{
// 							var xhr = new window.XMLHttpRequest();
// 							//Upload progress
// 							xhr.upload.addEventListener("progress", function(evt){
// 							  if (evt.lengthComputable) {
// 								var percentComplete = evt.loaded / evt.total*100;
// 								//Do something with upload progress
// 								$("#upload-progress-bar").width(percentComplete+"%");
// 								console.log(percentComplete);
// 							  }
// 							}, false);
// 							return xhr;
// 						},
//						url: "<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat(sortByID).concat("/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab),
// 							//data: formData,
// 						processData: false,
// 						contentType: false,
// 						type: 'POST',
// 						success:function(msg){
							//$("#".concat(activeCtrl)).attr("href", "<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat(sortByID).concat("/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab));
// 							$('#progress-bar').css("display", "none");
// 							$('#pleaseWaitDialog').modal('hide');
// 						}
// 					});
//                }
//                return data;
//            });
			
		document.getElementById("myForm").action="<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat('0').concat("/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab).concat("/").concat(sortByType).concat("/").concat(sortByPrice).concat("/").concat(sortByDate);
		document.getElementById("myForm").submit();
	}
  function setForm(callback)
  {
  	  $('.progress-bar').css('width', 100+'%').attr('aria-valuenow', 100);
  		callback(true);
  }
function setup(){
	var catID=document.getElementById("search-category").value;
 	var locID=document.getElementById("id-location").value;
	//var locID=0;
	var sortByType=document.getElementById("selectSortType").value;
	var sortByPrice=document.getElementById("sortByPrice").value;
	var sortByDate=document.getElementById("sortByDate").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var minPrice=document.getElementById("minPrice").value;
	   if(minPrice.trim()=='')
		   minPrice=0;
	   var maxPrice=document.getElementById("maxPrice").value;
	   if(maxPrice.trim()=='')
		   maxPrice=0;
	   var activeTab=document.getElementById("paneActiveTab").value;
		   

// 	   $('#pleaseWaitDialog').modal('show');

//        setForm(function(data)
//         {
//             if(data == true)
//             {
// 					$.ajax({
// 						xhr: function()
// 						{
// 							var xhr = new window.XMLHttpRequest();
// 							//Upload progress
// 							xhr.upload.addEventListener("progress", function(evt){
// 							  if (evt.lengthComputable) {
// 								var percentComplete = evt.loaded / evt.total*100;
// 								//Do something with upload progress
// 								$("#upload-progress-bar").width(percentComplete+"%");
// 								console.log(percentComplete);
// 							  }
// 							}, false);
// 							return xhr;
// 						},
						url: "<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/0/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab),
// 						//data: formData,
// 						processData: false,
// 						contentType: false,
// 						type: 'POST',
// 						success:function(msg){
// 							$('#progress-bar').css("display", "none");
// 							$('#pleaseWaitDialog').modal('hide');
// 						}
// 					});
//             }
//             return data;
//         });
		
	document.getElementById("myForm").action="<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/0/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab).concat("/").concat(sortByType).concat("/").concat(sortByPrice).concat("/").concat(sortByDate);
	document.getElementById("myForm").submit();
}
function isNumber(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	}
function priceSetup(){
	var returnvalue=true;
	var catID=document.getElementById("search-category").value;
 	var locID=document.getElementById("id-location").value;
	//var locID=0;
	var sortByType=document.getElementById("selectSortType").value;
	var sortByPrice=document.getElementById("sortByPrice").value;
	var sortByDate=document.getElementById("sortByDate").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var minPrice=(document.getElementById("minPrice").value);
	   var maxPrice=(document.getElementById("maxPrice").value);
	   var activeTab=document.getElementById("paneActiveTab").value;

	   
 	if(!isNumber(minPrice) || !isNumber(maxPrice)){
		alert("<?php echo $this->lang->line('invalidpriceformat'); ?>");
 		returnvalue=false;
 	}else if(Number(minPrice) > Number(maxPrice)){
		alert("<?php echo $this->lang->line('invalidpricerange'); ?>");
 		returnvalue=false;
 	}else {
		document.getElementById("priceForm").action="<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat('0').concat("/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab).concat("/").concat(sortByType).concat("/").concat(sortByPrice).concat("/").concat(sortByDate);
 		document.getElementById("priceForm").submit();
 	}
 	return returnvalue;
}

function priceSetup1(){
	var returnvalue=true;
	var catID=document.getElementById("search-category").value;
 	var locID=document.getElementById("id-location").value;
//var locID=0;
	var sortByType=document.getElementById("sortByType").value;
	var sortByPrice=document.getElementById("selectSortType").value;
	var sortByDate=document.getElementById("sortByDate").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var minPrice=(document.getElementById("minPrice1").value);
	   var maxPrice=(document.getElementById("maxPrice1").value);
	   var activeTab=document.getElementById("paneActiveTab").value;
	   
 	  if(!isNumber(minPrice) || !isNumber(maxPrice)){
			alert("<?php echo $this->lang->line('invalidpriceformat'); ?>");
 			returnvalue=false;
 		}else if(Number(minPrice) > Number(maxPrice)){
			alert("<?php echo $this->lang->line('invalidpricerange'); ?>");
 			returnvalue=false;
		}else {
		   document.getElementById("priceForm1").action="<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat('0').concat("/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab).concat("/").concat(sortByType).concat("/").concat(sortByPrice).concat("/").concat(sortByDate);
			document.getElementById("priceForm1").submit();
			
	   } 
 	return returnvalue;
}
function locSetup1(){
	var catID=document.getElementById("search-category").value;
 	var locID=document.getElementById("region-state").value;
//var locID=0;
	var sortByType=document.getElementById("selectSortType").value;
	var sortByPrice=document.getElementById("sortByPrice").value;
	var sortByDate=document.getElementById("sortByDate").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var activeTab=document.getElementById("paneActiveTab").value;
	   
	   var minPrice=document.getElementById("minPrice1").value;
	   var maxPrice=document.getElementById("maxPrice1").value;
	document.getElementById("locForm1").action="<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat('0').concat("/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab).concat("/").concat(sortByType).concat("/").concat(sortByPrice).concat("/").concat(sortByDate);
	document.getElementById("locForm1").submit();
}
function catSetup1(){
	var catID=document.getElementById("parent-category").value;
 	var locID=document.getElementById("id-location").value;
//var locID=0;
	var sortByType=document.getElementById("selectSortType").value;
	var sortByPrice=document.getElementById("sortByPrice").value;
	var sortByDate=document.getElementById("sortByDate").value;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var activeTab=document.getElementById("paneActiveTab").value;
	   
	   var minPrice=document.getElementById("minPrice1").value;
	   var maxPrice=document.getElementById("maxPrice1").value;
	document.getElementById("catForm1").action="<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat('0').concat("/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab).concat("/").concat(sortByType).concat("/").concat(sortByPrice).concat("/").concat(sortByDate);
	document.getElementById("catForm1").submit();
}
function savedAds(ctrlValue, ctrlName, clickLink) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>getCategory/savedAds",
		data: { postID: $( "#".concat(ctrlValue) ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#Err".concat(ctrlName)).html(result.message);
	    	//$("#".concat(clickLink)).attr("href", "#");
	    	$("#".concat(clickLink)).attr("style", "pointer-events: none; cursor: default;color:yellow;");
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


<div class="modal fade" id="loginPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title">Please login</h4>
      	</div>
      	<div class="modal-body">
      	   <h2 class="center-text">Please login to continue the process</h2>
      	   <br>
      	   <a class="btn btn-primary btn-40 center-obj" href="<?php echo base_url().MY_PATH."home/loginPage?prevURL=".urlencode(current_url());?>" ><i class="fa fa-sign-in"></i>&nbsp;&nbsp;&nbsp;&nbsp;Login</a></p>
                    	
      	</div>
    	
    </div>
 </div>
</div>
<!-- Modal Change City -->
<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" tabindex="-1" role="dialog"  data-keyboard="false" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 id ="modal-text">Processing...<?php echo $this->lang->line("PleaseNotCloseBrowseWhileSearching");?> <img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif"></h1>
                                </div>
                                <div class="modal-body">
                                    <div id="progress-bar" class="progress">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar" id="upload-progress-bar"
                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">   
                                        </div>
                                    </div>
									<button id="fwd-btn" class="btn btn-primary btn-tw" onclick="backHomePage(); return false;" style="display: none;"><i class="fa fa-check"></i>Go to Homepage</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
<form role="form"  id="locForm1" class="form-inline modalBody margin-top-20"  onSubmit="return locSetup1()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/0';?>" method="POST">  
             
<div style="clear:both"></div>            
            <div class="col-sm-6 no-padding">
        <select  class="form-control selecter  " id="region-state" name="region-state">
		
		<?php 
		$str="";
		if($locID_==null or $locID_=="" or $locID_=='0')
			$str=" selected='selected' ";
		echo "<option ".$str." value=\"\">All Districts</option>";
		foreach ($resLoc as $id=>$value)
		{
			if(!isset($lang_label))
				$lang_label="";
				$name=$value[0]->name;
				if($lang_label<>"english")
					$name=$value[0]->nameCN;
					if($value[0]->level==2){
						$str="";
						$fontcolor="";
						if(strcmp($locID_, $id)==0)
							$str=" selected='selected' ";
						if($value[0]->parentID==1)
							$fontcolor="<font color=blue>";
						else if($value[0]->parentID==2)
							$fontcolor="<font color=green>";
						else if($value[0]->parentID==3)
							$fontcolor="<font color=red>";
							echo "<option ".$str." value='".$id."' style='font-weight:bold;'>".$fontcolor.$name."</font></option>";
					}
		}
		
		?>
		
		</select>
            </div>
            <div>
                    <div class="form-group no-padding">
                      <button id="locRangeBtn1" class="btn btn-default btn-pink btn-80  " 
                      type="submit">Filter<i class="icon-search-2"></i></button>
                    </div>
                  </div>
                </form>	
           <div style="clear:both"></div>            

            <hr class="hr-thin">
          </div>
          <div class="col-md-4">
            <ul  class="list-link list-unstyled">
              <?php 
             	$level2=array();
              foreach ($resLoc as $id=>$value){
              	if($value[0]->parentID==1){
              			array_push($level2,$value[0]->locationID);
              	}
              }
              
              $level3=array();
              foreach ($resLoc as $id=>$value){
              	if(in_array($value[0]->parentID, $level2)){
              		array_push($level3, $value[0]->locationID);
              	}
              }
              
               
              foreach ($resLoc as $id=>$value)
              {
              	if(!isset($lang_label))
              		$lang_label="";
              		$postCount=" (".$value[0]->postCount.")";
              		if(SHOW_BRACKETS_SEARCH_PAGE==0)
              			$postCount="";
              		$name=$value[0]->name.$postCount;
              		if($lang_label<>"english")
              			$name=$value[0]->nameCN.$postCount;
              			if($value[0]->level==3){
              				if(in_array($value[0]->locationID, $level3)){
              					$path=base_url().MY_PATH."getCategory/getAll/1/0/".$value[0]->locationID;
              								echo "<li>
              								<a  href=$path title=$name>
              								<font color=blue>
              								$name
              								</font>
              								</a> </li>";
              					}
              				
              			}
              }
              
              ?>
              
              </ul>
              </div>
              
              <div class="col-md-4">
            <ul  class="list-link list-unstyled">
              <?php 
			$level2=array();
              foreach ($resLoc as $id=>$value){
              	if($value[0]->parentID==2){
              			array_push($level2,$value[0]->locationID);
              	}
              }
              
              $level3=array();
              foreach ($resLoc as $id=>$value){
              	if(in_array($value[0]->parentID, $level2)){
              		array_push($level3, $value[0]->locationID);
              	}
              }
              
              foreach ($resLoc as $id=>$value)
              {
              	if(!isset($lang_label))
              		$lang_label="";
              		$postCount=" (".$value[0]->postCount.")";
              		if(SHOW_BRACKETS_SEARCH_PAGE==0)
              			$postCount="";
              		$name=$value[0]->name.$postCount;
              		if($lang_label<>"english")
              			$name=$value[0]->nameCN.$postCount;
              			if($value[0]->level==3){
              					if(in_array($value[0]->locationID, $level3)){
              						$path=base_url().MY_PATH."getCategory/getAll/1/0/".$value[0]->locationID;
              								echo "<li>
              								<a  href=$path title=$name>
              								<font color=green>
              								$name
              								</font>
              								</a> </li>";
              					}
              				
              			}
              }
              
              ?>
              
              </ul>
              </div>
              
              <div class="col-md-4">
            <ul  class="list-link list-unstyled">
              <?php 
				$level2=array();
              foreach ($resLoc as $id=>$value){
              	if($value[0]->parentID==3){
              			array_push($level2,$value[0]->locationID);
              	}
              }
              
              $level3=array();
              foreach ($resLoc as $id=>$value){
              	if(in_array($value[0]->parentID, $level2)){
              		array_push($level3, $value[0]->locationID);
              	}
              }
              foreach ($resLoc as $id=>$value)
              {
              	if(!isset($lang_label))
              		$lang_label="";
              		$postCount=" (".$value[0]->postCount.")";
              		if(SHOW_BRACKETS_SEARCH_PAGE==0)
              			$postCount="";
              		$name=$value[0]->name.$postCount;
              		if($lang_label<>"english")
              			$name=$value[0]->nameCN.$postCount;
              			if($value[0]->level==3){
              				if(in_array($value[0]->locationID, $level3)){
              						$path=base_url().MY_PATH."getCategory/getAll/1/0/".$value[0]->locationID;
              								echo "<li>
              								<a  href=$path title=$name>
              								<font color=red>
              								$name
              								</font>
              								</a> </li>";
              					}
              				
              			}
              }
              
              ?>
              
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

          <div class="locations-list  list-filter">
                <h5 class="list-title">
                <div class="modalBody">
				<div class="searchCat3">
                <i class="fa fa-usd"></i>Price <strong>Range</strong>
				</div>
                </div>
                </h5>
               <form role="form"  id="priceForm1" class="form-inline modalBody"  onSubmit="return priceSetup1()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/0';?>" method="POST">  
                  <div class="margin-top-20">
					  <div id="price-slider1" class="price-slider"></div>
                      <input type="number" placeholder="20" id="minPrice1"
                      value=<?php  if($minPrice>0) echo $minPrice;?>     
                      name="minPrice1"  min="20" class="form-control price">
                      <span id="menubarTitle"> — </span>
                      <input type="number" placeholder="5000 " id="maxPrice1"  
                      value=<?php if($maxPrice>0) echo $maxPrice;?>  
                      name="maxPrice1" max="5000"   class="form-control price">
					  <script type="text/javascript">
						var html5Slider1 = document.getElementById('price-slider1');


						noUiSlider.create(html5Slider1, {
							start: [ <?php if($minPrice>0)echo $minPrice; else echo 20;?>, <?php if($minPrice>0)echo $maxPrice; else echo 5000;?> ],

							connect: true,
							range: {
								'min': 20,
								'max': 5000
							}
						});
						
						var minPrice1 = document.getElementById('minPrice1');
						var maxPrice1 = document.getElementById('maxPrice1');
						
						html5Slider1.noUiSlider.on('update', function( values, handle ) {

							var value = values[handle];

							if ( handle ) {
								maxPrice1.value = Math.round(value);
							} else {
								minPrice1.value = Math.round(value);
							}
						});

						minPrice1.addEventListener('change', function(){
							html5Slider1.noUiSlider.set([this.value, null]);
						});

						maxPrice1.addEventListener('change', function(){
							html5Slider1.noUiSlider.set([null, this.value]);
						});

						
					</script>
                  </div>
                  <div>
                    <div class="form-group no-padding">
                      <button id="priceRangeBtn1" class="btn btn-default btn-pink margin-top-20" 
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
		<form role="form"  id="catForm1" class="form-inline modalBody margin-top-20"  onSubmit="return catSetup1()"  action="<?php echo base_url().MY_PATH.'getCategory/getAll/1/'.$catID_.'/'.$locID_.'/'.$keywords.'/0';?>" method="POST">  
             
                  
			<div style="clear:both"></div>            
            <div class="col-sm-6 no-padding">
        <select  class="form-control selecter  " id="parent-category" name="parent-category">
		
		<?php 
		
		$str="";
		if($catID_==null or $catID_=="" or $catID_==0)
			$str=" selected='selected' ";
		echo "<option ".$str." value=\"\">All Categories</option>";
		
		
		foreach ($result as $id=>$value)
		{
			if(!isset($lang_label))
				$lang_label="";
				$name=$value[0]->name;
				$postCount="(".$value[0]->postCount.")";
				if(SHOW_BRACKETS_SEARCH_PAGE==0)
					$postCount="";
				if($lang_label<>"english")
					$name=$value[0]->nameCH;
					if($value[0]->level==1)
					{
						$str="";
						if(strcmp($catID_, $id)==0)
							$str=" selected='selected' ";
						echo "<option ".$str." value='".$id."'  style='background-color:#E9E9E9;font-weight:bold;' > ".$name.$postCount." </option>";
					}
		}		
		?>
		
		
		
		
		</select>
		</div>
				
                    <div class="form-group no-padding">
                      <button id="catRangeBtn1" class="btn btn-default btn-pink btn-80  " 
                      type="submit">Filter<i class="icon-search-2"></i></button>
                    </div>
                
                  
                </form>	
            
           <div style="clear:both"></div>            

            <hr class="hr-thin">
          </div>
          
          <?php 
    	     $count=0;
    	     $total=0;
    	     $lastCol=0;
            foreach ($result as $id=>$value)
            {
            	if(!isset($lang_label))
	            		$lang_label="";
            	$name=$value[0]->name;
            	$postCount="(".$value[0]->postCount.")";
            	if(SHOW_BRACKETS_SEARCH_PAGE==0)
            		$postCount="";
            	if($lang_label<>"english")
            		$name=$value[0]->nameCH;
            	$path=base_url().MY_PATH."getCategory/getAll/1/".$value[0]->categoryID;
            	
            	if($value[0]->level==1)
            	{
            		$total++;
            		$count++;
            		if($count==7)
            		{
            			$lastCol++;
            			$count=1;
            		}
            		if($total<>1)
            			echo "</ul>";
            			//echo "</ul></div>";
            		if($count==1)
            		{
            			if($total<>1)
            				echo "</div>";
            			if($lastCol==2)
            				echo "<div class=\"col-md-4 col-sm-4 last-column\">";
            			else
            			echo "<div class=\"col-md-4 col-sm-4\">";
            		}
            		$imageIcon=$value[0]->iconImage;
            		if($value[0]->childCount<>0){
            		//echo "<div class=\"cat-list\">";
            		echo "<h5 class=\"cat-title\"><a class=\"title-font\"  style=\"margin:0px; padding:0px;padding-left:3px;\"  href='$path'>$name $postCount</a>";
            		
            		//echo "<span data-target=\".cat-id-$total\"  data-toggle=\"collapse\"  class=\"btn-cat-collapsed collapsed\">   <span class=\" icon-down-open-big\"></span> </span>";
            		//echo "<span class=\" icon-down-open-big\"></span>";
            		echo "</h5>";
            	 
            		//echo "<ul class=\"cat-collapse collapse in cat-id-$total\">";
            		echo "<ul>";
            		} else {
            			//echo "<div class=\"cat-list\">";
            			echo "<h5 ><a class=\"title-font\" style=\"margin:0px; padding:0px;padding-left:3px;\" href='$path'>$name $postCount</a>";
            			
            			//echo "<span data-target=\".cat-id-$total\"  >  </span>";
            			echo "</h5>";
            			echo "<ul>";
            			
            		}
            	}else 
            	{
            		echo  "<li> <a href='$path'><h6>$name $postCount</h6></a></li>";
                   
            	}
            }
            if($total<>0)
            	echo "</ul></div></div></div>";
            ?>
          
          
          
          
          
          
       <!--   <div class="locations-list  list-filter modalBody">
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
          -->
          
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
function backHomePage(){
	window.location = "<?php echo base_url();?>";
}

</script>
<?php include "footer2.php"; ?>

