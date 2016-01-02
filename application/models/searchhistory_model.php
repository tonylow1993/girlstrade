<?php
class searchhistory_model extends CI_Model {
var $userID ='';
var $keyword ='';
var $catID ='';
var	$locID='';
var $ip='';
var $session_id='';
var $viewtime='';
var $minPrice=0;
var $maxPrice=0;
var $cookies_id='';
function __construct()
{
	parent::__construct();
}
 
function insert($data)
{
	try {
		 
		$this->db->trans_start();
		$var=$this->db->insert('searchhistory', $data);
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
?>
