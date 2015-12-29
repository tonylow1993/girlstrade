<div class="col-sm-3 page-sidebar">
         <aside>
            <div class="inner-box">
              <div class="user-panel-sidebar">
<!--                 <div class="collapse-box"> -->
<!--                   <h5 class="collapse-title no-border"> My Classified <a class="pull-right" data-toggle="collapse"  href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5> -->
<!--                   <div id="MyClassified" class="panel-collapse collapse in"> -->
<!--                     <ul class="acc-list"> -->
                      <?php 
                      
//                       	$accountpage=base_url().MY_PATH."home/getAccountPage/".$activeNav;              	      	 
//                 		if($activeNav==2)
//                       	 	echo "<li><a class=\"active\" href=$accountpage> $ApproveRequest </a></li>";
//                       	 else if($activeNav==3)
//                       	 	echo "<li><a  class=\"active\" href=$accountpage> $MyAds </a></li>";
//                       	 else if($activeNav==5)
//                       	 	echo "<li><a class=\"active\" href=$accountpage> $SavedItems </a></li>";
//                       	 else if($activeNav==6)
//                       	 	echo "<li><a class=\"active\" href=$accountpage> $PendingRequest </a></li>";
//                       	 else if($activeNav==7)
//                       	 	echo "<li><a class=\"active\" href=$accountpage> $ApprovedRequest </a></li>";
//                       	 else if($activeNav==11)
//                       	 	echo "<li><a class=\"active\" href=$accountpage> ".$this->lang->line("BuyAdsHistory")." </a></li>";
//                       	 else if($activeNav==12)
//                       	 	echo "<li><a class=\"active\" href=$accountpage> ".$this->lang->line("directsend_history")." </a></li>";
                      	  
//                       ?>
                
