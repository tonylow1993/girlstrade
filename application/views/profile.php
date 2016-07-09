<?php $title = "Girls' Trading Platform";  include("header.php");?>
<style>
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
        <div class="col-sm-3 page-sidebar">
          <aside>
            <div class="inner-box">
              <div class="categories-list  list-filter">
                <h5 class="content-subheading userName"><img class="ratingIcon" src="<?php echo base_url()."images/".$userRating; ?>" />
                <strong><?php echo $userName;?></strong></h5>
                
                <ul class=" list-unstyled">
	            <img src="<?php echo $userPhotoPath;?>" class="img-thumbnail center-obj" alt="profilePic" width="auto" height="auto">
	            
	               <li><span class="count"><p>&nbsp;<?php echo $this->lang->line("profileNormalUser");?></p></span> </li>
                </ul>
                              
                <!--<table class="userProfileTable">
                <tr>
                <td>
                <p class="userRating">
                User Rating: </p>
                </td><td>
                <div id="userStar"></div>
                </td></tr>
                </table>-->
              </div>
              <!--/.categories-list-->
              
              <div class="locations-list  list-filter">
                <h5 class="list-title"><strong><?php echo $this->lang->line("profileInfo");?></strong></h5>
                <table class="browse-list list-unstyled userProfileTable">
				
                 <tr><td><p><?php echo $this->lang->line("profileRegisterationDate");?> </p></td>
                 <td><p class="userInfoData"><?php echo $createDate; //->format('Y-m-d');?>  </p></td></tr>
                 <?php if(strcmp(SHOWLASTACTIVITY,"Y")==0){?>
                 <tr><td><p><?php echo $this->lang->line("profileLatestAccountActivity");?></p></td>   
                 <td><p class="userInfoData"><?php echo  $lastLoginTime; //->format('Y-m-d H:i:s');?></p></td></tr>
                 <?php }?>
                 <tr><td><p><?php echo $this->lang->line("profileTotalPost");?></p></td>  
                 <td><p class="userInfoData"><?php $count=0; if($itemList!=null) $count=count($itemList); 
                 echo $count; ?></p></td></tr>
                </table>
              </div>
              <?php 
              if($recentBuyerComment!=""){
	              echo "Latest Buyer Comment: ".$recentBuyerComment;
	              echo "<br/>";
              }
              if($recentSellerComment!=""){
	              echo "Latest Seller Comment: ".$recentSellerComment;
	              echo "<br/>";
              }
              ?>
              <?php 
              echo "<br/>";
              echo $this->lang->line("MyIntroduction")." :".$introduction;
              echo "<br/>";
              ?>
              
              <a href="<?php echo base_url().MY_PATH."home/viewAllFeedback/$userID/1?prevURL=".urlencode(current_url())."&prevViewFeedBack_Url=",urlencode(current_url()); ?>"> 
              <?php echo $this->lang->line("profileViewAllComments");?></a>
              <br />
              <?php $usr = $this->nativesession->get('user');
					if(empty($usr) || $isSameUser){ 
           			?>
<!--               <a href="#contactAdvertiser1" disabled="disabled" data-toggle="modal" class="btn   btn-default btn-block inboxMsgButton"> -->
<!--               <i class=" icon-mail-2"></i> Send Private Message</a> -->
               <?php }else{?>
               <a href="#contactAdvertiser1" data-toggle="modal" class="btn   btn-default btn-block inboxMsgButton">
               <i class=" icon-mail-2"></i> <?php echo $this->lang->line("profileSendPrivateMessage");?></a>
              
               <?php }?>  
               </div>
          </aside>
        </div>
        <!--/.page-side-bar-->
        <div class="col-sm-9 page-content col-thin-left">
          <div class="category-list">
          
 			<div class="tab-box "> 
              <!-- Nav tabs -->
