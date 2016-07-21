<?php $title = "Girls' Trading Platform";  include("header.php"); ?>

<!-- bxSlider CSS file -->
<link href="<?php echo base_url();?>assets/plugins/bxslider/jquery.bxslider.css" rel="stylesheet" />

<style>
.enlarged {
        width: 600px;
        height: 600px;
    }
</style>

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
.panel-heading {
    //cursor: pointer;
}

/* CSS Method for adding Font Awesome Chevron Icons */
 .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family:'FontAwesome';
    content:"\f146";
    float: right;
    color: inherit;
}
input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 10px;
}
.panel-heading.collapsed .accordion-toggle:after {
    /* symbol for "collapsed" panels */
    content:"\f0fe";
}
</style>
<script src="<?php echo base_url();?>assets/js/dist/clipboard.min.js"></script>
<script>
    paceOptions = {
      elements: true
    };
    new Clipboard('.js-textareacopybtn');
    
    // JavaScript
//     Array.prototype.forEach.call(document.querySelector("img"), function (elem) {
//         elem.addEventListener("click", function () {
//             elem.classList.toggle("enlarged");
//         });
//     });

//     $("#thumbnailImage").click(function() {
//     	   $(this).attr('width', '600');
//     	    $(this).attr('height', '600');
//     	});
</script>
<script src="<?php echo base_url();?>assets/js/pace.min.js"></script>
</head>
<body>


  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">  
      <ol class="breadcrumb pull-left">
        <li><a href=<?php echo base_url();?>><i class="icon-home fa"></i></a></li>
        <li><a href=<?php echo base_url().MY_PATH."getCategory/getAll/1";?>>All Ads</a></li>
        <li><a href=<?php echo base_url().MY_PATH."getCategory/getAll/1/$ParentCatID";?>><?php echo $ParentCatName;?></a></li>
        <li class="active"><a href=<?php echo base_url().MY_PATH."getCategory/getAll/1/$ChildCatID";?>><?php echo $ChildCatName;?></a></li>
      </ol>
      
	  <a class="pull-right back-btn margin-5" href=<?php $tempUrl=$prevUrl; if(strcmp($prevItem_Url, base_url())==0) echo $prevUrl; else echo $prevItem_Url;?>> 
	  <i class="fa fa-angle-double-left"></i> <?php echo $profileBackToResult;?></a>
     
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 page-content col-thin-right">
          <div class="inner inner-box ads-details-wrapper panel-bevel">
            <h2 class="itemName"> <?php echo $itemName;?> </h2>
			<h1 class="pricetag"> <?php echo "\$".$price." (".$currency.")";?></h1>
			
            <span class="info-row"> <span class="seller"><?php 
				$imgRatingPath=base_url()."images/".$userRating;
				echo "<img src=\"$imgRatingPath\" class=\"ratingIcon-xs\"><a href=".base_url().MY_PATH."viewProfile/index/".$postID.'/1?prevURL='.urlencode($previousCurrent_url).">$username</a>";
			?></span> - <span class="date"><i class=" icon-clock"> </i> <?php echo date('Y-m-d h:i A', strtotime($createDate));?> </span> - <span class="category"><?php echo $ParentCatName;?> </span>- <span class="item-location"><i class="fa fa-map-marker"></i> <?php echo $LocationName;?> </span> </span>
            <div class="ads-image">
              <ul class="bxslider">
                <?php 
                if($AdsProduct<>null)
                  {
                    foreach($AdsProduct as $id=>$item)
                  	{
                  		if(is_array($item))
                  		{
	                  		foreach($item as $picObj)
	                  		{
	                  		$imagePath='';
	                  		$imagePath=base_url().$picObj->picturePath.'/'.$picObj->pictureName;
	                  		$checkImage=$picObj->picturePath.'/'.$picObj->pictureName;
	                  		if(!is_file_exists($checkImage))
	                  			$imagePath = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
	                  			 
	                  		echo "<li><img src=$imagePath alt=\"img\"  /></li>";
	                  		}
                  		}
                  	}
                  }
                  
                
                ?>
              </ul>
              <div id="bx-pager"> 
              <?php 
              if($AdsProduct<>null)
                  {
                    foreach($AdsProduct as $id=>$item)
                  	{
                  		if(is_array($item))
                  		{
                  			$imgID=0;
	                  		foreach($item as $picObj)
	                  		{
	                  		$imagePath='';
	                  		$imagePath=base_url().$picObj->thumbnailPath.'/'.$picObj->thumbnailName;
		              		$checkImageThumb=$picObj->thumbnailPath.'/'.$picObj->thumbnailName;
		              		if(!is_file_exists($checkImageThumb))
	                  			$imagePath = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
	                  		echo "<a class=\"thumb-item-link\" data-slide-index=$imgID ><img src=$imagePath alt=\"img\" /></a>";
	                  		$imgID=$imgID+1;
	                  		}
                  		}
                  	}
                  }
              
              ?>
              
              </div>
            </div>
            <!--ads-image-->
            
            <div class="Ads-Details">
              <h5 class="list-title"><strong><?php echo $this->lang->line("lblDescription");?></strong></h5>
              <div class="row">
              <div class="col-sm-7 add-desc-box">
                <div class="ads-details">
                  <h5  class="add-title">
                  
                  <?php echo $itemDesc; ?> 
                  <br/> 
 <!--                  <h4><?php echo $ChildCatName;?></h4>-->
