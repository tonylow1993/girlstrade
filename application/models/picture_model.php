<?php 
	class picture_model extends CI_Model {
	
	    var $sequence = '';
	    var $postID = '';
	    var $userID = '';
            var $picturePath = '';
            var $pictureName = '';
            var $status = '';
            var $thumbnailPath = '';
            var $thumbnailName = '';
            var $createDate = '';
            
            
	    function __construct()
	    {
	        parent::__construct();
	    }
	    
	    function get_picture_by_postID($postID)
	    {	
	    	$query = $this->db->from('picture')->where('postID', $postID)->limit(1)->get();
	    	
	        return $query->result();
	    }
	   
	    function insert($data)
	    {
	        //$this->sequence = $data['username'];
	        //$this->postID = $data['postID'];
	        try{
	        $this->postID = $data['postID'];
	        $this->userID = $data['userID'];
	        $this->picturePath = $data['picturePath'];
                $this->pictureName = $data['pictureName'];
                $this->status = $data['status'];
                $this->thumbnailPath = $data['thumbnailPath'];
                $this->thumbnailName = $data['thumbnailName'];
	        $this->createDate = date("Y-m-d H:i:s");
	        $this->db->trans_start();
               $this->db->insert('picture', $this);
               $this->db->trans_complete();
	        }
	    	catch (Exception $ex) {
	    		echo 'Caught exception: ',  $ex->getMessage(), "\n";
	    		log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
	    				$this->router->fetch_method().
	    				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
	    		return 0;
	    	}
	    }
	}
?>