<!--               id="ajaxTabs" role="tablist" -->
              <ul class="nav nav-tabs add-tabs" >
              <li <?php if(strcmp($activeTab, "allAds")==0) echo "class=\"active\""; ?>><a href="<?php echo 	base_url().MY_PATH.'viewProfile/viewByUserID/'.$userID.'/'.$pageNum.'/0/0/0/'.$sortByType.'/'.$sortByPrice.'/'.$sortByDate.'/allAds?prevURL='.$previousCurrent_url;?>" id="allAds1" name="allAds1" >
                <?php echo $lblConditionAny;?>
                <?php 
                  		if(SHOW_BRACKETS_PROFILE_PAGE==1){
                  			
                  		?>
                <span class="badge"><?php 
                $rowCount=0;
                if($itemList<>null && sizeof($itemList)>0)
                	$rowCount=sizeof($itemList);
                echo $rowCount;
                ?></span>
                <?php }?></a></li>
                <li <?php if(strcmp($activeTab, "newAds")==0) echo "class=\"active\""; ?>><a href="<?php echo 	base_url().MY_PATH.'viewProfile/viewByUserID/'.$userID.'/'.$pageNum.'/0/0/0/'.$sortByType.'/'.$sortByPrice.'/'.$sortByDate.'/newAds?prevURL='.$previousCurrent_url;
             ?>" id="newAds1" name="newAds1" >
                <?php echo $lblConditionNew;?>
                <?php 
                  		if(SHOW_BRACKETS_PROFILE_PAGE==1){
                  			
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
                <?php }?></a></li>
                <li <?php if(strcmp($activeTab, "usedAds")==0) echo "class=\"active\""; ?>><a href="<?php echo base_url().MY_PATH.'viewProfile/viewByUserID/'.$userID.'/'.$pageNum.'/0/0/0/'.$sortByType.'/'.$sortByPrice.'/'.$sortByDate.'/usedAds?prevURL='.$previousCurrent_url;?>" id="usedAds1" name="usedAds1" >
                <?php echo $lblConditionUsed;?> 
                <?php 
                  		if(SHOW_BRACKETS_PROFILE_PAGE==1){
                  			
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
	                <?php }?></a></li>
              </ul>
         		 <div class="sortByDiv"><form role="form" method="POST" action="<?php echo base_url().MY_PATH.'viewProfile/viewByUserID/'.$userID.'/'.$pageNum.'/'.$catID.'/0/0?prevURL='.$previousCurrent_url.'&prevViewFeedBack_Url='.urlencode(current_url());?>"
         	     id="sortfrm" class="tab-filter"> 
         	      	<input type="hidden" name="paneActiveTab" id="paneActiveTab" value="<?php echo $activeTab;?>" >
             
			   <div class="form-group sort-group" style="width:150px;">
				  <select class="form-control sort-select" name="selectSortType"   id="selectSortType" data-width="auto">
					  <option value="0" <?php if(strcmp($sortByType,"0")==0 or $sortByType==0) echo " selected='selected' ";?> ><?php echo $lblSearchSortBy;?></option>
					  <option value="1" <?php if(strcmp($sortByType,"1")==0)  echo " selected='selected' ";?>><?php echo $Price;?></option>
					  <option value="2" <?php if(strcmp($sortByType,"2")==0)  echo " selected='selected' ";?>><?php echo $Date;?></option>
					  <option value="3" <?php if(strcmp($sortByType,"3")==0)  echo " selected='selected' ";?>><?php echo $Category;?></option>
					</select>
			    </div>
			   
			   	<div id="sortByPriceDiv" style="display:none;width:150px">
					<select class="form-control "   name="sortByPrice"   id="sortByPrice" data-width="auto"  onchange="beginSort();">
					  <option value="0" <?php if(strcmp($sortByPrice,"0")==0 or $sortByPrice==0) echo " selected='selected' ";?> ><?php echo $lblSearchSortBy;?></option>
					  <option value="1" <?php if(strcmp($sortByPrice,"1")==0)  echo " selected='selected' ";?>><?php echo $lblPriceLowToHigh;?></option>
					  <option value="2" <?php if(strcmp($sortByPrice,"2")==0)  echo " selected='selected' ";?>><?php echo $lblPriceHighToLow;?></option>
					</select>
				</div>
				
				<div id="sortByDateDiv" style="display:none;width:150px">
					<select class="form-control "   name="sortByDate"   id="sortByDate" data-width="auto" onchange="beginSort();">
					  <option value="0" <?php if(strcmp($sortByDate,"0")==0 or $sortByDate==0) echo " selected='selected' ";?> ><?php echo $lblSearchSortBy;?></option>
					  <option value="1" <?php if(strcmp($sortByDate,"1")==0)  echo " selected='selected' ";?>><?php echo $mostRecent;?></option>
					  <option value="2" <?php if(strcmp($sortByDate,"2")==0)  echo " selected='selected' ";?>><?php echo $oldest;?></option>
					</select>
				</div> 
				<div id="filterByCategoryDiv" style="display:none;width:150px;">
				<select class="form-control " name="search-category" id="search-category" onchange="beginSort();">
        	<?php 
        	$str="";
        	if($catID==null or $catID=="" or $catID==0)
        		$str=" selected='selected' ";
        	echo "<option ".$str." value='0'>".$lblAllCategories."</option>";
            foreach ($AllCategory as $id=>$value)
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
            		if(strcmp($catID,$id)==0)
            			$str=" selected='selected' ";
            		 echo "<option value='".$id."' ".$str." style='background-color:#E9E9E9;font-weight:bold;' > ".$name.$postCount." </option>";
            	}else 
            	{
            		$str="";
            		if(strcmp($catID,$id)==0)
            			$str=" selected='selected' ";
            		echo "<option ".$str." value='".$id."'> &nbsp;&nbsp;&nbsp;&nbsp;".$name.$postCount." </option>";
            	}
            }
            ?>
          </select>
          </div>
				 <!--<div class="col-sm-3">
				<button type="submit"  class="btn btn-block btn-primary">Sort</button> 
    			
				</div>-->
				<noscript><input type="submit" value="Submit"></noscript>
			</form></div>
            <!--/.tab-box-->
               <a class="pull-right margin-5 back-btn" href=<?php echo $prevProfile_Url;?>> <i class="fa fa-angle-double-left"></i> 
               <?php echo $this->lang->line("profileBackToResult");?>
               </a>
 
           </div>
               
            <div class="adds-wrapper">
              <div class="tab-content">
               <div class="tab-pane fade <?php if(strcmp($activeTab, "allAds")==0) echo "in active"; ?>" id="allAds">
               
                <?php
             $basePath=base_url();
             $encodeCurrentURL=urlencode(current_url());
             $title=$this->lang->line("lblTitle");
              if($itemList<>null)
              {
              	$rowCount=0;
              
              foreach($itemList as $id=>$item)
				{
					$rowCount=$rowCount+1;
				  $viewBasePath=$basePath.MY_PATH."viewItem/index/".$id."/".$catID."/".$locID."/".$keywords."?prevURL=".$encodeCurrentURL."&prevItem_Url=".urlencode(current_url());
              		$locationName='';
					$categoryName='';
					$post=NULL;
					$soldToUserName="";
					$getDisableSavedAds=false;
					foreach($item as $key=>$child)
					{
						if($key=='post')
							$post=$child;
						else if($key=='location')
							$locationName=$child[0]->name;
						else if($key=='category')
							$categoryName=$child[0]->name;
						else if($key=='soldToUser'){
							if($child<> null && count($child)>0)
								$soldToUserName=$child[0]->username;
							else if($key=='savedAds')
								$getDisableSavedAds=$child;
						}
					}
					echo  "<div class=\"item-list\"> ";
              		echo  "<div class=\"col-sm-2 no-padding photobox\">";
					foreach($item as $pic=>$picObj)
              		{	
              			if($pic=='pic')
              			{
              				$picCount=count($picObj);
              				if($picCount>0)
              				{
	              				for($x=0;$x<1;$x++)
	              				{
		              			$thumbnail=$basePath.$picObj[$x]->thumbnailPath.'/'.$picObj[$x]->thumbnailName;
		              			echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";              			
		              			}
              				}else {
              				$thumbnail = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
							echo "<div class=\"add-image\"> <span class=\"photo-count\">
							<i class=\"fa fa-camera\"></i> 0 </span> <a href=\"$viewBasePath\">
							<img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";
              				}
              			}
              		}
              	

              		$enableMarkSoldBtn=false;
              		$visibleBuyerComment=false;
              		$soldToUserID=0;
              			$soldToUserID=$post->soldToUserID;
              			$enableMarkSoldBtn=$post->sellerRating==null;
              			$visibleBuyerComment=$post->sellerRating<>null &&
              			$post->buyerRating==null;
              			$previewTitle=$post->itemName;
              			$preview=trimLongText(trim($post->description));
              			if($post->sellerRating<>null){
              				$preview=$preview."<br/>Seller Comment:  (". getRating($post->sellerRating).")";
              				$preview=$preview." ".$post->sellerComment;
              			}
              			if($post->buyerRating<>null){
              				$preview=$preview."<br/> Buyer [$soldToUserName] Comment: (". getRating($post->buyerRating).")";
              				$preview=$preview." ".$post->buyerComment;
              			}
              			
              		
              		$ctrlName="AjaxLoad".$rowCount;
              		$errorctrlName="ErrAjaxLoad".$rowCount;
              		$ctrlValue="post".$rowCount;
              		$postID2=$post->postID;
              		$clickLink="clickLink".$rowCount;
				echo "</div>";
			    echo "<div class=\"col-sm-7 add-desc-box\">";
                 // echo "<div class=\"add-details\">";
                echo "<div class=\"ads-details\">";   
			    echo "<h5> <div class=\"add-title-girlstrade\"><a href=\"$viewBasePath\">$title $previewTitle</a></div><a href=\"$viewBasePath\">$preview </a></h5>";
                   echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $post->createDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h4 class=\"item-price\">$</h4><h1 class=\"item-price\">$post->itemPrice</h1>";
                  echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
				  /*echo "<a class=\"btn btn-primary btn-block btn-pink\" href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL&prevItem_Url=".urlencode(current_url())."><i class=\"fa fa-info-circle\"></i>  View Details</a>";
				  
				if(isset($usr) && !empty($usr) && $usr["username"]!=null){
					 if($post->userID!=$usr["userID"]){
					 	 if($item["isPendingRequest"]==false && $item["isPostAlready"]==false)
					 	{
					 		echo "<a  href=";
					 		echo base_url().MY_PATH."messages/directSend/".$postID2."?prevURL=".urlencode(current_url()); //."&prevprevURL=".urlencode($previousCurrent_url);
                			echo " data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
					 	}else if($item["isPendingRequest"] == true){
					 		echo "<a  href=\"\" onclick=\"return false;\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink disabled\" > <i class=\" icon-pencil\"></i> Pending for Seller's Approval</a>";
					 	}
					 }
					}else{
						echo "<a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
					}
                  /* if($getDisableSavedAds)
                  	echo "[<a style=\"pointer-events: none; cursor: default;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>] ";
                  else
                  echo "[<a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>] ";
                  	echo "[<a href=\"$viewBasePath\">View Details</a>]</div>";
               */
               echo "</div></div>"; 
				}
               
				}
				
              ?>  
              </div>
              
               <div class="tab-pane <?php if(strcmp($activeTab, "newAds")==0) echo "active"; ?>" id="newAds">
              <?php
