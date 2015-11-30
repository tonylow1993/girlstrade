<?php
class category_model extends CI_Model {
	
	    var $categoryID = NULL;
	    var $parentID = NULL;
	    var $level = NULL;
		var $name = '';
		var $nameCH = '';
		var $postCount=0;
		var $iconImage='';
		var $viewCount=0;
		var $childCount=0;
	    function __construct()
	    {
	        parent::__construct();
	    }
	    function getCategoriesCount()
	    {
	    	return 0;
	    }
	    function getParentCategory()
	    {	
	    	$query = $this->db->from('category')->where('parentID', NULL)->get();
	        return $query->result();
	    }
		function getChildCategory($parentID)
	    {	
	    	$query = $this->db->from('category')->where('parentID', $parentID)->get();
	        return $query->result();
	    }
	    
	    function getPopularParentCategory()
	    {
 	    	$this->db->limit(6,0);
	    	$query = $this->db->from('category')->where('parentID', NULL)->order_by('postCount', 'desc')->get();
	        return $query->result();
	    }
	    function getPopularCategory($first, $second)
	    {
	    	$this->db->limit($first, $second);
	    	$this->db->order_by('postCount', 'DESC');
	    	$this->db->where('parentID IS NOT NULL', null);
	    	$query = $this->db->get('category');
	        return $query->result();
	    }
}
?>