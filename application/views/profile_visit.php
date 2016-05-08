<div class="welcome-msg">
              <h3 class="page-sub-header2 clearfix no-padding">Hello <?php echo $userName;?> </h3>
              <span class="page-sub-header-sub small">You last logged in at: <?php echo $lastLoginTime; ?></span> </div>
          	<form role="form" method="POST" action="<?php echo base_url().MY_PATH.'home/getAccountPage/'.$activeNav.'/'.$pageNum.'/0/'.$sortByDate.'?prevURL='.urlencode(current_url());?>"
         	     id="sortfrm" > 
<!-- 			  class="tab-filter" -->
          		<div id="sortByDateDiv" style="<?php if(strcmp($activeNav,"4")==0) echo "display:none"; else echo "display:block"; ?>;width:150px">
					<select class="form-control"   name="sortByDate"   id="sortByDate" data-width="auto" onchange="beginSort();">
					  <option value="0" <?php if(strcmp($sortByDate,"0")==0 or $sortByDate==0) echo " selected='selected' ";?> >Sort by...</option>
					  <option value="1" <?php if(strcmp($sortByDate,"1")==0)  echo " selected='selected' ";?>>Most Recent</option>
					  <option value="2" <?php if(strcmp($sortByDate,"2")==0)  echo " selected='selected' ";?>>Oldest</option>
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