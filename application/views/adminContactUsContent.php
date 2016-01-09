

	<form name="myForm" action="<?php echo base_url().MY_PATH;?>getAdmin/updateContactUs" method="POST">
             
             <div class="table-responsive">
             <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                    <tr>
                    <th data-type="numeric" data-sort-initial="true"> </th>
                    <th> <?php echo $this->lang->line("From");?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Preview");?>  </th>
                    <th> <?php echo $this->lang->line("Action");?>  </th>
                   </tr>
                </thead>
                <tbody>
                <?php 
                $Num=0;
                
                if($itemList<>null)
            	{
            		foreach($itemList as $id=>$row)
                  	{
                  		$Num=$Num+1;
                  		$email=$row['email'];
                  		$phone=$row["phone"];
                  		$name=$row["name"];
                  		$message=$row["message"];
                  		$contactType=$row["contactType"];
                  		
                  		$createDate=$row['createDate'];
                  		$status=$row['status'];
                  		$contactID=$row['contactID'];
                  		
                		echo "<tr>";
                    	echo "<td style=\"width:5%\" class=\"add-img-selector\"><div class=\"checkbox\">";
                        echo "<label>";
                        echo "  <input type=\"checkbox\">";
                        echo "</label>";
                      	echo "</div></td>";
                    	echo "<td style=\"width:20%\">" ;
                  		if(isset($name) && strcmp($name, "")!=0)
                  			echo $name."<br/>";
                  		if(isset($email) && strcmp($email, "")!=0)
                  			echo $email."<br/>";
                  		if(isset($phone) && strcmp($phone, "")!=0)
                  			echo $phone;
                    	echo "</td>";
                    	echo "<td style=\"width:60%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                       echo "<h5>".$message."<br/>Posted On: ". $createDate."</h5>";
                      	 	echo "</div></td>";
                      	 	echo "<td style=\"width:10%\" class=\"action-td\"><div>";
                      	 	 $actionType="actionType".$Num;
                $commentIDCtrl="contactID".$Num;
                echo "<input type='hidden' name='".$commentIDCtrl."' value='".$contactID."' />";
          
                echo "<select id='".$actionType."' name='".$actionType."'   style='font-size:1.3em'>";
                echo "<option selected='selected' value='A'>Approve</option>";
                echo "<option value='U'>Unverified</option>";
                echo "</select>";
                echo "</div>";
                  echo "</td><td></td></tr>";
				}
               
            	}
				echo "<br/><input type='hidden' name='NumRec' value='".$Num."' ></input>";
              ?>  
               
                </tbody>
              </table>
              
             	
           
            </div>
             <br/><button  type="submit" value="Submit" >Submit</button>
             </form>   
   