<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'ChromePhp.php';

class newPost extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
	    
		$this->load->helper('url');
		//$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helpers('site');
		$this->load->library('upload');
		$this->load->library('image_lib');
		//$this->load->model('users_model');
		$this->load->model('post_model', 'post');
		$this->load->model('picture_model', 'picture');
		$this->load->model('category_model', 'cat');
		$this->load->model('tag_model', 'tag');
		$this->load->model('location_model');
		$this->load->model('userstat_model');
		$this->load->model('messages_model');
		$this->load->model('category_model');
		$this->load->model('admin_model');
		$this->load->helper('language');
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
	
    public function index($userID=0, $username='', $errorMsg='')
	{
		$prevURL=base_url();
		
		if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
		}else if(isset($_SESSION["previousUrl"])){
			$prevURL=$_SESSION["previousUrl"];
		}
		
		if(isset($_GET["category"])){
			$data["categoryID"]=$_GET["category"];
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
	  
		$userInfo=$this->nativesession->get("user");
		if($userID==0 & !empty($userInfo))
			$data["userID"]=$userInfo["userID"];
		else 
			$data["userID"]=$userID;
		if($username=='' & !empty($userInfo))
			$data["username"]=$userInfo["username"];
		else 
			$data["username"]=$username;
		$data["lang_label"]=$this->nativesession->get("language");
		$data['result']=null;
		$data['query']=$this->cat->getParentCategory();
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
            
            if($this->nativesession->get('language') && $data["lang_label"] <>"english")
            {
                $data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW'></script>";
                $data["fileinputLang"] = "language: \"ch\",";
                //$data["fileinputLang"] = "<script src=\"".base_url()."assets/js/fileinput_locale_ch.js\" type=\"text/javascript\"></script>";      
                // log_message('debug', '!!!!!!!!!!!!!'.$data["fileinputLang"]);
                
            }else
            {
                $data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>";
                $data["fileinputLang"] = "";
                
            }

            //print_r($data);
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
		
            $this->nativesession->set("lastPageVisited","newPost");
			if(empty($userInfo))
			{
				$errorMsg=$this->lang->line("PostPleaseLoginFirst");
				$data["error"]=$errorMsg;
				$data["prevURL"]=$prevURL;
				$data['redirectToWhatPage']="Login in Page";
				$data['redirectToPHP']=base_url().MY_PATH."home/loginPage?prevURL=".base_url().MY_PATH."newPost";
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($userInfo)){
				$menuCount=$this->getHeaderCount($userInfo["userID"]);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			//----------------------------
			$NumOfPostTimes=$this->post->getNUMOFTIMESPOST($data["userID"]);
			if($NumOfPostTimes>=NUMOFTIMESPOST && NUMOFTIMESPOST<UNLIMITEDTIMES)
			{
				$errorMsg=sprintf($this->lang->line("ExceedMaxPost"),NUMOFTIMESPOST , NUMOFDAYSFORPOST);
				$data["error"]=$errorMsg;
				$data["prevURL"]=$prevURL;
				$data['redirectToWhatPage']="Previous Page";
				$data['redirectToPHP']=$prevURL;
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
			
			
            $data["error"]= ($errorMsg);
            $data["prevURL"]=$prevURL;
            
            $data["NewPost"]=$this->lang->line("NewPost");
            $data["TopicTitle"]=$this->lang->line("TopicTitle");
            $data["Category"]=$this->lang->line("Category");
            $data["ItemQuality"]=$this->lang->line("ItemQuality");
            $data["Description"]=$this->lang->line("Description");
            $data["HKDPrice"]=$this->lang->line("HKDPrice");
            $data["Negotiable"]=$this->lang->line("Negotiable");
            $data["Picture"]=$this->lang->line("Picture");
            $data["Extra"]=$this->lang->line("Extra");
            $data["ExtraInfo"]=$this->lang->line("ExtraInfo");
            $data["SearchTags"]=$this->lang->line("SearchTags");
            $data["lblLocation"]=$this->lang->line("lblLocation");
            $data["lblAllLocations"]=$this->lang->line("lblAllLocations");
            $data["PleaseNotCloseBrowse"]=$this->lang->line("PleaseNotCloseBrowse");
            $data["YouHaveRemainPost"]="";
            if(NUMOFTIMESPOST-$NumOfPostTimes<=MINCOUNTSHOWREMAINTIMES && NUMOFTIMESPOST<UNLIMITEDTIMES)
            	$data["YouHaveRemainPost"]=sprintf($this->lang->line("YouHaveRemainPost"), NUMOFTIMESPOST-$NumOfPostTimes);
            
			//-----------------Set user information -----------------
			$user1=$this->nativesession->get("user");
			if(isset($user1)){
				$data["userName"]=$user1["username"];
			
			}
			$data['remainCount'] = 4;
			
            $this->load->view('newPost', $data);
		}
	}
	
	public function selectCategory ($userID=0, $username='', $errorMsg='')
	{
		$prevURL=base_url();
		
		if(isset($_GET["prevURL"])){
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
			$data["AllCategory"]=$this->getAllCategory();
		  
 	        $userInfo=$this->nativesession->get("user");
 	        if($userID==0 & !empty($userInfo))
 	        	$data["userID"]=$userInfo["userID"];
 	        else 
 	        	$data["userID"]=$userID;
 	        if($username=='' & !empty($userInfo))
 	        	$data["username"]=$userInfo["username"];
            else 
            	$data["username"]=$username;
 	        $data["lang_label"]=$this->nativesession->get("language");
			$data['result']=null;
            $data['query']=$this->cat->getParentCategory();
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
            
            if($this->nativesession->get('language') && $data["lang_label"] <>"english")
            {
                $data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW'></script>";
                $data["fileinputLang"] = "language: \"ch\",";
                //$data["fileinputLang"] = "<script src=\"".base_url()."assets/js/fileinput_locale_ch.js\" type=\"text/javascript\"></script>";      
                // log_message('debug', '!!!!!!!!!!!!!'.$data["fileinputLang"]);
                
            }else
            {
                $data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>";
                $data["fileinputLang"] = "";
                
            }

            //print_r($data);
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
		
            $this->nativesession->set("lastPageVisited","newPost");
			if(empty($userInfo))
			{
				$data["PrevURL"]=$prevURL;
				$data["Username"]=$this->lang->line("Username");
				$data["Password"]=$this->lang->line("Password");
				$data["SignUp"]=$this->lang->line("SignUp");
				$data["LostYourPassword"]=$this->lang->line("LostYourPassword");
				
				$this->load->view('login', $data);
				return;
			}
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($userInfo)){
				$menuCount=$this->getHeaderCount($userInfo["userID"]);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			//----------------------------
			$NumOfPostTimes=$this->post->getNUMOFTIMESPOST($data["userID"]);
			if($NumOfPostTimes>=NUMOFTIMESPOST && NUMOFTIMESPOST<UNLIMITEDTIMES)
			{
				$errorMsg=sprintf($this->lang->line("ExceedMaxPost"),NUMOFTIMESPOST , NUMOFDAYSFORPOST);
				$data["error"]=$errorMsg;
				$data["prevURL"]=$prevURL;
				$data['redirectToWhatPage']="Previous Page";
				$data['redirectToPHP']=$prevURL;
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
			
			
            $data["error"]= ($errorMsg);
            $data["prevURL"]=$prevURL;
            
            $data["NewPost"]=$this->lang->line("NewPost");
            $data["TopicTitle"]=$this->lang->line("TopicTitle");
            $data["Category"]=$this->lang->line("Category");
            $data["ItemQuality"]=$this->lang->line("ItemQuality");
            $data["Description"]=$this->lang->line("Description");
            $data["HKDPrice"]=$this->lang->line("HKDPrice");
            $data["Negotiable"]=$this->lang->line("Negotiable");
            $data["Picture"]=$this->lang->line("Picture");
            $data["Extra"]=$this->lang->line("Extra");
            $data["ExtraInfo"]=$this->lang->line("ExtraInfo");
            $data["SearchTags"]=$this->lang->line("SearchTags");
            $data["lblLocation"]=$this->lang->line("lblLocation");
            $data["lblAllLocations"]=$this->lang->line("lblAllLocations");
            $data["PleaseNotCloseBrowse"]=$this->lang->line("PleaseNotCloseBrowse");
			$data["RemainChar"]=$this->lang->line("RemainChar");
            $data["YouHaveRemainPost"]="";
            if(NUMOFTIMESPOST-$NumOfPostTimes<=MINCOUNTSHOWREMAINTIMES && NUMOFTIMESPOST<UNLIMITEDTIMES)
            	$data["YouHaveRemainPost"]=sprintf($this->lang->line("YouHaveRemainPost"), NUMOFTIMESPOST-$NumOfPostTimes);
            
			//-----------------Set user information -----------------
			$user1=$this->nativesession->get("user");
			if(isset($user1)){
				$data["userName"]=$user1["username"];
			
			}
			$data['remainCount'] = 4;
			
            $this->load->view('newPost_1', $data);
		}
	}
	
	public function showEditPost($postID)
	{
		$prevURL=base_url();
	if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
		}else if(isset($_SESSION["previousUrl"])){
			$prevURL=$_SESSION["previousUrl"];
		}
		$data["postID"]=$postID;
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
	
		$userInfo=$this->nativesession->get("user");
		$userID=0;
		$username="";
		if($userID==0 & !empty($userInfo))
			$data["userID"]=$userInfo["userID"];
		else
			$data["userID"]=$userID;
		if($username=='' & !empty($userInfo))
			$data["username"]=$userInfo["username"];
		else
			$data["username"]=$username;
		
		$postInfo=$this->post->getPostByPostID($postID);
		if($data["userID"]==0 || $postInfo[0]->userID!=$data["userID"])
		{
			$errorMsg=$this->lang->line("PostPleaseLoginFirst");
			$data['error']= $errorMsg;
			$data["prevURL"]=$prevURL;
			$data['redirectToWhatPage']="Login Page";
			$data['redirectToPHP']=base_url().MY_PATH."home/loginPage";
			$data["successTile"]=$this->lang->line("successTile");
			$data["failedTitle"]=$this->lang->line("failedTitle");
			$data["goToHomePage"]=$this->lang->line("goToHomePage");
			$this->load->view('failedPage', $data);
			return;
		}
		
		$data["catIDValue"]=$postInfo[0]->catID;
		$data["locIDValue"]=$postInfo[0]->locID;
		$data["itemNameValue"]=$postInfo[0]->itemName;
		$data["itemNameCHValue"]=$postInfo[0]->itemNameCH;
		$data["itemPriceValue"]=$postInfo[0]->itemPrice;
		$data["descriptionValue"]=$postInfo[0]->description;
		$data["newUsedValue"]=$postInfo[0]->newUsed;
		$data["infoDisplayStatus"]=$postInfo[0]->infoDisplayStatus;
		
		$data["lang_label"]=$this->nativesession->get("language");
		$data['result']=null;
		$data['query']=$this->cat->getParentCategory();
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
	
		if($this->nativesession->get('language') && $data["lang_label"] <>"english")
		{
			$data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW'></script>";
			$data["fileinputLang"] = "language: \"ch\",";
			//$data["fileinputLang"] = "<script src=\"".base_url()."assets/js/fileinput_locale_ch.js\" type=\"text/javascript\"></script>";
			// log_message('debug', '!!!!!!!!!!!!!'.$data["fileinputLang"]);
	
		}else
		{
			$data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>";
			$data["fileinputLang"] = "";
	
		}
	
		//print_r($data);
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
	
			$this->nativesession->set("lastPageVisited","newPost");
			if(empty($userInfo))
			{
				$errorMsg=$this->lang->line("PostPleaseLoginFirst");
				$data["error"]=$errorMsg;
				$data["prevURL"]=$prevURL;
				$data['redirectToWhatPage']="Login in Page";
				$data['redirectToPHP']=base_url().MY_PATH."home/loginPage";
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
			
			$data["imageFile1"]="#";
			$data["imageFile2"]="#";
			$data["imageFile3"]="#";
			$data["imageFile4"]="#";
			$data["imageFile5"]="#";
			$data["disableimage1"]="";
			$data["disableimage2"]="";
			$data["disableimage3"]="";
			$data["disableimage4"]="";
			$data["disableimage5"]="";
				
			$pic=$this->post->get_picture_by_postID($postID);
			if(isset($pic))
			{
				$a=1;
				$upload_dir="USER_IMG/".$data["username"]."/Resize/";
				foreach($pic as $row)
				{
					$data["imageFile".$a]=base_url().$row->thumbnailPath."/".$row->thumbnailName;
					$data["disableimage".$a]=" disabled='disabled' ";
					$a++;
				}
			}
			
			
			
			$data["prevURL"]=$prevURL;
	
			$data["NewPost"]=$this->lang->line("NewPost");
			$data["TopicTitle"]=$this->lang->line("TopicTitle");
			$data["Category"]=$this->lang->line("Category");
			$data["ItemQuality"]=$this->lang->line("ItemQuality");
			$data["Description"]=$this->lang->line("Description");
			$data["HKDPrice"]=$this->lang->line("HKDPrice");
			$data["Negotiable"]=$this->lang->line("Negotiable");
			$data["Picture"]=$this->lang->line("Picture");
			$data["Extra"]=$this->lang->line("Extra");
			$data["ExtraInfo"]=$this->lang->line("ExtraInfo");
			$data["SearchTags"]=$this->lang->line("SearchTags");
			$data["lblLocation"]=$this->lang->line("lblLocation");
			$data["lblAllLocations"]=$this->lang->line("lblAllLocations");
			$data["PleaseNotCloseBrowse"]=$this->lang->line("PleaseNotCloseBrowse");
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($userInfo)){
				$menuCount=$this->getHeaderCount($userInfo["userID"]);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			//----------------------------
			$this->load->view('editPost', $data);
		}
	}
	
public function getChildCategory($parentID)
	{
		$result=null;
		$data['query']=$this->cat->getChildCategory($parentID);
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
        public function validation()
	{
            $captcha;

            if(isset($_POST['g-recaptcha-response'])){
              $captcha=$_POST['g-recaptcha-response'];
            }
            if(!$captcha){
              echo '<h2>Please check the the captcha form.</h2>';
              exit;
            }
            $fields = array(
                'secret'    =>  "6Lec9AYTAAAAALrIwia-e_3Lc2pb3Vj0ZTbI9gEN",
                'response'  =>  $captcha,
                'remoteip'  =>  $_SERVER['REMOTE_ADDR']
            );
		//$ch = curl_init("https://www.google.com/recaptcha/api/siteverify");
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
		//$response = json_decode(curl_exec($ch));
		//curl_close($ch);
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
            print "curl response is:" . $response;
            echo "Curl Error :--" . curl_error($ch);
            curl_close ($ch);


            $result = json_decode($response,true);
		//$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=YOUR SECRET KEY&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        //$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le4uAYTAAAAAJiVej5-dLhS_PRCRF0pzgWvQekf&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		//echo "?secret=6Le4uAYTAAAAAJiVej5-dLhS_PRCRF0pzgWvQekf";
		//echo "&response=".$captcha;
		//echo "&remoteip=".$_SERVER['REMOTE_ADDR'];
		//echo "RESULT!!!!!!!!!!!!!!!!!".$result;
            print_r($result);
            echo "a!!!!!!!!!!!!!!!!!".$response;
		//echo "CH!!!!!!!!!!!!!!!!!".$ch;
		
        if($result['success'] == false)
        {
          echo '<h2>You are spammer ! Get the @$%K out</h2>';
        }else
        {
          echo '<h2>Thanks for posting comment.</h2>';
        }
    }
   public function uploadImg2()
    {
        if (0 < $_FILES['file']['error']) {
            $output = array('uploaded' => 'ERROR' );
            //$output['status'] = '<em><span style="color:red"><i class="icon-cancel-1 fa"></i><strong>'."Error".'!</strong></span></em>';
        }else
        {

            $userName = 'testUser';
            /*** the upload directory ***/
            $upload_dir= 'TMP_UPLOAD';

            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            //User Upload Folder Name
            $upload_dir = $upload_dir.'/'.$userName;
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            /*** maximum filesize allowed in bytes ***/
            $max_file_size  = 5000000;
            $maxFilesAllowed = 10;


            log_message('debug', 'PRE UPLOADING!!!!!!!!');

            //echo "this is a test";
            //print_r($_FILES['input-upload']);

            if (isset($_FILES['file']['tmp_name'])){

                log_message('debug', 'UPLOADING!!!!!!!!');
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["file"]["tmp_name"]);
                
                // check if there is a file in the array
                if(!is_uploaded_file($_FILES['file']['tmp_name']))
                {
                    $messages = 'No file uploaded';
                }// check the file is less than the maximum file size
                else if($_FILES['file']['size'] > $max_file_size)
                {
                    log_message('debug', 'size!!!!!!!!');
                    $messages = "File size exceeds $max_file_size limit";
                    $output = array('uploaded' => 'SIZE' );
                    $output['status'] = '<em><span style="color:red"><i class="icon-cancel-1 fa"></i><strong>'."File size exceeds $max_file_size limit".'!</strong></span></em>';
                }else if($check == false) {
                    $messages = "File is not an image.";
                    $uploadOk = 0;
                    $output = array('uploaded' => 'TYPE' );
                    $output['status'] = '<em><span style="color:red"><i class="icon-cancel-1 fa"></i><strong>'."File is not an image".'!</strong></span></em>';
                }
                else
                {

                    $filecount = 0;
                    $files = glob($upload_dir . "/*");
                    if ($files){
                        $filecount = count($files);
                    }
                    log_message('debug', $upload_dir.' has filecount: '.$filecount);

                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);
                    //echo $extension;
                    $name = $_FILES["file"]["name"];

                    if($filecount > $maxFilesAllowed)
                    {
                        //$messages[] = 'Maximum Number of Upload Attempts Exceeded!';
                        $messages[] = 'Uploading '.$name.' Failed';
                        $output = array('uploaded' => 'ERROR' );
                        $output['status'] = '<em><span style="color:red"><i class="icon-cancel-1 fa"></i><strong>'."Maximum Number of Upload Attempts Exceeded".'!</strong></span></em>';
                        echo json_encode($output); 
                    }else
                    {
                        $target_file = $upload_dir.'/'.$name;
                        // copy the file to the specified dir 
                        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file))
                        {
                            /*** give praise and thanks to the php gods ***/
                            $messages = $name.' uploaded';
                            $image_path=$upload_dir.'/'.$name;
                            $output = array('uploaded' => 'OK' );
                            $output['status'] = '<em><span style="color:green"><i class="icon-ok-1 fa"></i><strong>'."Upload Successful".'!</strong></span></em>';                        
                        }
                        else
                        {
                            /*** an error message ***/
                            $messages = 'Uploading '.$name.' Failed';
                            $output = array('uploaded' => 'ERROR' );
                            $output['status'] = '<em><span style="color:red"><i class="icon-cancel-1 fa"></i><strong>'."Upload Unsuccessful, Please try again later".'!</strong></span></em>';
                        }
                    }

                }
                echo json_encode($output); 
            }
        }
    }
    
    function check_base64_image($base64) {
        $img = imagecreatefromstring(base64_decode($base64));
        if (!$img) {
            return false;
        }

        imagepng($img, 'tmp.png');
        $info = getimagesize('tmp.png');

        unlink('tmp.png');

        if ($info[0] > 0 && $info[1] > 0 && $info['mime']) {
            return true;
        }

        return false;
    }
    
    
    
    
    function uploadImg($input, $isThumbnail, $file)
    {
//        echo "<br />";echo "<br />";
//        echo"input".$input;
//        echo"isThumbnail".$isThumbnail;
//        echo"file".$file;
//        echo "<br />";echo "<br />";
        
        if($input == null || $input == "")
        {
            return false;
        }
        //$fileName = "someName"; 
        $stringVal = $input; 
        $value  = str_replace('data:image/png;base64,', '', $stringVal);
        
        if ($this->check_base64_image($value) == false) {
            //$this->load->view('system-error.php');
            return false;
        }
        
        
        
        
        $actualFile  = base64_decode($value);
        $img = imagecreatefromstring($actualFile);
        $imgSize = getimagesize('data://application/octet-stream;base64,' . base64_encode($actualFile));
        
        
        //log_message('debug', '@@@@@@@@@@@@@@@@@@@@@'.$value);        
        
        if ($img == false) {
            return false;
        }else
        {

            /*** maximum filesize allowed in bytes ***/
            $max_file_length  = 100000;
            $maxFilesAllowed = 10;
   
            log_message('debug', 'PRE UPLOADING!!!!!!!!');
            
            if (isset($img)){

                log_message('debug', 'UPLOADING!!!!!!!!');

                // check the file is less than the maximum file size
                if($imgSize['0'] > $max_file_length || $imgSize['1'] > $max_file_length)
                {
                    log_message('debug', 'size!!!!!!!!'.print_r($imgSize));
                    $messages = "File size exceeds $max_file_size limit";
                    //$this->load->view('system-error.php');
                    return false;
                }else if (file_exists($file)) {
                    //$this->load->view('system-error.php');
                    return false;
                }else
                {
                    file_put_contents($file, $actualFile);
                    try{
                    	//echo $file;
//                     	$handle = fopen(FCPATH.$file, "rb");
//                     	$contents = fread($handle, filesize(FCPATH.$file));
                    	//$databyte = implode("", file($file));
                    	//$encodeStr=base64_encode($contents);
// 	                    $gzdata = gzencode($contents, 9);
// 	                    $fp = fopen(FCPATH.$file, "w");
// 	                    fwrite($fp, $actualFile);
// 	                    fclose($fp);
	                    //$errorMsg="FCPATH: ".FCPATH.$file.". FREAD: ".$contents.". ENCODESTR: ".$encodeStr.".  Gzencode: ".$gzdata;
	                    //redirect(base_url().MY_PATH."/newPost///".urlencode($errorMsg));
	                    //return false;
                    }catch(Exception $ex)
                    {
//                     	$errorMsg="FCPATH: ".FCPATH.$actualFile.". FREAD: ".$contents.". ENCODESTR: ".$encodeStr.".  Gzencode: ".$gzdata.". error: ".$ex.getMessage();
//                     	redirect(base_url().MY_PATH."/newPost///".urlencode($errorMsg));
//                     	return false;
                    }
                    return true;
                }
            }       
        } 
    }
	
    public function price_check($str)
	{
    	if(strcmp(trim($str), '')==0){
    		$this->form_validation->set_message('price_check', 'The %s field cannot be empty');
    		return FALSE;
    	}else if (!is_int((int)trim($str)))
		{
			$this->form_validation->set_message('price_check', 'The %s field can only be number without decimal');
			return FALSE;
		}
		else
		{
			if(intval($str)>=MINPRICERANGE and intval($str)<=MAXPRICERANGE)
				return TRUE;
			else{
				$this->form_validation->set_message('price_check', 'The %s field is not in the price range value');
				return FALSE;
			}
		}
    }
    
    public function createNewPost($loginID, $loginUser, $prevURL='')
    {
    	//header('Content-type: application/json');
    	$response_array=array();
    	$prevURL=base_url();
    	
    	if(isset($_GET["prevURL"])){
    		$prevURL=$_GET["prevURL"];
    		$_SESSION["previousUrl"]=$prevURL;
    	}else if(isset($_SESSION["previousUrl"])){
    		$prevURL=$_SESSION["previousUrl"];
    	}
    	$data["prevURL"]=$prevURL;
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
    	
    	$data["Login"]=$this->lang->line("Login");
    	$data["Signup"]=$this->lang->line("Signup");
    	$data["Profile"]=$this->lang->line("Profile");
    	$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
    	$data["Logout"]=$this->lang->line("Logout");
    	$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
    	
    	$userInfo=$this->nativesession->get("user");
    	//----------setup the header menu----------
    	$data["menuMyAds"]="";
    	$data["menuInbox"]="";
    	$data["menuInboxNum"]="0";
    	$data["menuPendingRequest"]="";
    	$data["menuPendingRequestNumber"]="0";
    	if(isset($userInfo)){
    		$menuCount=$this->getHeaderCount($userInfo["userID"]);
    		$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
    		$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
    	}
    	//----------------------------
    	if(empty($userInfo))
 	        {
 	        	$errorMsg=$this->lang->line("PostPleaseLoginFirst");	
//  	        	$data['error']= $errorMsg;
//  	    		$data["prevURL"]=$prevURL;
// 				$data['redirectToWhatPage']="Login Page";
// 				$data['redirectToPHP']=base_url().MY_PATH."home/loginPage?prevURL=".base_url().MY_PATH."newPost";;
// 				$data["successTile"]=$this->lang->line("successTile");
// 				$data["failedTitle"]=$this->lang->line("failedTitle");
// 				$data["goToHomePage"]=$this->lang->line("goToHomePage");
// 				$this->load->view('failedPage', $data);
// 				return;
				$response_array['status'] = 'error';
				$response_array['errmsg']=$errorMsg;
				echo json_encode($response_array);
				return;
 	        }
    	
 	        
 	        
 	        
        $userName = $loginUser;
        $userID = $loginID;
        $userInfo=$this->nativesession->get("user");
        $userID=$userInfo["userID"];
        $userName=$userInfo["username"];
        $usertype="PREMIUMPOSTEXPIRYDAYS"; //$userInfo("usertype");
        
        $NumOfPostTimes=$this->post->getNUMOFTIMESPOST($userID);
        if($NumOfPostTimes>=NUMOFTIMESPOST && NUMOFTIMESPOST<UNLIMITEDTIMES)
        {
    	    $errorMsg=sprintf($this->lang->line("ExceedMaxPost"),NUMOFTIMESPOST , NUMOFDAYSFORPOST);
// 				$data["error"]=$errorMsg;
//         	$data["prevURL"]=$prevURL;
//         	$data['redirectToWhatPage']="Previous Page";
//         	$data['redirectToPHP']=$prevURL;
//         	$data["successTile"]=$this->lang->line("successTile");
//         	$data["failedTitle"]=$this->lang->line("failedTitle");
//         	$data["goToHomePage"]=$this->lang->line("goToHomePage");
//         	$this->load->view('failedPage', $data);
//         	return;
        	$response_array['status'] = 'error';
        	$response_array['errmsg']=$errorMsg;
        	echo json_encode($response_array);
        	return;
        }
        
        
        
        /*** the upload directory ***/
        $upload_dir= 'USER_IMG';

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
        
        $title = $this->input->post('Adtitle',true); 
        $cat = $this->input->post('category-group',true); 
        $tags = $this->input->post('tagsInput',true); 
        $des = $this->input->post('descriptionTextarea',true); 
        $content=htmlentities($des, ENT_QUOTES, 'UTF-8');
        $price = $this->input->post('price',true);
        
//         if ($this->form_validation->run('newPost/createNewPost') == FALSE)
//         {
//         	$this->index($userID, $userName, '0', $prevURL);
//         	return;
//         }else{
		$errorMsg="";
		if(strcmp(trim($price), '')==0){
			$errorMsg=$errorMsg." ".sprintf($this->lang->line("EmptyPrice"));	
		}else if (!is_int((int)trim($price)))
		{
			$errorMsg=$errorMsg." ".sprintf($this->lang->line("InvalidPriceFormat"), $price);
		}
		else
		{
			if(intval($price)>=MINPRICERANGE and intval($price)<=MAXPRICERANGE)
			{
			}else{
					$errorMsg=$errorMsg." ".sprintf($this->lang->line("InvalidPriceRange"), $price);
					}
		}		


        if(ExceedDescLength($content, DESCLENGTHINNEWPOST) ||
        	ExceedDescLength($title, 70) ||
        		ShortDescLength($content, DESCMINLENGTHINNEWPOST) || 
        		empty($cat) || $cat==0 || strcmp($cat, "0")==0
        		){
	        if(ExceedDescLength($content, DESCLENGTHINNEWPOST) ||
        	ExceedDescLength($title, 70))
        		$errorMsg=$errorMsg." ".sprintf($this->lang->line("ExceedMaxDescOrTitleLengthInNewPost"));
	        if(ShortDescLength($content, DESCMINLENGTHINNEWPOST))
	        	$errorMsg=$errorMsg." ".sprintf($this->lang->line("MinDescLength"));
	       if(empty($content) || strlen(trim($content))==0)
				$errorMsg=$errorMsg." ".sprintf($this->lang->line("ZeroDescLength"));
			if(empty($title) || strlen(trim($title))==0)
				$errorMsg=$errorMsg." ".sprintf($this->lang->line("ZeroTitleLength"));
			if(empty($cat) || $cat==0 || strcmp($cat, "0")==0)
				$errorMsg=$errorMsg." ".sprintf($this->lang->line("EmptyCategory"));
			
        }
        
        if(!empty($errorMsg) || strcmp($errorMsg, "")!=0){

//         	$data["error"]=$errorMsg;
//         	$data["prevURL"]=$prevURL;
//         	$data['redirectToWhatPage']="New Post Page";
//         	$data['redirectToPHP']=base_url().MY_PATH."newPost";
//         	$data["successTile"]=$this->lang->line("successTile");
//         	$data["failedTitle"]=$this->lang->line("failedTitle");
//         	$data["goToHomePage"]=$this->lang->line("goToHomePage");
//         	$this->load->view('failedPage', $data);
//         	return;
        	$response_array['status'] = 'error';
        	$response_array['errmsg']=$errorMsg;
        	echo json_encode($response_array);
        	return;
        	
        }
        
        $recaptcha = $this->input->post('g-recaptcha-response',true); 
        $negotiable = $this->input->post('negotiable'); 
        $soldqty=1;
        if(strcmp(SHOWQTY, "Y")==0){
        	$soldqty=$this->input->post("soldqty");
        }
        if (isset($_POST['negotiable'])) {
            $negotiable = true;
        }else
        {
            $negotiable = false;
        }
        if (isset($_POST['itemQualityGroup'])) {
            $quality = $_POST['itemQualityGroup'];
        }else
        {
            $quality = '';
        }
            $locID2=$this->input->post('locID2');
         $tempExpriyDate = '';
        if(strcmp($usertype, "PREMIUMPOSTEXPIRYDAYS")==0)
        	$tempExpriyDate=$this->addDayswithdate(date("Y-m-d H:i:s"), PREMIUMPOSTEXPIRYDAYS);
        else  if(strcmp($usertype, "GOLDPOSTEXPIRYDAYS")==0)
        	$tempExpriyDate=$this->addDayswithdate(date("Y-m-d H:i:s"), GOLDPOSTEXPIRYDAYS);
       else  if(strcmp($usertype, "SILVERPOSTEXPIRYDAYS")==0)
      	 	$tempExpriyDate=$this->addDayswithdate(date("Y-m-d H:i:s"), SILVERPOSTEXPIRYDAYS);
      
        $postInfo = array(
        'userID'   => intval($userID),
        'viewCount'   =>  "1",
        'catID'   =>  intval($cat),
        'locID'   =>intval($locID2),
        'itemName' => $title,
        'itemNameCH'  =>  $title,
        'itemPrice' => $price,
        'itemQual' => "1",
        'currency' => "HKD",
        'description' => $content,
        'paymentMethod' => 'U',
        'status'  => 'U',
        'infoDisplayStatus'  => $negotiable,
        'newUsed'=>$quality,
        'remainQty'=>$soldqty,
        'createDate'  => date("Y-m-d H:i:s"),
   		'postDate'  => date("Y-m-d H:i:s"),
        'expriyDate' => $tempExpriyDate
    	);
        
        
        //$this->post->updateStat();
        $data['result']=null;
        $data['query']=$this->cat->getParentCategory();
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
        $serviceCatList="";
        foreach ($data['result'] as $id=>$value)
        {
        	if($value[0]->newPostNotRequiredImg==1){
        		$serviceCatList=$serviceCatList.$id.",";
        	}
        }
        $isServiceCat=false;
        $fields=explode(',',$serviceCatList);
        foreach ($fields as $value)
        {	if(intval($value)==intval($cat)){
        		$isServiceCat=true;
        		break;
        	}
        }
        
        
        $imgInfoList=array();
        
        if(isset($_FILES['filelist']) && !empty($_FILES['filelist'])){
	        $this->load->library('image_lib');
			$filelist=$_FILES['filelist'];
		    $number_of_files = count($_FILES['filelist']['tmp_name']);
			if($number_of_files==0 && !$isServiceCat)
			{
				$errorMsg=$this->lang->line("PostErrorNoImageFileSelected");
// 				$data['error'] = $errorMsg;
// 				$data["prevURL"]=$prevURL;
// 				$data['redirectToWhatPage']="New Post Page";
// 				$data['redirectToPHP']=base_url().MY_PATH."newPost/index/".$userID."/".$userName."?prevURL=".$prevURL;
// 				$data["successTile"]=$this->lang->line("successTile");
// 				$data["failedTitle"]=$this->lang->line("failedTitle");
// 				$data["goToHomePage"]=$this->lang->line("goToHomePage");
// 				$this->load->view('failedPage', $data);
// 				return;
				$response_array['status'] = 'error';
				$response_array['errmsg']=$errorMsg;
				echo json_encode($response_array);
				return;
			}
			
							
		   // ChromePhp::log($filelist);
	        for ($i=0;$i<$number_of_files;$i++)
	        {
				$_FILES['image']['name'] = $filelist['name'][$i];
				$_FILES['image']['type'] = $filelist['type'][$i];
				$_FILES['image']['tmp_name'] = $filelist['tmp_name'][$i];
				$_FILES['image']['error'] = $filelist['error'][$i];
				$_FILES['image']['size'] = $filelist['size'][$i];
				
				$imgPath = $upload_dir . '/'.$userName.'_'.(new DateTime())->format('Y-m-d-H-i-s').'_'.$i.'.png';
				$thumb_fileName=$userName.'_'.(new DateTime())->format('Y-m-d-H-i-s').'_thumb_'.$i.'.png';
				$main_fileName=$userName.'_'.(new DateTime())->format('Y-m-d-H-i-s').'_main_'.$i.'.png';
				
				$config['file_name'] = basename($imgPath);
				$config['upload_path'] = $upload_dir;  
				$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('image'))
				{
					if($this->upload->display_errors()<>'')
					{
						//$hasImage=$this->input->post('image');
						//if(!isset($hasImage) or empty($hasImage))
						//	continue;	        		
						$error = $this->upload->display_errors();
// 						$data=array('error'=> $error);
// 						$data["prevURL"]=$prevURL;
// 						$data['redirectToWhatPage']="New Post Page";
// 						$data['redirectToPHP']=base_url().MY_PATH."newPost/index/".$userID."/".$userName."?prevURL=".$prevURL;
// 						$data["successTile"]=$this->lang->line("successTile");
// 						$data["failedTitle"]=$this->lang->line("failedTitle");
// 						$data["goToHomePage"]=$this->lang->line("goToHomePage");
// 						$this->load->view('failedPage', $data);
// 						return;
						$response_array['status'] = 'error';
						$response_array['errmsg']=$error;
						echo json_encode($response_array);
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
// 							$data=array('error'=> $error);
// 							$data["prevURL"]=$prevURL;
// 							$data['redirectToWhatPage']="New Post Page";
// 							$data['redirectToPHP']=base_url().MY_PATH."newPost/index/".$userID."/".$userName."?prevURL=".$prevURL;
// 							$data["successTile"]=$this->lang->line("successTile");
// 							$data["failedTitle"]=$this->lang->line("failedTitle");
// 							$data["goToHomePage"]=$this->lang->line("goToHomePage");
// 							$this->load->view('failedPage', $data);
// 							return;
							$response_array['status'] = 'error';
							$response_array['errmsg']=$error;
							echo json_encode($response_array);
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
// 								$data=array('error'=> $error);
// 								$data["prevURL"]=$prevURL;
// 								$data['redirectToWhatPage']="New Post Page";
// 								$data['redirectToPHP']=base_url().MY_PATH."newPost/index/".$userID."/".$userName."?prevURL=".$prevURL;
// 								$this->load->view('failedPage', $data);
// 								$data["successTile"]=$this->lang->line("successTile");
// 								$data["failedTitle"]=$this->lang->line("failedTitle");
// 								$data["goToHomePage"]=$this->lang->line("goToHomePage");
// 								return;
								
								$response_array['status'] = 'error';
								$response_array['errmsg']=$error;
								echo json_encode($response_array);
								return;
							}
						}
						else
						{
							$imgInfo=array();
							$imgInfo['postID'] = 0;
							$imgInfo['userID'] = $userID;
							$imgInfo['picturePath'] = $upload_dir_resize;
							$imgInfo['pictureName'] = $main_fileName;
							$imgInfo['status'] = 'U';
							$imgInfo['thumbnailPath'] = $upload_dir_resize;
							$imgInfo['thumbnailName']  =$thumb_fileName;
							array_push($imgInfoList ,$imgInfo);
							//$data['returnValue'] = $this->picture->insert($imgInfo);
						}
					}
				}
	        }
        }
        else{
        	if(!$isServiceCat)
        	{
        		$errorMsg=$this->lang->line("PostErrorNoImageFileSelected");
//         		$data['error'] = $errorMsg;
// 				$data["prevURL"]=$prevURL;
//         		$data['redirectToWhatPage']="New Post Page";
//         		$data['redirectToPHP']=base_url().MY_PATH."newPost/index/".$userID."/".$userName."?prevURL=".$prevURL;
//         		$data["successTile"]=$this->lang->line("successTile");
//         		$data["failedTitle"]=$this->lang->line("failedTitle");
//         		$data["goToHomePage"]=$this->lang->line("goToHomePage");
//         		$this->load->view('failedPage', $data);
//         		return;
        		$response_array['status'] = 'error';
        		$response_array['errmsg']=$errorMsg;
        		echo json_encode($response_array);
        		return;
	        }
	        else{
//         	$postID = $this->post->insert($postInfo);
        		
// 	        	if($postID==null or $postID==0)
// 	        	{
// 	        		$errorMsg=$this->lang->line("PostErrorZeroPostID");
// 	        		$data['error'] = $errorMsg;
// 					$data["prevURL"]=$prevURL;
// 	        		$data['redirectToWhatPage']="New Post Page";
// 	        		$data['redirectToPHP']=base_url().MY_PATH."newPost/index/".$userID."/".$userName."?prevURL=".$prevURL;
// 	        		$data["successTile"]=$this->lang->line("successTile");
// 	        		$data["failedTitle"]=$this->lang->line("failedTitle");
// 	        		$data["goToHomePage"]=$this->lang->line("goToHomePage");
// 	        		$this->load->view('failedPage', $data);
// 	        		return;
// 	        	}
        		
       	 	}
        }
        
        $postID = $this->post->insert($postInfo);
        	
        if($postID==null or $postID==0)
        {
        	$errorMsg=$this->lang->line("PostErrorZeroPostID");
        	//$data['error']= $errorMsg;
//         	$data['error'] = $errorMsg;
//         	$data["prevURL"]=$prevURL;
//         	$data['redirectToWhatPage']="New Post Page";
//         	$data['redirectToPHP']=base_url().MY_PATH."newPost/index/".$userID."/".$userName."?prevURL=".$prevURL;
//         	$data["successTile"]=$this->lang->line("successTile");
//         	$data["failedTitle"]=$this->lang->line("failedTitle");
//         	$data["goToHomePage"]=$this->lang->line("goToHomePage");
//         	$this->load->view('failedPage', $data);
//         	return;
        	
        	$response_array['status'] = 'error';
        	$response_array['errmsg']=$errorMsg;
        	echo json_encode($response_array);
        	return;
        }
        
        if(isset($imgInfoList) && $imgInfoList<>null && count($imgInfoList)>0){
	        foreach($imgInfoList as $id=> $imgInfo)
	        {
	        	$imgInfo['postID'] = $postID;
	        	$data['returnValue'] = $this->picture->insert($imgInfo);
	        }
        }