<!--                   <ul class="list-circle"> -->
<!--                     <li></li> -->
<!--                    </ul> -->
                </div>
                </div>
                <div class="col-md-4">
                  <aside class="panel panel-body panel-details panel-info">
                    <!-- <ul class="itemInfo">
                    <li>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("lbltag").": ";?></strong> <?php echo $tagDesc;?></p>
                      </li>
                    <li>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("lblType").": ";?></strong> TYPE</p>
                      </li>
                      <li>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("Price").": ";?></strong><?php echo "\$".$price." (".$currency.")";?> </p>
                      </li>
                      <li>
                        <p class="no-margin"><strong><?php echo $this->lang->line("lblLocation").": ";?></strong> <?php echo $LocationName;?> </p>
                      </li>
                      <li>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("lblCondition").": ";?></strong> New</p>
                      </li>
                    </ul> -->
                    <table class="itemInfo">
                    <?php if(strcmp(SHOWVISITCOUNTINITEMPAGE, "Y")==0){?>
                    <tr>
                        <td>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("lblView").": ";?></strong> 
                        </p>
                        </td><td><p class="itemInfoData">
                        <?php echo $visitCount;?>
                        
                        </p></td>
                      </tr>
                      <?php }?>
                    <tr>
                    	<td>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("lblType").": ";?></strong> 
                        </p></td>
                        <td><p class="itemInfoData"><?php echo $ChildCatName; ?></p></td>
                        
                      </tr>
                      <tr>
                      	<td>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("Price").": ";?></strong>
                        </p></td>
                        <td><p class="itemInfoData">
                        <?php echo "\$".$price." (".$currency.")";?> 
                        </p></td>
                      </tr>
                      <tr>
                      	<td>
                        <p class="no-margin"><strong><?php echo $this->lang->line("lblLocation").": ";?></strong> 
                        </p>
                        </td>
                        <td><p class="itemInfoData">
                        <?php echo $LocationName;?></p>
                        </td>
                      </tr>
                      <tr>
                      	<td>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("lblCondition").": ";?></strong> 
                        </p></td>
                        <td><p class="itemInfoData">
                        <?php echo $condition;?>
                        </p></td>
                      </tr>
                      <?php if(strcmp(SHOWQTY,'Y')==0) {?>
                      <tr>
                      	<td>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("lblRemainQty").": ";?></strong> 
                        </p></td>
                        <td><p class="itemInfoData">
                        <?php echo $remainQty;?>
                        </p></td>
                      </tr>
                      <?php }?>
                      <tr>
                      	<td>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("lblDatePosted").": ";?></strong> 
                        </p></td>
                        <td><p class="itemInfoData">
                        <?php echo $userCreateDate;?>
                        </p></td>
                      </tr>
                    </table>
                  </aside>
                  
                  
                  
                  
                  
                  <div class="ads-action">
                    <ul class="list-border">
                    <?php 
                    $ctrlName="AjaxLoad1";
              		$errorctrlName="ErrAjaxLoad1";
              		$ctrlValue="post1";
              		$postID2=$postID;
              		$clickLink="clickLink1";
              		$shareLink=base_url().MY_PATH."viewItem/index/".$postID;
                     echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
                	if($getDisableSavedAds)
                     echo "<li><a style=\"pointer-events: none;color:black; cursor: default;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'><i class=\" fa fa-heart\"></i> ".$this->lang->line("lblItemSaved")."</a> </li>";
                   else 
                   	echo "<li><a href=\"javascript:savedAds('$ctrlValue', '$ctrlName','$clickLink')\" id='$clickLink'><i class=\" fa fa-heart\"></i> ".$this->lang->line("lblItemSave")." </a> </li>";
                   	
                	echo "<li><a href=\"#shareAds\" data-toggle=\"modal\" shareLink='$shareLink'> <i class=\"fa fa-share-alt\"></i> ".$this->lang->line("lblShareItem")." </a></li>";
                      ?>
                      <?php if($isSameUser==true && $abuseList!=null && count($abuseList)>0){?>
                      <li><a href="#reportDeleteAbuseComplaint" data-toggle="modal"> <i class="fa icon-info-circled-alt"></i> <?php echo $this->lang->line("lblDeleteAbuse"); ?> </a> </li>
                    	
                      <?php }else if($isReportAbuseAlready){?>
                      <li><a href="" style="color: black;" onclick="return false;" data-toggle="modal"> <i class="fa icon-info-circled-alt"></i> <?php echo $this->lang->line("lblReportAbuseAlready"); ?> </a> </li>
                    	<?php }else {?>
                    	 <li><a href="#reportAdvertiser" data-toggle="modal"> <i class="fa icon-info-circled-alt"></i> <?php echo $this->lang->line("lblReportAbuse");?> </a> </li>
                    	<?php }?>
                    </ul>
                  </div>
                </div>
              </div>
              
            </div>
            
			<!--<div class="content-footer" > 
				<?php 
				
				if(!$isloginedIn and $isSameUser==false){
					$imgRatingPath=base_url()."images/".$userRating;
					
						echo "<a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-default  directSendButton\"> <i class=\" icon-pencil\"></i> ".$this->lang->line("lblContactSeller")."</a>";
					
				}
				
				if(($isloginedIn) && $isPendingRequest==false && ($isPostAlready==false or $isSameUser==false))
                  {
	                  if($isPostAlready == false and $isSameUser ==false ){
	                  	$imgRatingPath=base_url()."images/".$userRating;
	                  	
		                  echo "<a href=";
		                  echo base_url().MY_PATH."messages/directSend/".$postID."?prevURL=".urlencode(current_url())."&prevprevURL=".urlencode($previousCurrent_url);
		                  echo " data-toggle=\"modal\" class=\"btn btn-default directSendButton\">";
		                  echo "<i class=\"icon-right-hand\"></i>".$this->lang->line("lblContactSeller")."</a>";
	                  }
                  }
                  ?>  
                  <?php if(($isloginedIn) &&($isPendingRequest==true && $isSameUser==false) )
                  {
	                  echo "<a href=\"\" data-toggle=\"modal\" class=\"btn   btn-default  directSendButton disabled\">";
	                  echo "<i class=\" icon-info\"></i>".$this->lang->line("lblPendingForSellerApproval")."</a>";
                  }
                  ?>
                  <?php
                  if(($isloginedIn) &&($isPostAlready==true && $isSameUser==false))
                  {
	                  echo "<a href=\"#sellerInfo\" data-toggle=\"modal\" data-phone=\"$sellerphone\" data-email=\"$selleremail\" class=\"btn   btn-default directSendButton\">";
	                  echo "<i class=\" icon-info\"></i>".$this->lang->line("lblViewSellerInfo")."</a>";
                  }
                  ?>
                  
                 <?php
					//if(($isloginedIn) && ($isSameUser==true) && ($hasRequestContact==true))
					//{
						if($isSameUser==true && $hasRequestContact==true) 
							echo "<a  href=\"#sellerApprovePopup\" data-toggle=\"modal\"  data-id=\"$postID\"  data-pagenum=\"$pageNum\" class=\"btn btn-default  directSendButton\"> <i class=\"fa fa-check\"></i> ".$this->lang->line("lblItemApproveRequest")." </a>";
						else if($isSameUser==true)
							echo "<a href=\"\" style=\"color: black;\" data-toggle=\"modal\" onclick=\"return false;\"  class=\"btn btn-default  directSendButton\"> <i class=\"fa fa-check\"></i>".$this->lang->line("lblItemNoApproveRequest")." </a>";
							
					//}
					?>
					<?php
					if(($isloginedIn) && ($isSameUser==false))
					{
// 						echo "<a href=\"#contactAdvertiser\" email=\"$email\"
// 						firstName=\"$firstName\" lastName=\"$lastName\"
// 						telNo=\"$telNo\" phoneNo=\"$phoneNo\"
// 						data-toggle=\"modal\" class=\"btn   btn-default inboxMsgButton\">
// 						<i class=\" icon-mail-2\"></i> Send a message";
// 						if($DailyMaxTimes>0) 
// 							echo "(".$DailyMaxTimes.")";
// 						echo "</a>";
												
					}
					?>	
					<?php
					//if(($isloginedIn) && ($isSameUser==false) && ( $isBuyerApproveThisPost==true))
					//{
					if($isloginedIn && $isSameUser==false && ( $isBuyerApproveThisPost==true) && $isBuyerFeedBackAlready==false)
						echo "<a  href=\"#buyerFeedBackPopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-userid=\"$userID\" class=\"btn btn-success\"> <i class=\" icon-pencil\"></i> ".$this->lang->line("lblItemFeedback")."</a>";
					//}
					?>
					<?php
					$soldUsersstr="  <select required=\"true\" class=\"form-control    \" name=\"soldUser\" id=\"soldUser\">  ";
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
					
					if($isSameUser==true && $soldUsers!=null && count($soldUsers)>0 && $isSellerFeedBackAlready==false)
						echo "<a  href=\"#sellerFeedBackPopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-soldusers=\"$soldUsersstr\" class=\"btn btn-success\"> <i class=\" icon-pencil\"></i> ".$this->lang->line("lblItemFeedback")."</a>";
					if(($isloginedIn) &&($isSameUser==true))
					{
						echo "<a href=\"#deleteAdsPopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-userID=\"$userID\" class=\"btn btn-danger\"> <i class=\" fa fa-trash\"></i> ".$this->lang->line('CloseAds')." </a>";
					}
						
					if(($isloginedIn) && ($isSameUser==true) && ( $hasBuyerList==true))
					{
// 						$ctrlName1="AjaxLoad_1";
// 						$errorctrlName1="ErrAjaxLoad_1";
// 						$postValueID="postValueCtrl_1";
// 						echo "<input id='$postValueID' name='$postValueID' type='hidden' value='$postID'>";
// 						echo "<a  href=\"javascript:marksold('$postID', '$ctrlName1', '$errorctrlName1')\" class=\"btn btn-inverse \"> <i class=\"fa fa-thumb-tack\"></i> Mark Sold </a>";
// 						echo " <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
						
// 						$soldUsersstr="  <select required=\"true\" class=\"form-control    \" name=\"soldUser\" id=\"soldUser\">  ";
// 						if($soldUsers!=null){
// 							$NoOfSoldUsers=count($soldUsers);
// 							foreach($soldUsers as $row){
// 								$soldUserID=$row->soldUserID;;
// 								$soldUsername=$row->soldUsername;
// 								$soldUsersstr=$soldUsersstr."  <option  value='".$soldUserID."'  style='background-color:#E9E9E9;font-weight:bold;' > ".$soldUsername." </option>  ";
// 							}
// 						}
// 						$soldUsersstr=$soldUsersstr."  </select>  ";
// 						$soldUsersstr=base64_encode($soldUsersstr);
						
						
// 						echo "<a  href=\"#sellerActionPopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-soldusers=\"$soldUsersstr\" class=\"btn btn-default  directSendButton\"> <i class=\" icon-pencil\"></i> Mark Sold </a>";
						
					}
					?>
					
					 
					</div>
                        <!-- </div> -->
			 <!-- 	<div class="blog-post-footer">
 			</div>


                             <div style="clear: both"></div>
							
                            <div class="inner "> 
 								<div class="clearfix"> 
                                <div class="col-md-12  blog-post-bottom">
                                </div> 
                             </div> -->



                            <div class="blogs-comments-area"></div>
                                <h5 class="list-title">
                                <strong><?php count($commentList);?> 
                               <?php echo $this->lang->line("lblComments");?></strong></h5>
                               
                               
                               

                                 <div class="blogs-comment-respond" id="respond"> 
                                    <ul class="blogs-comment-list">
										<?php 
										if($commentList!=null && count($commentList)>0){
										
										foreach ($commentList as $id=>$value)
										{
											//var_dump($value);
											$userPhotoPath=$value['userPhotoPath'];
											$username1=$value['username'];
											$strElapsedTime=$value['strElapsedTime'];
											$comments=$value['comments'];
											$id=$value["commentID"];
											$userProfilePath=base_url().MY_PATH."viewProfile/viewByUserID/".$value['usercommentID'].'/1?prevURL='.urlencode($previousCurrent_url).'&prevProfile_Url='.urlencode(current_url()); 
											echo "<li>";
											echo "<div class=\"blogs-comment-wrapper\">";
											echo "<div class=\"blogs-comment-avatar\">";
											echo "<figure>";
											echo "<a href=\"$userProfilePath\"><img alt=\"avatar\" src=$userPhotoPath></a>";
											echo "</figure>";
											echo "</div>";
											echo "<div class=\"blogs-comment-details\">";
											echo "<div class=\"blogs-comment-name\">";
											echo "<a href=\"$userProfilePath\">$username1 </a> ";
											echo  "<span class=\"blogs-comment-date\">$strElapsedTime</span>";
											echo "</div>";
											echo "<div class=\"blogs-comment-description\">";
											echo "<p>$comments</p>";
											echo "</div>";
											if($isloginedIn)
											echo "<div class=\"blogs-comment-reply\"><a data-toggle=\"modal\" href=\"#replyComment\"  data-id=\"$id\">Reply</a></div>";
											
											
											if($value["childCommentList"]!=null && count($value["childCommentList"])){
												echo "<ul>";
												foreach ($value["childCommentList"] as $id1=>$value1)
												{
													//var_dump($value);
													$userPhotoPath1=$value1['userPhotoPath'];
													$username2=$value1['username'];
													$strElapsedTime1=$value1['strElapsedTime'];
													$comments1=$value1['comments'];
													$userProfilePath1=base_url().MY_PATH."viewProfile/viewByUserID/".$value1['usercommentID'].'/1?prevURL='.urlencode($previousCurrent_url).'&prevProfile_Url='.urlencode(current_url());
														
													//$id1=$value1["commentID"];
													echo "<li>";
													echo "<div class=\"blogs-comment-wrapper\">";
													echo "<div class=\"blogs-comment-avatar\">";
													echo "<figure>";
													echo "<a href=\"$userProfilePath1\"><img alt=\"avatar\" src=$userPhotoPath1></a>";
													echo "</figure>";
													echo "</div>";
													echo "<div class=\"blogs-comment-details\">";
													echo "<div class=\"blogs-comment-name\">";
													echo "<a href=\"$userProfilePath1\">$username2 </a> ";
													echo  "<span class=\"blogs-comment-date\">$strElapsedTime1</span>";
													echo "</div>";
													echo "<div class=\"blogs-comment-description\">";
													echo "<p>$comments1</p>";
													echo "</div>";
// 													echo "<div class=\"blogs-comment-reply\"><a data-toggle=\"modal\" href=\"#replyComment\"  data-id=\"$id1\">Reply</a></div>";
														
													echo "</div></div>";
													echo "</li>";
											}
											echo "</ul>";
											
											}
											echo "</div></div>";
											echo "</li>";
										}
										}
										?>
                                       
                                    </ul>   <!--Comment list End-->
                                    <?php if($isloginedIn) {?>
             
                                    <!--<h5 class="list-title"><strong><?php echo $this->lang->line("lblItemLeaveComment"); ?></strong></h5>-->
                                    
									   <form class="blogs-comment-form" id="blogs-commentform" method="post" action="<?php echo base_url().MY_PATH; ?>itemComments/insertItemComment?prevURL=<?php echo current_url();?>">         
<!--                                         <div class="row form-group"><div class="col-md-6"><input class="form-control" type="text" placeholder="Enter your name" aria-required="true" value="" name="author"></div><div class="col-md-6 text-left"><span>Name*</span></div></div> -->
<!--                                         <div class="row form-group" ><div class="col-md-6"><input class="form-control" type="text" placeholder="Enter your email" aria-required="true" value="" name="email"></div><div class="col-md-6 text-left"><span>E-mail*</span></div></div> -->
										<input type="hidden" name="postID"  value="<?php echo $postID;?>" >
<!--                                     	<div class="row form-group"><div class="col-md-6"><input class="form-control" type="text" value="" placeholder="Enter your website" name="url"></div><div class="col-md-6 text-left"><span>Website*</span></div></div> -->

                                        <div class="form-group" id="blogscommentDiv">
                                            <textarea style="vertical-align: top; horizontal-align: left; resize:none;font-size: 15px;" class="form-control" maxlength="300"  rows="5" columns="30"  placeholder="<?php echo $YouHaveRemainItemPostTimes;?>" name="blogscomment" id="blogscomment"></textarea> 
											  	<!--<div id="blogscommentAjaxLoad" class="center"></div>
	                        					<div id="blogscommentError" hidden="true"></div>-->
                         				</div>
                                        <button type="submit" class="btn-success btn btn-lg"> <?php echo $this->lang->line("btnSubmitComment");?> </button>
										<br>
										</form>
										<?php }?>
										<br>
                                </div><!-- #respond -->


                           
					
            
          </div>
          <!--/.ads-details-wrapper--> 
          
        </div>
        <!--/.page-content-->
        
        <div class="col-sm-3  page-sidebar-right">
          <aside>
              <div class="panel sidebar-panel panel-contact-seller panel-bevel seller-info-border">
              <div class="panel-heading seller-heading pink-bg"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;<?php echo $username ?></div>
         
              <div class="panel-content user-info">
                <div class="panel-body text-center">
                  <div class="seller-info">
                    <h3 class="no-margin">
              			<div class="user-ads-action"> 
              			<a href="<?php echo base_url().MY_PATH;?>viewProfile/index/<?php echo $postID.'/1?prevURL='.urlencode($previousCurrent_url).'&prevProfile_Url='.urlencode(current_url());?>" 
              			class="btn   btn-default btn-block viewButton">
              			<i class="icon-user-3"></i>
              			<?php echo $this->lang->line("lblViewUserInfo");?>
						</a> </div>
              		</h3>
                    <!-- <p> Joined: <strong><?php //echo $userCreateDate;?></strong></p> -->
                  </div>
                  
                  <?php
                  if(!$isloginedIn and $isSameUser==false){
                  	$imgRatingPath=base_url()."images/".$userRating;
                  		
                  	echo "<div class=\"user-ads-action\"><a  href=\"#loginPopup\" data-toggle=\"modal\"  class=\"btn btn-default btn-block  directSendButton\"> <i class=\" icon-pencil\"></i> ".$this->lang->line("lblContactSeller")."</a></div>";
                  		
                  }
                  
                  if(($isloginedIn) && $isPendingRequest==false && ($isPostAlready==false  or $isSameUser==false))
                  {
	                  if($isPostAlready == false and $isSameUser ==false ){
	                  	$imgRatingPath=base_url()."images/".$userRating;
	                  	
		                  echo"<div class=\"user-ads-action\">";
		                  echo "<a href=\"#directSend\"";
		                  //echo base_url().MY_PATH."messages/directSend/".$postID."?prevURL=".urlencode(current_url())."&prevprevURL=".urlencode($previousCurrent_url);
		                  echo " data-toggle=\"modal\" id=\"directSendButton\" class=\"btn btn-default btn-block directSendButton\">";
		                  echo "<i class=\"icon-right-hand\"></i>".$this->lang->line("lblContactSeller")."</a></div>";
	                  }
                  }
                  ?>  
                  <?php
                  if(($isloginedIn) &&($isPostAlready==true && $isSameUser==false))
                  {
	                  echo "<div class=\"user-ads-action\">"; 
	                  echo "<a href=\"#sellerInfo\" data-toggle=\"modal\" data-phone=\"$sellerphone\" data-email=\"$selleremail\" class=\"btn   btn-default btn-block directSendButton\">";
	                  echo "<i class=\" icon-info\"></i>".$this->lang->line("lblViewSellerInfo")."</a> </div>";
                  }
                  ?>
                  <?php if(($isloginedIn) &&($isPendingRequest==true && $isSameUser==false) )
                  {
	                  echo "<div class=\"user-ads-action\">"; 
	                  echo "<a href=\"\" data-toggle=\"modal\" class=\"btn   btn-default btn-block directSendButton disabled\">";
	                  echo "<i class=\" icon-info\"></i>".$this->lang->line("lblPendingForSellerApproval")."</a> </div>";
                  }
                  ?>
                  <?php
					//if(($isloginedIn) && ($isSameUser==true) && ($hasRequestContact==true))
					//{
					if($isSameUser==true && $hasRequestContact==true)
						echo "<div class=\"user-ads-action\"><a  href=\"#sellerApprovePopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-pagenum=\"$pageNum\"  class=\"btn btn-default btn-block directSendButton\"> <i class=\"fa fa-check\"></i>".$this->lang->line("lblItemApproveRequest")."</a></div>";
					else if($isSameUser==true)
							echo "<div class=\"user-ads-action\"><a  href=\"\" style=\"color: black;\" data-toggle=\"modal\"   class=\"btn btn-default btn-block directSendButton\"> <i class=\"fa fa-check\"></i>".$this->lang->line("lblItemNoApproveRequest")." </a></div>";
						
					//}
					?>
                  
                   <?php
					if(($isloginedIn) && ($isSameUser==false))
					{
// 						echo "<div class=\"user-ads-action\">";
// 						echo "<a href=\"#contactAdvertiser\" email=\"$email\"
// 						firstName=\"$firstName\" lastName=\"$lastName\"
// 						telNo=\"$telNo\" phoneNo=\"$phoneNo\"
// 						data-toggle=\"modal\" class=\"btn btn-default btn-block inboxMsgButton\">
// 						<i class=\" icon-mail-2\"></i> Send a message";
// 						if($DailyMaxTimes>0) 
// 							echo "(".$DailyMaxTimes.")";
// 						echo "</a></div>";
												
					}
					?>	 
					<?php
					//if(($isloginedIn) && ($isSameUser==false) && ( $isBuyerApproveThisPost==true))
					//{
						if($isloginedIn && $isSameUser==false && ( $isBuyerApproveThisPost==true) && $isBuyerFeedBackAlready==false)
							echo "<br/><a  href=\"#buyerFeedBackPopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-userid=\"$userID\" class=\"btn btn-success btn-block\"> <i class=\" icon-pencil\"></i> ".$this->lang->line("lblItemFeedback")."</a>";
					//}
					?>
					<?php
					$soldUsersstr="  <select required=\"true\" class=\"form-control    \" name=\"soldUser\" id=\"soldUser\">  ";
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
					
					if($isSameUser==true && $soldUsers!=null && count($soldUsers)>0 && $isSellerFeedBackAlready==false)
						echo "<div class=\"user-ads-action\"><a  href=\"#sellerFeedBackPopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-soldusers=\"$soldUsersstr\" class=\"btn btn-success btn-block\"> <i class=\" icon-pencil\"></i> ".$this->lang->line("lblItemFeedback")." </a></div>";
					if(($isloginedIn) &&($isSameUser==true))
					{
						echo "<div class=\"user-ads-action\"><a  href=\"#deleteAdsPopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-userID=\"$userID\" class=\"btn btn-danger btn-block\"> <i class=\" fa fa-trash\"></i> ".$this->lang->line('CloseAds')." </a></div>";
					}
					if(($isloginedIn) && ($isSameUser==true) && ( $hasBuyerList==true))
					{
// 						$ctrlName2="AjaxLoad_2";
// 						$errorctrlName2="ErrAjaxLoad_2";
// 						$postValueID="postValueCtrl_2";
// 						echo "<input id='$postValueID' name='$postValueID' type='hidden' value='$postID'>";
// 						echo "<br/><a  href=\"javascript:marksold('$postValueID', '$ctrlName2', '$errorctrlName2')\" class=\"btn btn-inverse btn-block\"> <i class=\"fa fa-thumb-tack\"></i> Mark Sold </a>";
// 						echo " <div id='$ctrlName2' name='$ctrlName2' class='center'></div><div id='$errorctrlName2' name='$errorctrlName2' class='center'></div>";
						
						//echo "<div class=\"user-ads-action\"><a  href=\"#sellerActionPopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-soldusers=\"$soldUsersstr\" class=\"btn btn-default btn-block directSendButton\"> <i class=\" icon-pencil\"></i> Mark Sold </a></div>";
						
					}
					?>
					<?php
                  	 
                  	
	                //  echo "<div class=\"user-ads-action\">";
	                //  echo "<a href=\"".base_url().MY_PATH."newPost/showEditPost/".$postID."?prevURL=".urlencode($previousCurrent_url);
	                //  echo " data-toggle=\"modal\" class=\"btn btn-default btn-block directSendButton\">";
	                //  echo "<i class=\" icon-pencil\"></i> Edit Item </a> </div>";
                  
                  ?>
                </div>
              </div>
            </div>
            <div class="panel sidebar-panel panel-bevel seller-info-border">
              <div class="panel-heading  seller-heading pink-bg"><i class="fa fa-shield"></i>&nbsp;&nbsp;&nbsp;
              <?php echo $this->lang->line("lblSafety");?></div>
             <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li><?php echo $this->lang->line("lblSafety1");?> </li>
                    <li><?php echo $this->lang->line("lblSafety2");?></li>
                    <li><?php echo $this->lang->line("lblSafety3");?></li>
                  </ul>
                </div>
              </div>
            </div>
            <!--/.categories-list--> 
          </aside>
        </div>
        <!--/.page-side-bar--> 
      </div>
    </div>
 
  <!-- /.main-container -->
  
  <?php include "footer1.php"; ?>
  <!-- /.footer -->
