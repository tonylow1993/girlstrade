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
            <div style="position:relative;"><h2 class="title-2"><i class="icon-mail"></i> <?php echo $this->lang->line("Inbox");?> <?php include("sort-dropdown.php");?></h2></div>
            <div>

		<!-- table-striped -->	
              <div id="addManageTable" class="table  table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <div class="inbox-title">
                    <span class="from-span inbox-title-span"> <?php echo $this->lang->line("From");?> </span>
                    <span class="msg-span inbox-title-span" data-sort-ignore="true"> <?php echo $this->lang->line("Preview");?>  </span>
					<span class="date-span inbox-title-span" data-sort-ignore="true"> Date  </span>
                </div>
                <?php 
                if($result<>null)
            	{
            		$rowCount=0;
                  	foreach($result as $id=>$row)
                  	{
                  		$createDate=$row['createDate'];
                  		$status=$row['status'];
                  		$userID=$row["userID"];
                  		$fromUserID=$row["fromUserID"];
                  		if(strcmp($row["type"], "Inbox")==0){
                  			$userID=$row["fromUserID"];
                  			$fromUserID=$row["userID"];
                  		}
                  		
                  		
                  		$username=$row["username"];
                  		$fromusername=$row["fromusername"];
                  		$fromEmail=$row["fromEmail"];
                  		$content=$row["content"];
                  		$readflag="";
						$rowCount=$rowCount+1;
						$trId="trId_".$rowCount;
						$unreadCount=$row["unreadCount"];
                		if(strcmp($row["readflag"],"N")==0)
							$readflag="bgcolor='".UnReadInBoxBgColor."' onclick=\"editData($id, $pageNum, '$trId')\"";
						$urlPath=base_url().MY_PATH."home/getAccountPage/14/1/0/1/$fromUserID?prevURL=".urlencode(current_url()); 
						//echo "<form class=\"form-horizontal\" method=\"post\"  enctype=\"multipart/form-data\" action=\"$urlPath\"> "; 
						//echo "<div class=\"msg-box\" id=".$trId." name=".$trId." ".$readflag." href=\"#replyPopup\" data-toggle=\"modal\" data-id=\"$fromUserID\" data-pagenum=\"$pageNum\">";
						 
						echo "<div class=\"msg-box\" id=".$trId." name=".$trId." ".$readflag." >";
                    	echo "<span class=\"from-span\"><p class=\"box-from\"><a href=$urlPath >$fromusername</a><br/>$username";
                    	if($row["unreadCount"] >0)
                    		echo "<span class=\"badge\">$unreadCount</span>";
                    	echo "</p>";
                    	//echo "<a class=\"btn btn-primary btn-xs btn-120\" href=\"#replyPopup\" data-toggle=\"modal\" data-id=\"$fromUserID\" data-pagenum=\"$pageNum\"> <i class=\"fa fa-edit\"></i> ".$this->lang->line('Reply')." </a>";
                    	//echo "<input type='hidden' id='fromUserID' name='fromUserID' value=$fromUserID />";
                    	//echo "<input type='hidden' id='userID' name='userID' value=$userID />";
                    	//echo "<input type='submit' />"; 
                    	//echo "</form>";
                    	echo "</span>";
                    	 
                    	
                    	echo "<span class=\"msg-span\">";
                        echo "<p class=\"box-msg\">".$content;
                      	echo "</p></span>";
							
                      	echo "<span class=\"date-span\">";
                        echo "<p class=\"box-date\">". $createDate."</p>";
                      	echo "</span>";
                      	
                  		echo "</div>";
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
              </div>
            </div>
            <!--/.row-box End--> 
        

         
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  
  <!-- /.main-container -->
  <!-- Modal contactAdvertiser -->
</div>

<div class="modal fade" id="replyPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i> Reply </h4>
      </div>
      <div class="modal-body">
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>home/insertBuyerMessage/Inbox">
			<div class="form-group">
          		<input type="hidden" id="userID_1" name="userID_1" />
          		<input type="hidden" id="pageNum_1" name="pageNum_1" />
          		
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message <font color="red">*</font><span class="text-count">(<?php echo DESCLENGTHININBOX;?>) </span>:</label>
            <textarea style="vertical-align: top; horizontal-align: left; resize:none;" class="form-control"  rows="5" columns="30" maxlength="<?php echo DESCLENGTHININBOX;?>"  required="true" id="message-text_1" name="message-text_1"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
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
function editData(id, pageNo, trId)
{
 	$.ajax({
		method: "POST",
		url: "<?php echo base_url().MY_PATH;?>home/updateReadInboxBuyerMessage",
		data: { messageID: id , pageNum: pageNo},
		success: function(response){
			//location.href="<?php echo base_url().MY_PATH;?>home/getAccountPage/1/".concat(pageNo);
			var result = JSON.parse(response);
	    	$("#".concat(trId)).attr("bgcolor", "");
	    	$("#".concat(trId)).on("click", function(event) { return false;});
	    	
	    //	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
    
}
function passToModal() {
	   $("#replyPopup").on("show.bs.modal", function(event) {
	        $("#userID_1").val($(event.relatedTarget).data("id"));
	        $("#pageNum_1").val($(event.relatedTarget).data("pagenum"));
	    });
	}
	$(document).ready(passToModal());
function setup()
{
        var myform = document.getElementById("item");
	  	document.getElementById("item").submit();
       	return true;
}

</script>




<?php include "footer2.php"; ?>

