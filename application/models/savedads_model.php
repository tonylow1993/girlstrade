<?php
class savedads_model extends CI_Model {

	var $userID ='';
	var $postID ='';
	var $status ='';
	var $expriyDate;
	var $createDate;
		
	function __construct()
	{
		parent::__construct();
	}
	 
	
	
	function getSavedAds($userId, $pageNum)
	{
		$ulimit=ITEMS_PER_PAGE;
		$olimit=0;
		if ($pageNum>1)
			$olimit=($pageNum-1)*ITEMS_PER_PAGE;
		$arr=array("status"=>"U", "userID"=>$userId);
		$query = $this->db->from('savedAds')->where($arr)->limit($ulimit, $olimit)->get();
	  
		return $query->result();
	}
	public function getNoOfItemCountInSavedAds($userId){
		$strQuery="select count(distinct postID) as NoOfCount from savedAds where status=? and (userID=?) ";
		$NoOfItemCount=0;
		$arr=array("status"=>"U", "userID"=>$userId);
		$query2 = $this->db->query($strQuery, $arr);
		$var2=$query2->result_array();
		var_dump($var2);
		$NoOfItemCount=$var2[0]["NoOfCount"];
		 
		return $NoOfItemCount;
	}
	function insert($data)
	{
		try {
			 
			$this->db->trans_start();
			$var=$this->db->insert('savedAds', $data);
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
			$var=$this->db->update('savedAds', $data);
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