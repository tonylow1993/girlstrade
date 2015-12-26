<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once 'getCategory.php';
class viewProfile extends getCategory {
	public function __construct()
	{
		parent::__construct(true);
		$this->load->library("nativesession");
		
		$this->load->model('post_model');
		$this->load->model('users_model');
		$this->load->model('user_model', 'user');
		$data["lang_label"] = $this->nativesession->get("language");
            $this->lang->load("message",$this->nativesession->get('language'));
            
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
         public function index($postID,$pageNum=1, $catID='', $locID='',$keywords='',$sortByID="0" )
	{
		$previousUrl="";
		if(isset($_GET["prevURL"]))
			$previousUrl=$_GET["prevURL"];
		else 
			$previousUrl=base_url();
			$prevURL=$previousUrl;
		$_SESSION["previousUrl"]=$previousUrl;
			$data["previousCurrent_url"]=($previousUrl);
		
           $data["lang_label_text"] = $this->lang->line("lang_label_text");
		 $data["lang_label"] = $this->lang->line("lang_label");
			$data["postID"]=$postID;
			$postInfo=$this->post_model->getPostByPostID($postID);
			$data["userID"]=$postInfo[0]->userID;
			$userInfo=$this->users_model->get_user_by_id($data["userID"]);
			
			$loginUser=$this->nativesession->get("user");
			
			if($userInfo[0]->blockDate!=null && $userInfo[0]->blockDate> date('Y-m-d'))
			{
				if( empty($loginUser) || 						
						(!empty($loginUser) &&  isset($loginUser) && $loginUser<>null &&  $loginUser["userID"]<>0
							&& strcmp($loginUser["username"],"admin")!=0))
				{
				$errorMsg=$this->lang->line("NotAllowCreatePostBlackList");
				$data["error"]=$errorMsg;
				$data["prevURL"]=$prevURL;
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
				}
			}
			
			
			
			
			$date=$userInfo[0]->lastLoginTime;
			$data["lastLoginTime"]=$date; //->format('Y-m-d H:i:s');
			 $user1=$this->user->getUserByUserID($data["userID"]);
			 if(strcmp($user1["photostatus"],"A")==0)
			$data["userPhotoPath"]=base_url().$user1['thumbnailPath'].'/'.$user1['thumbnailName'];
		else 
			$data["userPhotoPath"]=base_url()."images/user.jpg";
		
			 
			$data["userName"]=$userInfo[0]->username;
			$createDate=$userInfo[0]->createDate;
			$data["createDate"]=$createDate;
			$data["prevURL"]=$previousUrl;
			$data["pageNum"]=$pageNum;
			$data["catID"]=$catID;
			$data["locID"]=$locID;
			$data["keywords"]=base64_decode($keywords);
			$tempSortByID=$this->input->post("sortByPrice");
			if(!empty($tempSortByID))
				$data["sortByID"]=$this->input->post("sortByPrice");
			else 
				$data["sortByID"]=$sortByID;
            $NoOfItemCount=0;
			$data["itemList"]=$this->post_model->getItemList($pageNum, $data["userID"], $catID, $locID, $keywords, $data["sortByID"]);
			$NoOfItemCount=$this->post_model->getNoOfItemCount($data["userID"], $catID, $locID, $keywords);
	      
			$data["NoOfItemCount"]=$NoOfItemCount;
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
	         $this->nativesession->set("lastPageVisited","newPost");
            $this->load->view('profile', $data);
	}
    
	public function viewByUserID($userID,$pageNum=1, $catID='', $locID='',$keywords='',$sortByID="0" )
	{
		$previousUrl="";
		if(isset($_GET["prevURL"]))
			$previousUrl=$_GET["prevURL"];
		else
			$previousUrl=base_url();
		$prevURL=$previousUrl;
		$_SESSION["previousUrl"]=$previousUrl;
			$data["previousCurrent_url"]=($previousUrl);
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["lang_label"] = $this->lang->line("lang_label");
		$data["userID"]=$userID;
		$userInfo=$this->users_model->get_user_by_id($data["userID"]);
			
		$loginUser=$this->nativesession->get("user");
			
		if($userInfo[0]->blockDate!=null && $userInfo[0]->blockDate> date('Y-m-d'))
		{
			if( empty($loginUser) ||
					(!empty($loginUser) &&  isset($loginUser) && $loginUser<>null &&  $loginUser["userID"]<>0
							&& strcmp($loginUser["username"],"admin")!=0))
			{
				$errorMsg=$this->lang->line("NotAllowCreatePostBlackList");
				$data["error"]=$errorMsg;
				$data["prevURL"]=$prevURL;
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
		}
			
			
			
			
		$date=$userInfo[0]->lastLoginTime;
		$data["lastLoginTime"]=$date; //->format('Y-m-d H:i:s');
		$user1=$this->user->getUserByUserID($data["userID"]);
		if(strcmp($user1["photostatus"],"A")==0)
			$data["userPhotoPath"]=base_url().$user1['thumbnailPath'].'/'.$user1['thumbnailName'];
		else
			$data["userPhotoPath"]=base_url()."images/user.jpg";
	
	
		$data["userName"]=$userInfo[0]->username;
		$createDate=$userInfo[0]->createDate;
		$data["createDate"]=$createDate;
		$data["prevURL"]=$previousUrl;
		$data["pageNum"]=$pageNum;
		$data["catID"]=$catID;
		$data["locID"]=$locID;
		$data["keywords"]=base64_decode($keywords);
		$tempSortByID=$this->input->post("sortByPrice");
		if(!empty($tempSortByID))
			$data["sortByID"]=$this->input->post("sortByPrice");
		else
			$data["sortByID"]=$sortByID;
		$NoOfItemCount=0;
		$data["itemList"]=$this->post_model->getItemList($pageNum, $data["userID"], $catID, $locID, $keywords, $data["sortByID"]);
		$NoOfItemCount=$this->post_model->getNoOfItemCount($data["userID"], $catID, $locID, $keywords);
		 
		$data["NoOfItemCount"]=$NoOfItemCount;
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
		$this->nativesession->set("lastPageVisited","newPost");
		$this->load->view('profile', $data);
	}
	
	
}