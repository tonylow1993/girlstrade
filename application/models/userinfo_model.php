<?php 
	class userinfo_model extends CI_Model{
	
	    var $userID = '';
	    var $lastName = '';
	    var $firstName = '';
// 	    var $gender = '';
	    var $country = '';
	    var $language = '';
	    var $phoneNo = '';
	    var $telNo = '';
// 	    var $profilePicID = '';
// 	    var $signature = '';
// 	    var $documentID = '';
// 	    var $documentType = '';
	    var $lastModified = '';
		var $hidetelno='';
		var $checkBox1='';
		var $checkBox2='';
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function getUserInfoByUserID($userID)
	    {	
	    	$query = $this->db->from('userinfo')->where('userID', $userID)->limit(1)->get();
	        return $query->first_row('array');
	    }
	 
	    function update($data)
	    {
	    	try{
	    	$this->userID = $data['userID'];
	    	$this->lastName = $data['lastName'];
	    	$this->firstName = $data['firstName'];
// 	    	$this->gender = $data['gender'];
	    	$this->telNo = $data['telNo'];
	    	$this->hidetelno=$data["hidetelno"];
	    	$this->lastModified = date("Y-m-d H:i:s");
	    	$this->checkBox1=$data["checkBox1"];
	    	$this->checkBox2=$data["checkBox2"];
	    	$this->db->trans_start();
	        $result= $this->db->update('userinfo', $this, array('userID' => $data['userID']));
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
	        return -1;
	        }
	function insert($data)
		{
			try{
				$this->userID = $data['userID'];
 				$this->lastName = $data['lastName'];
 				$this->firstName = $data['firstName'];
				// 	    	$this->gender = $data['gender'];
 				$this->telNo = $data['telNo'];
 				$this->hidetelno=$data["hidetelno"];
				$this->lastModified = date("Y-m-d H:i:s");
				$this->checkBox1=true;
				$this->checkBox2=true;
				print_r($this);
				$this->db->trans_start();
				$result= $this->db->insert('userinfo', $this);
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
			return -1;
		}

	        function insertUserInfo($data)
	        {
	        	try{
	        		$this->userID = $data['userID'];
	        		$this->lastName = $data['lastName'];
	        		$this->firstName = $data['firstName'];
	        		// 		    $this->gender = $data['gender'];
	        		$this->telNo = $data['telNo'];
	        		$this->hidetelno=$data("hidetelno");
	        		$this->checkBox1=false;
	        		$this->checkBox2=false;
	        
	        
	        		$this->lastModified = date("Y-m-d H:i:s");
	        		$this->db->trans_start();
	        		$result= $this->db->insert('userinfo', $this);
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
	        	return  0;
	        }
	        
		function updateCheckBox($data)
		{
			try{
			$this->userID = $data['userID'];
	    	$this->lastName = $data['lastName'];
	    	$this->firstName = $data['firstName'];
// 	    	$this->gender = $data['gender'];
	    	$this->telNo = $data['telNo'];
	    	$this->hidetelno=$data["hidetelno"];
	    	$this->lastModified = date("Y-m-d H:i:s");
			$this->checkBox1=$data["checkBox1"];
			$this->checkBox2=$data["checkBox2"];
		   print_r($this);
		   $this->db->trans_start();
			 $result= $this->db->update('userinfo', $this, array('userID' => $data['userID']));
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
	        return -1;
		}
		function insertCheckBox($data)
		{
			try{
				$this->userID = $data['userID'];
// 				$this->lastName = $data['lastName'];
// 				$this->firstName = $data['firstName'];
				// 	    	$this->gender = $data['gender'];
// 				$this->telNo = $data['telNo'];
// 				$this->hidetelno=$data["hidetelno"];
				$this->lastModified = date("Y-m-d H:i:s");
				$this->checkBox1=$data["checkBox1"];
				$this->checkBox2=$data["checkBox2"];
				print_r($this);
				$this->db->trans_start();
				$result= $this->db->insert('userinfo', $this);
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
			return -1;
		}
}
?>