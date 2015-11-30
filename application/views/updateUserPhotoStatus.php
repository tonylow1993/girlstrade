<?php $title = "New Topic";  include("header.php"); ?>
    	
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
							$thumbnail=$basePath.$item->thumbnailPath.'/'.$item->thumbnailName;
		              			echo "<div class=\"add-image\"> <img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"> </div> ";
		              		
				echo "</div>";
				echo "<h2>".$item->username."</h2>";
			 	
				 echo "<div class=\"col-sm-3 text-right  price-box\">";
               
				$actionType="actionType".$Num;
			 	$postIDCtrl="userID".$Num;
				$rejectReason="rejectReason".$Num;
                $rejectSpecifiedReason="rejectSpecifiedReason".$Num;
                
			 	echo "<input type='hidden' id='".$postIDCtrl."' name='".$postIDCtrl."' value='".$item->userID."' />";
			 	echo "<br/><select id='".$actionType."' name='".$actionType."' style='font-size:1.6em' >";
			 	echo "<option selected='selected' value='A'>Approve</option>";
			 	echo "<option value='R'>Reject</option>";
			 	echo "<option value='U'>Unverified</option>";
			 	echo "</select>";
				echo "<br/><select id='".$rejectReason."' name='".$rejectReason."' style='font-size:1.6em' >";
                echo "<option selected='selected' value='Reject Reason 1'>Reject Reason 1</option>";
                echo "<option value='Reject Reason 2'>Reject Reason 2</option>";
                echo "</select>";
                echo "<br/><input type='text' id='".$rejectSpecifiedReason."' name='".$rejectSpecifiedReason."' maxlength='100' style='width:200px'></input>";
                echo "</div></div>";
			 	
				}
               
				}
				echo "<br/><input type='hidden' name='NumRec' value='".$Num."' ></input>";
// 				echo "</div></div></div>";
				
				
              ?>  
              <br/><button  type="submit" value="Submit" >Submit</button>
             </form>   
                
                
                
          
          <div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
//             	$url_path=base_url()."getAdmin/showAdminPage";
//             	$pageNumPrev=$pageNum-1;
//             	$pageNum2=$pageNum+1;
//             	$pageNum3=$pageNum+2;
//             	$pageNum4=$pageNum+3;
//             	$pageNum5=$pageNum+4;
//             	$pageNumNext=$pageNum+5;
//             	if($pageNum<>1)
//             		echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev\">Previous</a></li>";
//             	echo "<li  class=\"active\"><a href=\"$url_path/$pageNum\">$pageNum</a></li>";
//             	echo "<li><a href=\"$url_path/$pageNum2\">$pageNum2</a></li>";
//               	echo "<li><a href=\"$url_path/$pageNum3\">$pageNum3</a></li>";
//               	echo "<li><a href=\"$url_path/$pageNum4\">$pageNum4</a></li>";
//               	echo "<li><a href=\"$url_path/$pageNum5\">$pageNum5</a></li>";
              
//                echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext\">Next</a></li>";
            ?>
                </ul>
          </div>
 </body>
</html>