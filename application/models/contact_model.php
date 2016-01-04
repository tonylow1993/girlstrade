<?php
class contact_model extends CI_Model {
	
	    var $contactID = NULL;
	    var $name = NULL;
	    var $phone = NULL;
		var $email = '';
		var $contactTypeID = '';
		var $message = '';
		var $createDate='';

	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function addContactModel($data)
	    {	
	    	try{
			$this->db->trans_start();
			$result= $this->db->insert('contactHistory', $data);
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