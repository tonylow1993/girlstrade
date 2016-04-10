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