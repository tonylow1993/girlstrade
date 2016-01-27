<?php
class abusemessages_model extends CI_Model {

	var $messageID='';
	var $postID ='';
	var $fUserID=''; // session userID
	var $content ='';
	var $status ='';
	var $rejectReason='';
	var $rejectSpecifiedReason='';
	var $reportreason='';
	var $createDate='';
	var $recipientName='';
	var	$senderEmail='';
	var	$recipientPhoneNumber='';
		
	function __construct()
	{
		parent::__construct();
	}
	function insert($data)
	{
		try {
	
			$this->db->trans_start();
			$var=$this->db->insert('abusemessages', $data);
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
	public function getNoOfItemCountInAbuseMessages(){
		$strQuery="select count(distinct messageID) as NoOfCount from abusemessages  where status in ('U')  ";
		$NoOfItemCount=0;
		$query2 = $this->db->query($strQuery);
		$var2=$query2->result_array();
		var_dump($var2);
		$NoOfItemCount=$var2[0]["NoOfCount"];
		
		return $NoOfItemCount;
	}
	public function getUAbuseMessagesList($pageNum){
		$ulimit=ITEMS_PER_PAGE;
		$olimit=0;
		if ($pageNum>1)
			$olimit=($pageNum-1)*ITEMS_PER_PAGE;
		
		$statusIn=array('U');
		$query = $this->db->from('abusemessages')->where_in('status', $statusIn)->limit($ulimit, $olimit)->get();
		$var=$query->result();
		return $var;
	}
	
	function updateApprovePost($array)
	{
		try {
			$this->db->trans_start();
			
			
			foreach($array as $id=> $commentID)
			{
	
				$data=array('status'=>'A');
				$this->db->where('messageID', intval($commentID));
				$result=$this->db->update('abusemessages', $data);
	
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
			{
				$this->db->trans_start();
				foreach($array as $detail)
				{
					$commentID=$detail['commentID'];
					$rejectReason=$detail['rejectReason'];
					$rejectSpecifiedReason=$detail['rejectSpecifiedReason'];
					$data=array('status'=>'R', 'rejectReason'=>$rejectReason ,'rejectSpecifiedReason' =>$rejectSpecifiedReason );
					$this->db->where('messageID', $commentID);
					$result=$this->db->update('abusemessages', $data);
	
	
				}
				$this->db->trans_complete();
			}
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			return;
		}
	}
}