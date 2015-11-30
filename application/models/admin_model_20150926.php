<?php
class admin_model extends CI_Model {
		
		function __construct()
	    {
	        parent::__construct();
	    }
		function updateApprovePost($array)
		{
			try {
				foreach($array as $id=> $postID)
			{
				
			$data=array('status'=>'A');
			$this->db->where('postID', intval($postID));
			$result=$this->db->update('post', $data);
			 if($result<=0)
			 	throw new Exception(ZeroUpdateRecordError);
			}
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
				$this->router->fetch_method().
				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
			}
		}
		function updateRejectPost($array)
		{
			try {
			
if (is_array($array) || is_object($array))
{
			foreach($array as $detail)
			{
// 				print_r($detail);
// 				$data=array('status'=>'R', 'rejectReason'=>$detail['rejectReason'] ,'rejectSpecifiedReason' =>$detail['rejectSpecifiedReason'] );
// 				$this->db->where('postID', $detail['postID']);
// 				$result=$this->db->update('post', $data);
				$postID=$detail['postID'];
				$rejectReason=$detail['rejectReason'];
				$rejectSpecifiedReason=$detail['rejectSpecifiedReason'];
// 				foreach($detail as list($key, $value))
// 				{
// 					if($key=='postID')
// 						$postID=$value;
// 					else if($key=='rejectReason')
// 						$rejectReason=$value;
// 					else if($key=='rejectSpecifiedReason')
// 						$rejectSpecifiedReason=$value;
// 				}
				
				$data=array('status'=>'R', 'rejectReason'=>$rejectReason ,'rejectSpecifiedReason' =>$rejectSpecifiedReason );
				$this->db->where('postID', $postID);
				$result=$this->db->update('post', $data);
				if($result<=0)
					throw new Exception(ZeroUpdateRecordError);
					
			}
}
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
				$this->router->fetch_method().
				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
			}
		} 
}
?>