//              $basePath=base_url();
//              $encodeCurrentURL=urlencode(current_url());
//              $title=$this->lang->line("lblTitle");
//               if($itemList<>null)
//               {
//               	$rowCount=0;
              
//               foreach($itemList as $id=>$item)
// 				{
// 					if(strcmp($item["newUsed"], "N")!=0)
// 						continue;
// 					$rowCount=$rowCount+1;
// 				  $viewBasePath=$basePath.MY_PATH."viewItem/index/".$id."/".$catID."/".$locID."/".$keywords."?prevURL=".$encodeCurrentURL."&prevItem_Url=".urlencode(current_url());
//               		$locationName='';
// 					$categoryName='';
// 					$post=NULL;
// 					$soldToUserName="";
// 					$getDisableSavedAds=false;
// 					foreach($item as $key=>$child)
// 					{
// 						if($key=='post')
// 							$post=$child;
// 						else if($key=='location')
// 							$locationName=$child[0]->name;
// 						else if($key=='category')
// 							$categoryName=$child[0]->name;
// 						else if($key=='soldToUser'){
// 							if($child<> null && count($child)>0)
// 								$soldToUserName=$child[0]->username;
// 							else if($key=='savedAds')
// 								$getDisableSavedAds=$child;
// 						}
// 					}
// 					echo  "<div class=\"item-list\"> ";
//               		echo  "<div class=\"col-sm-2 no-padding photobox\">";
// 					foreach($item as $pic=>$picObj)
//               		{	
//               			if($pic=='pic')
//               			{
//               				$picCount=count($picObj);
//               				if($picCount>0)
//               				{
// 	              				for($x=0;$x<1;$x++)
// 	              				{
// 		              			$thumbnail=$basePath.$picObj[$x]->thumbnailPath.'/'.$picObj[$x]->thumbnailName;
// 		              			echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";              			
// 		              			}
//               				}
//               			}
//               		}
//               		$enableMarkSoldBtn=false;
//               		$visibleBuyerComment=false;
//               		$soldToUserID=0;
//               			$soldToUserID=$post->soldToUserID;
//               			$enableMarkSoldBtn=$post->sellerRating==null;
//               			$visibleBuyerComment=$post->sellerRating<>null &&
//               			$post->buyerRating==null;
//               			$previewTitle=$post->itemName;
//               			$preview=trimLongText(trim($post->description));
//               			if($post->sellerRating<>null){
//               				$preview=$preview."<br/>Seller Comment:  (". getRating($post->sellerRating).")";
//               				$preview=$preview." ".$post->sellerComment;
//               			}
//               			if($post->buyerRating<>null){
//               				$preview=$preview."<br/> Buyer [$soldToUserName] Comment: (". getRating($post->buyerRating).")";
//               				$preview=$preview." ".$post->buyerComment;
//               			}
              			
              		
//               		$ctrlName="AjaxLoad".$rowCount;
//               		$errorctrlName="ErrAjaxLoad".$rowCount;
//               		$ctrlValue="post".$rowCount;
//               		$postID2=$post->postID;
//               		$clickLink="clickLink".$rowCount;
// 				echo "</div>";
// 			    echo "<div class=\"col-sm-7 add-desc-box\">";
//                  // echo "<div class=\"add-details\">";
//                 echo "<div class=\"add-details\">";   
// 			    echo "<h5 class=\"add-title\"> <div class=\"add-title-girlstrade\"><a href=\"$viewBasePath\">$title $previewTitle</a></div><a href=\"$viewBasePath\">$preview </a></h5>";
//                    echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $post->createDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
//                 echo "</div>";
                
