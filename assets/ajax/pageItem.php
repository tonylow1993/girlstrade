
              <?php
             $var1 = unserialize(base64_decode($_GET['result_str']));
              $basePath = $_GET['basePath'];
              
              print_r($var1);
              echo $basePath;
              if($var1<>null)
              {
              foreach($var1 as $id=>$item)
				{
				  $viewBasePath=$basePath."viewItem/index/$id"."/".urlencode(current_url);
              		$locationName='';
					$categoryName='';
					$post=NULL;
					foreach($item as $key=>$child)
					{
						if($key=='post')
							$post=$child;
						else if($key=='location')
							$locationName=$child[0]->name;
						else if($key=='category')
							$categoryName=$child[0]->name;
					}
					echo  "<div class=\"item-list\"> ";
              		echo  "<div class=\"col-sm-2 no-padding photobox\">";
					foreach($item as $pic=>$picObj)
              		{	
              			if($pic=='pic')
              			{
              				for($x=0;$x<count($picObj);$x++)
              				{
	              			$thumbnail=$basePath.$picObj[$x]->thumbnailPath.'/'.$picObj[$x]->thumbnailName;
	              			echo "<div class=\"add-image\"> <span class=\"photo-count\"><i class=\"fa fa-camera\"></i> $post->itemQual </span> <a href=\"$viewBasePath\"><img class=\"thumbnail no-margin\" src=$thumbnail alt=\"img\"></a> </div> ";              			
	              			}
              			}
              		}
				echo "</div>";
			    echo "<div class=\"col-sm-7 add-desc-box\">";
                  echo "<div class=\"add-details\">";
                   echo "<h5 class=\"add-title\"> <a href=\"ads-details.html\"> $post->description </a> </h5>";
                   echo "<span class=\"info-row\"> <span class=\"add-type business-ads tooltipHere\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Business Ads\">B </span> <span class=\"date\"><i class=\"icon-clock\"> </i> $post->createDate </span> - <span class=\"category\">$categoryName </span>- <span class=\"item-location\"><i class=\"fa fa-map-marker\"></i> $locationName </span> </span> </div>";
                echo "</div>";
                echo "<div class=\"col-sm-3 text-right  price-box\">";
                echo "<h2 class=\"item-price\"> $post->currency $post->itemPrice</h2>";
                echo "<a class=\"btn btn-default  btn-sm make-favorite\"> <i class=\"fa fa-heart\"></i> <span><button>Save</button><a href=".$basePath."viewItem/index/$id>View Details</a></span> </a> </div>";
               echo "</div>";
				}
               
				}
				
              ?>        
              
              
              
             
             