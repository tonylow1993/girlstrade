<div class="inner-box">
          <div class="row">
            <div class="col-md-5 col-xs-4 col-xxs-12">
            
<!--             <div class="col-sm-2 no-padding photobox"></div> 
					<div class="add-image"> <img class="thumbnail no-margin" src="<?php echo $userPhotoPath;?>"  alt="user"><?php echo $userName; ?></div>         			
		   -->
		             <h3 class="no-padding text-center-480 useradmin"><a href="<?php echo base_url().MY_PATH;?>viewProfile/viewByUserID/<?php echo $userID.'/1?prevURL='.urlencode(current_url());?>"><img class="userImg" src="<?php echo $userPhotoPath;?>" alt="user"></a>
		             
		             <a href="<?php echo base_url().MY_PATH;?>viewProfile/viewByUserID/<?php echo $userID.'/1?prevURL='.urlencode(current_url()).'&prevProfile_Url='.urlencode(current_url());?>"> <?php echo $userName; ?></a></h3>
            
            </div>
            <div class="col-md-7 col-xs-8 col-xxs-12">
              <div class="header-data text-center-xs"> 
                
                <!-- Traffic data -->
                <div class="hdata">
                  <div class="mcol-left"> 
                    <!-- Icon with red background --> 
                    <i class="fa fa-eye ln-shadow shape-8"></i> </div>
                  <div class="mcol-right"> 
                    <!-- Number of visitors -->
                    <p><a class="not-active"><?php echo $visitCount; ?></a> <em><?php echo $accountHeaderVisitLang;?></em></p>
                  </div>
                  <div class="clearfix"></div>
                </div>
                
                <!-- revenue data -->
                <div class="hdata">
                  <div class="mcol-left"> 
                    <!-- Icon with green background --> 
                    <i class="fa fa-pencil ln-shadow shape-4"></i> </div>
                  <div class="mcol-right"> 
                    <!-- Number of visitors -->
                    <p><a class="not-active"><?php echo $totalMyAdsCount;?></a><em><?php echo $accountHeaderAdsLang;?></em></p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
          </div>
   
