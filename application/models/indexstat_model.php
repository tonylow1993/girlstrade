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
		$list= $query->result();
		if($list==null || sizeof($list)==0)
			$result=array("trustedseller"=>0, "facebookfans"=>0, "category"=>0,  "location"=>0);
		else 
			$result=array("trustedseller"=>$list[0]->trustedseller , "facebookfans"=>$list[0]->facebookfans, 
					"category"=>$list[0]->category,  "location"=>$list[0]->location);
			
			return $result;
		}
	
}