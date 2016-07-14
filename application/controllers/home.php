<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'ChromePhp.php';


class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->output->enable_profiler(TRUE);
		
		//$this->load->library('form_validation');
		//$this->load->library('session');
// 		ini_set('post_max_size',52428800); // 50 MB
// 		ini_set('upload_max_filesize',52428800); // 50 MB
		$this->load->library("nativesession");
		$this->load->helper('url');
		$this->load->library('form_validation');
		
		$this->load->helpers('site');
		$this->load->helper('language');
		$this->load->database();
		$this->load->library('upload');
		$this->load->library('image_lib');
		        date_default_timezone_set("Asia/Hong_Kong");
              
               	if($this->nativesession->get("language")!=null)
               	{
               		$data["lang_label"] = $this->nativesession->get("language");
               		$this->lang->load("message", $data["lang_label"]);
               	}
              	else 
              	{
              		$data["lang_label"]="chinese";
              		$this->lang->load("message", $data["lang_label"]);
              	   	$this->nativesession->set("language",$data["lang_label"]);
              	}
              	
              	if(isset($_GET["session_id"]))
              	{              	
              	if($this->nativesession->userdata("session_id")==null)
              	{
              		$this->nativesession->set_userdata("session_id", $_GET["session_id"]);
              	}
              	}else {
              		$this->nativesession->_sess_run();
              	}
              		
                $this->load->model('users_model');
        $this->load->model('user_model', 'user');
		$this->load->model('userinfo_model', 'userInfo');
		$this->load->model('useremail_model', 'userEmail');
		$this->load->model('userpassword_model', 'userPassword');
		$this->load->model('address_model', 'address');
     	$this->load->model('category_model');
              $this->load->model('location_model');
              $this->load->model('post_model');
              $this->load->model('picture_model');
        	$this->load->model('messages_model');
        	$this->load->model('requestpost_model');
        	$this->load->model('savedAds_model');
        	$this->load->model('userstat_model');
        	$this->load->model('postviewhistory_model');
        	$this->load->model('indexstat_model');
        	    $this->load->model("userloginhistory_model"); 
        	    $this->load->model('tradecomments_model');
        	    $this->load->model('itemcomments_model');
        	    $this->load->model('mailtemplate_model');
        	    $this->load->model('pagevisited_model');
        	    $this->load->model('buyermessage_model');
        	    $this->load->model('userInfoSendEmail_model');
				$this->load->model('blog_model');
				$this->load->model('admin_model');
				$this->load->model('userinfosendemail_model');
				$this->load->model('sendEmailLog_model');
	}
	public function index($errorMsg='', $successMsg='')
	{
		try{
		
		$viewItemInfo=$this->post_model->getPostByID($errorMsg);
		if($viewItemInfo!=null && isset($viewItemInfo) && !empty($viewItemInfo))
		{
			$this->viewItem($errorMsg);
			return;
		}
		
			
		$this->load->library("nativesession");
		
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
		$data["About_us"] = $this->lang->line("About_us");
		$data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
		$data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
		$data["Contact_us"] = $this->lang->line("Contact_us");
		//log_message('debug', 'Contact Us words is: '.$data["Contact_us"]);
		$data["FAQ"] = $this->lang->line("FAQ");
		$data["Index_Footer1"] = $this->lang->line("Index_Footer1");
		$data["Call_Now"] = $this->lang->line("Call_Now");
		$data["Tel"] = $this->lang->line("Tel");
		
		$data["Login"]=$this->lang->line("Login");;
		$data["Signup"]=$this->lang->line("Signup");
		$data["Profile"]=$this->lang->line("Profile");
		$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
		$data["Logout"]=$this->lang->line("Logout");
		$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		
		
		$data["errorMsg"]=array("success1"=> ($successMsg), "error"=> ($errorMsg));
			
        $keywords="";
        $catID="";
        $locID="";    
		try{
		$keywords=base64_encode($this->input->post("ads"));
		$catID=$this->input->post('search-category');
		$locID=$this->input->post('id-location');
		} catch(Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		$data['catID']=$catID;
		$data['locID']=$locID;
		$data['keywords']=$keywords;
		$data["lang_label"]=$this->nativesession->get("language");
        $data["Find_Product"] = $this->lang->line("Find_Product");
            $data["Index_Title1"] = $this->lang->line("Index_Title1");
            $data["District"] = $this->lang->line("District");
            $data["Looking_For"] = $this->lang->line("Looking_For");
            $data["Find"] = $this->lang->line("Find");
            $data["Find_Desc"] = $this->lang->line("Find_Desc");
            $data["Featured_Listings"] = $this->lang->line("Featured_Listings");
            
            $data["AllCategory"]=$this->getAllCategory();
            $data["FeatureProduct"]=$this->getFeatureProduct();
            $data["InterestedProduct"]=$this->getInterestedProduct();
            $data["HotProduct"]=$this->getHotProduct();
			$data["result"]=$this->blog_model->getBlog();
			if($data["result"]!=null && count($data["result"])>0){
				$data["pic1"]=base_url().$data["result"][0]->picPath1.$data["result"][0]->picName1;
				$data["pic2"]=base_url().$data["result"][0]->picPath2.$data["result"][0]->picName2;
				$data["pic3"]=base_url().$data["result"][0]->picPath3.$data["result"][0]->picName3;
				$data["title"]=$data["result"][0]->title;
				$data["description"]=$data["result"][0]->description;
			}else{
				$data["pic1"]="";
				$data["pic2"]="";
				$data["pic3"]="";
				$data["title"]="";
				$data["description"]="";
			}
            $data["popularLocation1"]=$this->getPopularLocation(3, 0);
            $data["popularLocation2"]=$this->getPopularLocation(3, 3);
            $data["popularMakes1"]=$this->getPopularCategory(2, 0);
            $data["popularMakes2"]=$this->getPopularCategory(2, 2);
            $data["popularMakes3"]=$this->getPopularCategory(2, 5);
            $data["popularCategory"]=$this->getPopularParentCategory();
            $data["indexstat"]=$this->indexstat_model->getIndexStat();
            
            $data["Categories"]=$this->lang->line("Categories");
			$data["Location"]=$this->lang->line("Location");
			
            $data["Interested_Listings"]=$this->lang->line("Interested_Listings");
            $data["Hot_Listings"]=$this->lang->line("Hot_Listings");
			$data["Interested_Ads"]=$this->lang->line("Interested_Ads");
            $data["AdsProduct"]=Array(30 ,$this->post_model->get_picture_by_postID(30));
			$this->nativesession->set("lastPageVisited","index");
			$data["lblAllCategories"]=$this->lang->line("lblAllCategories");
			$data["Trusted_Seller"]=$this->lang->line("Trusted_Seller");
			$data["Categories"]=$this->lang->line("Categories");
			$data["Location"]=$this->lang->line("Location");
			$data["Facebook_Fans"]=$this->lang->line("Facebook_Fans");
			
			//---------Title and how it works heading-----
			$data["indexFirstTitle"]=$this->lang->line("indexFirstTitle");
			$data["indexSecondTitle"]=$this->lang->line("indexSecondTitle");
			$data["indexHowDoesItWorks"]=$this->lang->line("indexHowDoesItWorks");
			$data["indexWorksStepOne"]=$this->lang->line("indexWorksStepOne");
			$data["indexWorksTitleOne"]=$this->lang->line("indexWorksTitleOne");
			$data["indexWorksDescOne"]=$this->lang->line("indexWorksDescOne");
			$data["indexWorksStepSec"]=$this->lang->line("indexWorksStepSec");
			$data["indexWorksTitleSec"]=$this->lang->line("indexWorksTitleSec");
			$data["indexWorksDescSec"]=$this->lang->line("indexWorksDescSec");
			$data["indexWorksStepThird"]=$this->lang->line("indexWorksStepThird");
			$data["indexWorksTitleThird"]=$this->lang->line("indexWorksTitleThird");
			$data["indexWorksDescThird"]=$this->lang->line("indexWorksDescThird");
			$data["indexWorksStepFourth"]=$this->lang->line("indexWorksStepFourth");
			$data["indexWorksTitleFourth"]=$this->lang->line("indexWorksTitleFourth");
			$data["indexWorksDescFourth"]=$this->lang->line("indexWorksDescFourth");
			$data["indexDiscoverTitle"]=$this->lang->line("indexDiscoverTitle");
			$data["indexDiscoverTitle2"]=$this->lang->line("indexDiscoverTitle2");
			$data["indexViewMore"]=$this->lang->line("indexViewMore");
			$data["indexViewLess"]=$this->lang->line("indexViewLess");
			$data["indexHotItemTitle"]=$this->lang->line("indexHotItemTitle");
			$data["indexHotItemTitle2"]=$this->lang->line("indexHotItemTitle2");
			$data["indexHighlightTitle"]=$this->lang->line("indexHighlightTitle");
			$data["indexBlogTitle"]=$this->lang->line("indexBlogTitle");
			$data["indexSideOneTitle"]=$this->lang->line("indexSideOneTitle");
			$data["indexSideOneTitle2"]=$this->lang->line("indexSideOneTitle2");
			
			$data["indexSider1_1"]=$this->lang->line("indexSider1_1");
			$data["indexSider1_2"]=$this->lang->line("indexSider1_2");
			$data["indexSider1_3"]=$this->lang->line("indexSider1_3");
			$data["indexSider1_4"]=$this->lang->line("indexSider1_4");
			$data["indexSider1_btn"]=$this->lang->line("indexSider1_btn");
			$data["indexSider2_1"]=$this->lang->line("indexSider2_1");
			$data["indexSider2_2"]=$this->lang->line("indexSider2_2");
			$data["indexSider2_btn"]=$this->lang->line("indexSider2_btn");
			$data["indexSider3_1"]=$this->lang->line("indexSider3_1");
			$data["indexSider3_2"]=$this->lang->line("indexSider3_2");
			$data["indexSider3_3"]=$this->lang->line("indexSider3_3");
			$data["indexSider4_1"]=$this->lang->line("indexSider4_1");
			$data["indexSider4_btn"]=$this->lang->line("indexSider4_btn");
			$data["indexSider5_1"]=$this->lang->line("indexSider5_1");
			$data["indexSider5_2"]=$this->lang->line("indexSider5_2");
			$data["indexSider5_btn"]=$this->lang->line("indexSider5_btn");
			
			//--------------------------------------------------
			
			
			setcookie('gt_cookie_id', $this->nativesession->userdata('session_id') ,time() + (86400 * 7));
			//-----------------Set user information -----------------
			$user1=$this->nativesession->get("user");
			if(isset($user1)){
				$data["userName"]=$user1["username"];
			
			}
			
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($user1)){
				$menuCount=$this->getHeaderCount($user1["userID"]);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($user1["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			//----------------------------
			$this->load->view('index', $data);
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			
		}
	}
	
	public function viewItem($postId)
	{
		try {
			$data["lang_label_text"] = $this->lang->line("lang_label_text");
			$data["lang_label"] = $this->nativesession->get("language");
			$data["Home"] = $this->lang->line("Home");
			$data["About_us"] = $this->lang->line("About_us");
			$data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
			$data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
			$data["Contact_us"] = $this->lang->line("Contact_us");
			$data["FAQ"] = $this->lang->line("FAQ");
			$data["Index_Footer1"] = $this->lang->line("Index_Footer1");
			$data["Call_Now"] = $this->lang->line("Call_Now");
			$data["Tel"] = $this->lang->line("Tel");
	
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
	
			$data["lang_label"]=$this->nativesession->get("language");
			$var = $this->post_model->getPostByID($postId);
			$data["postID"]=$postId;
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			//----------------------------
			if($var == null)
			{
				$this->nativesession->set("lastPageVisited","processError");
				$this->load->view('system-error', $data);
			}else
			{
				 
				//echo $var['postID'];
				$user = $this->users_model->get_user_by_id($var[0]->userID);
				$pic = $this->post_model->get_picture_by_postID($var[0]->postID);
				$category = $this->post_model->get_category_by_categoryID($var[0]->catID);
				$parentCategory=$this->post_model->get_category_by_categoryID($category[0]->parentID);
				$location = $this->post_model->get_location_by_locationID($var[0]->locID);
	
				$this->nativesession->set("lastPageVisited","item");
	
				$data["previousCurrent_url"] = base_url();
				$data["ParentCatID"] = $parentCategory[0]->categoryID;
				$data["ParentCatName"] = $data["lang_label"]<>"english" ? $parentCategory[0]->nameCH : $parentCategory[0]->name;
				$data["ChildCatID"] = $category[0]->categoryID;
				$data["ChildCatName"] = $data["lang_label"]<>"english" ? $category[0]->nameCH : $category[0]->name;
				$data["itemName"] = $data["lang_label"]<>"english" ? $var[0]->itemNameCH : $var[0]->itemName;
				$data["createDate"] = $var[0]->createDate;
				$data["currency"] = $var[0]->currency;
				$data["price"] = $var[0]->itemPrice;
				$data["AdsProduct"] = array($var[0]->postID => $pic);
				$data["itemDesc"] = $var[0]->description;
				if ($var[0]->locID>0)
					$data["LocationName"] = $data["lang_label"]<>"english" ? $location[0]->nameCN : $location[0]->name;
				else
					$data["LocationName"]="";
				$data["userName"] = $user[0]->username;
				$data["userID"] = $user[0]->userID;
				$userCreateDate = $user[0]->createDate;
				$data["userCreateDate"]=$userCreateDate;
				//$data["errorMsg"]=array("success1"=> ($successMsg), "error"=> ($errorMsg));
				$loginUser=$this->nativesession->get("user");
				
				if(isset($loginUser["userID"])){
					$menuCount=$this->getHeaderCount($loginUser["userID"]);
					$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($loginUser["userID"]); //$menuCount["inboxMsgCount"]; //$this->messages_model->getUnReadInboxMessage($loginUser["userID"]);
					$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
				}
				
				$userInfo=$this->userInfo->getUserInfoByUserID($data["userID"] );
				$email=$this->userEmail->getUserEmailByUserID($data["userID"] );
				if(isset($userInfo))
				{
					$data["lastName"]=$userInfo["lastName"];
					$data["firstName"]=$userInfo["firstName"];
					$data["phoneNo"]=$userInfo["phoneNo"];
					$data["telNo"]=$userInfo["telNo"];
				}
				$data["email"]=$email["email"];
	
	
				$isSameUser=false;
				$isPostAlready=false;
				$isPendingRequest=true;
				if(!empty($loginUser) and isset($loginUser) and $loginUser<>null and $loginUser["userID"]<>0)
				{
					if($loginUser["userID"]==$user[0]->userID)
						$isSameUser=true;
					$isPostAlready=$this->requestpost_model->getfUserIDAndPostID($var[0]->postID, $loginUser["userID"], "U");
					$isPendingRequest=$this->requestpost_model->getfUserIDAndPostID($var[0]->postID, $loginUser["userID"], "");
				}
				$data["isSameUser"]=$isSameUser;
	
				$data["isPostAlready"]=$isPostAlready;
				$data["isPendingRequest"]=$isPendingRequest;
				$thread["postID"]=$postId;
				if(!empty($loginUser) and isset($loginUser) and $loginUser<>null and $loginUser["userID"]<>0)
				{
					$thread["userID"]=$loginUser["userID"];
				}
				$thread["ip"]=$_SERVER['REMOTE_ADDR'];
				date_default_timezone_set('Asia/Hong_Kong');
				$date = date('Y-m-d h:i:s a', time());
				$thread["viewTime"]=$date;
				$thread['session_id']=$this->nativesession->userdata('session_id');
				$ip='';
				if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
					$ip = $_SERVER['HTTP_CLIENT_IP'];
				} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
					$ip = $_SERVER['REMOTE_ADDR'];
				}
				
				$thread['ip']=$ip;
				$thread['cookies_id']=isset($_COOKIE['gt_cookie_id']) && $_COOKIE['gt_cookie_id']!='' ? $_COOKIE['gt_cookie_id'] : 'Guest';
				
				$this->postviewhistory_model->insert($thread);
	
			}
		}catch(Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			 
		}
		//var_dump($data);
		$data["profileBackToResult"]=$this->lang->line("profileBackToResult");
		$this->load->view('item', $data);
	}
	
	
	public function loginPage( $errorMsg='', $activeNav=0){
		$prevURL="";
		if($activeNav!=0){
			$prevURL=base_url().MY_PATH."home/getAccountPage/".$activeNav;
			$_SESSION["previousUrl"]=$prevURL;
		} else if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
		}else if(isset($_SESSION["previousUrl"])){
			$prevURL=$_SESSION["previousUrl"];
		}
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
            $data["About_us"] = $this->lang->line("About_us");
            $data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
            $data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
            $data["Contact_us"] = $this->lang->line("Contact_us");
            $data["FAQ"] = $this->lang->line("FAQ");
            $data["Index_Footer1"] = $this->lang->line("Index_Footer1");
            $data["Call_Now"] = $this->lang->line("Call_Now");
            $data["Tel"] = $this->lang->line("Tel");
          
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
          $data["lang_label"]=$this->nativesession->get("language");
          $data["PrevURL"]=$prevURL;
          $_SESSION["prevURL"]=$prevURL;
          //$temp=$this->session->flashdata("errorMessage");
          //print_r($temp);
          //$data["temp"]=$temp;
          //$errorMsg_=$temp["msg1"];
          //$data["errorMsg_"]=$errorMsg_;
          $data["errorMsg"]=array("error"=> ($errorMsg));
          $this->nativesession->set("lastPageVisited","login");
          // redirect(base_url().MY_PATH."/home/login/".$prevURL."/".$errorMsg)
           
          $data["Username"]=$this->lang->line("Username");
          $data["Password"]=$this->lang->line("Password");
          $data["lblLogin"]=$this->lang->line("lblLogin");
          $data["lblWithoutAccount"]=$this->lang->line("lblWithoutAccount");
          $data["lblSubmit"]=$this->lang->line("lblSubmit");
          $data["SignUp"]=$this->lang->line("SignUp");
          $data["LostYourPassword"]=$this->lang->line("LostYourPassword");
          //----------setup the header menu----------
          $data["menuMyAds"]="";
          $data["menuInbox"]="";
          $data["menuInboxNum"]="0";
          $data["menuPendingRequest"]="";
          $data["menuPendingRequestNumber"]="0";
          //----------------------------
          
          $this->load->view('login', $data);
	}
	
	
	public function signupPage(){
        $data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
            $data["About_us"] = $this->lang->line("About_us");
            $data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
            $data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
            $data["Contact_us"] = $this->lang->line("Contact_us");
            //log_message('debug', 'Contact Us words is: '.$data["Contact_us"]);
            $data["FAQ"] = $this->lang->line("FAQ");
            $data["Index_Footer1"] = $this->lang->line("Index_Footer1");
            $data["Call_Now"] = $this->lang->line("Call_Now");
            $data["Tel"] = $this->lang->line("Tel");
          
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");  
		 $data["lang_label"]=$this->nativesession->get("language");
		 
		 	$data["lblRegistration"]=$this->lang->line("lblRegistration");
            $data["lblAtLeastFiveChar"]=$this->lang->line("lblAtLeastFiveChar");
            $data["lblAtLeastEightChar"]=$this->lang->line("lblAtLeastEightChar");
            $data["lblPhoneNumberRestriction"]=$this->lang->line("lblPhoneNumberRestriction");
            $data["lblAgreeTerms"]=$this->lang->line("lblAgreeTerms");
            $data["lblCondition"]=$this->lang->line("lblCondition");
            $data["lblSignupSubmit"]=$this->lang->line("lblSignupSubmit");
            $data["lblSignupEmail"]=$this->lang->line("lblSignupEmail");
            
            $data["lblSignupDesc1"]=$this->lang->line("lblSignupDesc1");
            $data["lblSignupDesc1T"]=$this->lang->line("lblSignupDesc1T");
            $data["lblSignupDesc2"]=$this->lang->line("lblSignupDesc2");
            $data["lblSignupDesc2T"]=$this->lang->line("lblSignupDesc2T");
          if($this->nativesession->get('language') && $this->nativesession->get('language') == "chinese")
            {
                $data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW'></script>";
            }else
            {
                $data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>";
            }
            $this->nativesession->set("lastPageVisited","signupPage");
            
            $data["SignUpWelcomeMessage"]=$this->lang->line("SignUpWelcomeMessage");
            $data["ReTypePassword"]=$this->lang->line("ReTypePassword");
            $data["PhoneNumber"]=$this->lang->line("PhoneNumber");
            $data["HidePhoneNumber"]=$this->lang->line("HidePhoneNumber");
            $data["Email"]=$this->lang->line("Email");
            $data["VerifyCaptcha"]=$this->lang->line("VerifyCaptcha");
            $data["Username"]=$this->lang->line("Username");
            $data["Password"]=$this->lang->line("Password");
            
            //----------setup the header menu----------
            $user1=$this->nativesession->get("user");
			$data["menuMyAds"]="";
            $data["menuInbox"]="class=\"active\"";
            $data["menuInboxNum"]="0";
            $data["menuPendingRequest"]="";
            $data["menuPendingRequestNumber"]="0";
            if(isset($user1) && !empty($user1)){
            	$menuCount=$this->getHeaderCount($user1["userID"]);
            	$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($user1["userID"]); //$menuCount["inboxMsgCount"]; //
            	$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
            }
            //----------------------------
            $this->load->view('signup', $data);
	}
	
	public function username_check($str){
		if(filter_var($str, FILTER_VALIDATE_EMAIL)) {
			$this->form_validation->set_message('username_check', 'The %s cannot be meail.');
			return FALSE;
		}
		
		if (!preg_match("/\p{Han}+/u", $str)){ //preg_match("^[0-9A-Za-z_]+$", $str)){
			$validate = $this->user->isUserExist($str);
			if($validate){
				$this->form_validation->set_message('username_check', 'The %s is used already.');
				return FALSE;
			}else{
				if (strpos(strtolower($str), 'fuck') !== false) {
					$this->form_validation->set_message('username_check', 'The %s contains invalid words.');
					return FALSE;
				}else
					return TRUE;
			}
		}else{
			$this->form_validation->set_message('username_check', 'The %s is invalid. Only digits or english');
			return FALSE;
		}
	}
	
	public function email_check($str)
	{
		if ($str == 'test@test.com')
		{
			$this->form_validation->set_message('email_check', 'The %s can not be the word "test@test.com"');
			return FALSE;
		}
		else
		{
			$validate = $this->userEmail->isEmailExist($str);
			if($validate){
				$this->form_validation->set_message('email_check', 'The %s is used already.');
				return FALSE;	
			}else{
				return TRUE;
			}
		}
	}
	
	public function password_check($str)
	{
		if(strlen($str)> MAXLENGTHPASSWORD){
			$this->form_validation->set_message('password_check', 'The %s is too long');
			return FALSE;
		}
		
		if (!preg_match("/\p{Han}+/u", $str)){ //preg_match("^[0-9A-Za-z_]+$", $str)){
				if (strpos(strtolower($str), ' ') !== false) {
					$this->form_validation->set_message('password_check', 'The %s contains empty space.');
					return FALSE;
				}else
					return TRUE;
		}else{
			$this->form_validation->set_message('password_check', 'The %s is invalid. Only digits or english');
			return FALSE;
		}
	}
	
	public function agree_check($str){
		if (!$this->input->post('checkboxes-1'))
		{
			$this->form_validation->set_message('agree_check', 'You need to check the agreement checkbox before create account');
			return FALSE;
		}
		else
		{
			return TRUE;
			
		}
	}
	
	public function signup(){
		
            //-------------------------------captcha------------------------------
		if ($this->form_validation->run('home/signup') == FALSE)
		{
			$this->signupPage();
		}else{       
			$captcha;
                if(isset($_POST['g-recaptcha-response'])){
                  $captcha=$_POST['g-recaptcha-response'];
                }
                if(!$captcha){
                	$errorMsg="Please check the captcha form.";
                	$data["lang_label"]=$this->nativesession->get("language");
                	$data["PrevURL"]=base_url();
            	$data["error"]=$errorMsg;
                	$this->nativesession->set("lastPageVisited","login");
                	$data['redirectToWhatPage']="SignUp Page";
                	$data['redirectToPHP']=base_url().MY_PATH."home/signupPage";
                	
                	$data["successTile"]=$this->lang->line("successTile");
                	$data["failedTitle"]=$this->lang->line("failedTitle");
                	$data["goToHomePage"]=$this->lang->line("goToHomePage");
                	 
                	$this->load->view('failedPage', $data);
                	return;
                  
                }
                $fields = array(
                    'secret'    =>  "6Lec9AYTAAAAALrIwia-e_3Lc2pb3Vj0ZTbI9gEN",
                    'response'  =>  $captcha,
                    'remoteip'  =>  $_SERVER['REMOTE_ADDR']
                );
                $postvars = '';
                foreach($fields as $key=>$value) {
                        $postvars .= $key . "=" . $value . "&";
                }
                $ch = curl_init();
                $url = "https://www.google.com/recaptcha/api/siteverify?";
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
                curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
                curl_setopt($ch,CURLOPT_TIMEOUT, 20);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close ($ch);


                $result = json_decode($response,true);
                
            if($result['success'] == false)
            {
            	$errorMsg=$this->lang->line("HomeSignUpCheckCaptchaForm");
            	
            	$data["lang_label"]=$this->nativesession->get("language");
            	$data["PrevURL"]=base_url();
            	$data["error"]=$errorMsg;
            	$this->nativesession->set("lastPageVisited","login");
            	$data['redirectToWhatPage']="SignUp Page";
            	$data['redirectToPHP']=base_url().MY_PATH."home/signupPage";
            	$data["successTile"]=$this->lang->line("successTile");
            	$data["failedTitle"]=$this->lang->line("failedTitle");
            	$data["goToHomePage"]=$this->lang->line("goToHomePage");
            	 
            	$this->load->view('failedPage', $data);
            	return;
             
            }else
            {
             
            //------------------------------------------------------------------------------
      		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		 	$data["Home"] = $this->lang->line("Home");
            $data["About_us"] = $this->lang->line("About_us");
            $data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
            $data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
            $data["Contact_us"] = $this->lang->line("Contact_us");
            //log_message('debug', 'Contact Us words is: '.$data["Contact_us"]);
            $data["FAQ"] = $this->lang->line("FAQ");
            $data["Index_Footer1"] = $this->lang->line("Index_Footer1");
            $data["Call_Now"] = $this->lang->line("Call_Now");
            $data["Tel"] = $this->lang->line("Tel");
          
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		$data['optionsRadios'] = "I"; // $this->input->post('optionsRadios');
		$data['username'] = $this->input->post('username');
		//$data['firstname'] = $this->input->post('firstname');
		//$data['lastname'] = $this->input->post('lastname');
                $data['firstname'] = "";
		$data['lastname'] = "";
		$data['telno'] = $this->input->post('telno');
		//$data['gender'] = $this->input->post('gender');
                $data['gender'] = "";
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');

		//$data['retype'] = $this->input->post('retype'); 
		//if($data['password'] != $data['retype']){
		//	return;
		//}
		// $this->form_validation->set_rules('username', 'lang:Username', 'trim|required|min_length[5]|max_length[20]|xss_clean');
		// $this->form_validation->set_rules('email', 'lang:Email', 'callback_email_check');
		
		
		
		$data['checkboxes'] = $this->input->post('checkboxes');
		
		$user['username'] = $data['username'];
		$user['ip'] = $_SERVER['REMOTE_ADDR'];
		$user['point'] = 0;
		$user['accountStatus'] = 'U';
		
		$userInfo['lastName'] = $data['lastname'];
		$userInfo['firstName'] = $data['firstname'];
		$userInfo['gender'] = $data['gender'];
		$userInfo['telNo'] = $data['telno'];
		$userInfo['introduction']="";
		if($this->input->post('hidetelno')!=null
				&& $this->input->post('hidetelno')=="Yes")
			$userInfo['hidetelno']=true;
		else 
			$userInfo['hidetelno']=false;
// 		$userInfo("checkBox1")=true;
// 		$userInfo("checkBox2")=true;
			$userInfo['showWeChatID']=false;
			$userInfo['weChatID']='';
			$userInfo['showWebSite']=false;
			$userInfo['webSiteAddr']='';
			
		
		
		$userEmail['email'] = $data['email'];
		$userEmail['priority'] = 1;
		$userEmail['status'] = 'U';
		
		$userPassword['password'] = $data['password'];
		$userPassword['status'] = 'U';
		
		
		$data['userID'] = $this->user->insert($user);
			
		$this->userinfosendemail_model->insertNewSendEmailConfig($data['userID']);
		
		$userInfo['userID'] = $data['userID'];
			
		$data['userInfo'] = $this->userInfo->insert($userInfo);
		$userEmail['userID'] = $data['userID'];
		$data['userEmail'] = $this->userEmail->insert($userEmail);
		$userPassword['userID'] = $data['userID'];
		$data['userPassword'] = $this->userPassword->insert($userPassword);
		
		
		$userAfter = $this->user->getUserByUserID($userInfo['userID']);
		
// 		$message = '<p>Dear User,</p>';
// 		$path=base_url().MY_PATH."home/activate/".$userAfter["userID"]."/".md5($userAfter["createDate"]);
// 		$message .= "<p>Please <a href=$path>click here</a> to activate your account.</p>";
// 		$message .= '<p>Thank you!</p>';
		$path=base_url().MY_PATH."home/activate/".$userAfter["userID"]."/".md5($userAfter["createDate"]);
		$title=$this->mailtemplate_model->SendEmailTitleForSignupActivate();
		$message=$this->mailtemplate_model->SendEmailMsgForSignupActivate( $data['username'],  $path, $data['email']);
		
		$this->sendAuthenticationEmail($userEmail, $message, $title, "SIGNUPSENDEMAIL");
		log_message('debug', 'retrieve userid  '.$data['userID']);
		$thread["userID"]=$data['userID'];
		$thread["visit_time"]=date("Y-m-d H:i:s");;
		$thread['session_id']=$this->nativesession->userdata('session_id');
		$ip='';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$thread['ip']=$ip;
		$thread['cookies_id']=isset($_COOKIE['gt_cookie_id']) && $_COOKIE['gt_cookie_id']!='' ? $_COOKIE['gt_cookie_id'] : 'Guest';
		$thread["page_visit"]=PageSignup;
		$this->pagevisited_model->insert($thread);
		
		
		
		$errorMsg=$this->lang->line("HomeSignUpSuccess");
                	$data["lang_label"]=$this->nativesession->get("language");
                	$data["PrevURL"]=base_url();
            		$data["error"]=$errorMsg;
                	$this->nativesession->set("lastPageVisited","login");
                	$data['redirectToWhatPage']="Home Page";
                	$data['redirectToPHP']=base_url();
                	$data["successTile"]=$this->lang->line("successTile");
                	$data["failedTitle"]=$this->lang->line("failedTitle");
                	$data["goToHomePage"]=$this->lang->line("goToHomePage");
                	 
                	$this->load->view('successPage', $data);
                	//redirect('', 'location');
                
            }
         }
	}
	
	public function loginUser(){
		$prevURL="";
		if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
		}else if(isset($_SESSION["previousUrl"])){
			$prevURL=$_SESSION["previousUrl"];
		}
		
		//----------setup the header menu----------
		$data["menuMyAds"]="";
		$data["menuInbox"]="";
		$data["menuInboxNum"]="0";
		$data["menuPendingRequest"]="";
		$data["menuPendingRequestNumber"]="0";
		//----------------------------
        
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
            $data["About_us"] = $this->lang->line("About_us");
            $data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
            $data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
            $data["Contact_us"] = $this->lang->line("Contact_us");
            //log_message('debug', 'Contact Us words is: '.$data["Contact_us"]);
            $data["FAQ"] = $this->lang->line("FAQ");
            $data["Index_Footer1"] = $this->lang->line("Index_Footer1");
            $data["Call_Now"] = $this->lang->line("Call_Now");
            $data["Tel"] = $this->lang->line("Tel");
          
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		
		$data["lang_label"]=$this->nativesession->get("language");
       $data["Find_Product"] = $this->lang->line("Find_Product");
            $data["Index_Title1"] = $this->lang->line("Index_Title1");
            $data["District"] = $this->lang->line("District");
            $data["Looking_For"] = $this->lang->line("Looking_For");
            $data["Find"] = $this->lang->line("Find");
            $data["Find_Desc"] = $this->lang->line("Find_Desc");
            $data["Featured_Listings"] = $this->lang->line("Featured_Listings");
            
            $data["AllCategory"]=$this->getAllCategory();
            $data["FeatureProduct"]=$this->getFeatureProduct();
            
            $data["Categories"]=$this->lang->line("Categories");
			$data["Location"]=$this->lang->line("Location");
		    $data["Interested_Listings"]=$this->lang->line("Interested_Listings");
			$data["Interested_Ads"]=$this->lang->line("Interested_Ads");
            $data["AdsProduct"]=Array(30 ,$this->post_model->get_picture_by_postID(30));
			
        	
		
		$username="";
		if(!($this->input->post("username"))) 
			$username = $this->input->post("username");
		else if(is_array($_POST))
		{
			if(!empty($_POST))
				$username=$_POST["username"];
		}
		$user = $this->user->getUserByUsername($username);
		
		$password="";
		if(!($this->input->post("password")))
			$password = $this->input->post("password");
		else if(is_array($_POST))
		{
			if(!empty($_POST))
				$password=$_POST["password"];
		}
		
		$loginUser=$this->nativesession->get("user");
		if(isset($loginUser))
			$thread["userID"]=$loginUser['userID'];
			
		$thread["visit_time"]=date("Y-m-d H:i:s");;
		$thread['session_id']=$this->nativesession->userdata('session_id');
		$ip='';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$thread['ip']=$ip;
		$thread['cookies_id']=isset($_COOKIE['gt_cookie_id']) && $_COOKIE['gt_cookie_id']!='' ? $_COOKIE['gt_cookie_id'] : 'Guest';
		$thread["page_visit"]=PageSignin;
		$this->pagevisited_model->insert($thread);
		
		
		
		$data["PrevURL"]=$prevURL;
		$back2LoginPage=base_url().MY_PATH."home/loginPage?prevURL=".$prevURL;
		if(!is_array($user) or !isset($user) or $username=='' or 
		empty($user) or count($user)==0
			or !$this->user->isUserExist($username))
		{
			
			if(!$this->userEmail->isEmailExist($username))
			{			
				$loginhist=array("username"=> $username, "logMsg"=>INVALIDUSERNAME,
						"status"=>"F", "loginTime"=>  date("Y-m-d H:i:s"));
				$this->userloginhistory_model->insert($loginhist);
				
				//$errorMsg=$this->lang->line("HomeLoginInvalidUsername");
				$errorMsg=$this->lang->line("HomeLoginInvalid");
				$data["lang_label"]=$this->nativesession->get("language");
				$data["PrevURL"]=$prevURL;
				$data["error"]=$errorMsg;
				$this->nativesession->set("lastPageVisited","login");
				
				$data['redirectToWhatPage']="Login Page";
				$data['redirectToPHP']=base_url().MY_PATH."home/loginPage";
				$data["successTile"]=$this->lang->line("successTile");
                	$data["failedTitle"]=$this->lang->line("failedTitle");
                	$data["goToHomePage"]=$this->lang->line("goToHomePage");
                	
                	//$this->load->view('failedPage', $data);
					echo "Invalid Username";
				return;
			}
			else 
			{
				$userID=$this->userEmail->getUserIDByEmail($username);
				$user = $this->user->getUserByUserID($userID);
				$username=$user["username"];
				//echo "Invalid Username";
				//return;
			}
		}
		else if(count($user)>0 and $user["accountStatus"] == 'U'){
			$userID=$user["userID"];
			$loginhist=array("username"=> $username, "logMsg"=>ACTIVATEUSERNAME,
					"status"=>"F", "loginTime"=>  date("Y-m-d H:i:s"), "userID"=>$userID);
			$this->userloginhistory_model->insert($loginhist);
			$errorMsg=$this->lang->line("HomeLoginActivateUser");
			//redirect($back2LoginPage."/".($errorMsg));
				$data["lang_label"]=$this->nativesession->get("language");
				$data["PrevURL"]=$prevURL;
				$data["error"]=$errorMsg;
				$this->nativesession->set("lastPageVisited","login");
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				//$this->load->view('failedPage', $data);
				echo "Unactivated User";
				return;
		}
		
		
		if($user["userID"]<>0){
			 $data["userID"]=$user["userID"];
			 $userID=$user["userID"];;
			 $data["password"]=$password;
			 $data["username"]=$username;
			$isValid = $this->userPassword->isValidPassword($data);
			if($isValid){
				if($user["blockDate"]!=null && $user["blockDate"]> date('Y-m-d'))
				{
					if( empty($user) ||
							(!empty($user) &&  isset($user) && $user<>null &&  $user["userID"]<>0
									&& strcmp($user["username"],"admin")!=0))
					{
						$errorMsg=$this->lang->line("NotAllowCreatePostBlackList");
						$data["error"]=$errorMsg;
						$data["prevURL"]=$prevURL;
						$data['redirectToWhatPage']="Home Page";
						$data['redirectToPHP']=base_url();
						$data["successTile"]=$this->lang->line("successTile");
						$data["failedTitle"]=$this->lang->line("failedTitle");
						$data["goToHomePage"]=$this->lang->line("goToHomePage");
						echo $errorMsg;
						//$this->load->view('failedPage', $data);
						return;
					}
				}
				 $user = $this->user->getUserByUsername($username);
                  $this->nativesession->set("user",$user);
			}else{
				
				$loginhist=array("username"=> $username, "logMsg"=>INCORRECTPASSWORD,
						"status"=>"F", "loginTime"=>  date("Y-m-d H:i:s"), "userID"=>$userID);
				$this->userloginhistory_model->insert($loginhist);
				$errorMsg=$this->lang->line("HomeLoginIncorrectPassword");
				//$msg=array("msg1"=>$errormsg);
				//$this->nativesession->set("errorMessage",$msg);
				//redirect($back2LoginPage."/".$errorMsg);
				$data["lang_label"]=$this->nativesession->get("language");
				$data["PrevURL"]=$prevURL;
				$data["error"]=$errorMsg;
				$this->nativesession->set("lastPageVisited","login");
				$data['redirectToWhatPage']="Login Page";
				$data['redirectToPHP']=base_url().MY_PATH."home/loginPage";
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				 
				//$this->load->view('failedPage', $data);
				echo "Invalid Password";
				return;
			}
		}else{
			$errorMsg=$this->lang->line("HomeLoginUnknownErrors");
			$data["lang_label"]=$this->nativesession->get("language");
			$data["PrevURL"]=$prevURL;
			$data["error"]=$errorMsg;
			$this->nativesession->set("lastPageVisited","login");
			$data['redirectToWhatPage']="Login Page";
			$data['redirectToPHP']=base_url().MY_PATH."home/loginPage";
			$data["successTile"]=$this->lang->line("successTile");
			$data["failedTitle"]=$this->lang->line("failedTitle");
			$data["goToHomePage"]=$this->lang->line("goToHomePage");
			
			$loginhist=array("username"=> $username, "logMsg"=>UNKNOWNLOGINERROR,
					"status"=>"F", "loginTime"=>  date("Y-m-d H:i:s"), "userID"=>$data["userID"]);
			$this->userloginhistory_model->insert($loginhist);
			
			//$this->load->view('failedPage', $data);
			echo "Unknown Error";
			return;
			//redirect($back2LoginPage."/".($errorMsg));
			//print_r($user);
			
		}
	
			$errorMsg=$this->lang->line("HomeLoginSuccess");
			
			$data["lang_label"]=$this->nativesession->get("language");
			$data["PrevURL"]=$prevURL;
			$data["error"]=$errorMsg;
			$this->nativesession->set("lastPageVisited","login");
			$data['redirectToWhatPage']="Previous Page";
			if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
				$data['redirectToPHP']=base_url();
			else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
				$data['redirectToPHP']=base_url();
			else if(strpos(((String)$_SESSION["previousUrl"]),'signupPage') !== false)
				$data['redirectToPHP']=base_url();
 			else 
 				$data['redirectToPHP']=$_SESSION["previousUrl"];
 			$data["PrevURL"]=$data['redirectToPHP'];
 			$data["successTile"]=$this->lang->line("successTile");
			$data["failedTitle"]=$this->lang->line("failedTitle");
			$data["goToHomePage"]=$this->lang->line("goToHomePage");
			$loginhist=array("username"=> $username, "logMsg"=>"SUCCESSLOGIN",
					"status"=>"A", "loginTime"=>  date("Y-m-d H:i:s"), "userID"=>$data["userID"]);
			$this->userloginhistory_model->insert($loginhist);
			$this->user->update($user);
			
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($user)){
				$menuCount=$this->getHeaderCount($user["userID"]);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($user["userID"]); //$menuCount["inboxMsgCount"]; //
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			//----------------------------
			//$this->load->view('successPage', $data);
			echo "Success";
			//return;
	}	
	
	function generateRandomString($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function forgetPassword()
	{
		
		$emailAddress=$this->input->post("sender-email");
		
		if($emailAddress!="")
		{
			if(!$this->userEmail->isEmailExist($emailAddress))
			{
				$errorMsg=$this->lang->line("HomeForgetPasswordFailedEmailNotExist");
				$data["lang_label"]=$this->nativesession->get("language");
				$data["error"]=$errorMsg;
				$this->nativesession->set("lastPageVisited","login");
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				
				$this->load->view('failedPage', $data);
				return;				
			}
		
			$userEmail=$this->userEmail->getUserEmailByEmail($emailAddress);
			

			if($this->sendEmailLog_model->getNoOfCountByUserID($userEmail['userID'], $userEmail["email"])>MAXTIMESSENDEMAIL){
				$errorMsg=sprintf($this->lang->line("HomeExceedMaxTimesSendEmail"),MAXTIMESSENDEMAIL,MAXTIMESMINUTESSENDEMAIL);
				$data["lang_label"]=$this->nativesession->get("language");
				$data["error"]=$errorMsg;
				$this->nativesession->set("lastPageVisited","login");
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				
				$this->load->view('failedPage', $data);
				return;
			}
				
			$userAfter = $this->user->getUserByUserID($userEmail['userID']);
			$user=$this->user->getUserByUserID($userEmail['userID']);
			$path=base_url().MY_PATH."home/resetPassword/".$userAfter["userID"]."/".md5($userAfter["createDate"]);
			$message=$this->mailtemplate_model->SendEmailMsgForResetPassword(
					$path, $user["username"]);
				$title=$this->mailtemplate_model->SendEmailTitleForResetPassword();
			$this->sendAuthenticationEmail($userEmail, $message, $title, FORGETPASSWORDSENDEMAIL);
			
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
		$data["About_us"] = $this->lang->line("About_us");
		$data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
		$data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
		$data["Contact_us"] = $this->lang->line("Contact_us");
		//log_message('debug', 'Contact Us words is: '.$data["Contact_us"]);
		$data["FAQ"] = $this->lang->line("FAQ");
		$data["Index_Footer1"] = $this->lang->line("Index_Footer1");
		$data["Call_Now"] = $this->lang->line("Call_Now");
		$data["Tel"] = $this->lang->line("Tel");
		
		$data["Login"]=$this->lang->line("Login");;
		$data["Signup"]=$this->lang->line("Signup");
		$data["Profile"]=$this->lang->line("Profile");
		$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
		$data["Logout"]=$this->lang->line("Logout");
		$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		
		
		$errorMsg=$this->lang->line("HomeForgetPasswordSuccess");
		$data["lang_label"]=$this->nativesession->get("language");
		$data["error"]=$errorMsg;
		$this->nativesession->set("lastPageVisited","login");
		$data['redirectToWhatPage']="Home Page";
		$data['redirectToPHP']=base_url();
		$data["successTile"]=$this->lang->line("successTile");
		$data["failedTitle"]=$this->lang->line("failedTitle");
		$data["goToHomePage"]=$this->lang->line("goToHomePage");
		//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			//----------------------------
		$this->load->view('successPage', $data);
		}
	}
	
	public function resetPassword($userID, $code)
	{
		$userAfter = $this->user->getUserByUserID($userID);
		$userEmail=$this->userEmail->getUserEmailByUserID($userID);
			
		$emailAddress=$userEmail["email"];
		
		if($emailAddress!="")
		{
			if(!$this->userEmail->isEmailExist($emailAddress))
			{
				$errorMsg=$this->lang->line("ResetPasswordFailed");
				$data["lang_label"]=$this->nativesession->get("language");
				$data["error"]=$errorMsg;
				$this->nativesession->set("lastPageVisited","login");
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				
				$this->load->view('failedPage', $data);
				return;	
			}
			$user = $this->user->getUserByUserID($userID);
			if($code != md5($user['createDate'])){
					$errorMsg=$this->lang->line("ResetPasswordFailed");
				$data["lang_label"]=$this->nativesession->get("language");
				$data["error"]=$errorMsg;
				$this->nativesession->set("lastPageVisited","login");
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				
				$this->load->view('failedPage', $data);
				return;	
			}
			if($this->sendEmailLog_model->getNoOfCountByUserID($userEmail['userID'], $userEmail["email"])>MAXTIMESSENDEMAIL){
				$errorMsg=sprintf($this->lang->line("HomeExceedMaxTimesSendEmail"),MAXTIMESSENDEMAIL,MAXTIMESMINUTESSENDEMAIL);
				$data["lang_label"]=$this->nativesession->get("language");
				$data["error"]=$errorMsg;
				$this->nativesession->set("lastPageVisited","login");
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
			
				$this->load->view('failedPage', $data);
				return;
			}
			$password=$this->generateRandomString();
			$userPasswordContent['userID']=$userEmail['userID'];
			$userPasswordContent['password']=$password;
				
			$this->userPassword->update($userPasswordContent);
			$path=base_url().MY_PATH."home/activate/".$userAfter["userID"]."/".md5($userAfter["createDate"]);
			$message=$this->mailtemplate_model->SendEmailMsgForUpdatePassword(
					$userAfter['username'], $password, $userAfter['username'],
					$path);
			$title=$this->mailtemplate_model->SendEmailTitleForForgotPassword();
			$this->sendAuthenticationEmail($userEmail, $message, $title, RESETPASSWORDSENDEMAIL);
				
			$data["lang_label_text"] = $this->lang->line("lang_label_text");
			$data["Home"] = $this->lang->line("Home");
			$data["About_us"] = $this->lang->line("About_us");
			$data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
			$data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
			$data["Contact_us"] = $this->lang->line("Contact_us");
			//log_message('debug', 'Contact Us words is: '.$data["Contact_us"]);
			$data["FAQ"] = $this->lang->line("FAQ");
			$data["Index_Footer1"] = $this->lang->line("Index_Footer1");
			$data["Call_Now"] = $this->lang->line("Call_Now");
			$data["Tel"] = $this->lang->line("Tel");
	
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
	
	
			$errorMsg=$this->lang->line("HomeForgetPasswordSuccess");
			$data["lang_label"]=$this->nativesession->get("language");
			$data["error"]=$errorMsg;
			$this->nativesession->set("lastPageVisited","login");
			$data['redirectToWhatPage']="Home Page";
			$data['redirectToPHP']=base_url();
			$data["successTile"]=$this->lang->line("successTile");
			$data["failedTitle"]=$this->lang->line("failedTitle");
			$data["goToHomePage"]=$this->lang->line("goToHomePage");
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			//----------------------------
			$this->load->view('successPage', $data);
		}
	}
	public function forgetPasswordPage()
	{
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
            $data["About_us"] = $this->lang->line("About_us");
            $data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
            $data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
            $data["Contact_us"] = $this->lang->line("Contact_us");
            //log_message('debug', 'Contact Us words is: '.$data["Contact_us"]);
            $data["FAQ"] = $this->lang->line("FAQ");
            $data["Index_Footer1"] = $this->lang->line("Index_Footer1");
            $data["Call_Now"] = $this->lang->line("Call_Now");
            $data["Tel"] = $this->lang->line("Tel");
          
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
			
			$data["Email"]=$this->lang->line("Email");
			$data["SendMeMyPassword"]=$this->lang->line("SendMeMyPassword");
			$data["BackToLogin"]=$this->lang->line("BackToLogin");
			$data["SignUp"]=$this->lang->line("SignUp");
			$this->load->view("forgot-password", $data);
			
	}
	
	public function logout(){
		
		//$this->nativesession->delete('user');
		$this->nativesession->destroy();
		redirect(base_url());
	}
	
	public function validateEmail(){
		sleep(1);
		$data['email'] = $this->input->post('email');
		if(null==($data['email'])){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Email cannot empty!</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Empty Email</span></em>';
			$data['emailError']='Error';
			echo json_encode($data);
			return;
		}
		$validate = $this->userEmail->isEmailExist($data['email']);
		$data['validate'] = $validate;
		if($validate){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Email: '. $data['email'] .' has been used already.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Email</span></em>';
			$data['emailError']='Error';
			echo json_encode($data);
			return;
		}else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Email: '. $data['email'] .' is invalid email.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Email</span></em>';
			$data['emailError']='Error';
			echo json_encode($data);
			return;
		} if(strlen($data['email'])> MAXLENGTHEMAIL){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Email: '. $data['email'] .' is too long.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Email</span></em>';
			$data['emailError']='Error';
			echo json_encode($data);
			return;
		}else{
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			//$data['icon'] = '<i class="girl-icon  icon-ok-circled ln-shadow shape-2"></i>';
			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i> Valid Email</span></em>';
			$data['emailError']='';
		}
		echo json_encode($data);
	}
	
	public function validateTel(){
		sleep(1);
		$data['telno'] = $this->input->post('telno');
		if(empty($data['telno'])){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Phone Number  cannot empty!</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Empty Phone</span></em>';
			$data['telError']='Error';
			echo json_encode($data);
			return;
		}
// 		$validate = !
		$validate=!is_numeric(trim($data["telno"]));;
		$data['validate'] = $validate==false;
		if($validate){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> phone number is digits only.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid phone number</span></em>';
			$data['telError']='Error';
			echo json_encode($data);
			return;
		}else{
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			//$data['icon'] = '<i class="girl-icon  icon-ok-circled ln-shadow shape-2"></i>';
			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i> Valid phone number</span></em>';
			$data['telError']='';
		}
		echo json_encode($data);
		
	}
	
	public function validateUsername(){
		sleep(1);
		$data['username'] = $this->input->post('username');
		if(empty($data['username'])){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Username cannot empty!</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Empty Username</span></em>';
			$data['usernameError']='Error';
			echo json_encode($data);
			return;
		}
		$validate=preg_match("/\p{Han}+/u", $data['username']);
		if($validate){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Username: ('. $data['username'] .') should not contain chinese word.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Username</span></em>';
			$data['usernameError']='Error';
			echo json_encode($data);
			return;
		}
		$validate = $this->user->isUserExist($data['username']);
		$data['validate'] = $validate;
		if($validate){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Username: '. $data['username'] .' has been used already.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Username</span></em>';
			$data['usernameError']='Error';
			echo json_encode($data);
			return;
		}
		if (filter_var($data['username'], FILTER_VALIDATE_EMAIL)) {
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Username: '. $data['username'] .' cannot be email.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Username</span></em>';
			$data['usernameError']='Error';
			echo json_encode($data);
			return;
			
		}
		
		if(strlen($data['username'])> MAXLENGTHUSERNAME){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Username: '. $data['username'] .' too long.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Username</span></em>';
			$data['usernameError']='Error';
			echo json_encode($data);
			return;
		}
		
		if (strpos(strtolower($data['username']), 'fuck') !== false) {
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Username: '. $data['username'] .' contains invalid words.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Username</span></em>';
			$data['usernameError']='Error';
			echo json_encode($data);
			return;
		}else{
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			//$data['icon'] = '<i class="girl-icon  icon-ok-circled ln-shadow shape-2"></i>';
                        $data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i> Valid Username</span></em>';
                        $data['usernameError']='';
		}
		echo json_encode($data);
	}
	
	public function validatePassword_signup(){
		sleep(1);
		$password = $this->input->post('password3');
		if(empty($password)){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Password cannot empty!</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Empty Password</span></em>';
			$data['passwordError']='Error';
			echo json_encode($data);
			return;
		}
		$validate=preg_match("/\p{Han}+/u", $password);
		if($validate){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Password: ('. $password .') should not contain chinese word.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Password</span></em>';
			$data['passwordError']='Error';
			echo json_encode($data);
			return;
		}
		if(strlen($password)> MAXLENGTHPASSWORD){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Password: '. $password.' too long.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Password</span></em>';
			$data['passwordError']='Error';
			echo json_encode($data);
			return;
		}
	
		if (strpos(strtolower($password), ' ') !== false) {
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> password: '. $password .' contains empty space.</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid Password</span></em>';
			$data['passwordError']='Error';
			echo json_encode($data);
			return;
		}
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			//$data['icon'] = '<i class="girl-icon  icon-ok-circled ln-shadow shape-2"></i>';
			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i> Valid Password</span></em>';
			$data['passwordError']='';
		
		echo json_encode($data);
	}
	public function viewAllFeedback($userID, $pageNum=1, $sortTypeID="0", $sortByDate="0", $sortByType="0", $activeTab="allAds"){
	
		$prevViewFeedBack_Url=base_url();
		if(isset($_GET["prevViewFeedBack_Url"]))
			$prevViewFeedBack_Url=$_GET["prevViewFeedBack_Url"];
		else if(isset($_SESSION["prevViewFeedBack_Url"]))
			$prevViewFeedBack_Url=$_SESSION["prevViewFeedBack_Url"];
		$_SESSION["prevViewFeedBack_Url"]=$prevViewFeedBack_Url;
		
		$data["prevViewFeedBack_Url"]=$prevViewFeedBack_Url;
		
		$prevUrl=base_url();
		if(isset($_GET["prevURL"])) {
			$prevUrl=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevUrl;
		}
		else if(isset($_SESSION["previousUrl"]))
			$prevUrl=$_SESSION["previousUrl"];
			$data["prevUrl"]=$prevUrl;
			$data["previousCurrent_url"]=$prevUrl;
	
			$data["userID"]=$userID;
				$data["pageNum"]=$pageNum;
				$userStat=$this->userstat_model->getUserStat($userID);
	
				$data["inboxMsgCount"]=0;
				$data["approveMsgCount"]=0;
				$data["myAdsCount"]=0;
				$data["savedAdsCount"]=0;
				$data["pendingMsgCount"]=0;
				$data["archivedAdsCount"]=0;
				$data["visitCount"]=0;
				$data["totalMyAdsCount"]=0;
				$data["favoriteAdsCount"]=0;
				$data["outgoingMsgCount"]=0;
				$data["buyAdsCount"]=0;
				$data["directsendhistCount"]=0;
				$data["directsendhistCount1"]=0;
				if(isset($userStat) && !empty($userStat)){
					$data["inboxMsgCount"]=$userStat[0]->inboxMsgCount;
					$data["approveMsgCount"]=$userStat[0]->approveMsgCount;
					$data["myAdsCount"]=$userStat[0]->myAdsCount;
					$data["savedAdsCount"]=$userStat[0]->savedAdsCount;
					$data["pendingMsgCount"]=$userStat[0]->pendingMsgCount;
					$data["archivedAdsCount"]=$userStat[0]->archivedAdsCount;
					$data["visitCount"]=$userStat[0]->visitCount;
					$data["totalMyAdsCount"]=$userStat[0]->totalMyAdsCount;
					$data["favoriteAdsCount"]=$userStat[0]->favoriteAdsCount;
					$data["outgoingMsgCount"]=$userStat[0]->outgoingMsgCount;
					$data["buyAdsCount"]=$userStat[0]->buyAdsCount;
					$data["directsendhistCount"]=$userStat[0]->directsendhistCount;
					$data["directsendhistCount1"]=$userStat[0]->directsendhistCount;
				}
	
				//----------setup the header menu----------
				$data["menuMyAds"]="";
				$data["menuInbox"]="class=\"active\"";
				$data["menuInboxNum"]="0";
				$data["menuPendingRequest"]="";
				$data["menuPendingRequestNumber"]="0";
				if(isset($userID)){
					$menuCount=$this->getHeaderCount($userID);
					$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userID); //$menuCount["inboxMsgCount"]; //
					$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
				}
				$data["activeTab"]=$activeTab;
				$data["lblSellerInfo"]=$this->lang->line("viewCommentSeller");
				$data["lblBuyerInfo"]=$this->lang->line("viewCommentBuyer");
				$data["lblConditionAll"]=$this->lang->line("viewCommentAll");
				$data["profileBackToResult"]=$this->lang->line("profileBackToResult");
				$data["sortTypeID"]="0";
				$data["sortByDate"]="0";
				$data["sortByType"]="0";
				$tempSortByID=$this->input->post("selectSortType");
				if(!empty($tempSortByID))
					$data["sortTypeID"]=$this->input->post("selectSortType");
				else 
					$data["sortTypeID"]=$sortTypeID;
				$tempSortByID=$this->input->post("sortByDate");
				if(!empty($tempSortByID))
					$data["sortByDate"]=$this->input->post("sortByDate");
				else 
					$data["sortByDate"]=$sortByDate;
				$tempSortByID=$this->input->post("sortByType");
				if(!empty($tempSortByID))
					$data["sortByType"]=$this->input->post("sortByType");
				else 
					$data["sortByType"]=$sortByType;
				
				if(strcmp($data["sortTypeID"],"1")==0){
					$data["sortByType"]="0";
				}else if(strcmp($data["sortTypeID"],"2")==0){
					$data["sortByDate"]="0";
				}else {
					$data["sortByType"]="0";
					$data["sortByDate"]="0";
				}
					
				$data["NoOfItemCount"]=$this->messages_model->getNoOfItemCountInAllFeedbacks($userID, $data["sortTypeID"], $data["sortByDate"], $data["sortByType"], $activeTab);
				$myList=$this->messages_model->getAllFeedbacks($userID, $pageNum, $data["sortTypeID"], $data["sortByDate"], $data["sortByType"], $activeTab);
				$data["result"]=$this->mapFeedbackToView($myList);
				
