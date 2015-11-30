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
			
	    function __construct()
	    {
	        parent::__construct();
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
			
			$strQuery="select * from message where (status in ('R', 'C') and userID=$userId) or (status='OC' and fUserID=$userId) limit $olimit, $ulimit";
			$query2 = $this->db->query($strQuery);
				
// 			$arr=array("status"=>"R", "userID"=>$userId);
// 			$Carr=array("status"=>"C", "userID"=>$userId);
// 			$Inarr=array("status"=>"OC", "fUserID"=>$userId);
// 			$query = $this->db->from('message')->where($arr)->or_where($Carr)->or_where($Inarr)->limit($ulimit, $olimit)->get();
			
			return $query2->result();
		}
		
		public function getNoOfItemCountInOutgoing($userId)
		{
			$strQuery="select count(distinct messageID) as NoOfCount from message where (status in ('R', 'C') and userID=$userId) or (status='OC' and fUserID=$userId) ";
			$NoOfItemCount=0;
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			var_dump($var2);
			$NoOfItemCount=$var2[0]["NoOfCount"];
				
			return $NoOfItemCount;
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
	function reply($data, $messageID, $originalStatus)
	    {
	    	try {
	        
            $this->db->trans_start();
    		$var=$this->db->insert('message', $data);
    		$data1=array('status'=>'C');
    		if(strcmp($originalStatus,"Op")==0){
    			$data1=array('status'=>'OC');
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
	    
	    public function getSoldUserList($postID){
	    	$str="select b.userID as soldUserID, b.username as soldUsername ";
	    	$str=$str."  from message a inner join user b on a.fUserID=b.userID ";
	    	$str=$str."	where a.postID=".$postID;
	    	$str=$str."	group by b.userID, b.username";
	    	$query=$this->db->query($str);
	    	$var=$query->result();
	    	return $var;
	    }
	}

?>