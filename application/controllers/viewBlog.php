<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class viewBlog extends CI_Controller {
    	
 	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		
		
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('users_model');
		$this->load->helpers('site');
		$this->load->helper('language');
		date_default_timezone_set("Asia/Hong_Kong");
		$this->load->model('userinfo_model');
		$this->load->model('userstat_model');
		$this->load->model('messages_model');
		$this->load->model('blog_model');
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
	public function index()
	{
		$loginUser=$this->nativesession->get("user");
		//----------setup the header menu----------
		$data["menuMyAds"]="";
		$data["menuInbox"]="";
		$data["menuInboxNum"]="0";
		$data["menuPendingRequest"]="";
		$data["menuPendingRequestNumber"]="0";
		if(isset($loginUser)){
			$menuCount=$this->getHeaderCount($loginUser["userID"]);
			$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($loginUser["userID"]); //$menuCount["inboxMsgCount"]; // //$this->messages_model->getUnReadInboxMessage($user[0]->userID);
			$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
		}
		//----------------------------
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
		$data["Logout"]=$this->lang->line("Logout");
		$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
			
		$data["lang_label"]=$this->nativesession->get("language");
		$this->load->view('blogs', $data);
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
}
		