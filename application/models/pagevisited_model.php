<?php

class pagevisited_model extends CI_Model {

		var $userID;
		var $ip;
		var $session_id;
		var $cookies_id;
		var $visit_time;
		var $page_visit;
		
	function __construct()
	{
		parent::__construct();
	}
	function insert($data)
	{
		try {

			$this->db->trans_start();
			$var=$this->db->insert('pagevisited', $data);
			$this->db->trans_complete();

			if($var>0)
				return true;
			else
				throw new Exception(ZeroUpdateRecordError);

		}catch (Exception $ex) {
			echo 'Caught exception: ',  $ex->getMessage(), "\n";
			log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
					$this->router->fetch_method().
					"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());

			return false;
		}
			
		return false;
			
	}
	
}


