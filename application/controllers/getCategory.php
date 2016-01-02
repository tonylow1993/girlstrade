<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getCategory extends CI_Controller {
	
	var $byPassViewProfile=false;
	public function __construct($bypass=false)
	{
		
		parent::__construct();
		$this->load->library("nativesession");
		
	   $byPassGetCategory=$bypass;
		
       
		$this->load->helper('url');
		$this->load->helper('language');
		$this->load->database();
		date_default_timezone_set("Asia/Hong_Kong");
		if($this->nativesession->get("language")!=null)
		{
			$data["lang_label"] = $this->nativesession->get("language");
			$this->lang->load("message", $data["lang_label"]);
		}
		else
		{
			$data["lang_label"]="chinese";
			$this->lang->load("message", $data["lang_label"]);
			$this->nativesession->set("language",$data["lang_label"]);
		}
         $this->load->model('category_model');
        $this->load->model('location_model');
        $this->load->model('post_model');
		$this->load->model('searchhistory_model');
		$this->load->model('savedAds_model');
		$this->load->model('searchresult_model');
	}
	
	public function savedAds()
	{
		$userInfo=$this->nativesession->get("user");
		$fUserID=0;
		if(!empty($userInfo))
			$fUserID=$userInfo["userID"];
		else {
			$data['status'] = 'F';
			$data['class'] = "has-error";
			$data['message'] = '<div class="alert alert-danger"><strong>Warning!</strong> Please login in to save the item</div>';
			$data['icon'] = '<em><span style="color:red"></span></em>';
			echo json_encode($data);
			return;
		}
		
		$postID = $this->input->post('postID');
		
		$messageArray=array(
				'postID'=>intval($postID),
				'userID'=>intval($fUserID),
				'status' => "U",
				'createDate' => date("Y-m-d H:i:s"));
			$messageID=$this->savedAds_model->insert($messageArray);
			$data['status'] = 'A';
			$data['class'] = "has-success";
			$data['message'] = '';
			$data['icon'] = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i>Saved</span></em>';
			echo json_encode($data);
	}
	
	public function getAll($pageNum, $catID="0", $locID="0", $keywords='0', $sortByID="0", $minPrice="0", $maxPrice="0")
	{
		try{
		if($this->input->post("ads")<> null && trim($this->input->post("ads"))<>"")
			$keywords=($this->input->post("ads"));
		if($this->input->post("category")<>'' && $this->input->post("category")<>0)
			$catID=$this->input->post("category");
		//$_POST["category"];
		//if(!isset($this->input->post("location")) or empty($this->input->post("location")) )
		//	$locID="";
		//else 
		if($this->input->post("location")<>'' && $this->input->post("location")<>0)
			$locID=$this->input->post("location");
		if($this->input->post("sortByPrice")<>'' && $this->input->post("sortByPrice")<>'0')
			$sortByID=$this->input->post("sortByPrice");
		
		$data["sortByID_"]=$sortByID;
		//$catID=$this->input->post('search-category');
		//$locID=$this->input->post('id-location');
// 		echo $keywords;
// 		echo $catID;
// 		echo $locID;
// 		var_dump($_POST);
		
		$searchhistory['keyword']=$keywords;
		$searchhistory['catID']=$catID;
		$searchhistory['locID']=$locID;
		$searchhistory['ip']=$_SERVER['REMOTE_ADDR'];
		//print_r($this->nativesession->userdata);
		$searchhistory['session_id']=$this->nativesession->userdata('session_id');
                date_default_timezone_set('Asia/Hong_Kong');
                $date = date('Y-m-d h:i:s a', time());
		$searchhistory['viewtime']=$date;
		$searchhistory["minPrice"]=$minPrice;
		$searchhistory["maxPrice"]=$maxPrice;
		
		$userInfo=$this->nativesession->get("user");
		if(!empty($userInfo))
			$searchhistory["userID"]=$userInfo["userID"];
		$ip='';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$searchhistory['ip']=$ip;
		$searchhistory['cookies_id']=$_COOKIE['gt_cookie_id']!='' ? $_COOKIE['gt_cookie_id'] : 'Guest';
		
		$this->searchhistory_model->insert($searchhistory);
		
		
		//var_dump($this->input);
		} catch(Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
		$data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["Home"] = $this->lang->line("Home");
            $data["About_us"] = $this->lang->line("About_us");
            $data["Terms_and_Conditions"] = $this->lang->line("Terms_and_Conditions");
            $data["Privacy_Policy"] = $this->lang->line("Privacy_Policy");
            $data["Contact_us"] = $this->lang->line("Contact_us");
            $data["FAQ"] = $this->lang->line("FAQ");
            $data["Index_Footer1"] = $this->lang->line("Index_Footer1");
            $data["Call_Now"] = $this->lang->line("Call_Now");
            $data["Tel"] = $this->lang->line("Tel");
          
			$data["Login"]=$this->lang->line("Login");;
			$data["Signup"]=$this->lang->line("Signup");
			$data["Profile"]=$this->lang->line("Profile");
			$data["Logout"]=$this->lang->line("Logout");
			$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
		  
		 $data['lang_label']=$this->nativesession->get('language');
        $data['pageNum']=$pageNum;
		$selectCategory=$catID;
		$data['result']=null;
		$data["catID_"]=$catID;
		$data["locID_"]=$locID;
		if($keywords=='0')
			$data['keywords']='0';
		else
		$data['keywords']=($keywords);
		
		$query=$this->category_model->getParentCategory();
		if (!is_null($query)) {
			foreach($query as $row)
			{
				$result1=array($row->categoryID => array($row));
				$result2=$this->getChildCategory($row->categoryID);
				if(!is_null($result2))
						if(is_null($data['result']))
							$data['result']=$result1+$result2;
						else
							$data['result']=$data['result']+$result1+$result2;
					else 
					{
						if(is_null($data['result']))
							$data['result']=$result1;
						else
							$data['result']=$data['result']+$result1;
					}
			}
		}
	$data['resLoc']=null;
		$queryLoc=$this->location_model->getParentLocation();
		if (!is_null($queryLoc)) {
			foreach($queryLoc as $row)
			{
				$resLoc1=array($row->locationID => array($row));
				$resLoc2=$this->getChildLocation($row->locationID);
				if(!is_null($resLoc2))
						if(is_null($data['resLoc']))
							$data['resLoc']=$resLoc1+$resLoc2;
						else
							$data['resLoc']=$data['resLoc']+$resLoc1+$resLoc2;
					else 
					{
						if(is_null($data['resLoc']))
							$data['resLoc']=$resLoc1;
						else
							$data['resLoc']=$data['resLoc']+$resLoc1;
					}
			}
		}
		$NoOfItemCount=0;
		if(strcmp($keywords,'0')==0 )
			$keywords='';
		
		$data["minPrice"]=$minPrice;
		$data["maxPrice"]=$maxPrice;
		$data['itemList']=$this->searchresult_model->getItemList($pageNum,0, $catID, $locID, $keywords, $sortByID, $minPrice, $maxPrice);
		$NoOfItemCount=$this->searchresult_model->getNoOfItemCount(0, $catID, $locID, $keywords, $minPrice, $maxPrice);
	 	$data["NoOfItemCount"]=$NoOfItemCount;
					
	 			
					
		$data["lblAllCategories"]=$this->lang->line("lblAllCategories");
	 	$data["lblAllLocations"]=$this->lang->line("lblAllLocations");
	 	$data["lblSearchSortBy"]=$this->lang->line("lblSearchSortBy");
	 	$data["lblPriceLowToHigh"]=$this->lang->line("lblPriceLowToHigh");
	 	$data["lblPriceHighToLow"]=$this->lang->line("lblPriceHighToLow");
	 	$data["lblLocation"]=$this->lang->line("lblLocation");
	 	$data["lblPriceRange"]=$this->lang->line("lblPriceRange");
	 	$data["lblPaymentOptions"]=$this->lang->line("lblPaymentOptions");
	 	
		$this->load->view('category.php', $data);
	}
	
	public function getChildLocation($parentID)
	{
		$result=null;
		$queryLoc=$this->location_model->getChildLocation($parentID);
		if(!is_null($queryLoc))
		{
			foreach($queryLoc as $row)
				{
					$result1=array($row->locationID => array($row));
					$result2=$this->getChildLocation($row->locationID);
					if(!is_null($result2))
						if(is_null($result))
							$result=$result1+$result2;
						else
							$result=$result+$result1+$result2;
					else 
					{
						if(is_null($result))
							$result=$result1;
						else
							$result=$result+$result1;
					}
				}
		}
		else 
		{
			return NULL;			
		}
		return $result;	
	}
	public function getChildCategory($parentID)
	{
		$result=null;
		$query=$this->category_model->getChildCategory($parentID);
		if(!is_null($query))
		{
			foreach($query as $row)
				{
					$result1=array($row->categoryID => array($row));
					$result2=$this->getChildCategory($row->categoryID);
					if(!is_null($result2))
						if(is_null($result))
							$result=$result1+$result2;
						else
							$result=$result+$result1+$result2;
					else 
					{
						if(is_null($result))
							$result=$result1;
						else
							$result=$result+$result1;
					}
				}
		}
		else 
		{
			return NULL;			
		}
		return $result;	
	}
}
?>