//                 echo "<div class=\"col-sm-3 text-right  price-box\">";
//                 echo "<h4 class=\"item-price\">$</h4><h1 class=\"item-price\">$post->itemPrice</h1>";
//                 echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
//                 /*echo "<a class=\"btn btn-primary btn-block btn-pink\" href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL&prevItem_Url=".urlencode(current_url())."><i class=\"fa fa-info-circle\"></i>  View Details</a>";
                
// 				if(isset($usr) && !empty($usr) && $usr["username"]!=null){
// 					 if($post->userID!=$usr["userID"]){
// 					 	 if($item["isPendingRequest"]==false && $item["isPostAlready"]==false)
// 					 	{
// 					 		echo "<a  href=";
// 					 		echo base_url().MY_PATH."messages/directSend/".$postID2."?prevURL=".urlencode(current_url()); //."&prevprevURL=".urlencode($previousCurrent_url);
//                 			echo " data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
// 					 	}else if($item["isPendingRequest"] == true){
// 					 		echo "<a  href=\"\" onclick=\"return false;\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink disabled\" > <i class=\" icon-pencil\"></i> Pending for Seller's Approval</a>";
// 					 	}
// 					 }
// 					}else{
// 						echo "<a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
// 					}
//                 /*
//                 echo "<div class=\"col-sm-3 text-right  price-box\">";
//                 echo "<h2 class=\"item-price\"> $post->currency $post->itemPrice</h2>";
//                   echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
              
//                   if($getDisableSavedAds)
//                   	echo "[<a style=\"pointer-events: none; cursor: default;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>] ";
//                   else
//                   echo "[<a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>] ";
//                   	echo "[<a href=\"$viewBasePath\">View Details</a>]</div>";
//                */
//                   	echo "</div></div>";
// 				}
               
