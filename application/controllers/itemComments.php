<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class itemComments  extends CI_Controller {
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
        $this->load->model('tradecomments_model');
        $this->load->model('itemcomments_model');
        $this->load->model('abusemessages_model');
	}
	
	public function insertItemComment(){
		
		try {
			$prevURL=base_url();
			if(isset($_GET["prevURL"])){
				$prevURL=$_GET["prevURL"];
				$_SESSION["previousUrl"]=$prevURL;
			}else if(isset($_SESSION["previousUrl"])){
				$prevURL=$_SESSION["previousUrl"];
			}
			
			$userInfo=$this->nativesession->get("user");
			$usercommentID=0;
			$username="";
			if(!empty($userInfo)){
				$usercommentID=$userInfo["userID"];
				$username=$userInfo["username"];
			}else{
				$errorMsg=$this->lang->line("PostPleaseLoginFirst");
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
			
			$postID=$this->input->post("postID");
			$name=$this->input->post("author");
			$email-$this->input->post("email");
			$comment=$this->input->post("blogscomment");
			$parentID=$this->input->post("parentID");
			
			$data=array("postID"=>$postID, "usercommentID" =>$usercommentID, "parentID"=>$parentID,      
					"comments"=> $comment, "status"=>"U", "createDate"=>date("Y-m-d H:i:s"));
			
			$this->itemcomments_model->insertItemComment($data);
			redirect($prevURL);
		}
		catch(Exception $ex){}
	}
	
	
}
?>