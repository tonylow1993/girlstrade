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
	var $SELLERFEEDBACKSENDEMAIL='';
	var $BUYERFEEDBACKSENDEMAIL='';
	

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
				
				if(strcmp($field, "APPROVEPOST")==0 || 
						strcmp($field, "REJECTPOST")==0 ||
						strcmp($field, "DIRECTSENDEMAIL")==0 ||
						strcmp($field, "INSERTMESSAGESENDEMAIL")==0 ||
						strcmp($field, "APPROVEDIRECTSEND")==0 ||
						strcmp($field, "REJECTDIRECTSEND")==0 ||
						strcmp($field, "REPLYMESSAGESENDEMAIL")==0){
						//strcmp($field, "APPROVEFEEDBACK")==0 ||
						//strcmp($field, "REJECTFEEDBACK")==0 ){
						//|| strcmp($field, "sendEmailForApproveReject")==0){
				$temp = array("type"=>$field, "typeValue"=>$var[0]->$field);
				array_push($data, $temp);
				}
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
	
	function insertNewSendEmailConfig($userID){
		try {
			$this->db->trans_start();
			$data=array("userID"=>$userID,"SELLERFEEDBACKSENDEMAIL"=>1, "BUYERFEEDBACKSENDEMAIL"=>1, "APPROVETRADECOMMENT" => 1, "REJECTTRADECOMMENT" => 1, "APPROVEFEEDBACK" => 1, "REJECTFEEDBACK" => 1, "REJECTITEMCOMMENT" => 1, "APPROVEITEMCOMMENT" => 1, "APPROVEABUSE" => 1, "REJECTABUSE" => 1, "APPROVEPOST" => 1, "REJECTPOST" => 1, "APPROVEUSERPHOTO" => 1, "REJECTUSERPHOTO" => 1, "SIGNUPSENDEMAIL" => 1, "FORGETPASSWORDSENDEMAIL" => 1, "RESETPASSWORDSENDEMAIL" => 1, "CHANGEPASSWORDSENDEMAIL" => 1, "UPDATEPASSWORDSENDEMAIL" => 1, "DIRECTSENDEMAIL" => 1, "DELETEABUSEMESSAGESENDEMAIL" => 1, "INSERTABUSEMESSAGESENDEMAIL" => 1, "INSERTMESSAGESENDEMAIL" => 1, "APPROVEDIRECTSEND" => 1, "REJECTDIRECTSEND" => 1, "REPLYMESSAGESENDEMAIL" => 1, "sendEmailForApproveReject"=>1 );
			$var=$this->db->insert('userAllowSendEmailConfig', $data);
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