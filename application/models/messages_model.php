<?php 
	class messages_model extends CI_Model {
		
		var $messageID=''; 
		var $postID =''; 
		var $userID =''; // post userID
		var $fUserID=''; // session userID
		var $title='';
		var $content =''; 
		var $status =''; 
		var $replyID =''; 
		var $createDate=''; 
		var $recipientName='';
		var	$senderEmail='';
		var	$recipientPhoneNumber='';
		var $messageIOType='';
		var $commentID='';
		var $parentID=0;
		var $readflag='N';
		
	    function __construct()
	    {
	        parent::__construct();
	    }
	    function updateReadInboxFlag($messageID){
	    
	    	try {
	    		$this->db->trans_start();
	    		$data=array('readflag'=>'Y');
	    		$this->db->where('messageID', $messageID);
	    		$result=$this->db->update('message', $data);
	    		$this->db->trans_complete();
	    	}catch(Exception $ex)
	    	{
	    		echo $ex->getMessage();
	    		return;
	    	}
	    
	    }
	    
	    public function updateReadInboxBuyerMessageFlag($messageID){
	    
	    	try {
	    		$this->db->trans_start();
	    		$data=array('readflag'=>'Y');
	    		$this->db->where('ID', $messageID);
	    		$result=$this->db->update('buyermessage', $data);
	    		$this->db->trans_complete();
	    	}catch(Exception $ex)
	    	{
	    		echo $ex->getMessage();
	    		return;
	    	}
	    }
	    public function isLastMessage($messageArray, $type){
	    	
	    	$postID=$messageArray->postID;
	    	$userID=0;
	    	$fuserID=0;
	    	if(strcmp($messageArray->status, "Op")==0 || strcmp($messageArray->status, "OC")==0 ){
	    		$userID=$messageArray->userID;
	    		$fuserID=$messageArray->fUserID;
	    	}else {
	    		$fuserID=$messageArray->userID;
	    		$userID=$messageArray->fUserID;
	    	}
	    	$parentID=0;
	    	if($messageArray->parentID==0)
	    		$parentID=$messageArray->messageID;
	    	else 
	    		$parentID=$messageArray->parentID;;
	    	
	    	$str="select max(messageID) as maxID  from message where ( (status in ('Op', 'OC') and userID=$userID and fuserID=$fuserID) or (status in ('R', 'C') and fUserID=$userID and userID=$fuserID) ) and postID=$postID ";
	    	$str=$str." and (messageID=".$parentID." or parentID=".$parentID.") ";
	    	
	    	$query=$this->db->query($str);
	    	$var=$query->result();
	    	if($messageArray->messageID==$var[0]->maxID)
	    		return true;
	    	else
	    		return false;
	    }
	    
	    public function getMessageByMessageID($messageID){
	    	$query = $this->db->from('message')->where('messageID', $messageID)->get();
	    	return $query->result();
	    }
	    
	    public function getPendingPostTotalCount()
	    {
	    	$query = $this->db->from('message')->where('status', 'Op')->get();
	    	return $query->result();
	    }
	    
	    public function getPendingPost($pageNum)
		{
			$ulimit=ITEMS_PER_PAGE;
			$olimit=0;
			if ($pageNum>1)
				$olimit=($pageNum-1)*ITEMS_PER_PAGE;
			$query = $this->db->from('message')->where('status', 'Op')->limit($ulimit, $olimit)->get();
	    	
	        return $query->result();
			
		}
		public function getOutgoingByUserId($userId, $pageNum)
		{
			$ulimit=ITEMS_PER_PAGE;
			$olimit=0;
			if ($pageNum>1)
				$olimit=($pageNum-1)*ITEMS_PER_PAGE;
			
			$strQuery="select * from message where (status in ('R', 'C') and userID=$userId) or (status in ('OC', 'Op') and fUserID=$userId) limit $olimit, $ulimit";
			$query2 = $this->db->query($strQuery);
				
// 			$arr=array("status"=>"R", "userID"=>$userId);
// 			$Carr=array("status"=>"C", "userID"=>$userId);
// 			$Inarr=array("status"=>"OC", "fUserID"=>$userId);
// 			$query = $this->db->from('message')->where($arr)->or_where($Carr)->or_where($Inarr)->limit($ulimit, $olimit)->get();
			
			return $query2->result();
		}
		
		
		
		public function getNoOfItemCountInOutgoing($userId)
		{
			$strQuery="select count(distinct messageID) as NoOfCount from message where (status in ('R', 'C') and userID=$userId) or (status in ('OC', 'Op') and fUserID=$userId) ";
			$NoOfItemCount=0;
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			var_dump($var2);
			$NoOfItemCount=$var2[0]["NoOfCount"];
				
			return $NoOfItemCount;
		}
		
		public function getMaxDailyTimesBuyerSendMsg($postID, $fUserID){
			$strQuery="select count(distinct a.messageID) as NoOfCount from message a inner join post b on a.postID=b.postID where a.status in ('OC', 'Op') and a.fUserID=$fUserID  and a.createDate>=curdate() ";
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			$NoOfItemCount=$var2[0]["NoOfCount"];
				
			return $NoOfItemCount;
		}
		
		public function getMaxTotalTimesBuyerSendMsg($postID, $fUserID){
			$strQuery="select count(distinct a.messageID) as NoOfCount from message a inner join post b on a.postID=b.postID where a.status in ('OC', 'Op') and a.fUserID=$fUserID  ";
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			$NoOfItemCount=$var2[0]["NoOfCount"];
		
			return $NoOfItemCount;
		}
		
		public function getMaxTimesBuyerSend($userID){
			$strQuery="select count(distinct a.messageID) as NoOfCount from message a inner join post b on a.postID=b.postID where ((a.status in ('R', 'C') and a.userID=$userID) or (a.status in ('OC', 'Op') and a.fUserID=$userID)) and b.userID != $userID and a.createDate>=curdate() ";    
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			//var_dump($var2);
			$NoOfItemCount=$var2[0]["NoOfCount"];
			
			return $NoOfItemCount;
		}
		public function getMaxTimesSellerSend($userID){
			$strQuery="select count(distinct a.messageID) as NoOfCount from message a inner join post b on a.postID=b.postID where ((a.status in ('R', 'C') and a.userID=$userID) or (a.status in ('OC', 'Op') and a.fUserID=$userID)) and b.userID = $userID and a.createDate>=curdate()";
			$NoOfItemCount=0;
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			//var_dump($var2);
			$NoOfItemCount=$var2[0]["NoOfCount"];
				
			return $NoOfItemCount;
		}
		public function getMaxTimesDeleteAds($userID){
			$strQuery="select count(distinct a.postID) as NoOfCount from post a where a.userID = $userID and a.deleteDate>=curdate()";
			$NoOfItemCount=0;
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			//var_dump($var2);
			$NoOfItemCount=$var2[0]["NoOfCount"];
		}
		public function getInBoxByPostUserId($userId, $pageNum)
		{
			$ulimit=ITEMS_PER_PAGE;
			$olimit=0;
			if ($pageNum>1)
				$olimit=($pageNum-1)*ITEMS_PER_PAGE;
			
			$strQuery="select * from message where (status in ('Op', 'OC') and userID=$userId) or (status in ('R', 'C') and fUserID=$userId) limit $olimit, $ulimit ";
			$query2 = $this->db->query($strQuery);
// 			$arr=array("status"=>"Op", "userID"=>$userId);
// 			$farr=array("status"=>"R", "fUserID"=>$userId);
// 			$Inarr=array("status"=>"OC", "userID"=>$userId);
// 			$Outarr=array("status"=>"C", "fUserID"=>$userId);
// 			$query = $this->db->from('message')->where($arr)->or_where($farr)->or_where($Inarr)->or_where($Outarr)->limit($ulimit, $olimit)->get();
		
			return $query2->result();
				
		}
		
		public function getUnReadInboxMessage($userId){
			
			try{
			//$strQuery="select count(distinct messageID) as NoOfCount from message where ((status in ('Op', 'OC') and userID=$userId) or (status in ('R', 'C') and fUserID=$userId )) and readflag='N' ";
			$strQuery="select count(distinct ID) as NoOfCount from buyermessage where userID=$userId and readflag='N' ";
			$NoOfItemCount=0;
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			//var_dump($var2);
			$NoOfItemCount=$var2[0]["NoOfCount"];
				
			return $NoOfItemCount;
			}catch(Exception $ex){ return 0;}
		}
		
		public function getNoOfItemCountInInbox($userId){
			$strQuery="select count(distinct messageID) as NoOfCount from message where (status in ('Op', 'OC') and userID=$userId) or (status in ('R', 'C') and fUserID=$userId) ";
			$NoOfItemCount=0;
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			var_dump($var2);
			$NoOfItemCount=$var2[0]["NoOfCount"];
			
			return $NoOfItemCount;
		}
	function delete($data, $where)
	{
		try {
			 
			$this->db->trans_start();
			$this->db->where($where);
			$var=$this->db->update('message', $data);
			$this->db->trans_complete();
		
			if($var>0)
				return true;
		 else 
		 	throw new Exception(ZeroUpdateRecordError);
		}catch (Exception $ex) {
			echo 'Caught exception: ',  $ex->getMessage(), "\n";
			log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
					$this->router->fetch_method().
					"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
			return false;
		}
					
	}
	
	function getOriginalMessageID($messageID){
		$str="select parentID, messageID from message where messageID=".$messageID;
		$query=$this->db->query($str);
		$var=$query->result();
		if($var<>null && count($var)>0){
			if($var[0]->parentID==0)
				return $var[0]->messageID;
			else
				return $var[0]->parentID;
		}
		else 
			return 0;
	}
	function reply($data, $messageID, $originalStatus, $parentID)
	    {
	    	try {
	        
            $this->db->trans_start();
    		$var=$this->db->insert('message', $data);
    		$data1=array('status'=>'C', 'parentID'=>$parentID );
    		if(strcmp($originalStatus,"Op")==0){
    			$data1=array('status'=>'OC' ,'parentID'=>$parentID );
    		}
    		$this->db->where('messageID', intval($messageID));
    		$var1=$this->db->update('message', $data1);
    		$this->db->trans_complete();
    		
            if($var>0)
            	return true;
            else 	throw new Exception(ZeroUpdateRecordError);
		}catch (Exception $ex) {
			echo 'Caught exception: ',  $ex->getMessage(), "\n";
			log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
					$this->router->fetch_method().
					"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
			return false;
            
    		//$this->db->select_max('messageID');
     		//$result= $this->db->get('message')->result_array();
     		   		
    		//return $result[0]['messageID'];
	    	//}catch (Exception $e) {
    		//	echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	    
	    }
	    function insert($data)
	    {
	    	try {
	    		 
	    		$this->db->trans_start();
	    		$var=$this->db->insert('message', $data);
	    			$this->db->trans_complete();
	    
	    		if($var>0)
	    			return true;
	    		else 	throw new Exception(ZeroUpdateRecordError);
		}catch (Exception $ex) {
			//echo 'Caught exception: ',  $ex->getMessage(), "\n";
			log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
					$this->router->fetch_method().
					"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
			return false;
	    
	    		//$this->db->select_max('messageID');
	    		//$result= $this->db->get('message')->result_array();
	    
	    		//return $result[0]['messageID'];
	    		//}catch (Exception $e) {
	    		//	echo 'Caught exception: ',  $e->getMessage(), "\n";
	    	}
	    	 
	    
	    }
	    
	    public function getSoldUserList($postID){
	    	$str="select solduserList.userID as soldUserID, solduserList.username as soldUsername
	    			from  (select b.userID, b.username ";
	    	$str=$str."  from message a inner join user b on a.userID=b.userID ";
	    	$str=$str." inner join post c on a.postID=c.postID ";
	    	$str=$str."	where a.status in ('C', 'R') and c.userID != a.userID and  a.postID=".$postID;
	    	$str=$str." union all ";
	    	$str=$str." select b.userID, b.username ";
	    	$str=$str."  from message a inner join user b on a.fUserID=b.userID ";
	    	$str=$str." inner join post c on a.postID=c.postID ";
	    	$str=$str."	where a.status in ('OC', 'Op') and  c.userID != a.fUserID and a.postID=".$postID;
	    	$str=$str." union all ";
	    	$str=$str." SELECT a.userID, b.username FROM requestpost a inner join user b
								on a.userID=b.userID  inner join post c on a.postID=c.postID 
								where a.postID=".$postID. "  and c.userID != a.userID  ) solduserList ";
	     	$str=$str."	group by solduserList.userID, solduserList.username";
	    	$query=$this->db->query($str);
	    	$var=$query->result();
	    	return $var;
	    }
	    
	    public function getViewMessageHistory($userID, $postID, $fuserID){
			$strQuery="select a.* from ( ";
	    	$strQuery=$strQuery." select *, 'outBox' as messageIOType from message where ((status in ('R', 'C') and userID=$userID and fuserID=$fuserID) or (status in ('OC', 'Op') and fUserID=$userID and userID=$fuserID) ) and postID=$postID ";
	    	$strQuery=$strQuery." union all ";
	    	$strQuery=$strQuery." select *, 'inBox' as messageIOType  from message where ( (status in ('Op', 'OC') and userID=$userID and fuserID=$fuserID) or (status in ('R', 'C') and fUserID=$userID and userID=$fuserID) ) and postID=$postID ";
	    	$strQuery=$strQuery." ) a order by a.createDate desc ";
	    	//log_message('error', $strQuery.": param:fuserID: ".$fuserID." userID: ".$userID);;
	    	$query2 = $this->db->query($strQuery);
	   		return $query2->result();
	    }
	    public function getAllFeedbacks($userID, $pageNum, $sortType, $sortByDate, $sortByType){
	    	$ulimit=ITEMS_PER_PAGE;
	    	$olimit=0;
	    	if ($pageNum>1)
	    		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
	    	$sortStr=" order by createDate desc ";
	    	if(strcmp($sortType,"1")==0){
	    		if(strcmp($sortByDate,"3")==0){
	    			$sortStr=" order by createDate desc ";
	    		}else if(strcmp($sortByDate,"4")==0){
	    			$sortStr=" order by createDate asc ";
	    		}
	    	}
	    	$filterStr="";
	    	if(strcmp($sortType,"2")==0){
	    		if(strcmp($sortByType,"1")==0){
	    			$filterStr=" and rating=3 ";
	    		}else if(strcmp($sortByType,"2")==0){
	    			$filterStr=" and rating=1 ";
	    		}else if(strcmp($sortByType,"3")==0){
	    			$filterStr=" and rating=2 ";
	    		}
	    	}
	    		
	    		
	    	$strQuery="select b.* from (select a.* from ( ";
	    	if(strcmp(SHOWBUYERINFORMATION,"Y")==0){
		    	$strQuery=$strQuery." select *, 'buyer' as type from sellerfeedback where status='A' and buyerID=$userID ".$filterStr;
		    	$strQuery=$strQuery." union all ";
	    	}
	    	$strQuery=$strQuery." select *, 'seller' as type  from buyerfeedback where status='A' and sellerID=$userID ".$filterStr;
	    	$strQuery=$strQuery." ) a  ".$sortStr." ) b limit $olimit, $ulimit";
	    	//log_message('error', $strQuery.": param:fuserID: ".$fuserID." userID: ".$userID);;
	    	$query2 = $this->db->query($strQuery);
	    	return $query2->result();
	    }
	    public function getNoOfItemCountInAllFeedbacks($userID, $sortType, $sortByDate, $sortByType){
	    	$filterStr="";
	    	if(strcmp($sortType,"2")==0){
	    		if(strcmp($sortByType,"1")==0){
	    			$filterStr=" and rating=3 ";
	    		}else if(strcmp($sortByType,"2")==0){
	    			$filterStr=" and rating=1 ";
	    		}else if(strcmp($sortByType,"3")==0){
	    			$filterStr=" and rating=2 ";
	    		}
	    	}
	    	$strQuery="select count(*) as NoOfCount from ( ";
	    	$strQuery=$strQuery." select *, 'buyer' as type from sellerfeedback where status='A' and buyerID=$userID ".$filterStr;
	    	$strQuery=$strQuery." union all ";
	    	$strQuery=$strQuery." select *, 'seller' as type  from buyerfeedback where status='A' and sellerID=$userID ".$filterStr;
	    	$strQuery=$strQuery." ) a ";
	    	$NoOfItemCount=0;
	    	$query2 = $this->db->query($strQuery);
	    	$var2=$query2->result_array();
	    	//var_dump($var2);
	    	$NoOfItemCount=$var2[0]["NoOfCount"];
	    	
	    	return $NoOfItemCount;
	    }
	    
	    public function getNoOfItemCountInOutgoingByPostUserId($userID){
	    	$strQuery="select count(*) as NoOfCount from buyermessage where fromUserID=$userID";
	    	$NoOfItemCount=0;
	    	$query2 = $this->db->query($strQuery);
	    	$var2=$query2->result_array();
	    	$NoOfItemCount=$var2[0]["NoOfCount"];
	    	
	    	return $NoOfItemCount;
	    }
	    public function getOutgoingByPostUserId($userID, $pageNum, $sortByDate){
	    	$ulimit=ITEMS_PER_PAGE;
	    	$olimit=0;
	    	if ($pageNum>1)
	    		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
    		$sortByDateString="";
    		if(strcmp($sortByDate,"1")==0){
    			$sortByDateString=" order by createDate desc";
    		}else if(strcmp($sortByDate,"2")==0){
    			$sortByDateString=" order by createDate asc";
    		}
    		$strQuery="select * from buyermessage where fromUserID=$userID $sortByDateString limit $olimit, $ulimit";
    		$query2 = $this->db->query($strQuery);
    			
    		return $query2->result();
	    }
	    public function getNoOfItemCountInBuyerMessageInboxByPostUserId($userID){
	    	$strQuery="select count(*) as NoOfCount from buyermessage where  userID=$userID";
	    	$NoOfItemCount=0;
	    	$query2 = $this->db->query($strQuery);
	    	$var2=$query2->result_array();
	    	$NoOfItemCount=$var2[0]["NoOfCount"];
	    	
	    	return $NoOfItemCount;
	    }
	    public function getBuyerMessageInBoxByPostUserId($userID, $pageNum, $sortByDate){
	    	$ulimit=ITEMS_PER_PAGE;
	    	$olimit=0;
	    	if ($pageNum>1)
	    		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
    		$sortByDateString="";
    		if(strcmp($sortByDate,"1")==0){
    			$sortByDateString=" order by createDate desc";
    		}else if(strcmp($sortByDate,"2")==0){
    			$sortByDateString=" order by createDate asc";
    		}
    		$strQuery="select * from buyermessage where  userID=$userID $sortByDateString limit $olimit, $ulimit";
    		$query2 = $this->db->query($strQuery);
    	
    		return $query2->result();
	    }
	    
	    public function getBuyerMessageByUserID($userID, $pageNum, $sortByDate, $reportType, $fromUserID){
	    	$ulimit=ITEMS_PER_PAGE;
	    	$olimit=0;
	    	if ($pageNum>1)
	    		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
	    		$sortByDateString="";
	    		if(strcmp($sortByDate,"1")==0){
	    			$sortByDateString=" order by c.createDate desc";
	    		}else if(strcmp($sortByDate,"2")==0){
	    			$sortByDateString=" order by c.createDate asc";
	    		}
	    		$strQuery="";
	    		if(strcmp($reportType, "Summary")==0){
	    			$strQuery="select c.*, b.msgType, b.unreadcount from
						(select a.user1, a.user2, max(a.ID) as maxID,
						case when a.user1=$userID then 'Inbox' else 'Outbox' end as msgType,
						sum(case when a.readflag = 'Y' then 1 else 0 end) as unreadcount
						 from (			
						    select userID as user1, fromUserID as user2, ID, readflag from buyermessage where  userID=$userID Union all 
						    select fromUserID as user1, userID as user2, ID, readflag from buyermessage where fromUserID=$userID ) a
						group by a.user1, a.user2 ) b inner join buyermessage c on b.maxID=c.ID
	    					$sortByDateString limit $olimit, $ulimit";
	    		}else{
	    			$strQuery="select c.* from (
	    			select *, 'Inbox' as msgType from buyermessage where fromUserID=$fromUserID and userID=$userID Union all
	    			select *, 'Outbox' as msgType from buyermessage where fromUserID=$userID and userID=$fromUserID) c
	    			$sortByDateString"; // limit $olimit, $ulimit";
	    		}
	    		$query2 = $this->db->query($strQuery);
	    		 
	    		return $query2->result();
	    }
	    
	    public function getNoOfItemCountInBuyerMessageByUserID($userID, $reportType, $fromUserID){
	    	$strQuery="";
	    	if(strcmp($reportType, "Summary")==0){
		    	$strQuery="select count(*) as NoOfCount from 
	    		(select a.user1, a.user2, max(a.ID) as maxID,
						case when a.user1=$userID then 'Inbox' else 'Outbox' end as msgType,
						sum(case when a.readflag = 'Y' then 1 else 0 end) as unreadcount
						 from (			
						    select userID as user1, fromUserID as user2, ID, readflag from buyermessage where  userID=$userID Union all 
						    select fromUserID as user1, userID as user2, ID, readflag from buyermessage where fromUserID=$userID ) a
						group by a.user1, a.user2 ) b inner join buyermessage c on b.maxID=c.ID";
	    	}else{
	    		$strQuery="select count(*) as NoOfCount from (
	    		select *, 'Inbox' as msgType from buyermessage where  userID=$userID and fromUserID=$fromUserID Union all
	    		select *, 'Outbox' as msgType from buyermessage where fromUserID=$userID and userID=$fromUserID ) a";
	    		
	    	}
    		$NoOfItemCount=0;
	    	$query2 = $this->db->query($strQuery);
	    	$var2=$query2->result_array();
	    	$NoOfItemCount=$var2[0]["NoOfCount"];
	    	
	    	return $NoOfItemCount;
	    }
	    
	}
	
?>