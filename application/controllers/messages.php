<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class messages extends CI_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		
		
	      
			$this->load->helper('url');
			$this->load->database();
			$this->load->helpers('site');
			
			$this->load->model('messages_model');
			$this->load->model('users_model');
			$this->load->model("userinfo_model");
            $this->load->model('post_model', 'post');
            $this->load->model('picture_model', 'picture');
            $this->load->model("requestpost_model");
            $this->load->helper('language');
            $this->load->model("savedAds_model");
            $this->load->model("abusemessages_model");
            $this->load->model("useremail_model");
            $this->load->model('tradecomments_model');
            $this->load->model('admin_model');
            $this->load->model('mailtemplate_model');
            $this->load->model('userstat_model');
            $this->load->model('sellerfeedback_model');
            $this->load->model('buyerfeedback_model');
            $this->load->model('buyermessage_model');
            $this->load->model('userInfoSendEmail_model');
            $this->load->model('sendEmailLog_model');
            
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
            //$this->load->model('category_model', 'cat');
            //$this->load->model('tag_model', 'tag');
            //$this->load->model('location_model');
		}
        
        public function index()
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
			redirect(base_url());
		}
function addDayswithdate($date,$days){

    $date = strtotime("+".$days." days", strtotime($date));
    return  date("Y-m-d", $date);

}
		public function directSend($postID)
		{
			try {
			if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
			}else if(isset($_SESSION["previousUrl"])){
				$prevURL=$_SESSION["previousUrl"];
			}
			$prevprevURL="";
			if(isset($_GET["prevprevURL"])){
				$prevprevURL=$_GET["prevprevURL"];
			}
			
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
				
			$userInfo=$this->nativesession->get("user");
			$username=$userInfo["username"];
			$fUserID=0;
			if(!empty($userInfo) and isset($userInfo) and $userInfo<> null and $userInfo["userID"]<>0)
				$fUserID=$userInfo["userID"];
			
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
				if($fUserID==0)
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
							return;
				}
				
			$postInfo=$this->post->getPostByPostID($postID);
			$userID=$postInfo[0]->userID;
			
					
			$messageArray=array(
			'userID'=>$fUserID,
			'postID'=>$postID,
			'status'=>'U',
			'viewOption'=>'U',
			'createDate'=>date("Y-m-d H:i:s"),
			'expriyDate'=>$this->addDayswithdate(date("Y-m-d H:i:s"), DIRECTSENDEXPIRYDAYS));
			if(intval($userID)==intval($fUserID) and $fuseRID<>0)
			{
				$errorMsg="You cannot request a message from your own post";
				$data["lang_label"]=$this->nativesession->get("language");
				$data["PrevURL"]=$prevURL;
				$data["error"]=$errorMsg;
				$data['redirectToWhatPage']="Previous Page";
				if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
					$data['redirectToPHP']=base_url();
				else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
					$data['redirectToPHP']=base_url();
	 			else {
	 				$data['redirectToPHP']=$_SESSION["previousUrl"];
	 				if(strcmp($prevprevURL,"")<>0)
	 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
	 			}
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
			}
			else 
			{
				
				$DailyMaxTimes=$this->requestpost_model->getMaxDailyTimesBuyerDirectSend($postID, $fUserID);
				
				if($DailyMaxTimes>=MAXTIMEDAILY_DRECTSENDFROMBUYER && MAXTIMEDAILY_DRECTSENDFROMBUYER<UNLIMITEDTIMES){
					$errorMsg=$this->lang->line("ExceedMAXTIMEDAILY_DRECTSENDFROMBUYER");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
				}
				$email=$this->useremail_model->getUserEmailByUserID($userID);
					
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
				$result=$this->requestpost_model->insert($messageArray);
				if($result)
				{
					$this->admin_model->updateStatByUserID($fUserID);
					$this->admin_model->updateStatByUserID($userID);
						
					$usernameArr=$this->users_model->get_user_by_id($userID);
					$username=$usernameArr[0]->username;
					$path=base_url().MY_PATH."viewItem/index/".$postID;
					$msg=$this->mailtemplate_model->SendEmailMsgForDirectSendToSeller( $username, $path, $postInfo[0]->itemName);
					$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForDirectSendToSeller(), DIRECTSENDEMAIL);
					
					$this->admin_model->getDirectSendStatByUserID($fUserID);
					
					$errorMsg=$this->lang->line("MessagesDirectSendSuccess");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
	 				$data['redirectToPHP']=$_SESSION["previousUrl"];
	 				if(strcmp($prevprevURL,"")<>0)
	 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
	 				}
	 				$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					
					//----------setup the header menu----------
					$data["menuMyAds"]="";
					$data["menuInbox"]="";
					$data["menuInboxNum"]="0";
					$data["menuPendingRequest"]="";
					$data["menuPendingRequestNumber"]="0";
					if(isset($userInfo)){
						$menuCount=$this->getHeaderCount($fUserID);
						$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($fUserID); //$menuCount["inboxMsgCount"]; //
						$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
					}
					//----------------------------
					$this->load->view('successPage', $data);		
				}
				else 
				{	$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
		 				$data['redirectToPHP']=$_SESSION["previousUrl"];
		 				if(strcmp($prevprevURL,"")<>0)
		 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
		 			}
		 			$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
			
				}
			}
			}catch (Exception $e) {
    			echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		public function deleteAbuseMessage($postID){
			try{
				if(isset($_GET["prevURL"])){
					$prevURL=$_GET["prevURL"];
					$_SESSION["previousUrl"]=$prevURL;
				}else if(isset($_SESSION["previousUrl"])){
					$prevURL=$_SESSION["previousUrl"];
				}
			
				$prevprevURL="";
				if(isset($_GET["prevprevURL"])){
					$prevprevURL=$_GET["prevprevURL"];
				}
				$expired= $this->nativesession->_session_id_expired();
				if($expired){
					redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
			
			
					$userInfo=$this->nativesession->get("user");
					$fUserID=0;
					if(!empty($userInfo))
						$fUserID=$userInfo["userID"];
			
						//----------setup the header menu----------
						$data["menuMyAds"]="";
						$data["menuInbox"]="class=\"active\"";
						$data["menuInboxNum"]="0";
						$data["menuPendingRequest"]="";
						$data["menuPendingRequestNumber"]="0";
						if(isset($userInfo)){
							$menuCount=$this->getHeaderCount($userInfo["userID"]);
							$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo["userID"]); //$menuCount["inboxMsgCount"]; //
							$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
						}
						//----------------------------
							
							
						if($fUserID==0)
						{
							$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
							$data["lang_label"]=$this->nativesession->get("language");
							$data["PrevURL"]=$prevURL;
							$data["error"]=$errorMsg;
							$data['redirectToWhatPage']="Previous Page";
							if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
								$data['redirectToPHP']=base_url();
								else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
									$data['redirectToPHP']=base_url();
									else {
					 				$data['redirectToPHP']=$_SESSION["previousUrl"];
					 				if(strcmp($prevprevURL,"")<>0)
					 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
					 			}
					 			$data["successTile"]=$this->lang->line("successTile");
					 			$data["failedTitle"]=$this->lang->line("failedTitle");
					 			$data["goToHomePage"]=$this->lang->line("goToHomePage");
					 			$this->load->view('failedPage', $data);
					 			return;
						}
			
						$comment=nl2br(htmlentities($this->input->post('messagetext2'), ENT_QUOTES, 'UTF-8'));
			
						if(ExceedDescLength($comment, DESCLENGTHINNEWPOSTBACKEND)){
							$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
							if(empty($comment) || strlen(trim($comment))==0)
								$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
							if(ShortDescLength($comment, DESCMINLENGTHINNEWPOST))
								$errorMsg=sprintf($this->lang->line("MinDescLength"));
							$data["error"]=$errorMsg;
							$data["prevURL"]=$prevURL;
							$data['redirectToWhatPage']="Previous Page";
							$data['redirectToWhatPage']="Previous Page";
							if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
								$data['redirectToPHP']=base_url();
								else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
									$data['redirectToPHP']=base_url();
									else {
					 				$data['redirectToPHP']=$_SESSION["previousUrl"];
					 				if(strcmp($prevprevURL,"")<>0)
					 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
									}
					 			$data["successTile"]=$this->lang->line("successTile");
					 			$data["failedTitle"]=$this->lang->line("failedTitle");
					 			$data["goToHomePage"]=$this->lang->line("goToHomePage");
					 			$this->load->view('failedPage', $data);
					 			return;
						}
						$messageArray=array(
								'postID'=>intval($postID),
								'fUserID'=>intval($fUserID),
								'status' => "U",
								'createDate' => date("Y-m-d H:i:s"),
								'reportreason'=> $this->input->post('reportreason'),
								'content'=>$comment,
								'recipientName'=>$this->input->post('recipientname1'),
								'senderEmail'=>$this->input->post('recipientemail'),
								'recipientPhoneNumber'=>$this->input->post('recipientPhoneNumber1'));
						$email=$this->useremail_model->getUserEmailByUserID($fUserID);
							
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
			
						//print_r($messageArray);
						$messageResult=false; //$this->abusemessages_model->insert($messageArray);
						if($messageResult)
						{
							$email["email"]=HOST_EMAIL;
							$msg=$this->mailtemplate_model->SendEmailMsgForHostOfAbuseMsg();
							$this->sendAuthenticationEmail($email, $msg,$this->mailtemplate_model->SendEmailMsgForHostOfAbuseMsg(), DELETEABUSEMESSAGESENDEMAIL );
							$errorMsg=$this->lang->line("MessagesSendError");
							$data["lang_label"]=$this->nativesession->get("language");
							$data["PrevURL"]=$prevURL;
							$data["error"]=$errorMsg;
							$data['redirectToWhatPage']="Previous Page";
							if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
								$data['redirectToPHP']=base_url();
								else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
									$data['redirectToPHP']=base_url();
									else {
					 				$data['redirectToPHP']=$_SESSION["previousUrl"];
					 				if(strcmp($prevprevURL,"")<>0)
					 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
									}
									$data["successTile"]=$this->lang->line("successTile");
									$data["failedTitle"]=$this->lang->line("failedTitle");
									$data["goToHomePage"]=$this->lang->line("goToHomePage");
									$this->load->view('successPage', $data);
						}
						else
						{
							$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
							$data["lang_label"]=$this->nativesession->get("language");
							$data["PrevURL"]=$prevURL;
							$data["error"]=$errorMsg;
							$data['redirectToWhatPage']="Previous Page";
							if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
								$data['redirectToPHP']=base_url();
								else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
									$data['redirectToPHP']=base_url();
									else {
										$data['redirectToPHP']=$_SESSION["previousUrl"];
										if(strcmp($prevprevURL,"")<>0)
											$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
									}
									$data["successTile"]=$this->lang->line("successTile");
									$data["failedTitle"]=$this->lang->line("failedTitle");
									$data["goToHomePage"]=$this->lang->line("goToHomePage");
									$this->load->view('failedPage', $data);
						}
			
			}
			catch(Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
				
		}
		
		
		public function insertAbuseMessage($postID){
			try{
			if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
		}else if(isset($_SESSION["previousUrl"])){
			$prevURL=$_SESSION["previousUrl"];
		}
		
		$prevprevURL="";
		if(isset($_GET["prevprevURL"])){
			$prevprevURL=$_GET["prevprevURL"];
		}
		$expired= $this->nativesession->_session_id_expired();
		if($expired){
			redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
				
		
				$userInfo=$this->nativesession->get("user");
				$fUserID=0;
				if(!empty($userInfo))
					$fUserID=$userInfo["userID"];
				
					//----------setup the header menu----------
					$data["menuMyAds"]="";
					$data["menuInbox"]="class=\"active\"";
					$data["menuInboxNum"]="0";
					$data["menuPendingRequest"]="";
					$data["menuPendingRequestNumber"]="0";
					if(isset($userInfo)){
						$menuCount=$this->getHeaderCount($userInfo["userID"]);
						$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo["userID"]); //$menuCount["inboxMsgCount"]; //
						$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
					}
					//----------------------------
					
					
				if($fUserID==0)
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
		 				$data['redirectToPHP']=$_SESSION["previousUrl"];
		 				if(strcmp($prevprevURL,"")<>0)
		 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
		 			}
		 			$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
					return;
				}
				
				$comment=nl2br(htmlentities($this->input->post('messagetext2'), ENT_QUOTES, 'UTF-8'));
				
				if(ExceedDescLength($comment, DESCLENGTHINNEWPOSTBACKEND)){
					$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
					if(empty($comment) || strlen(trim($comment))==0)
						$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
					if(ShortDescLength($comment, DESCMINLENGTHINNEWPOST))
						$errorMsg=sprintf($this->lang->line("MinDescLength"));
					$data["error"]=$errorMsg;
					$data["prevURL"]=$prevURL;
					$data['redirectToWhatPage']="Previous Page";
					$data['redirectToWhatPage']="Previous Page";
						if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
							$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
						else {
		 				$data['redirectToPHP']=$_SESSION["previousUrl"];
		 				if(strcmp($prevprevURL,"")<>0)
		 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
		 				}
		 			$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
					return;
				}
				$email=$this->useremail_model->getUserEmailByUserID($fUserID);
				
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
				
				$messageArray=array(
						'postID'=>intval($postID),
						'fUserID'=>intval($fUserID),
						'status' => "U",
						'createDate' => date("Y-m-d H:i:s"),
						'reportreason'=> $this->input->post('reportreason'),
						'content'=>$comment,
						'recipientName'=>$this->input->post('recipientname1'),
						'senderEmail'=>$this->input->post('recipientemail'),
						'recipientPhoneNumber'=>$this->input->post('recipientPhoneNumber1'));
				
				
				
				//print_r($messageArray);
					$messageResult=$this->abusemessages_model->insert($messageArray);
					if($messageResult)
					{
						$email["email"]=HOST_EMAIL;
						$msg=$this->mailtemplate_model->SendEmailMsgForHostOfAbuseMsg();
						$this->sendAuthenticationEmail($email, $msg,$this->mailtemplate_model->SendEmailMsgForHostOfAbuseMsg() , INSERTABUSEMESSAGESENDEMAIL);
						$errorMsg=$this->lang->line("MessagesSendError");
						$data["lang_label"]=$this->nativesession->get("language");
						$data["PrevURL"]=$prevURL;
						$data["error"]=$errorMsg;
						$data['redirectToWhatPage']="Previous Page";
						if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
							$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
						else {
		 				$data['redirectToPHP']=$_SESSION["previousUrl"];
		 				if(strcmp($prevprevURL,"")<>0)
		 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
		 				}
		 				$data["successTile"]=$this->lang->line("successTile");
						$data["failedTitle"]=$this->lang->line("failedTitle");
						$data["goToHomePage"]=$this->lang->line("goToHomePage");
						
						//----------setup the header menu----------
						$data["menuMyAds"]="";
						$data["menuInbox"]="";
						$data["menuInboxNum"]="0";
						$data["menuPendingRequest"]="";
						$data["menuPendingRequestNumber"]="0";
						if(isset($userInfo)){
							$menuCount=$this->getHeaderCount($fUserID);
							$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($fUserID); //$menuCount["inboxMsgCount"]; //$this->messages_model->getUnReadInboxMessage($fUserID);
							$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
						}
						//----------------------------
						$this->load->view('successPage', $data);
					}
					else
					{
						$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
						$data["lang_label"]=$this->nativesession->get("language");
						$data["PrevURL"]=$prevURL;
						$data["error"]=$errorMsg;
						$data['redirectToWhatPage']="Previous Page";
						if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
							$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
						else {
			 				$data['redirectToPHP']=$_SESSION["previousUrl"];
			 				if(strcmp($prevprevURL,"")<>0)
			 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
			 			}
			 			$data["successTile"]=$this->lang->line("successTile");
						$data["failedTitle"]=$this->lang->line("failedTitle");
						$data["goToHomePage"]=$this->lang->line("goToHomePage");
						$this->load->view('failedPage', $data);
					}
				
				}
				catch(Exception $e)
				{
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			
		}
		public function insertMessage($postID, $maxLengthDesc=300)
		{
			
			try {
			if(isset($_GET["prevURL"])){
				$prevURL=$_GET["prevURL"];
				$_SESSION["previousUrl"]=$prevURL;
			}else if(isset($_SESSION["previousUrl"])){
				$prevURL=$_SESSION["previousUrl"];
			}
			$prevprevURL="";
			if(isset($_GET["prevprevURL"])){
				$prevprevURL=$_GET["prevprevURL"];
			}
		$expired= $this->nativesession->_session_id_expired();
		if($expired){
			redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); 
			return;}
					
			$userInfo=$this->nativesession->get("user");
			$username=$userInfo["username"];
			$fUserID=0;
			if(!empty($userInfo))
				$fUserID=$userInfo["userID"];
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
				if($fUserID==0)
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
							return;
				}
			$postInfo=$this->post->getPostByPostID($postID);
			$userID=$postInfo[0]->userID;	
			//var_dump($postInfo);
			$content=nl2br(htmlentities($this->input->post('message-text'), ENT_QUOTES, 'UTF-8'));
			
			if(ExceedDescLength($content, $maxLengthDesc)){
				$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
				if(empty($content) || strlen(trim($content))==0)
					$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
				if(ShortDescLength($content, DESCMINLENGTHINNEWPOST))
					$errorMsg=sprintf($this->lang->line("MinDescLength"));
							
				
				$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
		 				$data['redirectToPHP']=$_SESSION["previousUrl"];
		 				if(strcmp($prevprevURL,"")<>0)
		 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
		 			}
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
			
			
			
			
			
			
			$messageArray=array(
			'postID'=>intval($postID),
			'userID'=>intval($userID),
			'fUserID'=>intval($fUserID),
			'parentID'=> 0,
			'status' => "Op",
			'readflag'=>'N',
            'createDate' => date("Y-m-d H:i:s"),
			//'fUserID'=>intval($this->input->post('fuserID')),
			//'title'=>$this->input->post('title'),
			'content'=>$content,
			'recipientName'=>$this->input->post('recipient-name'),
			'senderEmail'=>$this->input->post('sender-email'),
			'recipientPhoneNumber'=>$this->input->post('recipient-Phone-Number'));
			//var_dump($messageArray);
			if(intval($userID)==intval($fUserID) and $fUserID<>0)
			{
						
				$errorMsg=$this->lang->line("MessagesSendFromYourOwnError");
				$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
		 				$data['redirectToPHP']=$_SESSION["previousUrl"];
		 				if(strcmp($prevprevURL,"")<>0)
		 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
		 			}
		 			$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
			}
			else {
				
				$DailyMaxTimes=$this->messages_model->getMaxDailyTimesBuyerSendMsg($postID, $fUserID);
				
				if($DailyMaxTimes>=MAXTIMEDAILY_SENDMSGFROMBUYER && MAXTIMEDAILY_SENDMSGFROMBUYER<UNLIMITEDTIMES){
					$errorMsg=$this->lang->line("ExceedMAXTIMEDAILY_SENDMSGFROMBUYER");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
		 				$data['redirectToPHP']=$_SESSION["previousUrl"];
		 				if(strcmp($prevprevURL,"")<>0)
		 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
		 			}
		 			$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
				}
				
				$TotalMaxTimes=$this->messages_model->getMaxTotalTimesBuyerSendMsg($postID, $fUserID);
				
				if($TotalMaxTimes>=MAXTIME_SENDMSGFROMBUYER && MAXTIME_SENDMSGFROMBUYER<UNLIMITEDTIMES){
					$errorMsg=$this->lang->line("ExceedMAXTIME_SENDMSGFROMBUYER");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
		 				$data['redirectToPHP']=$_SESSION["previousUrl"];
		 				if(strcmp($prevprevURL,"")<>0)
		 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
		 			}
		 			$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
				}
				$email=$this->useremail_model->getUserEmailByUserID($userID);
					
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
				
				$messageID=$this->messages_model->insert($messageArray);
				if($messageID)
				{
					$usernameArr=$this->users_model->get_user_by_id($userID);
					$username=$usernameArr[0]->username;
					$path=base_url().MY_PATH."home/loginPage";
					$msg=$this->mailtemplate_model->SendEmailMsgForSeller( $username, $path );
					$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForSeller(), INSERTMESSAGESENDEMAIL);
					
					$this->admin_model->getMessageStatByUserID($fUserID);
					$this->admin_model->getMessageStatByUserID($userID);
						
					$errorMsg=$this->lang->line("MessagesSendError");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
	 				$data['redirectToPHP']=$_SESSION["previousUrl"];
	 				if(strcmp($prevprevURL,"")<>0)
	 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
	 				}
	 				$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					
					$this->load->view('successPage', $data);
				}
				else 
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
		 				$data['redirectToPHP']=$_SESSION["previousUrl"];
		 				if(strcmp($prevprevURL,"")<>0)
		 					$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
		 			}
		 			$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
				}
			}
			}
			catch(Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		
		public function approveSavedAds()
		{$expired= $this->nativesession->_session_id_expired();
		if($expired){
			$this->loginPage(); return;}
		
			try{
			$userInfo=$this->nativesession->get("user");
			$fUserID=0;
			$username="";
			if(!empty($userInfo)) {
				$fUserID=$userInfo["userID"];
			}
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login in to save the item</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
				return;
			}
			
			
			$messageID = explode("-", $this->input->post('messageID'));
			$postID=$messageID[0];
			$userID=$messageID[1];
						
			$where=array('postID'=>intval($postID),
					'userID'=>intval($userID));
			$messageArray=array('status' => "A");
			$email=$this->useremail_model->getUserEmailByUserID($userID);
			
			if($this->sendEmailLog_model->getNoOfCountByUserID($email['userID'], $email["email"])>MAXTIMESSENDEMAIL){
				$errorMsg=sprintf($this->lang->line("HomeExceedMaxTimesSendEmail"),MAXTIMESSENDEMAIL,MAXTIMESMINUTESSENDEMAIL);
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> '.$errorMsg.'</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
				return;
			}
			$messageResult=$this->requestpost_model->update($messageArray,$where);
			if($messageResult){
				$this->admin_model->updateStatByUserID($fUserID);
				$this->admin_model->updateStatByUserID($userID);
					
				$postInfo=$this->post->getPostByPostID($postID);
				$title=$postInfo[0]->itemName;
				
				$usernameArr=$this->users_model->get_user_by_id($userID);
					$username=$usernameArr[0]->username;
					$path=base_url().MY_PATH."viewItem/index/".$postID;
					$msg=$this->mailtemplate_model->SendEmailMsgForDirectSendApproveFromSeller($username, $path, $title );
					$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForDirectSendApproveFromSeller($title), APPROVEDIRECTSEND);
					
				
				$data['status'] = 'A';
				$data['class'] = "has-success";
				$data['message'] = '';
				$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
				echo json_encode($data);
			}
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>Error</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
					
			}
			}catch(Exception $ex){
				$exMessage=$ex->getMessage();
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>'.$exMessage.'</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
			}
		}
		
		public function sendEmailForApproveReject($userID)
		{
// 			$postInfo=$this->post->getPostByPostID($postID);
// 							$userID=$postInfo[0]->fUserID;
			$usernameArr=$this->users_model->get_user_by_id($userID);
					$username=$usernameArr[0]->username;
					$email=$this->useremail_model->getUserEmailByUserID($userID);
						
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
					$path=base_url().MY_PATH."home/loginPage";
					$msg=$this->mailtemplate_model->SendEmailMsgForSeller( $username, $path );
					$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForSeller(), sendEmailForApproveReject);
						
		}
		public function rejectSavedAds()
		{
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				$this->loginPage(); return;}
			
			try{
			$userInfo=$this->nativesession->get("user");
			$fUserID=0;
			if(!empty($userInfo))
				$fUserID=$userInfo["userID"];
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login in to save the item</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
				return;
			}
			
			$messageID = explode("-", $this->input->post('messageID'));
			$postID=$messageID[0];
			$userID=$messageID[1];
			$where=array('postID'=>intval($postID),
					'userID'=>intval($userID));
			$messageArray=array('status' => "R");
			$email=$this->useremail_model->getUserEmailByUserID($userID);
				
			if($this->sendEmailLog_model->getNoOfCountByUserID($email['userID'], $email["email"])>MAXTIMESSENDEMAIL){
				$errorMsg=sprintf($this->lang->line("HomeExceedMaxTimesSendEmail"),MAXTIMESSENDEMAIL,MAXTIMESMINUTESSENDEMAIL);
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> '.$errorMsg.'</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
				return;
			}
			$messageResult=$this->requestpost_model->update($messageArray,$where);
			if($messageResult){
				$postInfo=$this->post->getPostByPostID($postID);
				$title=$postInfo[0]->itemName;
				
			$usernameArr=$this->users_model->get_user_by_id($userID);
					$username=$usernameArr[0]->username;
					//$email=$this->useremail_model->getUserEmailByUserID($userID);
					$path=base_url().MY_PATH."home/loginPage";
					$msg=$this->mailtemplate_model->SendEmailMsgForDirectSendRejectFromSeller($username, $path, $title );
					$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForDirectSendRejectFromSeller($title), REJECTDIRECTSEND);
					
					$data['status'] = 'A';
				$data['class'] = "has-success";
				$data['message'] = '';
				$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
				echo json_encode($data);
			}
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>Error</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
					
			}
			}catch(Exception $ex){
				$exMessage=""; //$ex->getMessage();
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>'.$exMessage.'</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
			}
		}
		public function cancelArchivedAds($messageID)
		{
		
		}
