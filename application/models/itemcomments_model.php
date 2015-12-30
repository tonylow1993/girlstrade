<?php
class itemcomments_model  extends CI_Model {

	var $postID='';
	var $usercommentID ='';
	var $comments=''; // session userID
	var $status ='';
	 var $rejectReason='';
            var $rejectSpecifiedReason='';
	var $createDate='';
	var $ID=0;
	var $parentID=0;
	
	function __construct()
	{
		parent::__construct();
	}
	

	function getItemComments($ID){
		$query = $this->db->from('itemcomments')->where('ID', $ID)->get();
		$var=$query->result();
		return $var;
	}
	function getItemCommentsbyPostID($ID){
		$wherearr=array("postID"=>$ID, "status"=>"A", "parentID"=>0);
		$query = $this->db->from('itemcomments')->where($wherearr)->get();
		$var=$query->result();
		return $var;
	}
	
	function getItemCommentsbyPostIDParentID($postID, $parentID){
		$wherearr=array("postID"=>$postID, "status"=>"A", "parentID"=>$parentID);
		$query = $this->db->from('itemcomments')->where($wherearr)->get();
		$var=$query->result();
		return $var;
	}
	
	function getUItemCommentsList($pageNum){
		$ulimit=ITEMS_PER_PAGE;
		$olimit=0;
		if ($pageNum>1)
			$olimit=($pageNum-1)*ITEMS_PER_PAGE;
		
		$statusIn=array('U');
		$query = $this->db->from('itemcomments')->where_in('status', $statusIn)->limit($ulimit, $olimit)->get();
		$var=$query->result();
		return $var;
	}
	function getNoOfItemCountInItemComments(){
		$strQuery="select count(distinct ID) as NoOfCount from itemcomments  where status in ('U')  ";
		$NoOfItemCount=0;
		$query2 = $this->db->query($strQuery);
		$var2=$query2->result_array();
		var_dump($var2);
		$NoOfItemCount=$var2[0]["NoOfCount"];
		
		return $NoOfItemCount;
	}
	function updateItemComment($data){
		try{
			$this->db->trans_start();
			$result= $this->db->update('itemcomments', $data, array('ID' => $data['ID']));
			$this->db->trans_complete();
			if($result<=0)
				throw new Exception(ZeroUpdateRecordError);
			else
				return $result;
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
					$this->router->fetch_method().
					"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
		}
		return 0;
	}
	
	function insertItemComment($data){
		try{
			$this->db->trans_start();
			$result= $this->db->insert('itemcomments', $data);
			$this->db->trans_complete();
			if($result<=0)
				throw new Exception(ZeroUpdateRecordError);
			else
				return $result;
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
					$this->router->fetch_method().
					"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
		}
		return 0;
	}
	function updateApprovePost($array)
	{
		try {
			$this->db->trans_start();
			foreach($array as $id=> $commentID)
			{
	
				$data=array('status'=>'A');
				$this->db->where('ID', intval($commentID));
				$result=$this->db->update('itemcomments', $data);
	
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
					$commentID=$detail['commentID'];
					$rejectReason=$detail['rejectReason'];
					$rejectSpecifiedReason=$detail['rejectSpecifiedReason'];
					$data=array('status'=>'R', 'rejectReason'=>$rejectReason ,'rejectSpecifiedReason' =>$rejectSpecifiedReason );
					$this->db->where('ID', $commentID);
					$result=$this->db->update('itemcomments', $data);
	
	
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