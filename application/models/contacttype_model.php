<?php
class contacttype_model extends CI_Model {
	
	    var $contactTypeID = '';
	    var $name = '';
	    var $nameCH = '';
		var $value = '';

	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function getContactType()
	    {	
	    	$query = $this->db->from('contactType')->get();
	        return $query->result();
	    }
	    
	    function getContactTypeByID($ID)
	    {
	    	$query = $this->db->from('contactType')->where('contactTypeID' , $ID)->get();
	    	return $query->result();
	    }
		
}
?>