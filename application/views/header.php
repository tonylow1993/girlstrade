<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<!--   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
  <style>

   .carousel-inner > .item > img, 
   .carousel-inner > .item > a > img { 
   display: block;  
      max-height: 200px;  
      line-height: 1;  
      margin: 0 auto;  
      max-width: 100%; 
/*        width:auto;  */
/*        height:250px;  */
/*        max-height:250px;  */
/*        margin: auto;  */
  } 
/* .carousel-inner .active.left  { left: -33%;             } */
/* .carousel-inner .active.right { left: 33%;              } */
/* .carousel-inner .next         { left: 33%               } */
/* .carousel-inner .prev         { left: -33%              } */
/* .carousel-control.left        { background-image: none; } */
/* .carousel-control.right       { background-image: none; } */
/* .carousel-inner .item         { background: white;      } */
  </style>


<meta name="Description" content="一個為香港女士而設的交易平台,一起團結創造一個GirlsTrade社區!" />
<meta name="Keywords" content="GirlsTrade、HK Trades、Girls Trade、Images、Pictures,Free,Hong Kong,trade,港女,二手交易,交易平台,免費,二手袋,Hong Kong,trade,女士交易集中地" />








<!-- Fav and touch icons -->
<link rel="shortcut icon" href="<?php echo base_url();?>images/site/girlstrade_logo_small.png">
<title><?php echo $title; ?></title>
<!-- Bootstrap core CSS -->
 <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
<!-- Custom styles for this template -->
 <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet"> 
 
<!-- styles needed for carousel slider -->
<link href="<?php echo base_url();?>assets/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/owl.theme.css" rel="stylesheet">

<!-- Just for debugging purposes. -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!-- include pace script for automatic web page progress bar  -->
<!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
<!--     <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/shop.style.css">

    <!-- CSS Header and Footer -->
<!--     <link rel="stylesheet" href="assets/css/headers/header-v5.css"> -->
<!--     <link rel="stylesheet" href="assets/css/footers/footer-v4.css"> -->

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/animate.css">    
<!--     <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css"> -->
<!--     <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/revolution-slider/rs-plugin/css/settings.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme-colors/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
    
    <!-- CSS RATY -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/js/plugins/raty/jquery.raty.css">
    
<script>
    paceOptions = {
      elements: true
    };
    //setInterval(function() {
  	  // Do something every 1 minute 
//   	function checksession(){
//   	$.ajax({
//   	type : 'POST',
//  	url  : '<?php echo site_url("home/check_session")?>',
//   	success : function(data){
//   	if(data){
//   	   //your session is not expired
//   	}else{
//   	   //your session is already expired
//   	 //window.location.href="your url"; // or you can redirect from here also
//   	} 
//   	}});}
//   	window.onload = checksession;
  	//}, 500);
  	//jQuery(document).ready(checksession()); 
    
</script>
<script src="<?php echo base_url();?>assets/js/pace.min.js"></script>
<script src="<?php echo base_url();?>assets/js/gen_validatorv4.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-carousel-page-merger.js"></script>
<script src="<?php echo base_url();?>assets/js/custom.js"></script>

</head>
<body>
<div id="wrapper">
<script type="text/javascript"> 
// 	$("#error").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: '.$errorMsg.'</span></em>');
</script> 
<?php
//Check if we should check for js
// echo '<script  type="text/javascript">alert(\''.urldecode($errorMsg).'\');</script>';

$bob = session_id();

//echo "Session ID on load is ".$bob;
//echo "<br>";

if($bob==""){
	session_start();
	$bob = session_id();
	//echo ' session ID currently is '.$bob;
}
	
	if ( !is_writable(session_save_path()) ) {
		//echo 'Session save path "'.session_save_path().'" is not writable!';
	}


if ((!isset($_GET['jsEnabled']) || $_GET['jsEnabled'] == 'true') && !isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

   //Check to see if we already found js enabled
   if (!isset($_SESSION['javaEnabled'])){
      //Check if we were redirected by javascript
      if (isset($_GET['jsEnabled'])){
         //Check if we have started a session
         if(session_id() == '') {
            session_start();
         }

         //Set session variable that we have js enabled
         $_SESSION['javaEnabled'] = true;
      }
      else{
         $reqUrl = $_SERVER['REQUEST_URI'];
         $paramConnector = (strpos($reqUrl, "?"))? "&" : "?";

         echo "
            <script type='text/javascript'>
               window.location = '" . $reqUrl . $paramConnector . "jsEnabled=true'
            </script>
            <noscript>
               <!-- Redirect to page and tell us that JS is not enabled -->
               <meta HTTP-EQUIV='REFRESH' content='0; " . $reqUrl . $paramConnector . "jsEnabled=false'>
            </noscript>
         ";

         //Break out and try again to check js
         exit;
      }
   }
}

