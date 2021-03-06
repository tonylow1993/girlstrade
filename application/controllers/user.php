<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {
	public function __construct()
	{
	parent::__construct(true);
		$this->load->library("nativesession");
		
		$this->load->model('post_model');
		$this->load->model('users_model');
		$this->load->model('user_model', 'user');
		$this->load->model('tradecomments_model');
		$this->load->model('messages_model');
		$this->load->model('userstat_model');
		$this->load->model('userInfo_model');
		$data["lang_label"] = $this->nativesession->get("language");
            $this->lang->load("message",$this->nativesession->get('language'));
            
            $this->load->helper('language');
            $this->load->helpers('site');
            $this->load->model('pagevisited_model');
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
	
	public function index($username,$pageNum=1, $catID='', $locID='',$keywords='',$sortByID="0")
	{
		$loginUser=$this->nativesession->get("user");
		if(isset($loginUser))
			$thread["userID"]=$loginUser['userID'];
			$thread["visit_time"]=date("Y-m-d H:i:s");;
			$thread['session_id']=$this->nativesession->userdata('session_id');
			$ip='';
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		
			$thread['ip']=$ip;
			$thread['cookies_id']=isset($_COOKIE['gt_cookie_id']) && $_COOKIE['gt_cookie_id']!='' ? $_COOKIE['gt_cookie_id'] : 'Guest';
			$thread["page_visit"]=PageViewProfile;
			$this->pagevisited_model->insert($thread);
		
		
		
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
		 	$userInfo=$this->users_model->getUserByUsername($username);
		 	if(!isset($userInfo) or empty($userInfo))
		 	{
		 		echo $username;
		 		return;
		 	}
		 	$userInformation=$this->userInfo_model->getUserInfoByUserID($userInfo[0]->userID);
		 	$data["userID"]=$userInfo[0]->userID;	
		 	if(isset($userInformation))
		 		$data["introduction"]=$userInformation["introduction"];
		 		else
		 			$data["introduction"]="";
		 			//----------setup the header menu----------
		 			$data["menuMyAds"]="";
		 			$data["menuInbox"]="";
		 			$data["menuInboxNum"]="0";
		 			$data["menuPendingRequest"]="";
		 			$data["menuPendingRequestNumber"]="0";
		 			if(isset($loginUser)){
		 				$menuCount=$this->getHeaderCount($loginUser['userID']);
		 				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($loginUser['userID']); //$menuCount["inboxMsgCount"]; //
		 				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
		 			}
		 			//----------------------------
		 			if($userInfo[0]->blockDate!=null && $userInfo[0]->blockDate> date('Y-m-d'))
		 			{
		 				if( empty($loginUser) ||
		 						(!empty($loginUser) &&  isset($loginUser) && $loginUser<>null &&  $loginUser["userID"]<>0
		 								&& strcmp($loginUser["username"],"admin")!=0))
		 				{
		 					$errorMsg=$this->lang->line("NotAllowCreatePostBlackList");
		 					$data["error"]=$errorMsg;
		 					$data["prevURL"]=$prevURL;
		 					$data['redirectToWhatPage']=$this->lang->line("homepage");
		 					$data['redirectToPHP']=base_url();
		 					$data["successTile"]=$this->lang->line("successTile");
		 					$data["failedTitle"]=$this->lang->line("failedTitle");
		 					$data["goToHomePage"]=$this->lang->line("goToHomePage");
		 	
		 					$this->load->view('failedPage', $data);
		 					return;
		 				}
		 			}
		 				
		 				
		 				
		 				
		 			$date=new DateTime($userInfo[0]->lastLoginTime);
		 			$data["lastLoginTime"]=$date->format('Y-M-d H:i:s');
		 			$user1=$this->user->getUserByUserID($userInfo[0]->userID);
		 			if(strcmp($user1["photostatus"],"A")==0)
		 				$data["userPhotoPath"]=base_url().$user1['thumbnailPath'].'/'.$user1['thumbnailName'];
		 				else
		 					$data["userPhotoPath"]=base_url()."images/user.jpg";
		 	
		 	
		 					$data["userName"]=$userInfo[0]->username;
		 					$createDate=(new DateTime($userInfo[0]->createDate))->format('Y-M-d');
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
		 							$data["sellerRating"]=$this->tradecomments_model->getRating($data["userID"]);
		 	
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
		 							$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
		 							$data["Logout"]=$this->lang->line("Logout");
		 							$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		 							$this->nativesession->set("lastPageVisited","newPost");
		 	
		 							 
		 							$data["activeTab"]="allAds";
		 							$data["lblCondition"]=$this->lang->line("lblCondition");
		 							$data["lblConditionNew"]=$this->lang->line("lblConditionNew");
		 							$data["lblConditionUsed"]=$this->lang->line("lblConditionUsed");
		 							$data["lblConditionAny"]=$this->lang->line("lblConditionAny");
		 							$data["lblConditionAll"]=$this->lang->line("lblConditionAll");
		 	
		 	
		 							$data["recentBuyerComment"]=trimLongTextInViewAllComments($this->tradecomments_model->getLatestBuyerComment($data["userID"]));
		 							$data["recentSellerComment"]=trimLongTextInViewAllComments($this->tradecomments_model->getLatestSellerComment($data["userID"]));
		 	
		 	
		 							$this->load->view('profile', $data);
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
?>