// 				}
				$basePath=base_url();
				$encodeCurrentURL=urlencode(current_url());
				$title=$this->lang->line("lblTitle");
				if($itemList<>null)
				{
					$rowCount=0;
				
					foreach($itemList as $id=>$item)
					{
						$rowCount=$rowCount+1;
						$viewBasePath=$basePath.MY_PATH."viewItem/index/".$id."/".$catID."/".$locID."/".$keywords."?prevURL=".$encodeCurrentURL."&prevItem_Url=".urlencode(current_url());
						$locationName='';
						$categoryName='';
						$post=NULL;
						$soldToUserName="";
						$getDisableSavedAds=false;
						foreach($item as $key=>$child)
						{
							if($key=='post')
								$post=$child;
								else if($key=='location')
									$locationName=$child[0]->name;
									else if($key=='category')
										$categoryName=$child[0]->name;
										else if($key=='soldToUser'){
											if($child<> null && count($child)>0)
												$soldToUserName=$child[0]->username;
												else if($key=='savedAds')
													$getDisableSavedAds=$child;
										}
						}
						echo  "<div class=\"item-list\"> ";
						echo  "<div class=\"col-sm-2 no-padding photobox\">";
						foreach($item as $pic=>$picObj)
						{
							if($pic=='pic')
							{
								$picCount=count($picObj);
								if($picCount>0)
								{
									for($x=0;$x<1;$x++)
									{
										$thumbnail=$basePath.$picObj[$x]->thumbnailPath.'/'.$picObj[$x]->thumbnailName;
										echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";
									}
								}else {
									$thumbnail = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
									echo "<div class=\"add-image\"> <span class=\"photo-count\">
									<i class=\"fa fa-camera\"></i> 0 </span> <a href=\"$viewBasePath\">
									<img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";
								}
							}
						}
						 
				
						$enableMarkSoldBtn=false;
						$visibleBuyerComment=false;
						$soldToUserID=0;
						$soldToUserID=$post->soldToUserID;
						$enableMarkSoldBtn=$post->sellerRating==null;
						$visibleBuyerComment=$post->sellerRating<>null &&
						$post->buyerRating==null;
						$previewTitle=$post->itemName;
						$preview=trimLongText(trim($post->description));
						if($post->sellerRating<>null){
							$preview=$preview."<br/>Seller Comment:  (". getRating($post->sellerRating).")";
							$preview=$preview." ".$post->sellerComment;
						}
						if($post->buyerRating<>null){
							$preview=$preview."<br/> Buyer [$soldToUserName] Comment: (". getRating($post->buyerRating).")";
							$preview=$preview." ".$post->buyerComment;
						}
						 
				
						$ctrlName="AjaxLoad".$rowCount;
						$errorctrlName="ErrAjaxLoad".$rowCount;
						$ctrlValue="post".$rowCount;
						$postID2=$post->postID;
						$clickLink="clickLink".$rowCount;
						echo "</div>";
						echo "<div class=\"col-sm-7 add-desc-box\">";
						// echo "<div class=\"add-details\">";
						echo "<div class=\"ads-details\">";
						echo "<h5> <div class=\"add-title-girlstrade\"><a href=\"$viewBasePath\">$title $previewTitle</a></div><a href=\"$viewBasePath\">$preview </a></h5>";
						echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $post->createDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
						echo "</div>";
						echo "<div class=\"col-sm-3 text-right  price-box\">";
						echo "<h4 class=\"item-price\">$</h4><h1 class=\"item-price\">$post->itemPrice</h1>";
						echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
						/*echo "<a class=\"btn btn-primary btn-block btn-pink\" href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL&prevItem_Url=".urlencode(current_url())."><i class=\"fa fa-info-circle\"></i>  View Details</a>";
				
						if(isset($usr) && !empty($usr) && $usr["username"]!=null){
						if($post->userID!=$usr["userID"]){
						if($item["isPendingRequest"]==false && $item["isPostAlready"]==false)
						{
						echo "<a  href=";
						echo base_url().MY_PATH."messages/directSend/".$postID2."?prevURL=".urlencode(current_url()); //."&prevprevURL=".urlencode($previousCurrent_url);
						echo " data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
						}else if($item["isPendingRequest"] == true){
						echo "<a  href=\"\" onclick=\"return false;\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink disabled\" > <i class=\" icon-pencil\"></i> Pending for Seller's Approval</a>";
						}
						}
						}else{
						echo "<a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
						}
						/* if($getDisableSavedAds)
							echo "[<a style=\"pointer-events: none; cursor: default;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>] ";
							else
								echo "[<a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>] ";
								echo "[<a href=\"$viewBasePath\">View Details</a>]</div>";
								*/
							echo "</div></div>";
					}
					 
				}
              ?>  
              </div>
              
            <div class="tab-pane <?php if(strcmp($activeTab, "usedAds")==0) echo "active"; ?>" id="usedAds">
               
                <?php
// $basePath=base_url();
//              $encodeCurrentURL=urlencode(current_url());
//              $title=$this->lang->line("lblTitle");
//               if($itemList<>null)
//               {
//               	$rowCount=0;
//               foreach($itemList as $id=>$item)
// 				{
// 					if(strcmp($item["newUsed"], "U")!=0)
// 						continue;
// 					$rowCount=$rowCount+1;
// 				  $viewBasePath=$basePath.MY_PATH."viewItem/index/".$id."/".$catID."/".$locID."/".$keywords."?prevURL=".$encodeCurrentURL."&prevItem_Url=".urlencode(current_url());
//               		$locationName='';
// 					$categoryName='';
// 					$post=NULL;
// 					$soldToUserName="";
// 					$getDisableSavedAds=false;
// 					foreach($item as $key=>$child)
// 					{
// 						if($key=='post')
// 							$post=$child;
// 						else if($key=='location')
// 							$locationName=$child[0]->name;
// 						else if($key=='category')
// 							$categoryName=$child[0]->name;
// 						else if($key=='soldToUser'){
// 							if($child<> null && count($child)>0)
// 								$soldToUserName=$child[0]->username;
// 							else if($key=='savedAds')
// 								$getDisableSavedAds=$child;
// 						}
// 					}
// 					echo  "<div class=\"item-list\"> ";
//               		echo  "<div class=\"col-sm-2 no-padding photobox\">";
// 					foreach($item as $pic=>$picObj)
//               		{	
//               			if($pic=='pic')
//               			{
//               				$picCount=count($picObj);
//               				if($picCount>0)
//               				{
// 	              				for($x=0;$x<1;$x++)
// 	              				{
// 		              			$thumbnail=$basePath.$picObj[$x]->thumbnailPath.'/'.$picObj[$x]->thumbnailName;
// 		              			echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";              			
// 		              			}
//               				}
//               			}
//               		}
//               		$enableMarkSoldBtn=false;
//               		$visibleBuyerComment=false;
//               		$soldToUserID=0;
//               			$soldToUserID=$post->soldToUserID;
//               			$enableMarkSoldBtn=$post->sellerRating==null;
//               			$visibleBuyerComment=$post->sellerRating<>null &&
//               			$post->buyerRating==null;
//               			$previewTitle=$post->itemName;
//               			$preview=trimLongText(trim($post->description));
//               			if($post->sellerRating<>null){
//               				$preview=$preview."<br/>Seller Comment:  (". getRating($post->sellerRating).")";
//               				$preview=$preview." ".$post->sellerComment;
//               			}
//               			if($post->buyerRating<>null){
//               				$preview=$preview."<br/> Buyer [$soldToUserName] Comment: (". getRating($post->buyerRating).")";
//               				$preview=$preview." ".$post->buyerComment;
//               			}
              			
              		
//               		$ctrlName="AjaxLoad".$rowCount;
//               		$errorctrlName="ErrAjaxLoad".$rowCount;
//               		$ctrlValue="post".$rowCount;
//               		$postID2=$post->postID;
//               		$clickLink="clickLink".$rowCount;
// 				echo "</div>";
// 			    echo "<div class=\"col-sm-7 add-desc-box\">";
//                  // echo "<div class=\"add-details\">";
//                 echo "<div class=\"add-details\">";   
// 			    echo "<h5 class=\"add-title\"> <div class=\"add-title-girlstrade\"><a href=\"$viewBasePath\">$title $previewTitle</a></div><a href=\"$viewBasePath\">$preview </a></h5>";
//                    echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $post->createDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
//                 echo "</div>";
//                 echo "<div class=\"col-sm-3 text-right  price-box\">";
//                 echo "<h4 class=\"item-price\">$</h4><h1 class=\"item-price\">$post->itemPrice</h1>";
//                 echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
//                 /*echo "<a class=\"btn btn-primary btn-block btn-pink\" href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL&prevItem_Url=".urlencode(current_url())."><i class=\"fa fa-info-circle\"></i>  View Details</a>";
                
