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
            <h2> <?php echo $itemName;?> </h2>
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
              <h5 class="list-title"><strong>Ads Deteils</strong></h5>
              <div class="row">
              <div class="col-sm-7 add-desc-box">
                <div class="ads-details">
                  <h5  class="add-title"><div class=\"add-title-girlstrade\"><?php echo $this->lang->line("lblTitle");?><?php  echo $itemTitle;?></div>
                  <?php echo $itemDesc; ?> </h5>
 <!--                  <h4><?php echo $ChildCatName;?></h4>-->
<!--                   <ul class="list-circle"> -->
<!--                     <li></li> -->
<!--                    </ul> -->
                </div>
                </div>
                <div class="col-md-4">
                  <aside class="panel panel-body panel-details">
                    <ul>
                      <li>
                        <p class=" no-margin "><strong>Price:</strong><?php echo "\$".$price." (".$currency.")";?> </p>
                      </li>
                      <li>
                        <p class="no-margin"><strong>Location:</strong> <?php echo $LocationName;?> </p>
                      </li>
                      <li>
                        <p class=" no-margin "><strong>Condition:</strong> New</p>
                      </li>
               
                    </ul>
                  </aside>
                  <div class="ads-action">
                    <ul class="list-border">
                    <?php 
                    $ctrlName="AjaxLoad1";
              		$errorctrlName="ErrAjaxLoad1";
              		$ctrlValue="post1";
              		$postID2=$postID;
              		$clickLink="clickLink1";
              		$shareLink=base_url()."home/index/".$postID;
                     echo " <div id='$ctrlName' name='$ctrlName' class='center'></div><div id='$errorctrlName' name='$errorctrlName' class='center'></div><input name='$ctrlValue' id='$ctrlValue' type='hidden' value='$postID2' />";
                	echo "<li><a href=\"javascript:savedAds('$ctrlValue', '$ctrlName')\" id='$clickLink'><i class=\" fa fa-heart\"></i> Save ad </a> </li>";
                     echo "<li><a href=\"#shareAds\" data-toggle=\"modal\" shareLink='$shareLink'> <i class=\"fa fa-share-alt\"></i> Share ad </a></li>";
                      ?>
                      <li><a href="#reportAdvertiser" data-toggle="modal"> <i class="fa icon-info-circled-alt"></i> Report abuse </a> </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content-footer text-left">  </div>
            </div>
          </div>
          <!--/.ads-details-wrapper--> 
          
        </div>
        <!--/.page-content-->
        
        <div class="col-sm-3  page-sidebar-right">
          <aside>
            <div class="panel sidebar-panel panel-contact-seller panel-bevel pink-border">
              <div class="panel-heading"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;Contact Seller</div>
              <div class="panel-content user-info">
                <div class="panel-body text-center">
                  <div class="seller-info">
                    <h3 class="no-margin">
              			<div class="user-ads-action"> <a href="<?php echo base_url().MY_PATH;?>viewProfile/index/<?php echo $postID.'/1?prevURL='.urlencode($previousCurrent_url);?>" class="btn   btn-default btn-block">View <?php echo $userName;?> Info.</a> </div>
              		</h3>
                    <p> Joined: <strong><?php echo $userCreateDate;?></strong></p>
                  </div>
                  <div class="user-ads-action" <?php if($isPostAlready==true or $isPendingRequest==true or $isSameUser) echo  "  style='display:none;'  ";?>> 
                  <a <?php if($isPostAlready and $isSameUser ) echo  " style='display:none;' ";?> href="<?php echo base_url().MY_PATH?>messages/directSend/<?php echo $postID;?>?prevURL=<?php echo urlencode($previousCurrent_url);?>" data-toggle="modal" class="btn   btn-default btn-block"><i class=" icon-mail-2"></i> Direct send request </a> </div>
                  <div class="user-ads-action" <?php if($isPostAlready==false or $isSameUser) echo  " style='display:none;' ";?>> <a href="" data-toggle="modal" class="btn   btn-default btn-block"><i class=" icon-mail-2"></i>Pending Request, Wait</a> </div>
                  <div class="user-ads-action" <?php if($isPendingRequest==false or $isSameUser) echo  " style='display:none;' ";?>> <a href="" data-toggle="modal" class="btn   btn-default btn-block"><i class=" icon-mail-2"></i>Send Already!</a> </div>
                  <div class="user-ads-action" <?php if($isSameUser==false) echo  " style='display:none;' ";?>> <a href="<?php echo base_url().MY_PATH."newPost/showEditPost/".$postID."?prevURL=".urlencode($previousCurrent_url);?>" data-toggle="modal" class="btn   btn-default btn-block"><i class=" icon-mail-2"></i> Edit Items </a> </div>
                  <?php $usr = $this->nativesession->get('user');
					if(empty($usr)){ 
           			?>
                  <div class="user-ads-action"> <a href="#contactAdvertiser" data-toggle="modal" disabled="disabled" class="btn   btn-default btn-block"><i class=" icon-mail-2"></i> Send a message </a> </div>
                  <?php }else{?>
                	<div class="user-ads-action"> <a href="#contactAdvertiser" email="<?php echo $email;?>" 
                	firstName="<?php echo $firstName;?>" lastName="<?php echo $lastName;?>"
                	telNo="<?php echo $telNo;?>" phoneNo="<?php echo $phoneNo;?>"
                	 data-toggle="modal" class="btn   btn-default btn-block"><i class=" icon-mail-2"></i> Send a message </a> </div>
                  <?php }?>   
                </div>
              </div>
            </div>
            <div class="panel sidebar-panel panel-bevel pink-border">
              <div class="panel-heading"><i class="fa fa-shield"></i>&nbsp;&nbsp;&nbsp;Safety Tips for Buyers</div>
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
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/insertMessage/<?php echo $postID;?>?prevURL=<?php echo urlencode($previousCurrent_url);?>">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Name: <font color="red">*</font></label>
            <input class="form-control required"  maxlength="50" value="<?php echo $firstName; echo ' '.$lastName;?>" id="recipient-name" name="recipient-name"  required="true" placeholder="Your name" data-placement="top" data-trigger="manual" data-content="Must be at least 3 characters long, and must only contain letters." type="text">
          </div>
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
            <textarea class="form-control"  maxlength="300" required="true" id="message-text" name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
          </div>
          <div class="form-group">
            <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success pull-right" onclick="setup(); return false;">Send message!</button>
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
      <h2 ID="copytext">
			<?php echo $shareLink;?>
			</h2>
		<TEXTAREA ID="holdtext" STYLE="display:none;">
		</TEXTAREA>
		 </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success pull-right" onclick="ClipBoard()">Copy</button>
      </div>
    </div>
  </div>
</div>
<!-- Le javascript
================================================== --> 

<script>
function ClipBoard() 
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
<!-- Placed at the end of the document so the pages load faster --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"> </script><script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script> 

<!-- include carousel slider plugin  --> 
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script> 

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
<!-- include jquery.fs plugin for custom scroller and selecter  --> 
<script src="<?php echo base_url();?>assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js"></script>
<!-- include custom script for site  --> 
<script src="<?php echo base_url();?>assets/js/script.js"></script>

<?php include "footer2.php"; ?>
