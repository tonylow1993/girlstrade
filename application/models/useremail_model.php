<?php 
	class useremail_model extends CI_Model{
	
	    var $userID = '';
	   	var $email = '';
	   	var $priority = '';
	   	var $status = '';
	   	var $createDate = '';
		
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function getUserEmailByUserID($userID)
	    {	
	    	$query = $this->db->from('useremail')->where('userID', $userID)->limit(1)->get();
	        return $query->first_row('array');
	    }
	    function getUserIDByEmail($email){
	    	$query = $this->db->from('useremail')->where('LOWER(email)', strtolower($email))->limit(1)->get();
	    	$var= $query->first_row('array');
	    	return $var['userID'];
	    }
	    function getUserEmailByEmail($email) {
	    	$query = $this->db->from('useremail')->where('LOWER(email)', strtolower($email))->limit(1)->get();
	    	return $query->first_row('array');
	    }
	    
	    function isEmailExist($email){
	    	$query = $this->db->from('useremail')->where('LOWER(email)', strtolower($email))->get();
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
	        $this->userID = $data['userID'];
		    $this->email = $data['email'];
		    $this->priority = $data['priority'];
		    $this->status = $data['status'];
	    	$this->db->set('createDate', ' NOW()', FALSE);
	    	$this->db->trans_start();
		    $this->db->insert('useremail', $this);
		   $this->db->trans_complete();
		    }catch(Exception $ex)
		    {
		    	echo $ex->getMessage();
		    	log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
		    			$this->router->fetch_method().
		    			"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
		    }
	    }
	
	    function update($data)
	    {
	    	try{
	        $this->userID = $data['userID'];
	        $this->email = $data['email'];
	        $this->priority = $data['priority'];
	        $this->status = $data['status'];
	        $this->createDate = $data['createDate'];
	        $this->db->trans_start();
	        $result= $this->db->update('useremail', $this, array('userID' => $data['userID']));
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
	
	}
?>