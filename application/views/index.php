<?php
$title = "Girls' Trading Platform"; 
  include("header.php"); ?>

<script>
window.onload = function(){
	   document.getElementById("ads").focus();
	};
</script>

				
<div class="intro">
    <div class="dtable hw100">
      <div class="dtable-cell hw100">
        <div class="container text-center">
       <h1 class="intro-title animated fadeInDown"> Search Something For Yourself  </h1>
		<p class="sub animateme fittext3 animated fadeIn"> A Platform for Girls Only </p>
           <form action="<?php echo base_url().MY_PATH;?>getCategory/getAll/1" method="POST">
          
          <div class="row search-row animated fadeInUp">
			<div class="col-lg-4 col-sm-4 search-col relative"> <i class="icon-docs icon-append icon-index"></i>
                <input type="text" name="ads" id="ads"  class="form-control has-icon"  placeholder="<?php echo $this->lang->line("Looking_For"); ?>"  value="">
              </div>	
				<div class="col-sm-4  col-sm-4 search-col relative">
				
                <select class="btn btn-catSelect btn-search btn-block  catSelect dropdown-toggle" name="category" id="search-category">
                    <option <?php if($catID="" or $catID=0) echo "selected='selected'"; ?> value="">
                        <?php echo $this->lang->line("lblAllCategories");?>
                    </option>
                    <?php 
            foreach ($AllCategory as $id=>$value)
            {
               	if(!isset($lang_label))
	            		$lang_label="";
            	$name=$value[0]->name;
            	$postCount="(".$value[0]->postCount.")";
            	if($lang_label<>"english")
            		$name=$value[0]->nameCH;
            	if($value[0]->level==1)
            		echo "<option value='".$id."' style='font-weight:bold;' >".$name.$postCount."</option>";
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
					
                    <img src="assets/img/1.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch1 sft start"
                        data-x="center"
                        data-hoffset="0"
                        data-y="100"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        A Place For<br>
						<strong>Girls</strong><br>
						To<br>
                        <strong>Trade</strong><br>
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
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Search Now</a>
                    </div>
                </li>
                <!-- END SLIDE -->

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 2">
                    <!-- MAIN IMAGE -->
                    <img src="assets/img/5.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch3 sft start"
                        data-x="right"
                        data-hoffset="0"
                        data-y="140"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        <strong>Post</strong>
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
                        Within Three Clicks Away
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
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Post Now</a>
                    </div>
                </li>
                <!-- END SLIDE -->

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 3">
                    <!-- MAIN IMAGE -->
                    <img src="assets/img/3.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch3 sft start"
                        data-x="right"
                        data-hoffset="5"
                        data-y="130"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        <strong>Hong Kong</strong> 
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
                        Only Trade Within<br>
                        The Hong Kong Network
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
                    <img src="assets/img/2.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

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
                        <strong>Feedback</strong> 
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
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Give A Review</a>
                    </div>
                </li>
                <!-- END SLIDE -->                

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 5">
                    <!-- MAIN IMAGE -->
                    <img src="assets/img/4.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch5 sft start"
                        data-x="right"
                        data-hoffset="5"
                        data-y="130"
                        data-speed="1500"
                        data-start="500"
                        data-easing="Back.easeInOut"
                        data-endeasing="Power1.easeIn"                        
                        data-endspeed="300">
                        <strong>Advertisement</strong>
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
                        Let Us Help You Advertise Your Business
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
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Contact Us</a>
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
          <div class="inner-box category-content panel-bevel">
            <h2 class="title-2"><span style="font-family: MyCustomFont; font-weight: 700; color: #E2348C;">Discover</span> from Listing</h2>
             <div class="row">
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
            		echo "<h3 class=\"cat-title\"><img  style=\"margin:0px; padding:0px;\"  src=$imageIcon alt='' height='30' width='30'><a class=\"title-font\"  style=\"margin:0px; padding:0px;\"  href='$path'>$name $postCount</a>";
            		
            		echo "<span data-target=\".cat-id-$total\"  data-toggle=\"collapse\"  class=\"btn-cat-collapsed collapsed\">   <span class=\" icon-down-open-big\"></span> </span>";
            		echo "</h3>";
            		echo "<ul class=\"cat-collapse collapse in cat-id-$total\">";
            		} else {
            			echo "<div class=\"cat-list\">";
            			echo "<h3 ><img style=\"margin:0px; padding:0px;\"  src=$imageIcon alt='' height='30' width='30'><a class=\"title-font\" style=\"margin:0px; padding:0px;\" href='$path'>$name $postCount</a>";
            			
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
                <div class="inner-box relative panel-bevel">
                <h2 class="title-2"><span style="font-family: MyCustomFont; font-weight: 700; color: #E2348C;">Interested</span> Items
            
                <a id="nextItem1" class="link  pull-right carousel-nav"> <i class="icon-right-open-big"></i></a>
             <a id="prevItem1" class="link pull-right carousel-nav"> <i class="icon-left-open-big"></i> </a>

            </h2>
			
            <div class="row">
                    <div class="col-lg-12">
                        <div class="no-margin item1-carousel owl-carousel owl-theme">

                            <?php 
                  if($InterestedProduct<>null)
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
	              			if($pic=='pic')
	              			{$imagePath1=base_url().$picObj[0]->thumbnailPath.'/'.$picObj[0]->thumbnailName;
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
                  }
                  ?>



                        </div>
                    </div>
                


            </div>

        </div>
       
            <div class="inner-box relative panel-bevel">
                <h2 class="title-2"><span style="font-family: MyCustomFont; font-weight: 700; color: #E2348C;">Hot</span> Items
            
                          <a id="nextItem" class="link  pull-right carousel-nav"> <i class="icon-right-open-big"></i></a>
             <a id="prevItem" class="link pull-right carousel-nav"> <i class="icon-left-open-big"></i> </a>

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
	              			{$imagePath1=base_url().$picObj[0]->thumbnailPath.'/'.$picObj[0]->thumbnailName;
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
                  }
                  ?>
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
              <div class="inner-box-content"> <a href="#"><img class="img-responsive" src="images/site/app.jpg" alt="tv"></a> </div>
            </div>
            <div class="inner-box panel-bevel">
              <h2 class="title-2 no-bottom"><span style="font-family: MyCustomFont; font-weight: 700; color: #E2348C;">Popular</span> Categories </h2>
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
            
            <div class="inner-box no-padding panel-bevel"> <img class="img-responsive" src="images/site/add2.jpg" alt=""> </div>
          </aside>
        </div>
        
</div>
    </div>
    </div>
    
    <!-- /.main-container -->

	  <div class="page-info" style="background: url(images/bg.jpg); background-size:cover">
    <div class="container text-center section-promo"> 
    	<div class="row">
        	<div class="col-sm-3 col-xs-6 col-xxs-12">
                <div class="iconbox-wrap">
                          <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                            <i class="icon  icon-group"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                              <h5><span><?php echo $indexstat["trustedseller"];?></span> </h5>
                              <div  class="iconbox-wrap-text"><?php echo  $Trusted_Seller;?></div>
                            </div>
                          </div>
  							<!-- /..iconbox -->
                     </div><!--/.iconbox-wrap-->
            </div>
            
            <div class="col-sm-3 col-xs-6 col-xxs-12">
            	<div class="iconbox-wrap">
                          <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                            <i class="icon  icon-th-large-1"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                              <h5><span><?php echo $indexstat["category"];?></span> </h5>
                              <div  class="iconbox-wrap-text"><?php echo $Categories;?></div>
                            </div>
                          </div>
  							<!-- /..iconbox -->
                     </div><!--/.iconbox-wrap-->
            </div>
            
            <div class="col-sm-3 col-xs-6  col-xxs-12">
            	<div class="iconbox-wrap">
                          <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                            <i class="icon  icon-map"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                              <h5><span><?php echo $indexstat["location"];?></span> </h5>
                              <div  class="iconbox-wrap-text"><?php  echo $Location;?></div>
                            </div>
                          </div>
  							<!-- /..iconbox -->
                     </div><!--/.iconbox-wrap-->
            </div>
            
            <div class="col-sm-3 col-xs-6 col-xxs-12">
            	<div class="iconbox-wrap">
                          <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                            <i class="icon icon-facebook"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                              <h5><span><?php echo $indexstat["facebookfans"];?></span> </h5>
                              <div  class="iconbox-wrap-text"> <?php echo $Facebook_Fans;?></div>
                            </div>
                          </div>
  							<!-- /..iconbox -->
                     </div><!--/.iconbox-wrap-->
            </div>
            
        </div>
    
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
<script src="assets/plugins/back-to-top.js"></script>
<script src="assets/plugins/smoothScroll.js"></script>
<script src="assets/plugins/jquery.parallax.js"></script>
<script src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="assets/js/shop.app.js"></script>
<script src="assets/js/plugins/owl-carousel.js"></script>
<script src="assets/js/plugins/revolution-slider.js"></script>
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