
           <form name="myForm" action="<?php echo base_url().MY_PATH;?>getAdmin/updateAdmin" method="POST">
                	<?php
//                 	echo "<div class=\"adds-wrapper\"><div class=\"tab-content\"><div class=\"tab-pane active\" id=\"allAds\">";
            $basePath=base_url();
             $encodeCurrentURL=urlencode(current_url());
               $Num=0;
              if($itemList<>null && count($itemList)>0)
              {
              	
              foreach($itemList as $id=>$item)
				{
					$Num=$Num+1;
					$viewBasePath=$basePath."viewItem/index/".$id."?prevURL=".$encodeCurrentURL."&prevItem_Url=".urlencode(current_url());
					
					//$viewBasePath=$basePath."viewItem/index/".$id."/".$encodeCurrentURL;
              		$locationName='';
					$categoryName='';
					$popupform='';
					$post=NULL;
					foreach($item as $key=>$child)
					{
						if($key=='post')
							$post=$child;
						else if($key=='location')
							$locationName=$child[0]->name;
						else if($key=='category')
							$categoryName=$child[0]->name;
// 						eise if($key=='popup')
// 							$popupform=$child;
					}
					echo  "<div class=\"item-list\"> ";
              		echo  "<div class=\"col-sm-2 no-padding photobox\">";
					foreach($item as $pic=>$picObj)
              		{	
              			if($pic=='pic')
              			{
              				$picCount=count($picObj);
              				if($picCount>0)
              				{
	              				for($x=0;$x< $picCount ;$x++)
	              				{
	              				$thumbnail=$basePath.$picObj[$x]->thumbnailPath.'/'.$picObj[$x]->thumbnailName;
		              			echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a target='_blank' href=\"$viewBasePath\" onclick=\"window.open(this.href, 'popupwindow', width=400,height=300,scrollbars,resizable');return false;\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";
		              			//echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $picCount </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";
		              			 
		              			}
              				}
              			}
              		}
				echo "</div>";
			    echo "<div class=\"col-sm-7 add-desc-box\">";
                  echo "<div class=\"add-details\">";
                   echo "<h5 class=\"add-title\"> $post->itemName ($post->currency $post->itemPrice) <br/>$post->description </h5>";
                   echo "<span class=\"info-row\"> <span class=\"date\"><i class=\"icon-clock\"> </i> $post->createDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
//                 echo "</div>";
//                 echo "<div class=\"col-sm-3 text-right  price-box\">";
//                 echo "<h5 class=\"item-price\"> $post->currency $post->itemPrice</h5>";
              //  echo "<a class=\"btn btn-default  btn-sm make-favorite\"> <i class=\"fa fa-heart\"></i> <span><button>Save</button><a href=".$basePath."viewItem/index/$id/$encodeCurrentURL>View Details</a></span> </a> </div>";
//                 echo "<a class=\"btn btn-default  btn-sm make-favorite\" href=".$basePath."viewItem/index/".$id."/".$encodeCurrentURL."> Aprrove </a><a class=\"btn btn-default  btn-sm make-favorite\" href=".$basePath."viewItem/index/".$id."/".$encodeCurrentURL.">Reject</a>  </div>";
                
                $actionType="actionType".$Num;
                $postIDCtrl="postID".$Num;
                $rejectReason="rejectReason".$Num;
                $rejectSpecifiedReason="rejectSpecifiedReason".$Num;
                $rejectDiv="rejectDiv".$Num;
                $rejectAjaxLoad="rejectAjaxLoad".$Num;
                $rejectError="rejectError".$Num;
                $loadingImg=base64_encode(base_url()."assets/img/loading.gif");
                $validateRejectDescPath=base64_encode(base_url().MY_PATH."getAdmin/validateRejectDescLength");
                echo "<input type='hidden' name='".$postIDCtrl."' value='".$id."' />";
//                 echo "<input type='radio' style='font-size:20px;' name='".$actionType."' value='U' checked='true'><label style='font-size: 20px;'>Unverified  </label> </input>";
//                 echo "<br/><input type='radio' style='font-size:20px;' name='".$actionType."' value='A'  ><label style='font-size: 20px;'>Approve  </label> </input>";
//                 echo "<br/><input type='radio' style='font-size:20px;' name='".$actionType."' value='R'><label style='font-size: 20px;'>Reject  </label></input>";
                
                echo "<select id='".$actionType."' name='".$actionType."'   style='font-size:1.3em'>";
                echo "<option selected='selected' value='A'>Approve</option>";
                echo "<option value='R'>Reject</option>";
                echo "<option value='U'>Unverified</option>";
                echo "</select>";
                echo "<br/><select id='".$rejectReason."' name='".$rejectReason."' style='font-size:1.3em' >";
                echo "<option selected='selected' value='Reject Reason 1'>Reject Reason 1</option>";
                echo "<option value='Reject Reason 2'>Reject Reason 2</option>";
                echo "</select><div id=\"$rejectDiv\">";
                // $('#$rejectAjaxLoad').html('<img alt=\"loading...\" src='.$loadingImg.'  '); ";
                echo "<input type='text' id='$rejectSpecifiedReason' name='$rejectSpecifiedReason' maxlength='100' style='width:200px' 
						onblur=\"javscript:validateRejectDesc('$rejectSpecifiedReason','$loadingImg','$validateRejectDescPath', '$rejectDiv', '$rejectAjaxLoad' , '$rejectError');\" />";
//                 	onblur=\"function() {  
//  					 $.ajax({
// 							method: 'POST',
// 							url: '$validateRejectDescPath' ,
// 							data: { descTextarea: $( '#$rejectSpecifiedReason' ).val() },
// 							success: function(response){
// 								var result = JSON.parse(response);
// 						    	$('#error').html(result.message);
// 						    	$('#$rejectDiv').removeClass('has-success has-error').addClass(result.class);
// 						    	$('#$rejectAjaxLoad').html(result.icon);
// 						    	$('#$rejectError').html(result.err);
// 						    	}
// 						});
// 					}\"></input>";
                echo "<div id='".$rejectAjaxLoad."' class=\"center\"></div>";
                echo "<div id='".$rejectError."'></div>";
                
                		
                echo "</div>";
                 echo "</div></div>";
				}
               
				}else{
              	echo "<div align='center'><h2>".$this->lang->line("NoRecordsFound")."</h2></div>";
              }
				echo "<br/><input type='hidden' name='NumRec' value='".$Num."' ></input>";
// 				echo "</div></div></div>";
				
				
              ?>  
              <br/><button  type="submit" value="Submit" >Submit</button>
             </form>   
                
                
                
          
       