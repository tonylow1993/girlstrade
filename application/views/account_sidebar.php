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
				<div class="collapse-box">
                  <div class="collapse-title"  href="#ProfileMenuAccount"> 
                  <a id="menuTitle" data-toggle="collapse"  href="#ProfileMenuAccount" style="display:block;">
                  <span id="menuTitle"><i class="icon-user-woman"></i><?php echo $AccountTabName;?> 
                  </span>
                  </a>
                  <a id="menuTitle" class="pull-right" data-toggle="collapse"  href="#ProfileMenuAccount">
                  <span id="menuTitle"><i class="fa fa-angle-down collapseIcon"></i></span></a></div>
                  <div id="ProfileMenuAccount" class="panel-collapse collapse in">
                    <ul class="acc-list">
                    	<?php
                 	    $editprofile1=base_url().MY_PATH."home/getAccountPage/4";
		             	 $accountinbox=base_url().MY_PATH."home/getAccountPage/1";
		             	 $outgoingMsg=base_url().MY_PATH."home/getAccountPage/10";
		             	 $sendEmailconfig=base_url().MY_PATH."home/getAccountPage/12";
		             	 
              			 if($activeNav==4)
              					echo "<li><a  class=\"active\" href=$editprofile1><i class=\"icon-pencil-2\"></i> $EditProfile <span class=\"badge\"></span></a></li>";
         	     		 else 
         	     		 	echo "<li><a href=$editprofile1><i class=\"icon-user\"></i> $EditProfile <span class=\"badge\"></span></a></li>";
         	     		 if($activeNav==12)
         	     		 	echo "<li><a  class=\"active\" href=$sendEmailconfig><i class=\"icon-pencil-2\"></i>". $this->lang->line("updateSendEmailConfig")." <span class=\"badge\"></span></a></li>";
         	     		 else
         	     			echo "<li><a href=$sendEmailconfig><i class=\"icon-user\"></i>". $this->lang->line("updateSendEmailConfig")." <span class=\"badge\"></span></a></li>";
         	     		 	
         	     		 if($activeNav==1)
              					echo "<li><a  class=\"active\" href=$accountinbox><i class=\"icon-pencil-2\"></i> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
         	     		 else 
         	     		 	echo "<li><a href=$accountinbox><i class=\"icon-mail\"></i> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
         	     		 	 
         	     		 if($activeNav==10)
              					echo "<li><a  class=\"active\" href=$outgoingMsg><i class=\"icon-reply\"></i> $OutgoingMsgTitle <span class=\"badge\">$outgoingMsgCount</span> </a></li>";
         	     			else 
         	     				echo "<li><a href=$outgoingMsg><i class=\"icon-reply\"></i> $OutgoingMsgTitle <span class=\"badge\">$outgoingMsgCount</span> </a></li>";
         	     				
         	     		 ?>
                      </ul>
                  </div>
                </div>
                
                
                                
                <?php
                
                echo "<div class=\"collapse-box\">";
                $approverequest1=base_url().MY_PATH."home/getAccountPage/2";
              	$saveditems1=base_url().MY_PATH."home/getAccountPage/5";
              	$myads1=base_url().MY_PATH."home/getAccountPage/3";
		        $pendingrequest1=base_url().MY_PATH."home/getAccountPage/6";
              	
              	 
              		echo "<div class=\"collapse-title\"><a data-toggle=\"collapse\"  href=\"#ProfileMenuAds\" style=\"display:block;\"><span id=\"menuTitle\"><i class=\"icon-docs\"></i>".$this->lang->line('menuAds')."</span></a><a id=\"menuTitle\" class=\"pull-right\" data-toggle=\"collapse\"  href=\"#ProfileMenuAds\"><span id=\"menuTitle\"><i class=\"fa fa-angle-down collapseIcon\"></i></span></a></div>";
                 	 echo "<div id=\"ProfileMenuAds\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                	
              	 	if($activeNav==3)
              	 		echo "<li><a  class=\"active\" href=$myads1><i class=\"icon-th-thumb\"></i> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     	else 
         	     		echo "<li><a href=$myads1><i class=\"icon-th-thumb\"></i> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     $sellerCount=$approveMsgCount+$directsendhistCount1;		
         	     if($activeNav==2)
         	   		echo "<li><a  class=\"active\" href=$approverequest1><i class=\"icon-thumbs-up-1\"></i> Seller List <span class=\"badge\">$sellerCount</span></a></li>";
       			else 
       				echo "<li><a href=$approverequest1><i class=\"icon-ok-1\"></i> Seller List <span class=\"badge\">$sellerCount</span></a></li>";
         	     $buyerCount=$pendingMsgCount+$directsendhistCount;				 
         	     if($activeNav==6)
              		echo "<li><a  class=\"active\" href=$pendingrequest1><i class=\"icon-clock-2\"></i> Buyer List <span class=\"badge\">$buyerCount</span></a></li>";
          		 	else 
          		 		echo "<li><a href=$pendingrequest1><i class=\"icon-clock-2\"></i> Buyer List <span class=\"badge\">$buyerCount</span></a></li>";
          		 if($activeNav==5)
          				echo "<li><a  class=\"active\" href=$saveditems1><i class=\"icon-heart\"></i> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
       	 			else
   		 				echo "<li><a href=$saveditems1><i class=\"icon-heart\"></i> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
          		 		
         	    
          		 	echo "</ul>";
                  	echo "</div>";
              	echo "</div>";
                ?>
                
                <div class="collapse-box">
                  <div class="collapse-title"> 
                  <a id="menuTitle" data-toggle="collapse"  href="#ProfileMenuEvaluate" style="display:block;">
                  <span id="menuTitle">
                  <i class="icon-clipboard"></i><?php echo $this->lang->line("menuEvaluation");?> 
                  </span>
                  </a>
                  <a id="menuTitle" class="pull-right" data-toggle="collapse"  href="#ProfileMenuEvaluate" style="display:inline;">
                  <span id="menuTitle">
                  <i class="fa fa-angle-down collapseIcon"></i>
                  </span>
                  </a></div>
                  <div id="ProfileMenuEvaluate" class="panel-collapse collapse in">
                    <ul class="acc-list">
                    	<?php
                 	   $approvedrequest1=base_url().MY_PATH."home/getAccountPage/7";
              	$buyAdsHistory1=base_url().MY_PATH."home/getAccountPage/11";
              	$directsentHistory1=base_url().MY_PATH."home/getAccountPage/12";
              	$directsentHistory2=base_url().MY_PATH."home/getAccountPage/13";
              		 if($activeNav==7)
              		echo "<li><a  class=\"active\" href=$approvedrequest1><i class=\"icon-hammer\"></i> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          		else 
          			echo "<li><a href=$approvedrequest1><i class=\"icon-hammer\"></i> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          			 
         	     if($activeNav==11)
              		echo "<li><a  class=\"active\" href=$buyAdsHistory1><i class=\"icon-th-list-2\"></i>".$this->lang->line("ContactedAdsHistory")."<span class=\"badge\">$buyAdsCount</span></a></li>";
          		 	else 
          		 		echo "<li><a href=$buyAdsHistory1><i class=\"icon-th-list-2\"></i>".$this->lang->line("ContactedAdsHistory")."<span class=\"badge\">$buyAdsCount</span></a></li>";
          		 		
//          	     if($activeNav==12)
//               		echo "<li><a  class=\"active\" href=$directsentHistory1><i class=\"icon-mouse\"></i>".$this->lang->line("directsend_history")."<span class=\"badge\">$directsendhistCount</span></a></li>";
//           		 	else 
//           		 		echo "<li><a href=$directsentHistory1><i class=\"icon-mouse\"></i>".$this->lang->line("directsend_history")."<span class=\"badge\">$directsendhistCount</span></a></li>";
          		 	
//           		 	if($activeNav==13)
//           		 		echo "<li><a  class=\"active\" href=$directsentHistory2><i class=\"icon-users-1\"></i>".$this->lang->line("directsend_history_seller")."<span class=\"badge\">$directsendhistCount1</span></a></li>";
//           		 	else
//           		 		echo "<li><a href=$directsentHistory2><i class=\"icon-users-1\"></i>".$this->lang->line("directsend_history_seller")."<span class=\"badge\">$directsendhistCount1</span></a></li>";
          		 	 
          		 	
          		 	
          		 	?>
                      </ul>
                  </div>
                </div>
                
                
              </div>
            </div>
            
          </aside>
        </div>
