<?php
$title = "香港女士交易平台"; 
  include("header.php"); ?>

<script>
window.onload = function(){
	   //document.getElementById("ads").focus();
	};
</script>
<style id="jsbin-css">
.progress-bar[aria-valuenow="1"],
.progress-bar[aria-valuenow="2"] {
  min-width: 3%;
}

.progress-bar[aria-valuenow="0"] {
  color: gray;
  min-width: 100%;
  background: transparent;
  box-shadow: none;
}

.progress-bar[aria-valuenow^="9"]:not([aria-valuenow="9"]) {
  background: red;
}
</style>
				
<div class="intro">
    <div class="dtable hw100">
      <div class="dtable-cell hw100">
        <div class="container text-center">
       <h1 class="intro-title animated fadeInDown"> <?php echo $indexFirstTitle;?>  </h1>
		<p class="sub animateme fittext3 animated fadeIn"> <?php echo $indexSecondTitle;?> </p>
           <form action="<?php echo base_url().MY_PATH;?>getCategory/getAll/1" method="POST">
          
          <div class="row search-row animated fadeInUp">
			<div class="col-lg-4 col-sm-4 search-col relative"> <i class="icon-docs icon-append icon-index"></i>
                <input type="text" name="ads" id="ads"  class="form-control has-icon"  placeholder="<?php echo $this->lang->line("Looking_For"); ?>"  value="">
              </div>	
				<div class="col-sm-4  col-sm-4 search-col relative">
				
                <select class="btn btn-catSelect btn-search btn-block  catSelect dropdown-toggle" name="category" id="search-category">
                    <option style="background-color: #B9005E;" <?php if($catID="" or $catID=0) echo "selected='selected'"; ?> value="">
                        <?php echo $this->lang->line("lblAllCategories");?>
                    </option>
                    <?php 
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
            	if($value[0]->level==1)
            		echo "<option value='".$id."' style='background-color: #E1338B;' >".$name.$postCount."</option>";
            	else 
            	{
            		$str="";
            		if($catID==$id)
            			$str=" selected='selected' ";
            		echo "<option ".$str." value='".$id."' style='margin-left:10px;'> &nbsp;&nbsp;&nbsp;&nbsp;".$name.$postCount." </option>";
            	}
            }
            ?>
                </select>
            </div>
       
              <div class="col-lg-3 col-sm-3 search-col relative">
                <button class="btn btn-primary btn-search btn-block"><i class="icon-search"></i><strong><?php echo $this->lang->line("Find");?></strong></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
      <!--  <div class="search-row-wrapper"> -->

    <!--=== Slider ===-->
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 1">
                    <!-- MAIN IMAGE -->
					
                    <img src="<?php echo base_url();?>assets/img/1.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch1 sft start"
                        data-x="center"
                        data-hoffset="0"
                        data-y="100"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        <?php echo $indexSider1_1;?><br>
						<strong><?php echo $indexSider1_2;?></strong><br>
						<?php echo $indexSider1_3;?><br>
                        <strong><?php echo $indexSider1_4;?></strong><br>
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption sft"
                        data-x="center"
                        data-hoffset="0"
                        data-y="380"
                        data-speed="1600"
                        data-start="1800"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light"><?php echo $indexSider1_btn;?></a>
                    </div>
                </li>
                <!-- END SLIDE -->

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 2">
                    <!-- MAIN IMAGE -->
                    <img src="<?php echo base_url();?>assets/img/5.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch3 sft start"
                        data-x="right"
                        data-hoffset="0"
                        data-y="140"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        <strong><?php echo $indexSider2_1;?></strong>
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption revolution-ch4 sft"
                        data-x="right"
                        data-hoffset="-14"
                        data-y="210"
                        data-speed="1400"
                        data-start="2000"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        <?php echo $indexSider2_2;?>
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption sft"
                        data-x="right"
                        data-hoffset="0"
                        data-y="300"
                        data-speed="1600"
                        data-start="1800"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">
						<?php echo $indexSider2_btn;?>
						</a>
                    </div>
                </li>
                <!-- END SLIDE -->

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 3">
                    <!-- MAIN IMAGE -->
                    <img src="<?php echo base_url();?>assets/img/3.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch3 sft start"
                        data-x="right"
                        data-hoffset="5"
                        data-y="130"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        <strong><?php echo $indexSider3_1;?></strong> 
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption revolution-ch4 sft"
                        data-x="right"
                        data-hoffset="0"
                        data-y="210"
                        data-speed="1400"
                        data-start="2000"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        <?php echo $indexSider3_2;?><br>
                        <?php echo $indexSider3_3;?>
                    </div>

                    <!-- LAYER -->
                    <!--<div class="tp-caption sft"
                        data-x="right"
                        data-hoffset="0"
                        data-y="300"
                        data-speed="1600"
                        data-start="2800"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Find Your Location</a>
                    </div>-->
                </li>
                <!-- END SLIDE -->

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 4">
                    <!-- MAIN IMAGE -->
                    <img src="<?php echo base_url();?>assets/img/2.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                    <!--<div class="tp-caption revolution-ch1 sft start"
                        data-x="center"
                        data-hoffset="0"
                        data-y="100"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        Review
                    </div>-->
					
					 <div class="tp-caption revolution-ch3 sft start"
                        data-x="left"
                        data-hoffset="5"
                        data-y="130"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        <strong><?php echo $indexSider4_1;?></strong> 
                    </div>
					
                    <!-- LAYER -->
                    <!--<div class="tp-caption revolution-ch2 sft"
                        data-x="center"
                        data-hoffset="0"
                        data-y="280"
                        data-speed="1400"
                        data-start="2000"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        Give Us Feedback On Your Latest Trade
                    </div>-->
					
					<!-- LAYER -->
                    <!--<div class="tp-caption revolution-ch4 sft"
                        data-x="left"
                        data-hoffset="0"
                        data-y="210"
                        data-speed="1400"
                        data-start="2000"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        Give Us Feedback On Your Latest Trade
                    </div>-->
					
                    <!-- LAYER -->
                    <div class="tp-caption sft"
                        data-x="right"
                        data-hoffset="0"
                        data-y="370"
                        data-speed="1600"
                        data-start="2800"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">
						<?php echo $indexSider4_btn;?></a>
                    </div>
                </li>
                <!-- END SLIDE -->                

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 5">
                    <!-- MAIN IMAGE -->
                    <img src="<?php echo base_url();?>assets/img/4.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch5 sft start"
                        data-x="right"
                        data-hoffset="5"
                        data-y="130"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        <strong><?php echo $indexSider5_1;?></strong>
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption revolution-ch4 sft"
                        data-x="right"
                        data-hoffset="-14"
                        data-y="210"
                        data-speed="1400"
                        data-start="2000"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        <?php echo $indexSider5_2;?>
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption sft"
                        data-x="right"
                        data-hoffset="0"
                        data-y="300"
                        data-speed="1600"
                        data-start="2800"
                        data-easing="Power4.easeOut"
                        data-endspeed="300"
                        data-endeasing="Power1.easeIn"
                        data-captionhidden="off"
                        style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">
						<?php echo $indexSider5_btn;?>
						</a>
                    </div>
                </li>
                <!-- END SLIDE -->
            </ul>        
        </div>
    </div>
    <!--=== End Slider ===-->
