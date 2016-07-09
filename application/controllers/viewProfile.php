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
		$this->load->model('tradecomments_model');
		$this->load->model('messages_model');
		$this->load->model('userstat_model');
		$this->load->model('userInfo_model');
		$this->load->model('category_model');
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
         public function index($postID,$pageNum=1, $catID='', $locID='',$keywords='',$sortByType="0", $sortByPrice="", $sortByDate="0" )
	{
		
		$prevProfile_Url=base_url();
		if(isset($_GET["prevProfile_Url"]))
			$prevProfile_Url=$_GET["prevProfile_Url"];
		else if(isset($_SESSION["prevProfile_Url"]))
			$prevProfile_Url=$_SESSION["prevProfile_Url"];
		$_SESSION["prevProfile_Url"]=$prevProfile_Url;
		$data["prevProfile_Url"]=$prevProfile_Url;
		
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
			$data["postID"]=$postID;
			$postInfo=$this->post_model->getPostByPostID($postID);
			$data["userID"]=$postInfo[0]->userID;
			$userInfo=$this->users_model->get_user_by_id($data["userID"]);
			$userInformation=$this->userInfo_model->getUserInfoByUserID($data["userID"]);
			
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
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				
				$this->load->view('failedPage', $data);
				return;
				}
			}
			
			$data["isSameUser"]=false;
			if(!empty($loginUser) &&  isset($loginUser) && $loginUser<>null &&  $loginUser["userID"]==$data["userID"]){
				$data["isSameUser"]=true;
			}
			
			
			$date=new DateTime($userInfo[0]->lastLoginTime);
			$data["lastLoginTime"]=$date->format('Y-M-d H:i:s');
			 $user1=$this->user->getUserByUserID($data["userID"]);
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
			
			$data["sortByType"]="0";
			$data["sortByPrice"]="0";
			$data["sortByDate"]="0";
			$tempSortByID=$this->input->post("sortByPrice");
			if(!empty($tempSortByID))
				$data["sortByPrice"]=$this->input->post("sortByPrice");
			else
				$data["sortByPrice"]=$sortByPrice;
			$tempSortByID=$this->input->post("sortByType");
			if(!empty($tempSortByID))
				$data["sortByType"]=$this->input->post("sortByType");
			else
				$data["sortByType"]=$sortByType;
							
			$tempSortByID=$this->input->post("sortByDate");
			if(!empty($tempSortByID))
				$data["sortByDate"]=$this->input->post("sortByDate");
			else
				$data["sortByDate"]=$sortByDate;
			$tempSortByID=$this->input->post("search-category");
			if(!empty($tempSortByID))
				$data["catID"]=$this->input->post("search-category");
			
			if(strcmp($data["sortByType"],"1")==0){
				$data["sortByDate"]="0";
				$data["catID"]="0";
			}else if(strcmp($data["sortByType"],"2")==0){
				$data["sortByPrice"]="0";
				$data["catID"]="0";
			}else if(strcmp($data["sortByType"],"3")==0){
				$data["sortByDate"]="0";
				$data["sortByPrice"]="0";
			}else{
				$data["sortByDate"]="0";
				$data["sortByPrice"]="0";
				$data["catID"]="0";
			}
				
			$NoOfItemCount=0;
			$data["itemList"]=$this->mapToViewProfileItemList($this->post_model->getItemList($pageNum, $data["userID"], $data["catID"], $locID, $keywords, $data["sortByType"]), $loginUser["userID"]);
			$NoOfItemCount=$this->post_model->getNoOfItemCount($data["userID"], $catID, $locID, $keywords);
	      	$data["sellerRating"]=$this->tradecomments_model->getRating($data["userID"]);
	      	$data["userRating"]=$this->users_model->getUserRating($data["userID"]);
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
				$data["lblAllCategories"]=$this->lang->line("lblAllCategories");
				
				$data["lblSearchSortBy"]=$this->lang->line("lblSearchSortBy");
				$data["lblPriceLowToHigh"]=$this->lang->line("lblPriceLowToHigh");
				$data["lblPriceHighToLow"]=$this->lang->line("lblPriceHighToLow");
				$data["mostRecent"]=$this->lang->line("mostRecent");
				$data["oldest"]=$this->lang->line("oldest");
				$data["Price"]=$this->lang->line("Price");
				$data["Category"]=$this->lang->line("Category");
				$data["Date"]=$this->lang->line("Date");

				
				
				$data["AllCategory"]=$this->getAllCategory();
				
			$data["recentBuyerComment"]=trimLongTextInViewAllComments($this->tradecomments_model->getLatestBuyerComment($data["userID"]));
			$data["recentSellerComment"]=trimLongTextInViewAllComments($this->tradecomments_model->getLatestSellerComment($data["userID"]));
				
				
            $this->load->view('profile', $data);
	}
	function getAllCategory()
	{
		$data['result']=null;
		$data['query']=$this->category_model->getParentCategory();
		if (!is_null($data['query'])) {
			foreach($data['query'] as $row)
			{
				$result1=array($row->categoryID => array($row));
				$result2=$this->getChildCategory($row->categoryID);
				if(!is_null($result2))
					if(is_null($data['result']))
						$data['result']=$result1+$result2;
						else
							$data['result']=$data['result']+$result1+$result2;
							else
							{
								if(is_null($data['result']))
									$data['result']=$result1;
									else
										$data['result']=$data['result']+$result1;
							}
			}
		}
		return $data['result'];
	}
    
	public function viewByUserID($userID,$pageNum=1, $catID='', $locID='',$keywords='',$sortByType="0", $sortByPrice="0", $sortByDate="0",$activeTab="allAds")
	{
		$prevProfile_Url=base_url();
		if(isset($_GET["prevProfile_Url"]))
			$prevProfile_Url=$_GET["prevProfile_Url"];
		else if(isset($_SESSION["prevProfile_Url"]))
			$prevProfile_Url=$_SESSION["prevProfile_Url"];
			$_SESSION["prevProfile_Url"]=$prevProfile_Url;
			$data["prevProfile_Url"]=$prevProfile_Url;
		
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
		$userInformation=$this->userInfo_model->getUserInfoByUserID($data["userID"]);
			
		if(isset($userInformation))
			$data["introduction"]=$userInformation["introduction"];
			else
				$data["introduction"]="";
		$loginUser=$this->nativesession->get("user");
		//----------setup the header menu----------
		$data["menuMyAds"]="";
		$data["menuInbox"]="";
		$data["menuInboxNum"]="0";
		$data["menuPendingRequest"]="";
		$data["menuPendingRequestNumber"]="0";
		if(isset($loginUser)){
			$menuCount=$this->getHeaderCount($loginUser['userID']);
			$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($loginUser['userID']); // $menuCount["inboxMsgCount"]; //
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
				$data['redirectToWhatPage']="Home Page";
				$data['redirectToPHP']=base_url();
				$data["successTile"]=$this->lang->line("successTile");
				$data["failedTitle"]=$this->lang->line("failedTitle");
				$data["goToHomePage"]=$this->lang->line("goToHomePage");
				$this->load->view('failedPage', $data);
				return;
			}
		}
		$data["isSameUser"]=false;
		if(!empty($loginUser) &&  isset($loginUser) && $loginUser<>null &&  $loginUser["userID"]==$data["userID"]){
			$data["isSameUser"]=true;			
		}
			
			
		$date=new DateTime($userInfo[0]->lastLoginTime);
		$data["lastLoginTime"]=$date->format('Y-M-d H:i:s');
		$user1=$this->user->getUserByUserID($data["userID"]);
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
		$data["sortByType"]="0";
		$data["sortByPrice"]="0";
		$data["sortByDate"]="0";
		$tempSortByID=$this->input->post("sortByPrice");
		if(!empty($tempSortByID))
			$data["sortByPrice"]=$this->input->post("sortByPrice");
		else
			$data["sortByPrice"]=$sortByPrice;
		$tempSortByID=$this->input->post("sortByType");
		if(!empty($tempSortByID))
			$data["sortByType"]=$this->input->post("sortByType");
		else
			$data["sortByType"]=$sortByType;
						
		$tempSortByID=$this->input->post("sortByDate");
		if(!empty($tempSortByID))
			$data["sortByDate"]=$this->input->post("sortByDate");
		else
			$data["sortByDate"]=$sortByDate;
		$tempSortByID=$this->input->post("search-category");
		if(!empty($tempSortByID))
			$data["catID"]=$this->input->post("search-category");
		
			if(strcmp($data["sortByType"],"1")==0){
				$data["sortByDate"]="0";
				$data["catID"]="0";
			}else if(strcmp($data["sortByType"],"2")==0){
				$data["sortByPrice"]="0";
				$data["catID"]="0";
			}else if(strcmp($data["sortByType"],"3")==0){
				$data["sortByDate"]="0";
				$data["sortByPrice"]="0";
			}else{
				$data["sortByDate"]="0";
				$data["sortByPrice"]="0";
				$data["catID"]="0";
			}
		$NoOfItemCount=0;
		$data["itemList"]=$this->mapToViewProfileItemList($this->post_model->getItemList($pageNum, $data["userID"], $data["catID"], $locID, $keywords,0,0,0,$data["sortByType"],$data["sortByPrice"], $data["sortByDate"], $activeTab), $loginUser['userID']);
		$NoOfItemCount=$this->post_model->getNoOfItemCount($data["userID"], $catID, $locID, $keywords,0,0, $activeTab);
		$data["sellerRating"]=$this->tradecomments_model->getRating($data["userID"]);
		$data["userRating"]=$this->users_model->getUserRating($data["userID"]);
		$data["activeTab"]=$activeTab;	
		
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
		$data["lblCondition"]=$this->lang->line("lblCondition");
		$data["lblConditionNew"]=$this->lang->line("lblConditionNew");
		$data["lblConditionUsed"]=$this->lang->line("lblConditionUsed");
		$data["lblConditionAny"]=$this->lang->line("lblConditionAny");
		$data["lblConditionAll"]=$this->lang->line("lblConditionAll");
		$data["lblAllCategories"]=$this->lang->line("lblAllCategories");
		
		$data["lblSearchSortBy"]=$this->lang->line("lblSearchSortBy");
		$data["lblPriceLowToHigh"]=$this->lang->line("lblPriceLowToHigh");
		$data["lblPriceHighToLow"]=$this->lang->line("lblPriceHighToLow");
		$data["Price"]=$this->lang->line("Price");
		$data["Category"]=$this->lang->line("Category");
		$data["Date"]=$this->lang->line("Date");
		
		//Added July 2016			
		$data["profileBackToResult"]=$this->lang->line("profileBackToResult");
		$data["profileInfo"]=$this->lang->line("profileInfo");
		$data["profileRegisterationDate"]=$this->lang->line("profileRegisterationDate");
		$data["profileTotalPost"]=$this->lang->line("profileTotalPost");
		$data["profileViewAllComments"]=$this->lang->line("profileViewAllComments");	
		$data["profileNormalUser"]=$this->lang->line("profileNormalUser");	
		$data["profileLatestAccountActivity"]=$this->lang->line("profileLatestAccountActivity");
		$data["profileSendPrivateMessage"]=$this->lang->line("profileSendPrivateMessage");
		
		
				
		$data["AllCategory"]=$this->getAllCategory();
			
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
	public function mapToViewProfileItemList($itemList, $loginUserID){
		
		$result=null;
		if($itemList!=null && count($itemList)>0){
			foreach($itemList as $id=>$item)
			{
				$temp=$item;
				$temp["isPostAlready"]=$this->requestpost_model->getfUserIDAndPostID($id, $loginUserID, "A");
				$temp["isPendingRequest"]=$this->requestpost_model->getfUserIDAndPostID($id, $loginUserID, "U");
		
				if(is_null($result))
				{
					$result=array($id => $temp);
				}else
				{	$result=$result + array($id => $temp);
				
				}
			}
		}
		return $result;
		
	}
}