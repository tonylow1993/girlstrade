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
           <h2 class="title-2"><i class="icon-folder-close"></i> <?php  echo $this->lang->line("ArchivedAds");?> </h2>
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
                    <th data-type="numeric" data-sort-initial="true"> </th>
          <!--           <th> <?php echo $this->lang->line("From"); ?> </th-->
                    ><th> <?php echo $this->lang->line("Photo"); ?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Ads_Detail"); ?> </th>
         <!--            <th> <?php  echo $this->lang->line("Option");?> </th> -->
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
                  		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
                  		$previewTitle=$row['previewTitle'];
                  		$previewDesc=$row["previewDesc"];
                  		$preview=$row['preview'];
                  		
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		//$soldToUserName=$row["soldToUserName"];
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
                      	//echo "<td style=\"width:10%\">$soldToUserName</td>";
                    	echo "<td style=\"width:20%\" class=\"add-image\">";
                      	echo "<a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
                    	echo "</td>";
                      	echo "<td style=\"width:55%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                         echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
                          echo "<br/>Posted On: ". $createDate."<br/>".$preview."</h5>";
                          echo "</div></td>";
                     	$cancelPath=base_url().MY_PATH."messages/cancelArchivedAds/$messageID";
						//echo "<td style=\"width:10%\" class=\"action-td\"><div>";
						//echo "<p> <a class=\"btn btn-primary btn-xs\" href=$cancelPath> <i class=\"fa fa-edit\"></i> ".$this->lang->line('Cancel')." </a></p>";
// 						$str=' ';
// 						if($enableMarkSoldBtn)
// 							$str="";
// 						else
// 							$str=" disabled='disabled' ";
						
// 						echo "<p><div class=\"user-ads-action\"><a class=\"btn btn-info btn-xs\"  data-toggle=\"modal\"   href=\"#markSoldAds\"  data-id=\"$messageID\"  data-soldusers=\"$soldUsersstr\"  $str> <i class=\"fa fa-mail-forward\"></i>".$this->lang->line('MarkSold')." </a></div></p>";
						
// 						echo "</div></td>";
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
        				<option value='3'  style='background-color:#E9E9E9;font-weight:bold;' > Good</option>
        				<option value='2'  style='background-color:#E9E9E9;font-weight:bold;' > Bad </option>
        				<option value='1'  style='background-color:#E9E9E9;font-weight:bold;' > Average </option>
        		</select>
        		<div id="ratingError" name="ratingError" ></div>
        	</div>
        	<div class="form-group">
             	<label  for="soldqty" class="control-label">Quantity<font color="red">*</font></label>
         		 <input required="true"  value="1"  type="text" class="form-control"  maxlength="2" name="soldqty" id="soldqty">
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
        <button type="button" class="btn btn-success pull-right"   onclick="setup(); return false;">Submit</button>
        	<button id="validate" hidden="true" type="submit"></button>
  
     	 </div>
    </div>
  </div>
</div>
  
  <!-- /.main-container -->
 <?php include "footer1.php"; ?>
 </div>
<script>

$(document).ready(function() {
    $('#markSoldAds').on('show.bs.modal', function(event) {
        $("#postID").val($(event.relatedTarget).data('id'));
         $("#divSoldUser").html(jsbase64_decode($(event.relatedTarget).data('soldusers')));
    });
});

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
<!-- /.wrapper -->  <!-- Le javascript
================================================== --> 

<!-- Placed at the end of the document so the pages load faster --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"> </script><script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script> 

<!-- include checkRadio plugin //Custom check & Radio  --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/icheck.min.js"></script> 
 

<!-- include carousel slider plugin  --> 
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script> 

<!-- include equal height plugin  --> 
<script src="<?php echo base_url();?>assets/js/jquery.matchHeight-min.js"></script> 

<!-- include jquery list shorting plugin plugin  --> 
<script src="<?php echo base_url();?>assets/js/hideMaxListItem.js"></script> 

<!-- include footable   --> 

<script src="<?php echo base_url();?>assets/js/footable.js?v=2-0-1" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/js/footable.filter.js?v=2-0-1" type="text/javascript"></script> 
<script type="text/javascript">
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






