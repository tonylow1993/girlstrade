<?php $title = "Girls' Trading Platform";  include("header.php"); ?>
<div id="wrapper">

  <div class="intro-inner">
    <div class="about-intro" style="
    background:url(/images/blogs-bg.jpg) no-repeat center;
	background-size:cover;">
      <div class="dtable hw100">
        <div class="dtable-cell hw100">
          <div class="container text-center animated fadeInDown">

                  <h1 class="intro-title"> Classified Blogs</h1>

              <h2>Keep track of the latest trend among girls and  <br> you'll never want to miss a post.</h2>
              <!--<div class="row search-row animated fadeInUp">
                  <div class="col-lg-4 col-sm-offset-2 col-sm-4 search-col relative ">
                      <input type="text" value="" placeholder="Your email..." class="form-control locinput input-rel searchtag-input " >

                  </div>

                  <div class="col-lg-4 col-sm-4 search-col">
                      <button class="btn btn-primary btn-search btn-block"><i class="icon-mail-1"></i><strong> Subscribe</strong></button>
                  </div>
              </div>--> 


          </div>
        </div>
      </div>
    </div>
    <!--/.about-intro --> 
    
  </div>
  <!-- /.intro-inner -->
  
  <div class="main-container inner-page">
    <div class="container">
      <div class="section-content">
        <div class="row ">
            <div class="col-sm-8 blogLeft">
               <div class="blog-post-wrapper">

                <article class="blog-post-item">
                    <div class="inner-box">


                    <!--blog image-->
                    
                    <?php 
                    if($result!=null && sizeof($result)>0){
                    	foreach($result as $ID=>$value){
                    		$pic1=base_url().$value->picPath1.$value->picName1;
                    		$pic2=base_url().$value->picPath2.$value->picName2;
                    		$pic3=base_url().$value->picPath3.$value->picName3;
                    		
                    		echo "<div class=\"blog-post-img\" > ";
		
		                        echo "<a href=".base_url()."getBlog/viewBlog/".$value->ID."?prevURL=".urlencode(current_url())." > ";
		                        echo " <figure > ";
		                           echo   " <img class=\"img-responsive\" alt=\"blog-post image\" src=$pic1 > ";
		                         echo "   </figure>";
		                        echo "</a>";
                    		echo "</div>";

                    		echo "<div class=\"blog-post-content-desc\">";
	
	
	                        echo   " <span class=\"info-row blog-post-meta\"> ";
							echo	"	<span class=\"date\"><i class=\" icon-clock\"> </i> ".$value->createDate ."</span> ";
	                        echo 	"</span>";
	
	
	                         echo  " <div class=\"blog-post-content\">";
	                         echo  "    <h2><a href=".base_url()."getBlog/viewBlog/".$value->ID."?prevURL=".urlencode(current_url()).">".$value->title."</a></h2>";
	                         echo  "    <p> ".$value->description."</p>";
	                         echo  "    <div class=\"row\">";
	                         echo  "        <div class=\"col-md-12 clearfix blog-post-bottom\">";
	                         echo  "            <a class=\"btn btn-primary  pull-left\" href=".base_url()."getBlog/viewBlog/".$value->ID."?prevURL=".urlencode(current_url()).">More info</a>";
	                          echo  "       </div>";
	                          echo  "   </div>";
	                         echo  "    </div>";
	                       echo  "  </div>";
							}
						}
					?>

                    </div>
                </article>
			<div class="pagination-bar text-center">
            <ul class="pagination">
            <?php 
            	$encodeCurrentURL=urlencode(current_url());
            	$url_path=base_url().MY_PATH."getBlog/viewAllBlog";
            	$pageNumPrev=$pageNum-1;
            	$pageNum2=$pageNum+1;
            	$pageNum3=$pageNum+2;
            	$pageNum4=$pageNum+3;
            	$pageNum5=$pageNum+4;
            	$pageNumNext=$pageNum+5;
            	$itemPerPage=ITEMS_PER_PAGE;
            	 
            	if($NoOfItemCount>0)
            	{
            		if($pageNum<>1)
            			echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumPrev?prevURL=$previousCurrent_url;\">Previous</a></li>";
            		if($NoOfItemCount > 0)
            			echo "<li  class=\"active\"><a href=\"$url_path/$pageNum?prevURL=$previousCurrent_url;\">$pageNum</a></li>";
            		if($NoOfItemCount > ($pageNum*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum2?prevURL=$previousCurrent_url;\">$pageNum2</a></li>";
              		if($NoOfItemCount > ($pageNum2*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum3?prevURL=$previousCurrent_url;\">$pageNum3</a></li>";
              		if($NoOfItemCount > ($pageNum3*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum4?prevURL=$previousCurrent_url;\">$pageNum4</a></li>";
              		if($NoOfItemCount > ($pageNum4*$itemPerPage))
            			echo "<li><a href=\"$url_path/$pageNum5?prevURL=$previousCurrent_url;\">$pageNum5</a></li>";
              		if($NoOfItemCount > ($pageNum5*$itemPerPage))
            	 	   echo "<li><a class=\"pagination-btn\" href=\"$url_path/$pageNumNext?prevURL=$previousCurrent_url;\">Next</a></li>";
           		}
             ?>
                </ul>
          </div>	
			
		  
            </div> <!--/.blog-post-wrapper-->
             </div><!--blogLeft-->


              <div class="col-sm-4 blogRight page-sidebar">
                  <aside>
                      <div class="inner-box">
                          <div class="categories-list  list-filter">
                              <h5 class="list-title uppercase"><strong><a href="#"> Categories</a></strong></h5>
                              <ul class=" list-unstyled list-border ">
                              	<?php 
			                  if($popularMakes1<>null)
			                  {
			                  	foreach ($popularMakes1 as $id=>$value)
			                  	{
			                  		if(!isset($lang_label))
			                  			$lang_label="";
			                  		$name=$value->name;
			                  		$postCount="(".$value->postCount.")";
			                  		if(SHOW_BRACKETS_INDEX_PAGE==0)
			                  			$postCount="";
			                  		if($lang_label<>"english")
			                  			$name=$value->nameCH;
			                  		$path=base_url().MY_PATH."getCategory/getAll/1/$value->categoryID";
			                  		echo "<li> <a href='$path'><span class=\"title\"><h4>$name $postCount</span></h4></a></li>";
			                  	}
			                  }
			                  ?>
                         </ul>
                          </div>
                          <!--/.categories-list-->
                          <div class="categories-list  list-filter">
                              <h5 class="list-title uppercase"><strong><a href="#"> recent
                                  popular</a></strong></h5>



                              <div class="blog-popular-content">
                                 <?php 
                                  
                                  if($HotProduct!=null){
                                  	foreach($HotProduct as $ID=>$value){
                                  		 
                                  		foreach($value as $pic=>$picObj)
                                  		{
                                  			if($pic=='post'){
                                  				$postID=$picObj->postID;
                                  				$urlPath=base_url().MY_PATH."viewItem/index/$postID?prevURL=".urlencode(current_url());
                                  				$createDate=$picObj->createDate;
                                  				$title=$picObj->itemName;
                                  			}if($pic=='pic' && count($picObj)>0)
                                  				$imgPath=base_url().$picObj[0]->thumbnailPath.'/'.$picObj[0]->thumbnailName;
                                  				
                                  		}
                                  		 
		                                  echo "<div class=\"item-list\">";
		                                   echo " <div class=\"col-sm-4 col-xs-4 no-padding photobox\"> ";
		                                     echo  "    <div class=\"add-image\">  <a href=$urlPath><img class=\"no-margin\" src=$imgPath alt=\"img\"></a> </div> ";
		                                    echo " </div>";
		                                     echo " <div class=\"col-sm-8 col-xs-8 add-desc-box\">";
		                                     echo "     <div class=\"add-details\">";
		                                     echo "         <h5 class=\"add-title\"> <a href=$urlPath>  $title </a> </h5> ";
		                                     echo "         <span class=\"info-row\">  <span class=\"date\"><i class=\" icon-clock\"> </i>  $createDate </span> </span> </div> ";
		                                     echo " </div>";
		                                     echo " </div>";
                               		   	}
                                  }
									?>

                                  

                              </div>





                              <div style="clear:both"></div>

                              <!--/.categories-list-->

                          </div>

                      </div>
                  </aside>
              </div>
            <!--page-sidebar-->

            </div>
          </div>

        </div>

</div>

<?php include "footer1.php"; ?>
</div>
<?php include "footer2.php"; ?>