<!-- /.wrapper --> 
<div class="modal fade" id="sellerApprovePopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
    <?php 
      	$usr = $this->nativesession->get('user');
      	if(!isset($usr) or empty($usr)){
      	?>
      	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("lblClose");?></span></button>
	        <h4 class="modal-title"><?php echo $this->lang->line("lblPleaseLogin");?></h4>
      	</div>
      	<div class="modal-body">
      	   <h2><?php echo $this->lang->line("lblLoginToContinue");?></h2>
      	   <br>
      	   <a class="btn btn-primary btn-xs" href="<?php echo base_url().MY_PATH."home/loginPage?prevURL=".urlencode(current_url());?>" ><i class="fa fa-reply"></i><?php echo $this->lang->line("lblLogin");?></a></p>";
                    	
      	</div>
        <?php } else {?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("lblClose");?></span></button>
        <h4 class="modal-title"><?php echo $this->lang->line("lblItemApproveRejectRequestContact");?></h4>
      </div>
      <div class="modal-body">
      	
      	<div id="tableBodyError">
      	
      	
      	</div>
      	<div id="tableBodyList">
      		<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line("From");?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Ads_Detail");?></th>
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
                  		$previewTitle=$row['previewTitle'];
                  		$previewDesc=$row["previewDesc"];
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		$messageID=$id;
                  		$userID=$row['userID'];
                  		$NoOfDaysPending=$row['NoOfDaysPending'];
						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
                		echo "<tr>";
                    	echo "<td style=\"width:20%\" class=\"add-image\">$from";
                    	//echo "<br/><a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                    	echo "<br/>".$this->lang->line("DaysExpiry")." :".$NoOfDaysb4ExpiryContact;
                    	$approvePath=base_url().MY_PATH."messages\approveSavedAds\$messageID\$userID";
                    	$rejectPath=base_url().MY_PATH."messages\rejectSavedAds\$messageID\$userID";
                    	$rowCount=$rowCount+1;
                    	$ctrlName1="AjaxLoad1_".$rowCount;
                    	$errorctrlName1="ErrAjaxLoad1_".$rowCount;
                    	$ctrlValue1="messageID".$rowCount;
                    	$ctrlValue2="userID".$rowCount;
                    	$ctrlName2="AjaxLoad2_".$rowCount;
                    	$errorctrlName2="ErrAjaxLoad2_".$rowCount;
                    	$clickLink="clickLink".$rowCount;
                    	$clickLink2="clickLink2_".$rowCount;
                    	echo "<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$messageID' />";
                    	echo "<input name='$ctrlValue2' id='$ctrlValue2' type='hidden' value='$userID' />";
                    	echo "<p> <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
                    	echo "<a class=\"btn btn-success btn-xs\" href=\"javascript:approve('$ctrlValue1','$ctrlValue2', '$ctrlName1', '$errorctrlName1')\" id='$clickLink'> <i class=\"fa fa-check\"></i> ".$this->lang->line('Approve')." </a></p>";
                    	echo "<p><div id='$ctrlName2' name='$ctrlName2' class='center'></div><div id='$errorctrlName2' name='$errorctrlName2' class='center'></div>";
                    	echo "<a class=\"btn btn-danger btn-xs\" href=\"javascript:reject('$ctrlValue1','$ctrlValue2', '$ctrlName2', '$errorctrlName2')\" id='$clickLink2'><i class=\"fa fa-times\"></i>  ".$this->lang->line('Reject')."</a></p>";
                    	//echo "</div>";
                    	
                    	echo "</td>";
                      	echo "<td style=\"width:55%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                      echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
                          echo "<br/>Posted On: ". date('Y-m-d h:i A', strtotime($createDate))."</h5>";
                    		echo "</div></td>";
                      		
                      	
                  		echo "</tr>";
                  		
                  	}
            	}
            ?>
          <!--    <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
