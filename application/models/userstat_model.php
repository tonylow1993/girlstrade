<?php
class userstat_model extends CI_Model {

	var $userID='';
	var $inboxMsgCount='';
	var $approveMsgCount='';
	var $myAdsCount='';
	var $savedAdsCount='';
	var $pendingMsgCount='';
	var $archivedAdsCount='';
	var $visitCount='';
	var $totalMyAdsCount='';
	var $favoriteAdsCount='';
	var $outgoingMsgCount='';
	var $buyAdsCount=0;
	var $directsendhistCount=0;
	function __construct()
	{
		parent::__construct();
	}

	function getUserStat($userID){
		$query = $this->db->from('userstat')->where('userID', $userID)->get();
		return $query->result();
	}
}
