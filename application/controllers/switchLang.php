<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class switchLang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		
                //The first parameter to the lang->load() method will be the language� 
                //filename without the _lang suffix. The second paramter, which is optional, is the language directory. 
                $this->load->helper('url');
      	//$this->load->helper('url');
		//$this->load->database();
		//$this->load->model('users_model');
	}
	public function changeLang()
	{
            $data["lang_label"] = $this->nativesession->get("language");
            if($this->nativesession->get('language')){
            	
            	try{
            	    if($this->nativesession->get('language') == "english")
	                {
	                    $this->nativesession->set("language","chinese");
	                }else
	                {
	                    $this->nativesession->set("language","english");
	                }
            	}catch(Exception $ex)
            	{
            		log_message('debug', $ex->getMessage());	
            	}
            }else{
            	log_message('debug', 'not lang session');
                $this->nativesession->set("language","chinese");
            }
            $data = array("STATUS"=>"true");
            //echo "HI";
            echo json_encode($data) ;	
	}
	
public function changeLang_R1($selfPath='')
	{
            log_message('debug', 'INSIDE@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@');
            //echo "test";
            $data["lang_label"] = $this->nativesession->get("language");
            if($this->nativesession->get('language')){
                if($this->nativesession->get('language') == "english")
                {
                    $this->nativesession->set("language","chinese");
                }else
                {
                    $this->nativesession->set("language","english");
                }
            }else{
                $this->nativesession->set("language","chinese");
            }
            $data = array("STATUS"=>"true");
            //echo "HI";
            if(strcmp($selfPath,'')==0)
            	$selfPath=base_url();
            redirect(urldecode($selfPath));	
            
	}
	
	public function index(){
            echo "HI";
        }   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */