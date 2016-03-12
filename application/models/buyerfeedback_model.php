<?php
class buyerfeedback_model extends CI_Model {
	var $ID='';
	var $postID='';
	var $sellerID='';
	var $buyerID='';
	var $rating='';
	var $content ='';
	var $status ='';
	var $rejectReason='';
	var $rejectSpecifiedReason='';
	var $rejectDate='';
	var $createDate='';
	
	function __construct()
	{
		parent::__construct();
	}
	function insert($data)
	{
		try {
	
			$this->db->trans_start();
			$var=$this->db->insert('buyerfeedback', $data);
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
			
		return false;
			
	}
	
	function updateApprovePost($array)
	{
		try {
			$this->db->trans_start();
			foreach($array as $row)
			{
				$tablename="buyerfeedback";
				if(strcmp($row["type"], "buyer")){
					$tablename="buyerfeedback";
				}else{
					$tablename="sellerfeedback";
				}
				$commentID=$row["commentID"];
				$data=array('status'=>'A');
				$this->db->where('ID', intval($commentID));
				$result=$this->db->update($tablename, $data);
	
			}
			$this->db->trans_complete();
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
	}
	function updateRejectPost($array)
	{
		try {
	
			if (is_array($array) || is_object($array))
			{$this->db->trans_start();
			foreach($array as $detail)
			{
				$tablename="buyerfeedback";
				if(strcmp($detail["type"], "buyer")){
					$tablename="buyerfeedback";
				}else{
					$tablename="sellerfeedback";
				}
				$commentID=$detail['commentID'];
				$rejectReason=$detail['rejectReason'];
				$rejectSpecifiedReason=$detail['rejectSpecifiedReason'];
				$data=array('status'=>'R', 'rejectReason'=>$rejectReason ,'rejectSpecifiedReason' =>$rejectSpecifiedReason );
				$this->db->where('ID', $commentID);
				$result=$this->db->update($tablename, $data);
	
	
			}
			$this->db->trans_complete();
			}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
	}
	public function getNoOfItemCountInApproveFeedBack(){
		$strQuery="select count(*) as NoOfCount from ( select * from buyerfeedback  where status ='U'  union all select * from sellerfeedback where status='U' ) a";
		$NoOfItemCount=0;
		$query2 = $this->db->query($strQuery);
		$var2=$query2->result_array();
		var_dump($var2);
		$NoOfItemCount=$var2[0]["NoOfCount"];
		
		return $NoOfItemCount;
	}
	public function getApproveFeedBackUnverifiedList($pageNum){
		$ulimit=ITEMS_PER_PAGE;
		$olimit=0;
		if ($pageNum>1)
			$olimit=($pageNum-1)*ITEMS_PER_PAGE;
		
			$strQuery="select b.* from (select a.* from ( ";
	    	$strQuery=$strQuery." select *, 'buyer' as type from sellerfeedback where status='U'  ";
	    	$strQuery=$strQuery." union all ";
	    	$strQuery=$strQuery." select *, 'seller' as type  from buyerfeedback where status='U'  ";
	    	$strQuery=$strQuery." ) a  order by a.createDate desc ) b "; //limit $olimit, $ulimit";
	    	//log_message('error', $strQuery.": param:fuserID: ".$fuserID." userID: ".$userID);;
	    	$query2 = $this->db->query($strQuery);
	    	return $query2->result();
	}
}