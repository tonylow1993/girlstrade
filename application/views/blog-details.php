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
                                  <li><a href="http://www.girlstrade.com/getCategory/getAll/1/1"><span class="title">Dresses</span></a> </li>
                                  <li><a href="http://www.girlstrade.com/getCategory/getAll/1/2"><span class="title">Tops </span></a> </li>
                                  <li><a href="http://www.girlstrade.com/getCategory/getAll/1/3"><span class="title">Property </span></a> </li>
                                  <li><a href="http://www.girlstrade.com/getCategory/getAll/1/4"><span class="title">Outerwear </span></a> </li>
                                  <li><a href="http://www.girlstrade.com/getCategory/getAll/1/5"><span class="title">Rompers </span></a> </li>
                                  <li><a href="http://www.girlstrade.com/getCategory/getAll/1/6"><span class="title">Hat </span></a> </li>
                              </ul>
                          </div>
                          <!--/.categories-list-->
                          <div class="categories-list  list-filter">
                              <h5 class="list-title uppercase"><strong><a href="#"> recent
                                  popular</a></strong></h5>



                              <div class="blog-popular-content">
                                  <div class="item-list">


                                      <div class="col-sm-4 col-xs-4 no-padding photobox">
                                          <div class="add-image">  <a href="http://www.girlstrade.com/viewItem/index/17?prevURL=http%3A%2F%2Fwww.girlstrade.com%2Findex.php%2FgetCategory%2FgetAll%2F1"><img class="no-margin" src="http://www.girlstrade.com/USER_IMG/gttest1/Resize/gttest1_2016-03-06-00-08-39_thumb_0.png" alt="img"></a> </div>
                                      </div>
                                      <!--/.photobox-->
                                      <div class="col-sm-8 col-xs-8 add-desc-box">
                                          <div class="add-details">
                                              <h5 class="add-title"> <a href="http://www.girlstrade.com/viewItem/index/17?prevURL=http%3A%2F%2Fwww.girlstrade.com%2Findex.php%2FgetCategory%2FgetAll%2F1">Shiseido Maquillage cheek colors blush </a> </h5>
                                              <span class="info-row">  <span class="date"><i class=" icon-clock"> </i>  2016-03-06 00:08:39 </span> </span> </div>
                                      </div>
                                      <!--/.add-desc-box-->


                                  </div>

                                  <div class="item-list">


                                      <div class="col-sm-4 col-xs-4 no-padding photobox">
                                          <div class="add-image">  <a href="http://www.girlstrade.com/viewItem/index/15?prevURL=http%3A%2F%2Fwww.girlstrade.com%2Findex.php%2FgetCategory%2FgetAll%2F1"><img class="no-margin" src="http://www.girlstrade.com/USER_IMG/rchiu3hk/Resize/rchiu3hk_2016-03-05-12-17-43_thumb_0.png" alt="img"></a> </div>
                                      </div>
                                      <!--/.photobox-->
                                      <div class="col-sm-8 col-xs-8 add-desc-box">
                                          <div class="add-details">
                                              <h5 class="add-title"> <a href="http://www.girlstrade.com/viewItem/index/15?prevURL=http%3A%2F%2Fwww.girlstrade.com%2Findex.php%2FgetCategory%2FgetAll%2F1">Kung Fu Panada  </a> </h5>
                                              <span class="info-row">  <span class="date"><i class=" icon-clock"> </i>  2016-03-05 12:17:43  </span> </span> </div>
                                      </div>
                                      <!--/.add-desc-box-->


                                  </div>

                                  <div class="item-list">


                                      <div class="col-sm-4 col-xs-4 no-padding photobox">
                                          <div class="add-image">  <a href="http://www.girlstrade.com/viewItem/index/3?prevURL=http%3A%2F%2Fwww.girlstrade.com%2Findex.php%2FgetCategory%2FgetAll%2F1"><img class="no-margin" src="http://www.girlstrade.com/USER_IMG/tonylow123/Resize/tonylow123_2016-02-07-14-43-12_thumb_0.png" alt="img"></a> </div>
                                      </div>
                                      <!--/.photobox-->
                                      <div class="col-sm-8 col-xs-8 add-desc-box">
                                          <div class="add-details">
                                              <h5 class="add-title"> <a href="http://www.girlstrade.com/viewItem/index/3?prevURL=http%3A%2F%2Fwww.girlstrade.com%2Findex.php%2FgetCategory%2FgetAll%2F1">Taylor Big Baby Taylor-e Acoustic-Electric Gu </a> </h5>
                                              <span class="info-row">  <span class="date"><i class=" icon-clock"> </i> 2016-02-07 14:43:12 </span> </span> </div>
                                      </div>
                                      <!--/.add-desc-box-->


                                  </div>




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
