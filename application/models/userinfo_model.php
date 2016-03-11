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
		var $introduction='';
		var $showWeChatID='';
		var $weChatID='';
		var $showWebSite='';
		var $webSiteAddr='';
		
		
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
	    	$result['userID'] = $data['userID'];
	    	$result['lastName'] = $data['lastName'];
	    	$result['firstName'] = $data['firstName'];
// 	    	$this->gender = $data['gender'];
	    	$result['telNo'] = $data['telNo'];
	    	$result['hidetelno']=$data["hidetelno"];
	    	$result['lastModified'] = date("Y-m-d H:i:s");
	    	$result['checkBox1']=$data["checkBox1"];
	    	$result['checkBox2']=$data["checkBox2"];
	    	$result['introduction']=$data['introduction'];
	    	$result['showWeChatID']=$data['showWeChatID'];
	    	$result['weChatID']=$data['weChatID'];
	    	$result['showWebSite']=$data['showWebSite'];
	    	$result['webSiteAddr']=$data['webSiteAddr'];
	    	$this->db->trans_start();
	        $row= $this->db->update('userinfo', $result, array('userID' => $data['userID']));
	        $this->db->trans_complete();
	        if($row>0)
	        	return $row;
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
				$result['userID'] = $data['userID'];
 				$result['lastName'] = $data['lastName'];
 				$result['firstName'] = $data['firstName'];
				// 	    	$this->gender = $data['gender'];
 				$result['telNo'] = $data['telNo'];
 				$result['hidetelno']=$data["hidetelno"];
				$result['lastModified'] = date("Y-m-d H:i:s");
				$result['checkBox1']=true;
				$result['checkBox2']=true;
				$result['introduction']=$data['introduction'];
				$result['showWeChatID']=$data['showWeChatID'];
				$result['weChatID']=$data['weChatID'];
				$result['showWebSite']=$data['showWebSite'];
				$result['webSiteAddr']=$data['webSiteAddr'];
				//print_r($this);
				$this->db->trans_start();
				$row= $this->db->insert('userinfo', $result);
				$this->db->trans_complete();
				if($row>0)
					return $row;
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
	        		$result['userID'] = $data['userID'];
	        		$result['lastName'] = $data['lastName'];
	        		$result['firstName'] = $data['firstName'];
	        		// 		    $this->gender = $data['gender'];
	        		$result['telNo'] = $data['telNo'];
	        		$result['hidetelno']=$data("hidetelno");
	        		$result['introduction']=$data['introduction'];
	        		$result['checkBox1']=false;
	        		$result['checkBox2']=false;
	        		$result['showWeChatID']=$data['showWeChatID'];
	        		$result['weChatID']=$data['weChatID'];
	        		$result['showWebSite']=$data['showWebSite'];
	        		$result['webSiteAddr']=$data['webSiteAddr'];
	        
	        		$this->lastModified = date("Y-m-d H:i:s");
	        		$this->db->trans_start();
	        		$row= $this->db->insert('userinfo', $result);
	        		$this->db->trans_complete();
	        		if($row>0)
	        			return $row;
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
			$result['userID'] = $data['userID'];
	    	$result['lastName'] = $data['lastName'];
	    	$result['firstName'] = $data['firstName'];
// 	    	$this->gender = $data['gender'];
	    	$result['telNo'] = $data['telNo'];
	    	$result['hidetelno']=$data["hidetelno"];
	    	$result['lastModified'] = date("Y-m-d H:i:s");
			$result['checkBox1']=$data["checkBox1"];
			$result['checkBox2']=$data["checkBox2"];
			$result['introduction']=$data['introduction'];
			$result['showWeChatID']=$data['showWeChatID'];
			$result['weChatID']=$data['weChatID'];
			$result['showWebSite']=$data['showWebSite'];
			$result['webSiteAddr']=$data['webSiteAddr'];
			 
		   //print_r($this);
		   $this->db->trans_start();
			 $row= $this->db->update('userinfo', $result, array('userID' => $data['userID']));
			 $this->db->trans_complete();
			 if($row>0)
			 	return $row;
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
				$result['userID'] = $data['userID'];
// 				$this->lastName = $data['lastName'];
// 				$this->firstName = $data['firstName'];
				// 	    	$this->gender = $data['gender'];
// 				$this->telNo = $data['telNo'];
// 				$this->hidetelno=$data["hidetelno"];
				$result['lastModified'] = date("Y-m-d H:i:s");
				$result['checkBox1']=$data["checkBox1"];
				$result['checkBox2']=$data["checkBox2"];
				print_r($this);
				$this->db->trans_start();
				$row= $this->db->insert('userinfo', $result);
				$this->db->trans_complete();
				if($row>0)
					return $row;
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