//             	$pageNumPrev=$pageNum-1;
//             	$pageNum2=$pageNum+1;
//             	$pageNum3=$pageNum+2;
//             	$pageNum4=$pageNum+3;
//             	$pageNum5=$pageNum+4;
//             	$pageNumNext=$pageNum+5;
//             	echo "<input type=\"hidden\" id=\"ctrlpostID\" name=\"ctrlpostID\" value=\"$postID\"/>";
//             	echo "<input type=\"hidden\" id=\"ctrlpageNumPrev\" name=\"ctrlpageNumPrev\" value=\"$pageNumPrev\"/>";
//             	echo "<input type=\"hidden\" id=\"ctrlpageNum\" name=\"ctrlpageNum\" value=\"$pageNum\"/>";
//             	echo "<input type=\"hidden\" id=\"ctrlpageNum2\" name=\"ctrlpageNum2\" value=\"$pageNum2\"/>";
//             	echo "<input type=\"hidden\" id=\"ctrlpageNum3\" name=\"ctrlpageNum3\" value=\"$pageNum3\"/>";
//             	echo "<input type=\"hidden\" id=\"ctrlpageNum4\" name=\"ctrlpageNum4\" value=\"$pageNum4\"/>";
//             	echo "<input type=\"hidden\" id=\"ctrlpageNum5\" name=\"ctrlpageNum5\" value=\"$pageNum5\"/>";
//             	echo "<input type=\"hidden\" id=\"ctrlpageNumNext\" name=\"ctrlpageNumNext\" value=\"$pageNumNext\"/>";
            	 
            	
//             	if($pageNum<>1)
//             		echo "<li><a class=\"pagination-btn\" href=\"#sellerApprovePopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-pagenum=\"$pageNumPrev\">Previous</a></li>";
//             	echo "<li  class=\"active\"><a id=\"hrefPageNum\" href=\"#\" onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum</a></li>";
//             	echo "<li><a id=\"hrefPageNum2\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum2\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum2</a></li>";
//             	echo "<li><a id=\"hrefPageNum3\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum3\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum3</a></li>";
//             	echo "<li><a id=\"hrefPageNum4\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum4\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum4</a></li>";
//             	echo "<li><a id=\"hrefPageNum5\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum5\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum5</a></li>";
//             	echo "<li><a id=\"hrefPageNumNext\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNumNext\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNumNext</a></li>";
            	 
            	
            ?>
                </ul>
          </div> -->
            	 </tbody>
              </table>
      	
      	</div>
      	
        
      </div>
      <?php }?>
    </div>
  </div>
