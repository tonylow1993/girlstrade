<?php
class sellerfeedback_model extends CI_Model {
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
			$var=$this->db->insert('sellerfeedback', $data);
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
	
	function getSellerFeedbackByUserID($userID, $postID)
	{
		$wherearr=array('sellerID'=> $userID, 'postID' => $postID);
		$query = $this->db->from('sellerfeedback')->where($wherearr)->limit(1)->get();
		return $query->first_row('array');
	}
	
}