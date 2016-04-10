<?php
class userInfoSendEmail_model extends CI_Model{

	var $userID = '';
	// GETAMDIN
	var $APPROVETRADECOMMENT='';
	var $REJECTTRADECOMMENT='';
	var $APPROVEFEEDBACK='';
	var $REJECTFEEDBACK=''; 
	var $REJECTITEMCOMMENT=''; 
	var $APPROVEITEMCOMMENT='';
	var $APPROVEABUSE=''; 
	var $REJECTABUSE=''; 
	var $APPROVEPOST='';
	var $REJECTPOST='';
	var $APPROVEUSERPHOTO=''; 
	var $REJECTUSERPHOTO=''; 
	// HOME
	var $SIGNUPSENDEMAIL=''; 
	var $FORGETPASSWORDSENDEMAIL=''; 
	var $RESETPASSWORDSENDEMAIL='';
	var $CHANGEPASSWORDSENDEMAIL=''; 
	var $UPDATEPASSWORDSENDEMAIL=''; 
	
	// MESSAGES
	var $DIRECTSENDEMAIL=''; 
	var $DELETEABUSEMESSAGESENDEMAIL=''; 
	var $INSERTABUSEMESSAGESENDEMAIL=''; 
	var $INSERTMESSAGESENDEMAIL='';
	var $APPROVEDIRECTSEND=''; 
	var $REJECTDIRECTSEND=''; 
	var $REPLYMESSAGESENDEMAIL=''; 
	var $sendEmailForApproveReject=''; 
	

	function __construct()
	{
		parent::__construct();
	}
	function getSendEmailConfigByUserID($userID)
	{
		$result = $this->db->list_fields('userAllowSendEmailConfig');
		$where=array("userID"=>$userID);
		$query = $this->db->from('userAllowSendEmailConfig')->where($where)->limit(1)->get();
		$var=$query->result();
		$data=array();
		if(isset($var) && !empty($var) && sizeof($var)>0){
			foreach($result as $field)
			{
				//if(strcmp($field,"userID")==0)
				//	continue;
				$temp = array("type"=>$field, "typeValue"=>$var[0]->$field);
				array_push($data, $temp);
			}
		}
		return $data;
	}
	
	function updateSendEmailConfig($data){
		try {
			$this->db->trans_start();
			$this->db->where("userID",$data["userID"]);
			$var=$this->db->update('userAllowSendEmailConfig', $data);
			$this->db->trans_complete();
			if($var>0)
				return $var;
				else
					throw new Exception(ZeroUpdateRecordError);
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
					$this->router->fetch_method().
					"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
		}
		
		return 0;
	}
	
	function getAlowSendEmailByType($userID, $type)
	{
		$where=array("userID"=>$userID);
		$query = $this->db->from('userAllowSendEmailConfig')->where($where)->limit(1)->get();
		$var= $query->first_row('array');
		if(isset($var) && $var!=null)
			return $var[$type]==1;
		else
			return false;
	}
}
?>