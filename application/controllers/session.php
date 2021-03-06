<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class session extends CI_Controller {
    	
    	var $data;
	public function __construct()
	{
		parent::__construct();
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
		$data["HeaderSearch"]=$this->lang->line("HeaderSearch");
		$data["Logout"]=$this->lang->line("Logout");
		$data["Post_New_Ads"]=$this->lang->line("Post_New_Ads");
	
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('users_model');
		$this->load->model('post_model', 'post');
		date_default_timezone_set("Asia/Hong_Kong");
               
	}
	public function index()
	{
		$usr = $this->session->userdata('user');
		print_r($usr);
    }
	}
?>