<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class processError extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library("nativesession");
		
		$this->load->helper('url');
		$this->load->database();
		//$this->load->model('users_model');
                $this->load->model('post_model', 'post');
                $this->load->model('picture_model', 'picture');
                $this->load->model('category_model', 'cat');
                
	}
        
        public function index()
	{
 $data["lang_label"] = $this->session->userdata("language");
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
		            
            $this->nativesession->set("lastPageVisited","processError");
            $this->load->view('system-error', $data);
	}
}