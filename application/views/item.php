<?php $title = "Girls' Trading Platform";  include("header.php"); ?>

<!-- bxSlider CSS file -->
<link href="<?php echo base_url();?>assets/plugins/bxslider/jquery.bxslider.css" rel="stylesheet" />

<style>
.enlarged {
        width: 600px;
        height: 600px;
    }
</style>

<script>
    paceOptions = {
      elements: true
    };
    
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
      <div class="pull-right backtolist"><a href=<?php echo $previousCurrent_url;?>> <i class="fa fa-angle-double-left"></i> Back to Results</a></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 page-content col-thin-right">
          <div class="inner inner-box ads-details-wrapper panel-bevel">
            <h2 class="itemName"> <?php echo $itemName;?> </h2>
            <span class="info-row"> <span class="date"><i class=" icon-clock"> </i> <?php echo $createDate;?> </span> - <span class="category"><?php echo $ParentCatName;?> </span>- <span class="item-location"><i class="fa fa-map-marker"></i> <?php echo $LocationName;?> </span> </span>
            <div class="ads-image">
              <h1 class="pricetag"> <?php echo "\$".$price." (".$currency.")";?></h1>
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
                    <tr>
                        <td>
                        <p class=" no-margin "><strong><?php echo $this->lang->line("lblView").": ";?></strong> 
                        </p>
                        </td><td><p class="itemInfoData">
                        <?php echo $visitCount;?>
                        
                        </p></td>
                      </tr>
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
                     echo "<li><a style=\"pointer-events: none; cursor: default;\" href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'><i class=\" fa fa-heart\"></i> Save ad </a> </li>";
                   else 
                   	echo "<li><a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'><i class=\" fa fa-heart\"></i> Save this item </a> </li>";
                   	
                	echo "<li><a href=\"#shareAds\" data-toggle=\"modal\" shareLink='$shareLink'> <i class=\"fa fa-share-alt\"></i> Share this item </a></li>";
                      ?>
                      <li><a href="#reportAdvertiser" data-toggle="modal"> <i class="fa icon-info-circled-alt"></i> Report abuse </a> </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content-footer text-left">  </div>
            </div>
            
            <!--<div class="blog-post-footer">
			</div>-->


                            <!-- <div style="clear: both"></div> -->
							
                            <!-- <div class="inner "> -->
<!-- 								<div class="clearfix"> -->
                                <!--<div class="col-md-12  blog-post-bottom">-->
                                <!-- </div> -->
