<?php $title = "Girls' Trading Platform";  include("header.php"); ?>
<div id="wrapper">

    <div class="intro-inner">
        <div class="about-intro" style="
    background:url(/images/blogs-bg.jpg) no-repeat center;
	background-size:cover;">
            <div class="dtable hw100">
                <div class="dtable-cell hw100">
                    <div class="container text-center animated fadeInDown">

                        <h1 class="intro-title">Classified Blogs</h1>

                        <h2>Keep track of the latest trend among girls and  <br> you'll never want to miss a post.</h2>


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
                    		
                    		echo "<div class=\"blog-post-img\" > ";
		                        echo " <figure > ";
		                           echo   " <img class=\"img-responsive\" alt=\"blog-post image\" src=$pic1 > ";
		                         echo "   </figure>";
		            		echo "</div>";
							if(strcmp($pic2,"")!=0){
			            		echo "<div class=\"blog-post-img\" > ";
			            		echo " <figure > ";
			            		echo   " <img class=\"img-responsive\" alt=\"blog-post image\" src=$pic2 > ";
			            		echo "   </figure>";
			            		echo "</div>";
							}
							if(strcmp($pic3,"")!=0){
			            		echo "<div class=\"blog-post-img\" > ";
			            		echo " <figure > ";
			            		echo   " <img class=\"img-responsive\" alt=\"blog-post image\" src=$pic3 > ";
			            		echo "   </figure>";
			            		echo "</div>";
							}
							echo "<div class=\"blog-post-content-desc\">";
							
	                        echo   " <span class=\"info-row blog-post-meta\"> ";
							echo	"	<span class=\"date\"><i class=\" icon-clock\"> </i> ".$createDate ."</span> ";
	                        echo 	"</span>";
	
	
	                         echo  " <div class=\"blog-post-content\">";
	                         echo  "    <h2>".$title."</h2>";
	                         echo  "    <p> ".$description."</p>";
	                 
	                         echo  "    </div>";
	                       echo  "  </div>";
							
					?>


                    </div>
                </article>




            </div> <!--/.blog-post-wrapper-->
             </div><!--blogLeft-->


              <div class="col-sm-4 blogRight page-sidebar">
                  <aside>
                      <div class="inner-box">
                          <div class="categories-list  list-filter">
                              <h5 class="list-title uppercase"><strong><a href="#"> Categories</a></strong></h5>
                              <ul class=" list-unstyled">
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
                                  
                                  if($blogList!=null){
                                  	foreach($blogList as $ID=>$value){
                                  		 
                                	  	$urlPath=base_url()."getBlog/viewBlog/".$value->ID."?prevURL=".urlencode(current_url());
		                                  $imgPath=base_url().$value->picPath1.$value->picName1;
		                                  $createDate=$value->createDate;
		                                  $title=$value->title;
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
  <!-- /.main-container -->

<?php include "footer1.php"; ?>
</div>
<?php include "footer2.php"; ?>
