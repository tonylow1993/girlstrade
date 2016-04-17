<?php $title = "New Topic";  include("header.php"); ?>
<!--input-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- /.header -->
<div id="wrapper">
   <div class="main-container">
    <div class="container">
		<div class="col-lg-12 content-box " id="summaryCategoryList" name="summaryCategoryList" style="display:block;">
			<div class="row row-featured row-featured-category">
				<div class="col-lg-12  box-title no-border">
				   <div class="inner"><h2 style="color:#5CB2DD; font-size:22px"> Which category does your item belong to?</h2>
				   </div>
				</div>
				<?php 
				 $total=0;
				 $lastCol=0;
				foreach ($AllCategory as $id=>$value)
				{
					if(!isset($lang_label))
							$lang_label="";
					$name=$value[0]->name;
					$postCount="(".$value[0]->postCount.")";
					if(SHOW_BRACKETS_INDEX_PAGE==0)
						$postCount="";
					if($lang_label<>"english")
						$name=$value[0]->nameCH;
					$path=base_url().MY_PATH."newPost/index?prevURL=".current_url()."&category=".$id;
					
					if($value[0]->level==1)
					{
						$imageIcon=$value[0]->iconImage;
						if($value[0]->childCount<>0){
							echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-4 f-category\">";
							echo "<a href='$path'><img src=/$imageIcon class=\"img-responsive\" alt=\"img\"> <h6> $name  </h6> </a>";
							echo "</div>";
						}
					}
				}
				?>

                </div>



          </div>
    </div>
    <!-- /.container --> 
  </div>

<?php include "footer1.php"; ?>
<?php include "footer2.php"; ?>
  <!--/.footer--> 
</div>