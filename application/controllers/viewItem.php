<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class viewItem extends CI_Controller {
    	
 	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		
		
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('users_model');
		$this->load->helpers('site');
                $this->load->model('post_model', 'post');
                $this->load->model('requestpost_model');
                $this->load->model('postviewhistory_model');
                $this->load->model('searchresult_model');
                $this->load->helper('language');
                date_default_timezone_set("Asia/Hong_Kong");
                $this->load->model('userinfo_model', 'userInfo');
                $this->load->model('useremail_model', 'userEmail');
                $this->load->model('tag_model');
                $this->load->model('itemcomments_model');
                $this->load->model('messages_model');
				$this->load->model('userstat_model');
				$this->load->model('picture_model');
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
	public function index($postId, $errorMsg='', $successMsg='')
	{
		$loginUser=$this->nativesession->get("user");
		$prevUrl="";
		if(isset($_GET["prevURL"])) {
			$prevUrl=$_GET["prevURL"];
			$_SESSION["previousUrl"]=$prevUrl;
		}
		else if(isset($_SESSION["previousUrl"]))
			$prevUrl=$_SESSION["previousUrl"];
	
			$data["previousCurrent_url"] = urldecode($prevUrl);
			$data["getDisableSavedAds"]=$this->searchresult_model->getDisableSavedAds($postId, $loginUser["userID"]);
			
		try {
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
         $var = $this->getPost($postId);
            $data["postID"]=$postId;
            $itemCommentInfo=$this->itemcomments_model->getItemCommentsbyPostID($postId);
            $data["itemCommentList"]=$itemCommentInfo;
            //----------setup the header menu----------
			$data["menuMyAds"]="";
			$data["menuInbox"]="";
			$data["menuInboxNum"]="0";
			$data["menuPendingRequest"]="";
			$data["menuPendingRequestNumber"]="0";
			$data["isloginedIn"]=false;
			
			if(isset($loginUser)){
				$data["isloginedIn"]=true;
				$menuCount=$this->getHeaderCount($loginUser['userID']);
				$data["menuInboxNum"]=$this->messages_model->getUnReadInboxMessage($loginUser['userID']); //$menuCount["inboxMsgCount"]; //
				$data["menuPendingRequestNumber"]=$menuCount["pendingMsgCount"];
			}
		//----------------------------
            if($var == null)
            {
                $this->nativesession->set("lastPageVisited","processError");
                $this->load->view('system-error', $data);
            }else
            {
            	
                //echo $var['postID'];
                $user = $this->users_model->get_user_by_id($var[0]->userID);
                $pic = $this->post->get_picture_by_postID($var[0]->postID);
                $category = $this->post->get_category_by_categoryID($var[0]->catID);
                $parentCategory=$this->post->get_category_by_categoryID($category[0]->parentID);
                $location = $this->post->get_location_by_locationID($var[0]->locID);
				$tag=$this->tag_model->getTagByPostID($var[0]->postID);
				
				$tagDesc="";
				if($tag!=null && sizeof($tag)>0){
					foreach($tag as $id=>$value){
						if($tagDesc=="")
							$tagDesc=$tagDesc.$value->tag;
						else
							$tagDesc=$tagDesc.", ".$value->tag;
					}
				}
				$data["tagDesc"]=$tagDesc;
				
                $this->nativesession->set("lastPageVisited","item");
                      if($parentCategory!=null){
                $data["ParentCatID"] = $parentCategory[0]->categoryID;
                $data["ParentCatName"] = $data["lang_label"]<>"english" ? $parentCategory[0]->nameCH : $parentCategory[0]->name;
                }else{
                	$data["ParentCatID"] =$category[0]->categoryID;
                	$data["ParentCatName"] = $data["lang_label"]<>"english" ? $category[0]->nameCH : $category[0]->name;    	
                }
                $data["ChildCatID"] = $category[0]->categoryID;
                $data["ChildCatName"] = $data["lang_label"]<>"english" ? $category[0]->nameCH : $category[0]->name;
                $data["itemName"] = $data["lang_label"]<>"english" ? $var[0]->itemNameCH : $var[0]->itemName;
                $data["createDate"] = $var[0]->createDate;
                $data["currency"] = $var[0]->currency;
                $data["remainQty"]=$var[0]->remainQty;
                $data["price"] = $var[0]->itemPrice;
                $data["AdsProduct"] = array($var[0]->postID => $pic);
                $data["itemDesc"] = $var[0]->description;
                $data["visitCount"]=$var[0]->viewCount;
                $data["itemTitle"]=$var[0]->itemName;
                $data["condition"]=strcmp($var[0]->newUsed, "N")==0 ? "NEW" :"USED"; 
                if ($var[0]->locID>0)
                	$data["LocationName"] = $data["lang_label"]<>"english" ? $location[0]->nameCN : $location[0]->name;
                else 
                	$data["LocationName"]="All Locations";
                 $data["username"] = $user[0]->username;
                $data["userID"] = $user[0]->userID;
                $userCreateDate = (new DateTime($user[0]->createDate))->format('Y-M-d');
                $data["userCreateDate"]=$userCreateDate;
                $date=$user[0]->lastLoginTime;
                $data["lastLoginTime"]=$date; //->format('Y-m-d H:i:s');
                $data["errorMsg"]=array("success1"=> ($successMsg), "error"=> ($errorMsg));
                
                $userInfo=$this->userInfo->getUserInfoByUserID($data["userID"] );
                //print_r($userInfo);
                $email=$this->userEmail->getUserEmailByUserID($data["userID"] );
                //print_r($email);
                if(isset($userInfo))
                {
                	$data["lastName"]=$userInfo["lastName"];
                	$data["firstName"]=$userInfo["firstName"];
                	$data["phoneNo"]=$userInfo["phoneNo"];
                	$data["sellerphone"]=$userInfo["telNo"];
                	$data["telNo"]=$userInfo["telNo"];
                }
                $data["email"]=$email["email"];
                $data["selleremail"]=$email["email"];
                $data["userRating"]=$this->users_model->getUserRating($data["userID"]);
                	
                $isSameUser=false;
                $isPostAlready=false;
                $isPendingRequest=false;
                $isBuyerApproveThisPost=false;
              	if(!empty($loginUser) and isset($loginUser) and $loginUser<>null and $loginUser["userID"]<>0)
                {
                	if($loginUser["userID"]==$user[0]->userID)
                		$isSameUser=true;
                	$isPostAlready=$this->requestpost_model->getfUserIDAndPostID($var[0]->postID, $loginUser["userID"], "A");
                	$isBuyerApproveThisPost=$isPostAlready; // need to do later
                	         
                	$isPendingRequest=$this->requestpost_model->getfUserIDAndPostID($var[0]->postID, $loginUser["userID"], "U");
                }
                $data["isBuyerApproveThisPost"]=$isBuyerApproveThisPost;
                $data["isSameUser"]=$isSameUser;
                $data["NoOfItemCount"]=$this->requestpost_model->getNoOfItemCountInApproveAndRejectOfPost($loginUser['userID'], $var[0]->postID);
                $myList=$this->requestpost_model->getApproveAndRejectOfPost($loginUser['userID'], $var[0]->postID,0);
                $data["result"]=$this->mapReqeustPostToView($myList, 'seller', "ApproveAndReject");
                $data["postID"]=$var[0]->postID;	
 				$data["hasRequestContact"]=$data["result"]!=null && count($data["result"])>0;
 				$data["soldUsers"]=$this->messages_model->getSoldUserList($postId);
 				$data["hasBuyerList"]=$data["soldUsers"]!=null && count($data["soldUsers"])>0;
 					
 				$data["pageNum"]=1;
                $data["isPostAlready"]=$isPostAlready;
                $data["isPendingRequest"]=$isPendingRequest;
                $thread["postID"]=$postId;
                if(!empty($loginUser) and isset($loginUser) and $loginUser<>null and $loginUser["userID"]<>0)
                {
                	$thread["userID"]=$loginUser["userID"];
                }
                $thread["ip"]=$_SERVER['REMOTE_ADDR'];
                date_default_timezone_set('Asia/Hong_Kong');
      		   $thread["viewTime"]=$date;
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
                
                $this->postviewhistory_model->insert($thread);
                
            } 
            
            $userInfo=$this->nativesession->get("user");
            $fUserID=0;
            $data["DailyMaxTimes"]=0;
            $data["TotalMaxTimes"]=0;
            if(!empty($userInfo)){
            	$fUserID=$userInfo["userID"];
	            $data["DailyMaxTimes"]=$this->messages_model->getMaxDailyTimesBuyerSendMsg($postId, $fUserID);
	            $data["TotalMaxTimes"]=$this->messages_model->getMaxTotalTimesBuyerSendMsg($postId, $fUserID);
            }
            
            	if  ( (strcmp($var[0]->status,"U")!=0 &&  strcmp($var[0]->status,"R")!=0
            			&&  strcmp($var[0]->status,"D")!=0 &&
            			($var[0]->blockDate==null || $var[0]->blockDate< date('Y-m-d')))
            			|| strcmp($loginUser["username"],"admin")==0)
            	{
            		
            		$commentList=$this->itemcomments_model->getItemCommentsbyPostID($var[0]->postID);
            		$data["commentList"]=$this->mapToItemComments($commentList);           		
            		
            	    $this->load->view('item', $data);
     	     	}else {
     	     		
     	     		$errorMsg=$this->lang->line("PostNotExistsNow");
     	     		$data["error"]=$errorMsg;
     	     		$data["prevURL"]=base_url();
     	     		$data['redirectToWhatPage']="Home Page";
     	     		$data['redirectToPHP']=base_url();
     	     		$data["successTile"]=$this->lang->line("successTile");
     	     		$data["failedTitle"]=$this->lang->line("failedTitle");
     	     		$data["goToHomePage"]=$this->lang->line("goToHomePage");
     	     		$this->load->view('failedPage', $data);
     	     		return;
     	     	}
            //}
     	     	
     	     	}catch(Exception $e)
     	     	{
     	     		echo 'Caught exception: ',  $e->getMessage(), "\n";
     	     		 
     	     	}
		}
    
		public function mapToItemComments ($input){
			$result=null;
			$lang_label=$this->nativesession->get("language");
			foreach($input as $row)
			{
				$postID=$row->postID;
				$commentID=$row->ID;
				$usercommentID=$row->usercommentID;
				$createDate=$row->createDate;
				$userPhotoPath="";
				$username="";
				$strElapsedTime=$this->getStrElapsedTime($row->createDate);
				$comments=$row->comments;
				$postInfo=$this->post->getPostByPostID($postID);
				$userarray=$this->users_model->get_user_by_id($usercommentID);
				$childComment=$this->mapToItemComments($this->itemcomments_model->getItemCommentsbyPostIDParentID($postID, $commentID));                           
				
				if($userarray<>null)
				{	
					$username=$userarray[0]->username;
					if(strcmp($userarray[0]->photostatus,"A")==0)
						$userPhotoPath=base_url().MY_PATH.$userarray[0]->thumbnailPath.'/'.$userarray[0]->thumbnailName;
					else
						$userPhotoPath=base_url()."images/user.jpg";
				}
				
				$viewItemPath=base_url().MY_PATH."viewItem/index/$postID";
			
			
				$arrayMessage=array($commentID => array("postID"=>$postID,
						"commentID"=>$commentID,
						"usercommentID"=>$usercommentID,
						"username"=>$username,
						"comments"=>$comments,
						"strElapsedTime"=>$strElapsedTime,
						"createDate"=>$createDate,
						"userPhotoPath"=>$userPhotoPath,
						"viewItemPath"=>$viewItemPath,
						"childCommentList"=> $childComment
						));
			
				if($result==null)
					$result=$arrayMessage;
				else
					$result=$result + $arrayMessage;
			}
			return $result;
		
		}
    
		public function getStrElapsedTime($createDate){
			return "";
		}
        public function getPost($postId)
        {
            return $this->post->getPostByID($postId);
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
        			$postInfo=$this->post->getPostByPostID($postID);
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
        					$email=$this->userEmail->getUserEmailByUserID($fuserID);
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
        
        public function getPreApproveHtmlList(){
        	
        	$postID=$this->input->post("postID");
        	$pageNum=$this->input->post("pageNum");
        	$loginUser=$this->nativesession->get("user");
        	if(!isset($loginUser))
        	{
        		$data['status'] = 'F';
        		$data['class'] = "has-error";
        		$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login in</div>';
        		$data['icon'] = '<em><span style="color:red"></span></em>';
        		echo json_encode($data);
        		return;
        	}
        	$NoOfItemCount=$this->requestpost_model->getNoOfItemCountInApproveAndRejectOfPost($loginUser['userID'], $postID);
                $myList=$this->requestpost_model->getApproveAndRejectOfPost($loginUser['userID'], $postID,$pageNum);
                $result=$this->mapReqeustPostToView($myList, 'seller', "ApproveAndReject");
                
        	$outputhtml="";
        	$outputhtml=$outputhtml."<table id=\"addManageTable\" class=\"table table-striped table-bordered add-manage-table table demo\" data-filter=\"#filter\" data-filter-text-only=\"true\" > ";
             $outputhtml=$outputhtml."   <thead> ";
            $outputhtml=$outputhtml."      <tr> ";
             $outputhtml=$outputhtml."       <th>".$this->lang->line("From")."</th> ";
             $outputhtml=$outputhtml."       <th data-sort-ignore=\"true\">".$this->lang->line("Ads_Detail")."</th> ";
             $outputhtml=$outputhtml."       </tr> ";
             $outputhtml=$outputhtml."   </thead> ";
             $outputhtml=$outputhtml."   <tbody> <tr></tr>";
            	if($result<>null)
            	{
            		$rowCount=0;
                  	foreach($result as $id=>$row)
                  	{
                  		
                  		$from=$row['from'];
                  		$reply=$row['reply'];
                  		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url());
                  		$imagePath=$row['imagePath'];
                  		$previewTitle=$row['previewTitle'];
                  		$previewDesc=$row["previewDesc"];
                  		$createDate=$row['createDate'];
                  		$itemStatus=$row['itemStatus'];
                  		$messageID=$id;
                  		$userID=$row['userID'];
                  		$NoOfDaysPending=$row['NoOfDaysPending'];
						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
						$price=$row['price'];
                		$outputhtml=$outputhtml."<tr>";
                    	$outputhtml=$outputhtml."<td style=\"width:20%\" class=\"add-image\">$from";
                    	$outputhtml=$outputhtml."<br/>".$this->lang->line("DaysExpiry")." :".$NoOfDaysb4ExpiryContact;
                    	$approvePath=base_url().MY_PATH."messages\approveSavedAds\$messageID\$userID";
                    	$rejectPath=base_url().MY_PATH."messages\rejectSavedAds\$messageID\$userID";
                    	$rowCount=$rowCount+1;
                    	$ctrlName1="AjaxLoad1_".$rowCount;
                    	$errorctrlName1="ErrAjaxLoad1_".$rowCount;
                    	$ctrlValue1="messageID".$rowCount;
                    	$ctrlValue2="userID".$rowCount;
                    	$ctrlName2="AjaxLoad2_".$rowCount;
                    	$errorctrlName2="ErrAjaxLoad2_".$rowCount;
                    	$clickLink="clickLink".$rowCount;
                    	$clickLink2="clickLink2_".$rowCount;
                    	$outputhtml=$outputhtml."<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$messageID' />";
                    	$outputhtml=$outputhtml."<input name='$ctrlValue2' id='$ctrlValue2' type='hidden' value='$userID' />";
                    	$outputhtml=$outputhtml."<p> <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
                    	$outputhtml=$outputhtml."<a class=\"btn btn-primary btn-xs\" href=\"javascript:approve('$ctrlValue1','$ctrlValue2', '$ctrlName1', '$errorctrlName1')\" id='$clickLink'> <i class=\"fa fa-reply\"></i> ".$this->lang->line('Approve')." </a></p>";
                    	$outputhtml=$outputhtml."<p><div id='$ctrlName2' name='$ctrlName2' class='center'></div><div id='$errorctrlName2' name='$errorctrlName2' class='center'></div>";
                    	$outputhtml=$outputhtml."<a class=\"btn btn-primary btn-xs\" href=\"javascript:reject('$ctrlValue1','$ctrlValue2', '$ctrlName2', '$errorctrlName2')\" id='$clickLink2'><i class=\"fa fa-trash\"></i>  ".$this->lang->line('Reject')."</a></p>";
                    	
                    	$outputhtml=$outputhtml."</td>";
                      	$outputhtml=$outputhtml."<td style=\"width:55%\" class=\"ads-details-td\">";
                    	$outputhtml=$outputhtml."<div class=\"ads-details\">";
                      $outputhtml=$outputhtml."<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
                          $outputhtml=$outputhtml."<br/>Posted On: ". $createDate."</h5>";
                    		$outputhtml=$outputhtml."</div></td>";
                      		
                      	
                  		$outputhtml=$outputhtml."</tr>";
                  		
                  	}
            	}
            
            $outputhtml=$outputhtml." <div class=\"pagination-bar text-center\"> ";
            $outputhtml=$outputhtml."<ul class=\"pagination\"> ";
            	$pageNumPrev=$pageNum-1;
            	$pageNum2=$pageNum+1;
            	$pageNum3=$pageNum+2;
            	$pageNum4=$pageNum+3;
            	$pageNum5=$pageNum+4;
            	$pageNumNext=$pageNum+5;
            	$outputhtml=$outputhtml."<input type=\"hidden\" id=\"ctrlpostID\" name=\"ctrlpostID\" value=\"$postID\"/>";
            	$outputhtml=$outputhtml."<input type=\"hidden\" id=\"ctrlpageNumPrev\" name=\"ctrlpageNumPrev\" value=\"$pageNumPrev\"/>";
            	$outputhtml=$outputhtml."<input type=\"hidden\" id=\"ctrlpageNum\" name=\"ctrlpageNum\" value=\"$pageNum\"/>";
            	$outputhtml=$outputhtml."<input type=\"hidden\" id=\"ctrlpageNum2\" name=\"ctrlpageNum2\" value=\"$pageNum2\"/>";
            	$outputhtml=$outputhtml."<input type=\"hidden\" id=\"ctrlpageNum3\" name=\"ctrlpageNum3\" value=\"$pageNum3\"/>";
            	$outputhtml=$outputhtml."<input type=\"hidden\" id=\"ctrlpageNum4\" name=\"ctrlpageNum4\" value=\"$pageNum4\"/>";
            	$outputhtml=$outputhtml."<input type=\"hidden\" id=\"ctrlpageNum5\" name=\"ctrlpageNum5\" value=\"$pageNum5\"/>";
            	$outputhtml=$outputhtml."<input type=\"hidden\" id=\"ctrlpageNumNext\" name=\"ctrlpageNumNext\" value=\"$pageNumNext\"/>";
            	 
            	
            	if($pageNum<>1)
            		$outputhtml=$outputhtml."<li><a class=\"pagination-btn\" href=\"#sellerApprovePopup\" data-toggle=\"modal\"  data-id=\"$postID\" data-pagenum=\"$pageNumPrev\">Previous</a></li>";
            	$outputhtml=$outputhtml."<li  class=\"active\"><a id=\"hrefPageNum\" href=\"#\" onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum</a></li>";
            	$outputhtml=$outputhtml."<li><a id=\"hrefPageNum2\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum2\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum2</a></li>";
            	$outputhtml=$outputhtml."<li><a id=\"hrefPageNum3\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum3\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum3</a></li>";
            	$outputhtml=$outputhtml."<li><a id=\"hrefPageNum4\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum4\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum4</a></li>";
            	$outputhtml=$outputhtml."<li><a id=\"hrefPageNum5\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNum5\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNum5</a></li>";
            	$outputhtml=$outputhtml."<li><a id=\"hrefPageNumNext\" href=\"#\"  onclick=\"getApproveList(\"ctrlpostID\", \"ctrlpageNumNext\", \"tableBodyList\", \"tableBodyError\"); return false;\">$pageNumNext</a></li>";
            	 
              $outputhtml=$outputhtml."  </ul>";
          		$outputhtml=$outputhtml."</div> ";
            $outputhtml=$outputhtml."	 </tbody> ";
            $outputhtml=$outputhtml."  </table> ";
      		$data1['status'] = 'A';
            $data1['class'] = 'has-success';
            $data1['message'] = '';
            $data1['icon'] = $outputhtml;
            echo json_encode($data1);
            return;
        }
        
    }
?>