<?php
class contact_model extends CI_Model {
	
	    var $contactID = NULL;
	    var $name = NULL;
	    var $phone = NULL;
		var $email = '';
		var $contactTypeID = '';
		var $message = '';
		var $createDate='';
		var $updateDate='';
		var $status='';
	    function __construct()
	    {
	        parent::__construct();
	    }
		public function updateUnverifiedContact($array){
			$result=false;
			try {
				$this->db->trans_start();
				foreach($array as $commentID)
				{
		
					$data=array('status'=>'A', 'updateDate'=> date('Y-m-d h:i:s a', time()) );
					$this->db->where('contactID', intval($commentID));
					$result=$this->db->update('contactHistory', $data);
		
				}
				$this->db->trans_complete();
				return $result;
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
			}
			return $result;
		}
	    function addContactModel($data)
	    {	
	    	try{
			$this->db->trans_start();
			$result= $this->db->insert('contactHistory', $data);
			$this->db->trans_complete();
			if($result<=0)
				throw new Exception(ZeroUpdateRecordError);
			else
				return $result;
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
			log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
					$this->router->fetch_method().
					"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
		}
		return 0;
	    }
		
	    function getContactUnverifiedList ($pageNum)
	    {
	    	$ulimit=ITEMS_PER_PAGE;
		$olimit=0;
		if ($pageNum>1)
			$olimit=($pageNum-1)*ITEMS_PER_PAGE;
		
		$statusIn=array('U');
		$query = $this->db->from('contactHistory')->where_in('status', $statusIn)->limit($ulimit, $olimit)->get();
		$var=$query->result();
		return $var;
	    }
	    function getNoOfItemCountInContactUs(){
	    	$strQuery="select count(distinct contactID) as NoOfCount from contactHistory  where status in ('U')  ";
	    	$NoOfItemCount=0;
	    	$query2 = $this->db->query($strQuery);
	    	$var2=$query2->result_array();
	    	var_dump($var2);
	    	$NoOfItemCount=$var2[0]["NoOfCount"];
	    	
	    	return $NoOfItemCount;
	    }
}
?>