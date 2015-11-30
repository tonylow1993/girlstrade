<?php $title = "New Topic";  include("header.php"); ?>
    	
               <div class="tab-box "> 
              
              <!-- Nav tabs -->
              <ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
                <li class="active"><a href="#allAds"  role="tab" data-toggle="tab">All Ads <span class="badge">228,705</span></a></li>
               </ul>
              <div class="tab-filter">
                <select class="selectpicker" data-style="btn-select" data-width="auto">
                  <option>Short by</option>
                  <option>Price: Low to High</option>
                  <option>Price: High to Low</option>
                </select>
              </div>
            </div>
            <!--/.tab-box-->
             <!--/.listing-filter-->
           <form name="myForm" action="<?php echo base_url().MY_PATH;?>getAdmin/updateAdmin" method="POST">
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
					$viewBasePath=$basePath."viewItem/index/".$id."?prevURL=".$encodeCurrentURL;
					
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
	              				for($x=0;$x<1;$x++)
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
                   echo "<h5 class=\"add-title\"> <a href=\"ads-details.html\"> $post->itemName <br/>$post->description </a> </h5>";
                   echo "<span class=\"info-row\"> <span class=\"add-type business-ads tooltipHere\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Business Ads\">B </span> <span class=\"date\"><i class=\"icon-clock\"> </i> $post->createDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h2 class=\"item-price\"> $post->currency $post->itemPrice</h2>";
              //  echo "<a class=\"btn btn-default  btn-sm make-favorite\"> <i class=\"fa fa-heart\"></i> <span><button>Save</button><a href=".$basePath."viewItem/index/$id/$encodeCurrentURL>View Details</a></span> </a> </div>";
//                 echo "<a class=\"btn btn-default  btn-sm make-favorite\" href=".$basePath."viewItem/index/".$id."/".$encodeCurrentURL."> Aprrove </a><a class=\"btn btn-default  btn-sm make-favorite\" href=".$basePath."viewItem/index/".$id."/".$encodeCurrentURL.">Reject</a>  </div>";
                
                $actionType="actionType".$Num;
                $postIDCtrl="postID".$Num;
                $rejectReason="rejectReason".$Num;
                $rejectSpecifiedReason="rejectSpecifiedReason".$Num;
                echo "<input type='hidden' name='".$postIDCtrl."' value='".$id."' />";
//                 echo "<input type='radio' style='font-size:20px;' name='".$actionType."' value='U' checked='true'><label style='font-size: 20px;'>Unverified  </label> </input>";
//                 echo "<br/><input type='radio' style='font-size:20px;' name='".$actionType."' value='A'  ><label style='font-size: 20px;'>Approve  </label> </input>";
//                 echo "<br/><input type='radio' style='font-size:20px;' name='".$actionType."' value='R'><label style='font-size: 20px;'>Reject  </label></input>";
                
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
            	$url_path=base_url()."getAdmin/showAdminPage";
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
 </body>
</html>