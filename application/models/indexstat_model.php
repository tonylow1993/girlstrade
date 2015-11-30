<?php
class indexstat_model extends CI_Model {

	var $trustedseller=''; 
	var $facebookfans =''; 
	var $category =''; 
	var $location=''; 

	function __construct()
	{
		parent::__construct();
	}
	function getIndexStat(){
		$query = $this->db->from('indexstat')->get();
		return $query->result();
	}
}