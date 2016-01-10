<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class messages extends CI_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		
		
	      
			$this->load->helper('url');
			$this->load->database();
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
			$userInfo=$this->nativesession->get("user");
			$username=$userinfo["username"];
			$fUserID=0;
			if(!empty($userInfo) and isset($userInfo) and $userInfo<> null and $userInfo["userID"]<>0)
				$fUserID=$userInfo["userID"];
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
				redirect(base_url().MY_PATH."viewItem/index/".$postID."/".$errorMsg."?prevURL=".$prevURL);
				
			}
			else 
			{
				$result=$this->requestpost_model->insert($messageArray);
				if($result)
				{
					$usernameArr=$this->users_model->get_user_by_id($userID);
					$username=$usernameArr[0]->username;
					$email=$this->useremail_model->getUserEmailByUserID($userID);
					$path=base_url().MY_PATH."/home/loginPage";
					$msg=$this->mailtemplate_model->SendEmailMsgForDirectSendToSeller( $username, $path);
					$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForDirectSendToSeller());
					$errorMsg=$this->lang->line("MessagesDirectSendSuccess");
					redirect(base_url().MY_PATH."viewItem/index/".$postID."/EMPTY/".($errorMsg)."?prevURL=".$prevURL);
							
				}
				else 
				{	$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					redirect(base_url().MY_PATH."viewItem/index/".$postID."/".$errorMsg."?prevURL=".$prevURL);
				
				}
			}
			}catch (Exception $e) {
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
				$userInfo=$this->nativesession->get("user");
				$fUserID=0;
				if(!empty($userInfo))
					$fUserID=$userInfo["userID"];
				if($fUserID==0)
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					redirect(base_url().MY_PATH."viewItem/index/".$postID."/".$errorMsg."?prevURL=".$prevURL);
					return;
				}
				
				
				$messageArray=array(
						'postID'=>intval($postID),
						'fUserID'=>intval($fUserID),
						'status' => "U",
						'createDate' => date("Y-m-d H:i:s"),
						'reportreason'=> $this->input->post('reportreason'),
						'content'=>$this->input->post('messagetext2'),
						'recipientName'=>$this->input->post('recipientname1'),
						'senderEmail'=>$this->input->post('recipientemail'),
						'recipientPhoneNumber'=>$this->input->post('recipientPhoneNumber1'));
				print_r($messageArray);
					$messageResult=$this->abusemessages_model->insert($messageArray);
					if($messageResult)
					{
						$email=$this->useremail_model->getUserEmailByUserID($fUserID);
						$email["email"]=HOST_EMAIL;
						$msg=$this->mailtemplate_model->SendEmailMsgForHostOfAbuseMsg();
						$this->sendAuthenticationEmail($email, $msg,$this->mailtemplate_model->SendEmailMsgForHostOfAbuseMsg() );
						$errorMsg=$this->lang->line("MessagesSendError");
						redirect(base_url().MY_PATH."viewItem/index/".$postID."/EMPTY/".$errorMsg."?prevURL=".$prevURL);
					}
					else
					{
						$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
						redirect(base_url().MY_PATH."viewItem/index/".$postID."/".$errorMsg."?prevURL=".$prevURL);
					}
				
				}
				catch(Exception $e)
				{
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			
		}
		public function insertMessage($postID)
		{
			try {
			if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
		}else if(isset($_SESSION["previousUrl"])){
			$prevURL=$_SESSION["previousUrl"];
		}
				
			$userInfo=$this->nativesession->get("user");
			$username=$userInfo["username"];
			$fUserID=0;
			if(!empty($userInfo))
				$fUserID=$userInfo["userID"];
			$postInfo=$this->post->getPostByPostID($postID);
			$userID=$postInfo[0]->userID;	
			//var_dump($postInfo);
			$content=$this->input->post('message-text');
			$messageArray=array(
			'postID'=>intval($postID),
			'userID'=>intval($userID),
			'fUserID'=>intval($fUserID),
			'parentID'=> 0,
			'status' => "Op",
            'createDate' => date("Y-m-d H:i:s"),
			//'fUserID'=>intval($this->input->post('fuserID')),
			//'title'=>$this->input->post('title'),
			'content'=>$content,
			'recipientName'=>$this->input->post('recipient-name'),
			'senderEmail'=>$this->input->post('sender-email'),
			'recipientPhoneNumber'=>$this->input->post('recipient-Phone-Number'));
			var_dump($messageArray);
			if(intval($userID)==intval($fUserID) and $fUserID<>0)
			{
						
				$errorMsg=$this->lang->line("MessagesSendFromYourOwnError");
				redirect(base_url().MY_PATH."viewItem/index/".$postID."/".$errorMsg."?prevURL=".$prevURL);
				
			}
			else {
				$messageID=$this->messages_model->insert($messageArray);
				if($messageID)
				{
					$usernameArr=$this->users_model->get_user_by_id($userID);
					$username=$usernameArr[0]->username;
					$email=$this->useremail_model->getUserEmailByUserID($userID);
					$path=base_url().MY_PATH."home/loginPage";
					$msg=$this->mailtemplate_model->SendEmailMsgForSeller( $username, $path );
					$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForSeller());
					
					$errorMsg=$this->lang->line("MessagesSendError");
					redirect(base_url().MY_PATH."viewItem/index/".$postID."/EMPTY/".$errorMsg."?prevURL=".$prevURL);
				}
				else 
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					redirect(base_url().MY_PATH."viewItem/index/".$postID."/".$errorMsg."?prevURL=".$prevURL);
				}	
			}
			}
			catch(Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		
		public function approveSavedAds()
		{
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
					
			$messageResult=$this->requestpost_model->update($messageArray,$where);
			if($messageResult){
				$usernameArr=$this->users_model->get_user_by_id($userID);
					$username=$usernameArr[0]->username;
					$email=$this->useremail_model->getUserEmailByUserID($userID);
					$path=base_url().MY_PATH."home/loginPage";
					$msg=$this->mailtemplate_model->SendEmailMsgForDirectSendApproveOrRejectToSeller($username, $path );
					$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForDirectSendApproveOrRejectToSeller());
					
				
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
					$path=base_url().MY_PATH."home/loginPage";
					$msg=$this->mailtemplate_model->SendEmailMsgForSeller( $username, $path );
					$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForSeller());
						
		}
		public function rejectSavedAds()
		{
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
			
			$messageResult=$this->requestpost_model->update($messageArray,$where);
			if($messageResult){
			$usernameArr=$this->users_model->get_user_by_id($userID);
					$username=$usernameArr[0]->username;
					$email=$this->useremail_model->getUserEmailByUserID($userID);
					$path=base_url().MY_PATH."home/loginPage";
					$msg=sprintf($this->lang->line("SendEmailMsgForDirectSendApproveOrRejectToSeller"), $username, $path );
					$this->sendAuthenticationEmail($email, $msg, $this->lang->line("SendEmailTitleForDirectSendApproveOrRejectToSeller"));
				
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
		public function replyMessage($postID, $messageID, $fromwhere="inbox")
		{
			$userInfo=$this->nativesession->get("user");
			$fUserID=0;
			if(!empty($userInfo)){
				$fUserID=$userInfo["userID"];
				$username=$userInfo["username"];
			}
			$postInfo=$this->post->getPostByPostID($postID);
				
			$userID=$postInfo[0]->userID;
			
			if($userID==$userInfo["userID"]){
				$times=$this->messages_model->getMaxTimesSellerSend($userInfo["userID"]);
				if($times>MAXTIMESDAILY_REPLYFROMSELLER && MAXTIMESDAILY_REPLYFROMSELLER>0){
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
				if($times>MAXTIMESDAILY_SENDFROMBUYER && MAXTIMESDAILY_SENDFROMBUYER>0){
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
			print_r($messageArray);
				
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
					$email=$this->useremail_model->getUserEmailByUserID($fUserID);
						$path=base_url().MY_PATH."home/loginPage";
						$msg=$this->mailtemplate_model->SendEmailReplyMsgForSelleOrBuyerr( $username, $path );
						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailTitleForReplyMsgForSellerOrBuyer());
						
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
			try{
			$userInfo=$this->nativesession->get("user");
			$times=$this->messages_model->getMaxTimesDeleteAds($userInfo["userID"]);
			if($times> MAXTIMESDAILY_DELETEADS && MAXTIMESDAILY_DELETEADS>0)
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
				$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/3";
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
			
			
			
			
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
				$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/3";
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
				$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/3";
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
				$data['redirectToPHP']=base_url().MY_PATH."home/getAccountPage/3";
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
				
				$user=$this->nativesession->get("user");
				$times=$this->tradecomments_model->getMaxTimesMarkSold($user["userID"]);
				if($times> MAXTIMESDAILY_MARKSOLDPERPOST && MAXTIMESDAILY_MARKSOLDPERPOST>0)
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
				
			$messageID=$_POST['messageID'];
			$postID=$_POST['postID'];;
			$soldUserID=$_POST['soldUser'];
			$rating=$_POST['rating'];
			$buyerComment=$_POST['message-text'];
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
		
				$user=$this->nativesession->get("user");
				$times=$this->tradecomments_model->getMaxTimesMarkSold($user["userID"]);
				if($times> MAXTIMESDAILY_MARKSOLDPERPOST && MAXTIMESDAILY_MARKSOLDPERPOST>0)
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
		
				$messageID=$_POST['messageID'];
				$postID=$_POST['postID'];;
				$soldUserID=$_POST['soldUserID'];
				
				$rating=$_POST['rating'];
				$buyerComment=$_POST['message-text'];
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
				$buyerComment=$_POST['message-text'];
				
				$redirectPage=$_POST['redirectPage'];
				$redirectNum=10;
				if(strcmp($redirectPage, "account-outbox.php")==0)
					$redirectNum=10;
				else if(strcmp($redirectPage, "account-my-buy-history.php")==0)
					$redirectNum=11;
				//log_message('error', "markBuyerComment:".$ID.", ".$rating.", ".$buyerComment);
				//$postID=207;
				//$soldUserID=48;
				//$rating=1;
				//$buyerComment="ABC";
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
		private function sendAuthenticationEmail($userEmail, $msg, $title){
		
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
			//----------------------------
			$this->load->view("account-viewMessageHistory", $result);
		}
		
}
?>