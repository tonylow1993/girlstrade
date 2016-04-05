<?php
class admin_model extends CI_Model {
		
		function __construct()
	    {
	        parent::__construct();
	    }
		function updateApprovePost($array)
		{
			try {
				$this->db->trans_start();
				foreach($array as $id=> $postID)
			{
				
			$data=array('status'=>'A');
			$this->db->where('postID', intval($postID));
			$result=$this->db->update('post', $data);
			 
			}
			$this->db->trans_complete();
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				return;
			}
		}
		function updateRejectPost($array)
		{
			try {
// 			foreach($array as $id=> $postID)
// 			{
				
// 					$data=array('status'=>'R');
// 					$this->db->where('postID', intval($postID));
// 					$result=$this->db->update('post', $data);
				
				 
// 			}
			
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
				$this->db->trans_start();
				$result=$this->db->update('post', $data);
				$this->db->trans_complete();
					
			}
}
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				return;
			}
		} 
		function updateStat(){
			try{
				$deleteStr="DELETE FROM userstat";
		
								
					$str="INSERT INTO userstat ";
				$str=$str." SELECT userID, SUM(inboxMsgCount), SUM(approveMsgCount), SUM(myAdsCount),"; 
				$str=$str." SUM(savedAdsCount), SUM(pendingMsgCount), SUM(archivedAdsCount), ";
				$str=$str." SUM(visitCount), SUM(adsCount), SUM(favoriteAdsCount),";
				$str=$str." SUM(outGoingMsgCount), SUM(BuyAdsCount), SUM(directsendhistCount), SUM(directsendhistCountAsSeller) ";
				$str=$str." FROM ( ";
				$str=$str." SELECT userID, COUNT(*) AS inboxMsgCount, 0 AS approveMsgCount,0  AS myAdsCount, ";
				$str=$str." 0  AS savedAdsCount,0 AS pendingMsgCount,0 AS archivedAdsCount,0 AS visitCount,";
				$str=$str." 0 AS adsCount,0 AS favoriteAdsCount , 0 as outGoingMsgCount,";
				$str=$str." 0 as BuyAdsCount, 0 as directsendhistCount, 0 as directsendhistCountAsSeller ";
				$str=$str." FROM buyermessage ";
				//$str=$str." WHERE STATUS='A' "; //Op' or status='OC' ";
				$str=$str." GROUP BY userID ";
				//$str=$str." Union all";
				//$str=$str." select fUserID as userID, count(*), 0, 0,0,0,0,0,0,0 ,0,0 ,0,0";
				//$str=$str." from message where status='R' ";
				//$str=$str." group by fUserID";
				//$str=$str." Union all";
				//$str=$str." select userID as userID, count(*), 0, 0,0,0,0,0,0,0 ,0,0 ,0,0";
				//$str=$str." from message where status='C' ";
				//$str=$str." group by userID";
				$str=$str." UNION ALL ";
				$str=$str." SELECT b.userID, 0, COUNT(*) AS approveMsgCount, 0,0,0,0,0,0,0,0,0,0,0 ";
				$str=$str." FROM requestpost a INNER JOIN post b ";
				$str=$str." ON a.postID=b.postID ";
				$str=$str." WHERE a.status='U' ";
				$str=$str." GROUP BY b.userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,COUNT(*) AS myAdsCount, 0,0,0,0,0,0 ,0,0,0,0";
				$str=$str." FROM post ";
				$str=$str." where status='A' or status='R' or status='U' ";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID,0,0,0, COUNT(*) AS savedAdsCount,0,0,0,0,0 ,0,0,0,0";
				$str=$str." FROM savedAds ";
				$str=$str." WHERE STATUS='U' ";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID,0,0,0,0, COUNT(*) AS pendingMsgCount,0,0,0,0,0,0,0,0"; 
				$str=$str." FROM requestpost ";
				$str=$str." WHERE STATUS='U' ";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,0, 0,0,COUNT(*) AS archivedAdsCount,0,0,0 ,0,0,0,0";
				$str=$str." FROM post ";
				$str=$str." where status = 'C' ";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT a.userID, 0,0,0, 0,0,0,COUNT(*) AS visitCount,0,0 ,0,0,0,0";
				$str=$str." FROM post a INNER JOIN postviewhistory b ";
				$str=$str." ON a.postID = b.postID ";
				$str=$str." GROUP BY a.userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,0, 0,0,0,0,COUNT(*) AS adsCount,0 ,0,0,0,0";
				$str=$str." FROM post ";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,0, 0,0,0,0,0,COUNT(*) AS favoriteAdsCount ,0,0,0,0";
				$str=$str." FROM post ";
				$str=$str." WHERE typeAds='featuredAds' ";
				$str=$str." GROUP BY userID ";
				$str=$str." Union all";
				$str=$str." select fromUserID as userID, 0,0,0, 0,0,0,0,0,0,count(*),0,0,0";
				$str=$str." from buyermessage ";
				//where status='A' "; // (status='C') ";
				$str=$str." group by fromUserID";
				//$str=$str." Union all";
				//$str=$str." select userID, 0,0,0, 0,0,0,0,0,0,count(*),0,0,0";
				//$str=$str." from message where (status='R') ";
				//$str=$str." group by userID";
				//$str=$str." Union all";
				//$str=$str." select fuserID as userID, 0,0,0, 0,0,0,0,0,0,count(*),0,0,0";
				//$str=$str." from message where status='OC' or status='Op' ";
				//$str=$str." group by fuserID";
				$str=$str." Union all";
				$str=$str." select soldToUserID as userID, 0,0,0, 0,0,0,0,0,0,0,count(*),0,0";
				$str=$str." from tradecomments";
				$str=$str." where soldToUserID !=0";
				$str=$str." group by soldToUserID";
				$str=$str." Union all";
				$str=$str." select userID, 0,0,0, 0,0,0,0,0,0,0,0,count(*),0";
				$str=$str." from requestpost";
				$str=$str." where status in ('A', 'R')";
				$str=$str." group by userID";
				$str=$str." Union all";
				$str=$str." select b.userID, 0,0,0, 0,0,0,0,0,0,0,0,0,count(*)";
				$str=$str." from requestpost a inner join post b on a.postID=b.postID ";
				$str=$str." where a.status in ('A', 'R')";
				$str=$str." group by b.userID";
				$str=$str." ) total group by userID";
				
				$Str1a="update location set postCount=0;";
				$Str2a="update category set postCount=0;";
				$Str1="UPDATE location a INNER JOIN ( SELECT locID, COUNT(*) AS NoOfCount FROM post where status='A' GROUP BY locID ) b ON a.locationID = b.locID ";
					$Str1=$Str1."SET a.postCount = b.NoOfCount ";
					$Str2="UPDATE category a INNER JOIN (SELECT catID, COUNT(*) AS NoOfCount FROM post where status='A' GROUP BY catID) b  ON a.categoryID = b.catID ";
					$Str2=$Str2."SET a.postCount = b.NoOfCount ";
					
					$Str3a="UPDATE location a INNER JOIN ( SELECT parentID, SUM(postCount) AS NoOfCount FROM location ";
					$Str3a=$Str3a."WHERE parentID IS NOT NULL and level=3 GROUP BY parentID ) b ON a.locationID = b.parentID ";
					$Str3a=$Str3a." SET a.postCount = b.NoOfCount + a.postCount";
					
					
					$Str3="UPDATE location a INNER JOIN ( SELECT parentID, SUM(postCount) AS NoOfCount FROM location ";
					$Str3=$Str3."WHERE parentID IS NOT NULL and level=2 GROUP BY parentID ) b ON a.locationID = b.parentID ";
					$Str3=$Str3."  SET a.postCount = b.NoOfCount + a.postCount";
					$Str4="UPDATE category a INNER JOIN (SELECT parentID, SUM(postCount) AS NoOfCount FROM category ";
					$Str4=$Str4."WHERE parentID IS NOT NULL GROUP BY parentID ) b  ON a.categoryID = b.parentID ";
					$Str4=$Str4."SET a.postCount = b.NoOfCount + a.postCount";
				$Str5="update category set childCount = 0;";
				$Str6="update category a inner join ( ";
				$Str6=$Str6." select parentID, count(*) as NoOfCount";
				$Str6=$Str6." 		from category where parentID is not null";
				$Str6=$Str6." 		group by parentID ) b on a.categoryID=b.parentID";
				$Str6=$Str6." 		set a.childCount=b.NoOfCount;";
				

				$str7="update category a inner join ( ";
				$str7=$str7."	SELECT catID, count(*) as NoOfCount FROM searchhistory";
				$str7=$str7."		where catID!=0 group by catID ) b";
				$str7=$str7."		on a.categoryID=b.catID";
				$str7=$str7."		set a.searchCount=b.NoOfCount;";
					
				$str8a="update post set viewCount=0;";
				$str8=" update post a inner join (";
				$str8=$str8." 		select postID, count(*) as NoOfCount";
				$str8=$str8." 		from postviewhistory group by postID ) b";
				$str8=$str8." 		on a.postID=b.postID";
				$str8=$str8." 		set a.viewCount=b.NoOfCount;";
					
				$str9a="update category set viewCount=0;";
				$str9="  update category a inner join (";
				$str9=$str9."  	select b.catID, count(*) as NoOfCount";
				$str9=$str9."  	from postviewhistory a inner join post b";
				$str9=$str9."  	on a.postID=b.postID group by b.catID ) b";
				$str9=$str9."  	on a.categoryID=b.catID";
				$str9=$str9."  		set a.viewCount=b.NoOfCount;";
					
				$str10a="delete from interestedproduct;";
				$str10="  insert into interestedproduct (postID, viewCount, cookies_id)";
				$str10=$str10."  select postID, NoOfCount, cookies_id from (";
				$str10=$str10."  		select postID, count(*) as NoOfCount, cookies_id";
				$str10=$str10."  	from postviewhistory group by postID, cookies_id ) a";
				//$str10=$str10."  	order by a.NoOfCount desc limit 6;";
				
				$str11="  insert into interestedproduct (postID, viewCount)";
				$str11=$str11."  select postID, NoOfCount from (";
				$str11=$str11."  		select postID, count(*) as NoOfCount";
				$str11=$str11."  	from postviewhistory group by postID) a";
				$str11=$str11."  	order by a.NoOfCount desc limit 6;";
				
				$this->db->trans_start();
				$this->db->query($deleteStr);
				$this->db->query($str);
				$this->db->query($Str1a);
				$this->db->query($Str2a);
				
				$this->db->query($Str1);
				$this->db->query($Str2);
				$this->db->query($Str3a);
				$this->db->query($Str3);
				$this->db->query($Str4);
				$this->db->query($Str5);
				$this->db->query($Str6);
				$this->db->query($str7);
				$this->db->query($str8a);
				$this->db->query($str8);
				$this->db->query($str9a);
				$this->db->query($str9);
				$this->db->query($str10a);
				$this->db->query($str10);
				$this->db->query($str11);
				$this->db->trans_complete();
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				return;
			}
		}
		
		function updateStatByUserID($userId){
			try{
				$deleteStr="DELETE FROM userstat where userID=$userId";
			
			
				$str="INSERT INTO userstat ";
				$str=$str." SELECT userID, SUM(inboxMsgCount), SUM(approveMsgCount), SUM(myAdsCount),";
				$str=$str." SUM(savedAdsCount), SUM(pendingMsgCount), SUM(archivedAdsCount), ";
				$str=$str." SUM(visitCount), SUM(adsCount), SUM(favoriteAdsCount),";
				$str=$str." SUM(outGoingMsgCount), SUM(BuyAdsCount), SUM(directsendhistCount), SUM(directsendhistCountAsSeller) ";
				$str=$str." FROM ( ";
				$str=$str." SELECT userID, COUNT(*) AS inboxMsgCount, 0 AS approveMsgCount,0  AS myAdsCount, ";
				$str=$str." 0  AS savedAdsCount,0 AS pendingMsgCount,0 AS archivedAdsCount,0 AS visitCount,";
				$str=$str." 0 AS adsCount,0 AS favoriteAdsCount , 0 as outGoingMsgCount,";
				$str=$str." 0 as BuyAdsCount, 0 as directsendhistCount, 0 as directsendhistCountAsSeller ";
				$str=$str." FROM buyermessage ";
				$str=$str." where userID=$userId ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT b.userID, 0, COUNT(*) AS approveMsgCount, 0,0,0,0,0,0,0,0,0,0,0 ";
				$str=$str." FROM requestpost a INNER JOIN post b ";
				$str=$str." ON a.postID=b.postID ";
				$str=$str." WHERE a.status='U' ";
				$str=$str." and b.userID=$userId ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,COUNT(*) AS myAdsCount, 0,0,0,0,0,0 ,0,0,0,0";
				$str=$str." FROM post ";
				$str=$str." where (status='A' or status='R' or status='U') ";
				$str=$str." and userID=$userId ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID,0,0,0, COUNT(*) AS savedAdsCount,0,0,0,0,0 ,0,0,0,0";
				$str=$str." FROM savedAds ";
				$str=$str." WHERE STATUS='U' ";
				$str=$str." and userID =$userId ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID,0,0,0,0, COUNT(*) AS pendingMsgCount,0,0,0,0,0,0,0,0";
				$str=$str." FROM requestpost ";
				$str=$str." WHERE STATUS='U' ";
				$str=$str." and userID =$userId ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,0, 0,0,COUNT(*) AS archivedAdsCount,0,0,0 ,0,0,0,0";
				$str=$str." FROM post ";
				$str=$str." where status = 'C' ";
				$str=$str." and userID=$userId ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT a.userID, 0,0,0, 0,0,0,COUNT(*) AS visitCount,0,0 ,0,0,0,0";
				$str=$str." FROM post a INNER JOIN postviewhistory b ";
				$str=$str." ON a.postID = b.postID ";
				$str=$str." where a.userID=$userId ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,0, 0,0,0,0,COUNT(*) AS adsCount,0 ,0,0,0,0";
				$str=$str." FROM post ";
				$str=$str." where userID=$userId ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,0, 0,0,0,0,0,COUNT(*) AS favoriteAdsCount ,0,0,0,0";
				$str=$str." FROM post ";
				$str=$str." WHERE typeAds='featuredAds' ";
				$str=$str." and userID=$userId ";
				$str=$str." Union all";
				$str=$str." select fromUserID as userID, 0,0,0, 0,0,0,0,0,0,count(*),0,0,0";
				$str=$str." from buyermessage ";
				$str=$str." where fromUserID=$userId ";
				$str=$str." Union all";
				$str=$str." select soldToUserID as userID, 0,0,0, 0,0,0,0,0,0,0,count(*),0,0";
				$str=$str." from tradecomments";
				$str=$str." where soldToUserID !=0";
				$str=$str." and soldToUserID=$userId ";
				$str=$str." Union all";
				$str=$str." select userID, 0,0,0, 0,0,0,0,0,0,0,0,count(*),0";
				$str=$str." from requestpost";
				$str=$str." where status in ('A', 'R')";
				$str=$str." and userID=$userId ";
				$str=$str." Union all";
				$str=$str." select b.userID, 0,0,0, 0,0,0,0,0,0,0,0,0,count(*)";
				$str=$str." from requestpost a inner join post b on a.postID=b.postID ";
				$str=$str." where a.status in ('A', 'R')";
				$str=$str." and  b.userID= $userId ";
				$str=$str." ) total group by userID";
				$this->db->trans_start();
				$this->db->query($deleteStr);
				$this->db->query($str);
				
				$this->db->trans_complete();
				}catch(Exception $ex)
				{
					echo $ex->getMessage();
					return;
				}
		}
		
		function getMessageStatByUserID($userID){
			try{
				$str="update userstat ,   ";
				$str=$str." ( select  SUM(b.inboxMsgCount) as inboxMsgCount , sum(b.outGoingMsgCount) as outboxMsgCount  from ( ";
				$str=$str." SELECT  COUNT(*) AS inboxMsgCount, 0 as outGoingMsgCount  ";
				$str=$str." FROM message ";
				$str=$str." WHERE (status='Op' or status='OC' ) and userID=$userID ";
				$str=$str." Union all ";
				$str=$str." select  count(*), 0 ";
				$str=$str." from message where (status='R' and fuserID=$userID ) or (status='C'  and userID=$userID ) ";
				$str=$str." Union all";
				$str=$str." select 0,count(*) ";
				$str=$str." from message where (status='R' and userID=$userID) or (status='C' and fuserID=$userID ) ";
				$str=$str." union all ";
				$str=$str." select  0,count(*) ";
				$str=$str." from message where (status='OC' or status='Op') and fuserID=$userID ) b ) a set userstat.inboxMsgCount =a.inboxMsgCount , userstat.outgoingMsgCount= a.outboxMsgCount where userstat.userID=$userID ";
				$this->db->trans_start();
				$this->db->query($str);
				$this->db->trans_complete();
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				return;
			}
		}
		function getDirectSendStatByUserID($userID){
			try{
				$str="update userstat ,   ";
				$str=$str." (SELECT  COUNT(*) AS NoOfCount ";
				$str=$str." FROM requestpost ";
				$str=$str." WHERE status='U' and userID=$userID ) a set userstat.pendingMsgCount =a.NoOfCount where userstat.userID=$userID ";
				$this->db->trans_start();
				$this->db->query($str);
				$this->db->trans_complete();
			}catch(Exception $ex)
			{
				echo $ex->getMessage();
				return;
			}
		}
}

?>