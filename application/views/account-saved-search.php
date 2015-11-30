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
            <h2 class="title-2"><i class="icon-star-circled"></i> <?php echo $this->lang->line("Saved_Search");?> </h2>
             <div class="table-responsive">
              <div class="table-action">
                <label for="checkAll">
                  <input type="checkbox" onclick="checkAll(this)" id="checkAll">
                  Select: All | <a href="#" class="btn btn-xs btn-danger">Cancel <i class="glyphicon glyphicon-remove "></i></a> </label>
                <div class="table-search pull-right col-xs-7">
                  <div class="form-group">
                   
                  </div>
                </div>
              </div>
             <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                    <th data-type="numeric" data-sort-initial="true"> </th>
                    <th> <?php echo $this->lang->line("Photo");?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Item_Detail");?> </th>
                    <th> <?php echo $this->lang->line("Status");?> </th><th> <?php echo $this->lang->line("Cancel");?> </th>
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
                  		$NoOfDaysPending=$row['NoOfDaysPending'];
						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
                		echo "<tr>";
                    	echo "<td style=\"width:5%\" class=\"add-img-selector\"><div class=\"checkbox\">";
                        echo "<label>";
                        echo "  <input type=\"checkbox\">";
                        echo "</label>";
                      	echo "</div></td>";
                      	echo "<td style=\"width:20%\" class=\"add-image\">";
                      	echo "<a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                    	echo "</td>";
                      	echo "<td style=\"width:60%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";;
                      echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
                          echo "<br/>Posted On: ". $createDate."</h5>";
                    	echo "</div></td>";
                      	echo "<td style=\"width:5%\">$itemStatus</td>";
                      	$rowCount=$rowCount+1;
                    	$ctrlName1="AjaxLoad".$rowCount;
						$errorctrlName1="ErrAjaxLoad".$rowCount;
						$ctrlValue1="messageID".$rowCount;
						$clickLink="clickLink".$rowCount;
						
				      	echo "<td style=\"width:10%\" class=\"action-td\"><div>";
						echo "<p>";
						echo " <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
						echo "<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$messageID' />";
						echo "<a class=\"btn btn-primary btn-xs\" href=\"javascript:cancelAds('$ctrlValue1','$ctrlName1', '$errorctrlName1')\" id='$clickLink'> <i class=\"fa fa-trash\"></i> ".$this->lang->line('Cancel') ."</a></p>";
                      echo "</div></td>";
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
            </div>
        </div>
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
  <!-- /.main-container -->
  
  <?php include "footer1.php"; ?>
  <!--/.footer--> 
</div>
<!-- /.wrapper --> 
<script>

function cancelAds(ctrlValue1, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>messages/cancelSavedAds",
		data: { messageID: $( "#".concat(ctrlValue1) ).val()},
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
