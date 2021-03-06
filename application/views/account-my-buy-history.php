<?php $title = "Buyer List History - GirlsTrade"; 
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
           <h2 class="title-2"><i class="icon-folder-close"></i> <?php  echo $this->lang->line("BuyAdsHistory");?> </h2>
            <div class="table-responsive">
<!--               <div class="table-action"> -->
<!--                 <label for="checkAll"> -->
 <!--                  <input type="checkbox" onclick="checkAll(this)" id="checkAll"> -->
<!--                   Select: All | <a href="#" class="btn btn-xs btn-danger">Cancel <i class="glyphicon glyphicon-remove "></i></a> </label> -->
<!--                 <div class="table-search pull-right col-xs-7"> -->
<!--                   <div class="form-group"> -->
                    
<!--                   </div> -->
<!--                 </div> -->
<!--               </div> -->
              <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line("Reply"); ?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Ads_Detail"); ?> </th>
        	      </tr>
                </thead>
                <tbody>
                  <?php 
                  if($result<>null)
            	{
            		foreach($result as $id=>$row)
                  	{
                		$from=$row['from'];
                  		$reply=$row['reply'];
                  		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url())."&prevItem_Url=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
                  		$checkImgFile=$row['checkImgFile'];
                  		 
                  		$preview=$row['preview'];
                  		$previewTitle=$row['previewTitle'];
                  		$previewDesc=$row["previewDesc"];
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		$commentID=$row["commentID"];
                  		$enableMarkSoldBtn=$row["enableMarkSoldBtn"];
//                   		$NoOfDaysPending=$row['NoOfDaysPending'];
// 						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
                		echo "<tr>";
                       	echo "<td style=\"width:20%\" class=\"add-image\">";
                       	if (is_file_exists($checkImgFile)) {
                      		echo "<a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                       	}else
                       	{
                       		$imagePath = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
                       		echo "<a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                       	}
                      	echo "<p class=\"price-td\">$reply</p>";
                    	if($enableMarkSoldBtn)
                    		echo "<p><div class=\"user-ads-action\"><a class=\"btn btn-inverse btn-xs btn-120\"  data-toggle=\"modal\"   href=\"#markSoldAds\"  data-id=\"$commentID\"  data-seller=\"$from\"> <i class=\"fa fa-thumb-tack\"></i> ".$this->lang->line('MarkSold')." </a></div></p>";
                    	
                      	echo "</td>";
                      	echo "<td style=\"width:55%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                       echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
                          echo "<br/>Posted On: ". $createDate;
                          echo "<br/>".$preview."</h5>";
                    		echo "</div></td>";
//                      	$cancelPath=base_url().MY_PATH."messages/cancelArchivedAds/$messageID";
						//echo "<td style=\"width:10%\" class=\"action-td\"><div>";
// 						echo "<p> <a class=\"btn btn-primary btn-xs\" href=$cancelPath> <i class=\"fa fa-edit\"></i> ".$this->lang->line('Cancel')." </a></p>";
					//	echo "<p><div class=\"user-ads-action\"><a class=\"btn btn-info btn-xs\"  data-toggle=\"modal\"   href=\"#markSoldAds\"  data-id=\"$commentID\"  > <i class=\"fa fa-mail-forward\"></i>".$this->lang->line('MarkSold')." </a></div></p>";
                    	echo "</td>";
                  		echo "</tr>";
                  	}
            	}
                  ?>
                  <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$encodeCurrentURL=urlencode(current_url());
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
  
  <div class="modal fade" id="markSoldAds" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line("popupTitleMarkSold");?></h4>
      </div>
      <div class="modal-body">
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/markBuyerComment">
           <div class="form-group">
           		<input type="hidden" id="commentID" name="commentID" >   	
           	</div>
        <div class="form-group">
           		<input type="hidden" id="redirectPage" name="redirectPage"  value="account-my-buy-history.php"">   	
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
            <label for="message-text" class="control-label">Message <span class="text-count">(300) </span>:</label>
            <textarea style="vertical-align: top; horizontal-align: left; resize:none;" class="form-control"  id="message-text"  maxlength="300"  rows="5" columns="30"  name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
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
  <!-- /.main-container -->
 <?php include "footer1.php"; ?>
 </div>

<script type="text/javascript">
function passToModal() {
	  $('#markSoldAds').on('show.bs.modal', function(event) {
	        $("#commentID").val($(event.relatedTarget).data('id'));
	    });
}
$(document).ready(passToModal());

function setup()
{
	
	if( document.getElementById("rating").value=="") {
		$("ratingError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Please select rating!</span></em>');
		 location.href ="#markSoldAds";
		 return false;
	}
     var myform = document.getElementById("item");
	  	document.getElementById("item").submit();
       	return true;
}


  $(function () {
    $('#addManageTable').footable().bind('footable_filtering', function (e) {
      var selected = $('.filter-status').find(':selected').text();
      if (selected && selected.length > 0) {
        e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
        e.clear = !e.filter;
      }
    });

    $('.clear-filter').click(function (e) {
      e.preventDefault();
      $('.filter-status').val('');
      $('table.demo').trigger('footable_clear_filter');
    });
   
  });
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