<div class="main-container">
    <div class="container">
      <div class="row">
           
    	<div class="col-sm-9 page-content col-thin-right">
          <div class="content-box category-content panel-bevel" id="detailCategoryList" name="detailCategoryList" style="display:none;">
             <div class="col-lg-12  box-title no-border" >
				<div class="inner"><h2><span style="font-family: MyCustomFont; font-weight: 500; color: #E2348C;">
				<?php echo $indexDiscoverTitle;?></span> 
				<?php echo $indexDiscoverTitle2;?><a href="javascript:showSummaryCatDiv();"  id="detailCatBtn" name="detailCatBtn" class="sell-your-item"> 
				<?php echo $indexViewLess;?><i class="  icon-th-list"></i> </a></h2></div>
             <?php 
    	     $count=0;
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
            	$path=base_url().MY_PATH."getCategory/getAll/1/".$value[0]->categoryID;
            	
            	if($value[0]->level==1)
            	{
            		$total++;
            		$count++;
            		if($count==7)
            		{
            			$lastCol++;
            			$count=1;
            		}
            		if($total<>1)
            			echo "</ul></div>";
            		if($count==1)
            		{
            			if($total<>1)
            				echo "</div>";
            			if($lastCol==2)
            				echo "<div class=\"col-md-4 col-sm-4 last-column\">";
            			else
            			echo "<div class=\"col-md-4 col-sm-4\">";
            		}
            		$imageIcon=$value[0]->iconImage;
            		if($value[0]->childCount<>0){
            		echo "<div class=\"cat-list\">";
            		echo "<h3 class=\"cat-title\"><img  style=\"margin:0px; padding:0px;\"  src=$imageIcon alt='' height='30' width='30'><a class=\"title-font\"  style=\"margin:0px; padding:0px;padding-left:3px;\"  href='$path'>$name $postCount</a>";
            		
            		echo "<span data-target=\".cat-id-$total\"  data-toggle=\"collapse\"  class=\"btn-cat-collapsed collapsed\">   <span class=\" icon-down-open-big\"></span> </span>";
            		echo "</h3>";
            		echo "<ul class=\"cat-collapse collapse in cat-id-$total\">";
            		} else {
            			echo "<div class=\"cat-list\">";
            			echo "<h3 ><img style=\"margin:0px; padding:0px;\"  src=$imageIcon alt='' height='30' width='30'><a class=\"title-font\" style=\"margin:0px; padding:0px;padding-left:3px;\" href='$path'>$name $postCount</a>";
            			
            			echo "<span data-target=\".cat-id-$total\"  >  </span>";
            			echo "</h3>";
            			echo "<ul>";
            			
            		}
            	}else 
            	{
            		echo  "<li> <a href='$path'><h4>$name $postCount</h4></a></li>";
                   
            	}
            }
            if($total<>0)
            	echo "</ul></div></div></div>";
            ?>
			
			
			</div>
			<div class="col-lg-12 content-box " id="summaryCategoryList" name="summaryCategoryList" style="display:block;">
                <div class="row row-featured row-featured-category">
                    <div class="col-lg-12  box-title no-border">
                       <div class="inner"><h2><span style="font-family: MyCustomFont; font-weight: 500; color: #E2348C;">
                       <?php echo $indexDiscoverTitle;?></span> <?php echo $indexDiscoverTitle2;?><a href="javascript:showDetailCatDiv();"  id="summaryCatBtn" name="summaryCatBtn" class="sell-your-item"> 
                       <?php echo $indexViewMore;?><i class="  icon-th-list"></i> </a></h2>
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
						$path=base_url().MY_PATH."getCategory/getAll/1/".$value[0]->categoryID;
						
						if($value[0]->level==1)
						{
							$imageIcon=$value[0]->iconImage;
							//if($value[0]->childCount<>0){
								echo "<div name='$count' class=\"col-lg-2 col-md-3 col-sm-3 col-xs-4 f-category\">";
								echo "<a href='$path'><img src=$imageIcon class=\"img-responsive\" alt=\"img\"> <h6> $name  </h6> </a>";
								echo "</div>";
							//}
						}
					}
					?>

                </div>



            </div>
			
        <!--<div class="inner-box relative panel-bevel">
				
                <h2 class="title-2">
					<i class="fa fa-heart" style="color: #E2348C;"></i>
					<span style="font-family: MyCustomFont; font-weight: 700; color: #E2348C;">Interested</span> Items
            
					<a id="nextItem1" class="link pull-right carousel-nav"> <i class="icon-right-open-big"></i></a>
					<a id="prevItem1" class="link pull-right carousel-nav"> <i class="icon-left-open-big"></i> </a>

				</h2>
			
            <div class="row">
                    <div class="col-lg-12">
                        <div class="no-margin item1-carousel owl-carousel owl-theme">

                            <?php 
                  /*if($InterestedProduct<>null)
                  {
                  	foreach($InterestedProduct as $id=>$item)
                  	{
                  		$viewItemPath='';
                  		$name='';
                  		$price=0;
                  		$imagePath1='';
						$desc='';
                  		foreach($item as $pic=>$picObj)
	              		{	
	              			if($pic=='post')
	              			{
	                  		$viewItemPath=base_url().MY_PATH."viewItem/index/$id?prevURL=".urlencode(current_url());
	                  		$name=$picObj->itemName;
							$desc=$picObj->description;
	                  		if($lang_label<>"english")
				            	$name=$picObj->itemNameCH;
				            $price=$picObj->itemPrice;
	              			}
	              		}
			            foreach($item as $pic=>$picObj)
	              		{	
	              			if($pic=='pic' && $picObj!=null && count($picObj)>0)
	              			{
	              				$checkImgFile=$picObj[0]->thumbnailPath.'/'.$picObj[0]->thumbnailName;
	              				$imagePath1=base_url().$picObj[0]->thumbnailPath.'/'.$picObj[0]->thumbnailName;
	              				if(!is_file_exists($checkImgFile))
	              					$imagePath1 = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
	              				
	              			}
	              			else{
	              				$imagePath1 = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
	              			}
	              		}
	              		echo "<div class=\"item\">";
						echo "<div class=\"item-right\">";
						echo "<span class=\"item-name\"> $name </span>"; 
						echo "<span class=\"item-desc\"> $desc </span>"; 
						echo "<span class=\"item-prc\"> $ $price </span>"; 
						echo "</div>";
						echo "<div class=\"item-left\">";
              			echo "<a href=\"$viewItemPath\">";
                  		echo "<span class=\"item-carousel-thumb\">"; 
                    	echo "<img class=\"img-responsive\" src=\"$imagePath1\" alt=\"img\" width='100%' >";
                     	echo "</span>"; 
                  		echo "</a>";
                  		echo "</div>";
						echo "</div>";
                  	}
                  }*/
                  ?>



                        </div>
                    </div>
                


            </div>

        </div>-->
       
            <div class="inner-box relative panel-bevel">
                <h2 class="title-2" style="border-bottom: 1px solid #E00000;">
					<i class="fa fa-fire" style="color: #E00000;"></i>
					<span style="font-family: MyCustomFont; font-weight: 700; color: #E00000;"><?php echo $indexHotItemTitle;?></span> 
					<?php echo $indexHotItemTitle2;?>
					<a id="nextItem" class="link pull-right carousel-nav" style="color: #E00000;"> <i class="icon-right-open-big"></i></a>
					<a id="prevItem" class="link pull-right carousel-nav" style="color: #E00000;"> <i class="icon-left-open-big"></i> </a>
				</h2>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="no-margin item-carousel owl-carousel owl-theme">

                            <?php 
                  if($HotProduct<>null && count($HotProduct)>0)
                  {
                  	foreach($HotProduct as $id=>$item)
                  	{
                  		$viewItemPath='';
                  		$name='';
                  		$price=0;
                  		$imagePath1='';
						$desc='';
                  		foreach($item as $pic=>$picObj)
	              		{	
	              			if($pic=='post')
	              			{
	                  		$viewItemPath=base_url().MY_PATH."viewItem/index/$id?prevURL=".urlencode(current_url());
	                  		$name=$picObj->itemName;
							$desc=$picObj->description;
	                  		if($lang_label<>"english")
				            	$name=$picObj->itemNameCH;
				            $price=$picObj->itemPrice;
	              			}
	              		}
			            foreach($item as $pic=>$picObj)
	              		{	
	              			if($pic=='pic' && $picObj!=null && count($picObj)>0)
	              			{
	              				$checkImgFile=$picObj[0]->thumbnailPath.'/'.$picObj[0]->thumbnailName;
	              				$imagePath1=base_url().$picObj[0]->thumbnailPath.'/'.$picObj[0]->thumbnailName;
	              				if(!is_file_exists($checkImgFile))
	              					$imagePath1 = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
	              			
              				}else{
              					$imagePath1 = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
              				}
	              		}
	              		echo "<div class=\"item\">";
						echo "<div class=\"item-right\">";
						echo "<span class=\"item-name\"> $name </span>"; 
						echo "<span class=\"item-desc\"> $desc </span>"; 
						echo "<span class=\"item-prc\" style=\"color: #E00000; border:1px solid #E00000;\"> $ $price </span>"; 
						echo "</div>";
						echo "<div class=\"item-left\">";
              			echo "<a href=\"$viewItemPath\">";
                  		echo "<span class=\"item-carousel-thumb\">"; 
                    	echo "<img class=\"img-responsive\" src=\"$imagePath1\" alt=\"img\" width='100%' >";
                     	echo "</span>"; 
                  		echo "</a>";
						echo "</div>";
                  		echo "</div>";
                  	}
                  }
                  ?>
                   </div>
                </div>
            </div>
        </div>
		
		<!--<div class="inner-box relative panel-bevel">
			<h2 class="title-2" style="border-bottom: 1px solid #9A01CC;">
				<i class="fa fa-bookmark" style="color: #9A01CC;"></i>
				<span style="font-family: MyCustomFont;font-weight: 700;color: #9A01CC;"><?php echo $indexHighlightTitle;?></span> <?php echo $indexBlogTitle;?>
				<!--<a id="nextItem2" class="link pull-right carousel-nav" style="color: #9A01CC;"> <i class="icon-right-open-big"></i></a>
				<a id="prevItem2" class="link pull-right carousel-nav" style="color: #9A01CC;"> <i class="icon-left-open-big"></i> </a>
			</h2>
			<div class="row">
				<?php 
                  if($result!=null && sizeof($result)>0){
						$value = $result[sizeof($result)-1];
						$pic1=base_url().$value->picPath1.$value->picName1;
						if(!is_file_exists($pic1))
	              			$pic1 = base_url()."images/defaultPostImg/defaultGTImg_TN.png";
	              		$content=$value->description;
	              		echo "<div class=\"col-md-5\">";
						echo "<div class=\"blog-post-img\"><a href=".base_url()."getBlog/viewBlog/".$value->ID."><figure>";
						echo "<img class=\"img-responsive\" alt=\"blog-post image\" src=$pic1>";
						echo "</figure></a></div></div>"; 
						
						echo "<div class=\"col-md-7\">";
						echo "<div class=\"blog-post-content\">";
						echo "<h2><a style=\"color:black\" href=".base_url()."getBlog/viewBlog/".$value->ID.">$title</a></h2>";
						echo "<span style=\"color:#6B6B6B\" class=\"date\"><i class=\" icon-clock\"> </i> ".$value->createDate ."</span> ";
						echo "<p class=\"overflow-hidden-6\"><a style=\"color:#6B6B6B\" href=".base_url()."getBlog/viewBlog/".$value->ID.">$content</a></p>";
						echo "</div></div>";
                  	
                  }
               ?>
			</div>
		  </div>-->
		
        <div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" tabindex="-1" role="dialog"  data-keyboard="false" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 id ="modal-text">Processing...<?php echo $this->lang->line("PleaseNotCloseBrowseWhileSearching");?> <img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif"></h1>
                                </div>
                                <div class="modal-body">
                                    <div id="progress-bar" class="progress">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar" id="upload-progress-bar"
                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">   
                                        </div>
                                    </div>
									<button id="fwd-btn" class="btn btn-primary btn-tw" onclick="backHomePage(); return false;" style="display: none;"><i class="fa fa-check"></i>Go to Homepage</button>
                                </div>
                            </div>
                        </div>
                    </div>
          
        <div class="inner-box relative panel-bevel">
            <div class="row">
              <div class="col-md-5">
                <div>
                  <h3 class="title-2"> <i class="icon-location-2"></i> <?php echo $this->lang->line("Popular_locations");?>  </h3>
                <div class="row">   <ul class="cat-list col-xs-6">
                <?php 
                if($popularLocation1<>null)
                {
                	foreach ($popularLocation1 as $id=>$value)
	                {
	                	if(!isset($lang_label))
	                		$lang_label="";
	                	$name=$value->name;
	                	$postCount="(".$value->postCount.")";
	                	if(SHOW_BRACKETS_INDEX_PAGE==0)
	                		$postCount="";
	                	if($lang_label<>"english")
	                		$name=$value->nameCN;
	                	$path=base_url().MY_PATH."getCategory/getAll/1/0/$value->locationID";
                  		echo "<li> <a href='$path'><h4>$name $postCount</h4></a></li>";
	                }
                }
                ?>
                 </ul>
                  <ul class="cat-list cat-list-border col-xs-6">
                
                  <?php 
                  if($popularLocation2<>null)
                  {
                  	foreach ($popularLocation2 as $id=>$value)
                  	{
                  		if(!isset($lang_label))
                  			$lang_label="";
                  		$name=$value->name;
                  		$postCount="(".$value->postCount.")";
                  		if(SHOW_BRACKETS_INDEX_PAGE==0)
                  			$postCount="";
                  		if($lang_label<>"english")
                  			$name=$value->nameCN;
                  		$path=base_url().MY_PATH."getCategory/getAll/1/0/$value->locationID";
                  		echo "<li> <a href='$path'><h4>$name $postCount</h4></a></li>";
                  	}
                  }
                  ?>
                 </ul></div>
                  
                </div>
              </div>
              <div class="col-md-7 ">
                <h3 class="title-2"> <i class="icon-search-1"></i> <?php echo $this->lang->line("Popular_Makes");?> </h3>
                <div class="row">
                  <ul class="cat-list col-md-4 col-xs-4 col-xxs-6">
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
                  		echo "<li> <a href='$path'><h4>$name $postCount</h4></a></li>";
                  	}
                  }
                  ?>
                  </ul>
                  <ul class="cat-list col-md-4 col-xs-4 col-xxs-6">
                    <?php 
                  if($popularMakes2<>null)
                  {
                  	foreach ($popularMakes2 as $id=>$value)
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
                  		echo "<li> <a href='$path'><h4>$name $postCount</h4></a></li>";
                  	}
                  }
                  ?>
                  </ul>
                  <ul class="cat-list col-md-4 col-xs-4 col-xxs-6">
                    <?php 
                  if($popularMakes3<>null)
                  {
                  	foreach ($popularMakes3 as $id=>$value)
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
                  		echo "<li> <a href='$path'><h4>$name $postCount</h4></a></li>";
                  	}
                  }
                  ?>
                  </ul>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3 page-sidebar col-thin-left">
          <aside>
            <div class="inner-box no-padding panel-bevel">
              <div class="inner-box-content"> 
              <!-- <a href="<?php echo base_url().MY_PATH;?>howgirlstradeworks"> -->
              <a href="https://www.instagram.com/girlstradehk/">
              <img class="img-responsive" src="<?php echo base_url();?>images/site/app.jpg" alt="tv">
              </a>
              <!-- </a> -->
              </div>
            </div>
            <div class="inner-box panel-bevel">
              <h2 class="title-2 no-bottom"><span style="font-family: MyCustomFont; font-weight: 700; color: #E2348C;">
              <?php echo $indexSideOneTitle;?></span>  <?php echo $indexSideOneTitle2;?> </h2>
              <div class="inner-box-content">
                <ul class="cat-list arrow">
                  <?php 
                  if($popularCategory<>null)
                  {
                  	foreach ($popularCategory as $id=>$value)
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
                  		echo "<li><a href='$path'><h4> $name $postCount</h4></a></li>";
                  	}
                  }
                  ?>
                </ul>
              </div>
            </div>
            
            <div class="inner-box no-padding panel-bevel"><a href="https://www.facebook.com/Donttellpapaplease/"> 
            <img class="img-responsive" src="<?php echo base_url();?>images/site/add2.jpg" alt=""></a> </div>
          	<div class="inner-box has-aff relative">
              <a class="dummy-aff-img" href="category.html"><img src="<?php echo base_url();?>images/site/aff2.png" class="img-responsive" alt=" aff"> </a>

          </div>
          </aside>
        </div>
        
