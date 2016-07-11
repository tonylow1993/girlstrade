<form role="form" method="POST" action="<?php echo base_url().MY_PATH.'home/getAccountPage/'.$activeNav.'/'.$pageNum.'/0/'.$sortByDate.'?prevURL='.urlencode(current_url());?>" id="sortfrm" class="tab-filter"> 
<!-- 			  class="tab-filter" -->
	<div id="sortByDateDiv" style="<?php if(strcmp($activeNav,"4")==0) echo "display:none"; else echo "display:block"; ?>;width:150px;margin-left:auto; margin-right:0;">
		<select class="form-control"   name="sortByDate"   id="sortByDate" data-width="auto" onchange="beginSort();">
		  <option value="0" <?php if(strcmp($sortByDate,"0")==0 or $sortByDate==0) echo " selected='selected' ";?> ><?php echo $lblSearchSortBy;?></option>
		  <option value="1" <?php if(strcmp($sortByDate,"1")==0)  echo " selected='selected' ";?>><?php echo $mostRecent;?></option>
		  <option value="2" <?php if(strcmp($sortByDate,"2")==0)  echo " selected='selected' ";?>><?php echo $oldest;?></option>
		</select>
	</div> 
		<noscript><input type="submit" value="Submit"></noscript>
</form>
			
<script>
function beginSort(){
	var sortByDate=document.getElementById("sortByDate").value;
	var actionpath="<?php echo base_url().MY_PATH.'home/getAccountPage/'.$activeNav.'/'.$pageNum.'/0/';?>".concat(sortByDate).concat("<?php echo '?prevURL='.urlencode(current_url());?>");
		document.getElementById("sortfrm").action=actionpath;
		document.getElementById("sortfrm").submit();
}
</script>