<?php
class sendEmailLog_model extends CI_Model {

	var $ID='';
	var $userID ='';
	var $toEmailAddress=''; 
	var $title ='';
	var $type ='';
	var $createDate='';
		
	function __construct()
	{
		parent::__construct();
	}
	
	function getNoOfCountByUserID($userID, $emailAddress){
		$minutes=MAXTIMESMINUTESSENDEMAIL;
		$strQuery="";
		
		$user1=$this->nativesession->get("user");
		if(!isset($user1) or empty($user1) or $user1==null)
			$userID=0; //$userEmail["userID"];
		else 
			$userID=$user1["userID"];
		if($userID==0)
			$strQuery="select count(distinct ID) as NoOfCount from sendEmailLog  where toEmailAddress='$emailAddress' and userID=0  and createDate between  DATE_ADD(NOW(), INTERVAL -".MAXTIMESMINUTESSENDEMAIL ." MINUTE) and NOW()";
		else 
			$strQuery="select count(distinct ID) as NoOfCount from sendEmailLog  where userID=$userID and createDate between  DATE_ADD(NOW(), INTERVAL -".MAXTIMESMINUTESSENDEMAIL ." MINUTE) and NOW()";
		$NoOfItemCount=0;
		$query = $this->db->query($strQuery);
		$var=$query->result_array();
		$NoOfItemCount=$var[0]["NoOfCount"]+1;
		
		return $NoOfItemCount;
	}
	
	function insert($data)
	{
		try {
	
			$this->db->trans_start();
			$var=$this->db->insert('sendEmailLog', $data);
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
}
?>