</div>


<div class="modal fade" id="loginPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("lblClose");?></span></button>
	        <h4 class="modal-title"><?php echo $this->lang->line("lblPleaseLogin");?></h4>
      	</div>
      	<div class="modal-body">
      	   <h2 class="center-text"><?php echo $this->lang->line("lblLoginToContinue");?></h2>
      	   <br>
      	   <a class="btn btn-primary btn-40 center-obj" href="<?php echo base_url().MY_PATH."home/loginPage?prevURL=".urlencode(current_url());?>" ><i class="fa fa-sign-in"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line("lblLogin");?></a></p>
                    	
      	</div>
    	
    </div>
 </div>
</div>
<div class="modal fade" id="buyerFeedBackPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
    <?php 
      	$usr = $this->nativesession->get('user');
      	if(!isset($usr) or empty($usr)){
      	?>
      	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("lblClose");?></span></button>
	        <h4 class="modal-title"><?php echo $this->lang->line("lblPleaseLogin");?></h4>
      	</div>
      	<div class="modal-body">
      	   <h2 class="center-text"><?php echo $this->lang->line("lblLoginToContinue");?></h2>
      	   <br>
      	   <a class="btn btn-primary btn-40 center-obj" href="<?php echo base_url().MY_PATH."home/loginPage?prevURL=".urlencode(current_url());?>" ><i class="fa fa-sign-in"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line("lblLogin");?></a></p>
                    	
      	</div>
      	<?php } else if(!$isBuyerApproveThisPost) {?>
        <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title">Please login</h4>
      	</div>
      	<div class="modal-body">
      	   <h2>To post feedback, you need to contact seller first.</h2>
      	   <br>
      	   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 	
      	</div>
        
        <?php }else {?>
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line("popupTitleMarkSold");?></h4>
      </div>
      <div class="modal-body">
      
        <form role="form" id="itemBuyerFeedBack" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/buyerFeedBack?prevURL=<?php echo urlencode(current_url());?>&prevprevURL=<?php echo urlencode($previousCurrent_url);?>">
           <div class="form-group">
           		<input type="hidden" id="postID_1" name="postID_1" >   	
           		<input type="hidden" id="userID_1" name="userID_1" >   	
           	</div>
          
             <div class="form-group">
             	<label  for="rating" class="control-label">Rating<font color="red">*</font></label>
         		 <select required="true" class="form-control    " name="rating" id="rating">
        			<?php 
        			foreach(getRatingArray() as $rateID=>$rateName){
         		 		echo "<option value='$rateID'  style='background-color:#E9E9E9;font-weight:bold;' > $rateName</option>";
         		 	}
         		 	?>
         		 </select>
        		<div id="ratingError" name="ratingError" ></div>
        	</div>
        	 <div class="form-group">
            <label for="message-text" class="control-label">Message <span class="text-count">(<?php echo DESCLENGTHINMYADS;?>) </span>:</label>
            <textarea style="vertical-align: top; horizontal-align: left; resize:none;" class="form-control"  id="message-text"  maxlength="<?php echo DESCLENGTHINMYADS;?>"  rows="5" columns="30"  name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
          </div>
         	
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success pull-right"   onclick="setupBuyerFeedBack(); return false;">
		<?php echo $this->lang->line("btnSubmitComment");?>
		</button>
        	<button id="validate" hidden="true" type="submit"></button>
  
     	 </div>
     	 <?php }?>
    </div>
  </div>
</div>
<div class="modal fade" id="sellerFeedBackPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
    <?php 
      	$usr = $this->nativesession->get('user');
      	if(!isset($usr) or empty($usr)){
      	?>
      	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("lblClose");?></span></button>
	        <h4 class="modal-title"><?php echo $this->lang->line("lblPleaseLogin");?></h4>
      	</div>
      	<div class="modal-body">
      	   <h2 class="center-text"><?php echo $this->lang->line("lblLoginToContinue");?></h2>
      	   <br>
      	   <a class="btn btn-primary btn-40 center-obj" href="<?php echo base_url().MY_PATH."home/loginPage?prevURL=".urlencode(current_url());?>" ><i class="fa fa-sign-in"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line("lblLogin");?></a></p>
                    	
      	</div>
        <?php } else {?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line("popupTitleMarkSold");?></h4>
      </div>
      <div class="modal-body">
        <form role="form" id="itemSellerFeedBack" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/sellerFeedBack?prevURL=<?php echo urlencode(current_url());?>&prevprevURL=<?php echo urlencode($previousCurrent_url);?>">
           <div class="form-group">
           		<input type="hidden" id="postID_2" name="postID_2" >   	
           	</div>
          <div class="form-group">
         	<label for="soldUser" class="control-label">Sold To<font color="red">*</font></label>
         	<div   id="divSoldUser_2"  class="center">
         	
         	</div>
         	<div id="soldUserError" name="soldUserError"></div>
           </div>
             <div class="form-group">
             	<label  for="rating" class="control-label">Rating<font color="red">*</font></label>
         		 <select required="true" class="form-control    " name="rating" id="rating">
        		<?php 
        			foreach(getRatingArray() as $rateID=>$rateName){
         		 		echo "<option value='$rateID'  style='background-color:#E9E9E9;font-weight:bold;' > $rateName</option>";
         		 	}
         		 	?>
         		 	</select>
        		<div id="ratingError" name="ratingError" ></div>
        	</div>
        	
        	
        	 <div class="form-group">
            <label for="message-text" class="control-label">Message <span class="text-count">(<?php echo DESCLENGTHINMYADS;?>) </span>:</label>
            <textarea style="vertical-align: top; horizontal-align: left; resize:none;" class="form-control"  id="message-text"  maxlength="<?php echo DESCLENGTHINMYADS;?>"  rows="5" columns="30"  name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
          </div>
         	
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success pull-right"   onclick="setupSellerFeedBack(); return false;">Submit</button>
        	<button id="validate" hidden="true" type="submit"></button>
  
     	 </div>
     	 <?php }?>
    </div>
  </div>
</div>

