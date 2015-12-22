<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cap extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('users_model', 'user');
   }
  public function index() {
      /*
    $captchaConfig = array(  // Captcha parameters:
    'CaptchaId' => 'ExampleCaptcha', // a unique Id for the Captcha instance
    'UserInputId' => 'CaptchaCode' // Id of the Captcha code input textbox
	  );
	  // load the BotDetect Captcha library
	  $this->load->library('botdetect/BotDetectCaptcha', $captchaConfig);
	  
	  // make Captcha Html accessible to View code
	  $data['captchaHtml'] = $this->botdetectcaptcha->Html();
    $this->load->view("cap", $data);*/
      $this->load->view("cap");
  }
  /*
  public function validation()
	{
		$captchaConfig = array(  // Captcha parameters:
    'CaptchaId' => 'ExampleCaptcha', // a unique Id for the Captcha instance
    'UserInputId' => 'CaptchaCode' // Id of the Captcha code input textbox
	  );
		$this->load->library('botdetect/BotDetectCaptcha', $captchaConfig);
		if ($_POST) {
			// validate the user-entered Captcha code when the form is submitted
			$code = $this->input->post('CaptchaCode');
			$isHuman = $this->botdetectcaptcha->Validate($code);

			if ($isHuman) {
				// Captcha validation passed
				$data['captchaValidationMessage'] = 'CAPTCHA validation passed, human visitor confirmed!';
				// TODO: continue with form processing, knowing the submission was made by a human
				 echo '<h2>SUCCESS</h2>';
			} else {
				// Captcha validation failed, return an error message
				$data['captchaValidationMessage'] = 'CAPTCHA validation failed, please try again.';
				 echo '<h2>You are spammer ! Get the @$%K out</h2>';
			}
		}
	}*/
  
	public function validation()
	{
		$email;$comment;$captcha;
        if(isset($_POST['email'])){
          $email=$_POST['email'];
        }if(isset($_POST['comment'])){
          $email=$_POST['comment'];
        }if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
		 $fields = array(
        'secret'    =>  "6Le4uAYTAAAAAJiVej5-dLhS_PRCRF0pzgWvQekf",
        'response'  =>  $captcha,
        'remoteip'  =>  $_SERVER['REMOTE_ADDR']
		);
		//$ch = curl_init("https://www.google.com/recaptcha/api/siteverify");
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
		//$response = json_decode(curl_exec($ch));
		//curl_close($ch);
		$postvars = '';
		foreach($fields as $key=>$value) {
			$postvars .= $key . "=" . $value . "&";
		}
		$ch = curl_init();
		$url = "https://www.google.com/recaptcha/api/siteverify?";
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
		curl_setopt($ch,CURLOPT_TIMEOUT, 20);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		print "curl response is:" . $response;
		echo "Curl Error :--" . curl_error($ch);
		curl_close ($ch);
		
		
		$result = json_decode($response,true);
		//$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=YOUR SECRET KEY&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        //$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le4uAYTAAAAAJiVej5-dLhS_PRCRF0pzgWvQekf&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		//echo "?secret=6Le4uAYTAAAAAJiVej5-dLhS_PRCRF0pzgWvQekf";
		//echo "&response=".$captcha;
		//echo "&remoteip=".$_SERVER['REMOTE_ADDR'];
		//echo "RESULT!!!!!!!!!!!!!!!!!".$result;
		print_r($result);
		echo "a!!!!!!!!!!!!!!!!!".$response;
		//echo "CH!!!!!!!!!!!!!!!!!".$ch;
		
        if($result['success'] == false)
        {
          echo '<h2>You are spammer ! Get the @$%K out</h2>';
        }else
        {
          echo '<h2>Thanks for posting comment.</h2>';
        }
	}
	
}
?>