// 		public function replyInboxMessage()   // unused, used replyMessage
// 		{
// 			$userInfo=$this->nativesession->get("user");
// 			$fUserID=0;
// 			if(!empty($userInfo))
// 				$fUserID=$userInfo["userID"];
// 			else {
// 				$data['status'] = 'F';
// 				$data['class'] = "has-error";
// 				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login in to save the item</div>';
// 				$data['icon'] = '<em><span style="color:red"></span></em>';
// 				echo json_encode($data);
// 				return;
// 			}
			
// 			$messageID = $this->input->post('messageID');
// 			$userID=$this->input->post('userID');
			
// 			// 			$messageArray=array(
// 			// 					'postID'=>intval($postID),
// 			// 					'userID'=>intval($fUserID),
// 			// 					'status' => "U",
// 			// 					'createDate' => date("Y-m-d H:i:s"));
// 			// 			$messageID=$this->savedAds_model->insert($messageArray);
// 			$data['status'] = 'A';
// 			$data['class'] = "has-success";
// 			$data['message'] = '';
// 			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
// 			echo json_encode($data);
// 		}
		public function replyMessage($postID, $messageID, $fromwhere="inbox", $maxLengthDesc=300)
		{
			if(strcmp($fromwhere,"inbox")==0)
				$prevURL=base_url().MY_PATH."home/getAccountPage/1";
			else
				$prevURL=base_url().MY_PATH."home/getAccountPage/10";
			
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
					
			$userInfo=$this->nativesession->get("user");
			$fUserID=0;
			if(!empty($userInfo)){
				$fUserID=$userInfo["userID"];
				$username=$userInfo["username"];
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
			if($fUserID==0)
			{
				$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
				$data["lang_label"]=$this->nativesession->get("language");
				$data["PrevURL"]=$prevURL;
				$data["error"]=$errorMsg;
				$data['redirectToWhatPage']="Previous Page";
				if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
					$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
						else {
							$data['redirectToPHP']=$_SESSION["previousUrl"];
							if(strcmp($prevprevURL,"")<>0)
								$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
						}
						$data["successTile"]=$this->lang->line("successTile");
						$data["failedTitle"]=$this->lang->line("failedTitle");
						$data["goToHomePage"]=$this->lang->line("goToHomePage");
						$this->load->view('failedPage', $data);
						return;
			}
			
			$postInfo=$this->post->getPostByPostID($postID);
				
			$userID=$postInfo[0]->userID;
			
			if($userID==$userInfo["userID"]){
				$times=$this->messages_model->getMaxTimesSellerSend($userInfo["userID"]);
				if($times>=MAXTIMESDAILY_REPLYFROMSELLER && MAXTIMESDAILY_REPLYFROMSELLER< UNLIMITEDTIMES){
					$errorMsg=$this->lang->line("ExceedMaxTimesDailySellerReply");
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(strcmp($fromwhere,"inbox")==0)
						$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/1";
					else 
						$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/10";
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
					return;
					
				}
			}else{
				$times=$this->messages_model->getMaxTimesBuyerSend($userInfo["userID"]);
				if($times>=MAXTIMESDAILY_SENDFROMBUYER && MAXTIMESDAILY_SENDFROMBUYER<UNLIMITEDTIMES){
					$errorMsg=$this->lang->line("ExceedMaxTimesDailyBuyerReply");
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(strcmp($fromwhere,"inbox")==0)
						$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/1";
					else 
						$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/10";
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
					return;
				}
			}
			
			
			
			
			$fuserinfo=$this->messages_model->getMessageByMessageID($messageID);
			if(!empty($fuserinfo)){
				if(strcmp($fuserinfo[0]->status,"Op")==0){
					$userID=$fuserinfo[0]->userID;
					$fUserID=$fuserinfo[0]->fUserID;
				}else {
				$userID=$fuserinfo[0]->fUserID;
				$fUserID=$fuserinfo[0]->userID;
				}
			}
			$content=nl2br(htmlentities($this->input->post('message-text'), ENT_QUOTES, 'UTF-8'));
			
			if(ExceedDescLength($content, $maxLengthDesc)){
				$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
				if(empty($content) || strlen(trim($content))==0)
					$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
				if(ShortDescLength($content, DESCMINLENGTHINNEWPOST))
					$errorMsg=sprintf($this->lang->line("MinDescLength"));
				$data["lang_label"]=$this->nativesession->get("language");
				$data["PrevURL"]=$prevURL;
				$data["error"]=$errorMsg;
				$data['redirectToWhatPage']="Previous Page";
			if(strcmp($fromwhere,"inbox")==0)
				$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/1";
			else 
				$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/10";
			
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
						return;
			}
			$email=$this->useremail_model->getUserEmailByUserID($userID);
				
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
			$parentID=$this->messages_model->getOriginalMessageID($messageID);
			$messageArray=array(
					'postID'=>intval($postID),
					'userID'=>intval($userID),
					'fUserID'=>intval($fUserID),
					'status' => "R",
					'createDate' => date("Y-m-d H:i:s"),
					'parentID'=> $parentID,
					//'fUserID'=>intval($this->input->post('fuserID')),
					//'title'=>$this->input->post('title'),
					'content'=>$content,
					'recipientName'=>$this->input->post('recipient-name'),
					'senderEmail'=>$this->input->post('sender-email'),
					'recipientPhoneNumber'=>$this->input->post('recipient-Phone-Number'));
			//print_r($messageArray);
				
// 			if(intval($userID)==intval($fUserID) and $fUserID<>0)
// 			{
// 				$errorMsg=$this->lang->line("MessagesSendFromYourOwnError");
// 				redirect(base_url().MY_PATH."viewItem/index/".$postID."/".$prevURL."/".$errorMsg);
		
// 			}
// 			else {
			//$messageID = $this->input->post('messageID');
				
				$messageResult=$this->messages_model->reply($messageArray, $messageID, $fuserinfo[0]->status, $parentID);
				if($messageResult)
				{
						$usernameArr=$this->users_model->get_user_by_id($fUserID);
					$username=$usernameArr[0]->username;
					//$email=$this->useremail_model->getUserEmailByUserID($fUserID);
						$path=base_url().MY_PATH."home/loginPage";
						$msg=$this->mailtemplate_model->SendEmailReplyMsgForSelleOrBuyerr( $username, $path );
						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForReplyMsgForSellerOrBuyer(), REPLYMESSAGESENDEMAIL);
						
						$this->admin_model->getMessageStatByUserID($userID);
						
					redirect(base_url().MY_PATH."home/getAccountPage/1");
				}
				else
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					redirect(base_url().MY_PATH."viewItem/index/".$postID."/".$prevURL."/".$errorMsg);
				}
