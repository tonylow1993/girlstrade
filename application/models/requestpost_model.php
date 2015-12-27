<?php
class requestpost_model extends CI_Model {
		
		var $userID =''; 
		var $postID =''; 
		var $status =''; 
		var	$viewOption='';
		var $expriyDate;
		var $createDate; 
					
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function getPendingApproval($userId, $pageNum)
	    {
	    	$ulimit=ITEMS_PER_PAGE;
	    	$olimit=0;
	    	if ($pageNum>1)
	    		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
	    	$arr=array("status"=>"U", "userID"=>$userId);
	    	$query = $this->db->from('requestpost')->where($arr)->limit($ulimit, $olimit)->get();
	    
	    	return $query->result();
	    }
	    function getDirectSendHistoryAsSeller($userId, $pageNum){
	    	$ulimit=ITEMS_PER_PAGE;
	    	$olimit=0;
	    	if ($pageNum>1)
	    		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
	    	$strQuery="select a.*  from requestpost a inner join post b on a.postID=b.postID where a.status in ('A', 'R') and (b.userID=?)  limit $olimit, $ulimit";
	    	$query2 = $this->db->query($strQuery,array($userId));
	    	$var2=$query2->result_array();
	    	return $var2;
	    }
	    function getNoOfItemCountInDirectSendHistoryAsSeller($userId){
	    	$strQuery="select count( *) as NoOfCount from requestpost a inner join post b on a.postID=b.postID where a.status in ('A', 'R') and (b.userID=?) ";
	    	$NoOfItemCount=0;
	    	$query2 = $this->db->query($strQuery,array($userId));
	    	$var2=$query2->result_array();
	    	var_dump($var2);
	    	$NoOfItemCount=$var2[0]["NoOfCount"];
	    	 
	    	return $NoOfItemCount;
	    }
	    function getDirectSendHistory($userId, $pageNum){
	    	$ulimit=ITEMS_PER_PAGE;
	    	$olimit=0;
	    	if ($pageNum>1)
	    		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
	    	$arr=array("userID"=>$userId);
	    	$statusIn=array('R', 'A' );
	    	$query = $this->db->from('requestpost')->where($arr)->where_in("status", $statusIn)->limit($ulimit, $olimit)->get();
	    	 
	    	return $query->result();
	    }
	    function getNoOfItemCountInDirectSendHistory($userId){
	    	$strQuery="select count(distinct postID) as NoOfCount from requestpost where status in ('A', 'R') and (userID=?) ";
	    	$NoOfItemCount=0;
	    	$query2 = $this->db->query($strQuery,array($userId));
	    	$var2=$query2->result_array();
	    	var_dump($var2);
	    	$NoOfItemCount=$var2[0]["NoOfCount"];
	    	 
	    	return $NoOfItemCount;
	    }
	    function getNoOfItemCountInPendingApproval($userId){
	    	$strQuery="select count(distinct postID) as NoOfCount from requestpost where status='U' and (userID=?) ";
	    	$NoOfItemCount=0;
	    	$query2 = $this->db->query($strQuery,array($userId));
	    	$var2=$query2->result_array();
	    	var_dump($var2);
	    	$NoOfItemCount=$var2[0]["NoOfCount"];
	    
	    	return $NoOfItemCount;
	    }
	    function getApproveAndReject($userId, $pageNum)
	    {
	    	$ulimit=ITEMS_PER_PAGE;
	    	$olimit=0;
	    	if ($pageNum>1)
	    		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
	    	$sql="select a.* from requestpost a inner join post b on a.postID=b.postID where b.userID=? and a.status='U' ";
	    	$this->db->limit($ulimit, $olimit);
	    	$query = $this->db->query($sql, array($userId));
	    	
	    	return $query->result();
	    }
	    function getNoOfItemCountInApproveAndReject($userId){
	    	$strQuery="select count(a.postID) as NoOfCount from requestpost a inner join post b on a.postID=b.postID where b.userID=? and a.status='U' ";
	    	$NoOfItemCount=0;
	    	$query2 = $this->db->query($strQuery,  array($userId));
	    	$var2=$query2->result_array();
	    	var_dump($var2);
	    	$NoOfItemCount=$var2[0]["NoOfCount"];
	    	 
	    	return $NoOfItemCount;
	    }
	    function getfUserIDAndPostID($postID, $fUserID, $status)
	    {
	    	$statusSQL=array();
	    	if($status==""){
	    		$statusSQL=array('A', 'R', 'C');
	    	}
	    	else {
	    		$statusSQL=array($status);
	    	}
	    	$query = $this->db->from('requestpost')->where_in('status', $statusSQL)
	    	->where('userID', $fUserID)->where('postID', $postID)->get();
	    	$var=$query->result();
	    	if(!empty($var) and isset($var) and $var<>null and count($var)>0)
	    	{
	    		return true;
	    	}
	    	else
	    		return false;
	     }
		function insert($data)
	    {
	    	try {
	        
            $this->db->trans_start();
    		$var=$this->db->insert('requestpost', $data);
            $this->db->trans_complete();
    		
            if($var>0)
    		return true;
    		else
					throw new Exception(ZeroUpdateRecordError);
				}catch(Exception $ex)
			{
				echo $ex->getMessage();
				log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
				$this->router->fetch_method().
				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
			}
	    		
	    	return false;	    	
	    }
	    function update($data, $whereSQL)
	    {
	    	try {
	    		 
	    		$this->db->trans_start();
	    		$this->db->where($whereSQL);
	    		$var=$this->db->update('requestpost', $data);
	    		$this->db->trans_complete();
	    	
	    		if($var>0)
	    			return true;
	    		else
					throw new Exception(ZeroUpdateRecordError);
			
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
				$this->router->fetch_method().
				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
			}
	    	 
	    	return false;
	    }
}