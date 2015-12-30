<?php 

        /*  --------------------MAP---------------------
            $infoDisplayStatus: 
            NY: Item is New and price is negotiable
            UY: Item is Used and price is negotiable
            Y:  Item is New/Used (not defined) and price is negotiable
         
            NN: Item is New and price is NOT negotiable
            UN: Item is Used and price is NOT negotiable
            N:  Item is New/Used (not defined) and price is NOT negotiable

        */
	class post_model extends CI_Model {
	
	    var $postID = '';
	    var $userID = '';
            var $viewCount = ''; 
            var $catID  = '';
            var $locID='';
            var $itemName  = '';
            var $itemNameCH  = '';
            var $itemPrice  = '';
            var $itemQual  = '';
            var $currency  = '';
            var $description  = '';
            var $paymentMethod  = '';
            var $status  = '';
            var $infoDisplayStatus  = '';
            var $createDate  = '';
            var $expriyDate = '';
            var $typeAds='';
            var $newUsed='';
            var $postDate='';
            var $soldDate='';
            var $soldToUserID=0;
            var $sellerRating=0;
            var $sellerComment='';
            var $buyerRating=0;
            var $buyerComment='';
            var $buyerDate='';
            var $rejectReason='';
            var $rejectSpecifiedReason='';
            var $blockDate;
            var $remainQty=0;
	    function __construct()
	    {
	        parent::__construct();
// 	        $this->load->model('users_model');
// 	        $this->load->model('post_model', 'post');
// 	        $this->load->model('requestpost_model');
	    }
	    
	   		
	    function insert($data)
	    {
	    	try{
	    	$this->db->trans_start();
    		$this->db->insert('post',$data);
    		$this->db->trans_complete();
    		
    		$this->db->select_max('postID');
     		$result= $this->db->get('post')->result_array();
     		   		
    		return $result[0]['postID'];
	    	}
	    	catch (Exception $ex) {
	    		echo 'Caught exception: ',  $ex->getMessage(), "\n";
	    		log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
	    				$this->router->fetch_method().
	    				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
	    		return 0;
	    	}
	    }
// 	    public function getPost($postId)
// 	    {
// 	    	return $this->post->getPostByID($postId);
// 	    }
// 	    function returnArray($postId, $prevUrl='', $errorMsg='', $successMsg='')
// 	    {
// 	    	try {
// 	    		$data["lang_label_text"] = $this->lang->line("lang_label_text");
// 	    		$data["lang_label"] = $this->nativesession->get("language");
// 	    		$data["Home"] = $this->lang->line("Home");
// 	    		$data["About_us"] = $this->lang->line("About_us");
// 	    		$data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
// 	    		$data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
// 	    		$data["Contact_us"] = $this->lang->line("Contact_us");
// 	    		$data["FAQ"] = $this->lang->line("FAQ");
// 	    		$data["Index_Footer1"] = $this->lang->line("Index_Footer1");
// 	    		$data["Call_Now"] = $this->lang->line("Call_Now");
// 	    		$data["Tel"] = $this->lang->line("Tel");
	    	
// 	    		$data["Login"]=$this->lang->line("Login");;
// 	    		$data["Signup"]=$this->lang->line("Signup");
// 	    		$data["Profile"]=$this->lang->line("Profile");
// 	    		$data["Logout"]=$this->lang->line("Logout");
// 	    		$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
	    	
// 	    		$data["lang_label"]=$this->nativesession->get("language");
// 	    		$var = $this->getPost($postId);
// 	    		$data["postID"]=$postId;
// 	    		if($var == null)
// 	    		{
// 	    			$this->nativesession->set("lastPageVisited","processError");
// 	    			$this->load->view('system-error', $data);
// 	    		}else
// 	    		{
// 	    			//echo $var['postID'];
// 	    			$user = $this->users_model->get_user_by_id($var[0]->userID);
// 	    			$pic = $this->post->get_picture_by_postID($var[0]->postID);
// 	    			$category = $this->post->get_category_by_categoryID($var[0]->catID);
// 	    			$parentCategory=$this->post->get_category_by_categoryID($category[0]->parentID);
// 	    			$location = $this->post->get_location_by_locationID($var[0]->locID);
	    	
// 	    			$this->nativesession->set("lastPageVisited","item");
	    	
// 	    			$data["previousCurrent_url"] = urldecode($prevUrl);
// 	    			$data["ParentCatID"] = $parentCategory[0]->categoryID;
// 	    			$data["ParentCatName"] = $data["lang_label"]<>"english" ? $parentCategory[0]->nameCH : $parentCategory[0]->name;
// 	    			$data["ChildCatID"] = $category[0]->categoryID;
// 	    			$data["ChildCatName"] = $data["lang_label"]<>"english" ? $category[0]->nameCH : $category[0]->name;
// 	    			$data["itemName"] = $data["lang_label"]<>"english" ? $var[0]->itemNameCH : $var[0]->itemName;
// 	    			$data["createDate"] = $var[0]->createDate;
// 	    			$data["currency"] = $var[0]->currency;
// 	    			$data["price"] = $var[0]->itemPrice;
// 	    			$data["AdsProduct"] = array($var[0]->postID => $pic);
// 	    			$data["itemDesc"] = $var[0]->description;
// 	    			if ($var[0]->locID>0)
// 	    				$data["LocationName"] = $data["lang_label"]<>"english" ? $location[0]->nameCN : $location[0]->name;
// 	    			else
// 	    				$data["LocationName"]="";
// 	    			$data["userName"] = $user[0]->username;
// 	    			$data["userID"] = $user[0]->userID;
// 	    			$userCreateDate = $user[0]->createDate;
// 	    			$data["userCreateDate"]=$userCreateDate;
// 	    			$data["errorMsg"]=array("success1"=> ($successMsg), "error"=> ($errorMsg));
	    			 
// 	    			$isSameUser=false;
// 	    			$isPostAlready=false;
// 	    			$loginUser=$this->nativesession->get("user");
// 	    			if(!empty($loginUser) and isset($loginUser) and $loginUser<>null and $loginUser["userID"]<>0)
// 	    			{
// 	    				if($loginUser["userID"]==$user[0]->userID)
// 	    					$isSameUser=true;
// 	    				$isPostAlready=$this->requestpost_model->getfUserIDAndPostID($var[0]->postID, $loginUser["userID"]);
// 	    			}
// 	    			$data["isSameUser"]=$isSameUser;
// 	    			$data["isPostAlready"]=$isPostAlready;
	    	
// 	    		}
// 	    	}catch(Exception $e)
// 	    	{
// 	    		echo 'Caught exception: ',  $e->getMessage(), "\n";
	    		 
// 	    	}
// 	    	return $data;
// 	    }
	    
	function getUItemList()
	    {
	    	$query = $this->db->from('post')->where('status', 'U')->get();
	    	$var=$query->result();
	    	$result=null;
	    	foreach($var as $post)
	    	{
	    		$pic=$this->get_picture_by_postID($post->postID);
	    		$category=$this->get_category_by_categoryID($post->catID);
	    		$location=$this->get_location_by_locationID($post->locID);
	    		
	    		
	    		//$popup_content= $this->load->view('item',$this->returnArray(), TRUE);
	    		$temp=array('post'=> $post, 'pic'=> $pic, 'category'=> $category, 'location'=> $location);
	    	
	    		if(is_null($result))
	    		{
	    			$result=array($post->postID => $temp);
	    		}else 
	    		{	$result=$result + array($post->postID => $temp);		
	    	
	    		}
	    	}
	    	return $result;
	    }
	    function getFeatureProduct()
	    {
	    	
	    	$query = $this->db->from('post')->where('status', 'A')->limit(6)->get();
	    	$var=$query->result();
	    	$result=null;
	    	foreach($var as $post)
	    	{
	    		$pic=$this->get_picture_by_postID($post->postID);
	    		$temp=array('post'=> $post, 'pic'=> $pic);
	    	
	    		if(is_null($result))
	    		{
	    			$result=array($post->postID => $temp);
	    		}else 
	    		{	$result=$result + array($post->postID => $temp);		
	    	
	    		}
	    	}
	    	return $result;
	    
	    }
	    function getNUMOFTIMESPOST($userID){
	    	$sql="select count(*) as NoOfCount from post ";
	    	$sql=$sql." 	where (status='A' or status='U') and postDate >= DATE_ADD(curdate(), INTERVAL -".NUMOFDAYSFORPOST ." DAY) ";
	    	$sql=$sql." 	and userID=".$userID;
	    	$NoOfPostCount=0;
	    	$query2 = $this->db->query($sql);
	    	$var2=$query2->result_array();
	    	//var_dump($var2);
	    	$NoOfPostCount=$var2[0]["NoOfCount"];
	    	
	    	return $NoOfPostCount;
	    }
	    function getInterestedProduct()
	    {
	    	$sql='';
	    	if(!empty($_SESSION['session_id']) && $_SESSION['session_id']!=null){
	    		$sql.="where a.session_id='".$_SESSION['session_id']."' order by a.viewCount desc limit 6";
	    	}
	    	else 
	    		$sql.="order by a.viewCount desc limit 6";
	    	
	    	$sqlMain="SELECT b.* FROM post b INNER JOIN interestedproduct a ON a.postID=b.postID ".$sql;
	    	
	    	$query=$this->db->query($sqlMain);
	    	//$query = $this->db->from('post')->where('status', 'A')->limit(6)->get();
	    	$var=$query->result();
	    	if(count($var)==0){
	    		$sqlMain="SELECT b.* FROM post b INNER JOIN interestedproduct a ON a.postID=b.postID order by a.viewCount desc limit 6";
	    		$query=$this->db->query($sqlMain);
	    		$var=$query->result();
	    	}
	    	
	    	$result=null;
	    	foreach($var as $post)
	    	{
	    		$pic=$this->get_picture_by_postID($post->postID);
	    		$temp=array('post'=> $post, 'pic'=> $pic);
	    
	    		if(is_null($result))
	    		{
	    			$result=array($post->postID => $temp);
	    		}else
	    		{	$result=$result + array($post->postID => $temp);
	    
	    		}
	    	}
	    	return $result;
	    	 
	    }
	    function getHotProduct()
	    {
// 	    	$query = $this->db->from('post')->where('status', 'A')->get();
// 	    	$var=$query->result();
// 	    	$recCount=count($var);
	    	$query = $this->db->from('post')->where('status', 'A')->order_by('viewCount', 'desc')->limit(6)->get();
	    	$var=$query->result();
	    	$result=null;
	    	foreach($var as $post)
	    	{
	    		$pic=$this->get_picture_by_postID($post->postID);
	    		$temp=array('post'=> $post, 'pic'=> $pic);
	    
	    		if(is_null($result))
	    		{
	    			$result=array($post->postID => $temp);
	    		}else
	    		{	$result=$result + array($post->postID => $temp);
	    
	    		}
	    	}
	    	return $result;
	    	 
	    }
	    function getPostByPostID($postID)
	    {
	    	$query = $this->db->from('post')->where('postID', $postID)->get();
	    	return $query->result();
	    }
	    
	    function getPostByUserID($userID){
	    	$query = $this->db->from('post')->where('userID', $userID)->get();
	    	$postList=array();
	    	 if($query->result()){
     			 foreach ( $query->result() as $state) {  
			
			         $postList[$state -> postID] = $state -> description;
 			     }
	    	 }
 			 return   $postList;
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
	    if(strcmp($keywords,"")!=0){
	    	$filterMore=$this->getFilterMoreString($keywords);
	    }
	    // -----------------end of keywrods search -----------------------//
	    
	    $strQuery="";
	    if(strcmp($catID, "0")!=0 && $this->isParentCatID($catID)){
	    	$strQuery="select count(distinct postID) as NoOfCount from post where status not in ('R', 'U', 'D') and (userID=$userID or $userID=0) ";
	    	$strQuery=$strQuery." and (catID in (select categoryID from category where parentID=".$catID." ) or catID=".$catID.") ";
	    	$strQuery=$strQuery." and (locID=".$locID." or ".$locID."=0) ";
		$strQuery=$strQuery." and date_format(expriyDate, '%Y-%m-%d') >= date_format(curdate(), '%Y-%m-%d') ";
		//$strQuery=$strQuery." and ( blockDate is null  or date_format(blockDate, '%Y-%m-%d') < date_format(curdate(), '%Y-%m-%d') ) ";
	    	if(strcmp($filterMore,"")!=0)
	    		$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$filterMore." ) ";
	    	else
	    		$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ) ";
	    	$strQuery=$strQuery.$priceStr;
	    	 
	    }else{
	    	$strQuery="select count(distinct postID) as NoOfCount from post where status not in ('R', 'U', 'D')  and (userID=$userID or $userID=0) ";
	    	$strQuery=$strQuery." and (catID=".$catID." or ".$catID."=0) ";
	    	$strQuery=$strQuery." and (locID=".$locID." or ".$locID."=0) ";
		$strQuery=$strQuery." and date_format(expriyDate, '%Y-%m-%d') >= date_format(curdate(), '%Y-%m-%d') ";
//		$strQuery=$strQuery." and ( blockDate is null  or date_format(blockDate, '%Y-%m-%d') < date_format(curdate(), '%Y-%m-%d') ) ";
	    	if(strcmp($filterMore,"")!=0)
	    		$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$filterMore." ) ";
	    	else
	    		$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ) ";
	    	$strQuery=$strQuery.$priceStr;
	    }//echo $strQuery;
	    $NoOfItemCount=0;
	    $query2 = $this->db->query($strQuery);
	    $var2=$query2->result_array();
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
	    	if(strcmp(($keywords),'0')==0 or $keywords==null)
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
	    	if($keywords<>""){
	    			$filterMore=$this->getFilterMoreString($keywords);
	    	}
	    	// -----------------end of keywrods search -----------------------//
	    	
	    	$ulimit=ITEMS_PER_PAGE;
	    	$olimit=0;
	    	if ($pageNum>1)
	    		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
	    	$sortStr="";
	    	if($sortByID<>"0")
	    	{
	    		if(strcmp($sortByID,"1")==0)
	    			$sortStr=" order by itemPrice asc ";
	    		else if(strcmp($sortByID,"2")==0)
	    			$sortStr=" order by itemPrice desc ";
	    		else if(strcmp($sortByID,"3")==0)
	    			$sortStr=" order by createDate desc ";
	    		else if(strcmp($sortByID,"4")==0)
	    			$sortStr=" order by createDate asc ";
	    	}
	    	$strQuery="";
	    	if(strcmp($catID, "0")!=0 && $this->isParentCatID($catID)){
	    		$strQuery="select * from post where status not in ('R', 'U', 'D') and (userID=$userID or $userID=0) ";
	    		$strQuery=$strQuery." and (catID in (select categoryID from category where parentID=".$catID." ) or catID=".$catID.") ";
	    		$strQuery=$strQuery." and (locID=".$locID." or ".$locID."=0) ";
				$strQuery=$strQuery." and date_format(expriyDate, '%Y-%m-%d') >= date_format(curdate(), '%Y-%m-%d') ";
		//		$strQuery=$strQuery." and ( blockDate is null  or date_format(blockDate, '%Y-%m-%d') < date_format(curdate(), '%Y-%m-%d') ) ";
	    		if(strcmp($filterMore,"")!=0)
	    			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$filterMore." ) ";
	    		else 
	    			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ) ";
	    		$strQuery=$strQuery.$priceStr.$sortStr." limit ".$olimit.",".$ulimit;
	    		
	    	}else{
	    	$strQuery="select * from post where status not in ('R', 'U' ,'D') and (userID=$userID or $userID=0) ";
	    	$strQuery=$strQuery." and (catID=".$catID." or ".$catID."=0) ";
	    	$strQuery=$strQuery." and (locID=".$locID." or ".$locID."=0) ";
		$strQuery=$strQuery." and date_format(expriyDate, '%Y-%m-%d') >= date_format(curdate(), '%Y-%m-%d') ";
	//	$strQuery=$strQuery." and ( blockDate is null  or date_format(blockDate, '%Y-%m-%d') < date_format(curdate(), '%Y-%m-%d') ) ";
	    	if(strcmp($filterMore,"")!=0)
	    			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ".$filterMore." ) ";
	    		else 
	    			$strQuery=$strQuery." and (description like '%".($keywords)."%'  or itemName like '%".($keywords)."%'  ) ";
	       		$strQuery=$strQuery.$priceStr.$sortStr." limit ".$olimit.",".$ulimit;
	    	}
	    	try {
	    	echo $strQuery;
	    	$query = $this->db->query($strQuery);
	    	$var=$query->result();
	    	
	    	$result=null;
	    	foreach($var as $post)
	    	{
	    		$pic=$this->get_picture_by_postID($post->postID);
	    		$category=$this->get_category_by_categoryID($post->catID);
	    		$location=$this->get_location_by_locationID($post->locID);
	    		$soldToUser=$this->get_user_by_id($post->soldToUserID);
	    		$temp=array('post'=> $post, 'pic'=> $pic, 'category'=> $category, 'location'=> $location,
	    				'soldToUser'=> $soldToUser, 'savedAds'=>$this->searchresult_model->getDisableSavedAds($post->postID, $userID));
	    	
	    		if(is_null($result))
	    		{
	    			$result=array($post->postID => $temp);
	    		}else 
	    		{	$result=$result + array($post->postID => $temp);		
	    	
	    		}
	    	}
	    	return $result;
	    	}catch(Exception $e)
	    	{
	    		echo 'Caught exception: ',  $e->getMessage(), "\n";
	    	}
	    	
	    }
	    public function get_user_by_id($userID)
	    {
	    	$query = $this->db->from('user')->where('userID', $userID)->limit(1)->get();
	    
	    	return $query->result();
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
            function getPostByID($postID)
            {
                $whereArray = array('postID' => $postID);
                $query = $this->db->from('post')->where('postID', $postID)->limit(1)->get();
	        return $query->result();  
            }
            public function getNoOfItemCountInMyAds($userId){
            	$strQuery="select count(distinct postID) as NoOfCount from post where status in ('A','U')  and (userID=$userId) ";
            	$NoOfItemCount=0;
            	$query2 = $this->db->query($strQuery);
            	$var2=$query2->result_array();
            	var_dump($var2);
            	$NoOfItemCount=$var2[0]["NoOfCount"];
            		
            	return $NoOfItemCount;
            }
            function getMyAds($userId, $pageNum){
            	$ulimit=ITEMS_PER_PAGE;
            	$olimit=0;
            	if ($pageNum>1)
            		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
            	$whereArray = array('userID' => $userId);
            	$in_where=array("A", "U");
            	$query = $this->db->from('post')->where($whereArray)->where_in("status", $in_where)->limit($ulimit, $olimit)->get();
            	return $query->result();
            }
	
            function getAdminPost($userId ){
            	
            	$whereArray = array('userID' => $userId);
            	$in_where=array("A", "U");
            	$query = $this->db->from('post')->where($whereArray)->where_in("status", $in_where)->get();
            	return $query->result();
            }
            public function getNoOfItemCountInArchiveAds($userId){
            	$strQuery="select count(distinct postID) as NoOfCount from post where (status='C')  and (userID=$userId) ";
            	$NoOfItemCount=0;
            	$query2 = $this->db->query($strQuery);
            	$var2=$query2->result_array();
            	var_dump($var2);
            	$NoOfItemCount=$var2[0]["NoOfCount"];
            
            	return $NoOfItemCount;
            }
            function getArchiveAds($userId, $pageNum){
            	$ulimit=ITEMS_PER_PAGE;
            	$olimit=0;
            	if ($pageNum>1)
            		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
            	$whereArray = array('userID' => $userId);
//             	$orWhereArray= array('userID' => $userId, 'status'=>'Bc');
//             	$statusIn=array('So', 'Bc');
            	$statusIn=array('C');
            	$query = $this->db->from('post')->where($whereArray)->where_in('status', $statusIn) ->limit($ulimit, $olimit)->get();
            	return $query->result();
            }
//             public function getNoOfItemCountInBuyAdsHistory($userId){
//             	$strQuery="select count(distinct postID) as NoOfCount from post where (status='So' or status='Bc')  and (soldToUserID=$userId) ";
//             	$NoOfItemCount=0;
//             	$query2 = $this->db->query($strQuery);
//             	$var2=$query2->result_array();
//             	var_dump($var2);
//             	$NoOfItemCount=$var2[0]["NoOfCount"];
            
//             	return $NoOfItemCount;
//             }
//             function getBuyAdsHistory($userId, $pageNum){
//             	$ulimit=ITEMS_PER_PAGE;
//             	$olimit=0;
//             	if ($pageNum>1)
//             		$olimit=($pageNum-1)*ITEMS_PER_PAGE;
//             	$whereArray = array('soldToUserID' => $userId);
//             	//$orWhereArray= array('userID' => $userId, 'status'=>'Bc');
//             	$statusIn=array('So', 'Bc');
//             	$query = $this->db->from('post')->where($whereArray)->where_in('status', $statusIn) ->limit($ulimit, $olimit)->get();
//             	return $query->result();
//             }
		function delete($data, $whereSQL)
		{
			try {
		
				$this->db->trans_start();
				$this->db->where($whereSQL);
				$var=$this->db->update('post', $data);
				$this->db->trans_complete();
		
				if($var>0)
					return true;
				else 
					throw new Exception(ZeroUpdateRecordError);
				}catch(Exception $ex)
			{
				echo $ex->getMessage();
				log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
				$this->router->fetch_method().
				"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
			}
		
			return false;
				
		}
		public function isParentCatID($catID){
			$query = $this->db->from('category')->where('parentID', $catID)->get();
			$var= $query->result();
			if(!isset($var) or empty($var))
				return false;
			return true;
		}
		function update($data, $postID)
		{
			try {
				$whereSQL=array("postID"=> $postID);
				$this->db->trans_start();
				$this->db->where($whereSQL);
				$var=$this->db->update('post', $data);
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
		
		function updatePost($messageArray,$where){
				try {
			
					$this->db->trans_start();
					$this->db->where($where);
					$var=$this->db->update('post', $messageArray);
					$this->db->trans_complete();
			
					if($var>0)
						return true;
					else
						throw new Exception(ZeroUpdateRecordError);
						
				}catch(Exception $ex)
				{
					echo $ex->getMessage();
					log_message('error', "[Class]: ".$this->router->fetch_class()."[Method:] ".
							$this->router->fetch_method().
							"[Line]: ".$ex->getLine()."[Error]: ".$ex->getMessage());
				}
					
				return false;
			}
			function updateStat(){
				try{
					$deleteStr="DELETE FROM userstat";
			
									
				$str="INSERT INTO userstat ";
				$str=$str." SELECT userID, SUM(inboxMsgCount), SUM(approveMsgCount), SUM(myAdsCount),"; 
				$str=$str." SUM(savedAdsCount), SUM(pendingMsgCount), SUM(archivedAdsCount), ";
				$str=$str." SUM(visitCount), SUM(adsCount), SUM(favoriteAdsCount),";
				$str=$str." SUM(outGoingMsgCount), SUM(BuyAdsCount), SUM(directsendhistCount) ";
				$str=$str." FROM ( ";
				$str=$str." SELECT userID, COUNT(*) AS inboxMsgCount, 0 AS approveMsgCount,0  AS myAdsCount, ";
				$str=$str." 0  AS savedAdsCount,0 AS pendingMsgCount,0 AS archivedAdsCount,0 AS visitCount,";
				$str=$str." 0 AS adsCount,0 AS favoriteAdsCount , 0 as outGoingMsgCount,";
				$str=$str." 0 as BuyAdsCount, 0 as directsendhistCount ";
				$str=$str." FROM message ";
				$str=$str." WHERE STATUS='Op' or status='OC'";
				$str=$str." GROUP BY userID ";
				$str=$str." Union all";
				$str=$str." select fUserID as userID, count(*), 0, 0,0,0,0,0,0,0 ,0,0 ,0";
				$str=$str." from message where status='R' or status='C'";
				$str=$str." group by fUserID";
				$str=$str." UNION ALL ";
				$str=$str." SELECT b.userID, 0, COUNT(*) AS approveMsgCount, 0,0,0,0,0,0,0,0,0,0 ";
				$str=$str." FROM requestpost a INNER JOIN post b ";
				$str=$str." ON a.postID=b.postID ";
				$str=$str." WHERE a.status='U' ";
				$str=$str." GROUP BY b.userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,COUNT(*) AS myAdsCount, 0,0,0,0,0,0 ,0,0,0";
				$str=$str." FROM post ";
				$str=$str." where status='A'";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID,0,0,0, COUNT(*) AS savedAdsCount,0,0,0,0,0 ,0,0,0";
				$str=$str." FROM savedAds ";
				$str=$str." WHERE STATUS='U' ";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID,0,0,0,0, COUNT(*) AS pendingMsgCount,0,0,0,0,0,0,0"; 
				$str=$str." FROM requestpost ";
				$str=$str." WHERE STATUS='U' ";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,0, 0,0,COUNT(*) AS archivedAdsCount,0,0,0 ,0,0,0";
				$str=$str." FROM post ";
				$str=$str." where status in ('Bc', 'So')";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT a.userID, 0,0,0, 0,0,0,COUNT(*) AS visitCount,0,0 ,0,0,0";
				$str=$str." FROM post a INNER JOIN postviewhistory b ";
				$str=$str." ON a.postID = b.postID ";
				$str=$str." GROUP BY a.userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,0, 0,0,0,0,COUNT(*) AS adsCount,0 ,0,0,0";
				$str=$str." FROM post ";
				$str=$str." GROUP BY userID ";
				$str=$str." UNION ALL ";
				$str=$str." SELECT userID, 0,0,0, 0,0,0,0,0,COUNT(*) AS favoriteAdsCount ,0,0,0";
				$str=$str." FROM post ";
				$str=$str." WHERE typeAds='featuredAds' ";
				$str=$str." GROUP BY userID ";
				$str=$str." Union all";
				$str=$str." select userID, 0,0,0, 0,0,0,0,0,0,count(*),0,0";
				$str=$str." from message where (status='R' or status='C') ";
				$str=$str." group by userID";
				$str=$str." Union all";
				$str=$str." select fuserID, 0,0,0, 0,0,0,0,0,0,count(*),0,0";
				$str=$str." from message where status='OC'";
				$str=$str." group by fuserID";
				$str=$str." Union all";
				$str=$str." select soldToUserID, 0,0,0, 0,0,0,0,0,0,0,count(*),0";
				$str=$str." from post";
				$str=$str." where status in ('So', 'Bc')";
				$str=$str." and soldToUserID !=0";
				$str=$str." group by soldToUserID";
				$str=$str." Union all";
				$str=$str." select userID, 0,0,0, 0,0,0,0,0,0,0,0,count(*)";
				$str=$str." from requestpost";
				$str=$str." where status in ('A', 'R')";
				$str=$str." group by userID";
				$str=$str." ) total group by userID";
				
				$Str1a="update location set postCount=0;";
				$Str2a="update category set postCount=0;";
					$Str1="UPDATE location a INNER JOIN ( SELECT locID, COUNT(*) AS NoOfCount FROM post where status='A' GROUP BY locID )b ON a.locationID = b.locID ";
					$Str1=$Str1."SET a.postCount = b.NoOfCount ";
					$Str2="UPDATE category a INNER JOIN (SELECT catID, COUNT(*) AS NoOfCount FROM post where status='A' GROUP BY catID) b  ON a.categoryID = b.catID ";
					$Str2=$Str2."SET a.postCount = b.NoOfCount ";
					$Str3="UPDATE location a INNER JOIN ( SELECT parentID, SUM(postCount) AS NoOfCount FROM location ";
					$Str3=$Str3."WHERE parentID IS NOT NULL GROUP BY parentID ) b ON a.locationID = b.parentID ";
					$Str3=$Str3."SET a.postCount = b.NoOfCount + a.postCount";
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
				$str10="  insert into interestedproduct (postID, viewCount)";
				$str10=$str10."  select postID, NoOfCount from (";
				$str10=$str10."  		select postID, count(*) as NoOfCount";
				$str10=$str10."  	from postviewhistory group by postID ) a";
				$str10=$str10."  	order by a.NoOfCount desc limit 6;";
				$this->db->trans_start();
					$this->db->query($deleteStr);
					$this->db->query($str);
					$this->db->query($Str1a);
					$this->db->query($Str2a);
					$this->db->query($Str1);
					$this->db->query($Str2);
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
				$this->db->trans_complete();
				}catch(Exception $ex)
				{
					echo $ex->getMessage();
					return;
				}
			}
	}
?>