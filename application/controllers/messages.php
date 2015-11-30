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
					$msg=sprintf($this->lang->line("SendEmailMsgForDirectSendToSeller"), $username, $path);
					$this->sendAuthenticationEmail($email, $msg, $this->lang->line("SendEmailTitleForDirectSendToSeller"));
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
						$msg=$this->lang->line("SendEmailMsgForHostOfAbuseMsg");
						$this->sendAuthenticationEmail($email, $msg,$this->lang->line("SendEmailMsgForHostOfAbuseMsg") );
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
			
			$messageArray=array(
			'postID'=>intval($postID),
			'userID'=>intval($userID),
			'fUserID'=>intval($fUserID),
			'status' => "Op",
            'createDate' => date("Y-m-d H:i:s"),
			//'fUserID'=>intval($this->input->post('fuserID')),
			//'title'=>$this->input->post('title'),
			'content'=>$this->input->post('message-text'),
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
					$msg=sprintf($this->lang->line("SendEmailMsgForSeller"), $username, $path );
					$this->sendAuthenticationEmail($email, $msg, $this->lang->line("SendEmailTitleForSeller"));
					
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
					$msg=sprintf($this->lang->line("SendEmailMsgForSeller"), $username, $path );
					$this->sendAuthenticationEmail($email, $msg, $this->lang->line("SendEmailTitleForSeller"));
						
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
		public function replyMessage($postID, $messageID)
		{
			$userInfo=$this->nativesession->get("user");
			$fUserID=0;
			if(!empty($userInfo)){
				$fUserID=$userInfo["userID"];
				$username=$userInfo["username"];
			}
			$postInfo=$this->post->getPostByPostID($postID);
				
			$userID=$postInfo[0]->userID;
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
			
			$messageArray=array(
					'postID'=>intval($postID),
					'userID'=>intval($userID),
					'fUserID'=>intval($fUserID),
					'status' => "R",
					'createDate' => date("Y-m-d H:i:s"),
					//'fUserID'=>intval($this->input->post('fuserID')),
					//'title'=>$this->input->post('title'),
					'content'=>$this->input->post('message-text'),
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
				
				$messageResult=$this->messages_model->reply($messageArray, $messageID, $fuserinfo[0]->status);
				if($messageResult)
				{
						$usernameArr=$this->users_model->get_user_by_id($fUserID);
					$username=$usernameArr[0]->username;
					$email=$this->useremail_model->getUserEmailByUserID($fUserID);
						$path=base_url().MY_PATH."home/loginPage";
						$msg=sprintf($this->lang->line("SendEmailReplyMsgForSelleOrBuyerr"), $username, $path );
						$this->sendAuthenticationEmail($email, $msg, $this->lang->line("SendEmailTitleForReplyMsgForSellerOrBuyer"));
							
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
			$messageArray=array('status' => "D");
			$messageResult=$this->post->delete($messageArray, $where);
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
			$postID=$_POST['postID'];;
			$soldUserID=$_POST['soldUser'];
			$rating=$_POST['rating'];
			$buyerComment=$_POST['message-text'];
			//$postID=207;
			//$soldUserID=48;
			//$rating=1;
			//$buyerComment="ABC";
			$where=array('postID'=>intval($postID));
			$messageArray=array('status' => "So", 'soldDate' =>date("Y-m-d H:i:s"),
					'soldToUserID'=> $soldUserID, 'sellerRating'=> $rating, 'sellerComment'=> $buyerComment);
			$messageResult=$this->post->updatePost($messageArray,$where);
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
		
		public function markBuyerComment(){
			try{
				$postID=$_POST['postID'];;
				$rating=$_POST['rating'];
				$buyerComment=$_POST['message-text'];
				//$postID=207;
				//$soldUserID=48;
				//$rating=1;
				//$buyerComment="ABC";
				$where=array('postID'=>intval($postID));
				$messageArray=array('status' => "Bc", 'buyerDate' =>date("Y-m-d H:i:s"),
						 'buyerRating'=> $rating, 'buyerComment'=> $buyerComment);
				$messageResult=$this->post->updatePost($messageArray,$where);
				if($messageResult)
				{
					redirect(base_url().MY_PATH."home/getAccountPage/10");
				}
				else
				{
					$errorMsg=$this->lang->line("MessagesDirectSendErrorLoginFirst");
					redirect(base_url().MY_PATH."home/getAccountPage/10/1/".$errorMsg);
				}
			}catch(Exception $ex){
				$errorMsg=$ex->getMessage();
				redirect(base_url().MY_PATH."home/getAccountPage/10/1/".$errorMsg);
					
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
	
		
}
?>