<div class="modal fade" id="sellerActionPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line("popupTitleMarkSold");?></h4>
      </div>
      <div class="modal-body">
        <form role="form" id="itemMarkSold" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/markSoldAds?prevURL=<?php echo urlencode(current_url());?>&prevprevURL=<?php echo urlencode($previousCurrent_url);?>">
           <div class="form-group">
           		<input type="hidden" id="postID_3" name="postID_3" >   	
           	</div>
          <div class="form-group">
         	<label for="soldUser" class="control-label">Sold To<font color="red">*</font></label>
         	<div   id="divSoldUser_1" name="divSoldUser_1"  class="center">
         	
         	</div>
         	<div id="soldUserError" name="soldUserError"></div>
           </div>
             <div class="form-group">
             	<label  for="rating" class="control-label">Rating<font color="red">*</font></label>
         		 <select required="true" class="form-control    " name="rating" id="rating">
         		 	<?php 
        			foreach(getRatingArray() as $rateID=>$rateName){
         		 		echo "<option value='$rateID'  style='background-color:#E9E9E9;font-weight:bold;' > $rateName</option>";
         		 	}
         		 	?>
         		 
         		 
        		<!--	<option value='3'  style='background-color:#E9E9E9;font-weight:bold;' > Good</option>
        				<option value='2'  style='background-color:#E9E9E9;font-weight:bold;' > Bad </option>
        				<option value='1'  style='background-color:#E9E9E9;font-weight:bold;' > Average </option>
        		-->
        		</select>
        		<div id="ratingError" name="ratingError" ></div>
        	</div>
        	<div class="form-group">
             	<label  for="soldqty" class="control-label">Quantity<font color="red">*</font></label>
         		<select required="true" class="form-control    " name="soldqty" id="soldqty">
        				<?php 
        				  	for ($x = 1; $x <= MAXSOLDQTY; $x++)
        				  		echo "<option value=$x> $x </option>";
        				  ?>
		        </select>
        		<div id="soldqtyError" name="soldqtyError" ></div>
        	</div>
        	
        	 <div class="form-group">
            <label for="message-text" class="control-label">Message <span class="text-count">(<?php echo DESCLENGTHINMYADS;?>) </span>:</label>
            <textarea style="vertical-align: top; horizontal-align: left; resize:none;" class="form-control"  id="message-text"  maxlength="<?php echo DESCLENGTHINMYADS;?>"  rows="5" columns="30"  name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
          </div>
         	
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success pull-right"   onclick="setupMarkSold(); return false;">Submit</button>
        	<button id="validate" hidden="true" type="submit"></button>
  
     	 </div>
    </div>
  </div>
</div>
<!-- Modal contactAdvertiser -->
<div class="modal fade" id="deleteAdsPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 id="modal-title-del" class="modal-title"><?php echo $this->lang->line("popupTitleDeleteAds");?></h2>
      </div>
      <div class="modal-footer">
		<form role="form" id="itemDelete" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/deleteMyAds?prevURL=<?php echo urlencode($previousCurrent_url);?>">
           <div class="form-group">
           		<input type="hidden" id="messageID" name="messageID" >   	
           		<input type="hidden" id="userID" name="userID" >   
           	</div>		
            
        </form>
		<button id="fwd-btn" class="btn btn-primary btn-tw" onclick="location.reload();" style="display: none;"><i class="fa fa-check"></i> Confirm</button>
      	<button id="cancel-btn" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		<button id="submit-btn" type="button" onclick="deleteMyAds(); return false;" class="btn btn-primary">Delete</button>
	  </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sellerInfo" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 id="modal-title-del" class="modal-title">Seller Contact Information</h2>
      </div>
      <div class="modal-body">
      	<table>
      <?php if(!$hidetelno){?>
        <tr><td>Phone: </td><td style="width:300px;"><input  id="sellerphone" name="sellerphone"></td></tr>
        <?php }?>
       <tr><td>Email: </td><td> <input id="selleremail" name="selleremail"></td></tr>
        <?php if($showWeChatID){?>
        <tr><td>We Chat ID: </td><td><input id="weChatID" name="weChatID" value="<?php echo $weChatID;?>"></td></tr>
        <?php }?>
        <?php if($showWebSite){?>
        <tr><td>Web Site: </td><td><input id="webSiteAddr" name="webSiteAddr" value="<?php echo $webSiteAddr;?>"></td></tr>
        <?php }?>
        </table>
      </div>
      <div class="modal-footer">
		<button id="fwd-btn" class="btn btn-primary btn-tw" onclick="location.reload();" style="display: none;"><i class="fa fa-check"></i> Confirm</button>
      	<button id="cancel-btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reportDeleteAbuseComplaint" tabindex="-1" role="dialog" >

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" ><i class="fa icon-info-circled-alt"></i> 
        <?php echo $this->lang->line("somethingWrongAd");?>
         </h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" id="itemDeleteAbuse" action="<?php echo base_url(); echo MY_PATH;?>messages/deleteAbuseMessage/<?php echo $postID;?>?prevURL=<?php echo urlencode(current_url());?>&prevprevURL=<?php echo urlencode($previousCurrent_url);?>">
          <div id="tableBodyList">
      		<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line("From");?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Ads_Detail");?></th>
                    </tr>
                </thead>
                <tbody>
            <?php 
            	if($abuseList<>null)
            	{
            		$rowCount=0;
                  	foreach($abuseList as $id=>$row)
                  	{
                  		
                  		$from=$row['username'];
                  		$createDate=$row['createDate'];
                  		$status=$row['status'];
                  		$fUserID=$row['fUserID'];
                  		$content=$row['content'];
                  		$reportreason=$row['reportreason'];
                  		echo "<tr>";
                    	echo "<td style=\"width:20%\" class=\"add-image\">$from";
                    	$rowCount=$rowCount+1;
                    	echo "</td>";
                      	echo "<td style=\"width:55%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                      echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$reportreason."</div>".$content;
                          echo "<br/>Posted On: ". date('Y-m-d h:i A', strtotime($createDate))."</h5>";
                    		echo "</div></td>";
                      		
                      	
                  		echo "</tr>";
                  		
                  	}
            	}
            ?>
       
            	 </tbody>
              </table>
      	
      	</div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" type="submit" onclick="setupDeleteAbuse(); return false;" class="btn btn-primary">Request Delete Abuse</button>
      	<button id="validate" hidden="true" type="submit"></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reportAdvertiser" tabindex="-1" role="dialog" >

  <div class="modal-dialog">
    <div class="modal-content">
    <?php 
      	$usr = $this->nativesession->get('user');
      	if(!isset($usr) or empty($usr)){
      	?>
      	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("lblClose");?></span></button>
	        <h4 class="modal-title"><?php echo $this->lang->line("lblPleaseLogin");?></h4>
      	</div>
      	<div class="modal-body">
      	   <h2 class="center-text"><?php echo $this->lang->line("lblLoginToContinue");?></h2>
      	   <br>
      	   <a class="btn btn-primary btn-40 center-obj" href="<?php echo base_url().MY_PATH."home/loginPage?prevURL=".urlencode(current_url());?>" ><i class="fa fa-sign-in"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line("lblLogin");?></a></p>
                    	
      	</div>
        <?php } else {?>
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" ><i class="fa icon-info-circled-alt"></i> <?php echo $this->lang->line("somethingWrongAd");?></h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" id="itemAbuse" action="<?php echo base_url(); echo MY_PATH;?>messages/insertAbuseMessage/<?php echo $postID;?>?prevURL=<?php echo urlencode(current_url());?>&prevprevURL=<?php echo urlencode($previousCurrent_url);?>">
          <div class="form-group">
            <label for="reportreason" class="control-label"><?php echo $this->lang->line("lblReason");?></label>
            <select name="reportreason" id="reportreason" class="form-control">
              <option value=""><?php echo $this->lang->line("lblReasonSelect");?></option>
              <option value="soldUnavailable"><?php echo $this->lang->line("lblReasonSelect2");?></option>
              <option value="fraud"><?php echo $this->lang->line("lblReasonSelect3");?></option>
              <option value="duplicate"><?php echo $this->lang->line("lblReasonSelect4");?></option>
              <option value="spam"><?php echo $this->lang->line("lblReasonSelect5");?></option>
              <option value="wrongCategory"><?php echo $this->lang->line("lblReasonSelect6");?></option>
              <option value="other"><?php echo $this->lang->line("lblReasonSelect7");?></option>
            </select>
          </div>
          <!--<div class="form-group">
            <label for="recipientemail" class="control-label">Your E-mail:</label>
            <input type="text"  name="recipientemail" maxlength="60" class="form-control" id="recipientemail">
          </div>
          
          <div class="form-group">
            <label for="recipientname1" class="control-label">Name: </label>
            <input  id="recipientname1" name="recipientname1" type="text"  maxlength="60" class="form-control" >
          </div>
          <div class="form-group">
            <label for="recipientPhoneNumber1"  class="control-label">Phone Number:</label>
            <input type="text"  maxlength="30" class="form-control" name="recipientPhoneNumber1" id="recipientPhoneNumber1">
          </div>-->
          <div class="form-group">
            <label for="messagetext2" class="control-label"><?php echo $this->lang->line("profileSendPostMessage");?> <span class="text-count">(<?php echo DESCLENGTHINITEMPAGE;?>) </span>:</label>
            <textarea style="vertical-align: top; horizontal-align: left; resize:none;" class="form-control"  rows="5" maxlength="<?php echo DESCLENGTHINITEMPAGE;?>" id="messagetext2" name="messagetext2"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line("Cancel");?></button>
        <button type="button" type="submit" onclick="setupAbuse(); return false;" class="btn btn-primary"><?php echo $this->lang->line("btnSubmit");?> </button>
      	<button id="validate" hidden="true" type="submit"></button>
      </div>
      <?php }?>
    </div>
  </div>
