   <form name="myForm" action="<?php echo base_url().MY_PATH;?>getAdmin/updateUserAdmin" method="POST">
                	<?php
                	
                	if($itemList<>null)
                	{
                		echo "<div  class=\"form-group\">";
                		echo "<label class=\"col-md-3 control-label\" >Select username:</label>";
                		echo "<div class=\"col-md-8\">";
                		echo "<select id='userID' name='userID' class=\"form-control\"   style='font-size:1.3em'>";
                		foreach($itemList as $id=>$item)
                		{
                			echo "<option value='".$item->userID."'>".$item->username." (".$item->accountStatus.", ".$item->usertype.", ".$item->blockDate.")</option>";	                	
                		}
                		echo "</select></div></div>";
                		
                		echo "<div  class=\"form-group\">";
                		echo "<label class=\"col-md-3 control-label\" >Select User Type::</label>";
                		echo "<div class=\"col-md-8\">";
                		echo "<select id='userType' name='userType'  class=\"form-control\"   style='font-size:1.3em'>";
                		echo "<option value='".PREMIUMPOSTEXPIRYDAYS."'>Premium 30 days </option>";
                		echo "<option value='".GOLDPOSTEXPIRYDAYS."'>Gold 15 days </option>";
                		echo "<option value='".SILVERPOSTEXPIRYDAYS."'>Silver 1 day </option>";
                		echo "</select></div></div>";
                		$ctrlName2="AjaxLoad_";
                		$errorctrlName2="ErrAjaxLoad_";
                		$ctrlValue3="blockDate_";
                		echo "<div  class=\"form-group\">";
                		echo "<label class=\"col-md-3 control-label\" >Enter Block Date:</label>";
                			echo "<div class=\"col-md-8\">";
                			echo " <div id='$ctrlName2' name='$ctrlName2' class='center'></div><div id='$errorctrlName2' name='$errorctrlName2' class='center'></div>";
                			echo "<input  id='blockDate' class=\"form-control\"  name='blockDate' onblur=\"checkDate(this.value,'$ctrlName2','$errorctrlName2')\">( e.g. 2015/09/08)";
                		 echo "</div></div>";
                		 
                	}
                	
                	?>
  					<button  type="submit" value="Submit" >Submit</button>
             </form>