// 				if(isset($usr) && !empty($usr) && $usr["username"]!=null){
// 					 if($post->userID!=$usr["userID"]){
// 					 	 if($item["isPendingRequest"]==false && $item["isPostAlready"]==false)
// 					 	{
// 					 		echo "<a  href=";
// 					 		echo base_url().MY_PATH."messages/directSend/".$postID2."?prevURL=".urlencode(current_url()); //."&prevprevURL=".urlencode($previousCurrent_url);
//                 			echo " data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
// 					 	}else if($item["isPendingRequest"] == true){
// 					 		echo "<a  href=\"\" onclick=\"return false;\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink disabled\" > <i class=\" icon-pencil\"></i> Pending for Seller's Approval</a>";
// 					 	}
// 					 }
// 					}else{
// 						echo "<a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
// 					}*/
                
//                echo "</div></div>";
// 				}
               
// 				}
				$basePath=base_url();
				$encodeCurrentURL=urlencode(current_url());
				$title=$this->lang->line("lblTitle");
				if($itemList<>null)
				{
					$rowCount=0;
				
					foreach($itemList as $id=>$item)
					{
						$rowCount=$rowCount+1;
						$viewBasePath=$basePath.MY_PATH."viewItem/index/".$id."/".$catID."/".$locID."/".$keywords."?prevURL=".$encodeCurrentURL."&prevItem_Url=".urlencode(current_url());
						$locationName='';
						$categoryName='';
						$post=NULL;
						$soldToUserName="";
						$getDisableSavedAds=false;
						foreach($item as $key=>$child)
						{
							if($key=='post')
								$post=$child;
								else if($key=='location')
									$locationName=$child[0]->name;
									else if($key=='category')
										$categoryName=$child[0]->name;
										else if($key=='soldToUser'){
											if($child<> null && count($child)>0)
												$soldToUserName=$child[0]->username;
												else if($key=='savedAds')
													$getDisableSavedAds=$child;
										}
						}
						echo  "<div class=\"item-list\"> ";
						echo  "<div class=\"col-sm-2 no-padding photobox\">";
						foreach($item as $pic=>$picObj)
						{
							if($pic=='pic')
							{
								$picCount=count($picObj);
								if($picCount>0)
								{
									for($x=0;$x<1;$x++)
									{
										$thumbnail=$basePath.$picObj[$x]->thumbnailPath.'/'.$picObj[$x]->thumbnailName;
										echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";
									}
								}else {
									$thumbnail = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
									echo "<div class=\"add-image\"> <span class=\"photo-count\">
									<i class=\"fa fa-camera\"></i> 0 </span> <a href=\"$viewBasePath\">
									<img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";
								}
							}
						}
						 
				
						$enableMarkSoldBtn=false;
						$visibleBuyerComment=false;
						$soldToUserID=0;
						$soldToUserID=$post->soldToUserID;
						$enableMarkSoldBtn=$post->sellerRating==null;
						$visibleBuyerComment=$post->sellerRating<>null &&
						$post->buyerRating==null;
						$previewTitle=$post->itemName;
						$preview=trimLongText(trim($post->description));
						if($post->sellerRating<>null){
							$preview=$preview."<br/>Seller Comment:  (". getRating($post->sellerRating).")";
							$preview=$preview." ".$post->sellerComment;
						}
						if($post->buyerRating<>null){
							$preview=$preview."<br/> Buyer [$soldToUserName] Comment: (". getRating($post->buyerRating).")";
							$preview=$preview." ".$post->buyerComment;
						}
						 
				
						$ctrlName="AjaxLoad".$rowCount;
						$errorctrlName="ErrAjaxLoad".$rowCount;
						$ctrlValue="post".$rowCount;
						$postID2=$post->postID;
						$clickLink="clickLink".$rowCount;
						echo "</div>";
						echo "<div class=\"col-sm-7 add-desc-box\">";
						// echo "<div class=\"add-details\">";
						echo "<div class=\"ads-details\">";
						echo "<h5> <div class=\"add-title-girlstrade\"><a href=\"$viewBasePath\">$title $previewTitle</a></div><a href=\"$viewBasePath\">$preview </a></h5>";
						echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $post->createDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
						echo "</div>";
						echo "<div class=\"col-sm-3 text-right  price-box\">";
						echo "<h4 class=\"item-price\">$</h4><h1 class=\"item-price\">$post->itemPrice</h1>";
						echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
						/*echo "<a class=\"btn btn-primary btn-block btn-pink\" href=".$basePath."viewItem/index/$id?prevURL=$encodeCurrentURL&prevItem_Url=".urlencode(current_url())."><i class=\"fa fa-info-circle\"></i>  View Details</a>";
				
						if(isset($usr) && !empty($usr) && $usr["username"]!=null){
						if($post->userID!=$usr["userID"]){
						if($item["isPendingRequest"]==false && $item["isPostAlready"]==false)
						{
						echo "<a  href=";
						echo base_url().MY_PATH."messages/directSend/".$postID2."?prevURL=".urlencode(current_url()); //."&prevprevURL=".urlencode($previousCurrent_url);
						echo " data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
						}else if($item["isPendingRequest"] == true){
						echo "<a  href=\"\" onclick=\"return false;\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink disabled\" > <i class=\" icon-pencil\"></i> Pending for Seller's Approval</a>";
						}
						}
						}else{
						echo "<a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-primary btn-block btn-pink\" > <i class=\" icon-pencil\"></i> Contact Seller</a>";
						}
						/* if($getDisableSavedAds)
							echo "[<a style=\"pointer-events: none; cursor: default;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>] ";
							else
								echo "[<a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'>Save</a>] ";
								echo "[<a href=\"$viewBasePath\">View Details</a>]</div>";
								*/
							echo "</div></div>";
					}
					 
				}
              ?>  
              </div>
              
              </div>
            
         	  </div>
       		</div>
       		
       		
          <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$encodeCurrentURL=urlencode(current_url());
            	$url_path=base_url().MY_PATH.'viewProfile/viewByUserID/'.$userID;
            	
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
            			echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev/0/0/0/$sortByType/$sortByPrice/$sortByDate/$activeTab.'?prevURL='.$previousCurrent_url;\">Previous</a></li>";
            		if($NoOfItemCount > 0)
            			echo "<li  class=\"active\"><a href=\"$url_path/$pageNum/0/0/0/$sortByType/$sortByPrice/$sortByDate/$activeTab.'?prevURL='.$previousCurrent_url;\">$pageNum</a></li>";
            		if($NoOfItemCount > ($pageNum*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum2/$catID/$locID/$keywords/0/0/0/$sortByType/$sortByPrice/$sortByDate/$activeTab\">$pageNum2</a></li>";
            		if($NoOfItemCount > ($pageNum2*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum3/$catID/$locID/$keywords/0/0/0/$sortByType/$sortByPrice/$sortByDate/$activeTab\">$pageNum3</a></li>";
            		if($NoOfItemCount > ($pageNum3*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum4/$catID/$locID/$keywords/0/0/0/$sortByType/$sortByPrice/$sortByDate/$activeTab\">$pageNum4</a></li>";
            		if($NoOfItemCount > ($pageNum4*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum5/$catID/$locID/$keywords/0/0/0/$sortByType/$sortByPrice/$sortByDate/$activeTab\">$pageNum5</a></li>";
            		if($NoOfItemCount > ($pageNum5*$itemPerPage))
            			echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext/$catID/$locID/$keywords/0/0/0/$sortByType/$sortByPrice/$sortByDate/$activeTab\">Next</a></li>";
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
</div>


<div class="modal fade" id="loginPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title"><?php echo $this->lang->line("profileLoginPlease");?></h4>
      	</div>
      	<div class="modal-body">
      	   <h2 class="center-text"><?php echo $this->lang->line("profilePleaseLoginToProceed");?></h2>
      	   <br>
      	   <a class="btn btn-primary btn-40 center-obj" href="<?php echo base_url().MY_PATH."home/loginPage?prevURL=".urlencode(current_url());?>" ><i class="fa fa-sign-in"></i>&nbsp;&nbsp;&nbsp;&nbsp;Login</a></p>
                    	
      	</div>
    	
    </div>
 </div>
</div>
<div class="modal fade" id="contactAdvertiser1" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i> <?php echo $this->lang->line("profileContactAdvertiser");?> </h4>
      </div>
      <div class="modal-body">
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/insertBuyerMessage?prevURL=<?php echo urlencode(current_url());?>&prevprevURL=<?php echo urlencode($prevURL);?>">
         <!--   <div class="form-group">
            <label for="recipient-name" class="control-label">Name: <font color="red">*</font></label>
            <input class="form-control required" name="recipient-name" id="recipient-name" placeholder="Your name" data-placement="top" required="true" data-trigger="manual" data-content="Must be at least 3 characters long, and must only contain letters." type="text">
          </div>-->
<!--           <div class="form-group"> -->
<!--             <label for="sender-email" class="control-label">E-mail: <font color="red">*</font></label> -->
<!--             <input id="sender-email" name="sender-email" type="text" data-content="Must be a valid e-mail address (user@gmail.com)" required="true" data-trigger="manual" data-placement="top" placeholder="email@you.com" class="form-control email"> -->
<!--           </div> -->
<!--           <div class="form-group"> -->
<!--             <label for="recipient-Phone-Number"  class="control-label">Phone Number:</label> -->
<!--             <input type="text"  maxlength="60" class="form-control" name="recipient-Phone-Number" id="recipient-Phone-Number"> -->
<!--           </div> -->
			<div class="form-group">
           		<input type="hidden" id="userID" name="userID" value="<?php echo $userID;?>">   	
           	</div>
          <div class="form-group">
            <label for="message-text" class="control-label"><?php echo $this->lang->line("profileSendPostMessage");?> <font color="red">*</font><span class="text-count">(<?php echo DESCLENGTHINPROFILE;?>) </span>:</label>
            <textarea style="vertical-align: top; horizontal-align: left; resize:none;" class="form-control" required="true" id="message-text" name="message-text" rows="5" columns="30" maxlength="<?php echo DESCLENGTHINPROFILE;?>"   placeholder="<?php echo $this->lang->line("profileSendPostMessageInside");?>" data-placement="top" data-trigger="manual"></textarea>
          </div>
          <div class="form-group">
            <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line("profileSendPostMessageCancelBtn");?></button>
        <button type="submit" class="btn btn-success pull-right" onclick="setup(); return false;"><?php echo $this->lang->line("profileSendPostMessageSendBtn");?></button>
      	<button id="validate" hidden="true" type="submit"></button>
      </div>
    </div>
  </div>
</div>

  <script>
  
  $( document ).ready(function() {
	    var sortType=document.getElementById('selectSortType').value;
	    if(sortType=="3"){
	  	  document.getElementById('sortByDateDiv').style.display = 'none';
	  	   document.getElementById('sortByPriceDiv').style.display = 'none';
	  	   document.getElementById('filterByCategoryDiv').style.display = 'inline-block';
	  	  }
	  	  else if(sortType=="2"){
	  		  document.getElementById('sortByDateDiv').style.display = 'inline-block';
	  		   document.getElementById('sortByPriceDiv').style.display = 'none';
	  		   document.getElementById('filterByCategoryDiv').style.display = 'none';
	  		  }
	  	  else if(sortType=="1"){
	  		  document.getElementById('sortByDateDiv').style.display = 'none';
	  		   document.getElementById('sortByPriceDiv').style.display = 'inline-block';
	  		   document.getElementById('filterByCategoryDiv').style.display = 'none';
	  		  }else{
	  		  document.getElementById('sortByDateDiv').style.display = 'none';			  
	  		  document.getElementById('sortByPriceDiv').style.display = 'none';
	  	   document.getElementById('filterByCategoryDiv').style.display = 'none';
	  		  
	  	  }
	});
  $('#selectSortType').change(function() {
	  if($(this).val()=="3"){
	  document.getElementById('sortByDateDiv').style.display = 'none';
	   document.getElementById('sortByPriceDiv').style.display = 'none';
	   document.getElementById('filterByCategoryDiv').style.display = 'inline-block';
	  }
	  else if($(this).val()=="2"){
		  document.getElementById('sortByDateDiv').style.display = 'inline-block';
		   document.getElementById('sortByPriceDiv').style.display = 'none';
		   document.getElementById('filterByCategoryDiv').style.display = 'none';
		  }
	  else if($(this).val()=="1"){
		  document.getElementById('sortByDateDiv').style.display = 'none';
		   document.getElementById('sortByPriceDiv').style.display = 'inline-block';
		   document.getElementById('filterByCategoryDiv').style.display = 'none';
		  }else{
		  document.getElementById('sortByDateDiv').style.display = 'none';			  
		  document.getElementById('sortByPriceDiv').style.display = 'none';
	   document.getElementById('filterByCategoryDiv').style.display = 'none';
		  
	  }
});

  

  
  if(document.getElementById('userStar'))
  {
  	$('#userStar').raty({readOnly: true, score: <?php echo $sellerRating;?> });
  }


function beginSort(){
	var catID=document.getElementById("search-category").value;
	var sortByType=document.getElementById("selectSortType").value;
	var sortByPrice=document.getElementById("sortByPrice").value;
	var sortByDate=document.getElementById("sortByDate").value;
	 var activeTab=document.getElementById("paneActiveTab").value;
	var actionpath="<?php echo base_url().MY_PATH.'viewProfile/viewByUserID/'.$userID.'/'.$pageNum.'/';?>".concat(catID).concat("<?php echo '/0/0';?>").concat("/").concat(sortByType).concat("/").concat(sortByPrice).concat('/').concat(sortByDate).concat('/').concat(activeTab).concat("<?php echo '?prevURL='.$previousCurrent_url.'&prevViewFeedBack_Url='.urlencode(current_url());?>");
		document.getElementById("sortfrm").action=actionpath;
		document.getElementById("sortfrm").submit();
	
}
function setup()
{
        var myform = document.getElementById("item");
	  	document.getElementById("item").submit();
       	return true;
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

// $(function() {

//   $('#sortByPrice').on('change', function(){
// 	$('#sortMethod')
// 	.find('option')
// 	.remove()
// 	.end();  
	  
//     var selected = $(this).find("option:selected").val();
//     if (selected == 1){
// 		selectValues = { "1": "High to Low", "2": "Low to High" };
		
// 		$.each(selectValues, function(key, value) {   
// 			$('#sortMethod')
// 			  .append($("<option></option>")
// 			  .attr("value",key)
// 			  .text(value)); 
// 			}
// 		);
// 	}else if (selected == 2){
// 		selectValues = { "1": "Most Recent", "2": "Oldest" };
		
// 		$.each(selectValues, function(key, value) {   
// 			$('#sortMethod')
// 			  .append($("<option></option>")
// 			  .attr("value",key)
// 			  .text(value)); 
// 			}
// 		);
// 	}else{
// 		$('#sortMethod').html("<option value=''>AllCategories </option>");
// 		$('#sortMethod').append(
			"<?php 
// 					foreach ($AllCategory as $id=>$value)
// 					{
// 						if(!isset($lang_label))
// 								$lang_label="";
// 						$name=$value[0]->name;
// 						$postCount="(".$value[0]->postCount.")";
// 						if(SHOW_BRACKETS_INDEX_PAGE==0)
// 							$postCount="";
// 						if($lang_label<>"english")
// 							$name=$value[0]->nameCH;
// 						if($value[0]->level==1)
// 							echo "<option value='".$id."' style='background-color: #E1338B;' >".$name.$postCount."</option>";
// 						else 
// 						{
// 							$str="";
// 							if($catID==$id)
// 								$str=" selected='selected' ";
// 							echo "<option ".$str." value='".$id."' style='margin-left:10px;'> &nbsp;&nbsp;&nbsp;&nbsp;".$name.$postCount." </option>";
// 						}
// 					}
			?>"
// 		);
// 	}
//   });
  
// });
</script>

    <?php include "footer2.php"; ?>