// 			}
		}
		public function editMyAds($messageID, $userID)
		{
			
		}
		public function shareMyAds($messageID, $userID)
		{
			
		}
		public function deleteMyAds()
		{
			$prevURL=base_url().MY_PATH."home/getAccountPage/3";
			if(isset($_GET["prevURL"])){
				$prevURL=$_GET["prevURL"];
			}
			$_SESSION["previousUrl"]=$prevURL;
			
			
			
			
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
			
			try{
			$userInfo=$this->nativesession->get("user");
			
			$fUserID=0;
			if(!empty($userInfo))
				$fUserID=$userInfo["userID"];
				else {
					$data['status'] = 'F';
					$data['class'] = "has-error";
					$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login in to save the item</div>';
					$data['icon'] = '<em><span style="color:red"></span></em>';
					echo json_encode($data);
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
			
			$times=$this->messages_model->getMaxTimesDeleteAds($userInfo["userID"]);
			if($times>= MAXTIMESDAILY_DELETEADS && MAXTIMESDAILY_DELETEADS<UNLIMITEDTIMES)
			{
// 				$data['status'] = 'F';
// 				$data['class'] = "has-error";
// 				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>'.$this->lang->line("ExceedMaxTimesDailyDeleteAds").'</div>';
// 				$data['icon'] = '<em><span style="color:red"></span></em>';
// 				echo json_encode($data);
// 				return;
				$errorMsg=$this->lang->line("ExceedMaxTimesDailyDeleteAds");
				$data["error"]=$errorMsg;
				$data['redirectToWhatPage']="Previous Page";
				$data['redirectToPHP']=$prevURL;
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
			
			$postID = $this->input->post('messageID');
			$userID=$this->input->post('userID');
		
			$where=array('postID'=>$postID);
			$messageArray=array('status' => "D", "deleteDate"=> date("Y-m-d H:i:s"));
			$messageResult=$this->post->delete($messageArray, $where);
			if($messageResult){
// 				$data['status'] = 'A';
// 				$data['class'] = "has-success";
// 				$data['message'] = '';
// 				$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
// 				echo json_encode($data);
				$errorMsg="success in delete ads";
				$data["error"]=$errorMsg;
				$data['redirectToWhatPage']="Previous Page";
				$data['redirectToPHP']=$prevURL;
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
				return;
			}
			else {
				$errorMsg="error in saving";
				$data["error"]=$errorMsg;
				$data['redirectToWhatPage']="Previous Page";
				$data['redirectToPHP']=$prevURL;
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
				
				
// 				$data['status'] = 'F';
// 				$data['class'] = "has-error";
// 				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>Error</div>';
// 				$data['icon'] = '<em><span style="color:red"></span></em>';
// 				echo json_encode($data);
					
			}
			}catch(Exception $ex){
				$exMessage=$ex->getMessage();
				$errorMsg=$exMessage;
				$data["error"]=$errorMsg;
				$data['redirectToWhatPage']="Previous Page";
				$data['redirectToPHP']=$prevURL;
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
// 				$data['status'] = 'F';
// 				$data['class'] = "has-error";
// 				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>'.$exMessage.'</div>';
// 				$data['icon'] = '<em><span style="color:red"></span></em>';
// 				echo json_encode($data);
			}
		}
		public function cancelPendingApproval()
		{
			$prevURL=base_url().MY_PATH."home/getAccountPage/6";
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
			
			try{
			$userInfo=$this->nativesession->get("user");
			$fUserID=0;
			if(!empty($userInfo))
				$fUserID=$userInfo["userID"];
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login in to save the item</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
				return;
			}
				
			$messageID = explode("-", $this->input->post('messageID'));
			$postID=$messageID[0];
			$userID=$messageID[1];
				
			$where=array('postID'=>intval($postID),
					'userID'=>intval($userID));
			$messageArray=array('status' => "D");
				
			$messageResult=$this->requestpost_model->update($messageArray,$where);
			if($messageResult){
				$data['status'] = 'A';
				$data['class'] = "has-success";
				$data['message'] = '';
				$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
				echo json_encode($data);
			}
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>Error</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
			
			}
		}catch(Exception $ex){
				$exMessage=$ex->getMessage();
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>'.$exMessage.'</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
			}
		}
		public function cancelSavedAds()
		{
			$prevURL=base_url().MY_PATH."home/getAccountPage/5";
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
			
			try{
			$userInfo=$this->nativesession->get("user");
			$fUserID=0;
			if(!empty($userInfo))
				$fUserID=$userInfo["userID"];
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login in to save the item</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
				return;
			}
			
			$messageID = explode("-", $this->input->post('messageID'));
			$postID=$messageID[0];
			$userID=$messageID[1];
				
			$where=array('postID'=>intval($postID),
					'userID'=>intval($fUserID));
			$messageArray=array('status' => "C");
				
			$messageResult=$this->savedAds_model->update($messageArray,$where);
			if($messageResult){
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
			echo json_encode($data);
			return;
			}
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>Error</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
				
			}
			}catch(Exception $ex){
				$exMessage=$ex->getMessage();
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>Error</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
			}
		}
		
		public function markSoldAds(){
			try{
			$prevURL=base_url().MY_PATH."home/getAccountPage/3";
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
			
				$user=$this->nativesession->get("user");
				//----------setup the header menu----------
				$data["menuMyAds"]="";
				$data["menuInbox"]="";
				$data["menuInboxNum"]="0";
				$data["menuPendingRequest"]="";
				$data["menuPendingRequestNumber"]="0";
				if(isset($user)){
					$menuCount=$this->getHeaderCount($user["userID"]);
					$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($user["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
					$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
				}
				//----------------------------
				if(!isset($user))
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
							return;
				}
				
				
				
				$times=$this->tradecomments_model->getMaxTimesMarkSold($user["userID"]);
				if($times>= MAXTIMESDAILY_MARKSOLDPERPOST && MAXTIMESDAILY_MARKSOLDPERPOST<UNLIMITEDTIMES)
				{
					$errorMsg=$this->lang->line("ExceedMaxTimesDailyMarkSoldPerPost");
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/3";
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
					return;
				}
				
			$messageID=0; //$_POST['messageID'];
			$postID=$_POST['postID_3'];;
			$soldUserID=$_POST['soldUser'];
			$rating=$_POST['rating'];
			$buyerComment=nl2br(htmlentities($_POST['message-text'], ENT_QUOTES, 'UTF-8'));
			$soldQty=$_POST['soldqty'];
			//$postID=207;
			//$soldUserID=48;
			//$rating=1;
			//$buyerComment="ABC";
			//$where=array('postID'=>intval($postID));
			$messageArray=array('postID'=>intval($postID), 'status' => "U", 'soldDate' =>date("Y-m-d H:i:s"), 'createDate' =>date("Y-m-d H:i:s"), 'soldQty' => $soldQty,
					'soldToUserID'=> $soldUserID, 'sellerRating'=> $rating, 'sellerComment'=> $buyerComment);
			$messageResult=$this->tradecomments_model->insertTradeComment($messageArray, $messageID);
			if($messageResult)
				{
					redirect(base_url().MY_PATH."home/getAccountPage/3");
				}
				else
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					redirect(base_url().MY_PATH."home/getAccountPage/3/1/".$errorMsg);
				}
			}catch(Exception $ex){
				$errorMsg=$ex->getMessage();
				redirect(base_url().MY_PATH."home/getAccountPage/3/1/".$errorMsg);
					
			}
		}
		
		public function markSoldAdsInbox(){
			try{
			$prevURL=base_url().MY_PATH."home/getAccountPage/1";
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
			
				$user=$this->nativesession->get("user");
			//----------setup the header menu----------
				$data["menuMyAds"]="";
				$data["menuInbox"]="";
				$data["menuInboxNum"]="0";
				$data["menuPendingRequest"]="";
				$data["menuPendingRequestNumber"]="0";
				if(isset($user)){
					$menuCount=$this->getHeaderCount($user["userID"]);
					$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($user["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
					$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
				}
				//----------------------------
				if(!isset($user))
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
							return;
				}
				$times=$this->tradecomments_model->getMaxTimesMarkSold($user["userID"]);
				if($times>= MAXTIMESDAILY_MARKSOLDPERPOST && MAXTIMESDAILY_MARKSOLDPERPOST<UNLIMITEDTIMES)
				{
					$errorMsg=$this->lang->line("ExceedMaxTimesDailyMarkSoldPerPost");
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/1";
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
					return;
				}
		
				$messageID=$_POST['messageID'];
				$postID=$_POST['postID'];;
				$soldUserID=$_POST['soldUserID'];
				
				$rating=$_POST['rating'];
				$buyerComment=nl2br(htmlentities($_POST['message-text'], ENT_QUOTES, 'UTF-8'));
				$soldQty=$_POST['soldqty'];
				$messageArray=array('postID'=>intval($postID), 'status' => "U", 'soldDate' =>date("Y-m-d H:i:s"), 'createDate' =>date("Y-m-d H:i:s"), 'soldQty' => $soldQty,
						'soldToUserID'=> $soldUserID, 'sellerRating'=> $rating, 'sellerComment'=> $buyerComment);
				$messageResult=$this->tradecomments_model->insertTradeComment($messageArray, $messageID);
				if($messageResult)
				{
					redirect(base_url().MY_PATH."home/getAccountPage/1");
				}
				else
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					redirect(base_url().MY_PATH."home/getAccountPage/1/1/".$errorMsg);
				}
			}catch(Exception $ex){
				$errorMsg=$ex->getMessage();
				redirect(base_url().MY_PATH."home/getAccountPage/1/1/".$errorMsg);
					
			}
		}
		
		public function markBuyerComment(){
			try{
				
				$ID=$_POST['commentID'];
				$rating=$_POST['rating'];
				$buyerComment=nl2br(htmlentities($_POST['message-text'], ENT_QUOTES, 'UTF-8'));
				
				$redirectPage=$_POST['redirectPage'];
				$redirectNum=10;
				if(strcmp($redirectPage, "account-outbox.php")==0)
					$redirectNum=10;
				else if(strcmp($redirectPage, "account-my-buy-history.php")==0)
					$redirectNum=11;
				
					$prevURL=base_url().MY_PATH."home/getAccountPage/".$redirectNum;
					$expired= $this->nativesession->_session_id_expired();
					if($expired){
						redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
							
						$user=$this->nativesession->get("user");
						//----------setup the header menu----------
						$data["menuMyAds"]="";
						$data["menuInbox"]="";
						$data["menuInboxNum"]="0";
						$data["menuPendingRequest"]="";
						$data["menuPendingRequestNumber"]="0";
						if(isset($user)){
							$menuCount=$this->getHeaderCount($user["userID"]);
							$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($user["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
							$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
						}
						//----------------------------
						if(!isset($user))
						{
							$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
							$data["lang_label"]=$this->nativesession->get("language");
							$data["PrevURL"]=$prevURL;
							$data["error"]=$errorMsg;
							$data['redirectToWhatPage']="Previous Page";
							if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
								$data['redirectToPHP']=base_url();
								else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
									$data['redirectToPHP']=base_url();
									else {
										$data['redirectToPHP']=$_SESSION["previousUrl"];
										if(strcmp($prevprevURL,"")<>0)
											$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
									}
									$data["successTile"]=$this->lang->line("successTile");
									$data["failedTitle"]=$this->lang->line("failedTitle");
									$data["goToHomePage"]=$this->lang->line("goToHomePage");
									$this->load->view('failedPage', $data);
									return;
						}			
				
						
						if(ExceedDescLength($buyerComment, DESCLENGTHINNEWPOSTBACKEND)){
							$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
							if(empty($buyerComment) || strlen(trim($buyerComment))==0)
								$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
							if(ShortDescLength($buyerComment, DESCMINLENGTHINNEWPOST))
								$errorMsg=sprintf($this->lang->line("MinDescLength"));
							$data["error"]=$errorMsg;
							$data["prevURL"]=$prevURL;
							$data['redirectToWhatPage']="Previous Page";
							$data['redirectToWhatPage']="Previous Page";
							if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
								$data['redirectToPHP']=base_url();
								else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
									$data['redirectToPHP']=base_url();
									else {
										$data['redirectToPHP']=$_SESSION["previousUrl"];
										if(strcmp($prevprevURL,"")<>0)
											$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
									}
									$data["successTile"]=$this->lang->line("successTile");
									$data["failedTitle"]=$this->lang->line("failedTitle");
									$data["goToHomePage"]=$this->lang->line("goToHomePage");
									$this->load->view('failedPage', $data);
									return;
						}		
						
						
						
				$where=array('ID'=>intval($ID));
				$messageArray=array('status' => "C", 'buyerDate' =>date("Y-m-d H:i:s"),
						 'buyerRating'=> $rating, 'buyerComment'=> $buyerComment);
				$messageResult=$this->tradecomments_model->updateTradeComment($messageArray, $ID);
				if($messageResult >0)
				{
					redirect(base_url().MY_PATH."home/getAccountPage/".$redirectNum."/1/success");
				}
				else
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					redirect(base_url().MY_PATH."home/getAccountPage/".$redirectNum."/1/".$errorMsg);
				}
			}catch(Exception $ex){
				$errorMsg=$ex->getMessage();
				log_message('error', $errorMsg);
				redirect(base_url().MY_PATH."home/getAccountPage/".$redirectNum."/1/".$errorMsg);
					
			}
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
			//		$this->email->cc('ryanfung@gmail.com');
		
			//$user = $this->user->getUserByUserID($userEmail['userID']);
		
		
		
			$this->email->subject($title);
			$message=$msg;
		
		
			$this->email->message($message);
		
			$this->email->send();
			//echo $this->email->print_debugger();
			log_message('debug', 'send Email');
			//echo 'Sending Email';
		}
	
		public function getViewMessageHistory($userID, $postID, $fuserID){
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				$this->loginPage(); return;}
			
			$userInfo=$this->nativesession->get("user");
			if(!empty($userInfo)) {
				if(strcmp($userID ,$userInfo["userID"])!=0){
					$data['status'] = 'F';
					$data['class'] = "has-error";
					$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>Please login in correct user</div>';
					$data['icon'] = '<em><span style="color:red"></span></em>';
					echo json_encode($data);
					return;
				}
			}
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
				return;
			}
			
			$prevUrl="";
			if(isset($_GET["prevURL"])) {
				$prevUrl=$_GET["prevURL"];
				$_SESSION["previousUrl"]=$prevUrl;
			}
			else if(isset($_SESSION["previousUrl"]))
				$prevUrl=$_SESSION["previousUrl"];
			$data=$this->messages_model->getViewMessageHistory($userID, $postID, $fuserID);
			$result["previousCurrent_url"]=urldecode($prevUrl);
			$result["result"]=$data;
			$postInfo=$this->post->getPostByPostID($postID);
			$buyerNameArr=$this->users_model->get_user_by_id($userID);
			$sellerNameArr=$this->users_model->get_user_by_id($fuserID);
			$result["titlepost"]=$postInfo[0]->itemName;
			$result["description"]=$postInfo[0]->description;
			$result["buyerName"]=$buyerNameArr[0]->username;
			$result["sellerName"]=$sellerNameArr[0]->username;
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
			$this->load->view("account-viewMessageHistory", $result);
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
	public function marksoldclosed(){
		//$postID=$_POST["postID"];
		try{
		$expired= $this->nativesession->_session_id_expired();
		if($expired){
			redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
		
			$postID=$this->input->post('postID');
			$userInfo=$this->nativesession->get("user");
			$fUserID=0;
			$username="";
			if(!empty($userInfo) and isset($userInfo) and $userInfo<> null and $userInfo["userID"]<>0)
			{
				$fUserID=$userInfo["userID"];
				$username=$userInfo["username"];
			}else{
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>Please login</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
					
			}
			$postInfo=$this->post->getPostByPostID($postID);
			$userID=$postInfo[0]->userID;
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($userInfo)){
				$menuCount=$this->getHeaderCount($fUserID);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($fUserID); //$menuCount["inboxMsgCount"]; //
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			//----------------------------
			
			
			$messageArray=array(
					'status'=>'C'	
			);
			$messageResult=$this->post->update($messageArray, $postID);
			if($messageResult){
				$data['status'] = 'A';
				$data['class'] = "has-success";
				$data['message'] = '';
				$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
				echo json_encode($data);
				
			}else{
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>Error</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
					
				}
		}catch(Exception $ex){
			$exMessage=$ex->getMessage();
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>'.$exMessage.'</div>';
			$data['icon'] = '<em><span style="color:red"></span></em>';
			echo json_encode($data);
		}
		return;
	}
	public function sellerFeedBack(){
		try {
			if(isset($_GET["prevURL"])){
				$prevURL=$_GET["prevURL"];
				$_SESSION["previousUrl"]=$prevURL;
			}else if(isset($_SESSION["previousUrl"])){
				$prevURL=$_SESSION["previousUrl"];
			}
			$prevprevURL="";
			if(isset($_GET["prevprevURL"])){
				$prevprevURL=$_GET["prevprevURL"];
			}
				
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
		
				$userInfo=$this->nativesession->get("user");
				$fUserID=0;
		
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
				
				
				
				
				$username="";
				if(!empty($userInfo) and isset($userInfo) and $userInfo<> null and $userInfo["userID"]<>0)
				{	
					$fUserID=$userInfo["userID"];
					$username=$userInfo["username"];
				}else{
					$errorMsg="Please login to continue your process";
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
				}
				$postID=$this->input->post("postID_2");
				$rating=$this->input->post("rating");
				$message=$this->input->post("message-text");
				$buyerID=$this->input->post("soldUser");
				
				$message=nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8'));
				
				if(ExceedDescLength($message, DESCLENGTHINNEWPOSTBACKEND)){
					$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
					if(empty($message) || strlen(trim($message))==0)   
						$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
					if(ShortDescLength($message, DESCMINLENGTHINNEWPOST))
						$errorMsg=sprintf($this->lang->line("MinDescLength"));
					$data["error"]=$errorMsg;
					$data["prevURL"]=$prevURL;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
					return;
				}
				$buyerEmail=$this->useremail_model->getUserEmailByUserID($buyerID);
				$buyerEmail=$buyerEmail["email"];
							
				if($this->sendEmailLog_model->getNoOfCountByUserID($buyerEmail['userID'], $buyerEmail["email"])>MAXTIMESSENDEMAIL){
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
				
				$postInfo=$this->post->getPostByPostID($postID);
				//$buyerID=$postInfo[0]->userID;
					
					$feedbackStatus="U";
					if(strcmp(NONEEDVERIFYFEEDBACK,"Y")==0)
						$feedbackStatus="A";
					
					$messageArray=array(
							'buyerID'=>$buyerID,
							'sellerID'=>$fUserID,
							'postID'=>$postID,
							'status'=>$feedbackStatus,
							'content'=>$message,
							'rating'=>$rating,
							'createDate'=>date("Y-m-d H:i:s"),
							);
					$messageResult=$this->sellerfeedback_model->insert($messageArray);
					if($messageResult){
						$path=base_url().MY_PATH."home/viewAllFeedback/$buyerID/1";
						$buyerInfo=$this->users_model->get_user_by_id($buyerID);
						//$buyerEmail=$this->useremail_model->getUserEmailByUserID($buyerID);
						//$email=$buyerEmail["email"];
						$title=$postInfo[0]->itemName;
						$buyerUsername=$buyerInfo[0]->username;
						$sellerUsername=$username;
						$msg=$this->mailtemplate_model->SendEmailFeedbackFromSeller( $buyerUsername, $sellerUsername, $path, $title );
						$this->sendAuthenticationEmail($buyerEmail, $msg, $this->mailtemplate_model->SendEmailFeedbackFromSellerTitle(), SELLERFEEDBACKSENDEMAIL);
							
						
						$errorMsg="Success in adding your feedback!";
						$data["lang_label"]=$this->nativesession->get("language");
						$data["PrevURL"]=$prevURL;
						$data["error"]=$errorMsg;
						$data['redirectToWhatPage']="Previous Page";
						if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
							$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
						else {
							$data['redirectToPHP']=$_SESSION["previousUrl"];
							if(strcmp($prevprevURL,"")<>0)
								$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
						}
						$data["successTile"]=$this->lang->line("successTile");
						$data["failedTitle"]=$this->lang->line("failedTitle");
						$data["goToHomePage"]=$this->lang->line("goToHomePage");
						$this->load->view('successPage', $data);
					}else{
						$errorMsg="Error in processing your request";
						$data["lang_label"]=$this->nativesession->get("language");
						$data["PrevURL"]=$prevURL;
						$data["error"]=$errorMsg;
						$data['redirectToWhatPage']="Previous Page";
						if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
							$data['redirectToPHP']=base_url();
							else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
								$data['redirectToPHP']=base_url();
								else {
									$data['redirectToPHP']=$_SESSION["previousUrl"];
									if(strcmp($prevprevURL,"")<>0)
										$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
								}
								$data["successTile"]=$this->lang->line("successTile");
								$data["failedTitle"]=$this->lang->line("failedTitle");
								$data["goToHomePage"]=$this->lang->line("goToHomePage");
								$this->load->view('failedPage', $data);
					}
		}catch(Exception $ex){
			$errorMsg="Error in processing your request";
			$data["lang_label"]=$this->nativesession->get("language");
			$data["PrevURL"]=$prevURL;
			$data["error"]=$errorMsg;
			$data['redirectToWhatPage']="Previous Page";
			if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
				$data['redirectToPHP']=base_url();
				else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
					$data['redirectToPHP']=base_url();
					else {
						$data['redirectToPHP']=$_SESSION["previousUrl"];
						if(strcmp($prevprevURL,"")<>0)
							$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
					}
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
		}
	}
	public function insertBuyerMessage(){
		
		try {
			if(isset($_GET["prevURL"])){
				$prevURL=$_GET["prevURL"];
				$_SESSION["previousUrl"]=$prevURL;
			}else if(isset($_SESSION["previousUrl"])){
				$prevURL=$_SESSION["previousUrl"];
			}
			$prevprevURL="";
			if(isset($_GET["prevprevURL"])){
				$prevprevURL=$_GET["prevprevURL"];
			}
			$fromUserID=0;
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
		
				$userInfo=$this->nativesession->get("user");
				$fUserID=0;
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
				
				
				
				$username="";
				if(!empty($userInfo) and isset($userInfo) and $userInfo<> null and $userInfo["userID"]<>0)
				{
					$fUserID=$userInfo["userID"];
					$username=$userInfo["username"];
				}else{
					$errorMsg="Please login to continue your process";
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
					else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
						$data['redirectToPHP']=base_url();
					else {
						$data['redirectToPHP']=$_SESSION["previousUrl"];
						if(strcmp($prevprevURL,"")<>0)
							$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
					}
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
				}
				$message=$this->input->post("message-text");
				$userID=$this->input->post("userID");
				$fromUserID=$fUserID;
		
				$message=nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8'));
				
				if(ExceedDescLength($message, DESCLENGTHINNEWPOSTBACKEND)){
					$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
					if(empty($message) || strlen(trim($message))==0)   
						$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
					if(ShortDescLength($message, DESCMINLENGTHINNEWPOST))
						$errorMsg=sprintf($this->lang->line("MinDescLength"));
					$data["error"]=$errorMsg;
					$data["PrevURL"]=$prevURL;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
							return;
				}
		
				$messageArray=array(
						'userID'=>$userID,
						'fromUserID'=>$fromUserID,
						'status'=>'U',
						'content'=>$message,
						'readflag'=>"N",
						'createDate'=>date("Y-m-d H:i:s"),
				);
				$messageResult=$this->buyermessage_model->insert($messageArray);
				if($messageResult){
					$this->admin_model->updateStatByUserID($userID);
					$this->admin_model->updateStatByUserID($fromUserID);
					$errorMsg="Success in adding your message!";
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('successPage', $data);
				}else{
					$errorMsg="Error in processing your request";
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
				}
		}catch(Exception $ex){
			$errorMsg="Error in processing your request";
			$data["lang_label"]=$this->nativesession->get("language");
			$data["PrevURL"]=$prevURL;
			$data["error"]=$errorMsg;
			$data['redirectToWhatPage']="Previous Page";
			if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
				$data['redirectToPHP']=base_url();
				else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
					$data['redirectToPHP']=base_url();
					else {
						$data['redirectToPHP']=$_SESSION["previousUrl"];
						if(strcmp($prevprevURL,"")<>0)
							$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
					}
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
		}
	}
	public function buyerFeedBack(){
		
		try {
			if(isset($_GET["prevURL"])){
				$prevURL=$_GET["prevURL"];
				$_SESSION["previousUrl"]=$prevURL;
			}else if(isset($_SESSION["previousUrl"])){
				$prevURL=$_SESSION["previousUrl"];
			}
			$prevprevURL="";
			if(isset($_GET["prevprevURL"])){
				$prevprevURL=$_GET["prevprevURL"];
			}
		
			$expired= $this->nativesession->_session_id_expired();
			if($expired){
				redirect(base_url().MY_PATH."home/loginPage?prevURL=".$prevURL); return;}
		
				$userInfo=$this->nativesession->get("user");
				$fUserID=0;
				
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
				
				$username="";
				if(!empty($userInfo) and isset($userInfo) and $userInfo<> null and $userInfo["userID"]<>0)
				{
					$fUserID=$userInfo["userID"];
					$username=$userInfo["username"];
				}else{
					$errorMsg="Please login to continue your process";
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
				}
				$postID=$this->input->post("postID_1");
				$rating=$this->input->post("rating");
				$message=$this->input->post("message-text");
				$buyerID=$fUserID;
		
				$postInfo=$this->post->getPostByPostID($postID);
				$userID=$postInfo[0]->userID;
				
				$message=nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8'));
				
				if(ExceedDescLength($message, DESCLENGTHINNEWPOSTBACKEND)){
					$errorMsg=sprintf($this->lang->line("ExceedMaxDescLength"));
					if(empty($message) || strlen(trim($message))==0)   
						$errorMsg=sprintf($this->lang->line("ZeroDescLength"));
					if(ShortDescLength($message, DESCMINLENGTHINNEWPOST))
						$errorMsg=sprintf($this->lang->line("MinDescLength"));
					$data["error"]=$errorMsg;
					$data["prevURL"]=$prevURL;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
							return;
				}
				$sellerEmail=$this->useremail_model->getUserEmailByUserID($userID);
					
				if($this->sendEmailLog_model->getNoOfCountByUserID($sellerEmail['userID'], $sellerEmail['email'])>MAXTIMESSENDEMAIL){
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
				$feedbackStatus="U";
				if(strcmp(NONEEDVERIFYFEEDBACK,"Y")==0)
					$feedbackStatus="A";
						
				$messageArray=array(
						'buyerID'=>$buyerID,
						'sellerID'=>$userID,
						'postID'=>$postID,
						'status'=>$feedbackStatus,
						'content'=>$message,
						'rating'=>$rating,
						'createDate'=>date("Y-m-d H:i:s"),
				);
				$messageResult=$this->buyerfeedback_model->insert($messageArray);
				if($messageResult){
					$path=base_url().MY_PATH."home/viewAllFeedback/$userID/1";
					$sellerInfo=$this->users_model->get_user_by_id($userID);
					//$sellerEmail=$this->useremail_model->getUserEmailByUserID($userID);
					$email=$sellerEmail["email"];
					$title=$postInfo[0]->itemName;
					$buyerUsername=$username;
					$sellerUsername=$sellerInfo[0]->username;
					$msg=$this->mailtemplate_model->SendEmailFeedbackFromBuyer( $buyerUsername, $sellerUsername, $path, $title );
					$this->sendAuthenticationEmail($sellerEmail, $msg, $this->mailtemplate_model->SendEmailFeedbackFromBuyerTitle(), BUYERFEEDBACKSENDEMAIL);
					
					$errorMsg="Success in adding your feedback!";
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('successPage', $data);
				}else{
					$errorMsg="Error in processing your request";
					$data["lang_label"]=$this->nativesession->get("language");
					$data["PrevURL"]=$prevURL;
					$data["error"]=$errorMsg;
					$data['redirectToWhatPage']="Previous Page";
					if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
						$data['redirectToPHP']=base_url();
						else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
							$data['redirectToPHP']=base_url();
							else {
								$data['redirectToPHP']=$_SESSION["previousUrl"];
								if(strcmp($prevprevURL,"")<>0)
									$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
							}
							$data["successTile"]=$this->lang->line("successTile");
							$data["failedTitle"]=$this->lang->line("failedTitle");
							$data["goToHomePage"]=$this->lang->line("goToHomePage");
							$this->load->view('failedPage', $data);
				}
		}catch(Exception $ex){
			$errorMsg="Error in processing your request";
			$data["lang_label"]=$this->nativesession->get("language");
			$data["PrevURL"]=$prevURL;
			$data["error"]=$errorMsg;
			$data['redirectToWhatPage']="Previous Page";
			if(!isset($_SESSION["previousUrl"]) or strcmp($_SESSION["previousUrl"], "")==0)
				$data['redirectToPHP']=base_url();
				else if(strpos(((String)$_SESSION["previousUrl"]),'loginPage') !== false)
					$data['redirectToPHP']=base_url();
					else {
						$data['redirectToPHP']=$_SESSION["previousUrl"];
						if(strcmp($prevprevURL,"")<>0)
							$data['redirectToPHP']=$data['redirectToPHP']."?prevURL=".$prevprevURL;
					}
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
		}
	}
}
?>