//         if($tags != null && $tags !== '')
//         {
//             $myTags = explode(',', $tags);
//             foreach ($myTags as $value) {
                
//                 $postInfo = array(
//                     'postID'   => $postID,
//                     'tag'   =>  $value,
//                     'createDate'   =>  date("Y-m-d H:i:s")
//                     );
//                 //echo "$value <br>";
//                 $this->tag->insert($postInfo);
//             }
//         }
        
        $errorMsg=$this->lang->line("PostSuccess");
        //if($prevURL<>'')
        //{
        //	redirect(urldecode($prevURL));
        //}
        //else
       // {
      $data["error"]=$errorMsg;
		$data["prevURL"]=$prevURL;
		$data['redirectToWhatPage']="Previous Page";
		$data['redirectToPHP']=$prevURL;
		$data["successTile"]=$this->lang->line("successTile");
		$data["failedTitle"]=$this->lang->line("failedTitle");
		$data["goToHomePage"]=$this->lang->line("goToHomePage");
		$this->admin_model->updateStatByUserID($userID);
			
		$msg['status'] = 'A';
		$msg['class'] = "has-success";
		$data['remainCount'] = 4;
		//echo json_encode($msg);
		//$this->load->view('successPage', $data);
		 //}
        $response_array['status'] = 'success';
        echo json_encode($response_array);
    }
	
    public function editPost($postID)
    {
    $prevURL=base_url();
    	
    	if(isset($_GET["prevURL"])){
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
    	 
    	$userInfo=$this->nativesession->get("user");
    	//----------setup the header menu----------
    	$data["menuMyAds"]="";
    	$data["menuInbox"]="";
    	$data["menuInboxNum"]="0";
    	$data["menuPendingRequest"]="";
    	$data["menuPendingRequestNumber"]="0";
    	if(isset($userInfo)){
    		$menuCount=$this->getHeaderCount($userInfo["userID"]);
    		$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
    		$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
    	}
    	//----------------------------
    	if(empty($userInfo))
    	{
    		$errorMsg=$this->lang->line("PostPleaseLoginFirst");
    		$data['error']= $errorMsg;
    		$data["prevURL"]=$prevURL;
    		$data['redirectToWhatPage']="Login Page";
    		$data['redirectToPHP']=base_url().MY_PATH."home/loginPage?prevURL=".base_url().MY_PATH."newPost";
    		$data["successTile"]=$this->lang->line("successTile");
    		$data["failedTitle"]=$this->lang->line("failedTitle");
    		$data["goToHomePage"]=$this->lang->line("goToHomePage");
    		$this->load->view('failedPage', $data);
    		return;
    	}
    	 
    	$userInfo=$this->nativesession->get("user");
    	$userID=$userInfo["userID"];
    	$userName=$userInfo["username"];
    	
    	$postInfo=$this->post->getPostByPostID($postID);
    	if($postInfo[0]->userID!=$userID)
    	{
    		$errorMsg=$this->lang->line("PostPleaseLoginFirst");
    		$data['error']= $errorMsg;
    		$data["prevURL"]=$prevURL;
    		$data['redirectToWhatPage']="Previous Page";
    		$data['redirectToPHP']=$prevURL;
    		$data["successTile"]=$this->lang->line("successTile");
    		$data["failedTitle"]=$this->lang->line("failedTitle");
    		$data["goToHomePage"]=$this->lang->line("goToHomePage");
    		$this->load->view('failedPage', $data);
    		return;
    	}
    	
    	/*** the upload directory ***/
    	$upload_dir= 'USER_IMG';
    
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
    
    	$title = $this->input->post('Adtitle',true);
    	$cat = $this->input->post('category-group',true);
    	$tags = $this->input->post('tagsInput',true);
    	$des = $this->input->post('descriptionTextarea',true);
    	$price = $this->input->post('price',true);
    	$recaptcha = $this->input->post('g-recaptcha-response',true);
    	//        $negotiable = $this->input->post('negotiable');
    	if (isset($_POST['negotiable'])) {
    		$negotiable = true;
    	}else
    	{
    		$negotiable = false;
    	}
    	if (isset($_POST['itemQualityGroup'])) {
    		$quality = $_POST['itemQualityGroup'];
    	}else
    	{
    		$quality = '';
    	}
    
    
    	$locID2=$this->input->post('locID2');
    
    	 
//     	if($negotiable)
//     	{
//     		if($quality == 'N')
//     		{
//     			$negoQValue = 'NY';
//     		}else if($quality == 'U')
//     		{
//     			$negoQValue = 'UY';
//     		}else
//     			$negoQValue = 'Y';
//     	}else
//     	{
//     		if($quality == 'N')
//     		{
//     			$negoQValue = 'NN';
//     		}else if($quality == 'U')
//     		{
//     			$negoQValue = 'UN';
//     		}else
//     			$negoQValue = 'N';
//     	}
    	$tempExpriyDate = date_create('2599-01-01');
    	$postInfo = array(
    			'userID'   => intval($userID),
    			'viewCount'   =>  "1",
    			'catID'   =>  intval($cat),
    			'locID'   =>intval($locID2),
    			'itemName' => $title,
    			'itemNameCH'  =>  $title,
    			'itemPrice' => $price,
    			'itemQual' => "1",
    			'currency' => "HKD",
    			'description' => $des,
    			'paymentMethod' => 'U',
    			'status'  => 'U',
    			'newUsed'=> $quality,
    			'infoDisplayStatus'  => $negotiable,
    			'createDate'  => date("Y-m-d H:i:s"),
    			'expriyDate' => date_format($tempExpriyDate, 'Y-m-d H:i:s')
    	);
    
    	$row = $this->post->update($postInfo, $postID);
    
    	if($row<=0 or $postID==null or $postID==0)
    	{
    		$errorMsg=$this->lang->line("PostErrorZeroPostID");
    		$data['error']= $errorMsg;
    		$data["prevURL"]=$prevURL;
    		$data['redirectToWhatPage']="New Post Page";
    		$data['redirectToPHP']=base_url().MY_PATH."newPost";
    		$data["successTile"]=$this->lang->line("successTile");
    		$data["failedTitle"]=$this->lang->line("failedTitle");
    		$data["goToHomePage"]=$this->lang->line("goToHomePage");
    		$this->load->view('failedPage', $data);
    		return;
    	}
    
    	 
    	for($i=1; $i<=5; $i++)
    	{
    
    		$imgPath = $upload_dir . '/'.$userName.'_'.(new DateTime())->format('Y-m-d-H-i-s').'_'.$i.'.png';
    		$thumb_fileName=$userName.'_'.(new DateTime())->format('Y-m-d-H-i-s').'_thumb_'.$i.'.png';
    		$main_fileName=$userName.'_'.(new DateTime())->format('Y-m-d-H-i-s').'_main_'.$i.'.png';
    		 
    		$config['file_name'] = basename($imgPath);
    		$config['upload_path'] = $upload_dir;
    		$config['allowed_types'] = 'gif|jpg|png|bmp';
    		 
    		$this->upload->initialize($config);
    		if ( ! $this->upload->do_upload("image".$i))
    		{
    			if($this->upload->display_errors()<>'')
    			{
    				$hasImage=$this->input->post("image".$i);
    				if(!isset($hasImage) or empty($hasImage))
    					continue;
    				$error = $this->upload->display_errors();
    				$data=array('error'=> $error);
    				$data["prevURL"]=$prevURL;
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
    			$config2['width'] = 320;
    			$config2['height'] = 320;
    			//$this->load->library('image_lib',$config2);
    			$this->image_lib->initialize($config2);
    			if ( !$this->image_lib->resize()){
    				if($this->image_lib->display_errors()<>'')
    				{
    					$error = $this->image_lib->display_errors();
    					$data=array('error'=> $error);
    					$data["prevURL"]=$prevURL;
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
    				$config2['width'] = 800;
    				$config2['height'] = 800;
    				//$this->load->library('image_lib',$config3);
    				$this->image_lib->initialize($config2);
    				if ( !$this->image_lib->resize()){
    					if($this->image_lib->display_errors()<>'')
    					{
    						$error = $this->image_lib->display_errors();
    						$data=array('error'=> $error);
    						$data["prevURL"]=$prevURL;
    						$data['redirectToWhatPage']="New Post Page";
    						$data['redirectToPHP']=base_url().MY_PATH."newPost";
    						$this->load->view('failedPage', $data);
    						$data["successTile"]=$this->lang->line("successTile");
    						$data["failedTitle"]=$this->lang->line("failedTitle");
    						$data["goToHomePage"]=$this->lang->line("goToHomePage");
    						return;
    					}
    				}
    				else
    				{
    	     
    					$imgInfo['postID'] = $postID;
    					$imgInfo['userID'] = $userID;
    					$imgInfo['picturePath'] = $upload_dir_resize;
    					$imgInfo['pictureName'] = $main_fileName;
    					$imgInfo['status'] = 'U';
    					$imgInfo['thumbnailPath'] = $upload_dir_resize;
    					$imgInfo['thumbnailName']  =$thumb_fileName;
    					$data['returnValue'] = $this->picture->insert($imgInfo);
    				}
    			}
    		}
    	}
    
    	if($tags != null && $tags !== '')
    	{
    		$myTags = explode(',', $tags);
    		foreach ($myTags as $value) {
    
    			$postInfo = array(
    					'postID'   => $postID,
    					'tag'   =>  $value,
    					'createDate'   =>  date("Y-m-d H:i:s")
    			);
    			//echo "$value <br>";
    			$this->tag->insert($postInfo);
    		}
    	}
    
    	$errorMsg=$this->lang->line("PostSuccess");
    	$data["error"]=$errorMsg;
    	$data["prevURL"]=$prevURL;
    	$data['redirectToWhatPage']="Previous Page";
    	if($prevURL=="")
    		$data['redirectToPHP']=base_url();
    	else
    		$data['redirectToPHP']=$prevURL;
    	$data["successTile"]=$this->lang->line("successTile");
    	$data["failedTitle"]=$this->lang->line("failedTitle");
    	$data["goToHomePage"]=$this->lang->line("goToHomePage");
    	$this->load->view('successPage', $data);
    	//}
    }
	public function getChildLocation($parentID)
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
	function addDayswithdate($date,$days){
	
		$date = strtotime("+".$days." days", strtotime($date));
		return  date("Y-m-d", $date);
	
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
	
	public function validateDescLength(){
		$des = $this->input->post('descTextarea',true);
		$content=htmlentities($des, ENT_QUOTES, 'UTF-8');
		if(!ExceedDescLength($content, DESCLENGTHINNEWPOST)){
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i> Valid Description</span></em>';
		}else{
			$data['status'] = 'F';
			$data['class'] = "has-error";
			if(strlen(trim($content))==0)
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Zero description length!</div>';
			else if(ShortDescLength($content, DESCMINLENGTHINNEWPOST))
	        	$data['message'] ='<div class="alert alert-danger"><strong>Warning!</strong> '.$this->lang->line("MinDescLength").'</div>';
	       	else 
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Exceed description length!</div>';
			$data['icon'] = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Exceed description length</span></em>';
		}
		echo json_encode($data);
	}
}