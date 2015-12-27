<?php

    class tag_model extends CI_Model {

        var $sequence = '';
        var $postID = '';
        var $tag = '';
        var $createDate = '';

        function insert($data)
	{
		try{
            $this->db->trans_start();
            $this->db->insert('tag',$data);
            $this->db->trans_complete();
                  }catch(Exception $ex)
            {
            	echo $ex->getMessage();
            	log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
            			$this->router->fetch_method().
            			"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
            }
        }
       
        function getTagByPostID($postID){
        	
        		$query = $this->db->from('tag')->where('postID', $postID)->get();
        		return $query->result();
        	
        }
        
    }
?>

