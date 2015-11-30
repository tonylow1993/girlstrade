<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getAdmin extends CI_Controller {
	var $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		$this->load->helper('language');
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
		$this->load->model("user_model");
		$this->load->model("useremail_model");
		$this->load->model("userpassword_model");
		$this->load->model("admin_model");
        $this->load->model("users_model");
	}
	
	public function index($Photo=0)
	{
		if($Photo==0){
		$data["lang_label"]=$this->nativesession->get("language");
		$this->nativesession->set("lastPageVisited","login");
		$this->load->view('adminLogin', $data);
		}
		else if($Photo==1){
			$data["lang_label"]=$this->nativesession->get("language");
			$this->nativesession->set("lastPageVisited","login");
			$this->load->view('adminUserPhotoLogin', $data);
		}
	}
	
	public function loginUser()
	{
		$username="";
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
			
		
		$data['pageNum']=1;
		$data['itemList']=$this->post_model->getUItemList();
		$this->load->view('admin.php', $data);
		}else{
			$loginUser=$this->nativesession->get("user");
			if($loginUser!=null && isset($loginUser)){
				if(strcmp($loginUser["username"],"admin")==0){
					$data['pageNum']=1;
					$data['itemList']=$this->post_model->getUItemList();
					$this->load->view('admin.php', $data);
				}
			}
		}
	}
	
	public function loginUserPhoto()
	{
		$username="";
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
				
	
			$data['pageNum']=1;
			$data['itemList']=$this->user_model->getUnverifyUserPhoto();
			$this->load->view('updateUserPhotoStatus.php', $data);
		}
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
							$path=base_url().MY_PATH."home/loginPage";
							$msg=sprintf($this->lang->line("SendEmailApprovePost"), $username);
							$this->sendAuthenticationEmail($email, $msg, $this->lang->line("SendEmailApprovePostTitle"));
							
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
						$msg=sprintf($this->lang->line("SendEmailRejectPost"), $username, $rejectReason ,$rejectSpecifiedReason );
						$this->sendAuthenticationEmail($email, $msg, $this->lang->line("SendEmailRejectPostTitle"));
							
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
							$msg=sprintf($this->lang->line("SendEmailApprovePhoto"), $username);
							$this->sendAuthenticationEmail($email, $msg, $this->lang->line("SendEmailApprovePhotoTitle"));
							
					}
					else if($status=='R')
					{
						$temp=array('userID'=>$userID ,'rejectReason'=> $rejectReason, 'rejectSpecifiedReason'=>$rejectSpecifiedReason);

						array_push($rejectlist ,$temp);
						
						$usernameArr=$this->users_model->get_user_by_id($userID);
						$username=$usernameArr[0]->username;
						$path=base_url().MY_PATH."home/loginPage";
						$msg=sprintf($this->lang->line("SendEmailRejectPhoto"), $username, $rejectReason ,$rejectSpecifiedReason );
						$this->sendAuthenticationEmail($email, $msg, $this->lang->line("SendEmailRejectPhotoTitle"));
							
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