<!--                             </div> -->



                            <!--<div class="blogs-comments-area">-->
                               <!-- <h3 class="list-title">--> 
                               <!-- <a href="" class="post-comments">--><?php //count($commentList);?> 
                               <!-- Comments</a></h3>-->
                               
                               
                               

                                <!-- <div class="blogs-comment-respond" id="respond"> -->
                                    <!--<ul class="blogs-comment-list">
										<?php 
										if($commentList!=null && count($commentList)>0){
										
										foreach ($commentList as $id=>$value)
										{
											//var_dump($value);
											$userPhotoPath=$value['userPhotoPath'];
											$username=$value['username'];
											$strElapsedTime=$value['strElapsedTime'];
											$comments=$value['comments'];
											$id=$value["commentID"];
											echo "<li>";
											echo "<div class=\"blogs-comment-wrapper\">";
											echo "<div class=\"blogs-comment-avatar\">";
											echo "<figure>";
											echo "<img alt=\"avatar\" src=$userPhotoPath>";
											echo "</figure>";
											echo "</div>";
											echo "<div class=\"blogs-comment-details\">";
											echo "<div class=\"blogs-comment-name\">";
											echo "<a href=\"#\">$username </a> ";
											echo  "<span class=\"blogs-comment-date\">$strElapsedTime</span>";
											echo "</div>";
											echo "<div class=\"blogs-comment-description\">";
											echo "<p>$comments</p>";
											echo "</div>";
											echo "<div class=\"blogs-comment-reply\"><a data-toggle=\"modal\" href=\"#replyComment\"  data-id=\"$id\">Reply</a></div>";
											
											
											if($value["childCommentList"]!=null && count($value["childCommentList"])){
												echo "<ul>";
												foreach ($value["childCommentList"] as $id1=>$value1)
												{
													//var_dump($value);
													$userPhotoPath1=$value1['userPhotoPath'];
													$username1=$value1['username'];
													$strElapsedTime1=$value1['strElapsedTime'];
													$comments1=$value1['comments'];
													//$id1=$value1["commentID"];
													echo "<li>";
													echo "<div class=\"blogs-comment-wrapper\">";
													echo "<div class=\"blogs-comment-avatar\">";
													echo "<figure>";
													echo "<img alt=\"avatar\" src=$userPhotoPath1>";
													echo "</figure>";
													echo "</div>";
													echo "<div class=\"blogs-comment-details\">";
													echo "<div class=\"blogs-comment-name\">";
													echo "<a href=\"#\">$username1 </a> ";
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
                                       
                                    </ul> -->    <!--Comment list End-->

                                <!--</div>--><!-- #respond -->


                            <!--</div>-->	
						<!--</div>-->
						<div class="content-footer text-left" id="viewItemBottomOpt"> 
				<?php if($isPostAlready==false or $isPendingRequest==false or $isSameUser==false)
                  {
	                  if($isPostAlready == false and $isSameUser ==false ){
		                  echo "<a href=";
		                  echo base_url().MY_PATH."messages/directSend/".$postID."?prevURL=".urlencode($previousCurrent_url);
		                  echo " data-toggle=\"modal\" class=\"btn btn-default directSendButton\">";
		                  echo "<i class=\"icon-right-hand\"></i> Direct send request </a>";
	                  }
                  }
                  ?>  
                  <?php
                  if($isPostAlready==true && $isSameUser==false)
                  {
	                  echo "<a href=\"\" data-toggle=\"modal\" class=\"btn   btn-default directSendButton\">";
	                  echo "<i class=\" icon-info\"></i>Pending Request.</a>";
                  }
                  ?>
                  <?php if($isPendingRequest==true && $isSameUser==false) 
                  {
	                  echo "<a href=\"\" data-toggle=\"modal\" class=\"btn   btn-default directSendButton\">";
	                  echo "<i class=\" icon-info\"></i>Pending for Seller's Approval.</a>";
                  }
                  ?>
                  <?php
                  if($isSameUser==true)
                  {  
	                  echo "<a href=\"".base_url().MY_PATH."newPost/showEditPost/".$postID."?prevURL=".urlencode($previousCurrent_url);
	                  echo " data-toggle=\"modal\" class=\"btn btn-default directSendButton\">";
	                  echo "<i class=\" icon-pencil\"></i> Edit Item </a>";
                  }
                  ?>
						
						<a href="#contactAdvertiser" email="<?php echo $email;?>" 
                	firstName="<?php echo $firstName;?>" lastName="<?php echo $lastName;?>"
                	telNo="<?php echo $telNo;?>" phoneNo="<?php echo $phoneNo;?>"
                	 data-toggle="modal" class="btn   btn-default inboxMsgButton">
						<i class=" icon-mail-2"></i> Send a message <?php if($DailyMaxTimes>0) echo "(".$DailyMaxTimes.")";?> </a> 
						</div>
                        <!-- </div> -->

            
          </div>
          <!--/.ads-details-wrapper--> 
          
        </div>
        <!--/.page-content-->
        
        <div class="col-sm-3  page-sidebar-right">
          <aside>
              <div class="panel sidebar-panel panel-contact-seller panel-bevel seller-info-border">
              <div class="panel-heading seller-heading pink-bg"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;Contact Seller</div>
         
              <div class="panel-content user-info">
                <div class="panel-body text-center">
                  <div class="seller-info">
                    <h3 class="no-margin">
              			<div class="user-ads-action"> 
              			<a href="<?php echo base_url().MY_PATH;?>viewProfile/index/<?php echo $postID.'/1?prevURL='.urlencode($previousCurrent_url);?>" 
              			class="btn   btn-default btn-block viewButton">
              			<i class="icon-user-3"></i>
              			View <?php echo $userName;?> Info</a> </div>
              		</h3>
                    <!-- <p> Joined: <strong><?php //echo $userCreateDate;?></strong></p> -->
                  </div>
                  <?php if($isPostAlready==false or $isPendingRequest==false or $isSameUser==false)
                  {
	                  if($isPostAlready == false and $isSameUser ==false ){
		                  echo"<div class=\"user-ads-action\">";
		                  echo "<a href=";
		                  echo base_url().MY_PATH."messages/directSend/".$postID."?prevURL=".urlencode($previousCurrent_url);
		                  echo " data-toggle=\"modal\" class=\"btn btn-default btn-block directSendButton\">";
		                  echo "<i class=\"icon-right-hand\"></i> Direct send request </a> </div>";
	                  }
                  }
                  ?>  
                  <?php
                  if($isPostAlready==true && $isSameUser==false)
                  {
	                  echo "<div class=\"user-ads-action\">"; 
	                  echo "<a href=\"\" data-toggle=\"modal\" class=\"btn   btn-default btn-block directSendButton\">";
	                  echo "<i class=\" icon-info\"></i>Pending Request.</a> </div>";
                  }
                  ?>
                  <?php if($isPendingRequest==true && $isSameUser==false) 
                  {
	                  echo "<div class=\"user-ads-action\">"; 
	                  echo "<a href=\"\" data-toggle=\"modal\" class=\"btn   btn-default btn-block directSendButton\">";
	                  echo "<i class=\" icon-info\"></i>Pending for Seller's Approval.</a> </div>";
                  }
                  ?>
                  <?php
                  if($isSameUser==true)
                  {  
	                  echo "<div class=\"user-ads-action\">"; 
	                  echo "<a href=\"".base_url().MY_PATH."newPost/showEditPost/".$postID."?prevURL=".urlencode($previousCurrent_url);
	                  echo " data-toggle=\"modal\" class=\"btn btn-default btn-block directSendButton\">";
	                  echo "<i class=\" icon-pencil\"></i> Edit Item </a> </div>";
                  }
                  ?>
                  <?php $usr = $this->nativesession->get('user');
					if(empty($usr)){ 
           			?>
                  <div class="user-ads-action"> <a href="#contactAdvertiser" data-toggle="modal" disabled="disabled" 
                  class="btn   btn-default btn-block  inboxMsgButton"><i class=" icon-mail-2"></i> Send a message </a> </div>
                  <?php }else{?>
                	<div class="user-ads-action"> <a href="#contactAdvertiser" email="<?php echo $email;?>" 
                	firstName="<?php echo $firstName;?>" lastName="<?php echo $lastName;?>"
                	telNo="<?php echo $telNo;?>" phoneNo="<?php echo $phoneNo;?>"
                	 data-toggle="modal" class="btn   btn-default btn-block inboxMsgButton">
                	 <i class=" icon-mail-2"></i> Send a message <?php if($DailyMaxTimes>0) echo "(".$DailyMaxTimes.")";?></a> </div>
                  <?php }?>   
                </div>
              </div>
            </div>
            <div class="panel sidebar-panel panel-bevel seller-info-border">
              <div class="panel-heading  seller-heading pink-bg"><i class="fa fa-shield"></i>&nbsp;&nbsp;&nbsp;Safety Tips for Buyers</div>
             <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li> Meet seller at a public place </li>
                    <li> Check the item before you buy</li>
                    <li> Pay only after collecting the item</li>
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
  </div>
  <!-- /.main-container -->
  
  <?php include "footer1.php"; ?>
  <!-- /.footer -->
</div>
<!-- /.wrapper --> 

<!-- Modal contactAdvertiser -->

<div class="modal fade" id="reportAdvertiser" tabindex="-1" role="dialog" >

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" ><i class="fa icon-info-circled-alt"></i> There's something wrong with this  ads? </h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" id="itemAbuse" action="<?php echo base_url(); echo MY_PATH;?>messages/insertAbuseMessage/<?php echo $postID;?>?prevURL=<?php echo urlencode($previousCurrent_url);?>">
          <div class="form-group">
            <label for="reportreason" class="control-label">Reason:</label>
            <select name="reportreason" id="reportreason" class="form-control">
              <option value="">Select a reason</option>
              <option value="soldUnavailable">Item unavailable</option>
              <option value="fraud">Fraud</option>
              <option value="duplicate">Duplicate</option>
              <option value="spam">Spam</option>
              <option value="wrongCategory">Wrong category</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipientemail" class="control-label">Your E-mail:</label>
            <input type="text"  name="recipientemail" maxlength="60" class="form-control" id="recipientemail">
          </div>
          <div class="form-group">
            <label for="messagetext2" class="control-label">Message <span class="text-count">(300) </span>:</label>
            <textarea class="form-control"   maxlength="300" id="messagetext2" name="messagetext2"></textarea>
          </div>
          <div class="form-group">
            <label for="recipientname1" class="control-label">Name: </label>
            <input  id="recipientname1" name="recipientname1" type="text"  maxlength="60" class="form-control" >
          </div>
          <div class="form-group">
            <label for="recipientPhoneNumber1"  class="control-label">Phone Number:</label>
            <input type="text"  maxlength="30" class="form-control" name="recipientPhoneNumber1" id="recipientPhoneNumber1">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" type="submit" onclick="setupAbuse(); return false;" class="btn btn-primary">Send Report</button>
      	<button id="validate" hidden="true" type="submit"></button>
      </div>
    </div>
  </div>
</div>

<!-- /.modal --> 


<div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i> Contact advertiser </h4>
      </div>
      <div class="modal-body">
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/insertMessage/<?php echo $postID;?>?prevURL=<?php echo urlencode(current_url());?>">  
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
            <label for="message-text" class="control-label">Message <font color="red">*</font><span class="text-count">(300) </span>:</label>
            <textarea id="txtSendMessage" class="form-control"  maxlength="300"  rows="5" columns="30" 
            required="true" id="message-text" name="message-text"  
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
      <h3 class="blogs-comment-reply-title list-title">LEAVE A COMMENT</h3>

                    <form class="blogs-comment-form" id="blogs-commentformPopup" method="post" action="<?php echo base_url().MY_PATH; ?>itemComments/insertItemComment?prevURL=<?php echo current_url();?>">         
                                        <div class="row form-group"><div class="col-md-6"><input class="form-control" type="text" placeholder="Enter your name" aria-required="true" value="" name="author"></div><div class="col-md-6 text-left"><span>Name*</span></div></div>
                                        <div class="row form-group" ><div class="col-md-6"><input class="form-control" type="text" placeholder="Enter your email" aria-required="true" value="" name="email"></div><div class="col-md-6 text-left"><span>E-mail*</span></div></div>
										<input type="hidden" name="postID"  value="<?php echo $postID;?>" ><!--                                     <div class="row form-group"><div class="col-md-6"><input class="form-control" type="text" value="" placeholder="Enter your website" name="url"></div><div class="col-md-6 text-left"><span>Website*</span></div></div> -->
										<input type="hidden" name="parentID"  id="parentID" >
                                        <div class="form-group">
                                            <textarea class="form-control" maxlength="300"  rows="5" columns="30"  placeholder="Message" name="blogscomment"></textarea> </div>

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
		<textarea style="width: 500px; height: 100px;font-size:20" class="js-copytextarea" id="holdtext">
		<?php echo $shareLink;?>
		</textarea>
		 </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
        <button type="button" class="js-textareacopybtn btn btn-success pull-right">Copy</button>
      </div>
    </div>
  </div>
</div>
<!-- Le javascript
================================================== --> 

<script>

function passToModal() {
    $('#replyComment').on('show.bs.modal', function(event) {
        $("#parentID").val($(event.relatedTarget).data('id'));
    });
}

$(document).ready(passToModal());

var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.js-copytextarea');
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
       location.href=copyTextarea.innerHTML;
           //"http://localhost:8888/girlstrade/index.php/viewItem/index/1"; 
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
  }
});

function clipBoard() 
{
holdtext.innerText = copytext.innerText;
Copied = holdtext.createTextRange();
Copied.execCommand("Copy");
}

function setup()
{
        var myform = document.getElementById("item");
	  	document.getElementById("item").submit();
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
</script>
<script>

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
