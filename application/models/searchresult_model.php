<?php

class searchresult_model extends CI_Model {

		var $locationName='';
			var		$categoryName='';
				var	$postCurrency='';
			var		$postItemPrice=0;
			var		$postDescription='';
			var		$postCreateDate='';
			var		$picCount=0;
		
	function __construct()
	{
		parent::__construct();
		
	}
	function getNoOfItemCount($userID=0 , $catID=0, $locID=0 , $keywords='', $minPrice=0, $maxPrice=0)
	{if($catID==0 or $catID==null)
		$catID=0;
	else
		$catID=$catID;
	if($userID==0 or $userID==null)
		$userID=0;
	else
		$userID=$userID;
	if($locID==0 or $locID==null)
		$locID=0;
	else
		$locID=$locID;
	if(strcmp($keywords,'0')==0 or $keywords==null)
		$keywords='';
	else
		$keywords=$keywords;
	$priceStr="";
	if(intval($minPrice)<>0)
		$priceStr=" and  itemPrice>=".$minPrice;
	if(intval($maxPrice)<>0){
		if($priceStr<>"")
			$priceStr=$priceStr." and itemPrice <=".$maxPrice;
		else
			$priceStr="  and itemPrice<=".$maxPrice;
	}
	//--------------- add keywords search -----------------------------//
	$filterMore="";
	$tagMore="";
	if(strcmp($keywords,"")!=0){
		$filterMore=$this->getFilterMoreString($keywords);
		$tagMore=$this->getFilterByTags($keywords);
	}
	// -----------------end of keywrods search -----------------------//
	$strLocQuery="";
	if(strcmp($locID, "0")!=0 && $this->isParentlocID($locID))
		$strLocQuery=" and (locID in (select locationID from location where parentID=".$locID." ) or locID=".$locID."  or ".$locID."=0) ";
	else
		$strLocQuery=" and (locID=".$locID." or ".$locID."=0) ";
	
	$strQuery="";
	if(strcmp($catID, "0")!=0 && $this->isParentCatID($catID)){
		$strQuery="select count(distinct postID) as NoOfCount from post where status='A' and (userID=$userID or $userID=0) ";
		$strQuery=$strQuery." and remainQty>0  and (catID in (select categoryID from category where parentID=".$catID." ) or catID=".$catID."  or ".$catID."=0) ";
		$strQuery=$strQuery.$strLocQuery;
		$strQuery=$strQuery." and date_format(expriyDate, '%Y-%m-%d') >= date_format(curdate(), '%Y-%m-%d') ";
		$strQuery=$strQuery." and ( blockDate is null  or date_format(blockDate, '%Y-%m-%d') < date_format(curdate(), '%Y-%m-%d') ) ";
		if(strcmp($filterMore,"")!=0)
			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$filterMore.$tagMore." ) ";
		else
			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$tagMore." ) ";
		$strQuery=$strQuery.$priceStr;
		 
	}else{
		$strQuery="select count(distinct postID) as NoOfCount from post where status='A' and (userID=$userID or $userID=0) ";
		$strQuery=$strQuery." and remainQty>0 and (catID=".$catID." or ".$catID."=0) ";
		$strQuery=$strQuery.$strLocQuery;
		$strQuery=$strQuery." and date_format(expriyDate, '%Y-%m-%d') >= date_format(curdate(), '%Y-%m-%d') ";
		$strQuery=$strQuery." and ( blockDate is null  or date_format(blockDate, '%Y-%m-%d') < date_format(curdate(), '%Y-%m-%d') ) ";
	if(strcmp($filterMore,"")!=0)
			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$filterMore.$tagMore." ) ";
		else
			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$tagMore.") ";
		$strQuery=$strQuery.$priceStr;
	}
	//echo $strQuery;
	$NoOfItemCount=0;
	$query2 = $this->db->query($strQuery);
	$var2=$query2-> result_array();
	//var_dump($var2);
	$NoOfItemCount=$var2[0]["NoOfCount"];
	
	return $NoOfItemCount;
	
	}
function getItemList($pageNum, $userID=0 , $catID=0, $locID=0 , $keywords='', $sortByID="0", $minPrice=0, $maxPrice=0)
{
	if($catID==0 or $catID==null)
		$catID=0;
	else
		$catID=$catID;
	if($userID==0 or $userID==null)
		$userID=0;
	else
		$userID=$userID;
	if($locID==0 or $locID==null)
		$locID=0;
	else
		$locID=$locID;
	if(strcmp($keywords,'0')==0 or $keywords==null)
		$keywords='';
	else
		$keywords=$keywords;
	 
	//--------------- add keywords search -----------------------------//
	$filterMore="";
	$tagMore="";
	if(strcmp($keywords,"")!=0){
		$filterMore=$this->getFilterMoreString($keywords);
		$tagMore=$this->getFilterByTags($keywords);
	}
	// -----------------end of keywrods search -----------------------//
	
	$priceStr="";
	if(intval($minPrice)<>0)
		$priceStr=" and  itemPrice>=".$minPrice;
	if(intval($maxPrice)<>0){
		if($priceStr<>"")
			$priceStr=$priceStr." and itemPrice <=".$maxPrice;
		else
			$priceStr="  and itemPrice<=".$maxPrice;
	}


	$ulimit=ITEMS_PER_PAGE;
	$olimit=0;
	if ($pageNum>1)
		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
	$sortStr="";
	if($sortByID<>"0")
	{
		if($sortByID=="1")
			$sortStr=" order by itemPrice asc ";
		else if($sortByID="2")
			$sortStr=" order by itemPrice desc ";
	}
	else 
		$sortStr=" order by createDate desc ";
	
	$strLocQuery="";
	if(strcmp($locID, "0")!=0 && $this->isParentlocID($locID))
		$strLocQuery=" and (locID in (select locationID from location where parentID=".$locID." ) or locID=".$locID."  or ".$locID."=0) ";
	else
		$strLocQuery=" and (locID=".$locID." or ".$locID."=0) ";
	
	$strQuery="";
	
	$strQuery="";
	if(strcmp($catID, "0")!=0 && $this->isParentCatID($catID)){
		$strQuery="select * from post where status='A' and (userID=$userID or $userID=0) ";
		$strQuery=$strQuery." and remainQty>0  and (catID in (select categoryID from category where parentID=".$catID." ) or catID=".$catID." or ".$catID."=0) ";
		$strQuery=$strQuery.$strLocQuery;
		$strQuery=$strQuery." and date_format(expriyDate, '%Y-%m-%d') >= date_format(curdate(), '%Y-%m-%d') ";
		$strQuery=$strQuery." and ( blockDate is null  or date_format(blockDate, '%Y-%m-%d') < date_format(curdate(), '%Y-%m-%d') ) ";
		
		if(strcmp($filterMore,"")!=0)
	    			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$filterMore.$tagMore." ) ";
	    		else 
	    			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$tagMore." ) ";
	    $strQuery=$strQuery.$priceStr.$sortStr." limit ".$olimit.",".$ulimit;
		 
	}else{
		$strQuery="select * from post where status='A' and (userID=$userID or $userID=0) ";
		$strQuery=$strQuery." and remainQty>0  and (catID=".$catID." or ".$catID."=0) ";
		$strQuery=$strQuery.$strLocQuery;
		$strQuery=$strQuery." and date_format(expriyDate, '%Y-%m-%d') >= date_format(curdate(), '%Y-%m-%d') ";
		$strQuery=$strQuery." and ( blockDate is null  or date_format(blockDate, '%Y-%m-%d') < date_format(curdate(), '%Y-%m-%d') ) ";
	if(strcmp($filterMore,"")!=0)
	    			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$filterMore.$tagMore." ) ";
	    		else 
	    			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$tagMore." ) ";
	    $strQuery=$strQuery.$priceStr.$sortStr." limit ".$olimit.",".$ulimit;
	}
	try {
		echo $strQuery;
		$query = $this->db->query($strQuery);
		$var=$query->result();

		$result=null;
		if($var!=null){
		foreach($var as $post)
		{
			$pic=$this->get_picture_by_postID($post->postID);
			$category=$this->get_category_by_categoryID($post->catID);
			$catName="";
			$locName="";
			if(strcmp($this->lang->line("lang_label_text"),"english")==0)
					$catName=$category[0]->name;
			else
				$catName=$category[0]->nameCH;
			$location=$this->get_location_by_locationID($post->locID);
			if($location[0]->locationID!=0){
				if(strcmp($this->lang->line("lang_label_text"),"english")==0)
					$locName=$location[0]->name;
				else 
					$locName=$location[0]->nameCN;
			}
			$thumbPath="";
			$thumbName="";
			if($pic!=null && count($pic)>0){
				try{
				$thumbPath=$pic[0]-> thumbnailPath;
				$thumbName=$pic[0]->thumbnailName;
				}catch(Exception $ex){}
			}
			$userInfo=$this->nativesession->get("user");
			$loginuserID=0;
			if(!empty($userInfo))
				$loginuserID=$userInfo["userID"];
			$temp=array('locationName'=> $locName,
					'categoryName'=> $catName,
					'postCurrency'=>$post->currency,
					'postItemPrice'=>$post->itemPrice,
					'postDescription'=> $post->description,
					'postTitle'=>$post->itemName,
					'postCreateDate'=>$post->createDate,
					'picCount'=>count($pic),
					'postTypeAds'=>$post->typeAds,
					'thumbnailPath'=>$thumbPath,
					'thumbnailName'=>	$thumbName,
					'getDisableSavedAds'=>$this->getDisableSavedAds($post->postID, $loginuserID)
			);	
			
			
			
			
			
			if(is_null($result))
			{
				$result=array($post->postID => $temp);
			}else
			{	$result=$result + array($post->postID => $temp);

			}
		}
		return $result;
		}
	}catch(Exception $e)
	{
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	return null;
}

function getDisableSavedAds($postID, $userID){
	$arr=array("postID"=> $postID, "userID"=> $userID);
	$query = $this->db->from('savedAds')->where($arr)->get();
	$var= $query->result();
	if($var!=null && sizeof($var)>0)
		return true;
	else
		return false;
}

function getFilterByTags($keywords){
	$strArr=explode(" " ,strtoupper($keywords));
	$max=count($strArr);
// 	if($max>1){
		$result=" or postID in ( select postID from tag where ";
		for($i=0; $i<$max;$i++){
			if(strcmp(trim($strArr[$i]), "")!=0){
			if($i==0)
				$result=$result." tag like '%".trim($strArr[$i])."%' ";
			else 
				$result=$result." or tag like '%".trim($strArr[$i])."%' ";
			}
		}
		$result=$result.")";
// 	}
	
	return $result;
}

function getFilterMoreString($keywords){
	$str=strtoupper($keywords);
	$searchWords=array("Dress"=>"連身裙",
			"Long"=> "長", "Short"=> "短",  "Tops"=>"上身",
			"Shirt"=>"衫", "Long Sleeve"=>"長袖",
			"Bottoms"=>"下身", "Shorts"=>"短褲",
			"Jacket"=>"外套",  	"Hat"=>"帽",
			"Necklace"=>"頸鏈", 	"Earrings"=>"耳環",
			"Bracelet"=>"手鐲",   	"Watch"=>"手錶",
			"Bag"=>"袋", "Wallet"=>"銀包",
			"Shoes"=>"鞋",   	"High heels"=>"高跟鞋",
			"Silver"=>"銀色",    	"Gold"=>"金色",
			"Red"=>"紅色",   	"Blue"=>"藍色",
			"Green"=>"綠色", "Pink"=>"粉紅色",
			"Dark"=>"暗",    	"Orange"=>"橙色",
			"Yellow"=>"黃色" ,    	"Black"=>"黑色",
			"White"=>"白色",   	"Purple"=>"紫色");
	$result="";
	foreach($searchWords as $x=>$y){
		if (strpos($str,strtoupper($x)) !== false)
			$result=$result." or description like '%".$y."%' or itemName like '%".$y."%'  ";
		if (strpos($str,strtoupper($y)) !== false)
			$result=$result." or description like '%".$x."%' or itemName like '%".$x."%'  ";
	}
	return $result;
}
function get_picture_by_postID($postID)
{
	$query = $this->db->from('picture')->where('postID', $postID)->get();

	return $query->result();
}
function get_category_by_categoryID($catID)
{
	$query = $this->db->from('category')->where('categoryID', $catID)->limit(1)->get();

	return $query->result();
}
 
function get_location_by_locationID($locID)
{
	$query = $this->db->from('location')->where('locationID', $locID)->limit(1)->get();
	return $query->result();
}
public function isParentCatID($catID){
	$query = $this->db->from('category')->where('parentID', $catID)->get();
	$var= $query->result();
	if(!isset($var) or empty($var))
		return false;
	return true;
}

public function isParentlocID($locID){
	$query = $this->db->from('location')->where('parentID', $locID)->get();
	$var= $query->result();
	if(!isset($var) or empty($var))
		return false;
	return true;
}
}