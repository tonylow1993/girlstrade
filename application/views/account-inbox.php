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
                		$from=$row['from'];
                  		$reply=$row['reply'];
                  		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
                  		$previewTitle=$row['previewTitle'];
                  		$previewDesc=$row["previewDesc"];
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		$status=$row['status'];
                  		$messageID=$id;
                  		$NoOfDaysPending=$row['NoOfDaysPending'];
						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
						$postID=$row['postID'];
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
                          echo "<br/>Posted On: ". $createDate."</h5>";
                      	 	echo "</div></td>";
                      	$rowCount=$rowCount+1;
                      	$ctrlName1="AjaxLoad".$rowCount;
                      	$errorctrlName1="ErrAjaxLoad".$rowCount;
                      	$ctrlValue1="messageID".$rowCount;
                      	$ctrlValue2="userID".$rowCount;
                      	$clickLink="clickLink".$rowCount;
                    	echo "<td style=\"width:15%\" class=\"action-td\"><div>";
                    	echo "<p>";
                    	echo " <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
                    	echo "<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$messageID' />";
                    	echo "<input name='$ctrlValue2' id='$ctrlValue2' type='hidden' value='$userID' />";
                    	
                    	$replyPath=base_url().MY_PATH."messages\replyInboxMessage\$message";
                    	if(strcmp($status,"OC")!=0 &&strcmp($status,"C")!=0 ){
            	         $usr = $this->nativesession->get('user');
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
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/replyMessage/<?php echo $postID;?>/<?php echo $messageID;?>">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Name: <font color="red">*</font></label>
            <input class="form-control required" value="<?php echo $firstName; echo ' '.$lastName;?>" id="recipient-name" name="recipient-name" required="true" placeholder="Your name" data-placement="top" data-trigger="manual" data-content="Must be at least 3 characters long, and must only contain letters." type="text">
          </div>
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
            <textarea class="form-control" required="true" id="message-text" name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
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
  <?php include "footer1.php"; ?>
  <!--/.footer--> 
</div>
<!-- /.wrapper --> 
<script>
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

