<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class updateAdmin extends CI_Controller {
     public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		
		$this->load->helper('url');
		$this->load->database();
		date_default_timezone_set("Asia/Hong_Kong");
		$this->load->model('admin_model');
		$this->load->model('post_model');
		$this->load->model("user_model");
	}
	
	
	public function index()
     {
     }
     
     function updateUserPhotoStatus(){
     	$data["lang_label"] = $this->nativesession->get("language");
     	try {
     		$Num=$this->input->post("NumRec");
     		echo $Num;
     		$approvelist;
     		$rejectlist;
     		$r=0;
     		$a=0;
     		if($Num>0)
     		{
     			for($i=1;$i<=$Num;$i++)
     			{
     				$userID=$this->input->post("userID".$i);
     				$status=$this->input->post("actionType".$i);
     				
     				if($status='A')
     				{
     					if($a==0)
     						$approvelist=$userID;
     					else
     						$approvelist=$approvelist+$userID;
     					$a=$a+1;
     				}
     				else if($status='R')
     				{
     					if($r==0)
     						$rejectlist=$userID;
     					else
     						$rejectlist=$rejectlist+$userID;
     					$r=$r+1;
     				}
     			}
     			
     			if($approvelist<>null)
     				$this->user_model->updateApprovePhoto($approvelist);
     			if($rejectlist<>null)
     				$this->user_model->updateRejectPhoto($rejectlist);
     		}
     	}catch(Exception $ex)
     	{
     		echo $ex->getMessage();
     
     	}
     	 
     	echo "success";
     }
     
     function updateAdmin(){
     	$data["lang_label"] = $this->nativesession->get("language");
    	try {
     	$Num=$this->input->post("NumRec");
     	echo $Num;
     	$approvelist;
     	$rejectlist;
     	$r=0;
     	$a=0;
     	if($Num>0)
     	{
     		for($i=1;$i<=$Num;$i++)
     		{
     			$postID=$this->input->post("postID".$i);
     			$status=$this->input->post("actionType".$i);
     			$rejectReason = $this->input->post("rejectReason".$i);
     			echo "Reject Reason: ";
     			$rejectSpecifiedReason = $this->input->post("rejectSpecifiedReason".$i);
     			echo $postID.": ".$status.",".$rejectReason.",".$rejectSpecifiedReason."<br/>";
     			
     			if($status='A')
     			{
     				if($a==0)
     					$approvelist=$postID;
     				else
     					$approvelist=$approvelist+$postID;
     				$a=$a+1;
     			}
     			else if($status='R')
     			{
     				$temp=array('postID'=>$postID ,'rejectReason'=> $rejectReason, 'rejectSpecifiedReason'=>$rejectSpecifiedReason);
     				if($r==0)
     					$rejectlist=$temp;
     				else
     					$rejectlist=$rejectlist+$temp;
     				$r=$r+1;
     			}
     		}
     		var_dump($rejectlist);
     			
	    	if($approvelist<>null)
	     		$this->admin_model->updateApprovePost($approvelist);
	     	if($rejectlist<>null)
	     		$this->admin_model->updateRejectPost($rejectlist);
	  	}
	  	}catch(Exception $ex)
    	{
    		echo $ex->getMessage();
    		
    	}
    	$this->post_model->updateStat();
    	 
    		echo "success";
     }
     
}
?>