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
	    
	    function addContactModel()
	    {	
	    	$query = $this->db->from('category')->where('parentID', NULL)->get();
	        return $query->result();
	    }
		
}
?>