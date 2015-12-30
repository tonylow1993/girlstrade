<?php 
	class userpassword_model extends CI_Model{
	
	    var $userID = '';
	    var $sequence = '';
		var $password = '';
		var $createDate = '';
		var $expriyDate = '';
		var $status = '';
		
	    function __construct()
	    {
	        parent::__construct();
	        $this->load->helper('security');
	    }
	    function getUserPasswordByUserID($userID){
	    	$query = $this->db->from('userpassword')->where('userID', $userID)->limit(1)->get();
	    	return $query->first_row('array');
	    }
	    function addDayswithdate($date,$days){
	    
	    	$date = strtotime("+".$days." days", strtotime($date));
	    	return  date("Y-m-d", $date);
	    
	    }
	    function insert($data)
	    {
	    	log_message('debug', 'before inserting userPassword');
	        $this->userID = $data['userID'];
	        $this->sequence = 1;// need to create a method to get last sequence
	        $this->password = do_hash($data['password']);
	        $this->createDate = date("Y-m-d H:i:s");
	        $this->expriyDate = $this->addDayswithdate(date("Y-m-d H:i:s"), PASSWORDEXPIRYDAYS); //current date + 90 days
	        $this->status = $data["status"];
	        $this->db->trans_start();
	        $this->db->insert('userpassword', $this);
	        $this->db->trans_complete();
	    }
	    function changePassword($data){
	    	try{
	    	$updateData=array('password'=> do_hash($data['password']));
	    	$this->db->where('userID',$data['userID']);
	    	$this->db->trans_start();
	    	$this->db->update('userpassword', $updateData);
	    	$this->db->trans_complete();
	    	}catch(Exception $ex){
	    		echo $ex->getMessage();
	    	}
	    }
	function isValidPassword($data){
	    	$userID = $data['userID'];
	    	$password = do_hash($data['password']);
	    	$query = $this->db->from('userpassword')->where('userID', $userID)->where('password', $password)->get()->result();
	    	if(is_array($query))
	    	{
	    		$count=0;
		    	foreach($query as $row){
		    		$count=$count+1;
		    	}
		    	
		    	if($count>0)
		    		return true;
		    	else
		    		return false;
		    	
	    	}
	    	else
	    		return true;
	    		
	    }
	
	    function update($data)
	    {
	        $this->userID = $data['userID'];
	        $this->password = do_hash($data['password']);
	        //$this->sequence = $data['sequence'];
	        $this->createDate = '2015-05-17';
	        $this->expriyDate = '2015-08-17';//current date + 90 days
	        $this->status = 'U';
	        $this->db->trans_start();
	        $this->db->update('userpassword', $this, array('userID' => $data['userID']));
	        $this->db->trans_complete();
	    }
	
	}
?>