</div>

<!-- /.modal --> 
<div class="modal fade" id="directSend" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i> Send Direct Request </h4>
      </div>
      <div class="modal-body">
		<h1 id ="modal-text">Sending request...<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif"></h1>
        <div id="progress-bar" class="progress">
			<div class="progress-bar progress-bar-striped active" role="progressbar" id="upload-progress-bar"
				 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">   
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i> Contact advertiser </h4>
      </div>
      <div class="modal-body">
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/insertMessage/<?php echo $postID;?>?prevURL=<?php echo urlencode(current_url());?>&prevprevURL=<?php echo urlencode($previousCurrent_url);?>">  
      <!--   $previousCurrent_url -->
     <!--       <div class="form-group">
            <label for="recipient-name" class="control-label">Name: <font color="red">*</font></label>
            <input .class="form-control required"  maxlength="50" value="<?php echo $firstName; echo ' '.$lastName;?>" id="recipient-name" name="recipient-name"  required="true" placeholder="Your name" data-placement="top" data-trigger="manual" data-content="Must be at least 3 characters long, and must only contain letters." type="text">
          </div> -->
<!--           <div class="form-group"> -->
<!--             <label for="sender-email" class="control-label">E-mail: <font color="red">*</font></label> -->
 <!--             <input id="sender-email"  maxlength="50" name="sender-email"   value="<?php echo $email;?>" type="text" data-content="Must be a valid e-mail address (user@gmail.com)" data-trigger="manual" data-placement="top" placeholder="email@you.com" required="true" class="form-control email">  -->
<!--           </div> -->
<!--           <div class="form-group"> -->
<!--             <label for="recipient-Phone-Number"  class="control-label">Phone Number:</label> -->
<!--              <input type="text"  maxlength="30"   value="<?php echo $telNo;?>" class="form-control" name="recipient-Phone-Number" id="recipient-Phone-Number">  -->
<!--           </div> -->
          <div class="form-group">
            <label for="message-text" class="control-label">Message <font color="red">*</font><span class="text-count">(<?php echo DESCLENGTHINITEMPAGE;?>) </span>:</label>
            <textarea id="txtSendMessage" class="form-control"  maxlength="<?php echo DESCLENGTHINITEMPAGE;?>"  rows="5" columns="30" 
            style="vertical-align: top; horizontal-align: left; resize:none;" required="true" id="message-text" name="message-text"  
            style="resize:none"
            placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
          </div>
          <div class="form-group">
            <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      	
      	<button type="submit" class="btn btn-success" onclick="setup(); return false;">Send</button>
      	<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
        
      	<button id="validate" hidden="true" type="submit"></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="replyComment" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i> Reply Comment </h4>
      </div>
      <div class="modal-body">
      <h3 class="blogs-comment-reply-title list-title"><?php echo $this->lang->line("lblItemLeaveComment"); ?></h3>

                    <form class="blogs-comment-form" id="blogs-commentformPopup" method="post" action="<?php echo base_url().MY_PATH; ?>itemComments/insertItemComment/Y?prevURL=<?php echo current_url();?>">         
<!--                                         <div class="row form-group"><div class="col-md-6"><input class="form-control" type="text" placeholder="Enter your name" aria-required="true" value="" name="author"></div><div class="col-md-6 text-left"><span>Name*</span></div></div> -->
<!--                                         <div class="row form-group" ><div class="col-md-6"><input class="form-control" type="text" placeholder="Enter your email" aria-required="true" value="" name="email"></div><div class="col-md-6 text-left"><span>E-mail*</span></div></div> -->
										<input type="hidden" name="postID"  value="<?php echo $postID;?>" ><!--                                     <div class="row form-group"><div class="col-md-6"><input class="form-control" type="text" value="" placeholder="Enter your website" name="url"></div><div class="col-md-6 text-left"><span>Website*</span></div></div> -->
										<input type="hidden" name="parentID"  id="parentID" >
                                        <div id="replyblogscommentDiv" class="form-group">
                                            <textarea style="vertical-align: top; horizontal-align: left; resize:none;" class="form-control" maxlength="<?php echo DESCLENGTHINITEMPAGE;?>"  rows="5" columns="30"  placeholder="Message" name="replyblogscomment" id="replyblogscomment"></textarea> 
                                              	<div id="replyblogscommentAjaxLoad" class="center"></div>
	                        					<div id="replyblogscommentError" hidden="true"></div>
                         
                                            </div>

<!--                                         <button type="submit" class="btn-success btn btn-lg"> Submit </button> -->

					</form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success pull-right" onclick="setupCommentPopup(); return false;">Send message!</button>
      	<button id="validate" hidden="true" type="submit"></button>
      </div>
    </div>
  </div>
 
</div>

<!-- /.modal --> 
 <div class="modal fade" id="shareAds" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Click copy button and paste in other apps to share </h4>
      </div>
      <div class="modal-body">
      <h2 id="copytext">
			<?php // echo $shareLink;?>
			</h2>
		<textarea style="vertical-align: top; horizontal-align: left; resize:none;width: 100%; height: 100px;font-size:20" class="js-copytextarea" id="holdtext">Find "<?php echo $itemName;?>" in GirlsTrade - <?php echo $shareLink;?></textarea>
		 </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
        <button type="button" class="js-textareacopybtn btn btn-success pull-right" data-clipboard-target=".js-copytextarea">Copy</button>
      </div>
    </div>
  </div>
</div>
<!-- Le javascript
================================================== --> 
</div>
 <script>
  $( "#blogscomment" ).blur(function() {
	$("#blogscommentAjaxLoad").html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
		$.ajax({
			method: "POST",
			url: "<?php echo base_url(); echo MY_PATH;?>viewItem/validateBlogsCommentLength",
			data: { blogscomment: $( "#blogscomment" ).val() },
			success: function(response){
				var result = JSON.parse(response);
		    	$("#error").html(result.message);
		    	$("#blogscommentDiv").removeClass('has-success has-error').addClass(result.class);
		    	$("#blogscommentAjaxLoad").html(result.icon);
		    	$("#blogscommentError").html(result.err);
		    	}
		});
	});
  $( "#replyblogscomment" ).blur(function() {
	$("#replyblogscommentAjaxLoad").html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
		$.ajax({
			method: "POST",
			url: "<?php echo base_url(); echo MY_PATH;?>viewItem/validateReplyBlogsCommentLength",
			data: { replyblogscomment: $( "#replyblogscomment" ).val() },
			success: function(response){
				var result = JSON.parse(response);
		    	$("#error").html(result.message);
		    	$("#replyblogscommentDiv").removeClass('has-success has-error').addClass(result.class);
		    	$("#replyblogscommentAjaxLoad").html(result.icon);
		    	$("#replyblogscommentError").html(result.err);
		    	}
		});
	});
  </script>
<script>

