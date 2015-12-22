<div class="col-sm-3 page-sidebar">
         <aside>
            <div class="inner-box">
              <div class="user-panel-sidebar">
                <div class="collapse-box">
                  <h5 class="collapse-title no-border"> My Classified <a class="pull-right" data-toggle="collapse"  href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
                  <div id="MyClassified" class="panel-collapse collapse in">
                    <ul class="acc-list">
                      <?php 
                      
                      	 $accountpage=base_url().MY_PATH."home/getAccountPage/".$activeNav;              	      	 
                      	 if($activeNav==1)
                      	 	echo "<li><a class=\"active\" href=$accountpage> $Inbox </a></li>";
                      	 else if($activeNav==2)
                      	 	echo "<li><a class=\"active\" href=$accountpage> $ApprovedRequest </a></li>";
                      	 else if($activeNav==3)
                      	 	echo "<li><a  class=\"active\" href=$accountpage> $MyAds </a></li>";
                      	 else if($activeNav==4)
                      	 	echo "<li><a class=\"active\" href=$accountpage> $EditProfile </a></li>";
                      	 else if($activeNav==5)
                      	 	echo "<li><a class=\"active\" href=$accountpage> $SavedItems </a></li>";
                      	 else if($activeNav==6)
                      	 	echo "<li><a class=\"active\" href=$accountpage> $PendingRequest </a></li>";
                      	 else if($activeNav==7)
                      	 	echo "<li><a class=\"active\" href=$accountpage> $ApprovedRequest </a></li>";
                      	  
                      ?>
                
                    </ul>
                  </div>
                </div>

                                
                <?php
                
                echo "<div class=\"collapse-box\">";
                $accountinbox=base_url().MY_PATH."home/getAccountPage/1";
              	$approverequest1=base_url().MY_PATH."home/getAccountPage/2";
              	$myads1=base_url().MY_PATH."home/getAccountPage/3";
              	$editprofile1=base_url().MY_PATH."home/getAccountPage/4";
                $saveditems1=base_url().MY_PATH."home/getAccountPage/5";
              	$pendingrequest1=base_url().MY_PATH."home/getAccountPage/6";
              	$approvedrequest1=base_url().MY_PATH."home/getAccountPage/7";
              	
              	if($activeNav==1)
                {
              		echo "<h5 class=\"collapse-title\">$Inbox <a class=\"pull-right\" data-toggle=\"collapse\"  href=\"#Home\"><i class=\"fa fa-angle-down\"></i></a></h5>";
                 	 echo "<div id=\"Home\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                   echo "<li><a href=$approverequest1> $ApproveRequest <span class=\"badge\">$approveMsgCount</span></a></li>";
              		echo "<li><a href=$myads1> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     	echo "<li><a href=$editprofile1> $EditProfile <span class=\"badge\"></span></a></li>";
         	     	echo "<li><a href=$saveditems1> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
         	     	echo "<li><a href=$pendingrequest1> $PendingRequest <span class=\"badge\">$pendingMsgCount</span></a></li>";
          		 	echo "<li><a href=$approvedrequest1> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          			echo "</ul>";
                  	echo "</div>";
              	}
                else if($activeNav==2)
              		{
              		echo "<h5 class=\"collapse-title\"> $ApproveRequest <a class=\"pull-right\" data-toggle=\"collapse\"  href=\"#Home\"><i class=\"fa fa-angle-down\"></i></a></h5>";
                 	 echo "<div id=\"Home\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                    echo "<li><a href=$accountinbox> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
               		echo "<li><a href=$myads1> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     	echo "<li><a href=$editprofile1> $EditProfile <span class=\"badge\"></span></a></li>";
         	     	echo "<li><a href=$saveditems1> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
         	     	echo "<li><a href=$pendingrequest1> $PendingRequest <span class=\"badge\">$pendingMsgCount</span></a></li>";
          		 	echo "<li><a href=$approvedrequest1> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          			echo "</ul>";
                  	echo "</div>";
              	  }
              	else if($activeNav==3)
              		{
              		echo "<h5 class=\"collapse-title\"> $MyAds <a class=\"pull-right\" data-toggle=\"collapse\"  href=\"#Home\"><i class=\"fa fa-angle-down\"></i></a></h5>";
                 	 echo "<div id=\"Home\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                    echo "<li><a href=$accountinbox> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
               		echo "<li><a href=$approverequest1> $ApproveRequest <span class=\"badge\">$approveMsgCount</span></a></li>";
              		echo "<li><a href=$editprofile1> $EditProfile <span class=\"badge\"></span></a></li>";
         	     	echo "<li><a href=$saveditems1> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
         	     	echo "<li><a href=$pendingrequest1> $PendingRequest <span class=\"badge\">$pendingMsgCount</span></a></li>";
          		 	echo "<li><a href=$approvedrequest1> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          			echo "</ul>";
                  	echo "</div>";
              	} 
              	else if($activeNav==4)
              		{
              		echo "<h5 class=\"collapse-title\"> $EditProfile <a class=\"pull-right\" data-toggle=\"collapse\"  href=\"#Home\"><i class=\"fa fa-angle-down\"></i></a></h5>";
                 	 echo "<div id=\"Home\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                    echo "<li><a href=$accountinbox> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
               		echo "<li><a href=$approverequest1> $ApproveRequest <span class=\"badge\">$approveMsgCount</span></a></li>";
              		echo "<li><a href=$myads1> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     	echo "<li><a href=$saveditems1> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
         	     	echo "<li><a href=$pendingrequest1> $PendingRequest <span class=\"badge\">$pendingMsgCount</span></a></li>";
          		 	echo "<li><a href=$approvedrequest1> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          			echo "</ul>";
                  	echo "</div>";
              	}else if($activeNav==5)
              		{
              	  echo "<h5 class=\"collapse-title\"> $SavedItems <a class=\"pull-right\" data-toggle=\"collapse\"  href=\"#Home\"><i class=\"fa fa-angle-down\"></i></a></h5>";
                 	 echo "<div id=\"Home\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                    echo "<li><a href=$accountinbox> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
               		echo "<li><a href=$approverequest1> $ApproveRequest <span class=\"badge\">$approveMsgCount</span></a></li>";
              		echo "<li><a href=$myads1> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     	echo "<li><a href=$editprofile1> $EditProfile <span class=\"badge\"></span></a></li>";
         	     	echo "<li><a href=$pendingrequest1> $PendingRequest <span class=\"badge\">$pendingMsgCount</span></a></li>";
          		 	echo "<li><a href=$approvedrequest1> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          			echo "</ul>";
                  	echo "</div>";
              	} 
              	else if($activeNav==6)
              		{
              		echo "<h5 class=\"collapse-title\"> $PendingRequest <a class=\"pull-right\" data-toggle=\"collapse\"  href=\"#Home\"><i class=\"fa fa-angle-down\"></i></a></h5>";
                 	 echo "<div id=\"Home\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                   echo "<li><a href=$accountinbox> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
               		echo "<li><a href=$approverequest1> $ApproveRequest <span class=\"badge\">$approveMsgCount</span></a></li>";
              		echo "<li><a href=$myads1> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     	echo "<li><a href=$editprofile1> $EditProfile <span class=\"badge\"></span></a></li>";
         	     	echo "<li><a href=$saveditems1> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
         	     	echo "<li><a href=$approvedrequest1> $ApprovedRequest <span class=\"badge\">$archivedAdsCount</span></a></li>";
          			echo "</ul>";
                  	echo "</div>";
              	}
                 else if($activeNav==7)
              		{
              		echo "<h5 class=\"collapse-title\"> $ApprovedRequest <a class=\"pull-right\" data-toggle=\"collapse\"  href=\"#Home\"><i class=\"fa fa-angle-down\"></i></a></h5>";
                 	 echo "<div id=\"Home\" class=\"panel-collapse collapse in\">";
                 	 echo  "<ul class=\"acc-list\">";
                   echo "<li><a href=$accountinbox> $Inbox <span class=\"badge\">$inboxMsgCount</span> </a></li>";
               		echo "<li><a href=$approverequest1> $ApproveRequest <span class=\"badge\">$approveMsgCount</span></a></li>";
              		echo "<li><a href=$myads1> $MyAds <span class=\"badge\">$myAdsCount</span></a></li>";
         	     	echo "<li><a href=$editprofile1> $EditProfile <span class=\"badge\"></span></a></li>";
         	     	echo "<li><a href=$saveditems1> $SavedItems <span class=\"badge\">$savedAdsCount</span></a></li>";
         	     	echo "<li><a href=$pendingrequest1> $PendingRequest <span class=\"badge\">$pendingMsgCount</span></a></li>";
          		 	echo "</ul>";
                  	echo "</div>";
              		}
              	
                     
                   
                echo "</div>";
                ?>
                <div class="collapse-box">
                  <h5 class="collapse-title"> <?php echo $TerminateAccount;?> <a class="pull-right" data-toggle="collapse"  href="#TerminateAccount"><i class="fa fa-angle-down"></i></a></h5>
                  <div id="TerminateAccount" class="panel-collapse collapse in">
                    <ul class="acc-list">
                    	<?php
                    	$closePath=base_url().MY_PATH."home/getAccountPage/9"; 
                      echo "<li><a href=$closePath><i class=\"icon-cancel-circled \"></i> $CloseAccount </a></li>";
                    	?>
                      </ul>
                  </div>
                </div>
              </div>
            </div>
            
          </aside>
        </div>
