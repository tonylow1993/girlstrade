<div class="inner-box">
          <div class="row">
            <div class="col-md-5 col-xs-4 col-xxs-12">
                <h3 class="no-padding text-center-480 useradmin"><img class="userImg" src="<?php echo $userPhotoPath;?>" alt="user"> <?php echo $userName; ?> </h3>
            	<form id="newPost" class="form-horizontal" method="post" enctype="multipart/form-data"
                      action="<?php echo base_url(); echo MY_PATH;?>home/uploadPhoto/<?php echo $userID.'/'.$userName; ?>">
             
         <fieldset>
           				<div class="form-group">
                      	       <input id="image1" name="image1" class="file" type="file" accept="image/*">
                                    <div id="uploadImgError1"></div>
                                      <button type="submit" class="btn btn-primary btn-tw" onclick="setup(); return false;"><i class="glyphicon glyphicon-upload"></i>Upload</button>
                           			   <button id="validate" hidden="true" type="submit"></button>
                             </div>
                            
                  </fieldset>
           	<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" tabindex="-1" role="dialog"  data-keyboard="false" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1>Processing...<?php echo $this->lang->line("PleaseNotCloseBrowse");?> <img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif"></h1>
                                </div>
                                <div class="modal-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">   
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
            </div>
            <div class="col-md-7 col-xs-8 col-xxs-12">
              <div class="header-data text-center-xs"> 
                
                <!-- Traffic data -->
                <div class="hdata">
                  <div class="mcol-left"> 
                    <!-- Icon with red background --> 
                    <i class="fa fa-eye ln-shadow"></i> </div>
                  <div class="mcol-right"> 
                    <!-- Number of visitors -->
                    <p><a href="#"><?php echo $visitCount; ?></a> <em>visits</em></p>
                  </div>
                  <div class="clearfix"></div>
                </div>
                
                <!-- revenue data -->
                <div class="hdata">
                  <div class="mcol-left"> 
                    <!-- Icon with green background --> 
                    <i class="icon-th-thumb ln-shadow"></i> </div>
                  <div class="mcol-right"> 
                    <!-- Number of visitors -->
                    <p><a href="#"><?php echo $totalMyAdsCount;?></a><em>Ads</em></p>
                  </div>
                  <div class="clearfix"></div>
                </div>
                
                <!-- revenue data -->
                <div class="hdata">
                  <div class="mcol-left"> 
                    <!-- Icon with blue background --> 
                    <i class="fa fa-user ln-shadow"></i> </div>
                  <div class="mcol-right"> 
                    <!-- Number of visitors -->
                    <p><a href="#"><?php echo $favoriteAdsCount;?></a> <em>Favorites </em></p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
          </div>
   
