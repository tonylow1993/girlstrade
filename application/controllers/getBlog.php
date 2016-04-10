<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class getBlog extends CI_Controller {
    	
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
			$this->load->model('contacttype_model');
			$this->load->model('contact_model');
			$this->load->model('pagevisited_model');
			$this->load->model('blog_model');
		}
		
		public function viewBlog ($ID=0)
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
			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			//----------------------------
			if(isset($loginUser)){
				$data["isloginedIn"]=true;
				$menuCount=$this->getHeaderCount($loginUser['userID']);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($loginUser['userID']); //$menuCount["inboxMsgCount"]; //
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			$data["result"]=$this->blog_model->getBlogByID($ID);
			$data["pic1"]=base_url().$data["result"][0]->picPath1.$data["result"][0]->picName1;
			if(strcmp($data["result"][0]->picName2,"")!=0)
				$data["pic2"]=base_url().$data["result"][0]->picPath2.$data["result"][0]->picName2;
			else 
				$data["pic2"]="";
			if(strcmp($data["result"][0]->picName3,"")!=0)
				$data["pic3"]=base_url().$data["result"][0]->picPath3.$data["result"][0]->picName3;
			else 
				$data["pic3"]="";
			
			$data["title"]=$data["result"][0]->title;
			$data["description"]=$data["result"][0]->description;
			$data["createDate"]=$data["result"][0]->createDate;
				
			$this->load->view('blog-details', $data);
		}
    }
?>