</div>
    </div>
    </div>

    <!-- /.main-container -->

	<div class="page-info userRatingTitleIndexFooterLine" style="background: url(<?php echo base_url();?>images/footerIndex.jpg); 
	background-size:cover">
	<div id="userRatingTitleIndexFooter"><?php echo $indexHowDoesItWorks;?></div>
    
			<div style="border: 0px; background: rgba(0, 0, 0, 0);" class="col-md-3 col-xs-3 col-sm-3 f-category">
				<div class="graph">
					<div class="graph_inner">
						
						<div class="large_num styler_color">
						<i class="icon-login"></i></div>
						<div class="progress_bars_with_image_title styler_color">
						<?php echo $indexWorksStepOne;?>
						</div>
					</div>
				</div>
				<div class="desc styler_bg_color">
					<i class="styler_border_color"></i>
					<div class="name"><?php echo $indexWorksTitleOne;?></div>
					<div class="text"><?php echo $indexWorksDescOne;?></div>
				</div>
			</div>
			
			<div style="border: 0px; background: rgba(0, 0, 0, 0);" class="col-md-3 col-xs-3 col-sm-3 f-category">
				<div class="graph">
					<div class="graph_inner">
						
						<div class="large_num styler_color">
						<i class="icon-pencil-circled"></i></div>
						<div class="progress_bars_with_image_title styler_color">
						<?php echo $indexWorksStepSec;?>
						</div>
						<!--<div class="progress_bars horizontal style1 styler_infograph" data-width="220" 
						data-height="15" data-color="#0eae9b" data-title="inner" data-value="50%"></div>-->
					</div>
				</div>
				<div class="desc styler_bg_color">
					<i class="styler_border_color"></i>
					<div class="name"><?php echo $indexWorksTitleSec;?></div>
					<div class="text"><?php echo $indexWorksDescSec;?></div> 
				</div>
			</div>
			
			<div style="border: 0px; background: rgba(0, 0, 0, 0);" class="col-md-3 col-xs-3 col-sm-3 f-category">
				<div class="graph">
					<div class="graph_inner">
						<div class="progress_bars_with_image styler_infograph visible" data-number="7" data-value="5" data-icon="fa fa-female" data-height="40" data-color="#F171DA" style="font-size: 40px; line-height: 40px; letter-spacing: 0em;"><div class="item fa fa-female active" style="color: rgb(241, 113, 218);"></div><div class="item fa fa-female active" style="color: rgb(241, 113, 218);"></div><div class="item fa fa-female active" style="color: rgb(241, 113, 218);"></div><div class="item fa fa-female active" style="color: rgb(241, 113, 218);"></div><div class="item fa fa-female active" style="color: rgb(241, 113, 218);"></div><div class="item fa fa-female"></div><div class="item fa fa-female"></div></div>
						<div class="progress_bars_with_image_title styler_color"><?php echo $indexWorksStepThird;?></div>
					</div>
				</div>
				<div class="desc styler_bg_color">
					<i class="styler_border_color"></i>
					<div class="name"><?php echo $indexWorksTitleThird;?></div>
					<div class="text"><?php echo $indexWorksDescThird;?></div>
				</div>
			</div>
			<div style="border: 0px; background: rgba(0, 0, 0, 0);" class="col-md-3 col-xs-3 col-sm-3 f-category">
				<div class="graph">
					<div class="graph_inner">
					<div class="large_num styler_color">
					<i class="fa fa-exchange"></i></div>
					<div class="progress_bars_with_image_title styler_color">
					<?php echo $indexWorksStepFourth;?>
					</div>
					</div>
				</div>
				<div class="desc styler_bg_color">
					<i class="styler_border_color"></i>
					<div class="name"><?php echo $indexWorksTitleFourth;?></div>
					<div class="text"><?php echo $indexWorksDescFourth;?></div>
				</div>
			</div>
			<div class="container text-center section-promo" style=""> 
    	
    
    </div>
  </div>

  <!-- /.page-info -->
  <!-- ending body -->
    <?php include "footer1.php"; ?>
	<!-- JS Global Compulsory -->