// 				if(strcmp($activeTab, "sellerAds")==0){
// 					$count=0;
// 					if($data["result"]!=null){
// 						foreach($data["result"] as $id=>$row)
// 						{
// 							if(strcmp($row["typeID"], "buyer")==0)
// 								continue;
// 							$count=$count+1;
// 						}
// 					}
// 					$data["NoOfItemCount"]=$count;
// 				}
// 				if(strcmp($activeTab, "buyerAds")==0){
// 					$count=0;
// 					if($data["result"]!=null){
// 						foreach($data["result"] as $id=>$row)
// 						{
// 							if(strcmp($row["typeID"], "seller")==0)
// 								continue;
// 							$count=$count+1;
// 						}
// 					}
// 					$data["NoOfItemCount"]=$count;
// 				}
				
				
				
				$data["lang_label_text"] = $this->lang->line("lang_label_text");
				$data["lang_label"] = $this->nativesession->get("language");
				$data["Home"] = $this->lang->line("Home");
				$data["About_us"] = $this->lang->line("About_us");
				$data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
				$data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
				$data["Contact_us"] = $this->lang->line("Contact_us");
				$data["FAQ"] = $this->lang->line("FAQ");
				$data["Index_Footer1"] = $this->lang->line("Index_Footer1");
				$data["Call_Now"] = $this->lang->line("Call_Now");
				$data["Tel"] = $this->lang->line("Tel");
				
				$data["Login"]=$this->lang->line("Login");
				$data["Signup"]=$this->lang->line("Signup");
				$data["Profile"]=$this->lang->line("Profile");
				$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
				$data["Logout"]=$this->lang->line("Logout");
				$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
				
				$data["lang_label"]=$this->nativesession->get("language");
				$data["activeTab"]=$activeTab;	
				
				$data["lblSearchSortBy"]=$this->lang->line("lblSearchSortBy");
				$data["mostRecent"]=$this->lang->line("mostRecent");
				$data["oldest"]=$this->lang->line("oldest");
				$data["Category"]=$this->lang->line("Category");
				$data["Date"]=$this->lang->line("Date");
				$data["good"]=$this->lang->line("good");
				$data["average"]=$this->lang->line("average");
				$data["bad"]=$this->lang->line("bad");
				
				$this->load->view("profile_allFeedbacks", $data);
	}
	
	public function mapFeedbackToView($myList){
		
		$result=array();
		$lang_label=$this->nativesession->get("language");
		if($myList!=null){
			foreach($myList as $row)
			{
				$feedBackKey=$row->ID.$row->type;
				$type="";
				$typeID=$row->type;
				if(strcmp($row->type,"buyer")==0)
					$type=$this->lang->line("SellerName");
				else 
					$type=$this->lang->line("BuyerName");
				
				$userName="";
				$createDate=$row->createDate;
				$rating=$row->rating;
				$feedback=$row->content;
				$arrayMessage=array($feedBackKey => 
						array("type"=>$type,
						"typeID"=>$typeID,
						"fromUser"=>$userName,
						"rating"=>$rating,
						"feedback"=>$feedback,
						"createDate"=>$createDate));
						
				if($result==null)
					$result=$arrayMessage;
					else
						$result=$result + $arrayMessage;
			}
		}
		return $result;
		
	}
	public function viewAllComments($userID, $pageNum=1){
	
		$previousUrl="";
		if(isset($_GET["prevURL"]))
			$previousUrl=$_GET["prevURL"];
			else
				$previousUrl=base_url();
				$prevURL=$previousUrl;
				$_SESSION["previousUrl"]=$previousUrl;
				$data["previousCurrent_url"]=($previousUrl);
				$data["userID"]=$userID;
				$data["pageNum"]=$pageNum;
				$userStat=$this->userstat_model->getUserStat($userID);
	
				$data["inboxMsgCount"]=0;
				$data["approveMsgCount"]=0;
				$data["myAdsCount"]=0;
				$data["savedAdsCount"]=0;
				$data["pendingMsgCount"]=0;
				$data["archivedAdsCount"]=0;
				$data["visitCount"]=0;
				$data["totalMyAdsCount"]=0;
				$data["favoriteAdsCount"]=0;
				$data["outgoingMsgCount"]=0;
				$data["buyAdsCount"]=0;
				$data["directsendhistCount"]=0;
				$data["directsendhistCount1"]=0;
				if(isset($userStat) && !empty($userStat)){
					$data["inboxMsgCount"]=$userStat[0]->inboxMsgCount;
					$data["approveMsgCount"]=$userStat[0]->approveMsgCount;
					$data["myAdsCount"]=$userStat[0]->myAdsCount;
					$data["savedAdsCount"]=$userStat[0]->savedAdsCount;
					$data["pendingMsgCount"]=$userStat[0]->pendingMsgCount;
					$data["archivedAdsCount"]=$userStat[0]->archivedAdsCount;
					$data["visitCount"]=$userStat[0]->visitCount;
					$data["totalMyAdsCount"]=$userStat[0]->totalMyAdsCount;
					$data["favoriteAdsCount"]=$userStat[0]->favoriteAdsCount;
					$data["outgoingMsgCount"]=$userStat[0]->outgoingMsgCount;
					$data["buyAdsCount"]=$userStat[0]->buyAdsCount;
					$data["directsendhistCount"]=$userStat[0]->directsendhistCount;
					$data["directsendhistCount1"]=$userStat[0]->directsendhistCount;
				}
	
				//----------setup the header menu----------
				$data["menuMyAds"]="";
				$data["menuInbox"]="class=\"active\"";
				$data["menuInboxNum"]="0";
				$data["menuPendingRequest"]="";
				$data["menuPendingRequestNumber"]="0";
				if(isset($userID)){
					$menuCount=$this->getHeaderCount($userID);
					$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userID); //$menuCount["inboxMsgCount"]; //
					$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
				}
				$data["NoOfItemCount"]=$this->post_model->getNoOfItemCountInMyAds($userID);
				$myList=$this->post_model->getMyAds($userID, $pageNum);
				$data["result"]=$this->mapPostToView($myList);
				$data["activeTab"]="allAds";
				$data["lblSellerInfo"]=$this->lang->line("SellerName");
				$data["lblBuyerInfo"]=$this->lang->line("BuyerName");
				$data["lblConditionAll"]=$this->lang->line("lblConditionAll");
				
				$data["profileBackToResult"]=$this->lang->line("profileBackToResult");
				
				$this->load->view("profile_allComments", $data);
	}
	
	
	public function validatePassword(){
		log_message('debug', 'checking user password');
		$password = $this->input->post('password');
		$retype = $this->input->post('retype');
		log_message('debug', 'post data');
		if($password == $retype){
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i> Correct Password</span></em>';
		}else{
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Your passwords do not match!</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Incorrect Password</span></em>';
		}
		log_message('debug', 'end of checking user password');
		echo json_encode($data);
	}
	
	
	private function sendAuthenticationEmail($userEmail, $msg, $title, $type=""){

		$allow=$this->userInfoSendEmail_model->getAlowSendEmailByType($userEmail["userID"], $type);
		if(!$allow)
			return;
		
			$user1=$this->nativesession->get("user");
			$userID=0;
			if(!isset($user1) or empty($user1) or $user1==null)
				$userID=0; //$userEmail["userID"];
			else 
				$userID=$user1["userID"];
			$data=array();
			$data["userID"]=$userID;
			$data["toEmailAddress"]=$userEmail['email'];
			$data["title"]=$title;
			$data["type"]=$type;
			//$data["createDate"]=date('Y/m/d H:i:s');
			$this->sendEmailLog_model->insert($data);
			
			
		$config['protocol'] = SMTP_PROTOCOL;
				$config['smtp_host'] = SMTP_HOST;
				$config['smtp_port'] = SMTP_PORT;
				$config['smtp_user'] = SMTP_USER;
				$config['smtp_pass'] = SMTP_PASSWORD;
				$config['charset'] = "utf-8";
				$config['mailtype'] = "html";
				$config['newline'] = "\r\n";
				$config['wordwrap'] = TRUE;
				$this->load->library('email');
				$this->email->initialize($config);
				
				$this->email->set_mailtype('html');
				$this->email->from(SMTP_USER, 'www.girlstrade.com');
				$this->email->to($userEmail['email']);
		
		$this->email->subject($title);
		$message=$msg;
		
		
		$this->email->message($message);
		
		$this->email->send();
		//echo $this->email->print_debugger();
		log_message('debug', 'send Email');
		//echo 'Sending Email';
	}
	
	public function changePassword(){
		try{
		$currentPassword=$this->input->post('currentPassword');
		$newPassword=$this->input->post('newPassword');
		$newReTypePassword=$this->input->post('newReTypePassword');
		$userInfo=$this->nativesession->get('user');
		$userID=$userInfo['userID'];
		$email=$this->userEmail->getUserEmailByUserID($userID);
		$input=array('userID'=>$userID, 'password'=> $newPassword);
		if($this->sendEmailLog_model->getNoOfCountByUserID($email['userID'], $email["email"])>MAXTIMESSENDEMAIL){
			$errorMsg=sprintf($this->lang->line("HomeExceedMaxTimesSendEmail"),MAXTIMESSENDEMAIL,MAXTIMESMINUTESSENDEMAIL);
			$data["lang_label"]=$this->nativesession->get("language");
			$data["error"]=$errorMsg;
			$this->nativesession->set("lastPageVisited","login");
			$data['redirectToWhatPage']="Home Page";
			$data['redirectToPHP']=base_url();
			$data["successTile"]=$this->lang->line("successTile");
			$data["failedTitle"]=$this->lang->line("failedTitle");
			$data["goToHomePage"]=$this->lang->line("goToHomePage");
		
			$this->load->view('failedPage', $data);
			return;
		}
		$this->userPassword->changePassword($input);
		$email=$this->userEmail->getUserEmailByUserID($userID);
		$msg=$this->mailtemplate_model->SendEmailMsgForChangePassword($userInfo['username']);
		$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForChangePassword(), CHANGEPASSWORDSENDEMAIL);
		
		
		
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
	}
	
	function minusDayswithdate($date,$days){
		 
		$date = strtotime("-".$days." days", strtotime($date));
		return  date("Y-m-d", $date);
		 
	}
	public function activate($userID, $code){
		echo 'activating userID: '.$userID;
		echo 'code: '.$code;
		$user = $this->user->getUserByUserID($userID);
		$userEmail = $this->userEmail->getUserEmailByUserID($user['userID']);
			
		$result = 0;
		$result2 = 0;
		$result3=0;
		$errorMsg="";
		
		if(isset($user) && isset($userEmail)){
			if($code != md5($user['createDate'])){
				echo 'Your activation code is incorrect!';
			}else{
				$expiryDate=$this->minusDayswithdate(date("Y-m-d H:i:s"), MAXDAYSACTIVATEUSEREXPIRYDAYS);
				if($user['createDate'] >= $expiryDate)
				{
					if(strcmp($user['accountStatus'],"U")==0){
						$user['accountStatus'] = 'A';
						$userEmail['status'] = 'A';
						$result = $this->user->update($user);
						$result2 = $this->userEmail->update($userEmail);
						$result3=1;
					}else{
						if(strcmp($user['accountStatus'],"A")==0)
							$errorMsg=$errorMsg."Activation has been done before!<br/>";
						else
							$errorMsg=$errorMsg."Activation failed!<br/>";
					}
				}else{
					$errorMsg=$errorMsg."Your activation period has expired!<br/>";
				}
			}
		}else{
			$errorMsg=$errorMsg."Activation failed due to your activation period has expired and account deleted!<br/>";
		}
		if($result == 1){
			$errorMsg=$errorMsg."Your account has been successfully activated!<br/>";
		}else{
			$errorMsg=$errorMsg.'Your account cannot be created at this time. Please contact admin for more information.<br/>';
		}
		if($result2 == 1){
			$errorMsg=$errorMsg. 'Email address verified!';
		}else{
			$errorMsg=$errorMsg. 'Unable to verify your email address.';
		}
		
		$data["error"]=$errorMsg;
		$this->nativesession->set("lastPageVisited","login");
		$data["PrevURL"]=base_url();
            	$data['redirectToWhatPage']="Home Page";
		$data['redirectToPHP']=base_url();
		$data["successTile"]=$this->lang->line("successTile");
		$data["failedTitle"]=$this->lang->line("failedTitle");
		$data["goToHomePage"]=$this->lang->line("goToHomePage");
		//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($userID)){
				$menuCount=$this->getHeaderCount($userID);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userID); //$menuCount["inboxMsgCount"]; //
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			//----------------------------
		if($result==1 && $result2==1 && $result3==1) {
			$data["error"]=$data["error"]."Registration has been completed!";
			$this->load->view('successPage', $data);
		}
		else 
			$this->load->view('failedPage', $data);
	}
	public function getAccountPage($activeNav, $pageNum=1, $errorMsg='', $sortByDate="2", $fromUserIDInMessage=0)
	{
		
		
		if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
		}else if(isset($_SESSION["previousUrl"])){
			$prevURL=$_SESSION["previousUrl"];
		}
		
		
		
		$expired= $this->nativesession->_session_id_expired();
		if($expired){
			$this->loginPage('', $activeNav); return;}
		
		$data["previousCurrent_url"]=urlencode(current_url());
		$data["MyAds"]=$this->lang->line("MyAds");
		$data["PersonalHome"]=$this->lang->line("PersonalHome");
		$data["FavoriteAds"]=$this->lang->line("FavoriteAds");
		$data["SavedSearch"]=$this->lang->line("SavedSearch");
		$data["ArchivedAds"]=$this->lang->line("ArchivedAds");
		$data["PendingApproval"]=$this->lang->line("PendingApproval");
		$data["PaymentHistory"]=$this->lang->line("PaymentHistory");
		$data["PostFreeAds"]=$this->lang->line("PostFreeAds");
		$data["Inbox"]=$this->lang->line("Inbox");
		$data["ApproveRequest"]=$this->lang->line("ApproveRequest");
		$data["EditProfile"]=$this->lang->line("EditProfile");
		$data["SavedItems"]=$this->lang->line("SavedItems");
		$data["PendingRequest"]=$this->lang->line("PendingRequest");
		$data["ApprovedRequest"]=$this->lang->line("ApprovedRequest");
		$data["TerminateAccount"]=$this->lang->line("TerminateAccount");
		$data["CloseAccount"]=$this->lang->line("CloseAccount");
		$data["OutgoingMsgTitle"]=$this->lang->line("OutgoingMsgTitle");
		$data["AccountTabName"]=$this->lang->line("AccountTabName");
		$data["HidePhoneNumber"]=$this->lang->line("HidePhoneNumber");
		 
		
		//----menu chinese config-----------
		$data["accountProfileLang"]=$this->lang->line("accountProfileLang");
		$data["accountEmailConfigLang"]=$this->lang->line("accountEmailConfigLang");
		$data["accountInboxLang"]=$this->lang->line("accountInboxLang");
		$data["accountMyAdsLang"]=$this->lang->line("accountMyAdsLang");
		$data["accountBuyerListLang"]=$this->lang->line("accountBuyerListLang");
		$data["accountSellerListLang"]=$this->lang->line("accountSellerListLang");
		$data["accountFavoriteLang"]=$this->lang->line("accountFavoriteLang");
		

		
		//------------profile header-----------------
		$data["accountHeaderVisitLang"]=$this->lang->line("accountHeaderVisitLang");
		$data["accountHeaderAdsLang"]=$this->lang->line("accountHeaderAdsLang");
		$data["accountHeaderFavLang"]=$this->lang->line("accountHeaderFavLang");
		//------------profile visit header-----------------
		$data["accountProfileHeaderHelloLang"]=$this->lang->line("accountProfileHeaderHelloLang");
		$data["accountProfileHeaderTimeLang"]=$this->lang->line("accountProfileHeaderTimeLang");
		$data["changePassword"]=$this->lang->line("changePassword");

		
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
            $data["About_us"] = $this->lang->line("About_us");
            $data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
            $data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
            $data["Contact_us"] = $this->lang->line("Contact_us");
            //log_message('debug', 'Contact Us words is: '.$data["Contact_us"]);
            $data["FAQ"] = $this->lang->line("FAQ");
            $data["Index_Footer1"] = $this->lang->line("Index_Footer1");
            $data["Call_Now"] = $this->lang->line("Call_Now");
            $data["Tel"] = $this->lang->line("Tel");
          
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		$user1=$this->nativesession->get("user");
		if(!isset($user1) or empty($user1) or $user1==null){
			$errorMsg=$this->lang->line("RequireLoginToAccess");
			$data["error"]=$errorMsg;
			$data['redirectToWhatPage']="Login in Page";
			$data['redirectToPHP']=base_url().MY_PATH."home/loginPage?prevURL=".base_url().MY_PATH."home/getAccountPage/".$activeNav;
			$data["successTile"]=$this->lang->line("successTile");
			$data["failedTitle"]=$this->lang->line("failedTitle");
			$data["goToHomePage"]=$this->lang->line("goToHomePage");
			$this->load->view('failedPage', $data);
			return;
		}
		
		if(strcmp($user1["photostatus"],"A")==0)
			$data["userPhotoPath"]=base_url().$user1['thumbnailPath'].'/'.$user1['thumbnailName'];
		else 
			$data["userPhotoPath"]=base_url()."images/user.jpg";
		
		$userID=$user1["userID"];
		$data["userID"]=$userID;
		$userInfo=$this->userInfo->getUserInfoByUserID($userID);
		$address=$this->address->getAddressByUserID($userID);
		$email=$this->userEmail->getUserEmailByUserID($userID);
		$data["userName"]=$user1["username"];
		
			
		$data["lastName"]="";
		$data["firstName"]="";
		$data["country"]="";
		$data["language"]="";
		$data["phoneNo"]="";
		$data["telNo"]="";
		$data["checkBox1"]=false;
		$data["checkBox2"]=false;
		$data["hidetelno"]=false;
		$data['showWeChatID']=true;
		$data['weChatID']="";
		$data['showWebSite']=true;
		$data['webSiteAddr']="";
		if(isset($userInfo) && !empty($userInfo) && $userInfo <>null)
		{
		$data["lastName"]=$userInfo["lastName"];
		$data["firstName"]=$userInfo["firstName"];
		$data["gender"]=$userInfo["gender"];
		$data["country"]=$userInfo["country"];
		$data["language"]=$userInfo["language"];
		$data["phoneNo"]=$userInfo["phoneNo"];
		$data["telNo"]=$userInfo["telNo"];
		$data["checkBox1"]=$userInfo["checkBox1"];
		$data["checkBox2"]=$userInfo["checkBox2"];
		$data["hidetelno"]=$userInfo["hidetelno"];
		$data["introduction"]=$userInfo["introduction"];
		$data["descriptionTextarea"]=$userInfo["introduction"];
		
		$data['showWeChatID']=$userInfo['showWeChatID'];
		$data['weChatID']=$userInfo['weChatID'];
		$data['showWebSite']=$userInfo['showWebSite'];
		$data['webSiteAddr']=$userInfo['webSiteAddr'];
		
		
		//$data["documentType"]=$userInfo["documentType"];
		}
		$data["email"]=$email["email"];
		if($address<>null)
		{
			$data["country"]=$address["country"];
		$data["area"]=$address["area"];
		$data["district"]=$address["district"];
		$data["street"]=$address["street"];
		$data["building"]=$address["building"];
		$data["roomNo"]=$address["roomNo"];
		$data["postalCode"]=$address["postalCode"];
		}
		 $data["lang_label"]=$this->nativesession->get("language");
        $data["result"]=$this->getPendingPost($pageNum);
        $data["activeNav"]=$activeNav;
        $data["pageNum"]=$pageNum;
       $data["error"]=$errorMsg;
       $date=new DateTime();
	    $data["lastLoginTime"]=$date->format('Y-m-d H:i:s');
	          $NoOfItemCount=0;
        
        $userStat=$this->userstat_model->getUserStat($userID);
        
        $data["inboxMsgCount"]=0;
        $data["approveMsgCount"]=0;
        $data["myAdsCount"]=0;
        $data["savedAdsCount"]=0;
        $data["pendingMsgCount"]=0;
        $data["archivedAdsCount"]=0;
        $data["visitCount"]=0;
        $data["totalMyAdsCount"]=0;
        $data["favoriteAdsCount"]=0;
        $data["outgoingMsgCount"]=0;
        $data["buyAdsCount"]=0;
        $data["directsendhistCount"]=0;
        $data["directsendhistCount1"]=0;
        if(isset($userStat) && !empty($userStat)){
        	$data["inboxMsgCount"]=$userStat[0]->inboxMsgCount;
        	$data["approveMsgCount"]=$userStat[0]->approveMsgCount;
        	$data["myAdsCount"]=$userStat[0]->myAdsCount;
        	$data["savedAdsCount"]=$userStat[0]->savedAdsCount;
        	$data["pendingMsgCount"]=$userStat[0]->pendingMsgCount;
        	$data["archivedAdsCount"]=$userStat[0]->archivedAdsCount;
        	$data["visitCount"]=$userStat[0]->visitCount;
        	$data["totalMyAdsCount"]=$userStat[0]->totalMyAdsCount;
        	$data["favoriteAdsCount"]=$userStat[0]->favoriteAdsCount;
        	$data["outgoingMsgCount"]=$userStat[0]->outgoingMsgCount;
        	$data["buyAdsCount"]=$userStat[0]->buyAdsCount;
        	$data["directsendhistCount"]=$userStat[0]->directsendhistCount;
        	$data["directsendhistCount1"]=$userStat[0]->directsendhistCountAsSeller;
        }
        
        $data["sellerRating"]=$this->tradecomments_model->getRating($userID);
        //----------setup the header menu----------
        $data["menuMyAds"]="";
        $data["menuInbox"]="class=\"active\"";
        $data["menuInboxNum"]="0";
        $data["menuPendingRequest"]="";
        $data["menuPendingRequestNumber"]="0";
        if(isset($userID)){
        	$menuCount=$this->getHeaderCount($userID);
        	$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userID); //$menuCount["inboxMsgCount"]; //
        	$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
        }
        //----------------------------
        $data["sortByDate"]=$sortByDate;
        $data["lblSearchSortBy"]=$this->lang->line("lblSearchSortBy");
        $data["mostRecent"]=$this->lang->line("mostRecent");
        $data["oldest"]=$this->lang->line("oldest");
        
		if($activeNav==1)
		{
// 			$data["NoOfItemCount"]=$this->messages_model->getNoOfItemCountInInbox($userID);
// 			$myList=$this->messages_model->getInBoxByPostUserId($userID, $pageNum);
// 			$data["result"]=$this->mapInBoxToView($myList, "Inbox");
// 			$this->load->view("account-inbox-new", $data);
			
			$data["NoOfItemCount"]=$this->messages_model->getNoOfItemCountInBuyerMessageInboxByPostUserId($userID);
			$myList=$this->messages_model->getBuyerMessageInBoxByPostUserId($userID, $pageNum, $sortByDate);
			$data["result"]=$this->mapInBoxByPostUserIdToView($myList, "Inbox");
			$this->load->view("account-inbox-onlybyuserid", $data);
			
		}
		else if($activeNav==2)
		{
			$data["NoOfItemCount"]=$this->requestpost_model->getNoOfItemCountInApproveAndReject($userID);
			$myList=$this->requestpost_model->getApproveAndReject($userID, 0);
			$data["result"]=$this->mapReqeustPostToView($myList, 'seller', "ApproveAndReject");
			$data["NoOfItemCount"]= $data["NoOfItemCount"] + $this->requestpost_model->getNoOfItemCountInDirectSendHistoryAsSeller($userID);
			$myList=$this->requestpost_model->getDirectSendHistoryAsSeller($userID, 0);
			//var_dump($myList);
			if(isset($data["result"]) && $data["result"]!=null && count($data["result"])>0)
				$data["result"]=array_merge($data["result"], $this->mapReqeustPostToViewOfArray($myList, "seller"));
			else 
				$data["result"]=$this->mapReqeustPostToViewOfArray($myList, "seller");
			if($sortByDate==2)
				usort($data["result"], array($this, "cmp2"));
			else
				usort($data["result"], array($this, "cmp1"));
			
				$ulimit=ITEMS_PER_PAGE;
				$olimit=0;
				if ($pageNum>1)
					$olimit=($pageNum-1)*ITEMS_PER_PAGE;
				$data["result"]=array_slice($data["result"],$olimit , $ulimit);
				
				
			$data["DirectSendType"]="Seller";
			$this->load->view("account-approve-request-ads", $data);
		}
		else if($activeNav==3)
		{
			$data["NoOfItemCount"]=$this->post_model->getNoOfItemCountInMyAds($userID);
			$myList=$this->post_model->getMyAds($userID, $pageNum, $sortByDate);
			$data["result"]=$this->mapPostToView($myList);
			if($sortByDate==2)
				usort($data["result"], array($this, "cmp2"));
			else
				usort($data["result"], array($this, "cmp1"));
					
			$ulimit=ITEMS_PER_PAGE;
			$olimit=0;
			if ($pageNum>1)
				$olimit=($pageNum-1)*ITEMS_PER_PAGE;
			$data["result"]=array_slice($data["result"],$olimit , $ulimit);
							
			$this->load->view("account-myads", $data);
		}
		else if($activeNav==4)
		{
				$this->load->view("account-home", $data);
		}else if($activeNav==5)
		{
			$data["NoOfItemCount"]=$this->savedAds_model->getNoOfItemCountInSavedAds($userID);
			$myList=$this->savedAds_model->getSavedAds($userID, $pageNum, $sortByDate);
			$data["result"]=$this->mapReqeustPostToView($myList);
			if($sortByDate==2)
				usort($data["result"], array($this, "cmp2"));
				else
					usort($data["result"], array($this, "cmp1"));
						
					$ulimit=ITEMS_PER_PAGE;
					$olimit=0;
					if ($pageNum>1)
						$olimit=($pageNum-1)*ITEMS_PER_PAGE;
						$data["result"]=array_slice($data["result"],$olimit , $ulimit);
							
				$this->load->view("account-saved-search", $data);
		}
		else if($activeNav==6)
		{
			$data["NoOfItemCount"]=$this->requestpost_model->getNoOfItemCountInPendingApproval($userID);
			$myList=$this->requestpost_model->getPendingApproval($userID,0);
			$data["result"]=$this->mapReqeustPostToView($myList, "buyer", "PendingApproval");
			$data["NoOfItemCount"]=$data["NoOfItemCount"]+$this->requestpost_model->getNoOfItemCountInDirectSendHistory($userID);
			$myList=$this->requestpost_model->getDirectSendHistory($userID, 0);
			if($data["result"]!=null && count($data["result"])>0)
				$data["result"]=array_merge($data["result"],$this->mapReqeustPostToView($myList, "buyer"));
			else
				$data["result"]=$this->mapReqeustPostToView($myList, "buyer");
			if($sortByDate==2)
				usort($data["result"], array($this, "cmp2"));
			else
				usort($data["result"], array($this, "cmp1"));
			
				$ulimit=ITEMS_PER_PAGE;
				$olimit=0;
				if ($pageNum>1)
					$olimit=($pageNum-1)*ITEMS_PER_PAGE;
					$data["result"]=array_slice($data["result"],$olimit , $ulimit);
				
			$data["DirectSendType"]="Buyer";
			$this->load->view("account-pending-approval-ads", $data);
		}
		else if($activeNav==10)
		{
			$data["NoOfItemCount"]=$this->messages_model->getNoOfItemCountInOutgoingByPostUserId($userID);
			$myList=$this->messages_model->getOutgoingByPostUserId($userID, $pageNum, $sortByDate);
			$data["result"]=$this->mapInBoxByPostUserIdToView($myList, "OutBox");
				$this->load->view("account-outbox-onlybyuserid", $data);
			
		}
		else if($activeNav==7){
			$data["NoOfItemCount"]=$this->post_model->getNoOfItemCountInArchiveAds($userID);
			$myList=$this->post_model->getArchiveAds($userID, $pageNum, $sortByDate);
			$data["result"]=$this->mapPostToView($myList);
			$this->load->view("account-archived-ads", $data);
		}
		else if($activeNav==11){
			$data["NoOfItemCount"]=$this->tradecomments_model->getNoOfItemCountInBuyAdsHistory($userID);
			$myList=$this->tradecomments_model->getBuyAdsHistory($userID, $pageNum, $sortByDate);
			$data["result"]=$this->mapTradeCommentToView($myList);
			$this->load->view("account-my-buy-history", $data);
		}else if($activeNav==8){
			$this->load->view("account-statements", $data);
		}else if($activeNav==9){
			$this->load->view("account-close", $data);
		}else if($activeNav==12){
			$data["userID"]=$userID;
			$data["result"]=$this->userInfoSendEmail_model->getSendEmailConfigByUserID($userID);
			$data["mandatory"]=$this->userInfoSendEmail_model->getMandatorySendEmailConfigByUserID($userID);
			$this->load->view('adminSendEmailConfig.php', $data);
		}else if ($activeNav==13){
			$data["NoOfItemCount"]=$this->messages_model->getNoOfItemCountInBuyerMessageByUserID($userID, "Summary", 0);
			$data["mostRecent"]=$this->lang->line("mostRecent");
			$data["oldest"]=$this->lang->line("oldest");
			$data["lblSearchSortBy"]=$this->lang->line("lblSearchSortBy");
			$myList=$this->messages_model->getBuyerMessageByUserID($userID, $pageNum, $sortByDate, "Summary", 0);
			$data["result"]=$this->mapInBoxByPostUserIdToView($myList, "All", "Summary");
			$this->load->view('account-message-onlybyuserid', $data);
		}else if ($activeNav==14){
			$fromUserID=$fromUserIDInMessage; // $_POST["fromUserID"];
			$fromUser=$this->user->getUserByUserID($fromUserID);
			if(strcmp($fromUser["photostatus"],"A")==0)
				$data["fromUserPhotoPath"]=base_url().$user1['thumbnailPath'].'/'.$user1['thumbnailName'];
			else
				$data["fromUserPhotoPath"]=base_url()."images/user.jpg";
			$data["sendToUserID"]=$fromUserID;
			$data["prevURL"]=$prevURL;
			$data["NoOfItemCount"]=$this->messages_model->getNoOfItemCountInBuyerMessageByUserID($userID, "Detail", $fromUserID);
			$myList=$this->messages_model->getBuyerMessageByUserID($userID, $pageNum, $sortByDate, "Detail", $fromUserID);
			$data["result"]=$this->mapInBoxByPostUserIdToView($myList, "All");
			$data["profileBackToResult"]=$this->lang->line("profileBackToResult");
			
			$this->messages_model->updateReadInboxBuyerMessageFlagByUserID($fromUserID);
			
			$this->load->view('account-chat', $data);
		}else if ($activeNav==15){
			$myList=$this->messages_model->getBuyerMessageByUserID($userID, $pageNum, $sortByDate, "Summary", 0);
			$data["result"]=$this->mapInBoxByPostUserIdToView($myList, "All");
			
			$this->load->view('account-profile', $data);
		}
	}
	public function mapInBoxByPostUserIdToView($inbox, $type="Inbox", $reportType="Detail"){

		$result=array();
		$lang_label=$this->nativesession->get("language");
		if($inbox!=null){
			foreach($inbox as $row)
			{
				$userID=0;
				$fromUserID=0;
				$unreadCount=0;
				if(strcmp($reportType, "Summary")==0)
					$unreadCount=$row->unreadcount;
				
				if(strcmp($type, "All")==0){
					if(strcmp($row->msgType, "Inbox")==0){
						$userID=$row->userID;
						$fromUserID=$row->fromUserID;
					}else {
						$userID=$row->fromUserID;
						$fromUserID=$row->userID;
					}
				
				} else if(strcmp($type, "Inbox")==0){
					$userID=$row->userID;
					$fromUserID=$row->fromUserID;
				}else {
					$userID=$row->fromUserID;
					$fromUserID=$row->userID;
				}
				$createDate=$row->createDate;
				$content=$row->content;
				$status=$row->status;
				
				$userarray=$this->users_model->get_user_by_id($userID);
				if($userarray<>null)
					$username=$userarray[0]->username;
				$userarray=$this->users_model->get_user_by_id($fromUserID);
				if($userarray<>null)
					$fromusername=$userarray[0]->username;
				$email=$this->userEmail->getUserEmailByUserID($fromUserID);
				$fromEmail="";
				if($email<>null)
					$fromEmail=$email["email"];
				$readFlag=$row->readflag;
				$ID=$row->ID;
					
					$arrayMessage=array($ID => array("userID"=>$userID,
								"fromUserID"=>$fromUserID,
								"username" => $username,
								"fromusername"=>$fromusername,
								"fromEmail"=>$fromEmail,
								"createDate"=>$createDate,
								"status" =>$status,
								"content"=>$content,
								"readflag"=>$readFlag,
								"unreadCount"=>$unreadCount,
								"type"=>$row->msgType));
						if($result==null)
							$result=$arrayMessage;
							else
								$result=$result + $arrayMessage;
			}
		}
		return $result;
	}
	
	function cmp1($a, $b)
	{
		if($a["createDate"] > $b["createDate"])
			return -1;
		else 
			return 1;
	}
	function cmp2($a, $b)
	{
		if($a["createDate"] > $b["createDate"])
			return 1;
		else 
			return -1;
	}
	public function mapReqeustPostToView($inbox, $type="buyer", $type2="DirectSend")
	{
		$result=array();
		$lang_label=$this->nativesession->get("language");
		if($inbox!=null){
		foreach($inbox as $row)
		{
			$postID=$row->postID;
			$messageID=$row->postID."-".$row->userID;
			//$userID=$row->userID;
			$fuserID=$row->userID;
			$createDate=$row->createDate;
			$expiryDate=$row->expriyDate;
			$statusRP=$row->status;
			$status="";
			$name="";
			$previewTitle="";
			$previewDesc="";
			$price=0;
			$userID=0;
			$enableMarkSoldBtn=false;
			$visibleBuyerComment=false;
			$soldToUserID=0;
			$postInfo=$this->post_model->getPostByPostID($postID);
			if($postInfo<>null)
			{
				if ($lang_label<>"english")
					$name=$postInfo[0]->itemNameCH;
				else
					$name=$postInfo[0]->itemName;
				$soldToUserID=$postInfo[0]->soldToUserID;
				$enableMarkSoldBtn=$postInfo[0]->sellerRating==null;
				$visibleBuyerComment=$postInfo[0]->sellerRating<>null &&
				$postInfo[0]->buyerRating==null;
				$previewTitle=$name;
				$previewDesc=$postInfo[0]->description;
				$price=$postInfo[0]->currency." ".$postInfo[0]->itemPrice;
				$userID=$postInfo[0]->userID;
				$status=$postInfo[0]->status;
			}
			$userarray=$this->users_model->get_user_by_id($userID);
			$reply="";
			$from="";
			$sellerEmail="";
			if($userarray<>null)
			{
				$reply=$userarray[0]->username;
				$from=$reply;
			}
			$email="";
			$userInfo;
			if(strcmp($type,"buyer")==0){
				$email=$this->userEmail->getUserEmailByUserID($userID);
				$userInfo=$this->userInfo->getUserInfoByUserID($userID);
			}
			else {
				$email=$this->userEmail->getUserEmailByUserID($fuserID);
				$userInfo=$this->userInfo->getUserInfoByUserID($fuserID);
			}
			$hidetelno=true;
			$telno="";
			$showWeChatID=false;
			$weChatID="";
			$showWebSite=false;
			$webSiteAddr="";
			if($userInfo<>null){
				$hidetelno=$userInfo["hidetelno"];
				$telno=$userInfo["telNo"];
				$showWeChatID=$userInfo['showWeChatID'];
				$weChatID=$userInfo['weChatID'];
				$showWebSite=$userInfo['showWebSite'];
				$webSiteAddr=$userInfo['webSiteAddr'];
			}
			if($email<>null){
				$sellerEmail=$email["email"];
			}
			$fUserarray=$this->users_model->get_user_by_id($fuserID);
			if($fUserarray<>null)
			{
				$from=$fUserarray[0]->username;
			}
			
			$pic=$this->picture_model->get_picture_by_postID($postID);
			$imagePath="";
			$checkImgFile="";
			$picCount=count($pic);
			if($pic<>null)
			{
				$checkImgFile=$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
				$imagePath=base_url().$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
			}
			$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
			
			$itemStatus=$status;
			$dStart=date_create('2015-09-20');
			$dDiff = $dStart->diff(date_create($expiryDate));
			$NoOfDaysPending=$dDiff->days;
			$NoOfDaysb4ExpiryContact=$dDiff->days;
			$arrayMessage=array($messageID => array("postID"=>$postID,
					"messageID"=>$messageID,
					"userID"=>$userID,
					"fuserID"=>$fuserID,
					"createDate"=>$createDate,
					"reply"=>$reply,
					"previewTitle"=>$previewTitle,
					"previewDesc"=>$previewDesc,
					"price"=>$price,
					"enableMarkSoldBtn"=>$enableMarkSoldBtn,
					"visibleBuyerComment"=>$visibleBuyerComment,
					"soldToUserID"=>$soldToUserID,
						"imagePath"=>$imagePath,
					"checkImgFile"=> $checkImgFile,
					"viewItemPath"=>$viewItemPath,
					"itemStatus"=>$itemStatus,
					"statusRP" =>$statusRP,
					"from"=>$from,
					"recordType" => $type2,
					"NoOfDaysPending"=>$NoOfDaysPending,
					"NoOfDaysb4ExpiryContact"=>$NoOfDaysb4ExpiryContact,
					"sellerEmail" => $sellerEmail,
					"replyUserID"=>$userID,
					"picCount"=>$picCount,
					"hidetelno"=>$hidetelno,
					"telno"=>$telno,
					"showWeChatID"=>$showWeChatID,
					"weChatID"=>$weChatID,
					"showWebSite"=>$showWebSite,
					"webSiteAddr" =>$webSiteAddr));
			//if($result==null || count($result)==0)
			//	array_push($result,$arrayMessage);
			//else
				$result=$result + $arrayMessage;
		}
		}
		return $result;
	}
	
	public function mapReqeustPostToViewOfArray($inbox, $type="buyer", $type2="DirectSend")
	{
		$result=array();
		$lang_label=$this->nativesession->get("language");
		if($inbox!=null){
			foreach($inbox as $row)
			{
				$postID=$row["postID"];
				$messageID=$row["postID"]."-".$row["userID"];
				//$userID=$row->userID;
				$fuserID=$row["userID"];
				$createDate=$row["createDate"];
				$expiryDate=$row["expriyDate"];
				$statusRP=$row["status"];
				$status="";
				$name="";
				$previewTitle="";
				$previewDesc="";
				$price=0;
				$userID=0;
				$enableMarkSoldBtn=false;
				$visibleBuyerComment=false;
				$soldToUserID=0;
				$postInfo=$this->post_model->getPostByPostID($postID);
				if($postInfo<>null)
				{
					if ($lang_label<>"english")
						$name=$postInfo[0]->itemNameCH;
					else
						$name=$postInfo[0]->itemName;
					$soldToUserID=$postInfo[0]->soldToUserID;
					$enableMarkSoldBtn=$postInfo[0]->sellerRating==null;
					$visibleBuyerComment=$postInfo[0]->sellerRating<>null &&
					$postInfo[0]->buyerRating==null;
					$previewTitle=$name;
					$previewDesc=$postInfo[0]->description;
					$price=$postInfo[0]->currency." ".$postInfo[0]->itemPrice;
					$userID=$postInfo[0]->userID;
					$status=$postInfo[0]->status;
				}
				$userarray=$this->users_model->get_user_by_id($userID);
				$reply="";
				$from="";
				$sellerEmail="";
				if($userarray<>null)
				{
					$reply=$userarray[0]->username;
					$from=$reply;
				}
				$email="";
				$userInfo;
				if(strcmp($type,"buyer")==0){
					$email=$this->userEmail->getUserEmailByUserID($userID);
					$userInfo=$this->userInfo->getUserInfoByUserID($userID);
				}
				else{
					$email=$this->userEmail->getUserEmailByUserID($fuserID);
					$userInfo=$this->userInfo->getUserInfoByUserID($fuserID);
				}
				$hidetelno=true;
				$telno="";
				$showWeChatID=false;
				$weChatID="";
				$showWebSite=false;
				$webSiteAddr="";
				if($userInfo<>null){
					$hidetelno=$userInfo["hidetelno"];
					$telno=$userInfo["telNo"];
					$showWeChatID=$userInfo['showWeChatID'];
					$weChatID=$userInfo['weChatID'];
					$showWebSite=$userInfo['showWebSite'];
					$webSiteAddr=$userInfo['webSiteAddr'];
				}
				if($email<>null){
					$sellerEmail=$email["email"];
				}
				$fUserarray=$this->users_model->get_user_by_id($fuserID);
				if($fUserarray<>null)
				{
					$from=$fUserarray[0]->username;
				}
					
				$pic=$this->picture_model->get_picture_by_postID($postID);
				$imagePath="";
				$checkImgFile="";
				$picCount=count($pic);
				if($pic<>null)
				{
					$checkImgFile=$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
					$imagePath=base_url().$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
				}
				$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
			
				$itemStatus=$status;
				$dStart=date_create('2015-09-20');
				$dDiff = $dStart->diff(date_create($expiryDate));
				$NoOfDaysPending=$dDiff->days;
				$NoOfDaysb4ExpiryContact=$dDiff->days;
				$arrayMessage=array($messageID => array("postID"=>$postID,
						"messageID"=>$messageID,
						"userID"=>$userID,
						"fuserID"=>$fuserID,
						"createDate"=>$createDate,
						"reply"=>$from,
						"previewTitle"=>$previewTitle,
						"previewDesc"=>$previewDesc,
						"price"=>$price,
						"enableMarkSoldBtn"=>$enableMarkSoldBtn,
						"visibleBuyerComment"=>$visibleBuyerComment,
						"soldToUserID"=>$soldToUserID,
						"imagePath"=>$imagePath,
						"checkImgFile"=> $checkImgFile,
						"viewItemPath"=>$viewItemPath,
						"itemStatus"=>$itemStatus,
						"statusRP" =>$statusRP,
						"from"=>$reply,
						"recordType" => $type2,
						"NoOfDaysPending"=>$NoOfDaysPending,
						"NoOfDaysb4ExpiryContact"=>$NoOfDaysb4ExpiryContact,
						"sellerEmail" => $sellerEmail,
						"replyUserID"=>$userID,
						"picCount"=>$picCount,
						"hidetelno"=>$hidetelno,
						"telno"=>$telno,
						"showWeChatID"=>$showWeChatID,
						"weChatID"=>$weChatID,
						"showWebSite"=>$showWebSite,
						"webSiteAddr" =>$webSiteAddr));
				
				if($result==null)
					$result=$arrayMessage;
				else
					$result=$result + $arrayMessage;
			}
		}
		return $result;
	}
	
	public function mapTradeCommentToView($inbox){
		$result=array();
		$lang_label=$this->nativesession->get("language");
		foreach($inbox as $row)
		{
			$postID=$row->postID;
			$commentID=$row->ID;
			$buyerID=$row->soldToUserID;
			$createDate=$row->createDate;
			
			$postInfo=$this->post_model->getPostByPostID($postID);
			$userarray=$this->users_model->get_user_by_id($buyerID);
				
			$reply="";
			$from="";
			if($userarray<>null)
			{
				$reply=$userarray[0]->username;
				$from=$reply;
			}
			$name="";
			$preview="";
			$price=0;
			if ($lang_label<>"english")
				$name=$postInfo[0]->itemNameCH;
			else
				$name=$postInfo[0]->itemName;
		
			$previewTitle=$name;
			$previewDesc=$postInfo[0]->description;
			$price=$postInfo[0]->currency." ".$postInfo[0]->itemPrice;
			$preview="";
			$sellerUserName="";
			$enableMarkSoldBtn=false;
			$sellerInfo=$this->users_model->get_user_by_id($postInfo[0]->userID);
			if($sellerInfo!=null && count($sellerInfo)>0)
				$sellerUserName=$sellerInfo[0]->username;
			if(strcmp($preview, "")==0)
				$preview=$preview."Seller: ".$sellerUserName;
			else
				$preview=$preview."<br/><br/>Seller: ".$sellerUserName;
			if($row->sellerRating!=0 && ($row->buyerRating==0 || $row->buyerRating==null)
					&& strcmp($row->status,"A")==0){
				$enableMarkSoldBtn=true;
			}
			if($row->sellerRating!=0 && (strcmp($row->status,"A")==0 || strcmp($row->status,"C")==0)){
				$preview=$preview."<br/>  Seller Comment:  (". $this->getRating($row->sellerRating).")";
				$preview=$preview." ".$row->sellerComment;
			}
			if($row->buyerRating!=0 && strcmp($row->status,"A")==0){
				$preview=$preview."<br/>  Buyer Comment: (".$this-> getRating($row->buyerRating).")";
				$preview=$preview." ".$row->buyerComment;
			}
				$pic=$this->picture_model->get_picture_by_postID($postID);
			$imagePath="";
			$checkImgFile="";
			
			$picCount=count($pic);
			if($pic<>null)
			{
				$checkImgFile=$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
				
				$imagePath=base_url().$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
			}
			$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
			
			$itemStatus='OPEN';
			$NoOfDaysPending=10;
			$NoOfDaysb4ExpiryContact=10;
			//var_dump($soldUserList);
			$arrayMessage=array($commentID => array("postID"=>$postID,
					"commentID"=>$commentID,
					"buyerID"=>$buyerID,
					"sellerID"=>$postInfo[0]->userID,
					"createDate"=>$createDate,
					"reply"=>$reply,
					"preview"=>$preview,
					"previewTitle"=>$previewTitle,
					"previewDesc"=>$previewDesc,
					"price"=>$price,
					"imagePath"=>$imagePath,
					"checkImgFile"=>$checkImgFile,
					"viewItemPath"=>$viewItemPath,
					"itemStatus"=>$itemStatus,
					"from"=>$from,
					"enableMarkSoldBtn"=> $enableMarkSoldBtn,
						"picCount"=>$picCount));
				
			if($result==null)
				$result=$arrayMessage;
			else
				$result=$result + $arrayMessage;
			}
			return $result;
	}
	public function getPostStatus($status, $enableRepostBtn){
		if(strcmp($status,"U")==0)
			return "Unverified";
		else if(strcmp($status,"R")==0)
			return "Rejected";
		else if(strcmp($status,"D")==0)
			return "Closed";
		else if($enableRepostBtn)
			return "Expired";
		else if(strcmp($status, "A")==0)
			return "Open";
		
		else
			return "";	
	}
	public function mapPostToView($inbox)
	{
		$result=array();
		$lang_label=$this->nativesession->get("language");
		foreach($inbox as $row)
		{
			$postID=$row->postID;
			$messageID=$row->postID;
			$userID=$row->userID;
			$fuserID=$row->userID;
			$createDate=$row->createDate;
			$userarray=$this->users_model->get_user_by_id($userID);
			$reply="";
			$from="";
			if($userarray<>null)
			{
				$reply=$userarray[0]->username;
				$from=$reply;
			}
			$name="";
			$preview="";
			$price=0;
			if ($lang_label<>"english")
				$name=$row->itemNameCH;
			else
				$name=$row->itemName;
			$rejectReason=$row->rejectReason;
			$rejectSpecifiedReason=$row->rejectSpecifiedReason;
			$preview="";
			$previewTitle=$name;
			$previewDesc=$row->description;
			$price=$row->currency." ".$row->itemPrice;
			$enableMarkSoldBtn=false;
			$visibleBuyerComment=false;
			$soldToUserID=0;
			$soldToUserName="";
			$soldUserList=$this->messages_model->getSoldUserList($postID);
			$postInfo=$this->post_model->getPostByPostID($postID);
			$postUserID=$postInfo[0]->userID;
			//$commentInfo=$this->tradecomments_model->getTradeCommentsbyPostID($postID);	
			$preview="";
// 			if($commentInfo<>null && count($commentInfo)>0)
// 			{
// 				foreach($commentInfo as $comment){
				
// 					$soldToUserID=$comment->soldToUserID;
// 					$soldToUser=$this->users_model->get_user_by_id($soldToUserID);
// 					$seller=$this->users_model->get_user_by_id($postInfo[0]->userID);
// 					if($soldToUser!=null && count($soldToUser)>0)
// 					$soldToUserName=$soldToUser[0]->username;
// 					if(strcmp($preview, "")==0)
// 						$preview=$preview."Sold to: ".$soldToUserName;
// 					else
// 							$preview=$preview."<br/><br/>Sold to: ".$soldToUserName;
// 					//$preview=$preview."<br/>Seller: ".$seller[0]->username;
// 						if($comment->sellerRating!=0 && (strcmp($comment->status,"A")==0 || strcmp($comment->status,"C")==0)){
// 						$preview=$preview."<br/>  Seller Comment:  (". $this->getRating($comment->sellerRating).")";
// 						$preview=$preview." ".$comment->sellerComment;
// 						}
// 						if($comment->buyerRating!=0 && (strcmp($comment->status,"A")==0 || strcmp($comment->status,"C")==0)){
// 							$preview=$preview."<br/>  Buyer Comment: (".$this-> getRating($comment->buyerRating).")";
// 							$preview=$preview." ".$comment->buyerComment;
// 						}
// 						//$enableMarkSoldBtn=$comment->sellerRating==0;
// 						$visibleBuyerComment=$comment->sellerRating!=0 &&
// 						($comment->buyerRating==null ||$comment->buyerRating==0) ;
// 				}
// 			}else{
// 				// set enable mark sold if it has records in messages from buyer
				
// 			}
			
// 			$itemComments=$this->itemcomments_model->getItemCommentsbyPostID($postID);
// 			if($itemComments<> null && count($itemComments)>0){
// 				foreach($itemComments as $comment){
// 					$buyerInfo=$this->users_model->get_user_by_id($comment->usercommentID);
// 					if($buyerInfo!=null && count($buyerInfo)>0){
// 						$buyerUserName=$buyerInfo[0]->username;
// 						if(strcmp($preview, "")==0)
// 							$preview=$preview."Comment user: ".$buyerUserName;
// 						else
// 							$preview=$preview."<br/><br/>Comment user: ".$buyerUserName;
						
// 						$preview=$preview."<br/>".$comment->comments;
						
// 						$itemChildComments=$this->itemcomments_model->getItemCommentsbyPostIDParentID($postID, $comment->ID);
// 						if($itemChildComments<> null && count($itemChildComments)>0){
// 							foreach($itemChildComments as $childComment){
// 								$buyerChildInfo=$this->users_model->get_user_by_id($childComment->usercommentID);
// 								if($buyerChildInfo!=null && count($buyerChildInfo)>0){
// 									$buyerUserName=$buyerChildInfo[0]->username;
// 									if(strcmp($preview, "")==0)
// 										$preview=$preview."--Reply Comment user: ".$buyerUserName;
// 									else
// 										$preview=$preview."<br/><br/>--Reply Comment user: ".$buyerUserName;
								
// 									$preview=$preview."<br/>----".$childComment->comments;
// 							}
// 						}
						
						
						
// 					}
// 				}
// 			}
// 				if(strcmp($preview, "")!=0)
// 					$preview=$preview."<br/>";
						
// 			}
			
			if($soldUserList<>null && count($soldUserList)>0  && $postInfo[0]->remainQty>0)
				$enableMarkSoldBtn=true;
			else 
				$enableMarkSoldBtn=false;
			
			
			$pic=$this->picture_model->get_picture_by_postID($postID);
			$imagePath="";
			$picCount=count($pic);
			$checkImgFile="";
			if($pic<>null)
			{
				$checkImgFile=$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
				$imagePath=base_url().$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
			}
			$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
			
			$itemStatus='OPEN';
			$NoOfDaysPending=10;
			$NoOfDaysb4ExpiryContact=10;
			
			$nextDate=$this->addDayswithdate($postInfo[0]->expriyDate, REPOSTEXPIRYDAYS);
			$nextexpirydate="Next expiry date of this post is ".$nextDate;
			$enableRepostBtn=false;
			//$today = date("Y-m-d");
			//if($postInfo[0]->expriyDate<$today and strcmp($row->status,"D")!=0)
			//	$enableRepostBtn=true;
			$status=$this->getPostStatus($row->status, $enableRepostBtn);
					
			//var_dump($soldUserList);
			$arrayMessage=array($messageID => array("postID"=>$postID,
					"messageID"=>$messageID,
					"userID"=>$userID,
					"fuserID"=>$fuserID,
					"postUserID"=>$postUserID,
					"createDate"=>$createDate,
					"reply"=>$reply,
					"nextexpirydate"=>$nextexpirydate,
					"preview"=>$preview,
					"previewTitle"=>$previewTitle,
					"previewDesc"=>$previewDesc,
					"price"=>$price,
					"imagePath"=>$imagePath,
					"checkImgFile"=>$checkImgFile,
					"viewItemPath"=>$viewItemPath,
					"itemStatus"=>$itemStatus,
					"from"=>$from,
					"status"=>$status,
					"soldUsers"=>$soldUserList,
					"enableMarkSoldBtn"=>$enableMarkSoldBtn,
					"enableRepostBtn"=>$enableRepostBtn,
					"visibleBuyerComment"=>$visibleBuyerComment,
					"soldToUserID"=>$soldToUserID,
					"soldToUserName"=>$soldToUserName, 
					"rejectReason" => $rejectReason,
					"rejectSpecifiedReason" => $rejectSpecifiedReason,
					"NoOfDaysPending"=>$NoOfDaysPending,
					"NoOfDaysb4ExpiryContact"=>$NoOfDaysb4ExpiryContact,
					"picCount"=>$picCount));
			
			//if($result==null)
			//	array_push($result,$arrayMessage);
			//else
				$result=$result + $arrayMessage;
		}
			
		return $result;
	}
	function getRating($rating){
		if($rating==1)return "Good";
		else if($rating==2)return "Bad";
		else if($rating==3)return "Average";
		else
			return "";
	}
	function mapInBoxToView($inbox, $type)
	{
		$result=array();
		$lang_label=$this->nativesession->get("language");
		foreach($inbox as $row)
		{
			$postID=$row->postID;
			$messageID=$row->messageID;
			$commentID=$row->commentID;
			$userID=$row->userID;
			$fuserID=$row->fUserID;
			$createDate=$row->createDate;
			$readflag=$row->readflag;
			//$messageIOType=$row->messageIOType;
			$userarray=$this->users_model->get_user_by_id($userID);
			$reply="";
			$from="";
			$replyID=0;
			$fromID=0;
			if($userarray<>null)
			{
				$reply=$userarray[0]->username;
				$from=$reply;
				$replyID=$userID;
				$fromID=$replyID;
			}
			$fuserarray=$this->users_model->get_user_by_id($fuserID);
			if($fuserarray<>null){
				$from=$fuserarray[0]->username;
				$fromID=$fuserID;
			}
			if(strcmp($row->status,"R")==0 || strcmp($row->status,"C")==0){
				$temp=$from;
				$from=$reply;
				$reply=$temp;
				$tempID=$fromID;
				$fromID=$replyID;
				$replyID=$tempID;
			}
			
			$userInfo=$this->nativesession->get("user");
 			if(!empty($userInfo)){
 				if(strcmp($type,"Inbox")==0){
 					if(strcmp($fromID,$userInfo["userID"])==0){
 						continue;
 					}
 				}
 				else {
 					if(strcmp($replyID,$userInfo["userID"])==0){
 						continue;
 					}
 				}
 			}
				

// 			if(strcmp($row->status,"C")==0){
// 				$userInfo=$this->nativesession->get("user");
// 				if(!empty($userInfo)){
// 					if(strcmp($from,$userInfo["userID"])==0){
// 						$from
// 					}
// 				}
// 			}
			
			$name="";
			$preview="";
			$previewTitle="";
			$previewDesc="";
			$price=0;
				$enableMarkSoldBtn=false;
			$visibleBuyerComment=false;
			$soldToUserID=$fromID;
			$soldToUserName=$from;
			$soldUserList=$this->messages_model->getSoldUserList($postID);
		
			$postInfo=$this->post_model->getPostByPostID($postID);
			$postUserID=$postInfo[0]->userID;
			if($postInfo<>null)
			{
				if ($lang_label<>"english")
					$name=$postInfo[0]->itemNameCH;
				else
					$name=$postInfo[0]->itemName;
				$previewTitle=$name;
				$previewDesc=$postInfo[0]->description;
				$price=$postInfo[0]->currency." ".$postInfo[0]->itemPrice;
			}
			if($commentID!=0){
				$tradecomment=$this->tradecomments_model->getTradeComments($commentID);
				$soldToUserID=$tradecomment[0]->soldToUserID;
				if(strcmp($type, "Inbox")!=0)
					$enableMarkSoldBtn=$tradecomment[0]->sellerRating!=0 &&
					($tradecomment[0]->buyerRating==null || $tradecomment[0]->buyerRating==0);
				else 
					$enableMarkSoldBtn=$tradecomment[0]->sellerRating==0;
				$visibleBuyerComment=$tradecomment[0]->sellerRating!=0 &&
				($tradecomment[0]->buyerRating==null ||$tradecomment[0]->buyerRating==0) ;
			}else{
				$isLastMessage=$this->messages_model->isLastMessage($row, $type);
				if($isLastMessage)
					$enableMarkSoldBtn=true;			
			}
// 			$messageInfo=$this->messages_model->getMessageByMessageID($messageID);
// 			if($messageInfo<>null){
// 				$preview=$messageInfo[0]->content;
// 			}
			$preview=$row->content;
			
			$pic=$this->picture_model->get_picture_by_postID($postID);
			$imagePath="";
			$checkImgFile="";
			$picCount=count($pic);
			if($pic<>null)
			{
				$checkImgFile=$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
				$imagePath=base_url().$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
			}
			$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
			
			$itemStatus='OPEN';
			$NoOfDaysPending=10;
			$NoOfDaysb4ExpiryContact=10;
			$arrayMessage=array($messageID => array("postID"=>$postID,
					"messageID"=>$messageID,
					"commentID" => $commentID,
					"userID"=>$userID,
					"fuserID"=>$fuserID,
					"createDate"=>$createDate,
					"from"=>$from,
					"soldUsers"=>$soldUserList,
					"enableMarkSoldBtn"=>$enableMarkSoldBtn,
					"visibleBuyerComment"=>$visibleBuyerComment,
					"soldToUserID"=>$soldToUserID,
					"soldToUserName"=>$soldToUserName,
					"reply"=>$reply,
					"preview"=>$preview,
					"previewTitle"=>$previewTitle,
					"previewDesc"=>$previewDesc,
					"price"=>$price,
					"imagePath"=>$imagePath,
					"checkImgFile"=> $checkImgFile,
					"viewItemPath"=>$viewItemPath,
					"itemStatus"=>$itemStatus,
					"status"=> $row->status,
					"readflag"=>$readflag,
					"postUserID" =>$postUserID,
					"NoOfDaysPending"=>$NoOfDaysPending,
					"NoOfDaysb4ExpiryContact"=>$NoOfDaysb4ExpiryContact,
					"picCount"=>$picCount));
			if($result==null)
				$result=$arrayMessage;
			else
				$result=$result + $arrayMessage;
		}
			
		return $result;
	}
	public function getPendingPost($pageNum)
		{
			$result=null;
			$lang_label=$this->nativesession->get("language");
		    $pendingPost=$this->messages_model->getPendingPost($pageNum);
			foreach($pendingPost as $row)
			{
				$postID=$row->postID;
				$messageID=$row->messageID;
				$userID=$row->userID;
				$fuserID=$row->fUserID;
				$createDate=$row->createDate;
				$userarray=$this->users_model->get_user_by_id($userID);
				$reply="";
				$from="";
				if($userarray<>null)
				{
					$reply=$userarray[0]->username;
					$from=$reply;
				}
				$name="";
				$preview="";
				$price=0;
				$enableMarkSoldBtn=false;
				$visibleBuyerComment=false;
				$soldToUserID=0;
				$postInfo=$this->post_model->getPostByPostID($postID);
				if($postInfo<>null)
				{
					if ($lang_label<>"english")
						$name=$postInfo[0]->itemNameCH;
					else 
						$name=$postInfo[0]->itemName;
					$soldToUserID=$postInfo[0]->soldToUserID;
					$enableMarkSoldBtn=$postInfo[0]->sellerRating==null;
					$visibleBuyerComment=$postInfo[0]->sellerRating<>null &&
					$postInfo[0]->buyerRating==null;
					
					$preview=$name." ".$postInfo[0]->description;
					
					
					$price=$postInfo[0]->currency." ".$postInfo[0]->itemPrice;
				}
				$pic=$this->picture_model->get_picture_by_postID($postID);
				$imagePath="";
				if($pic<>null)
				{
					$imagePath=base_url().$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
				}
				$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
			
	            $itemStatus='OPEN';	
              	$NoOfDaysPending=10;  		
              	$NoOfDaysb4ExpiryContact=10;	
				$arrayMessage=array($messageID => array("postID"=>$postID,
											"messageID"=>$messageID,
											"userID"=>$userID,
											"fuserID"=>$fuserID,
											"createDate"=>$createDate,
											"reply"=>$reply,
											"preview"=>$preview,
											"price"=>$price,
											"imagePath"=>$imagePath,
											"viewItemPath"=>$viewItemPath,
											"itemStatus"=>$itemStatus,
											"from"=>$from,
											"enableMarkSoldBtn"=>$enableMarkSoldBtn,
											"visibleBuyerComment"=>$visibleBuyerComment,
											"soldToUserID"=>$soldToUserID,
						
											"NoOfDaysPending"=>$NoOfDaysPending,
											"NoOfDaysb4ExpiryContact"=>$NoOfDaysb4ExpiryContact));
				if($result==null)
					$result=$arrayMessage;
				else 
					$result=$result + $arrayMessage;
			}
			
			return $result;
		}
	
	public function profilePage(){
		$data["previousCurrent_url"]=urlencode(current_url());
		
		$data["MyAds"]=$this->lang->line("MyAds");
		$data["PersonalHome"]=$this->lang->line("PersonalHome");
		$data["FavoriteAds"]=$this->lang->line("FavoriteAds");
		$data["SavedSearch"]=$this->lang->line("SavedSearch");
		$data["ArchivedAds"]=$this->lang->line("ArchivedAds");
		$data["PendingApproval"]=$this->lang->line("PendingApproval");
		$data["PaymentHistory"]=$this->lang->line("PaymentHistory");
		$data["PostFreeAds"]=$this->lang->line("PostFreeAds");
		$data["Inbox"]=$this->lang->line("Inbox");
		$data["ApproveRequest"]=$this->lang->line("ApproveRequest");
		$data["EditProfile"]=$this->lang->line("EditProfile");
		$data["SavedItems"]=$this->lang->line("SavedItems");
		$data["PendingRequest"]=$this->lang->line("PendingRequest");
		$data["ApprovedRequest"]=$this->lang->line("ApprovedRequest");
		$data["TerminateAccount"]=$this->lang->line("TerminateAccount");
		$data["CloseAccount"]=$this->lang->line("CloseAccount");
		$data["OutgoingMsgTitle"]=$this->lang->line("OutgoingMsgTitle");
		$data["AccountTabName"]=$this->lang->line("AccountTabName");
		
		
	$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
            $data["About_us"] = $this->lang->line("About_us");
            $data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
            $data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
            $data["Contact_us"] = $this->lang->line("Contact_us");
            //log_message('debug', 'Contact Us words is: '.$data["Contact_us"]);
            $data["FAQ"] = $this->lang->line("FAQ");
            $data["Index_Footer1"] = $this->lang->line("Index_Footer1");
            $data["Call_Now"] = $this->lang->line("Call_Now");
            $data["Tel"] = $this->lang->line("Tel");
          
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		$user1=$this->nativesession->get("user");
		$userID=$user1["userID"];
		$data["userID"]=$userID;
		if(strcmp($user1["photostatus"],"A")==0)
			$data["userPhotoPath"]=base_url().$user1['thumbnailPath'].'/'.$user1['thumbnailName'];
		else
			$data["userPhotoPath"]=base_url()."images/user.jpg";
		
		
		$userInfo=$this->userInfo->getUserInfoByUserID($userID);
		$address=$this->address->getAddressByUserID($userID);
		$email=$this->userEmail->getUserEmailByUserID($userID);
		$data["userName"]=$user1["username"];
		
		$data["lastName"]="";
		$data["firstName"]="";
		$data["country"]="";
		$data["language"]="";
		$data["phoneNo"]="";
		$data["telNo"]="";
		$data["checkBox1"]=false;
		$data["checkBox2"]=false;
		$data["hidetelno"]=false;
		
		if(isset($userInfo) && !empty($userInfo) && $userInfo<> null)
		{
		$data["lastName"]=$userInfo["lastName"];
		$data["firstName"]=$userInfo["firstName"];
		$data["gender"]=$userInfo["gender"];
		$data["country"]=$userInfo["country"];
		$data["language"]=$userInfo["language"];
		$data["phoneNo"]=$userInfo["phoneNo"];
		$data["telNo"]=$userInfo["telNo"];
		$data["documentType"]=$userInfo["documentType"];
		$data["checkBox1"]=$userInfo["checkBox1"];
		$data["checkBox2"]=$userInfo["checkBox2"];
		
		}
		if(isset($email) && !empty($email) && $email<> null)
		{
			$data["email"]=$email["email"];
		}
		
		if($address<>null)
		{
		$data["country"]=$address["country"];
		$data["area"]=$address["area"];
		$data["district"]=$address["district"];
		$data["street"]=$address["street"];
		$data["building"]=$address["building"];
		$data["roomNo"]=$address["roomNo"];
		$data["postalCode"]=$address["postalCode"];
		}
      
	 $data["lang_label"]=$this->nativesession->get("language");
        //  $user = $this->nativesession->get('user');
		//$userEmail = $this->userEmail->getUserEmailByUserID($user['userID']);
		//$userInfo = $this->userInfo->getUserInfoByUserID($user['userID']);
		//$address = $this->address->getAddressByUserID($user['userID']);
		//$data = array_merge($user, $userEmail);
		//$data = array_merge($data, $userInfo);
		//$data = array_merge($data, $address);
		$data["activeNav"]=1;
		$data["pageNum"]=1;
		$pageNum=1;
			$date=new DateTime();
	       $data["lastLoginTime"]=$date->format('Y-m-d H:i:s');
	       $userStat=$this->userstat_model->getUserStat($userID);
			
			$data["inboxMsgCount"]=0;
			$data["approveMsgCount"]=0;
			$data["myAdsCount"]=0;
			$data["savedAdsCount"]=0;
			$data["pendingMsgCount"]=0;
			$data["archivedAdsCount"]=0;
			$data["visitCount"]=0;
			$data["totalMyAdsCount"]=0;
			$data["favoriteAdsCount"]=0;
			$data["outgoingMsgCount"]=0;
			$data["buyAdsCount"]=0;
			$data["directsendhistCount"]=0;
			$data["directsendhistCount1"]=0;
			if(isset($userStat) && !empty($userStat)){
				$data["inboxMsgCount"]=$userStat[0]->inboxMsgCount;
				$data["approveMsgCount"]=$userStat[0]->approveMsgCount;
				$data["myAdsCount"]=$userStat[0]->myAdsCount;
				$data["savedAdsCount"]=$userStat[0]->savedAdsCount;
				$data["pendingMsgCount"]=$userStat[0]->pendingMsgCount;
				$data["archivedAdsCount"]=$userStat[0]->archivedAdsCount;
				$data["visitCount"]=$userStat[0]->visitCount;
				$data["totalMyAdsCount"]=$userStat[0]->totalMyAdsCount;
				$data["favoriteAdsCount"]=$userStat[0]->favoriteAdsCount;
				$data["outgoingMsgCount"]=$userStat[0]->outgoingMsgCount;
				$data["buyAdsCount"]=$userStat[0]->buyAdsCount;
				$data["directsendhistCount"]=$userStat[0]->directsendhistCount;
				$data["directsendhistCount1"]=$userStat[0]->directsendhistCount;
			}
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="class=\"active\"";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($userID)){
				$menuCount=$this->getHeaderCount($userID);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userID); //$menuCount["inboxMsgCount"]; //
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			//----------------------------
// 		$data["NoOfItemCount"]=$this->messages_model->getNoOfItemCountInInbox($userID);
// 			$myList=$this->messages_model->getInBoxByPostUserId($userID, $pageNum);
// 			$data["result"]=$this->mapInBoxToView($myList, "Inbox");
// 			$this->load->view("account-inbox", $data);
			
			$data["NoOfItemCount"]=$this->messages_model->getNoOfItemCountInBuyerMessageByUserID($userID, "Summary", 0);
			$myList=$this->messages_model->getBuyerMessageByUserID($userID, $pageNum, $sortByDate, "Summary", 0);
			$data["result"]=$this->mapInBoxByPostUserIdToView($myList, "All", "Summary");
			$this->load->view('account-message-onlybyuserid', $data);
			//log_message('debug', 'nothing happen.');
	}
	public function updateCheckBox(){
		$user=$this->nativesession->get("user");
		$chk1=false;
		if(isset($_POST["chk1"]))
			$chk1=true;
		$chk2=false;
		if(isset($_POST["chk2"]))
			$chk2=true;
		$userInfo = $this->userInfo->getUserInfoByUserID($user['userID']);
		
// 		$data = $this->input->post();
// 		if(!empty($data['firstName'])){
// 			$userInfo['firstName'] = $data['firstName'];
// 		}
// 		if(!empty($data['lastName'])){
// 			$userInfo['lastName'] = $data['lastName'];
// 		}
// 		if(!empty($data['country'])){
// 			$userInfo['country'] = $data['country'];
// 		}
// 		if(!empty($data['telNo'])){
// 			$userInfo['telNo'] = $data['telNo'];
// 		}
// 		if(isset($_POST['hidetelno']))
// 			$userInfo['hidetelno']=true;
// 		else
// 			$userInfo['hidetelno']=false;
		$userInfo["checkBox1"]=$chk1;
		$userInfo["checkBox2"]=$chk2; 
		$userInfo["userID"]=$user["userID"];
		$rowUpdate=0;
		if(empty($userInfo["userID"])){
		$rowUpdate=$this->userInfo->insertCheckBox($userInfo);
		}
		else{
		$rowUpdate=$this->userInfo->updateCheckBox($userInfo);
		}
		
		try{
		if($rowUpdate==0)
			log_message('error', "update failed in updating user profile references");;
		}catch(Exeception $ex){
			echo $ex->getMessage();
		}
		//----------setup the header menu----------
        $data["menuMyAds"]="";
        $data["menuInbox"]="class=\"active\"";
        $data["menuInboxNum"]="0";
        $data["menuPendingRequest"]="";
        $data["menuPendingRequestNumber"]="0";
        if(isset($user['userID'])){
        	$menuCount=$this->getHeaderCount($user['userID']);
        	$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($user['userID']); //$menuCount["inboxMsgCount"]; //
        	$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
        }
        //----------------------------
				
		$this->getAccountPage(4);
	}
	public function updateProfile(){
			 
			$user=$this->nativesession->get("user");
			$userInfo = $this->userInfo->getUserInfoByUserID($user['userID']);
			
// 		update userInfo Table
		$data = $this->input->post();
		if(!empty($data['firstName'])){
			$userInfo['firstName'] = $data['firstName'];
		}
		if(!empty($data['lastName'])){
			$userInfo['lastName'] = $data['lastName'];
		}
		if(!empty($data['country'])){
			$userInfo['country'] = $data['country'];
		}
		if(!empty($data['telNo'])){
			$userInfo['telNo'] = $data['telNo'];
		}
		if(isset($_POST['hidetelno']))
			$userInfo['hidetelno']=true;
		else
			$userInfo['hidetelno']=false;
		if(!empty($data['descriptionTextarea']))
			$userInfo['introduction']=$data['descriptionTextarea'];
		
			$userInfo['introduction']=nl2br(htmlentities($userInfo['introduction'], ENT_QUOTES, 'UTF-8'));
			
			if ($this->form_validation->run('home/updateProfile') == FALSE)
			{
				$this->getAccountPage(4);
				return;
			}
			
			
			
			if(ExceedDescLength($userInfo['introduction'], DESCLENGTHINNEWPOSTBACKEND)){
				$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
				if(empty($userInfo['introduction']) || strlen(trim($userInfo['introduction']))==0)
					$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
				if(ShortDescLength($userInfo['introduction'], DESCMINLENGTHINNEWPOST))
					$errorMsg=sprintf($this->lang->line("MinDescLength"));
							
				$data["error"]=$errorMsg;
				$data["prevURL"]=$prevURL;
				$data['redirectToWhatPage']="Edit Profile Page";
				$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/4";
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}	
			
			
		if(!empty($data['weChatID']))
			$userInfo['weChatID']=$data['weChatID'];
		if(!empty($data['webSiteAddr']))
			$userInfo['webSiteAddr']=$data['webSiteAddr'];
		if(isset($_POST['showWeChatID']))
			$userInfo['showWeChatID']=true;
		else
			$userInfo['showWeChatID']=false;
		if(isset($_POST['showWebSite']))
			$userInfo['showWebSite']=true;
		else
			$userInfo['showWebSite']=false;
			
			
			
// 			if(isset($_POST['chk1']))
// 				$userInfo['checkBox1']=true;
// 			else
// 				$userInfo['checkBox1']=false;
// 			if(isset($_POST['chk2']))
// 				$userInfo['checkBox2']=true;
// 			else
// 				$userInfo['checkBox2']=false;
				
			$rowUpdate=0;
		if(empty($userInfo["userID"])) {
			$userInfo["userID"]=$user["userID"];
			$userInfo["checkBox1"]=true;
			$userInfo["checkBox2"]=true;
			$this->userInfo->insert($userInfo);
			//$rowUpdate=$this->userInfo->update($userInfo);
		}
		else{
			print_r($userInfo);
			$rowUpdate=$this->userInfo->update($userInfo);
		}
		if($rowUpdate==0)
			log_message('error', "update failed in updating user profile");;
			
		
// 		End of update userInfo Table
		
		
		$address = $this->address->getAddressByUserID($user['userID']);
		log_message('debug', 'call getAddressByUserID');
		if(empty($address)){
			log_message('debug', 'where my address?');
			$address['userID'] = $user['userID'];
			//$address['country'] = $data['country'];
			$address['country'] = "HKG";
// 	    	$address['area'] = $data['area'];
// 	    	$address['district'] = $data['district'];
// 	    	$address['street'] = $data['street'];
// 	    	$address['building'] = $data['building'];
// 	    	$address['roomNo'] = $data['roomNo'];
// 	    	$address['postalCode'] = $data['postalCode'];
	    	$address['createDate'] = date('Y/m/d H:i:s');
	    	$address['default'] = 'Y';
	    	$this->address->insert($address);
		}else{
			
			if(!empty($data['country'])){
				$address['country'] = $data['country'];
			}
			if(!empty($data['area'])){
				$address['area'] = $data['area'];
			}
			if(!empty($data['district'])){
				$address['district'] = $data['district'];
			}
			if(!empty($data['street'])){
				$address['street'] = $data['street'];
			}
			if(!empty($data['building'])){
				$address['building'] = $data['building'];
			}
			if(!empty($data['roomNo'])){
				$address['roomNo'] = $data['roomNo'];
			}
			if(!empty($data['postalCode'])){
				$address['postalCode'] = $data['postalCode'];
			}
			$this->address->update($address);
		}
		// 		End of update Address Table
		
		$userEmail = $this->userEmail->getUserEmailByUserID($user['userID']);
		if(!empty($data['email'])){
			$userEmail['email'] = $data['email'];
		}
		$this->userEmail->update($userEmail);
		//----------setup the header menu----------
		$data["menuMyAds"]="";
		$data["menuInbox"]="class=\"active\"";
		$data["menuInboxNum"]="0";
		$data["menuPendingRequest"]="";
		$data["menuPendingRequestNumber"]="0";
		if(isset($user['userID'])){
			$menuCount=$this->getHeaderCount($user['userID']);
			$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($user['userID']); //$menuCount["inboxMsgCount"]; //
			$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
		}
		//----------------------------
		$this->getAccountPage(4);
	}
	
	public function updatePassword(){
		$user = $this->nativesession->get('user');
		$data = $this->input->post();
		$userPassword['userID'] = $user['userID'];
		$userPassword['password'] = $data['originalPassword'];
		$isValid = $this->userPassword->isValidPassword($userPassword);
		if($isValid){
			
			$email=$this->userEmail->getUserEmailByUserID($user["userID"]);
				
			if($this->sendEmailLog_model->getNoOfCountByUserID($email['userID'], $email["email"])>MAXTIMESSENDEMAIL){
				$errorMsg=sprintf($this->lang->line("HomeExceedMaxTimesSendEmail"),MAXTIMESSENDEMAIL,MAXTIMESMINUTESSENDEMAIL);
				$data["lang_label"]=$this->nativesession->get("language");
				$data["error"]=$errorMsg;
				$this->nativesession->set("lastPageVisited","login");
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
			
				$this->load->view('failedPage', $data);
				return;
			}
			
			
			$userPassword = $this->userPassword->getUserPasswordByUserID($user['userID']);
			$userPassword['password'] = $data['newPassword'];
			$this->userPassword->update($userPassword);
			
			$email=$this->userEmail->getUserEmailByUserID($user["userID"]);
			$msg=$this->mailtemplate_model->SendEmailMsgForChangePassword($user["username"]);
			$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForChangePassword(), "UPDATEPASSWORDSENDEMAIL");
			
			
			$errorMsg="Password Changed Successfully";
			$data['error']= $errorMsg;
			$data['redirectToWhatPage']="Home Page";
			$data['redirectToPHP']=base_url();
			
			$data["lang_label_text"] = $this->lang->line("lang_label_text");
			$data["lang_label"] = $this->nativesession->get("language");
			$data["Home"] = $this->lang->line("Home");
			$data["About_us"] = $this->lang->line("About_us");
			$data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
			$data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
			$data["Contact_us"] = $this->lang->line("Contact_us");
			$data["FAQ"] = $this->lang->line("FAQ");
			$data["Index_Footer1"] = $this->lang->line("Index_Footer1");
			$data["Call_Now"] = $this->lang->line("Call_Now");
			$data["Tel"] = $this->lang->line("Tel");
			
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
			$data["successTile"]=$this->lang->line("successTile");
			$data["failedTitle"]=$this->lang->line("failedTitle");
			$data["goToHomePage"]=$this->lang->line("goToHomePage");
			 
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($user)){
				$menuCount=$this->getHeaderCount($user['userID']);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($user['userID']);
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			//----------------------------
			$this->load->view('successPage', $data);
						
		}else{
			$errorMsg="Incorrect Current Password";
			
			$data['error']= $errorMsg;
			$data["lang_label_text"] = $this->lang->line("lang_label_text");
			$data["lang_label"] = $this->nativesession->get("language");
			$data["Home"] = $this->lang->line("Home");
			$data["About_us"] = $this->lang->line("About_us");
			$data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
			$data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
			$data["Contact_us"] = $this->lang->line("Contact_us");
			$data["FAQ"] = $this->lang->line("FAQ");
			$data["Index_Footer1"] = $this->lang->line("Index_Footer1");
			$data["Call_Now"] = $this->lang->line("Call_Now");
			$data["Tel"] = $this->lang->line("Tel");
			
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
			
			
			$data['redirectToWhatPage']="Account Profile Page";
			$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/9";
			$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
			
		}
	}
	function getPopularLocation($first, $second)
	{
		return $this->location_model->getPopularLocation($first,$second);
	}
	function getPopularParentCategory()
	{
		return $this->category_model->getPopularParentCategory();
		
	}
	function getPopularCategory($first, $second)
	{
		return $this->category_model->getPopularCategory($first, $second);
	}
	
	function getFeatureProduct()
	{
	return $this->post_model->getFeatureProduct();
	}
	
	function getInterestedProduct()
	{
		return $this->post_model->getInterestedProduct();
	}
	
	function getHotProduct()
	{
		return $this->post_model->getHotProduct();
	}
	function getAllCategory()
	{
		$data['result']=null;
		$data['query']=$this->category_model->getParentCategory();
		if (!is_null($data['query'])) {
			foreach($data['query'] as $row)
			{
				$result1=array($row->categoryID => array($row));
				$result2=$this->getChildCategory($row->categoryID);
				if(!is_null($result2))
						if(is_null($data['result']))
							$data['result']=$result1+$result2;
						else
							$data['result']=$data['result']+$result1+$result2;
					else 
					{
						if(is_null($data['result']))
							$data['result']=$result1;
						else
							$data['result']=$data['result']+$result1;
					}
			}
		}
		return $data['result'];
	}
	function getAllLocation()
	{
	$data['resLoc']=null;
		$data['queryLoc']=$this->location_model->getParentLocation();
		if (!is_null($data['queryLoc'])) {
			foreach($data['queryLoc'] as $row)
			{
				$resLoc1=array($row->locationID => array($row));
				$resLoc2=$this->getChildLocation($row->locationID);
				if(!is_null($resLoc2))
						if(is_null($data['resLoc']))
							$data['resLoc']=$resLoc1+$resLoc2;
						else
							$data['resLoc']=$data['resLoc']+$resLoc1+$resLoc2;
					else 
					{
						if(is_null($data['resLoc']))
							$data['resLoc']=$resLoc1;
						else
							$data['resLoc']=$data['resLoc']+$resLoc1;
					}
			}
		}
		return $data['resLoc'];
	}
	
	function getChildLocation($parentID)
	{
		$result=null;
		$data['queryLoc']=$this->location_model->getChildLocation($parentID);
		if(!is_null($data['queryLoc']))
		{
			foreach($data['queryLoc'] as $row)
				{
					$result1=array($row->locationID => array($row));
					$result2=$this->getChildLocation($row->locationID);
					if(!is_null($result2))
						if(is_null($result))
							$result=$result1+$result2;
						else
							$result=$result+$result1+$result2;
					else 
					{
						if(is_null($result))
							$result=$result1;
						else
							$result=$result+$result1;
					}
				}
		}
		else 
		{
			return NULL;			
		}
		return $result;	
	}
	function getChildCategory($parentID)
	{
		$result=null;
		$data['query']=$this->category_model->getChildCategory($parentID);
		if(!is_null($data['query']))
		{
			foreach($data['query'] as $row)
				{
					$result1=array($row->categoryID => array($row));
					$result2=$this->getChildCategory($row->categoryID);
					if(!is_null($result2))
						if(is_null($result))
							$result=$result1+$result2;
						else
							$result=$result+$result1+$result2;
					else 
					{
						if(is_null($result))
							$result=$result1;
						else
							$result=$result+$result1;
					}
				}
		}
		else 
		{
			return NULL;			
		}
		return $result;	
	}
	
	function uploadPhoto($userID, $userName){
		if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
		}else if(isset($_SESSION["previousUrl"])){
			$prevURL=$_SESSION["previousUrl"];
		}
		//----------setup the header menu----------
		$data["menuMyAds"]="";
		$data["menuInbox"]="";
		$data["menuInboxNum"]="0";
		$data["menuPendingRequest"]="";
		$data["menuPendingRequestNumber"]="0";
		if($userID){
			$menuCount=$this->getHeaderCount($userID);
			$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userID);
			$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
		}
		//----------------------------
		
		
		$upload_dir= 'USER_PHOTO';
		
		if (!file_exists($upload_dir)) {
			mkdir($upload_dir, 0777, true);
		}
		//User Upload Folder Name
		$upload_dir = $upload_dir.'/'.$userName;
		if (!file_exists($upload_dir)) {
			mkdir($upload_dir, 0777, true);
		}
		
		$upload_dir_resize=$upload_dir.'/Resize';
		if(!file_exists($upload_dir_resize)){
			mkdir($upload_dir_resize, 0777,true);
		}
		$this->load->library('image_lib');
		
		$imgPath = $upload_dir . '/'.$userName.'_'.(new DateTime())->format('Y-m-d-H-i-s').'_'.$i.'.png';
		$thumb_fileName=$userName.'_'.(new DateTime())->format('Y-m-d-H-i-s').'_thumb_'.$i.'.png';
		$main_fileName=$userName.'_'.(new DateTime())->format('Y-m-d-H-i-s').'_main_'.$i.'.png';
		 
		$config['file_name'] = basename($imgPath);
		$config['upload_path'] = $upload_dir;
		$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
		 
		$this->upload->initialize($config);
		
		ChromePhp::log($upload_dir);
		if ( ! $this->upload->do_upload("avatar"))
		{
			if($this->upload->display_errors()<>'')
			{
				$hasImage=$this->input->post("avatar");
				if(!isset($hasImage) or empty($hasImage))
					continue;
				$error = $this->upload->display_errors();
				$data=array('error'=> $error);
				$data["prevURL"]=base_url();
				$data['redirectToWhatPage']="New Post Page";
				$data['redirectToPHP']=base_url().MY_PATH."newPost";
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
		}
		else
		{
			$this->image_lib->clear();
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config2['new_image'] = $upload_dir_resize.'/'.$thumb_fileName;
			//$config2['file_path']=$upload_dir_resize.'/'.$thumb_fileName;
			$config2['maintain_ratio'] = TRUE;
			//$config2['create_thumb'] = TRUE;
			//$config2['thumb_marker'] = '_thumb';
			$config2['width'] = THUMBNAILSIZEWIDTH;
			$config2['height'] = THUMBNAILSIZEHEIGHT;
			//$this->load->library('image_lib',$config2);
			$this->image_lib->initialize($config2);
			if ( !$this->image_lib->resize()){
				if($this->image_lib->display_errors()<>'')
				{
					$error = $this->image_lib->display_errors();
					$data=array('error'=> $error);
					$data["prevURL"]=base_url();
					$data['redirectToWhatPage']="New Post Page";
					$data['redirectToPHP']=base_url().MY_PATH."newPost";
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
					return;
				}
			}
			else
			{
				$this->image_lib->clear();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config2['new_image'] = $upload_dir_resize.'/'.$main_fileName;
				//$config3['file_path']=$upload_dir_resize.'/'.$main_fileName;
	
				$config2['maintain_ratio'] = TRUE;
				//$config2['create_thumb'] = TRUE;
				//$config2['thumb_marker'] = '_main';
				$config2['width'] = MAINPICSIZEWIDTH;
				$config2['height'] = MAINPICSIZEHEIGHT;
				//$this->load->library('image_lib',$config3);
				$this->image_lib->initialize($config2);
				if ( !$this->image_lib->resize()){
					if($this->image_lib->display_errors()<>'')
					{
						$error = $this->image_lib->display_errors();
						$data=array('error'=> $error);
						$data["prevURL"]=base_url();
						$data['redirectToWhatPage']="New Post Page";
						$data['redirectToPHP']=base_url().MY_PATH."newPost";
						$data["successTile"]=$this->lang->line("successTile");
						$data["failedTitle"]=$this->lang->line("failedTitle");
						$data["goToHomePage"]=$this->lang->line("goToHomePage");
						$this->load->view('failedPage', $data);
						return;
					}
				}
				else
				{
					 
					$imgInfo['userID'] = $userID;
					$imgInfo['picturePath'] = $upload_dir_resize;
					$imgInfo['pictureName'] = $main_fileName;
					$imgInfo['photostatus'] = 'U';
					$imgInfo['thumbnailPath'] = $upload_dir_resize;
					$imgInfo['thumbnailName']  =$thumb_fileName;
					$this->user->updatePhoto($imgInfo);
				}
			}
		}
		$user = $this->user->getUserByUserID($userID);
		$this->nativesession->set("user",$user);
		$this->getAccountPage(4);
	}
	
	public function getHeaderCount($userID){
		$userStat=$this->userstat_model->getUserStat($userID);
		
		$data["inboxMsgCount"]=0;
		$data["approveMsgCount"]=0;
		$data["myAdsCount"]=0;
		$data["savedAdsCount"]=0;
		$data["pendingMsgCount"]=0;
		$data["archivedAdsCount"]=0;
		$data["visitCount"]=0;
		$data["totalMyAdsCount"]=0;
		$data["favoriteAdsCount"]=0;
		$data["outgoingMsgCount"]=0;
		$data["buyAdsCount"]=0;
		$data["directsendhistCount"]=0;
		$data["directsendhistCount1"]=0;
		if(isset($userStat) && !empty($userStat)){
			$data["inboxMsgCount"]=$userStat[0]->inboxMsgCount;
			$data["approveMsgCount"]=$userStat[0]->approveMsgCount;
			$data["myAdsCount"]=$userStat[0]->myAdsCount;
			$data["savedAdsCount"]=$userStat[0]->savedAdsCount;
			$data["pendingMsgCount"]=$userStat[0]->pendingMsgCount;
			$data["archivedAdsCount"]=$userStat[0]->archivedAdsCount;
			$data["visitCount"]=$userStat[0]->visitCount;
			$data["totalMyAdsCount"]=$userStat[0]->totalMyAdsCount;
			$data["favoriteAdsCount"]=$userStat[0]->favoriteAdsCount;
			$data["outgoingMsgCount"]=$userStat[0]->outgoingMsgCount;
			$data["buyAdsCount"]=$userStat[0]->buyAdsCount;
			$data["directsendhistCount"]=$userStat[0]->directsendhistCount;
			$data["directsendhistCount1"]=$userStat[0]->directsendhistCount;
		}
		
		return $data;
	}
	public function updateReadInboxBuyerMessage(){
		$messageID=$_POST["messageID"];
		$pageNum=$_POST["pageNum"];
		$this->messages_model->updateReadInboxBuyerMessageFlag($messageID);
		$data['status'] = 'A';
		$data['class'] = "has-success";
		$data['message'] = '';
		$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
		echo json_encode($data);
		return;
	}
	public function updateReadInbox(){
		$messageID=$_POST["messageID"];
		$pageNum=$_POST["pageNum"];
		$this->messages_model->updateReadInboxFlag($messageID);
		$data['status'] = 'A';
		$data['class'] = "has-success";
		$data['message'] = '';
		$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
		echo json_encode($data);
		return;
		//$this->getAccountPage("1", $pageNum);
	}
	public function insertBuyerMessage($type){
		$user=$this->nativesession->get("user");
			
		$fromUserID="";
		$userID="";
		if(strcmp($type,"Inbox")==0){
			$fromUserID=$user["userID"];
			$userID=$_POST["userID_1"];
		}
		$content=$_POST["message-text_1"];
		
		$content=nl2br(htmlentities($content, ENT_QUOTES, 'UTF-8'));
			
		if(ExceedDescLength($content, DESCLENGTHINNEWPOSTBACKEND)){
			$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
			if(empty($content) || strlen(trim($content))==0)
					$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
			if(ShortDescLength($content, DESCMINLENGTHINNEWPOST))
					$errorMsg=sprintf($this->lang->line("MinDescLength"));
			$data["error"]=$errorMsg;
			$data["prevURL"]=$prevURL;
			$data['redirectToWhatPage']="Account Profile Page";
			if(strcmp($type,"Inbox")==0)
				$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/1";
			else 
				$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/10";
			$data["successTile"]=$this->lang->line("successTile");
			$data["failedTitle"]=$this->lang->line("failedTitle");
			$data["goToHomePage"]=$this->lang->line("goToHomePage");
			$this->load->view('failedPage', $data);
			return;
		}
		
		
		$pageNum=$_POST["pageNum_1"];
		$data["userID"]=$userID;
		$data["fromUserID"]=$fromUserID;
		$data["content"]=$content;
		$data["status"]="U";
		$data["createDate"]=date("Y-m-d H:i:s");
		$data["readflag"]="N";
		$this->buyermessage_model->insert($data);
		$this->admin_model->updateStatByUserID($fromUserID);
		$this->admin_model->updateStatByUserID($userID);
		
		if(strcmp($type,"Inbox")==0)
			$this->getAccountPage("13", $pageNum, "0", 1, $userID);
		else 
			$this->getAccountPage("10", $pageNum);
	}
	public function updateRepost(){
		$postID=$_POST["postID"];
		$pageNum=$_POST["pageNum"];
		$post=$this->post_model->getPostByPostID($postID);
		$data['expriyDate']=$this->addDayswithdate($post[0]->expriyDate, REPOSTEXPIRYDAYS);
		$this->post_model->update($data, $postID);
		
		$this->getAccountPage("3", $pageNum);
	}
	function addDayswithdate($date,$days){
	
		$date = strtotime("+".$days." days", strtotime($date));
		return  date("Y-m-d", $date);
	
	}
	public function check_session(){
		$expired= $this->nativesession->_session_id_expired();
		if($expired){
				echo 0;
				$this->loginPage();
		
			}else{
				echo 1;
			}
		//echo 0; 
		/*
		session_start();
		
		// 5 mins in seconds
		$inactive = $this->nativesession->session_id_ttl;
		if(isset($_session['timeout'])){
			$session_life = time() - $_session['timeout'];
			if($session_life > $inactive)
			{
				session_destroy(); //redirect(base_url().MY_PATH."home/loginPage");
				$this->loginPage();
			}
			else
			{
				$_session['timeout']=time();
			}
		}else{
			$_session['timeout']=time();
		}
		*/
	}
	
	public function updateSendEmailConfig(){
		$userID=$this->input->post("userID",true);
		$result=$this->userInfoSendEmail_model->getSendEmailConfigByUserID($userID);
		$data=array();
		foreach($result as $id=>$value){
			$temp;
			if(strcmp($value["type"],"userID")!=0){
				try{
					if($this->input->post($value["type"], true))
						$value["typeValue"]=1;
					else
						$value["typeValue"]=0;
				}catch(Exception $ex){
					$value["typeValue"]=0;
				}
				$temp=array($value["type"]=>$value["typeValue"]);
			}else{
				$temp=array("userID"=>$value["typeValue"]);
			}
			$data=$data+$temp;			
		}
		$data["userID"]=$userID;
		$this->userInfoSendEmail_model->updateSendEmailConfig($data);
		$this->getAccountPage(12);
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */