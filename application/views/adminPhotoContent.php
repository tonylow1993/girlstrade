      <form name="myForm" action="<?php echo base_url().MY_PATH;?>getAdmin/updateUserPhotoStatus" method="POST">
                	<?php
//                 	echo "<div class=\"adds-wrapper\"><div class=\"tab-content\"><div class=\"tab-pane active\" id=\"allAds\">";
            $basePath=base_url();
             $encodeCurrentURL=urlencode(current_url());
               $Num=0;
              if($itemList<>null)
              {
              	
              foreach($itemList as $id=>$item)
				{
					$Num=$Num+1;
					$post=NULL;
						
					echo  "<div class=\"item-list\"> ";
              		echo  "<div class=\"col-sm-2 no-padding photobox\">";
              		$picture=$basePath.$item->picturePath.'/'.$item->pictureName;
              		//
								$thumbnail=$basePath.$item->thumbnailPath.'/'.$item->thumbnailName;
// 		              			echo "<div class=\"add-image\"> <img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"> </div> ";
		              		echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> 1 </span> <a target='_blank' href=\"$picture\" onclick=\"window.open(this.href, 'popupwindow', width=400,height=300,scrollbars,resizable');return false;\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";
		              			
				echo "</div>";
			 echo "<div class=\"col-sm-7 add-desc-box\">";
                  echo "<div class=\"add-details\">";
                 
				echo "<h2 class=\"add-title\">".$item->username."</h2>";
				
				 
				$actionType="actionType".$Num;
			 	$postIDCtrl="userID".$Num;
				$rejectReason="rejectReason".$Num;
                $rejectSpecifiedReason="rejectSpecifiedReason".$Num;
//                  echo "<div class=\"col-sm-3 text-right  price-box\">";
               echo "<input type='hidden' id='".$postIDCtrl."' name='".$postIDCtrl."' value='".$item->userID."' />";
			 	echo "<br/><select id='".$actionType."' name='".$actionType."' style='font-size:1.3em' >";
			 	echo "<option selected='selected' value='A'>Approve</option>";
			 	echo "<option value='R'>Reject</option>";
			 	echo "<option value='U'>Unverified</option>";
			 	echo "</select>";
				echo "<br/><select id='".$rejectReason."' name='".$rejectReason."' style='font-size:1.3em' >";
                echo "<option selected='selected' value='Reject Reason 1'>Reject Reason 1</option>";
                echo "<option value='Reject Reason 2'>Reject Reason 2111111111111111111111111</option>";
                echo "</select>";
                echo "<br/><input   type='text' id='".$rejectSpecifiedReason."' name='".$rejectSpecifiedReason."' maxlength='100' style='width:200px;font-size:1.3em;padding: 0px,0px;'></input>";
                echo "</div></div></div>";
			 	
				}
               
				}
				echo "<br/><input type='hidden' name='NumRec' value='".$Num."' ></input>";
// 				echo "</div></div></div>";
				
				
              ?>  
              <br/><button  type="submit" value="Submit" >Submit</button>
             </form>   
                
                
             