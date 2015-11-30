<?php
class location_model extends CI_Model {
	
	    var $locationID = NULL;
	    var $parentID = NULL;
	    var $level = NULL;
		var $name = '';
		var $nameCN = '';
		var $postCount=0;
		var $viewCount=0;
	    function __construct()
	    {
	        parent::__construct();
	    }
	    function getLocationCount()
	    {
	    	return 0;	
	    }
	    function getParentLocation()
	    {	
	    	$query = $this->db->from('location')->where('parentID', NULL)->get();
	        return $query->result();
	    }
		function getChildLocation($parentID)
	    {	
	    	$query = $this->db->from('location')->where('parentID', $parentID)->get();
	        return $query->result();
	    }
	    
	    function getPopularLocation($first, $second)
	    {
	    	$this->db->limit($first, $second);
	    	$query = $this->db->from('location')->where('parentID IS NOT NULL', null)->order_by('postCount', 'desc')->get();
	        return $query->result();
	    }
	    
}

?>