<div class="col-sm-3 page-sidebar">
         <aside>
            <div class="inner-box">
              <div class="user-panel-sidebar">
                 <?php
                
                echo "<div class=\"collapse-box\">";
                $adminPostPath=base_url().MY_PATH."getAdmin/getAccountPage/1";
              	$adminPhotoPath=base_url().MY_PATH."getAdmin/getAccountPage/2";
              	 $adminUserPath =base_url().MY_PATH."getAdmin/getAccountPage/3";     
              	 $updatePostPath =base_url().MY_PATH."getAdmin/getAccountPage/4";
              	 $deleteUserPath=base_url().MY_PATH."getAdmin/getAccountPage/5";
              	 $itemCommentPath=base_url().MY_PATH."getAdmin/getAccountPage/6";
              	 $postCommentPath=base_url().MY_PATH."getAdmin/getAccountPage/7";
              	 $abuseMessagePath=base_url().MY_PATH."getAdmin/getAccountPage/8";
              	 $sendEmailPath=base_url().MY_PATH."getAdmin/getAccountPage/9";
              	 
              		echo "<h5 class=\"collapse-title\"> ".$this->lang->line('lblMenu')." <a class=\"pull-right\" data-toggle=\"collapse\"  href=\"#Home\"><i class=\"fa fa-angle-down\"></i></a></h5>";
                 	 echo "<div id=\"Home\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                 	 
                	if($activeNav==1)
                      	echo "<li><a class=\"active\" href=$adminPostPath>". $this->lang->line('adminPost')." <span class=\"badge\"></span></a></li>";
              	  	else 
              	  		echo "<li><a href=$adminPostPath>". $this->lang->line('adminPost')." <span class=\"badge\"></span></a></li>";
              	  	if($activeNav==2)
                      	echo "<li><a  class=\"active\" href=$adminPhotoPath> ".$this->lang->line('adminPhoto') ." <span class=\"badge\"></span></a></li>";
                	else 
                   	echo "<li><a href=$adminPhotoPath> ".$this->lang->line('adminPhoto') ." <span class=\"badge\"></span></a></li>";
                	if($activeNav==3)
                      	echo "<li><a  class=\"active\" href=$adminUserPath> ".$this->lang->line('updateUser') ." <span class=\"badge\"></span></a></li>";
                	else 
              	    	echo "<li><a href=$adminUserPath> ".$this->lang->line('updateUser') ." <span class=\"badge\"></span></a></li>";
                	if($activeNav==4)
                      	echo "<li><a  class=\"active\" href=$updatePostPath>".$this->lang->line('updatePost') ." <span class=\"badge\"></span></a></li>";
                	else 
              	   	echo "<li><a href=$updatePostPath>".$this->lang->line('updatePost') ." <span class=\"badge\"></span></a></li>";
                	if($activeNav==6)
                		echo "<li><a  class=\"active\" href=$itemCommentPath>".$this->lang->line('approveitemComment') ." <span class=\"badge\"></span></a></li>";
                	else
                	echo "<li><a href=$itemCommentPath>".$this->lang->line('approveitemComment') ." <span class=\"badge\"></span></a></li>";
                	if($activeNav==7)
                		echo "<li><a  class=\"active\" href=$postCommentPath>".$this->lang->line('approvePostComment') ." <span class=\"badge\"></span></a></li>";
                	else
                		echo "<li><a href=$postCommentPath>".$this->lang->line('approvePostComment') ." <span class=\"badge\"></span></a></li>";
                	if($activeNav==8)
                		echo "<li><a  class=\"active\"  href=$abuseMessagePath>".$this->lang->line('abuseMessage') ." <span class=\"badge\"></span></a></li>";
                	else
                		echo "<li><a href=$abuseMessagePath>".$this->lang->line('abuseMessage') ." <span class=\"badge\"></span></a></li>";
                	
                	if($activeNav==5)
                      	echo "<li><a  class=\"active\" href=$deleteUserPath>".$this->lang->line('deleteUser') ." <span class=\"badge\"></span></a></li>";
              	  	else
              	   	echo "<li><a href=$deleteUserPath>".$this->lang->line('deleteUser') ." <span class=\"badge\"></span></a></li>";
              	  
              	  	if($activeNav==9)
              	  		echo "<li><a  class=\"active\" href=$sendEmailPath>".$this->lang->line('sendEmail') ." <span class=\"badge\"></span></a></li>";
              	  	else
              	  		echo "<li><a href=$sendEmailPath>".$this->lang->line('sendEmail') ." <span class=\"badge\"></span></a></li>";
              	  	 
          		 	echo "</ul>";
                  	echo "</div>";
                echo "</div>";
                ?>
              
              </div>
            </div>
            
          </aside>
        </div>
