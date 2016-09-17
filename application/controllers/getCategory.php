<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getCategory extends CI_Controller {
	
	var $byPassViewProfile=false;
	public function __construct($bypass=false)
	{
		
		parent::__construct();
		$this->load->library("nativesession");
		
	   $byPassGetCategory=$bypass;
		
       
		$this->load->helper('url');
		$this->load->helper('language');
		$this->load->database();
		$this->load->helpers('site');
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
         $this->load->model('category_model');
        $this->load->model('location_model');
        $this->load->model('post_model');
		$this->load->model('searchhistory_model');
		$this->load->model('savedAds_model');
		$this->load->model('searchresult_model');
		$this->load->model('pagevisited_model');
		$this->load->model('messages_model');
		$this->load->model('userstat_model');
		$this->load->model('users_model');
		$this->load->model('useremail_model');
		$this->load->model('requestpost_model');
		$this->load->model('picture_model');
	}
	
	public function savedAds()
	{
		$userInfo=$this->nativesession->get("user");
		$fUserID=0;
		if(!empty($userInfo))
			$fUserID=$userInfo["userID"];
		else {
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login in to save the item</div>';
			$data['icon'] = '<em><span style="color:red"></span></em>';
			echo json_encode($data);
			return;
		}
		
		$postID = $this->input->post('postID');
		
		$messageArray=array(
				'postID'=>intval($postID),
				'userID'=>intval($fUserID),
				'status' => "U",
				'createDate' => date("Y-m-d H:i:s"));
			$messageID=$this->savedAds_model->insert($messageArray);
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
			echo json_encode($data);
	}
	
	public function getAll($pageNum, $catID="0", $locID="0", $keywords='0', $sortByID="0", $minPrice="0", $maxPrice="0", $allAds='allAds', $sortByType="0", $sortByPrice="", $sortByDate="0")
	{
		try{
			//echo urlencode ($keywords);
			$keywords = urldecode ($keywords);	
				
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
			$thread["page_visit"]=PageSearch;
			$this->pagevisited_model->insert($thread);
			
		
			
		if( $this->input->post("ads")<> null && trim($this->input->post("ads"))<>"")
			$keywords=($this->input->post("ads"));
		if( $this->input->post("category")<>'' && $this->input->post("category")<>0)
			$catID=$this->input->post("category");
		if( $this->input->post("location")<>'' && $this->input->post("location")<>0)
			$locID=$this->input->post("location");
		if( $this->input->post("allAds")<>'' && $this->input->post("allAds")<>'allAds')
			$allAds=$this->input->post("allAds");
		$data["sortByType"]="0";
		$data["sortByPrice"]="0";
		$data["sortByDate"]="0";
		$tempSortByID=$this->input->post("sortByPrice");
		if(!empty($tempSortByID))
			$data["sortByPrice"]=$this->input->post("sortByPrice");
		else
			$data["sortByPrice"]=$sortByPrice;
		$tempSortByID=$this->input->post("selectSortType");
		if(!empty($tempSortByID))
			$data["sortByType"]=$this->input->post("selectSortType");
		else
			$data["sortByType"]=$sortByType;
							
		$tempSortByID=$this->input->post("sortByDate");
		if(!empty($tempSortByID))
			$data["sortByDate"]=$this->input->post("sortByDate");
		else
			$data["sortByDate"]=$sortByDate;
			
		if(strcmp($data["sortByType"],"1")==0){
			$data["sortByDate"]="0";
		}else if(strcmp($data["sortByType"],"2")==0){
			$data["sortByPrice"]="0";
		}else{
			$data["sortByDate"]="0";
			$data["sortByPrice"]="0";
		}
		$searchhistory['keyword']=$keywords;
		$searchhistory['catID']=$catID;
		$searchhistory['locID']=$locID;
		$searchhistory['ip']=$_SERVER['REMOTE_ADDR'];
		//print_r($this->nativesession->userdata);
		$searchhistory['session_id']=$this->nativesession->userdata('session_id');
                date_default_timezone_set('Asia/Hong_Kong');
                $date = date('Y-m-d h:i:s', time());
		$searchhistory['viewtime']=$date;
		$searchhistory["minPrice"]=$minPrice;
		$searchhistory["maxPrice"]=$maxPrice;
		
		$userInfo=$this->nativesession->get("user");
		if(!empty($userInfo))
			$searchhistory["userID"]=$userInfo["userID"];
		$ip='';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$searchhistory['ip']=$ip;
		$searchhistory['cookies_id']=isset($_COOKIE['gt_cookie_id']) && $_COOKIE['gt_cookie_id']!='' ? $_COOKIE['gt_cookie_id'] : 'Guest';
		
		$this->searchhistory_model->insert($searchhistory);
		
		
		//var_dump($this->input);
		} catch(Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
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
			$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		  
		 $data['lang_label']=$this->nativesession->get('language');
        $data['pageNum']=$pageNum;
		$selectCategory=$catID;
		$data['result']=null;
		$data["catID_"]=$catID;
		$data["locID_"]=$locID;
		if($keywords=='0')
			$data['keywords']='0';
		else
		$data['keywords']=($keywords);
		//echo $data['keywords'];
		$query=$this->category_model->getParentCategory();
		if (!is_null($query)) {
			foreach($query as $row)
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
	$data['resLoc']=null;
		$queryLoc=$this->location_model->getParentLocation();
		if (!is_null($queryLoc)) {
			foreach($queryLoc as $row)
			{
				$resLoc1=array($row->locationID => array($row));
				$resLoc2=$this->getChildLocation($row->locationID);
				if(!is_null($resLoc2))
						if(is_null($data['resLoc']))
							$data['resLoc']=$resLoc1+$resLoc2;
						else
							$data['resLoc']=$data['resLoc']+$resLoc1+$resLoc2;
					else 
					{
						if(is_null($data['resLoc']))
							$data['resLoc']=$resLoc1;
						else
							$data['resLoc']=$data['resLoc']+$resLoc1;
					}
			}
		}
		$NoOfItemCount=0;
		if(strcmp($keywords,'0')==0 )
			$keywords='';
		
		$data["minPrice"]=$minPrice;
		$data["maxPrice"]=$maxPrice;
		$data["activeTab"]=$allAds;
		

		
		
		
		$data['itemList']=$this->mapToSearchResult($this->searchresult_model->getItemList($pageNum,0, $catID, $locID, $keywords, $sortByID, $minPrice, $maxPrice, $allAds, $sortByType, $sortByPrice, $sortByDate));
		$NoOfItemCount=$this->searchresult_model->getNoOfItemCount(0, $catID, $locID, $keywords, $minPrice, $maxPrice, $allAds);
	 	$data["NoOfItemCount"]=$NoOfItemCount;
					
	 	$data["lblCatKeyword"]=$this->lang->line("lblCatKeyword");			
		$data["lblCatSearch"]=$this->lang->line("lblCatSearch");			
		$data["lblAllCategories"]=$this->lang->line("lblAllCategories");
	 	$data["lblAllLocations"]=$this->lang->line("lblAllLocations");
	 	$data["lblSearchSortBy"]=$this->lang->line("lblSearchSortBy");
	 	$data["lblPriceLowToHigh"]=$this->lang->line("lblPriceLowToHigh");
	 	$data["lblPriceHighToLow"]=$this->lang->line("lblPriceHighToLow");
		$data["lblCategory"]=$this->lang->line("Category");
	 	$data["lblLocation"]=$this->lang->line("lblLocation");
	 	$data["lblPriceRange"]=$this->lang->line("lblPriceRange");
		$data["Price"]=$this->lang->line("Price");
	 	$data["Date"]=$this->lang->line("Date");
	 	$data["mostRecent"]=$this->lang->line("mostRecent");
		$data["oldest"]=$this->lang->line("oldest");
	 	$data["lblCondition"]=$this->lang->line("lblCondition");
	 	$data["lblConditionNew"]=$this->lang->line("lblConditionNew");
	 	$data["lblConditionUsed"]=$this->lang->line("lblConditionUsed");
	 	$data["lblConditionAny"]=$this->lang->line("lblConditionAny");
	 	$data["lblConditionAll"]=$this->lang->line("lblConditionAll");
	 	//----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			if(isset($userInfo)){
				$menuCount=$this->getHeaderCount($userInfo['userID']);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($userInfo['userID']); //$menuCount["inboxMsgCount"]; //
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
		//----------------------------
		
		$this->load->view('category.php', $data);
	}
	
	public function getChildLocation($parentID)
	{
		$result=null;
		$queryLoc=$this->location_model->getChildLocation($parentID);
		if(!is_null($queryLoc))
		{
			foreach($queryLoc as $row)
				{
					$result1=array($row->locationID => array($row));
					$result2=$this->getChildLocation($row->locationID);
					if(!is_null($result2))
						if(is_null($result))
							$result=$result1+$result2;
						else
							$result=$result+$result1+$result2;
					else 
					{
						if(is_null($result))
							$result=$result1;
						else
							$result=$result+$result1;
					}
				}
		}
		else 
		{
			return NULL;			
		}
		return $result;	
	}
	public function getChildCategory($parentID)
	{
		$result=null;
		$query=$this->category_model->getChildCategory($parentID);
		if(!is_null($query))
		{
			foreach($query as $row)
				{
					$result1=array($row->categoryID => array($row));
					$result2=$this->getChildCategory($row->categoryID);
					if(!is_null($result2))
						if(is_null($result))
							$result=$result1+$result2;
						else
							$result=$result+$result1+$result2;
					else 
					{
						if(is_null($result))
							$result=$result1;
						else
							$result=$result+$result1;
					}
				}
		}
		else 
		{
			return NULL;			
		}
		return $result;	
	}
	
	public function allAds()
	{
		$data['status'] = 'A';
		$data['class'] = "has-success";
		$data['message'] = '';
		$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
		echo json_encode($data);
		//return PartialView();
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
	public function mapToSearchResult($var){
		$searchResult=null;
		if($var!=null){
			foreach($var as $post)
			{
				$pic=$this->searchresult_model->get_picture_by_postID($post->postID);
				$category=$this->searchresult_model->get_category_by_categoryID($post->catID);
				$catName="";
				$locName="";
				if(strcmp($this->lang->line("lang_label_text"),"english")==0)
					$catName=$category[0]->name;
					else
						$catName=$category[0]->nameCH;
						$location=$this->searchresult_model->get_location_by_locationID($post->locID);
						if($location[0]->locationID!=0){
							if(strcmp($this->lang->line("lang_label_text"),"english")==0)
								$locName=$location[0]->name;
								else
									$locName=$location[0]->nameCN;
						}
						$thumbPath="";
						$thumbName="";
						if($pic!=null && count($pic)>0){
							try{
								$thumbPath=$pic[0]-> thumbnailPath;
								$thumbName=$pic[0]->thumbnailName;
							}catch(Exception $ex){}
						}
						$userInfo=$this->nativesession->get("user");
						$loginuserID=0;
						if(!empty($userInfo))
							$loginuserID=$userInfo["userID"];
								
							$var = $this->searchresult_model->getPostByID($post->postID);
							$loginUser=$this->nativesession->get("user");
							$user = $this->searchresult_model->get_user_by_id($var[0]->userID);
								
							$userRating=$this->searchresult_model->getUserRating($var[0]->userID);
								
							$isloginedIn=false;
							$isSameUser=false;
							$isPostAlready=false;
							$isPendingRequest=false;
							$username=$user[0]->username;
							if(!empty($loginUser) and isset($loginUser) and $loginUser<>null and $loginUser["userID"]<>0)
							{
								$isloginedIn=true;
								if($loginUser["userID"]==$user[0]->userID)
									$isSameUser=true;
									$isPostAlready=$this->searchresult_model->getfUserIDAndPostID($var[0]->postID, $loginUser["userID"], "A");
									$isPendingRequest=$this->searchresult_model->getfUserIDAndPostID($var[0]->postID, $loginUser["userID"], "U");
							}
		
							$soldUsers=$this->messages_model->getSoldUserList($var[0]->postID);
							$NoOfItemCount=$this->requestpost_model->getNoOfItemCountInApproveAndRejectOfPost($loginUser['userID'], $var[0]->postID);
							$myList=$this->requestpost_model->getApproveAndRejectOfPost($loginUser['userID'], $var[0]->postID,0);
							$result=$this->mapReqeustPostToView($myList, 'seller', "ApproveAndReject");
							
							$temp=array('locationName'=> $locName,
									'categoryName'=> $catName,
									'postCurrency'=>$post->currency,
									'postItemPrice'=>$post->itemPrice,
									'postDescription'=> $post->description,
									'newUsed'=> $post->newUsed,
									'userRating'=>$userRating,
									'postTitle'=>$post->itemName,
									'postCreateDate'=>$post->createDate,
									'picCount'=>count($pic),
									'postTypeAds'=>$post->typeAds,
									'thumbnailPath'=>$thumbPath,
									'thumbnailName'=>	$thumbName,
									'isloginedIn'=> $isloginedIn,
									'username'=>$username,
									'isPendingRequest'=> $isPendingRequest,
									'isPostAlready'=> $isPostAlready,
									'isSameUser'=> $isSameUser,
									'hasBuyerList'=>$result!=null && count($result)>0,
									'soldUsers'=>$soldUsers,
									'result'=>$result,
									'postID'=>$var[0]->postID,
									'getDisableSavedAds'=>$this->post_model->getDisableSavedAds($post->postID, $loginuserID)
							);
								
								
								
								
								
							if(is_null($searchResult))
							{
								$searchResult=array($post->postID => $temp);
							}else
							{	$searchResult=$searchResult + array($post->postID => $temp);
		
							}
			}
		}
			return $searchResult;
	}
	public function mapReqeustPostToView($inbox, $type="buyer", $type2="DirectSend")
	{
		$result=null;
		$lang_label=$this->nativesession->get("language");
		if($inbox!=null){
			foreach($inbox as $row)
			{
				$postID=$row->postID;
				$messageID=$row->postID."-".$row->userID;
				//$userID=$row->userID;
				$fuserID=$row->userID;
				$createDate=$row->createDate;
				$expiryDate=$row->expriyDate;
				$statusRP=$row->status;
				$status="";
				$name="";
				$previewTitle="";
				$previewDesc="";
				$price=0;
				$userID=0;
				$enableMarkSoldBtn=false;
				$visibleBuyerComment=false;
				$soldToUserID=0;
				$postInfo=$this->post_model->getPostByPostID($postID);
				if($postInfo<>null)
				{
					if ($lang_label<>"english")
						$name=$postInfo[0]->itemNameCH;
						else
							$name=$postInfo[0]->itemName;
							$soldToUserID=$postInfo[0]->soldToUserID;
							$enableMarkSoldBtn=$postInfo[0]->sellerRating==null;
							$visibleBuyerComment=$postInfo[0]->sellerRating<>null &&
							$postInfo[0]->buyerRating==null;
							$previewTitle=$name;
							$previewDesc=$postInfo[0]->description;
							$price=$postInfo[0]->currency." ".$postInfo[0]->itemPrice;
							$userID=$postInfo[0]->userID;
							$status=$postInfo[0]->status;
				}
				$userarray=$this->users_model->get_user_by_id($userID);
				$reply="";
				$from="";
				$sellerEmail="";
				if($userarray<>null)
				{
					$reply=$userarray[0]->username;
					$from=$reply;
				}
				$email="";
				if(strcmp($type,"buyer")==0)
					$email=$this->userEmail->getUserEmailByUserID($userID);
					else
						$email=$this->useremail_model->getUserEmailByUserID($fuserID);
						if($email<>null){
							$sellerEmail=$email["email"];
						}
						$fUserarray=$this->users_model->get_user_by_id($fuserID);
						if($fUserarray<>null)
						{
							$from=$fUserarray[0]->username;
						}
	
						$pic=$this->picture_model->get_picture_by_postID($postID);
						$imagePath="";
						$picCount=count($pic);
						if($pic<>null)
						{
							$imagePath=base_url().$pic[0]->thumbnailPath.'/'.$pic[0]->thumbnailName;
						}
						$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
			
						$itemStatus=$status;
						$dStart=date_create('2015-09-20');
						$dDiff = $dStart->diff(date_create($expiryDate));
						$NoOfDaysPending=$dDiff->days;
						$NoOfDaysb4ExpiryContact=$dDiff->days;
						$arrayMessage=array($messageID => array("postID"=>$postID,
								"messageID"=>$messageID,
								"userID"=>$userID,
								"fuserID"=>$fuserID,
								"createDate"=>$createDate,
								"reply"=>$reply,
								"previewTitle"=>$previewTitle,
								"previewDesc"=>$previewDesc,
								"price"=>$price,
								"enableMarkSoldBtn"=>$enableMarkSoldBtn,
								"visibleBuyerComment"=>$visibleBuyerComment,
								"soldToUserID"=>$soldToUserID,
								"imagePath"=>$imagePath,
								"viewItemPath"=>$viewItemPath,
								"itemStatus"=>$itemStatus,
								"statusRP" =>$statusRP,
								"from"=>$from,
								"recordType" => $type2,
								"NoOfDaysPending"=>$NoOfDaysPending,
								"NoOfDaysb4ExpiryContact"=>$NoOfDaysb4ExpiryContact,
								"sellerEmail" => $sellerEmail,
								"replyUserID"=>$userID,
								"picCount"=>$picCount));
						if($result==null)
							$result=$arrayMessage;
							else
								$result=$result + $arrayMessage;
			}
		}
		return $result;
	}
}
?>