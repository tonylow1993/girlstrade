<?php
class blog_model extends CI_Model {

	var $ID;
	var $picPath1;
	var $picName1;
	var $picPath2;
	var $picName2;
	var $picPath3;
	var $picName3;
	var $title;
	var $description;
	var $createDate;
	
	function __construct()
	{
		parent::__construct();
	}
	function getBlog(){
			$query = $this->db->from('blog')->get();
			$var=$query->result();
			return $var;
	}
	function getBlogByID($ID){
		$this->db->where('ID', $ID);
		$query = $this->db->from('blog')->get();
		$var=$query->result();
		return $var;
	}
	function updateBlog($data)
	{
		try {
			$this->db->trans_start();
			$this->db->where('ID', 0);
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
	function insertBlog($data)
	{
		try {
			$this->db->trans_start();
			$var=$this->db->insert('blog', $data);
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
	function deleteBlogByID($ID){
		try {
			$this->db->trans_start();
			$var=$this->db->delete('blog', array("ID"=>$ID));
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