function passToModal() {
	$('#sellerActionPopup').on('show.bs.modal', function(event) {
        $("#postID_3").val($(event.relatedTarget).data('id'));
        $("#pageNum").val($(event.relatedTarget).data('pagenum'));
          $("#divSoldUser_1").html(jsbase64_decode($(event.relatedTarget).data('soldusers')));
    });
	$('#sellerApprovePopup').on('show.bs.modal', function(event) {
		$("#ctrlpostID").val($(event.relatedTarget).data('id'));
        $("#ctrlpageNum").val($(event.relatedTarget).data('pagenum'));
        
	});  
	 //$("#hrefPageNum").onclick(getApproveList("ctrlpostID", "ctrlpageNum2", "tableBodyList", "tableBodyError"));
		
	$('#sellerFeedBackPopup').on('show.bs.modal', function(event) {
		 $("#postID_2").val($(event.relatedTarget).data('id'));
         $("#divSoldUser_2").html(jsbase64_decode($(event.relatedTarget).data('soldusers')));
    });
	$('#buyerFeedBackPopup').on('show.bs.modal', function(event) {
		 $("#postID_1").val($(event.relatedTarget).data('id'));
         $("#userID_1").val($(event.relatedTarget).data('userid'));
    });
    $('#replyComment').on('show.bs.modal', function(event) {
        $("#parentID").val($(event.relatedTarget).data('id'));
    });
    $('#deleteAdsPopup').on('show.bs.modal', function(event) {
        $("#messageID").val($(event.relatedTarget).data('id'));
        $("#userID").val($(event.relatedTarget).data('userID'));
    });
    $('#sellerInfo').on('show.bs.modal', function(event) {
        $("#sellerphone").val($(event.relatedTarget).data('phone'));
        $("#selleremail").val($(event.relatedTarget).data('email'));
    });
}
$(document).ready(passToModal());
function getApproveList(ctrlValue1, ctrlValue2, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>viewItem/getPreApproveHtmlList",
		data: { postID: $( "#".concat(ctrlValue1) ).val(), 
			pageNum: $( "#".concat(ctrlValue2) ).val()},
		success: function(response){
			var result;
			try{
			result=JSON.parse(response);
			}catch(err){
				alert(err.message);
			}
			$("#".concat(ctrlName)).html(result.icon);
	    	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
};

	    
//encode(decode) html text into html entity
var decodeHtmlEntity = function(str) {
return str.replace(/&#(\d+);/g, function(match, dec) {
return String.fromCharCode(dec);
});
};

var encodeHtmlEntity = function(str) {
var buf = [];
for (var i=str.length-1;i>=0;i--) {
buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
}
return buf.join('');
};


function marksold(ctrlValue1, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/marksoldclosed",
		data: { postID: $( "#".concat(ctrlValue1) ).val()},
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
};
function approve(ctrlValue1, ctrlValue2, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/approveSavedAds",
		data: { messageID: $( "#".concat(ctrlValue1) ).val(),
		userID: $( "#".concat(ctrlValue2) ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
};
function reject(ctrlValue1, ctrlValue2, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/rejectSavedAds",
		data: { messageID: $( "#".concat(ctrlValue1) ).val(),
		userID: $( "#".concat(ctrlValue2) ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
};
function jsbase64_decode(data) {
	  //  discuss at: http://phpjs.org/functions/base64_decode/
	  // original by: Tyler Akins (http://rumkin.com)
	  // improved by: Thunder.m
	  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  //    input by: Aman Gupta
	  //    input by: Brett Zamir (http://brett-zamir.me)
	  // bugfixed by: Onno Marsman
	  // bugfixed by: Pellentesque Malesuada
	  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  //   example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
	  //   returns 1: 'Kevin van Zonneveld'
	  //   example 2: base64_decode('YQ===');
	  //   returns 2: 'a'

	  var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
	  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
	    ac = 0,
	    dec = '',
	    tmp_arr = [];

	  if (!data) {
	    return data;
	  }

	  data += '';

	  do { // unpack four hexets into three octets using index points in b64
	    h1 = b64.indexOf(data.charAt(i++));
	    h2 = b64.indexOf(data.charAt(i++));
	    h3 = b64.indexOf(data.charAt(i++));
	    h4 = b64.indexOf(data.charAt(i++));

	    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

	    o1 = bits >> 16 & 0xff;
	    o2 = bits >> 8 & 0xff;
	    o3 = bits & 0xff;

	    if (h3 == 64) {
	      tmp_arr[ac++] = String.fromCharCode(o1);
	    } else if (h4 == 64) {
	      tmp_arr[ac++] = String.fromCharCode(o1, o2);
	    } else {
	      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
	    }
	  } while (i < data.length);

	  dec = tmp_arr.join('');

	  return dec.replace(/\0+$/, '');
	}
	    
//encode(decode) html text into html entity
var decodeHtmlEntity = function(str) {
return str.replace(/&#(\d+);/g, function(match, dec) {
return String.fromCharCode(dec);
});
};

var encodeHtmlEntity = function(str) {
var buf = [];
for (var i=str.length-1;i>=0;i--) {
buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
}
return buf.join('');
};





function setupMarkSold()
{
	 if(document.getElementById("soldUser").value=="") {
		 $("soldUserError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Please select sold to person!</span></em>');
		 location.href ="#sellerActionPopup";
		 return false;
	 }
	if( document.getElementById("rating").value=="") {
		$("ratingError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Please select rating!</span></em>');
		 location.href ="#sellerActionPopup";
		 return false;
	}
     var myform = document.getElementById("itemMarkSold");
	  	document.getElementById("itemMarkSold").submit();
       	return true;
}
function setupDeleteAds()
{
	$("#modal-title-del").html("Processing...");
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/deleteMyAds",
		data: { 
			messageID: $("#postID").val(),
			userID: $("#userID").val() 
		},
		success: function(response){
			$("#modal-title-del").html("Your post has been deleted.");
			$('#fwd-btn').css("display", "block");
			$('#fwd-btn').css("margin", "auto");
			$('#cancel-btn').css("display", "none");
			$('#submit-btn').css("display", "none");
			
			console.log("success");
		}
	});


     //var myform = document.getElementById("itemDelete");
	  	//document.getElementById("itemDelete").submit();
    return false;
}
function clipBoard() 
{
holdtext.innerText = copytext.innerText;
Copied = holdtext.createTextRange();
Copied.execCommand("Copy");
}

function deleteMyAds(){
	var myform = document.getElementById("itemDelete");
  	document.getElementById("itemDelete").submit();
   	return true;
}

function setup()
{
        var myform = document.getElementById("item");
	  	document.getElementById("item").submit();
       	return true;
}
function setupBuyerFeedBack()
{
        var myform = document.getElementById("itemBuyerFeedBack");
	  	document.getElementById("itemBuyerFeedBack").submit();
       	return true;
}
function setupSellerFeedBack()
{
        var myform = document.getElementById("itemSellerFeedBack");
	  	document.getElementById("itemSellerFeedBack").submit();
       	return true;
}
function setupComment(){
	var myform = document.getElementById("blogs-commentform");
  	document.getElementById("blogs-commentform").submit();
   	return true;
}
function setupCommentPopup(){
	var myform = document.getElementById("blogs-commentformPopup");
  	document.getElementById("blogs-commentformPopup").submit();
   	return true;
}
function setupAbuse()
{
        var myform = document.getElementById("itemAbuse");
	  	document.getElementById("itemAbuse").submit();
       	return true;
}
function setupDeleteAbuse()
{
    var myform = document.getElementById("itemDeleteAbuse");
  	document.getElementById("itemDeleteAbuse").submit();
   	return true;
}
$('#directSendButton').on('click', function () {
	$.ajax({
		xhr: function()
		{
			var xhr = new window.XMLHttpRequest();
			//Upload progress
			xhr.addEventListener("progress", function(evt){
			  if (evt.lengthComputable) {
				var percentComplete = evt.loaded / evt.total*100;
				//Do something with upload progress
				$("#upload-progress-bar").width(percentComplete+"%");
				console.log(percentComplete);
			  }
			}, false);
			return xhr;
		},
		url: "<?php echo base_url().MY_PATH."messages/directSend/".$postID."?prevURL=".urlencode(current_url())."&prevprevURL=".urlencode($previousCurrent_url)?>",
		type: 'POST',
		success:function(msg){
			$("#modal-text").html("You have send a direct request to the seller.<?php echo $YouHaveRemainContactSellerTimes;?>");
			setTimeout(function(msg){location.reload();}, 2500);
		}
	});
});
</script>
<script>

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
	    	$("#".concat(clickLink)).attr("style", "pointer-events: none; cursor: default;color:black;");
		    }
	});
};
</script>

<!-- Placed at the end of the document so the pages load faster  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"> </script><script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script> 
-->

<!-- include equal height plugin  --> 
<script src="<?php echo base_url();?>assets/js/jquery.matchHeight-min.js"></script> 

<!-- include jquery list shorting plugin plugin  --> 
<script src="<?php echo base_url();?>assets/js/hideMaxListItem.js"></script> 

<!-- bxSlider Javascript file --> 
<script src="<?php echo base_url();?>assets/plugins/bxslider/jquery.bxslider.min.js"></script> 
<script>
$('.bxslider').bxSlider({
  pagerCustom: '#bx-pager'
});


</script> 

<!-- include form-validation plugin || add this script where you need validation   --> 
<script src="<?php echo base_url();?>assets/js/form-validation.js"></script> 


<?php include "footer2.php"; ?>
