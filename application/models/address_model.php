<?php 
	class address_model extends CI_Model {
		
		var $sequence = '';
	    var $userID = '';
	    var $country = '';
	    var $area = '';
	    var $district = '';
	    var $street = '';
	    var $building = '';
	    var $roomNo = '';
	    var $postalCode = '';
	    var $createDate = '';
	    var $default = '';
		
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function getAddressByUserID($userID)
	    {	
	    	try{
	    	$query = $this->db->from('address')->where('userID', $userID)->limit(1)->get();
	        return $query->first_row('array');
	    	}catch(Exception $ex){
	    		log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
	    				$this->router->fetch_method().
	    				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
	    		return null;
	    		
	    	}
	    }
	   
	    function insert($data)
	    {
	    	try{
	    	$this->userID = $data['userID'];
	    	$this->country = $data['country'];
// 	    	$this->area = $data['area'];
// 	    	$this->district = $data['district'];
// 	    	$this->street = $data['street'];
// 	    	$this->building = $data['building'];
// 	    	$this->roomNo = $data['roomNo'];
// 	    	$this->postalCode = $data['postalCode'];
	    	$this->createDate = $data['createDate'];
	    	$this->default = $data['default'];
	    	$this->db->trans_start();
	    	$result = $this->db->insert('address', $this);
	    	$this->db->trans_complete();
	    	return $result;
	    	}catch(Exception $ex){
	    		log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
	    				$this->router->fetch_method().
	    				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
	    		return 0;
	    	}
	    }
	    	
	
	    function update($data)
	    {
	    	try{
	    	$this->sequence = $data['sequence'];
	        $this->userID = $data['userID'];
	        $this->country = $data['country'];
	        $this->area = $data['area'];
	        $this->district = $data['district'];
	        $this->street = $data['street'];
	        $this->building = $data['building'];
	        $this->roomNo = $data['roomNo'];
	        $this->postalCode = $data['postalCode'];
	        $this->createDate = $data['createDate'];
	        $this->default = $data['default'];
	        $this->db->trans_start();
	        $result= $this->db->update('address', $this, array('userID' => $data['userID'], 'sequence' => $data['sequence']));
	        $this->db->trans_complete();
	        return $result;
	    	}catch(Exception $ex){
	    		log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
	    				$this->router->fetch_method().
	    				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
	    		return 0;
	    	}
	    }
	
	}
?>