$usr = $this->nativesession->get('user');
if(empty($usr)){$usr='Not Yet Login';}
//echo json_encode($usr);;

?>
  <div class="header">
    <nav class="navbar   navbar-site navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!--<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>-->
          
          <a href="<?php echo base_url();?>"  class="navbar-brand logo logo-title"> 
          <!-- Original Logo will be placed here  class="navbar-brand logo logo-title"--> 
    <!--          <span class="logo-icon"><i class="icon icon-harbor ln-shadow-logo shape-6"></i> </span> Girls<span>trade </span> </a> </div>-->
<!--           <span class="logo-icon"><i class="icon icon-hammer ln-shadow-logo shape-6"></i> </span>  -->
            <span class="logo-icon"><img  width="50px" height="50px"  src="<?php echo base_url();?>images/site/girlstrade_logo.png">  
         </span>
          <span style="color: #E2348C"><b>
          Girls<span style="color: #5e5e5e">trade </span> 
          </b></span></a> </div>
          
        <div class="">
          
          <?php $usr = $this->nativesession->get('user');
				//or !isset($this->session->userdata["userID"])
          if(!isset($usr) || empty($usr) || $usr["username"]==null ||
          		($usr["blockDate"]!=null && $usr["blockDate"]> date('Y-m-d'))){ 
            ?>  
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url().MY_PATH; ?>home/loginPage?prevURL=<?php echo urlencode(current_url());?>">
            <i  id="menubarTitle" class="icon-login"></i>
            <span id="menubarTitle" >
            <?php if (!isset($Login)) $Login = 'Login'; echo $Login;?>
            </span>
            </a></li>
            <li class="smborder-left"><a href="<?php echo base_url(); echo MY_PATH;?>home/signupPage">
            <i  id="menubarTitle" class="icon-doc-text-1"></i>
            <span id="menubarTitle" >
            <?php if (!isset($Signup)) $Signup = 'Signup'; echo $Signup;?>
            </span>
            </a></li>  
            <li class="smborder-left"><a href="<?php echo base_url(); echo MY_PATH;?>getCategory/getAll/1">
            <i  id="menubarTitle" class="icon-search-2"></i>
            <span id="menubarTitle" >
            <?php if (!isset($HeaderSearch)) $HeaderSearch = 'Search'; echo $HeaderSearch;?>
            </span>
            </a></li> 
            
            <!--<li>
            <a id="lang" href=<?php $pageURL = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            echo base_url().MY_PATH."switchLang/changeLang_R1?prevURL=".urlencode(current_url());    
            	?>>
            <i  id="menubarTitle" class="icon-cog"></i>
            <span id="menubarTitle" >
            	<?php 
                	//$lang_label=$this->session->userdata("language");
                	//if (!isset($lang_label)) 
                	//{
                	//	$lang_label = 'chinese';
                	//	$this->session->set_userdata("language", $lang_label);
                	//}	
                	echo $this->lang->line("lang_label_text");
                	?>
            </span>
            </a>    	
            </li>-->
			<li id="smpostaddnav" class="smborder-left"><a href="<?php echo base_url(); echo MY_PATH;?>newPost/selectCategory?prevURL=<?php echo urlencode((current_url()));?>">
            <i  id="menubarTitle" class="icon-picture"></i>
            <span id="menubarTitle" >
            <?php if (!isset($Post_New_Ads)) $Post_New_Ads = 'Post'; echo $Post_New_Ads;?>
            </span>
            </a></li> 
			
			<li id="postaddbtn" class="postadd"><a class="btn btn-block   btn-border btn-post btn-tw" href="<?php echo base_url(); echo MY_PATH;?>newPost/selectCategory?prevURL=<?php echo urlencode((current_url()));?>">
            <i class="icon-picture"></i>
            <?php if (!isset($Post_New_Ads)) $Post_New_Ads = 'Post'; echo $Post_New_Ads;?>
            </a>
            
            </li>
          </ul>
         <?php }else{?>
          <ul class="nav navbar-nav navbar-right">
            <!--<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" type="button" href="#">
					<i id="menubarTitle" class="icon-user-woman"></i>
					<span id="menubarTitle" >
						<?php if (!isset($Profile)) $Profile = 'Profile'; echo $usr["username"]; //echo $Profile; ?>
					</span>
					<i id="angleDown" class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu user-menu">
					<li <?php echo $menuMyAds?>><a id="menuDropDownItem" href="<?php echo base_url(); echo MY_PATH; echo "home/getAccountPage/3";?>">
					
						<i id="menuDropDownItem" class="icon-th-thumb"></i> My Ads </a>
					
					</li>
					<li <?php echo $menuInbox?>><a id="menuDropDownItem" href="<?php echo base_url(); echo MY_PATH; echo "home/getAccountPage/1";?>">
					
						<i id="menuDropDownItem" class="icon-pencil-2"></i> Inbox&nbsp;<span id="badgeMenu" class="badge"><?php echo $menuInboxNum;?></span> </a>
					
					</li>
					<li <?php echo $menuPendingRequest?>><a id="menuDropDownItem" href="<?php echo base_url(); echo MY_PATH; echo "home/getAccountPage/6";?>">
					
						<i id="menuDropDownItem" class="icon-clock-2"></i> Pending Request(s)&nbsp;<span id="badgeMenu" class="badge"><?php echo $menuPendingRequestNumber;?></span> </a>
					
					</li>
				</ul>     
            </li>-->
			
			<li <?php echo $menuMyAds?>><a href="<?php echo base_url(); echo MY_PATH; echo "home/getAccountPage/15";?>">
			<span id="menubarTitle">
				<i id="menubarTitle" class="icon-user-woman"></i>
				<?php if (!isset($Profile)) $Profile = 'Profile'; echo $Profile;?>
			</span></a></li>
			
            <li class="smborder-left"><a href="<?php echo base_url(); echo MY_PATH;?>home/logout">
            <span id="menubarTitle">
            <i id="menubarTitle" class="icon-logout"></i>
         	<?php if (!isset($Logout)) $Logout = 'Logout'; echo $Logout;?></span></a></li>
            
            <li class="smborder-left"><a href="<?php echo base_url(); echo MY_PATH;?>getCategory/getAll/1">
            <span id="menubarTitle" >
            <i  id="menubarTitle" class="icon-search-2"></i>
            <?php if (!isset($HeaderSearch)) $HeaderSearch = 'Search'; echo $HeaderSearch;?>
            </span></a></li> 
            <!--<li>
            <a id="lang" href=<?php $pageURL = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            echo base_url().MY_PATH."switchLang/changeLang_R1?prevURL=".urlencode(current_url());    
            	?>>
            <i  id="menubarTitle" class="icon-cog"></i>
            <span id="menubarTitle" >
            	<?php 
                	//$lang_label=$this->session->userdata("language");
                	//if (!isset($lang_label)) 
                	//{
                	//	$lang_label = 'chinese';
                	//	$this->session->set_userdata("language", $lang_label);
                	//}	
                	echo $this->lang->line("lang_label_text");
                	?>
            </span>
            </a>    	
            </li>-->
            
			<li id="smpostaddnav" class="smborder-left"><a href="<?php echo base_url(); echo MY_PATH;?>newPost/selectCategory?prevURL=<?php echo urlencode((current_url()));?>">
            
            <span id="menubarTitle" >
            <i  id="menubarTitle" class="icon-picture"></i>
            <?php if (!isset($Post_New_Ads)) $Post_New_Ads = 'Post'; echo $Post_New_Ads;?>
            </span>
            </a></li> 
			
            <li id="postaddbtn" class="postadd">
            <a class="btn btn-border" href="<?php echo base_url(); echo MY_PATH;?>newPost/selectCategory?prevURL=<?php echo urlencode((current_url()));?>">
            <i class="icon-picture"></i>
            <?php if (!isset($Post_New_Ads)) $Post_New_Ads = 'Post'; echo $Post_New_Ads;?>
            </a></li>
          </ul>
          <?php }?>       
        </div>
        <!--/.nav-collapse --> 
      </div>
      <?php 
      if(isset($errorMsg) and !empty($errorMsg) and count($errorMsg)>0) {
      		foreach($errorMsg as $id=>$value){
      			if(isset($value) and !empty($value) and $id=="error" and $value<>'' and $value<>"EMPTY"){?>
      <div class="alert alert-danger"><strong>Warning!</strong> <?php echo urldecode($value); ?></div>
      <!-- <em><span style="color:red"> <i class="icon-cancel-1 fa"></i><?php echo urldecode($value); ?></span></em>-->
      <?php }else if(isset($value) and !empty($value) and $id=="success1"  and $value<>''){?>
       <em><span style="color:green"> <i class="icon-cancel-1 fa"></i><?php echo urldecode($value); ?></span></em>
     	
      <?php } }}?>
      <?php if(isset($_GET['jsEnabled']) and $_GET['jsEnabled']=="false"){?>
      <em><span style="color:red"> <i class="icon-cancel-1 fa"></i><?php echo "Javascript is disabled. Please enable it to view this website!"; ?></span></em>
      <?php }?>
      
      <!-- /.container-fluid --> 
    </nav>
  </div>
  <!-- /.header -->


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82450043-1', 'auto');
  ga('send', 'pageview');

</script>
  