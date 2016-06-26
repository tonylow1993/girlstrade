<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class getAdmin extends CI_Controller {
	var $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		$this->load->helper('language');
		$this->load->helper('form');
		$this->load->helpers('site');
		$this->load->library('upload');
		//$this->load->library('image_lib');
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
		
		$this->load->helper('url');
		
		$this->load->database();
		$this->load->model('post_model');
		$this->load->model('picture_model');
		$this->load->model("user_model");
		$this->load->model("useremail_model");
		$this->load->model("userpassword_model");
		$this->load->model("admin_model");
        $this->load->model("users_model");
        $this->load->model('tradecomments_model');
        $this->load->model('itemcomments_model');
        $this->load->model('abusemessages_model');
        $this->load->model('mailtemplate_model');
        $this->load->model('contact_model');
        $this->load->model('contacttype_model');
        $this->load->model('buyerfeedback_model');
        $this->load->model('userstat_model');
        $this->load->model('messages_model');
        $this->load->model('blog_model');
        $this->load->model('userInfoSendEmail_model');
	}
	
	public function index($Photo=0)
	{
		if($Photo==0){
		$data["lang_label"]=$this->nativesession->get("language");
		$this->nativesession->set("lastPageVisited","login");
		//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
		//----------------------------
		$this->load->view('adminLogin', $data);
		}
		
	}
	public function getAccountPage($activeNav=1, $pageNum=1){
		   $data["pageNum"]=$pageNum;
			$loginUser=$this->nativesession->get("user");
		   //----------setup the header menu----------
        $data["menuMyAds"]="";
        $data["menuInbox"]="class=\"active\"";
        $data["menuInboxNum"]="0";
        $data["menuPendingRequest"]="";
        $data["menuPendingRequestNumber"]="0";
        if(isset($loginUser)){
        	$menuCount=$this->getHeaderCount($loginUser["userID"]);
        	$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($loginUser["userID"]); //$menuCount["inboxMsgCount"]; //
        	$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
        }
        //----------------------------
			if($loginUser!=null && isset($loginUser)){
				if(strcmp($loginUser["username"],"admin")==0){
					$data['activeNav']=$activeNav;
					$data["lang_label"]=$this->nativesession->get("language");
					
					if($activeNav==1){
						$data['itemList']=$this->post_model->getUItemList();
						$this->load->view('adminPost.php', $data);
					}else if($activeNav==2){
						$data['itemList']=$this->user_model->getUnverifyUserPhoto();
						$this->load->view('adminPhoto.php', $data);
					}else if($activeNav==3){
						$data['itemList']=$this->user_model->getUserList();
						$this->load->view('adminUser.php', $data);
					} 	else if($activeNav==4){
						$data['itemList']=$this->user_model->getUserArrayList();
						//$data["postList"]=$this->post_model->();
						$this->load->view('adminUpdatePost.php', $data);
					}else if($activeNav==5){
						$data['itemList']=$this->user_model->getUserArrayList();
						//$data["postList"]=$this->post_model->();
						$this->load->view('adminDeleteUser.php', $data);
					}else if($activeNav==6){
						$data["NoOfItemCount"]=$this->itemcomments_model->getNoOfItemCountInItemComments();
						$data['itemList']=$this->mapToItemComment($this->itemcomments_model->getUItemCommentsList($pageNum));
						 $this->load->view('adminItemComments.php', $data);
					}else if($activeNav==7){
						$data["NoOfItemCount"]=$this->tradecomments_model->getNoOfItemCountInTradeComments();
						$data['itemList']=$this->mapToTradeComment($this->tradecomments_model->getUTradeCommentsList($pageNum));
						$this->load->view('adminTradeComments.php', $data);
					}else if($activeNav==8){
						$data["NoOfItemCount"]=$this->abusemessages_model->getNoOfItemCountInAbuseMessages();
						$data['itemList']=$this->mapToAbuseMessages($this->abusemessages_model->getUAbuseMessagesList($pageNum));
						$this->load->view('adminAbuseMessages.php', $data);
					}
					else if($activeNav==9){
						$this->load->view('adminFireEmail.php', $data);
					}
					else if($activeNav==10){
						$data["NoOfItemCount"]=$this->contact_model->getNoOfItemCountInContactUs();
						$data['itemList']=$this->mapToContactUs($this->contact_model->getContactUnverifiedList($pageNum));
						$this->load->view('adminContactUs.php', $data);
					}
					else if($activeNav==11){
						$data["NoOfItemCount"]=$this->buyerfeedback_model->getNoOfItemCountInApproveFeedBack();
						$data['itemList']=$this->mapToFeedBack($this->buyerfeedback_model->getApproveFeedBackUnverifiedList($pageNum));
						$this->load->view('adminApproveFeedBack.php', $data);
					}else if($activeNav==12){
						$data["result"]=$this->blog_model->getBlog();
						//$data["pic1"]=base_url().$data["result"][0]->picPath1.$data["result"][0]->picName1;
						//$data["pic2"]=base_url().$data["result"][0]->picPath2.$data["result"][0]->picName2;
						//$data["pic3"]=base_url().$data["result"][0]->picPath3.$data["result"][0]->picName3;
						//$data["titleTextarea"]=$data["result"][0]->title;
						//$data["descriptionTextarea"]=$data["result"][0]->description;
						$data["titleTextarea"]="";
						$data["descriptionTextarea"]="";
						$this->load->view('adminBlogPage.php', $data);
					}
			}
			
	}
	}
	public function mapToFeedBack($input){
		$result=null;
		if($input!=null && count($input)>0){
			$lang_label=$this->nativesession->get("language");
			foreach($input as $row)
			{
				$type=$row->type;
				$ID=$row->ID;
				$postID=$row->postID;
				$status=$row->status;
				$sellerID=$row->sellerID;
				$buyerID=$row->buyerID;
				$rating=$row->rating;
				$content=$row->content;
				$createDate=$row->createDate;
				$sellerInfo=$this->users_model->get_user_by_id($sellerID);
				$sellername=$sellerInfo[0]->username;
				$buyerInfo=$this->users_model->get_user_by_id($buyerID);
				$buyername=$buyerInfo[0]->username;
				$arrayMessage=array($ID => 
						array("postID"=>$postID,
						"type"=>$type,
						"sellerID"=>$sellerID,
						"buyerID"=>$buyerID,
						"content"=>$content,
						"rating"=>$rating,
						"status"=>$status,
						"sellername"=>$sellername,
						"buyername"=>$buyername,
						"createDate"=>$createDate));
					
					
				if($result==null)
					$result=$arrayMessage;
					else
						$result=$result + $arrayMessage;
			}
		}
		
		return $result;
	}
	public function mapToContactUs($input){
		$result=null;
		if($input!=null && count($input)>0){
			$lang_label=$this->nativesession->get("language");
			foreach($input as $row)
			{
				$contactID=$row->contactID;
				$name=$row->name;
				$phone=$row->phone;
				$email=$row->email;
				$status=$row->status;
				$contactTypeID=$row->contactTypeID;
				$contactTypeArray=$this->contacttype_model->getContactTypeByID($contactTypeID);
				$contactType="";
				if(isset($contactTypeArray)){
				foreach($contactTypeArray as $id=>$contacarr){
					$contactType=$contacarr->name;
					if ($lang_label<>"english")
						$contactType=$contacarr->nameCH;
					}
				}
				$message=$row->message;
				$createDate=$row->createDate;
				$updateDate=$row->updateDate;	
			
				$arrayMessage=array($contactID => array("contactID"=>$contactID,
						"name"=>$name,
						"phone"=>$phone,
						"email"=>$email,
						"contactType"=>$contactType,
						"message"=>$message,
						"status"=>$status,
						"createDate"=>$createDate,
						"updateDate"=>$updateDate));
					
					
				if($result==null)
					$result=$arrayMessage;
				else
					$result=$result + $arrayMessage;
			}
		}
		
		return $result;
	}
	public function mapToAbuseMessages($input){
		$result=null;
		if($input!=null && count($input)>0){
			$lang_label=$this->nativesession->get("language");
			foreach($input as $row)
			{
				$postID=$row->postID;
				//$usercommentID=$row->usercommentID;
				//$comments=$row->comments;
				$createDate=$row->createDate;
				$commentID=$row->messageID;
				$buyerID=$row->fUserID;
				$comments=$row->content;
				$postInfo=$this->post_model->getPostByPostID($postID);
				$userarray=$this->users_model->get_user_by_id($buyerID);
				$userPost=$this->users_model->get_user_by_id($postInfo[0]->userID);
				$to="";
				$from="";
				if($userarray<>null)
					$from=$userarray[0]->username;
				if($userPost<>null)
					$to=$userPost[0]->username;
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
				$preview=$comments;
		
				$pic=$this->picture_model->get_picture_by_postID($postID);
				$imagePath="";
				$picCount=count($pic);
				if($pic<>null)
				{
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
						"to"=>$to,
						"preview"=>$preview,
						"previewTitle"=>$previewTitle,
						"previewDesc"=>$previewDesc,
						"price"=>$price,
						"imagePath"=>$imagePath,
						"viewItemPath"=>$viewItemPath,
						"itemStatus"=>$itemStatus,
						"from"=>$from,
						"picCount"=>$picCount));
					
				if($result==null)
					$result=$arrayMessage;
				else
					$result=$result + $arrayMessage;
			}
		}
		
		return $result;
	}
	public function mapToItemComment($input){
		$result=null;
		if($input!=null && count($input)>0){
			$lang_label=$this->nativesession->get("language");
			foreach($input as $row)
			{
				$postID=$row->postID;
				$ID=$row->ID;
				$content=$row->comments;
				//$reportReason=$row->reportreason;
				$createDate=$row->createDate;
				$userID=$row->usercommentID;
					
				$postInfo=$this->post_model->getPostByPostID($postID);
				$userarray=$this->users_model->get_user_by_id($userID);
				$userPost=$this->users_model->get_user_by_id($postInfo[0]->userID);
				$to="";
				$from="";
				if($userarray<>null)
					$from=$userarray[0]->username;
				if($userPost<>null)
					$to=$userPost[0]->username;
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
				$preview=$content;
				
				$pic=$this->picture_model->get_picture_by_postID($postID);
				$imagePath="";
				$picCount=count($pic);
				if($pic<>null)
				{
					$imagePath=base_url().$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
				}
				$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
					
				$itemStatus='OPEN';
				$NoOfDaysPending=10;
				$NoOfDaysb4ExpiryContact=10;
				//var_dump($soldUserList);
				$arrayMessage=array($ID => array("postID"=>$postID,
						"messageID"=>$ID,
						"commentID"=>$ID,
						"reporterID"=>$userID,
						"sellerID"=>$postInfo[0]->userID,
						"createDate"=>$createDate,
						"to"=>$to,
						"preview"=>$preview,
						"previewTitle"=>$previewTitle,
						"previewDesc"=>$previewDesc,
						//"reportReason"=>$reportReason,
						"price"=>$price,
						"imagePath"=>$imagePath,
						"viewItemPath"=>$viewItemPath,
						"itemStatus"=>$itemStatus,
						"from"=>$from,
						"picCount"=>$picCount));
					
				if($result==null)
					$result=$arrayMessage;
				else
					$result=$result + $arrayMessage;
			}
		}
		
		return $result;
	}
	public function mapToTradeComment($input){
		$result=null;
		if($input!=null && count($input)>0){
			$lang_label=$this->nativesession->get("language");
			foreach($input as $row)
			{
				$postID=$row->postID;
				$commentID=$row->ID;
				$buyerID=$row->soldToUserID;
				$createDate=$row->createDate;
					
				$postInfo=$this->post_model->getPostByPostID($postID);
				$userarray=$this->users_model->get_user_by_id($buyerID);
				
				if(!isset($postInfo) || $postInfo==null)
					continue;
				
				$to="";
				$from="";
				if($userarray<>null)
					$to=$userarray[0]->username;
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
					
				$sellerInfo=$this->users_model->get_user_by_id($postInfo[0]->userID);
				if($sellerInfo!=null && count($sellerInfo)>0)
					$sellerUserName=$sellerInfo[0]->username;
				$from=$sellerUserName;
				if(strcmp($preview, "")==0)
					$preview=$preview."Seller: ".$sellerUserName;
				else
					$preview=$preview."<br/>Seller: ".$sellerUserName;
				$preview=$preview."<br/>Buyer: ".$to;
				if($row->sellerRating!=0 && (strcmp($row->status,"A")==0 || strcmp($row->status,"C")==0)){
					$preview=$preview."<br/>Seller Comment:  (". $this->getRating($row->sellerRating).")";
					$preview=$preview." ".$row->sellerComment;
				}
				if($row->buyerRating!=0 && (strcmp($row->status,"A")==0 || strcmp($row->status,"C")==0)){
					$preview=$preview."<br/> Buyer Comment: (".$this-> getRating($row->buyerRating).")";
					$preview=$preview." ".$row->buyerComment;
				}
				$pic=$this->picture_model->get_picture_by_postID($postID);
				$imagePath="";
				$picCount=count($pic);
				if($pic<>null)
				{
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
						"to"=>$to,
						"preview"=>$preview,
						"previewTitle"=>$previewTitle,
						"previewDesc"=>$previewDesc,
						"price"=>$price,
						"imagePath"=>$imagePath,
						"viewItemPath"=>$viewItemPath,
						"itemStatus"=>$itemStatus,
						"from"=>$from,
						"picCount"=>$picCount));
			
				if($result==null)
					$result=$arrayMessage;
				else
					$result=$result + $arrayMessage;
			}
		}
		
		return $result;
	}
	
	public function loginUser()
	{
		$username="";
		//----------setup the header menu----------
		$data["menuMyAds"]="";
		$data["menuInbox"]="";
		$data["menuInboxNum"]="0";
		$data["menuPendingRequest"]="";
		$data["menuPendingRequestNumber"]="0";
		//----------------------------
		if(!($this->input->post("username")))
			$username = $this->input->post("username");
		else if(is_array($_POST))
		{
			if(!empty($_POST))
				$username=$_POST["username"];
		}
		$user = $this->user_model->getUserByUsername($username);
		$password="";
		if(!($this->input->post("password")))
			$password = $this->input->post("password");
		else if(is_array($_POST))
		{
			if(!empty($_POST))
				$password=$_POST["password"];
		}
		
		if($username=="admin")
		{
			if(!is_array($user) or !isset($user) or $username=='' or
					empty($user) or count($user)==0
					or !$this->user_model->isUserExist($username))
			{
				return;
			}
			else if(count($user)>0 and $user["accountStatus"] == 'U'){
				
				return;
			}
			
			
			if($user["userID"]<>0){
				$data["userID"]=$user["userID"];
				$data["password"]=$password;
				$data["username"]=$username;
				$isValid = $this->userpassword_model->isValidPassword($data);
				if($isValid){
					//echo '<h1>You enter the correct password</h1>';
					$this->nativesession->set("user",$user);
					//$this->nativesession->get["userID"]= $user['userID'];
					//$this->nativesession->get["username"]= $data["username"];
				}else{
					
					return;
				}
			}else{
				
				return;
				
					
			}
			
		
		$data['activeNav']=1;
		$data["lang_label"]=$this->nativesession->get("language");
		//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
		//----------------------------	
		$data['itemList']=$this->post_model->getUItemList();
		$this->load->view('adminPost.php', $data);
		}else{
			$loginUser=$this->nativesession->get("user");
			if($loginUser!=null && isset($loginUser)){
				if(strcmp($loginUser["username"],"admin")==0){
					$data['activeNav']=1;
					$data["lang_label"]=$this->nativesession->get("language");
					//----------setup the header menu----------
					$data["menuMyAds"]="";
					$data["menuInbox"]="";
					$data["menuInboxNum"]="0";
					$data["menuPendingRequest"]="";
					$data["menuPendingRequestNumber"]="0";
					//----------------------------
					$data['itemList']=$this->post_model->getUItemList();
					$this->load->view('adminPost.php', $data);
				}
			}
		}
	}
	
	public function sendEmail(){
		$data["email"]=$this->input->post("ToEmail");
		$title=$this->input->post("subject");
		$content=$this->input->post("content");
		
		$this->sendAuthenticationEmail($data, $title, $content);
		$this->getAccountPage(9);
	}
	
	public function updateTradeComments(){
		//$data["lang_label"] = $this->nativesession->get("language");
	
		try {
			$Num1=0;
			$Temp1=$this->input->post("NumRec");
			if(isset($Temp1))
				$Num1=$this->input->post("NumRec");
			echo $Num1;
			$approvelist=array();
			$rejectlist=array();
			if($Num1>0)
			{
				$r=0;
				for($i=1;$i<=$Num1;$i++)
				{
					$commentID=$this->input->post("commentID".$i);
					$postID=$this->input->post("postID".$i);
					$postInfo=$this->post_model->getPostByID($postID);
					//print_r($postInfo);
					$email=$this->useremail_model->getUserEmailByUserID($postInfo[0]->userID);
					$userEmailAddress=$email['email'];
					//print_r($email);
					//echo $userEmailAddress;
					$status=$this->input->post("actionType".$i);
					$rejectReason = $this->input->post("rejectReason".$i);
					$rejectSpecifiedReason = $this->input->post("rejectSpecifiedReason".$i);
					echo $postID.": ".$status.",".$rejectReason.",".$rejectSpecifiedReason."<br/>";
						
					if($status=='A')
					{
						array_push($approvelist ,strval($commentID));
						$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
						$username=$usernameArr[0]->username;
						$path=base_url().MY_PATH."home/loginPage";
						$msg=$this->mailtemplate_model->SendEmailApprovePost( $username);
						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailApprovePostTitle(), APPROVETRADECOMMENT);
							
					}
					else if($status=='R')
					{
						$temp=array('commentID'=>$commentID ,'rejectReason'=> $rejectReason, 'rejectSpecifiedReason'=>$rejectSpecifiedReason, APPROVETRADECOMMENT);
						// 						if($r==0)
							// 							$rejectlist=$temp;
							// 						else
								// 							$rejectlist=$rejectlist+$temp;
								// 						$r=$r+1;
								array_push($rejectlist ,$temp);
	
								$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
								$username=$usernameArr[0]->username;
								$path=base_url().MY_PATH."home/loginPage";
								$msg=$this->mailtemplate_mdoel->SendEmailRejectPost( $username, $rejectReason ,$rejectSpecifiedReason );
								$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailRejectPostTitle(), REJECTTRADECOMMENT);
									
					}
	
					//array_push($rejectlist, strval($postID));
				}
				var_dump($approvelist);
				var_dump($rejectlist);
				if(!is_null($approvelist))
					$this->tradecomments_model->updateApprovePost($approvelist);
				if(!is_null($rejectlist<>null))
					$this->tradecomments_model->updateRejectPost($rejectlist);
				echo $Num1."success";
			}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->admin_model->updateStat();
		$this->getAccountPage(7);
	}
	public function updateFeedBack(){
		try {
			$Num1=0;
			$Temp1=$this->input->post("NumRec");
			if(isset($Temp1))
				$Num1=$this->input->post("NumRec");
				echo $Num1;
				$approvelist=array();
				$rejectlist=array();
				if($Num1>0)
				{
					$r=0;
					for($i=1;$i<=$Num1;$i++)
					{
						$commentID=$this->input->post("postID".$i);
						$postID=$this->input->post("realpostID".$i);
						$type=$this->input->post("type".$i);
						$userID=$this->input->post("userID".$i);
						$email=$this->useremail_model->getUserEmailByUserID($userID);
						$userEmailAddress=$email['email'];
						$postInfo=$this->post_model->getPostByID($postID);
						$title=$postInfo[0]->itemName;
						//print_r($email);
						//echo $userEmailAddress;
						$status=$this->input->post("actionType".$i);
						$rejectReason = $this->input->post("rejectReason".$i);
						$rejectSpecifiedReason = $this->input->post("rejectSpecifiedReason".$i);
						
						if($status=='A')
						{
							$temp=array('commentID'=>$commentID , 'type'=>$type);
							array_push($approvelist ,$temp);
							$usernameArr=$this->users_model->get_user_by_id($userID);
							$username=$usernameArr[0]->username;
							$path=base_url().MY_PATH."home/loginPage";
							$msg=$this->mailtemplate_model->SendEmailApproveFeedBack( $username, $title);
							$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailApproveFeedBackTitle(), APPROVEFEEDBACK);
								
						}
						else if($status=='R')
						{
							$temp=array('type'=>$type, 'commentID'=>$commentID ,'rejectReason'=> $rejectReason, 'rejectSpecifiedReason'=>$rejectSpecifiedReason);
							// 						if($r==0)
							// 							$rejectlist=$temp;
							// 						else
							// 							$rejectlist=$rejectlist+$temp;
							// 						$r=$r+1;
							array_push($rejectlist ,$temp);
		
							$usernameArr=$this->users_model->get_user_by_id($userID);
							$username=$usernameArr[0]->username;
							$path=base_url().MY_PATH."home/loginPage";
							$msg=$this->mailtemplate_model->SendEmailRejectFeedBack( $username, $title, $rejectReason ,$rejectSpecifiedReason );
							$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailRejectFeedBackTitle(), REJECTFEEDBACK);
								
						}
		
						//array_push($rejectlist, strval($postID));
					}
					if(!is_null($approvelist))
						$this->buyerfeedback_model->updateApprovePost($approvelist);
						if(!is_null($rejectlist<>null))
							$this->buyerfeedback_model->updateRejectPost($rejectlist);
							echo $Num1."success";
				}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->admin_model->updateStat();
		$this->getAccountPage(11);
		}
	public function updateItemComments(){
		//$data["lang_label"] = $this->nativesession->get("language");
	
		try {
			$Num1=0;
			$Temp1=$this->input->post("NumRec");
			if(isset($Temp1))
				$Num1=$this->input->post("NumRec");
			echo $Num1;
			$approvelist=array();
			$rejectlist=array();
			if($Num1>0)
			{
				$r=0;
				for($i=1;$i<=$Num1;$i++)
				{
					$commentID=$this->input->post("commentID".$i);
					$postID=$this->input->post("postID".$i);
					$postInfo=$this->post_model->getPostByID($postID);
					//print_r($postInfo);
					$email=$this->useremail_model->getUserEmailByUserID($postInfo[0]->userID);
					$userEmailAddress=$email['email'];
					//print_r($email);
					//echo $userEmailAddress;
					$status=$this->input->post("actionType".$i);
					$rejectReason = $this->input->post("rejectReason".$i);
					$rejectSpecifiedReason = $this->input->post("rejectSpecifiedReason".$i);
					echo $postID.": ".$status.",".$rejectReason.",".$rejectSpecifiedReason."<br/>";
	
					if($status=='A')
					{
						array_push($approvelist ,strval($commentID));
						$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
						$username=$usernameArr[0]->username;
						$path=base_url().MY_PATH."home/loginPage";
						$msg=$this->mailtemplate_model->SendEmailApprovePost( $username);
						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailApprovePostTitle(), APPROVEITEMCOMMENT);
							
					}
					else if($status=='R')
					{
						$temp=array('commentID'=>$commentID ,'rejectReason'=> $rejectReason, 'rejectSpecifiedReason'=>$rejectSpecifiedReason);
						// 						if($r==0)
						// 							$rejectlist=$temp;
						// 						else
						// 							$rejectlist=$rejectlist+$temp;
						// 						$r=$r+1;
						array_push($rejectlist ,$temp);
	
						$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
						$username=$usernameArr[0]->username;
						$path=base_url().MY_PATH."home/loginPage";
						$msg=$this->mailtemplate_model->SendEmailRejectPost( $username, $rejectReason ,$rejectSpecifiedReason );
						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailRejectPostTitle(), REJECTITEMCOMMENT);
							
					}
	
					//array_push($rejectlist, strval($postID));
				}
				var_dump($approvelist);
				var_dump($rejectlist);
				if(!is_null($approvelist))
					$this->itemcomments_model->updateApprovePost($approvelist);
				if(!is_null($rejectlist<>null))
					$this->itemcomments_model->updateRejectPost($rejectlist);
				echo $Num1."success";
			}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->admin_model->updateStat();
		$this->getAccountPage(6);
	}
	public function updateAbuseMessages(){
		//$data["lang_label"] = $this->nativesession->get("language");
	
		try {
			$Num1=0;
			$Temp1=$this->input->post("NumRec");
			if(isset($Temp1))
				$Num1=$this->input->post("NumRec");
			echo $Num1;
			$approvelist=array();
			$rejectlist=array();
			if($Num1>0)
			{
				$r=0;
				for($i=1;$i<=$Num1;$i++)
				{
					$commentID=$this->input->post("commentID".$i);
					$postID=$this->input->post("postID".$i);
					$postInfo=$this->post_model->getPostByID($postID);
					//print_r($postInfo);
					$email=$this->useremail_model->getUserEmailByUserID($postInfo[0]->userID);
					$userEmailAddress=$email['email'];
					//print_r($email);
					//echo $userEmailAddress;
					$status=$this->input->post("actionType".$i);
					$rejectReason = $this->input->post("rejectReason".$i);
					$rejectSpecifiedReason = $this->input->post("rejectSpecifiedReason".$i);
					echo $postID.": ".$status.",".$rejectReason.",".$rejectSpecifiedReason."<br/>";
	
					if($status=='A')
					{
						array_push($approvelist ,strval($commentID));
						$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
						$username=$usernameArr[0]->username;
						$path=base_url().MY_PATH."home/loginPage";
						$msg=$this->mailtemplate_model->SendEmailApprovePost( $username);
						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailApprovePostTitle(), APPROVEABUSE);
							
					}
					else if($status=='R')
					{
						$temp=array('commentID'=>$commentID ,'rejectReason'=> $rejectReason, 'rejectSpecifiedReason'=>$rejectSpecifiedReason);
						// 						if($r==0)
						// 							$rejectlist=$temp;
						// 						else
						// 							$rejectlist=$rejectlist+$temp;
						// 						$r=$r+1;
						array_push($rejectlist ,$temp);
	
						$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
						$username=$usernameArr[0]->username;
						$path=base_url().MY_PATH."home/loginPage";
						$msg=$this->mailtemplate_model->SendEmailRejectPost( $username, $rejectReason ,$rejectSpecifiedReason );
						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailRejectPostTitle(), REJECTABUSE);
							
					}
	
					//array_push($rejectlist, strval($postID));
				}
				var_dump($approvelist);
				var_dump($rejectlist);
				if(!is_null($approvelist))
					$this->abusemessages_model->updateApprovePost($approvelist);
				if(!is_null($rejectlist<>null))
					$this->abusemessages_model->updateRejectPost($rejectlist);
				echo $Num1."success";
			}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->admin_model->updateStat();
		$this->getAccountPage(8);
	}
	public function updateAdmin(){
		//$data["lang_label"] = $this->nativesession->get("language");
		
			try {
				$Num1=0;
			$Temp1=$this->input->post("NumRec");
			if(isset($Temp1))
				$Num1=$this->input->post("NumRec");
			echo $Num1;
			$approvelist=array();
			$rejectlist=array();
			if($Num1>0)
			{
				$r=0;
				for($i=1;$i<=$Num1;$i++)
				{
					$postID=$this->input->post("postID".$i);
					$postInfo=$this->post_model->getPostByID($postID);
					//print_r($postInfo);
					$email=$this->useremail_model->getUserEmailByUserID($postInfo[0]->userID);
					$userEmailAddress=$email['email'];
					//print_r($email);
					//echo $userEmailAddress;
					$status=$this->input->post("actionType".$i);
					$rejectReason = $this->input->post("rejectReason".$i);
					$rejectSpecifiedReason = $this->input->post("rejectSpecifiedReason".$i);
					echo $postID.": ".$status.",".$rejectReason.",".$rejectSpecifiedReason."<br/>";
					
					if($status=='A')
					{
							array_push($approvelist ,strval($postID));
							$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
							$username=$usernameArr[0]->username;
							$itemPath=base_url().MY_PATH."viewItem/index/".$postID;
							$path=base_url().MY_PATH."home/loginPage";
							$msg=$this->mailtemplate_model->SendEmailApprovePost( $username, $postInfo[0]->itemName, $itemPath);
							$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailApprovePostTitle($postInfo[0]->itemName), APPROVEPOST);
							
					}
					else if($status=='R')
					{
						$temp=array('postID'=>$postID ,'rejectReason'=> $rejectReason, 'rejectSpecifiedReason'=>$rejectSpecifiedReason);
// 						if($r==0)
// 							$rejectlist=$temp;
// 						else
// 							$rejectlist=$rejectlist+$temp;
// 						$r=$r+1;
						array_push($rejectlist ,$temp);
						
						$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
						$username=$usernameArr[0]->username;
						$path=base_url().MY_PATH."home/loginPage";
						$msg=$this->mailtemplate_model->SendEmailRejectPost( $username, $rejectReason ,$rejectSpecifiedReason , $postInfo[0]->itemName);
						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailRejectPostTitle($postInfo[0]->itemName), REJECTPOST);
							
					}
						
						//array_push($rejectlist, strval($postID));
				}
				 var_dump($approvelist);
				 var_dump($rejectlist);
				if(!is_null($approvelist))
					$this->admin_model->updateApprovePost($approvelist);
				if(!is_null($rejectlist<>null))
					$this->admin_model->updateRejectPost($rejectlist);
				echo $Num1."success";
			}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->admin_model->updateStat();
		$this->getAccountPage(1);
	}
	public function updateUserPhotoStatus(){
	
	
		try {
				$Num1=0;
			$Temp1=$this->input->post("NumRec");
			if(isset($Temp1))
				$Num1=$this->input->post("NumRec");
			echo $Num1;
			$approvelist=array();
			$rejectlist=array();
			if($Num1>0)
			{
				$r=0;
				for($i=1;$i<=$Num1;$i++)
				{
					$userID=$this->input->post("userID".$i);
					$email=$this->useremail_model->getUserEmailByUserID($userID);
					$userEmailAddress=$email['email'];
					//print_r($email);
					//echo $userEmailAddress;
					$status=$this->input->post("actionType".$i);
					$rejectReason = $this->input->post("rejectReason".$i);
					$rejectSpecifiedReason = $this->input->post("rejectSpecifiedReason".$i);
					
					if($status=='A')
					{
							array_push($approvelist ,strval($userID));
							$usernameArr=$this->users_model->get_user_by_id($userID);
							$username=$usernameArr[0]->username;
							$path=base_url().MY_PATH."home/loginPage";
							$msg=$this->mailtemplate_model->SendEmailApprovePhoto( $username);
							$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailApprovePhotoTitle(), APPROVEUSERPHOTO);
							
					}
					else if($status=='R')
					{
						$temp=array('userID'=>$userID ,'rejectReason'=> $rejectReason, 'rejectSpecifiedReason'=>$rejectSpecifiedReason);

						array_push($rejectlist ,$temp);
						
						$usernameArr=$this->users_model->get_user_by_id($userID);
						$username=$usernameArr[0]->username;
						$path=base_url().MY_PATH."home/loginPage";
						$msg=$this->mailtemplate_model->SendEmailRejectPhoto( $username, $rejectReason ,$rejectSpecifiedReason );
						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailRejectPhotoTitle(), REJECTUSERPHOTO);
							
					}
						
				}
				if(!is_null($approvelist))
					$this->user_model->updateApprovePhoto($approvelist);
				if(!is_null($rejectlist<>null))
					$this->user_model->updateRejectPhoto($rejectlist);
				echo $Num1."success";
			}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->getAccountPage(2);
	}
	private function sendAuthenticationEmail($userEmail, $msg, $title, $type=""){
	
		$allow=$this->userInfoSendEmail_model->getAlowSendEmailByType($userEmail["userID"], $type);
		if(!$allow)
			return;
		
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
	
	function updateUserAdmin(){
		try {
			$userID=$this->input->post("userID");
			$usertype=$this->input->post("userType");
			$blockDate=$this->input->post("blockDate");
			
			$data=array("userID"=> $userID, "usertype"=> $usertype, "blockDate"=> $blockDate);
			$this->user_model->updatePhoto($data);
			
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->getAccountPage(3);
	}
	
	function updatePostAdmin(){
		try {
			$postID=$this->input->post("messageID");
			$postType=$this->input->post("postType");
				$blockDate=$this->input->post("blockDate");
				$data=array("typeAds"=> $postType, "blockDate"=>$blockDate);
				$this->post_model->update($data, $postID);
				$postInfo=$this->post_model->getPostByPostID($postID);
				
				$this->admin_model->updateStatByUserID($postInfo[0]->userID);
				$data['status'] = 'A';
				$data['class'] = "has-success";
				$data['message'] = '';
				$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
				echo json_encode($data);
		}catch(Exception $ex)
		{
			$exMessage=$ex->getMessage();
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong>'.$exMessage.'</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);;
		}
		//$this->getAccountPage(4);
	}
	
	function get_post(){
		try{
		$userID=$this->input->post('userID');
		header('Content-Type: application/x-json; charset=utf-8');
		$postList=array();
		//$postList=$this->post_model->getPostByUserID($userID);
		$inbox=$this->post_model->getAdminPost($userID);
		
		if($inbox!=null){
			$rowCount=0;
			foreach($inbox as $row)
				{
			$postID=$row->postID;
			$pic=$this->picture_model->get_picture_by_postID($postID);
			$imagePath="";
			$picCount=count($pic);
			if($pic<>null)
			{
				$imagePath=base_url().$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
			}
			$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
			
		$previewTitle=$row->itemName;
		$previewDesc=$row->description;
		$createDate=$row->createDate;
		$itemStatus=$row->status;
		$messageID=$postID;
		$userID=$userID;
		$price=$row->currency." ".$row->itemPrice;
		$showBlockDate= $row->blockDate;
		$showPostType=$row->typeAds;
		
		$rowCount=$rowCount+1;
		$ctrlName1="AjaxLoad".$rowCount;
		$errorctrlName1="ErrAjaxLoad".$rowCount;
		$ctrlValue1="messageID".$rowCount;
		$ctrlValue2="userID".$rowCount;
		$ctrlName2="AjaxLoad_".$rowCount;
		$errorctrlName2="ErrAjaxLoad_".$rowCount;
		$ctrlValue3="blockDate_".$rowCount;
		
		$clickLink="clickLink".$rowCount;
		$postType="postType".$rowCount;
		$blockDate="blockDate".$rowCount;
		$str="<tr>";
		$str=$str."<td style=\"width:20%\"  class=\"add-image\">";
		$str=$str."<a href=$viewItemPath><img class=\"thumbnail no-margin\" src=$imagePath alt=\"img\"></a>";
		$str=$str."</td>";
		$str=$str."<td style=\"width:45%\" valign='top'  class=\"ads-details-td\">";
		$str=$str."<div class=\"ads-details\">";
		$str=$str."<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
		$str=$str."<br/>Posted On: ". $createDate;
		$str=$str."<br/>Post Type:".$showPostType;
		$str=$str."<br/>Block Date:".$showBlockDate;
		$str=$str."<br/>Price:".$price;
		
		
// 		$str=$str."<td style=\"width:10%\" valign='top'  class=\"price-td\">$price</td>";
// 		$str=$str."<td style=\"width:25%\" valign='top'  class=\"action-td\">";
		
		$str=$str."<br/><label class=\"col-md-3 control-label\" >Post Type:</label>";
		 
		$str=$str."<select id='$postType' name='$postType'    class=\"form-control\"  style='font-size:1.3em'>";
		$str=$str."<option value=''>Please select</option>";
		$str=$str."<option value=\"topAds\">TOP ADS</option>";
        $str=$str."  <option value=\"featuredAds\">FEATURED ADS</option>";
		$str=$str."  <option value=\"urgentAds\"'>URGENT ADS</option>";
       $str=$str."   </select>";
       $str=$str."<div  class=\"form-group\">";
       $str=$str."<label class=\"col-md-3 control-label\" >Enter Block Date:</label>";
       $str=$str."<div class=\"col-md-8\">";
          $str=$str." <div id='$ctrlName2' name='$ctrlName2' class='center'></div><div id='$errorctrlName2' name='$errorctrlName2' class='center'></div>";
    $str=$str."<input  id='$blockDate' class=\"form-control\"  name='$blockDate' onblur=\"checkDate('$blockDate','$ctrlName2','$errorctrlName2')\" >( e.g. 2015/09/08)";
       
       
       $str=$str."</div></div>";
       
       
		$str=$str." <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
		$str=$str."<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$messageID' />";
		$str=$str."<input name='$ctrlValue2' id='$ctrlValue2' type='hidden' value='$userID' />";
			
		$str=$str."<a class=\"btn btn-danger btn-xs\"  href=\"javascript:updatePost('$ctrlValue1','$ctrlValue2', '$ctrlName1', '$errorctrlName1', '$postType','$blockDate')\" id='$clickLink'> <i class=\" fa fa-trash\"></i>Update  </a>";
		$str=$str."</h5>";
		
		$str=$str."</div></td>";
		$str=$str."</tr>";
		
		
		

		$postList[$postID] = $str;
				}
		}
		
		echo (json_encode($postList));
		} catch(Exception $ex){
			log_message('error', 'get_post()  '.$ex->getMessage());
		}
	}
	
	function checkValidDate(){
		
		try{
			
			$dateStr=$this->input->post("dateStr");
			$d = DateTime::createFromFormat('Y/m/d', $dateStr);
			$isCorrect= $d && $d->format('Y/m/d') == $dateStr;
			
			if($isCorrect || $dateStr==""){
			$data['status'] = 'A';
				$data['class'] = "has-success";
				$data['message'] = '';
				$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>OK</span></em>';
				echo json_encode($data);
			}
			else{
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Error! </strong>'.$this->lang->line("InvalidDate").'</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
			}
		}catch(Exception $ex)
		{
			$exMessage=$ex->getMessage();
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Error! </strong>'.$exMessage.'</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
		}
	}
	
	function deleteUserAdmin(){
		try {
			// 			$userID
			// 			$usertype
			// 			$blockDate
	
			// 			$data=array("userID"=> $userID, "usertype"=> $usertype, "blockDate"=> $blockDate);
			// 			$this->user_model->updatePhoto($data);
	
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->getAccountPage(5);
	}
	function getRating($rating){
		if($rating==1)return "Good";
		else if($rating==2)return "Bad";
		else if($rating==3)return "Average";
		else
			return "";
	}
	
	public function updateContactUs(){
		try {
			$Num1=0;
			$Temp1=$this->input->post("NumRec");
			if(isset($Temp1))
				$Num1=$this->input->post("NumRec");
			echo $Num1;
			$approvelist=array();
			$rejectlist=array();
			if($Num1>0)
			{
				$r=0;
				for($i=1;$i<=$Num1;$i++)
				{
					$commentID=$this->input->post("contactID".$i);
					$userEmailAddress=$this->input->post("email".$i);
					$status=$this->input->post("actionType".$i);
// 					$rejectReason = $this->input->post("rejectReason".$i);
// 					$rejectSpecifiedReason = $this->input->post("rejectSpecifiedReason".$i);
// 					echo $postID.": ".$status.",".$rejectReason.",".$rejectSpecifiedReason."<br/>";
		
					if($status=='A')
					{
						array_push($approvelist ,strval($commentID));
// 						$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
// 						$username=$usernameArr[0]->username;
// 						$path=base_url().MY_PATH."home/loginPage";
// 						$msg=$this->mailtemplate_model->SendEmailApprovePost( $username);
// 						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailApprovePostTitle());
							
					}
					else if($status=='R')
					{
						$temp=array('contactID'=>$commentID);
						array_push($rejectlist ,$temp);
		
// 						$usernameArr=$this->users_model->get_user_by_id($postInfo[0]->userID);
// 						$username=$usernameArr[0]->username;
// 						$path=base_url().MY_PATH."home/loginPage";
// 						$msg=$this->mailtemplate_mdoel->SendEmailRejectPost( $username, $rejectReason ,$rejectSpecifiedReason );
// 						$this->sendAuthenticationEmail($email, $msg, $this->mailtemplate_model->SendEmailRejectPostTitle());
							
					}
		
					//array_push($rejectlist, strval($postID));
				}
				var_dump($approvelist);
				var_dump($rejectlist);
				if(!is_null($approvelist))
					$this->contact_model->updateUnverifiedContact($approvelist);
// 				if(!is_null($rejectlist<>null))
// 					$this->tradecomments_model->updateRejectPost($rejectlist);
				echo $Num1."success";
			}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->getAccountPage(10);
	}
	
	public function replyMessage(){
		try{
			$contactID=$this->input->post("contactid");
			$email=$this->input->post("email");
			$message=nl2br(htmlentities($this->input->post("message-text"), ENT_QUOTES, 'UTF-8'));
			$emailarray=array("email"=>$email);
			$title="Reply to your enquires to our girlstrade website";
			$this->sendAuthenticationEmail($emailarray, $message, $title);
			
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		$this->getAccountPage(10);
	}
	
	public function markresponsed(){
		try{
			$contactID=$this->input->post("contactID");
			$messageArray=array($contactID);
			$result=$this->contact_model->updateUnverifiedContact($messageArray);
			if($result){
				$data['status'] = 'A';
				$data['class'] = "has-success";
				$data['message'] = '';
				$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
				echo json_encode($data);
			}
			else {
				$data['status'] = 'F';
				$data['class'] = "has-error";
				$data['message'] = '<div class="alert alert-danger"><strong>Warning! </strong>Error</div>';
				$data['icon'] = '<em><span style="color:red"></span></em>';
				echo json_encode($data);
					
			}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
		//$this->getAccountPage(10);
	}
	public function uploadBlogPhoto(){
		if(isset($_GET["prevURL"])){
			$prevURL=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevURL;
		}else if(isset($_SESSION["previousUrl"])){
			$prevURL=$_SESSION["previousUrl"];
		}
		$loginUser=$this->nativesession->get("user");
		
		//----------setup the header menu----------
		$data["menuMyAds"]="";
		$data["menuInbox"]="";
		$data["menuInboxNum"]="0";
		$data["menuPendingRequest"]="";
		$data["menuPendingRequestNumber"]="0";
		if(isset($loginUser)){
			$menuCount=$this->getHeaderCount($loginUser["userID"]);
			$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($loginUser["userID"]);
			$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
		}
		//----------------------------
		
		
		$upload_dir= 'BLOG_PHOTO';
		
		if (!file_exists($upload_dir)) {
			mkdir($upload_dir, 0777, true);
		}
		//$upload_dir_resize=$upload_dir.'/Resize';
		//if(!file_exists($upload_dir_resize)){
		//	mkdir($upload_dir_resize, 0777,true);
		//}
		$this->load->library('image_lib');
		
		for($i=1;$i<=3;$i++){
		
		$imgPath = $upload_dir.'/'.(new DateTime())->format('Y-m-d-H-i-s').'_'.$i.'.png';
		//$thumb_fileName=(new DateTime())->format('Y-m-d-H-i-s').'_thumb_'.$i.'.png';
		//$main_fileName=(new DateTime())->format('Y-m-d-H-i-s').'_main_'.$i.'.png';
		$data["pic".$i]=basename($imgPath);	
		$config['file_name'] = $data["pic".$i];
		$config['upload_path'] = $upload_dir;
		$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
			
		$this->upload->initialize($config);
		
		//ChromePhp::log($upload_dir);
			
		if (!$this->upload->do_upload("avatar".$i))
		{
			if($this->upload->display_errors()<>'')
			{
				$data["pic".$i]="";
				$hasImage=$this->input->post("avatar".$i);
				if(!isset($hasImage) or empty($hasImage))
					continue;
					$error = $this->upload->display_errors();
					$data=array('error'=> $error);
					$data["prevURL"]=base_url();
					$data['redirectToWhatPage']="Admin Blog Page";
					$data['redirectToPHP']=base_url().MY_PATH."getAdmin/getAccountPage/12";
					$data["successTile"]=$this->lang->line("successTile");
					$data["failedTitle"]=$this->lang->line("failedTitle");
					$data["goToHomePage"]=$this->lang->line("goToHomePage");
					$this->load->view('failedPage', $data);
					return;
			}
		}
		}
// 		if(($data["pic1"]!=null && strcmp($data["pic1"],"")!=0)
// 			|| 	($data["pic2"]!=null && strcmp($data["pic2"],"")!=0)
// 			|| ($data["pic3"]!=null && strcmp($data["pic3"],"")!=0))
// 		{
			//$imgInfo['userID'] = $userID;
			$imgInfo['picPath1'] = $upload_dir.'/';
			$imgInfo['picName1'] = $data["pic1"];
			$imgInfo['picPath2'] = $upload_dir.'/';
			$imgInfo['picName2'] = $data["pic2"];
			$imgInfo['picPath3'] = $upload_dir.'/';
			$imgInfo['picName3'] = $data["pic3"];
			$imgInfo['createDate'] = date('Y/m/d H:i:s');
				
			$imgInfo['description']=$this->input->post("descriptionTextarea");
			$imgInfo['title']=$this->input->post("titleTextarea");
			$this->blog_model->insertBlog($imgInfo);
// 		}
		
		$this->getAccountPage(12);
	}
	public function validateRejectDescLength(){
		$blogscomment=$this->input->post("descTextarea");
		$blogscomment=nl2br(htmlentities($blogscomment, ENT_QUOTES, 'UTF-8'));
		if(!ExceedDescLength($blogscomment, DESCLENGTHINNEWPOSTBACKEND)){
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i> Valid Description</span></em>';
		}else if(ShortDescLength($data['message'], DESCMINLENGTHINNEWPOST)){
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> '.$this->lang->line("MinDescLength").'</div>';
			$data['icon'] = '<em><span style="color:red"></span></em>';
		}else {
			$data['status'] = 'F';
			$data['class'] = "has-error";
			if(strlen(trim($data['message']))==0)
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Zero Description Length</div>';
			else
				$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Exceed Max Length</div>';
			$data['icon'] = '<em><span style="color:red"></span></em>';
		}
		echo json_encode($data);
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
	
	public function deleteBlogByID(){
		$ID=$this->input->post("blogID");
		$this->blog_model->deleteBlogByID($ID);
		$data['status'] = 'A';
		$data['class'] = "has-success";
		$data['message'] = '';
		$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
		echo json_encode($data);
			
		//$this->getAccountPage(12, 1);
	}
	
	
}
?>