<!--                     </ul> -->
<!--                   </div> -->
<!--                 </div> -->

                                
                <?php
                
                echo "<div class=\"collapse-box\">";
                $approverequest1=base_url().MY_PATH."home/getAccountPage/2";
              	$saveditems1=base_url().MY_PATH."home/getAccountPage/5";
              	$myads1=base_url().MY_PATH."home/getAccountPage/3";
		        $pendingrequest1=base_url().MY_PATH."home/getAccountPage/6";
              	
              	 
              		echo "<h5 class=\"collapse-title\">".$this->lang->line('menuAds')."<a class=\"pull-right\" data-toggle=\"collapse\"  href=\"#ProfileMenuAds\"><i class=\"fa fa-angle-down\"></i></a></h5>";
                 	 echo "<div id=\"ProfileMenuAds\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                	if($activeNav==2)
              			echo "<li><a  class=\"active\" href=$approverequest1> $ApproveRequest <span class=\"badge\">$approveMsgCount</span></a></li>";
              	 	else 
              	 	echo "<li><a href=$approverequest1> $ApproveRequest <span class=\"badge\">$approveMsgCount</span></a></li>";
              	 	
              	 	if($activeNav==3)
              	 		echo "<li><a  class=\"active\" href=$myads1> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     	else 
         	     		echo "<li><a href=$myads1> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     		
         	     if($activeNav==5)
              				echo "<li><a  class=\"active\" href=$saveditems1> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
         	     	else 
         	     		echo "<li><a href=$saveditems1> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
         	     	
         	     if($activeNav==6)
              		echo "<li><a  class=\"active\" href=$pendingrequest1> $PendingRequest <span class=\"badge\">$pendingMsgCount</span></a></li>";
          		 	else 
          		 		echo "<li><a href=$pendingrequest1> $PendingRequest <span class=\"badge\">$pendingMsgCount</span></a></li>";
          		 		
         	    
          		 	echo "</ul>";
                  	echo "</div>";
              	echo "</div>";
                ?>
                
                <div class="collapse-box">
                  <h5 class="collapse-title"> <?php echo $this->lang->line("menuEvaluation");?> <a class="pull-right" data-toggle="collapse"  href="#ProfileMenuEvaluate"><i class="fa fa-angle-down"></i></a></h5>
                  <div id="ProfileMenuEvaluate" class="panel-collapse collapse in">
                    <ul class="acc-list">
                    	<?php
                 	   $approvedrequest1=base_url().MY_PATH."home/getAccountPage/7";
              	$buyAdsHistory1=base_url().MY_PATH."home/getAccountPage/11";
              	$directsentHistory1=base_url().MY_PATH."home/getAccountPage/12";
              	$directsentHistory2=base_url().MY_PATH."home/getAccountPage/13";
              		 if($activeNav==7)
              		echo "<li><a  class=\"active\" href=$approvedrequest1> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          		else 
          			echo "<li><a href=$approvedrequest1> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          			 
         	     if($activeNav==11)
              		echo "<li><a  class=\"active\" href=$buyAdsHistory1>".$this->lang->line("BuyAdsHistory")."<span class=\"badge\">$buyAdsCount</span></a></li>";
          		 	else 
          		 		echo "<li><a href=$buyAdsHistory1>".$this->lang->line("BuyAdsHistory")."<span class=\"badge\">$buyAdsCount</span></a></li>";
          		 		
         	     if($activeNav==12)
              		echo "<li><a  class=\"active\" href=$directsentHistory1>".$this->lang->line("directsend_history")."<span class=\"badge\">$directsendhistCount</span></a></li>";
          		 	else 
          		 		echo "<li><a href=$directsentHistory1>".$this->lang->line("directsend_history")."<span class=\"badge\">$directsendhistCount</span></a></li>";
          		 	
          		 	if($activeNav==13)
          		 		echo "<li><a  class=\"active\" href=$directsentHistory2>".$this->lang->line("directsend_history_seller")."<span class=\"badge\">$directsendhistCount1</span></a></li>";
          		 	else
          		 		echo "<li><a href=$directsentHistory2>".$this->lang->line("directsend_history_seller")."<span class=\"badge\">$directsendhistCount1</span></a></li>";
          		 	 
          		 	
          		 	
          		 	?>
                      </ul>
                  </div>
                </div>
                
                <div class="collapse-box">
                  <h5 class="collapse-title"> <?php echo $AccountTabName;?> <a class="pull-right" data-toggle="collapse"  href="#ProfileMenuAccount"><i class="fa fa-angle-down"></i></a></h5>
                  <div id="ProfileMenuAccount" class="panel-collapse collapse in">
                    <ul class="acc-list">
                    	<?php
                 	    $editprofile1=base_url().MY_PATH."home/getAccountPage/4";
		             	 $accountinbox=base_url().MY_PATH."home/getAccountPage/1";
		             	 $outgoingMsg=base_url().MY_PATH."home/getAccountPage/10";
              			 if($activeNav==4)
              					echo "<li><a  class=\"active\" href=$editprofile1> $EditProfile <span class=\"badge\"></span></a></li>";
         	     		 else 
         	     		 	echo "<li><a href=$editprofile1> $EditProfile <span class=\"badge\"></span></a></li>";
         	     		 	 
         	     		 if($activeNav==1)
              					echo "<li><a  class=\"active\" href=$accountinbox> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
         	     		 else 
         	     		 	echo "<li><a href=$accountinbox> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
         	     		 	 
         	     		 if($activeNav==10)
              					echo "<li><a  class=\"active\" href=$outgoingMsg> $OutgoingMsgTitle <span class=\"badge\">$outgoingMsgCount</span> </a></li>";
         	     			else 
         	     				echo "<li><a href=$outgoingMsg> $OutgoingMsgTitle <span class=\"badge\">$outgoingMsgCount</span> </a></li>";
         	     				
         	     		 ?>
                      </ul>
                  </div>
                </div>
              </div>
            </div>
            
          </aside>
        </div>
