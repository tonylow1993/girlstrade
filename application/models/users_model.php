<?php 
	class users_model extends CI_Model {
	
	    var $userID = '';
	    var $username = '';
	    var $ip = '';
		var $point = '';
		var $accountStatus = '';
		var $createDate = '';
		var $usertype='';
		var $lastLoginTime;
		var $picturePath='';
		var $pictureName='';
		var $photostatus='';
		var $thumbnailPath='';
		var $thumbnailName='';
		var $rejectReason='';
		var $rejectSpecifiedReason='';
		var $blockDate;
		
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    public function get_user_by_id($userID)
	    {	
	    	$query = $this->db->from('user')->where('userID', $userID)->limit(1)->get();
	    	
	        return $query->result();
	    }
	    
// 	    function get_user_by_name($username){
// 	    	$query = $this->db->from('user')->where('username', $username)->limit(1)->get();
// 	    	return $query->result();
// 	    }
	    
	    function get_user_by_name($username){
	    	$query = $this->db->from('user')->where('LOWER(username)', strtolower($username))->get();
	    	return $query->row();
	    }
	    
	    function isUserExist($username){
	    	$query = $this->db->from('user')->where('LOWER(username)', strtolower($username))->get();
	    	if ($query->num_rows() > 0){
	    		return true;
	    	}
	    	else{
	    		return false;
	    	}
	    }
	    
	    function insert($data)
	    {
	    	try{
	    		$date=new DateTime();
	    	
	    		
	        $this->username = $data['username'];
	        $this->ip = $data['ip'];
	        $this->point = $data['point'];
	        $this->accountStatus = $data['accountStatus'];
	        $this->createDate = $date->format('Y-m-d H:i:s');
	        $this->usertype="PREMIUMPOSTEXPIRYDAYS";
	        $this->lastLoginTime= $date->format('Y-m-d H:i:s');
			log_message('debug', 'before inserting the usertable');
			$this->db->trans_start();
	        $this->db->insert('user', $this);
	        $this->db->trans_complete();
	        }catch(Exception $ex)
	        {
	        	echo $ex->getMessage();
	        	log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
	        			$this->router->fetch_method().
	        			"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
	        }
	    }
	    function addDayswithdate($date,$days){
	    
	    	$date = strtotime("+".$days." days", strtotime($date));
	    	return  date("Y-m-d", $date);
	    
	    }
	    function update($data)
	    {
	    	try{
	    		$date=new DateTime();
	    	$arr=array();
	        $arr["userID"] = $data['userID'];
	        $arr["username"] = $data['username'];
	        $arr["ip"] = $data['ip'];
	        $arr["point"] = $data['point'];
	        $arr["accountStatus"] = $data['accountStatus'];
	        $arr["createDate"] = $data['createDate'];
	        $arr["usertype"]="PREMIUMPOSTEXPIRYDAYS";
	        $arr["lastLoginTime"]= $date->format('Y-m-d H:i:s');
	        $this->db->trans_start();
	      $result=   $this->db->update('user', $arr, array('userID' => $data['userID']));
	      $this->db->trans_complete();
	        if($result>0)
	        	return $result;
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
	
	}
?>