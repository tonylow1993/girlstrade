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
            <h2 class="title-2"><i class="icon-hourglass"></i> <?php echo $this->lang->line("Inbox");?> </h2>
            <div class="table-responsive">
<!--               <div class="table-action"> -->
<!--                 <label for="checkAll"> -->
 <!--                  <input type="checkbox" onclick="checkAll(this)" id="checkAll"> -->
<!--                   Select: All  | <a href="#" class="btn btn-xs btn-danger">Delete <i class="glyphicon glyphicon-remove "></i></a> </label> -->
<!--                 <div class="table-search pull-right col-xs-7"> -->
<!--                   <div class="form-group"> -->
                    
<!--                   </div> -->
<!--                 </div> -->
<!--               </div> -->
              <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                    <th data-type="numeric" data-sort-initial="true"> </th>
                    <th> <?php echo $this->lang->line("From");?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Preview");?>  </th>
                    <th> <?php echo $this->lang->line("Reply");?>  </th>
                   </tr>
                </thead>
                <tbody>
                <?php 
                if($result<>null)
            	{
            		$rowCount=0;
                  	foreach($result as $id=>$row)
                  	{
                  		$enableMarkSoldBtn= $row["enableMarkSoldBtn"];
                  		$NoOfSoldUsers=0;
                  		$soldUsers=$row["soldUsers"];
                  		$soldUsersstr="  <select required=\"true\" class=\"form-control selecter\" name=\"soldUser\" id=\"soldUser\">  ";
                  		if($soldUsers!=null){
                  			$NoOfSoldUsers=count($soldUsers);
                  			foreach($soldUsers as $row1){
                  				$soldUserID=$row1->soldUserID;;
                  				$soldUsername=$row1->soldUsername;
                  				$soldUsersstr=$soldUsersstr."  <option  value='".$soldUserID."'  style='background-color:#E9E9E9;font-weight:bold;' > ".$soldUsername." </option>  ";
                  			}
                  		}
                  		$soldUsersstr=$soldUsersstr."  </select>  ";
                  		$soldUsersstr=base64_encode($soldUsersstr);
                  		$from=$row['from'];
                  		$reply=$row['reply'];
                  		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
                  		$previewTitle=$row['previewTitle'];
                  		$preview=trim($row["preview"]);
                  		
                  		$preview=trimLongText($preview);
                  		
                  		$previewDesc=trim($row["previewDesc"]);
                  		$postUserID=$row["postUserID"];
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		$status=$row['status'];
                  		$messageID=$row['messageID'];
                  		$commentID=$row['commentID'];
                  		$userID=$row["userID"];
                  		$NoOfDaysPending=$row['NoOfDaysPending'];
						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
						$postID=$row['postID'];
						$soldToUserID=$row["soldToUserID"];
						$soldToUserName=$row["soldToUserName"];
                		echo "<tr>";
                    	echo "<td style=\"width:5%\" class=\"add-img-selector\"><div class=\"checkbox\">";
                        echo "<label>";
                        echo "  <input type=\"checkbox\">";
                        echo "</label>";
                      	echo "</div></td>";
                    	echo "<td style=\"width:20%\">$from</td>";
                    	echo "<td style=\"width:60%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                       echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
                          echo "<br/>".$preview."<br/>Posted On: ". $createDate."</h5>";
                      	 	echo "</div></td>";
                      	$rowCount=$rowCount+1;
                      	$ctrlName1="AjaxLoad".$rowCount;
                      	$errorctrlName1="ErrAjaxLoad".$rowCount;
                      	$ctrlValue1="messageID".$rowCount;
                      	$ctrlValue2="userID".$rowCount;
                      	$clickLink="clickLink".$rowCount;
                    	echo "<td style=\"width:15%\" class=\"action-td\"><div>";
                    	echo "<p>";
                    	
                    	$usr = $this->nativesession->get('user');
                    	$fuserID=$row["fuserID"];
                    	$userID=$row["userID"];
                    	echo $status.$userID.$fuserID;
                    	if(!empty($usr)){
                    		if($usr["userID"]!=$fuserID || (strcmp($status,"R")==0 && $usr["userID"]!=$fuserID)){
                    			$fuserID=$row["userID"];
                    			$userID=$row["fuserID"];	
                    		}
                    	}
                    	echo $userID.$fuserID;
                    	$historyPath=base_url().MY_PATH."messages/getViewMessageHistory/$fuserID/$postID/$userID?prevURL=".urlencode(current_url());
                    	 
                    	echo "<a class=\"btn btn-info btn-xs\" href=\"$historyPath\" > <i class=\"fa fa-mail-forward\"></i>".$this->lang->line('History')." </a>";
                    	
                    	echo " <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
                    	echo "<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$messageID' />";
                    	echo "<input name='$ctrlValue2' id='$ctrlValue2' type='hidden' value='$userID' />";
                    	
                    	//$replyPath=base_url().MY_PATH."messages/replyInboxMessage/$messageID";
                    	if(strcmp($status,"OC")!=0 &&strcmp($status,"C")!=0 ){
            	        // $usr = $this->nativesession->get('user');
							if(!empty($usr)){ 
            					if(strcmp($status,"Op")==0){
						  			echo "<a class=\"btn btn-primary btn-xs\" href=\"#contactAdvertiser\" data-toggle=\"modal\" messageID='$messageID' postID='$postID'
						  			email='$email' firstName='$firstName' lastName='$lastName'
				                	telNo='$telNo' phoneNo='$phoneNo' > <i class=\"fa fa-edit\"></i> ".$this->lang->line('Reply')." </a>";
                    			}
                    			else 
                    			{
                    				echo "<a class=\"btn btn-primary btn-xs\" href=\"#contactAdvertiser\" data-toggle=\"modal\" messageID='$messageID' postID='$postID'
                    				email='$email' firstName='$firstName' lastName='$lastName'
                    				telNo='$telNo' phoneNo='$phoneNo' > <i class=\"fa fa-edit\"></i> ".$this->lang->line('Reply_Again')."</a>";
                    				 
                    			}
                    		}
                    	}
                    	$str=' ';
                    	//$usr = $this->nativesession->get('user');
                    	if(!empty($usr)){
                    			$checkUserID=$usr["userID"];
                    	}
//                     	if($enableMarkSoldBtn &&  $checkUserID==$userID)
//                     		$str="";
//                     	else
//                     		$str=" disabled='disabled' ";
                    	
//                     	IF((STRCMP($STATUS,"C")==0  && $CHECKUSERID==$FUSERID) ||  (STRCMP($STATUS, "R")==0 &&  $CHECKUSERID==$USERID ) ||
//                     			( (strcmp($status,"OC")==0 ||strcmp($status,"Op")==0 ) && $checkUserID==$fuserID))
                    		if($postUserID==$checkUserID)
                    		if($enableMarkSoldBtn) //  &&  ($checkUserID!=$userID || (strcmp($status, 'Op'))) )
                    			echo "<div class=\"user-ads-action\"><a class=\"btn btn-info btn-xs\"  data-toggle=\"modal\"  data-target=\"#markSoldAds\"  href=\"#markSoldAds\"  data-id=".$postID."  data-msgid=".$messageID."  data-solduserid=".$soldToUserID."  data-soldusername=".$soldToUserName."  data-soldusers=".$soldUsersstr."> <i class=\"fa fa-mail-forward\"></i>".$this->lang->line('MarkSold').$soldToUserID.$soldToUserName." </a></div>";
//                     	echo "<div class=\"user-ads-action\"><a class=\"btn btn-info btn-xs\"  data-toggle=\"modal\"  data-target=\"#markSoldAds\"  href=\"#markSoldAds\"  data-id=\"$postID\"  data-soldusername=\"$from\"  data-solduserID=\"$fuserID\"   data-soldusers=\"$soldUsersstr\"  $str> <i class=\"fa fa-mail-forward\"></i>".$this->lang->line('MarkSold')." </a></div>";
                    	 
                    	
			  			echo "</p></div></td>";
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
            	$itemPerPage=ITEMS_PER_PAGE;
            	if($NoOfItemCount>0)
            	{
            	if($pageNum<>1)
            		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev\">Previous</a></li>";
            	if($NoOfItemCount > 0)
            		echo "<li  class=\"active\"><a href=\"$url_path/$pageNum\">$pageNum</a></li>";
            	if($NoOfItemCount > ($pageNum*$itemPerPage))
            		echo "<li><a href=\"$url_path/$pageNum2\">$pageNum2</a></li>";
              	if($NoOfItemCount > ($pageNum2*$itemPerPage))
              		echo "<li><a href=\"$url_path/$pageNum3\">$pageNum3</a></li>";
              	if($NoOfItemCount > ($pageNum3*$itemPerPage))
              		echo "<li><a href=\"$url_path/$pageNum4\">$pageNum4</a></li>";
              	if($NoOfItemCount > ($pageNum4*$itemPerPage))
              		echo "<li><a href=\"$url_path/$pageNum5\">$pageNum5</a></li>";
              	if($NoOfItemCount > ($pageNum5*$itemPerPage))
              		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext\">Next</a></li>";
            	}
              ?>
                </ul>
          </div>
                </tbody>
              </table>
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
  <!-- Modal contactAdvertiser -->

<div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i> Contact advertiser </h4>
      </div>
      <div class="modal-body">
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/replyMessage/<?php echo $postID;?>/<?php echo $messageID;?>/inbox">
 <!--           <div class="form-group">
            <label for="recipient-name" class="control-label">Name: <font color="red">*</font></label>
            <input class="form-control required" value="<?php echo $firstName; echo ' '.$lastName;?>" id="recipient-name" name="recipient-name" required="true" placeholder="Your name" data-placement="top" data-trigger="manual" data-content="Must be at least 3 characters long, and must only contain letters." type="text">
          </div> -->
<!--           <div class="form-group"> -->
<!--             <label for="sender-email" class="control-label">E-mail: <font color="red">*</font></label> -->
   <!--          <input id="sender-email" name="sender-email" type="text" disabled="disabled" value="<?php echo $email;?>" data-content="Must be a valid e-mail address (user@gmail.com)" data-trigger="manual" data-placement="top" placeholder="email@you.com" required="true" class="form-control email">-->
<!--           </div> -->
<!--           <div class="form-group"> -->
<!--             <label for="recipient-Phone-Number"  class="control-label">Phone Number:</label> -->
      <!--       <input type="text"  maxlength="60" disabled="disabled" value="<?php echo $phoneNo;?>"class="form-control" id="recipient-Phone-Number" name="recipient-Phone-Number">-->
<!--           </div> -->
          <div class="form-group">
            <label for="message-text" class="control-label">Message <font color="red">*</font><span class="text-count">(300) </span>:</label>
            <textarea class="form-control"  rows="5" columns="30"  required="true" id="message-text" name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
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

<div class="modal fade" id="markSoldAds" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line("popupTitleMarkSold");?></h4>
      </div>
      <div class="modal-body">
        <form role="form" id="myitem" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/markSoldAdsInbox">
           <div class="form-group">
           		<input type="hidden"  id="postID"  name="postID" >   	
           		         	</div>
           	<div class="form-group">
           		<input type="hidden"  id="messageID"  name="messageID" >   	
           	</div>
			<div class="form-group">
           		<input type="hidden"  id="soldUserID"  name="soldUserID" >   	
           	</div>
<!--           <div class="form-group"> -->
<!--          	<label for="soldUser" class="control-label">Sold To<font color="red">*</font></label> -->
<!--          	<div   id="divSoldUser" name="divSoldUser"  class="center"> -->
         		
<!--          	</div> -->
<!--          	<div id="soldUserError" name="soldUserError"></div> -->
<!--            </div> -->
            <div class="form-group">
         	<label class="control-label">Sold To</label>
         			<input type="text"  id="soldUserName" name="soldUserName"   class="form-control"></input>
         	</div>
             <div class="form-group">
             	<label  for="rating" class="control-label">Rating<font color="red">*</font></label>
         		 <select required="true" class="form-control selecter" name="rating" id="rating">
        				<option value='3'  style='background-color:#E9E9E9;font-weight:bold;' > Good</option>
        				<option value='2'  style='background-color:#E9E9E9;font-weight:bold;' > Bad </option>
        				<option value='1'  style='background-color:#E9E9E9;font-weight:bold;' > Average </option>
        		</select>
        		<div id="ratingError" name="ratingError" ></div>
        	</div>
        	  
        	<div class="form-group">
             	<label  for="soldqty" class="control-label">Quantity<font color="red">*</font></label>
         		<select required="true" class="form-control selecter" name="soldqty" id="soldqty">
        				  <option value="1"> 1 </option>
                                   <option value="2"> 2 </option>
        		</select>
        		<div id="soldqtyError" name="soldqtyError" ></div>
        	</div>
        	 <div class="form-group">
            <label for="message-text" class="control-label">Message <span class="text-count">(300) </span>:</label>
            <textarea class="form-control"  id="message-text"  maxlength="300"  rows="5" columns="30"  name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
          </div>
         	
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success pull-right"   onclick="setupSold(); return false;">Submit</button>
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
function passToModal() {
   $("#markSoldAds").on("show.bs.modal", function(event) {
        $("#postID").val($(event.relatedTarget).data("id"));
        $("#messageID").val($(event.relatedTarget).data("msgid"));
        $("#soldUserID").val($(event.relatedTarget).data("solduserid"));
        $("#soldUserName").val($(event.relatedTarget).data("soldusername"));
        
  //       $("#divSoldUser").html( jsbase64_decode($(event.relatedTarget).data("soldusers")));
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

function setupSold()
{
// 	 if(document.getElementById("soldUser").value=="") {
// 		 $("soldUserError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Please select sold to person!</span></em>');
// 		 location.href ="#markSoldAds";
// 		 return false;
// 	 }
	if( document.getElementById("rating").value=="") {
		$("ratingError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Please select rating!</span></em>');
		 location.href ="#markSoldAds";
		 return false;
	}
     var myform = document.getElementById("myitem");
	  	document.getElementById("myitem").submit();
       	return true;
}
function setup()
{
        var myform = document.getElementById("item");
	  	document.getElementById("item").submit();
       	return true;
}
function reply(ctrlValue1, ctrlValue2, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/replyInboxMessage",
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

