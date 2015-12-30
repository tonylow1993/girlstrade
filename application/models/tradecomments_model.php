<?php

class tradecomments_model  extends CI_Model {
	var $ID=0;
	var $postID=0;
	var $soldQty=0;
var $soldDate='';
var $soldToUserID=0;
var $sellerRating=0;
var $sellerComment='';
var $buyerUserID=0;
var $buyerRating=0;
var $buyerComment='';
var $buyerDate='';
	
	var $status ='';
	var $rejectReason='';
   var $rejectSpecifiedReason='';
	var $createDate='';

	function __construct()
	{
		parent::__construct();
	}
	
	function getTradeComments($ID){
		$query = $this->db->from('tradecomments')->where('ID', $ID)->get();
		$var=$query->result();
		return $var;
	}
	function getTradeCommentsbyPostID($ID){
		$query = $this->db->from('tradecomments')->where('postID', $ID)->get();
		$var=$query->result();
		return $var;
	}
	
	function getUTradeCommentsList($pageNum){
		$ulimit=ITEMS_PER_PAGE;
		$olimit=0;
		if ($pageNum>1)
			$olimit=($pageNum-1)*ITEMS_PER_PAGE;
		$statusIn=array('U', 'C');
		$query = $this->db->from('tradecomments')->where_in('status', $statusIn)->limit($ulimit, $olimit)->get();
		$var=$query->result();
		return $var;
	}
	function getNoOfItemCountInTradeComments(){
		
		$strQuery="select count(distinct ID) as NoOfCount from tradecomments  where status in ('U')  ";
		$NoOfItemCount=0;
		$query2 = $this->db->query($strQuery);
		$var2=$query2->result_array();
		var_dump($var2);
		$NoOfItemCount=$var2[0]["NoOfCount"];
	
		return $NoOfItemCount;
	}
	function getBuyAdsHistory($userId, $pageNum){
            	$ulimit=ITEMS_PER_PAGE;
            	$olimit=0;
            	if ($pageNum>1)
            		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
            	$whereArray = array('soldToUserID' => $userId);
            	$statusIn=array('A');;
            	$query = $this->db->from('tradecomments')->where($whereArray)->where_in('status', $statusIn) ->limit($ulimit, $olimit)->get();
            	$var= $query->result();
			return $var;
	}
	public function getNoOfItemCountInBuyAdsHistory($userId){
		$strQuery="select count(distinct ID) as NoOfCount from tradecomments where (status='A')  and (soldToUserID=$userId) ";
		$NoOfItemCount=0;
		$query2 = $this->db->query($strQuery);
		$var2=$query2->result_array();
		var_dump($var2);
		$NoOfItemCount=$var2[0]["NoOfCount"];
	
		return $NoOfItemCount;
	}
	function updateTradeComment($data, $ID){
		try{
			$this->db->trans_start();
			$result= $this->db->update('tradecomments', $data, array('ID' => $ID));
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

	function insertTradeComment($data, $messageID){
		try{
			$this->db->trans_start();
			$row=$this->db->insert('tradecomments', $data);
			
			
			$this->db->select_max('ID');
			$result= $this->db->get('tradecomments')->result_array();
			
			$commentID= $result[0]['ID'];
			$row1= $this->db->update('message', array("commentID"=>$commentID), array('messageID' => $messageID));
			
			$query = $this->db->from('post')->where('postID', $data["postID"])->get();
			$var=$query->result();
			$row2=0;
			if($var!=null && count($var)>0){
				$remainQty=$var[0]->remainQty;
				$remainQty=$remainQty-$data["soldQty"];
				if($remainQty<=0)
					$row2=$this->db->update('post', array("status"=>"C", "remainQty"=>$remainQty), array("postID"=>$data["postID"]));
				else 
					$row2=$this->db->update('post', array("remainQty"=>$remainQty), array("postID"=>$data["postID"]));				
			}
			$this->db->trans_complete();
			if($row<=0 || $row2<=0 || $row1<=0){
				log_message('error', "commentID: ".$commentID." and messageID: ".$messageID);
				throw new Exception(ZeroUpdateRecordError);
			}
			else
			{log_message('error', "commentID: ".$commentID." and messageID: ".$messageID);
				return $result;
			}
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
				$result=$this->db->update('tradecomments', $data);
	
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
											$this->db->where('ID', $commentID);
											$result=$this->db->update('tradecomments', $data);
												
												
								}
								$this->db->trans_complete();
						}
					}catch(Exception $ex)
					{
						echo $ex->getMessage();
						return;
					}
	}
	
	public function getMaxTimesMarkSold($userID){
			$strQuery="select count(distinct a.ID) as NoOfCount from tradecomments a inner join post b on a.postID=b.postID  where  a.soldDate=curdate() and b.userID=$userID";
			$NoOfItemCount=0;
			$query2 = $this->db->query($strQuery);
			$var2=$query2->result_array();
			var_dump($var2);
			$NoOfItemCount=$var2[0]["NoOfCount"];
		
			return $NoOfItemCount;
		
	}
}