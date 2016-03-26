<?php $title = "Girls' Trading Platform"; 
  include("header.php"); ?>
  
   
<div id="wrapper">
  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <?php include("account_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
          <?php include("profile_header.php");?>
          <div class="inner-box">
          	  <?php include("profile_visit.php");?>
            <h2 class="title-2"><i class="icon-docs"></i> <?php  echo $this->lang->line("MyAds");?> </h2>
            <div class="table-responsive">
<!--               <div class="table-action"> -->
<!--                 <label for="checkAll"> -->
 <!--                  <input type="checkbox" onclick="checkAll(this)" id="checkAll"> -->
<!--                   Select: All | <a href="#" class="btn btn-xs btn-danger">Delete <i class="glyphicon glyphicon-remove "></i></a> </label> -->
<!--                 <div class="table-search pull-right col-xs-7"> -->
<!--                   <div class="form-group"> -->
                    
<!--                   </div> -->
<!--                 </div> -->
<!--               </div> -->
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
            		$rowCount=0;
                  	foreach($result as $id=>$row)
                  	{
                  		$from=$row['from'];
                  		$reply=$row['reply'];
                  		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url())."&prevItem_Url=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
                  		$preview=$row['preview'];
                  		$previewTitle=$row['previewTitle'];
                  		$previewDesc=$row["previewDesc"];
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		$messageID=$id;
                  		$postID=$row['postID'];
                  		$status=$row["status"];
                  		$userID=$row['userID'];
                  		$rejectReason=$row['rejectReason'];
                  		$rejectSpecifiedReason=$row['rejectSpecifiedReason'];
                  		$NoOfDaysPending=$row['NoOfDaysPending'];
						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
						$NoOfSoldUsers=0;
						$enableMarkSoldBtn= $row["enableMarkSoldBtn"];
						$enableRepostBtn=$row["enableRepostBtn"];
						$nextexpirydate=$row["nextexpirydate"];
                  		$soldUsers=$row["soldUsers"];
						$soldUsersstr="  <select required=\"true\" class=\"form-control selecter\" name=\"soldUser\" id=\"soldUser\">  ";
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
						echo "<tr>";
                      	echo "<td style=\"width:20%;height:150px;padding:0px; margin: 0px; border: none;\"  class=\"add-image\">";
//                       	echo  "<div class=\"col-sm-2 no-padding photobox\">";
// 						echo "<div style=\"position:relative; height:75px; width: 100%; overlfow:hidden;\">";
                  	if (file_exists($imagePath)) {
					
                      	$sizeimage=getimagesize($imagePath);
                      	echo "<p style=\"font-size:8px;padding:0px; margin: 0px;\">image size: ".$sizeimage[0]."x".$sizeimage[1]."</p>";
                      	if($sizeimage[1]>300)
                      	{
                      		$ratio= 100*300/ $sizeimage[1];
                      		if($sizeimage[0]>90* 300/ $sizeimage[1])
                      			echo "<a href=$viewItemPath  style=\"padding:0px; margin: 0px;\" ><img style=\"height:100%; width:".$ratio."%; padding:0px; margin:0px;\"  class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                      		else 
                      		echo "<a href=$viewItemPath  style=\"padding:0px; margin: 0px;\" ><img style=\"height:100%; width:auto; padding:0px; margin:0px;\"  class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                      	}else 
								echo "<a href=$viewItemPath  style=\"padding:0px; margin: 0px;\" ><img style=\"height:auto; padding:0px; margin:0px;\"  class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                  	}else
                  	{
                  		$imagePath = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
						echo "<a href=$viewItemPath  style=\"padding:0px; margin: 0px;\" ><img style=\"height:auto; padding:0px; margin:0px;\"  class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                  	}	
//                       	echo "</div>";
                      	
//                       	echo "<a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                    	echo "<p class=\"price-td\">".$this->lang->line("Price")." :$price</p>";
						$editPath=base_url().MY_PATH."newPost/showEditPost/".$messageID."?prevURL=".urlencode(current_url());
						$sharePath=base_url().MY_PATH."messages/shareMyAds/".$messageID."/".$userID;
						$deletePath=base_url().MY_PATH."messages/deleteMyAds/".$messageID."/".$userID;
						
						$rowCount=$rowCount+1;
						$ctrlName1="AjaxLoad".$rowCount;
						$errorctrlName1="ErrAjaxLoad".$rowCount;
						$ctrlValue1="messageID".$rowCount;
						$ctrlValue2="userID".$rowCount;
						$clickLink="clickLink".$rowCount;
						$shareLink=base_url().MY_PATH."viewItem/index/".$postID;
						//echo "<p><a class=\"btn btn-primary btn-xs\" href=$editPath> <i class=\"fa fa-edit\"></i> ".$this->lang->line('Edit')." </a></p>";
						if(strcmp($status, "Rejected")!=0 && strcmp($status, "Unverified")!=0 && strcmp($status, "Closed")!=0){
							echo "<p> <a class=\"btn btn-info btn-xs btn-120\" href=\"#shareAds\"  data-toggle=\"modal\" data-sharelink='$shareLink'> <i class=\"fa fa-mail-forward\"></i> ".$this->lang->line('Share')." </a></p>";
						}
						echo "<p>";
                        		
                        echo " <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
                    	echo "<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$messageID' />";
                    	echo "<input name='$ctrlValue2' id='$ctrlValue2' type='hidden' value='$userID' />";
                    	if(strcmp($status, "Open")==0 or strcmp($status, "Expired")==0)
                    	echo "<div class=\"user-ads-action\"><a class=\"btn btn-danger btn-xs btn-120\"  href=\"#deleteAdsPopup\" data-toggle=\"modal\" id='$clickLink' data-id=\"$messageID\" data-userID=\"$userID\"> <i class=\" fa fa-trash\"></i> ".$this->lang->line('Delete')." </a></div></p>";
                    	
                        //echo "<a class=\"btn btn-danger btn-xs\"  href=\"javascript:deleteAds('$ctrlValue1','$ctrlValue2', '$ctrlName1', '$errorctrlName1)'\" id='$clickLink'> <i class=\" fa fa-trash\"></i> ".$this->lang->line('Delete')." </a></p>";
                     	if($enableMarkSoldBtn)
                        	echo "<p><div class=\"user-ads-action\"><a class=\"btn btn-inverse btn-xs btn-120\"  data-toggle=\"modal\"   href=\"#markSoldAds\"  data-id=\"$messageID\"  data-soldusers=\"$soldUsersstr\"> <i class=\"fa fa-thumb-tack\"></i> ".$this->lang->line('MarkSold')." </a></div></p>";
                        if($enableRepostBtn)
                        	echo "<p><div class=\"user-ads-action\"><a class=\"btn btn-inverse btn-xs btn-120\"  data-toggle=\"modal\"   href=\"#confirmRepost\"  data-id=\"$messageID\" data-nextexpirydate=\"$nextexpirydate\" data-pagenum=\"$pageNum\"> <i class=\"fa fa-repeat\"></i> Repost</a></div></p>";
                        	
                        echo "</div></td>";
                      	echo "<td style=\"width:55%; border: none;\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                         echo "<h5><div class=\"add-title-girlstrade\"><u>".$previewTitle."</u></div>".$previewDesc."<br/>".$preview;
                         $datePost = strtotime($createDate); 
                         echo "<br/>Posted On: ". date("M d, Y", $datePost)."<br/>Status: ";
                          
                          if(strcmp($status, "Open")==0)
                          {
                          	echo "<font color=\"green\">".$status."</font>";
                          }else if(strcmp($status, "Rejected")==0)
                          {
                          	echo "<font color=\"red\">".$status."</font>";
                          }else if(strcmp($status, "Unverified")==0)
                          {
                          	echo "<font color=\"pink\">".$status."</font>";
                          }else {
                          	echo "<font color=\"grey\">".$status."</font>";
                          }
                          
                   	  echo "<br/>Interested Buyer:  $NoOfSoldUsers";
                        if(strcmp($status, "Rejected")==0){
                        	echo "<br/><font color=\"red\">Reject Reason: ".$rejectReason.": ".$rejectSpecifiedReason."</font>";
                        }
                        echo "</div></h5></td>";
                      	
                  		echo "</tr>";
                  	}
            	}
                  ?>
                  
                   <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$url_path=base_url().MY_PATH."home/getAccountPage/".$activeNav;
            	$pageNumPrev=$pageNum-1;
            	$pageNum2=$pageNum+1;
            	$pageNum3=$pageNum+2;
            	$pageNum4=$pageNum+3;
            	$pageNum5=$pageNum+4;
            	$pageNumNext=$pageNum+5;
            	if($pageNum<>1)
            		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev\">Previous</a></li>";
            	echo "<li  class=\"active\"><a href=\"$url_path/$pageNum\">$pageNum</a></li>";
            	echo "<li><a href=\"$url_path/$pageNum2\">$pageNum2</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum3\">$pageNum3</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum4\">$pageNum4</a></li>";
              	echo "<li><a href=\"$url_path/$pageNum5\">$pageNum5</a></li>";
              
               echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext\">Next</a></li>";
            ?>
                </ul>
          </div>
                </tbody>
              </table>
              
              <div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" tabindex="-1" role="dialog"  data-keyboard="false" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1>Processing...<?php echo $this->lang->line("PleaseNotCloseBrowse");?> <img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif"></h1>
                                </div>
                                <div class="modal-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">   
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
        
              
            </div>
            <!--/.row-box End--> 
            
          </div>
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
  <!-- /.main-container -->
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
		<input style="width: 500px; height: 100px;font-size:20" class="js-copytextarea" id="holdtext" name="holdtext">
		 </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
        <button type="button" class="js-textareacopybtn btn btn-success pull-right">Copy</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="confirmRepost" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Confirm Repost </h4>
      </div>
      <div class="modal-body">
      	<form role="form" id="itemRepost" method="post" action="<?php echo base_url(); echo MY_PATH;?>home/updateRepost">
           <div class="form-group">
           		<input type="hidden" id="postID" name="postID" > 
           		<input type="hidden" id="pageNum" name="pageNum" >   	
           	</div>
           	<div class="form-group">
           		<input id="nextExpiryDate" name="nextExpiryDate" >
           	</div>
         </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
        <button type="button" class="btn btn-success pull-right" onclick="repost(); return false;" >Repost</button>
        	<button id="validate" hidden="true" type="submit"></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="markSoldAds" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line("popupTitleMarkSold");?></h4>
      </div>
      <div class="modal-body">
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/markSoldAds">
           <div class="form-group">
           		<input type="hidden" id="postID" name="postID" >   	
           	</div>
          <div class="form-group">
         	<label for="soldUser" class="control-label">Sold To<font color="red">*</font></label>
         	<div   id="divSoldUser" name="divSoldUser"  class="center">
         	
         	</div>
         	<div id="soldUserError" name="soldUserError"></div>
           </div>
             <div class="form-group">
             	<label  for="rating" class="control-label">Rating<font color="red">*</font></label>
         		 <select required="true" class="form-control selecter" name="rating" id="rating">
        		<?php 
        			foreach(getRatingArray() as $rateID=>$rateName){
         		 		echo "<option value='$rateID'  style='background-color:#E9E9E9;font-weight:bold;' > $rateName</option>";
         		 	}
         		 	?>
         		 	</select>
        		<div id="ratingError" name="ratingError" ></div>
        	</div>
        	<div class="form-group">
             	<label  for="soldqty" class="control-label">Quantity<font color="red">*</font></label>
         		<select required="true" class="form-control selecter" name="soldqty" id="soldqty">
        				<?php 
        				  	for ($x = 1; $x <= MAXSOLDQTY; $x++)
        				  		echo "<option value=$x> $x </option>";
        				  ?>
		        </select>
        		<div id="soldqtyError" name="soldqtyError" ></div>
        	</div>
        	
        	 <div class="form-group">
            <label for="message-text" class="control-label">Message <span class="text-count">(<?php echo DESCLENGTHINMYADS;?>) </span>:</label>
            <textarea class="form-control"  id="message-text"  maxlength="<?php echo DESCLENGTHINMYADS;?>"  rows="5" columns="30"  name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
          </div>
         	
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success pull-right"   onclick="setup(); return false;">Submit</button>
        	<button id="validate" hidden="true" type="submit"></button>
  
     	 </div>
    </div>
  </div>
</div>


<div class="modal fade" id="deleteAdsPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 id="modal-title-del" class="modal-title"><?php echo $this->lang->line("popupTitleDeleteAds");?></h2>
      </div>
      <div class="modal-body">
        <form role="form" id="itemDelete" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/deleteMyAds">
           <div class="form-group">
           		<input type="hidden" id="messageID" name="messageID" >   	
           		<input type="hidden" id="userID" name="userID" >   
           			
           	</div>
        </form>
      </div>
      <div class="modal-footer">
		<button id="fwd-btn" class="btn btn-primary btn-tw" onclick="location.reload();" style="display: none;"><i class="fa fa-check"></i> Confirm</button>
      	<button id="cancel-btn" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="submit-btn" type="button" class="btn btn-success pull-right"   onclick="setupDeleteAds(); return false;">Submit</button>
        	<button id="validate" hidden="true" type="submit"></button>
  
     	 </div>
    </div>
  </div>
</div>

 <?php include "footer1.php"; ?>
  <!--/.footer--> 
</div>
<!-- /.wrapper --> 
<script>
var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.js-copytextarea');
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
       //location.href=copyTextarea.innerHTML;
           //"http://localhost:8888/girlstrade/index.php/viewItem/index/1"; 
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
  }
});
function passToModal() {
    $('#markSoldAds').on('show.bs.modal', function(event) {
        $("#postID").val($(event.relatedTarget).data('id'));
         $("#divSoldUser").html(jsbase64_decode($(event.relatedTarget).data('soldusers')));
    });
    $('#confirmRepost').on('show.bs.modal', function(event) {
        $("#postID").val($(event.relatedTarget).data('id'));
        $("#pageNum").val($(event.relatedTarget).data('pagenum'));
         $("#nextExpiryDate").val($(event.relatedTarget).data('nextexpirydate'));
    });
    $('#deleteAdsPopup').on('show.bs.modal', function(event) {
        $("#messageID").val($(event.relatedTarget).data('id'));
        $("#userID").val($(event.relatedTarget).data('userID'));
    });

    $('#shareAds').on('show.bs.modal', function(event) {
        $("#holdtext").val($(event.relatedTarget).data('sharelink'));
    });
}
$(document).ready(passToModal());
    
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
function setupDeleteAds()
{
	$("#modal-title-del").html("Processing...");
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/deleteMyAds",
		data: { 
			messageID: $("#messageID").val(),
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

function setup()
{
	 if(document.getElementById("soldUser").value=="") {
		 $("soldUserError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Please select sold to person!</span></em>');
		 location.href ="#markSoldAds";
		 return false;
	 }
	if( document.getElementById("rating").value=="") {
		$("ratingError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Please select rating!</span></em>');
		 location.href ="#markSoldAds";
		 return false;
	}
     var myform = document.getElementById("item");
	  	document.getElementById("item").submit();
       	return true;
}
function repost(){
	var myform = document.getElementById("itemRepost");
  	document.getElementById("itemRepost").submit();
   	return true;
}
function ClipBoard() 
{
holdtext.innerText = copytext.innerText;
Copied = holdtext.createTextRange();
Copied.execCommand("Copy");
}
function showWaitDialog() {
	 $('#pleaseWaitDialog').modal('show');
}

function deleteAds(ctrlValue1, ctrlValue2, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/deleteMyAds",
		data: { messageID: $( "#".concat(ctrlValue1) ).val(),
		userID: $( "#".concat(ctrlValue2) ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
};
</script>

<!-- include custom script for ads table [select all checkbox]  --> 
<script>
     
function checkAll(bx) {
  var chkinput = document.getElementsByTagName('input');
  for(var i=0; i < chkinput.length; i++) {
    if(chkinput[i].type == 'checkbox') {
      chkinput[i].checked = bx.checked;
    }
  }
}

</script> 

<?php include "footer2.php"; ?>

