<div class="header">
    <nav class="navbar   navbar-site navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span>Jhon Doe</span> <i class="icon-user fa"></i> <i class=" icon-down-open-big fa"></i></a>
              <ul class="dropdown-menu user-menu">
                <?php 
                $accounthome=base_url()."home\getAccountPage\1";
              	
                if($activeNav==1)
              		echo "<li class=\"active\"><a href=$accounthome><i class=\"icon-home\"></i> $MyAds </a></li>";
              	else 
              		echo "<li><a href=$accounthome><i class=\"icon-home\"></i> $MyAds </a></li>";

              	$accountmyads=base_url()."home\getAccountPage\2";
              	if($activeNav==2)
              		echo "<li class=\"active\"><a href=$accountmyads><i class=\"icon-th-thumb\"></i> $PersonalHome </a></li>";
              	else 
              		echo "<li><a href=$accountmyads><i class=\"icon-th-thumb\"></i> $PersonalHome </a></li>";
              
              	$accountfavouriteads=base_url()."home\getAccountPage\3";
              	if($activeNav==3)
              		echo "<li class=\"active\"><a href=$accountfavouriteads><i class=\"icon-heart\"></i> $FavoriteAds </a></li>";
              	else 
              		echo "<li><a href=$accountfavouriteads><i class=\"icon-heart\"></i> $FavoriteAds </a></li>";
              
              	$accountsavedsearch=base_url()."home\getAccountPage\4";
              	if($activeNav==4)
              		echo "<li class=\"active\"><a href=$accountsavedsearch><i class=\"icon-star-circled\"></i> $SavedSearch </a></li>";
              	else 
              		echo "<li><a href=$accountsavedsearch><i class=\"icon-star-circled\"></i> $SavedSearch </a></li>";
              
              	$accountarchivedads=base_url()."home\getAccountPage\5";
              	if($activeNav==5)
              		echo "<li class=\"active\"><a href=$accountarchivedads><i class=\"icon-folder-close\"></i> $ArchivedAds </a></li>";
              	else 
              		echo "<li><a href=$accountarchivedads><i class=\"icon-folder-close\"></i> $ArchivedAds </a></li>";
              
              	$accountpendingapprovalads=base_url()."home\getAccountPage\6";
              	if($activeNav==6)
              		echo "<li class=\"active\"><a href=$accountpendingapprovalads><i class=\"icon-hourglass\"></i> $PendingApproval </a></li>";
              	else 
              		echo "<li><a href=$accountpendingapprovalads><i class=\"icon-hourglass\"></i> $PendingApproval </a></li>";
              	$statements=base_url()."home\getAccountPage\7";
              	if($activeNav==7)
              		echo "<li class=\"active\"><a href=$statements><i class=\"icon-money\"></i> $PaymentHistory </a></li>";
              	else 
              		echo "<li><a href=$statements><i class=\"icon-money\"></i> $PaymentHistory </a></li>";
              
                
             echo "</ul>";
             ?>
            </li>
            <li class="postadd"><a class="btn btn-block   btn-border btn-post btn-danger" href="<?php echo base_url().'newPost/';?>">$PostFreeAds</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  
 