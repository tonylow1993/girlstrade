<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class footer  extends CI_Controller {
	var $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		$this->load->helper('language');
		$this->load->helper('form');
		$this->load->helpers('site');
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
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		
		$this->load->helper('url');
		
		$this->load->database();
		$this->load->model('post_model');
		$this->load->model('picture_model');
		$this->load->model("user_model");
		$this->load->model("useremail_model");
		$this->load->model("userpassword_model");
		$this->load->model("admin_model");
        $this->load->model("users_model");
		$this->load->model('blog_model');
		$this->load->model('userinfo_model');
		$this->load->model('userstat_model');
		$this->load->model('messages_model');
        $this->load->model('tradecomments_model');
        $this->load->model('itemcomments_model');
        $this->load->model('abusemessages_model');
        $this->load->model('contacttype_model');
        $this->load->model('contact_model');
        $this->load->model('pagevisited_model');
	}
	public function getAboutUS()
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
		$data["lang_label"]=$this->nativesession->get("language");
		//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
		//----------------------------
		$this->load->view("about-us", $data);
	}
	
	public function getContactUS()
	{
		log_message('error', 'GET CONTACT PAGE.');
		if($this->nativesession->get('language') && $this->nativesession->get('language') == "chinese")
        {
            $data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW'></script>";
        }else
        {
            $data["captchaJS"] = "<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>";
        }
        $this->nativesession->set("lastPageVisited","contactUS");
            
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
		
		$data["result"]=$this->contacttype_model->getContactType();
		//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
		//----------------------------
		$this->load->view("contact", $data);
	
	}
	
	public function getFQA()
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
		$data["titleFAQ"]=$this->lang->line("titleFAQ");
		$data["lang_label"]=$this->nativesession->get("language");
		//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
		//----------------------------
			
		$this->load->view("faq", $data);
	
	}
	
	public function getPrivacy()
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
		$data["lang_label"]=$this->nativesession->get("language");
		//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
		//----------------------------
		$this->load->view("privacy", $data);
	
	}
	
	public function getTerms()
	{
		$data["Home"] = $this->lang->line("Home");
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
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
		$data["Terms_and_Conditions"]=$this->lang->line("Terms_and_Conditions");
		$data["Logout"]=$this->lang->line("Logout");
		$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		$data["lang_label"]=$this->nativesession->get("language");
		//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
		//----------------------------
		$this->load->view("terms", $data);
	
	}
	
	public function testSuccess(){
            	
   		$data["lang_label"]=$this->nativesession->get("language");
    	$data["PrevURL"]=base_url();
		$this->nativesession->set("lastPageVisited","contactUs");
		$data['redirectToPHP']=base_url().MY_PATH."home/signupPage";
		$data["goToHomePage"]=$this->lang->line("goToHomePage");
            	 
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
		$data["About_us"] = $this->lang->line("About_us");
		$data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
		$data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
		$data["Contact_us"] = $this->lang->line("Contact_us");
		log_message('debug', 'Contact Us successful');
		$data["FAQ"] = $this->lang->line("FAQ");
		$data["Index_Footer1"] = $this->lang->line("Index_Footer1");
		$data["Call_Now"] = $this->lang->line("Call_Now");
		$data["Tel"] = $this->lang->line("Tel");
		
		$data["Login"]=$this->lang->line("Login");;
		$data["Signup"]=$this->lang->line("Signup");
		$data["Profile"]=$this->lang->line("Profile");
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
			$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo["userID"]); //$menuCount["inboxMsgCount"]; //
			$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
		}
		//----------------------------
		$this->load->view('contactSuccessful', $data);
		return;
	}
	public function addcontact(){
			//-------------------------------captcha------------------------------
		$userInfo=$this->nativesession->get("user");
		
		//----------setup the header menu----------
		$data["menuMyAds"]="";
		$data["menuInbox"]="";
		$data["menuInboxNum"]="0";
		$data["menuPendingRequest"]="";
		$data["menuPendingRequestNumber"]="0";
		if(isset($userInfo)){
			$menuCount=$this->getHeaderCount($userInfo["userID"]);
			$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo["userID"]); //$menuCount["inboxMsgCount"]; //
			$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
		}
		//----------------------------
		
		
		
		
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
                	$data['redirectToWhatPage']="Contact Us Page";
                	$data['redirectToPHP']=base_url().MY_PATH."footer/getContactUS";
                	
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
            	$data['redirectToPHP']=base_url().MY_PATH."footer/getContactUS";
            	$data["successTile"]=$this->lang->line("successTile");
            	$data["failedTitle"]=$this->lang->line("failedTitle");
            	$data["goToHomePage"]=$this->lang->line("goToHomePage");
            	
            	$this->load->view('failedPage', $data);
            	return;
             
            }
            //-------------------------end of checking captcha
		
		$result=array();
		$result['name'] = $this->input->post('name');
		log_message('error', '...'.$result['name']);
		$result['phone'] = $this->input->post('phone');
		$result['email'] = $this->input->post('email');
		$result['message'] = $this->input->post('message');
		

		$result['message']=nl2br(htmlentities($result['message'], ENT_QUOTES, 'UTF-8'));
		
		if(ExceedDescLength($result['message'], DESCLENGTHINCONTACTPAGE)){
			$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
			if(empty($result['message']) || strlen(trim($result['message']))==0)
				$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
			if(ShortDescLength($result['message'], DESCMINLENGTHINNEWPOST))		
				$errorMsg=sprintf($this->lang->line("MinDescLength"));
					
			$data["error"]=$errorMsg;
			$data["prevURL"]=base_url();;
			$data['redirectToWhatPage']=$this->lang->line("homepage");
			if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
				$data['redirectToPHP']=base_url();
			else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
				$data['redirectToPHP']=base_url();
			else {
				$data['redirectToPHP']=$_SESSION["previousUrl"];
				if(isset($prevprevURL) && strcmp($prevprevURL,"")<>0)
					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
			}
			$data["successTile"]=$this->lang->line("successTile");
			$data["failedTitle"]=$this->lang->line("failedTitle");
			$data["goToHomePage"]=$this->lang->line("goToHomePage");
			$this->load->view('failedPage', $data);
			return;
		}
		
		
		
		
		
		
		
		$result["contactTypeID"]=$this->input->post('contactTypeID');
		$result['createDate']=date("Y-m-d H:i:s"); 
		$result['updateDate']=date("Y-m-d H:i:s"); 
		$result['status'] = "U";
		$row=$this->contact_model->addContactModel($result);
		log_message('error', 'ADDING');
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
		$thread["page_visit"]=PageContactUs;
		$this->pagevisited_model->insert($thread);
		
		//$this->getContactUS();
		$this->testSuccess();
	}
	

}
