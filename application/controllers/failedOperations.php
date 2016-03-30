<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'ChromePhp.php';

class failedOperations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
	    
		$this->load->helper('url');
		$this->load->helper(array('form', 'url'));
		$this->load->database();
		$this->load->library('upload');
		$this->load->library('image_lib');
		//$this->load->model('users_model');
       	$this->load->model('post_model', 'post');
        $this->load->model('picture_model', 'picture');
        $this->load->model('category_model', 'cat');
		$this->load->model('tag_model', 'tag');
        $this->load->model('location_model');

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
        
    public function index($userID=0, $errorMsg='')
	{
		$prevURL="";
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
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		  
 	        $userInfo=$this->nativesession->get("user");
 	        if($userID==0 & !empty($userInfo))
 	        	$data["userID"]=$userInfo["userID"];
 	        else 
 	        	$data["userID"]=$userID;
 	        	
			$user1=$this->nativesession->get("user");
			if(isset($user1)){
				$data["userName"]=$user1["username"];
			
			}
 	        $data["lang_label"]=$this->nativesession->get("language");


  
		
            $this->nativesession->set("lastPageVisited","howgirlstradeworks");

			
			
            $data["error"]= ($errorMsg);
            $data["prevURL"]=$prevURL;
            

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
			//----------------------------
            $this->load->view('failedOperPage', $data);
	}
}



