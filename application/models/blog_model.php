<?php
class blog_model extends CI_Model {

	var $ID;
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	function updateBlog($data)
	{
		try {
			$this->db->trans_start();
			$this->db->where('ID', 1);
			$var=$this->db->update('blog', $data);
			$this->db->trans_complete();
			if($var>0)
				return $var;
			else 
				throw new Exception(ZeroUpdateRecordError);
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