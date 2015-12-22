<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SessionData{
    var $CI;

    function __construct(){
        $this->CI =& get_instance();
        
    }

    function initializeData() {
          // This function will run after the constructor for the controller is ran
          // Set any initial values here
          if(!$this->CI->session->userdata("language")){
             $this->CI->session->set_userdata("language", "english");
          }
          
    }
}
?>