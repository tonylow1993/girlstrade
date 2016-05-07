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
			$this->load->model('category_model');
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
			$data["pageNum"] = 1;
			//----------------------------
			if(isset($loginUser)){
				$data["isloginedIn"]=true;
				$menuCount=$this->getHeaderCount($loginUser['userID']);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($loginUser['userID']); //$menuCount["inboxMsgCount"]; //
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
			$data["result"]=$this->blog_model->getBlogByID($ID);
			if(strcmp($data["result"][0]->picName1,"")!=0)
				$data["pic1"]=base_url().$data["result"][0]->picPath1.$data["result"][0]->picName1;
				else
					$data["pic1"]="";
			$data["checkPic1"]=$data["result"][0]->picPath1.$data["result"][0]->picName1;
			if(strcmp($data["result"][0]->picName2,"")!=0)
				$data["pic2"]=base_url().$data["result"][0]->picPath2.$data["result"][0]->picName2;
			else 
				$data["pic2"]="";
			$data["checkPic2"]=$data["result"][0]->picPath2.$data["result"][0]->picName2;
			if(strcmp($data["result"][0]->picName3,"")!=0)
				$data["pic3"]=base_url().$data["result"][0]->picPath3.$data["result"][0]->picName3;
			else 
				$data["pic3"]="";
			$data["checkPic3"]=$data["result"][0]->picPath3.$data["result"][0]->picName3;
					
			$data["title"]=$data["result"][0]->title;
			$data["description"]=$data["result"][0]->description;
			$data["createDate"]=$data["result"][0]->createDate;
			
			$data["blogList"]=$this->blog_model->getBlog();
			$data["popularMakes1"]=$this->getPopularCategory(5, 0);
			 
			$this->load->view('blog-details', $data);
		}
		
		public function viewAllBlog($pageNum=1){
			
			$prevUrl=base_url();
			if(isset($_GET["prevURL"])) {
				$prevUrl=$_GET["prevURL"];
				$_SESSION["previousUrl"]=$prevUrl;
			}
			else if(isset($_SESSION["previousUrl"]))
				$prevUrl=$_SESSION["previousUrl"];
			
			$data["prevUrl"]=$prevUrl;
			$data["previousCurrent_url"]=$prevUrl;
			$data["pageNum"]=$pageNum;
	
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

			//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="class=\"active\"";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			$data["activeTab"]="allAds";
			
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
				
			$data["result"]=$this->blog_model->getBlog();
			if($data["result"]!=null)
				$data["NoOfItemCount"]=count($data["result"]);
			else 
				$data["NoOfItemCount"]=0;
			$data["pic1"]=base_url().$data["result"][0]->picPath1.$data["result"][0]->picName1;
			$data["pic2"]=base_url().$data["result"][0]->picPath2.$data["result"][0]->picName2;
			$data["pic3"]=base_url().$data["result"][0]->picPath3.$data["result"][0]->picName3;
			$data["title"]=$data["result"][0]->title;
			$data["description"]=$data["result"][0]->description;
			$data["HotProduct"]=$this->getRecentProduct();
			$data["popularMakes1"]=$this->getPopularCategory(5, 0);
			 
			$this->load->view("blogs", $data);
		}
		function getPopularCategory($first, $second)
		{
			return $this->category_model->getPopularCategory($first, $second);
		}
	    function getRecentProduct()
	    {
	    	return $this->post_model->getRecentProduct();
	    }
    }
?>