<!-- <script src="assets/plugins/jquery/jquery.min.js"></script> -->
<!-- <script src="assets/plugins/jquery/jquery-migrate.min.js"></script> -->
<!-- <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> -->
<!-- JS Implementing Plugins -->

<script>

function showDetailCatDiv() {
   document.getElementById('detailCategoryList').style.display = 'block';
   document.getElementById('summaryCategoryList').style.display = 'none';
    
}

function showSummaryCatDiv() {
	   document.getElementById('summaryCategoryList').style.display = 'block';
	   document.getElementById('detailCategoryList').style.display = 'none';
	    
	}

function setup(){
	var catID=document.getElementById("search-category").value;
 	var locID=0;
	var keywords=document.getElementById("ads").value;
	   if(keywords.trim()=='')
		   keywords='0';
	   var minPrice=0;
		   
	   var maxPrice=0;

	   $('#pleaseWaitDialog').modal('show');

      setForm(function(data)
       {
           if(data == true)
           {
				$.ajax({
					xhr: function()
					{
						var xhr = new window.XMLHttpRequest();
						//Upload progress
						xhr.upload.addEventListener("progress", function(evt){
						  if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total*100;
							//Do something with upload progress
							$("#upload-progress-bar").width(percentComplete+"%");
							console.log(percentComplete);
						  }
						}, false);
						return xhr;
					},
					url: "<?php echo base_url().MY_PATH; ?>getCategory/getAll/1/".concat(catID).concat("/").concat(locID).concat("/").concat(keywords).concat("/").concat(sortByID).concat("/").concat(minPrice).concat("/").concat(maxPrice).concat("/").concat(activeTab),
					//data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					success:function(msg){
						$('#progress-bar').css("display", "none");
						$('#pleaseWaitDialog').modal('hide');
					}
				});
           }
           return data;
       });
}
function setForm(callback)
{
	  $('.progress-bar').css('width', 100+'%').attr('aria-valuenow', 100);
		callback(true);
}
</script>

<script src="<?php echo base_url();?>assets/plugins/back-to-top.js"></script>
<script src="<?php echo base_url();?>assets/plugins/smoothScroll.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.parallax.js"></script>
<script src="<?php echo base_url();?>assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo base_url();?>assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<!-- JS Customization -->
<script src="<?php echo base_url();?>assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="<?php echo base_url();?>assets/js/shop.app.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/owl-carousel.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/revolution-slider.js"></script>
<!--Drop Down list-->

<script>
    jQuery(document).ready(function() {
        App.init();
        App.initScrollBar();
        App.initParallaxBg();
        OwlCarousel.initOwlCarousel();
        RevolutionSlider.initRSfullWidth();     
    });
</script>
    <?php include "footer2.php"; ?>