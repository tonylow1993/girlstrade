<?php
class postviewhistory_model extends CI_Model {
		
		var $userID =''; 
		var $postID =''; 
		var $ip =''; 
		var $session_id='';
		var	$viewTime='';
		var $cookies_id='';					
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	   
		function insert($data)
	    {
	    	try {
	        
            $this->db->trans_start();
    		$var=$this->db->insert('postviewhistory', $data);
            $this->db->trans_complete();
    		
            if($var>0)
    		return true;
    		else 
					throw new Exception(ZeroUpdateRecordError);
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
				$this->router->fetch_method().
				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
			}
	    		
	    	return false;	    	
	    }
}