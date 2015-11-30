<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class viewItem extends CI_Controller {
    	
 	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		
		
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('users_model');
                $this->load->model('post_model', 'post');
                $this->load->model('requestpost_model');
                $this->load->model('postviewhistory_model');
                $this->load->helper('language');
                date_default_timezone_set("Asia/Hong_Kong");
                $this->load->model('userinfo_model', 'userInfo');
                $this->load->model('useremail_model', 'userEmail');
                
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
               
	}
	public function index($postId, $errorMsg='', $successMsg='')
	{
		$loginUser=$this->nativesession->get("user");
			
		try {
 	      $data["lang_label_text"] = $this->lang->line("lang_label_text");
		$data["lang_label"] = $this->nativesession->get("language");
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
			
             $data["lang_label"]=$this->nativesession->get("language");
         $var = $this->getPost($postId);
            $data["postID"]=$postId;
            if($var == null)
            {
                $this->nativesession->set("lastPageVisited","processError");
                $this->load->view('system-error', $data);
            }else
            {
            	
                //echo $var['postID'];
                $user = $this->users_model->get_user_by_id($var[0]->userID);
                $pic = $this->post->get_picture_by_postID($var[0]->postID);
                $category = $this->post->get_category_by_categoryID($var[0]->catID);
                $parentCategory=$this->post->get_category_by_categoryID($category[0]->parentID);
                $location = $this->post->get_location_by_locationID($var[0]->locID);

                $this->nativesession->set("lastPageVisited","item");
              $prevUrl="";
                if(isset($_GET["prevURL"])) {
                	$prevUrl=$_GET["prevURL"];
                	$_SESSION["previousUrl"]=$prevUrl;
                }
                else if(isset($_SESSION["previousUrl"]))
                	$prevUrl=$_SESSION["previousUrl"];
                
                $data["previousCurrent_url"] = urldecode($prevUrl);
                if($parentCategory!=null){
                $data["ParentCatID"] = $parentCategory[0]->categoryID;
                $data["ParentCatName"] = $data["lang_label"]<>"english" ? $parentCategory[0]->nameCH : $parentCategory[0]->name;
                }else{
                	$data["ParentCatID"] =$category[0]->categoryID;
                	$data["ParentCatName"] = $data["lang_label"]<>"english" ? $category[0]->nameCH : $category[0]->name;    	
                }
                $data["ChildCatID"] = $category[0]->categoryID;
                $data["ChildCatName"] = $data["lang_label"]<>"english" ? $category[0]->nameCH : $category[0]->name;
                $data["itemName"] = $data["lang_label"]<>"english" ? $var[0]->itemNameCH : $var[0]->itemName;
                $data["createDate"] = $var[0]->createDate;
                $data["currency"] = $var[0]->currency;
                $data["price"] = $var[0]->itemPrice;
                $data["AdsProduct"] = array($var[0]->postID => $pic);
                $data["itemDesc"] = $var[0]->description;
                $data["itemTitle"]=$var[0]->itemName;
                if ($var[0]->locID>0)
                	$data["LocationName"] = $data["lang_label"]<>"english" ? $location[0]->nameCN : $location[0]->name;
                else 
                	$data["LocationName"]="";
                 $data["userName"] = $user[0]->username;
                $data["userID"] = $user[0]->userID;
                $userCreateDate = $user[0]->createDate;
                $data["userCreateDate"]=$userCreateDate;
                $date=$user[0]->lastLoginTime;
                $data["lastLoginTime"]=$date; //->format('Y-m-d H:i:s');
                $data["errorMsg"]=array("success1"=> ($successMsg), "error"=> ($errorMsg));
                
                $userInfo=$this->userInfo->getUserInfoByUserID($data["userID"] );
                print_r($userInfo);
                $email=$this->userEmail->getUserEmailByUserID($data["userID"] );
                print_r($email);
                if(isset($userInfo))
                {
                	$data["lastName"]=$userInfo["lastName"];
                	$data["firstName"]=$userInfo["firstName"];
                	$data["phoneNo"]=$userInfo["phoneNo"];
                	$data["telNo"]=$userInfo["telNo"];
                }
                $data["email"]=$email["email"];
                
                
                $isSameUser=false;
                $isPostAlready=false;
                $isPendingRequest=true;
              	if(!empty($loginUser) and isset($loginUser) and $loginUser<>null and $loginUser["userID"]<>0)
                {
                	if($loginUser["userID"]==$user[0]->userID)
                		$isSameUser=true;
                	$isPostAlready=$this->requestpost_model->getfUserIDAndPostID($var[0]->postID, $loginUser["userID"], "U");
                	$isPendingRequest=$this->requestpost_model->getfUserIDAndPostID($var[0]->postID, $loginUser["userID"], "");
                }
                $data["isSameUser"]=$isSameUser;
 
                $data["isPostAlready"]=$isPostAlready;
                $data["isPendingRequest"]=$isPendingRequest;
                $thread["postID"]=$postId;
                if(!empty($loginUser) and isset($loginUser) and $loginUser<>null and $loginUser["userID"]<>0)
                {
                	$thread["userID"]=$loginUser["userID"];
                }
                $thread["ip"]=$_SERVER['REMOTE_ADDR'];
                date_default_timezone_set('Asia/Hong_Kong');
      		   $thread["viewTime"]=$date;
                $thread['session_id']=$this->nativesession->userdata('session_id');
                $this->postviewhistory_model->insert($thread);
                
            } 
		
          //var_dump($data);
           //$postInfo=$this->post->getPostByPostID($postId);
            //echo "Checking line 156:";
           // var_dump($postInfo);
            //echo $postInfo[0]->postID;
            //if(isset($var)){
            	if  ( (strcmp($var[0]->status,"U")!=0 &&  strcmp($var[0]->status,"R")!=0
            			&&  strcmp($var[0]->status,"D")!=0)
            			|| strcmp($loginUser["username"],"admin")==0)
            	{
            	    $this->load->view('item', $data);
     	     	}else {
     	     		
     	     		$errorMsg=$this->lang->line("PostNotExistsNow");
     	     		$data["error"]=$errorMsg;
     	     		$data["prevURL"]=base_url();
     	     		$data['redirectToWhatPage']="Home Page";
     	     		$data['redirectToPHP']=base_url();
     	     		$data["successTile"]=$this->lang->line("successTile");
     	     		$data["failedTitle"]=$this->lang->line("failedTitle");
     	     		$data["goToHomePage"]=$this->lang->line("goToHomePage");
     	     		$this->load->view('failedPage', $data);
     	     		return;
     	     	}
            //}
     	     	
     	     	}catch(Exception $e)
     	     	{
     	     		echo 'Caught exception: ',  $e->getMessage(), "\n";
     	     		 
     	     	}
		}
		
    
    
        public function getPost($postId)
        {
            return $this->post->getPostByID($postId);
        }
    }
?>