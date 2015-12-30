<?php 
	class user_model extends CI_Model {
	
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
	    
	    function getUserByUserID($userID)
	    {	
	    	$query = $this->db->from('user')->where('userID', $userID)->limit(1)->get();
	        return $query->first_row('array');
	    }
	    
// 	    function get_user_by_name($username){
// 	    	$query = $this->db->from('user')->where('username', $username)->limit(1)->get();
// 	    	return $query->result();
// 	    }
	    
		function getUserByUsername($username){
	    	$query = $this->db->from('user')->where('LOWER(username)', strtolower($username))->limit(1)->get();
	    	return $query->first_row('array');
	    }
	    
	    function getUnverifyUserPhoto(){
	    	$whereSQL=array("photoStatus"=>'U');
	    	$query = $this->db->from('user')->where($whereSQL)->get();
	    	return $query->result();
	    }
	  //function get_user_by_name($username){
	   // 	$query = $this->db->from('user')->where('username', $username)->limit(1)->get();
	   // 	return $query->result();
	   // }
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
	    		$user=array();
	        $user["username"] = $data['username'];
	        $user["ip"]  = $data['ip'];
	        $user["point"]  = $data['point'];
	        $user["accountStatus"]  = $data['accountStatus'];
	        $user["createDate"]  = date("Y-m-d H:i:s");
	        $user["usertype"] ="PREMIUMPOSTEXPIRYDAYS";
	        $date=new DateTime();
	        $user["lastLoginTime"] = $date->format('Y-m-d H:i:s');
	        $this->db->trans_start();
			$this->db->insert('user', $user);
			$this->db->trans_complete();
			
	        $this->db->select_max('userID');
     		$result= $this->db->get('user')->result_array();
     		   		
    		return $result[0]['userID'];
    	
    		}catch(Exception $ex)
    		{
    			echo $ex->getMessage();
    			log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
    					$this->router->fetch_method().
    					"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
    		}
    		return 0;
	    }
	
	    function update($data)
	    {
	    	try{
				$arr=array();
	        $arr["userID"] = $data['userID'];
	        $arr["username"] = $data['username'];
	        $arr["ip"] = $data['ip'];
	        $arr["point"] = $data['point'];
	        $arr["accountStatus"] = $data['accountStatus'];
	        $arr["createDate"] = $data['createDate'];
	        $arr["usertype"]="PREMIUMPOSTEXPIRYDAYS";
	        $date=new DateTime();
	        $arr["lastLoginTime"]= $date->format('Y-m-d H:i:s');
	        $this->db->trans_start();
	        $result= $this->db->update('user', $arr, array('userID' => $data['userID']));
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
	    function updateRejectPhoto($array){
		try {

			
				if (is_array($array) || is_object($array))
				{
					$this->db->trans_start();
							foreach($array as $detail)
							{
								$userID=$detail['userID'];
								$rejectReason=$detail['rejectReason'];
								$rejectSpecifiedReason=$detail['rejectSpecifiedReason'];

								
								$data=array('photostatus'=>'R', 'rejectReason'=>$rejectReason ,'rejectSpecifiedReason' =>$rejectSpecifiedReason );
								$this->db->where('userID' , $userID);
								$result=$this->db->update('user', $data);
									
									
							}
							$this->db->trans_complete();
				}
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				return;
			}
	    	 
	    }
	    function updateApprovePhoto($array){
	    	
	    	$this->db->trans_start();
	    		foreach($array as $id=> $userID)
	    		{
	    			try{
	    			
	    			$data=array('photostatus'=>'A');
	    			$this->db->where('userID', intval($userID));
	    			$result= $this->db->update('user', $data);
	    			}catch(Exception $ex)
	    			{
	    				echo $ex->getMessage();
	    				log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
	    						$this->router->fetch_method().
	    						"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
	    			}
	    	}
	    	$this->db->trans_complete();
	    
	    }
	    function updatePhoto($data){
	    	try{
	    		$this->db->trans_start();
	    		$result= $this->db->update('user', $data, array('userID' => $data['userID']));
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
	    
	    function getUserList(){
	    	$query = $this->db->from('user')->order_by("username", "asc")->get();
	    	return $query->result();
	    }
	    
	    function getUserArrayList(){
	    	$query = $this->db->from('user')->order_by("username", "asc")->get();
	    	$itemList=array();
	   		 if ($query -> result()) {
                    foreach ($query->result() as $country) {
                            $itemList[$country -> userID] = $country -> username;
                    }
	   		 }
	    	return $itemList;
	    }
	}
?>