<?php 
 class mailtemplate_model  extends CI_Model {
		
		var $header='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Girlstrade buyer has sent you a new message</title>
</head>
<body>
<table width="614" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td style="border-bottom:1px solid #c0c0c0;" valign="top" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td valign="top" align="left"  style="padding-left:21px;"><a href="http://www.girlstrade.com" target="_blank"><img src="http://www.girlstrade.com/email_images/email_logo.jpg" alt="Oracle Corporation" width="123" height="30"  border="0"></a></td>
        </tr>
        <tr>
          <td valign="top" align="left"><a href="http://www.girlstrade.com" target="_blank" style="color:#1f4f82; text-decoration:underline; font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left"><img src="http://www.girlstrade.com/email_images/email_banner.jpg" alt="Oracle Applications Together with Oracle Systems" width="612" height="210" border="0" style="display:block;"></a></td>
        </tr>';
		
		var $footer=' <tr>
          <td valign="top" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0">
              <tr>
                <td height="25"><font face="Arial, Helvetica, sans-serif" size="1" color="#000000">Copyright &copy; 2015 Girlstrade.<br>  
                  All rights reserved.</font></td>
                <td align="right"><font face="Arial, Helvetica, sans-serif" size="1" color="#000000"> 
                  		<a href="http://www.girlstrade.com/index.php/footer/getPrivacy" target="_blank"><font color="#FF00FF" size="1" face="Arial, Helvetica, sans-serif"><u>Privacy Policy</u></font></a> |
                  		<a href="http://www.girlstrade.com/index.php/footer/getContactUS" target="_blank"><font color="#FF00FF" size="1" face="Arial, Helvetica, sans-serif"><u>Contact us</u></font></a></font></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="614" align="center"><tr><td><font face="Arial, Helvetica, sans-serif" size="1">
Unfortunately, we are unable to respond to inquiries sent to this address.<br />
To get help, simply visit our Contact Page by clicking “Contact Us” at the bottom of any Girlstrade page.<br />(Users are advised to read all the terms and conditions carefully.)<br />
</table>
</body>
</html>';
		function __construct()
		{
			parent::__construct();
		}
		
		public function SendEmailTitleForDirectSendToSeller(){
			return "You have got the direct send msg from buyer";
		}
		public function SendEmailMsgForDirectSendToSeller($username, $path){
			return  $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br />
				  
                 <br/>You have received a message from a Girlstrade seller which has been delivered to your Girlstrade inbox
<br/>To access your message, please click <a href='.$path.'>here</a> to login and view your message.
<br/>If you experience any difficulty using the link, simply access your profile to view your messages.
<br/>You will be notified each time you have a new message.
                  </td>
              </tr>
            </table></td>
        </tr> '.$this->footer;
		}
		
		public function SendEmailTitleForDirectSendApproveOrRejectToSeller(){
			return "You have got the direct send msg approve or reject from buyer";
		}
		
		public function SendEmailMsgForDirectSendApproveOrRejectToSeller($username, $path){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br />
				  
               You have received a message from a Girlstrade seller which has been delivered to your Girlstrade inbox.
<br/> It may be approved or rejected by seller.
<br/>To access your message, please click <a href='.$path.'>here</a> to login and view your request status. Or you can send messages to seller in your wanted  item profile page..
<br/>If you experience any difficulty using the link, simply access your profile to view your messages.
<br/>You will be notified each time you have a new message.";
                  </td>
              </tr>
            </table></td>
        </tr> '.$this->footer;
			

		}
		
		public function SendEmailReplyMsgForSelleOrBuyerr( $username, $path){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br />
				  
                  <br />
				  You have received a message from a Girlstrade buyer which has been delivered to your Girlstrade inbox
				  <br /><br />
				  To access your message, please click 
				  <strong><a href='.$path.' target="_blank" style="color:#1f4f82; text-decoration:underline; font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left">
				  here
				  </a></strong> 
				  to login and view your message. <br />
					If you experience any difficulty using the link, simply access your profile to view your messages.   <br />
					(To unsubscribe email alert, please go to your profile and edit.)
				  <br />
                  </td>
              </tr>
            </table></td>
        </tr> '.$this->footer;
       
		}
		
		public function SendEmailTitleForReplyMsgForSellerOrBuyer(){
			return "Girlstrade buyer/seller  has replied you a new message";
		}
		
		public function SendEmailMsgForHostOfAbuseMsg(){
			return "You have got the abuse message";
		}
		
		public function SendEmailMsgForSeller($username, $path){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br />
				  
                  <br />
				  You have received a message from a Girlstrade buyer which has been delivered to your Girlstrade inbox
				  <br /><br />
				  To access your message, please click 
				  <strong><a href='.$path.' target="_blank" style="color:#1f4f82; text-decoration:underline; font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left">
				  here
				  </a></strong> 
				  to login and view your message. <br />
					If you experience any difficulty using the link, simply access your profile to view your messages.   <br />
					(To unsubscribe email alert, please go to your profile and edit.)
				  <br />
                  </td>
              </tr>
            </table></td>
        </tr>'.$this->footer;
        
		}
		
		public function SendEmailTitleForSeller(){
			return "Girlstrade buyer has sent you a new message";
		}
		

		public function SendEmailMsgForChangePassword($username){
			return  $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br />
				  <br />
				  You have requested that your password have been chnaged. If you have not requested, please check your account now. 
				  </td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  您好 '.$username.',<br />
				  <br />
				  剛才你是否更改girlstrade帳户密碼，如果否，請檢查你的girlstrade帳户。
                  </td>
              </tr>
                  		
            </table></td>
        </tr>'.$this->footer;
		}
		
		public function SendEmailTitleForChangePassword(){
			return "Change Your Girlstrade Account Password";
		}
		
		public function SendEmailTitleForForgotPassword(){
			return "Reset Your GirlsTrade Password";
		}
		
		public function SendEmailMsgForUpdatePassword($username, $password, $username1,
					$path){
			return  $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br />
					You have requested that your password be reset.
					<br/>Your username is '.$username1.'
					<br/>Your password is '.$password.'.
					<br/>Please click the <a href="www.girlstrade.com" >girlstrade home page </a> to login and then change your prefered passwoed in account profile.";
                  </td>
              </tr>
				<tr>
	                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
	                  您好 '.$username.',<br />
						你剛才重罝你的密碼. 新資料是
						<br/>你的密碼是 '.$password.'.
						<br/>你的用户名是 '.$username1.'
						<br/>請按 <a href="www.girlstrade.com" >girlstrade 綱址 </a> 去登入去更改你要的新密碼。";
	                  </td>
	              </tr>
            </table></td>
        </tr>'.$this->footer;
			
		}
		
		public function SendEmailTitleForSignupActivate(){
			return "Activate your GirlsTrade account";
		}
		public function SendEmailMsgForSignupActivate($username,  $path, $email){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br /><br />
				  You have registered for GirlsTrade using the e-mail address: '.$email.'<br />
                  <br /><br />
				  In order to get you fully signed up as a member, we need to confirm your e-mail address.
				  <br />
				  Please click 
                  <strong><a href="'.$path.'" target="_blank" style="color:#1f4f82; text-decoration:underline; font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left"><h1>here</h1></a></strong> to activate your account. <br>
                  <br /> <br />
                  If you are still unable to verify your email address. <br />Please contact us and we will get back to you within the next 24 hours.
                  </td>
              </tr>
            </table></td>
        </tr>'.$this->footer;
		}
		
		public function SendEmailRejectPost( $username, $rejectReason ,$rejectSpecifiedReason){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br /><br />
				  		
<br/>Your post is rejected due to '.$rejectReason.' with '.$rejectSpecifiedReason.'.
<br/>Thank you!";  </td>
              </tr>
            </table></td>
        </tr>'.$this->footer;

		}
		
		public function SendEmailRejectPostTitle(){
			return "Reject your post";
		}
		
		public function SendEmailApprovePost($username){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br /><br />
				  		
<br/>Your post is approved.
<br/>Thank you!";</td>
              </tr>
            </table></td>
        </tr>'.$this->footer;

		}
		
		public function SendEmailApprovePostTitle(){
			return "Approve your post";
		}
		
		public function SendEmailRejectPhoto($username, $rejectReason ,$rejectSpecifiedReason){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br /><br />
<br/>Your photo is rejected due to '.$rejectReason.' with '.$rejectSpecifiedReason.'.
<br/>Thank you!";
                  		</td>
              </tr>
            </table></td>
        </tr>'.$this->footer;
			
	
		}
	
		public function SendEmailRejectPhotoTitle(){
			return "Reject your photo";
		}
		
		public function SendEmailApprovePhoto($username){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br /><br />
<br/>Your photo is approved.
<br/>Thank you!";
                  		</td>
              </tr>
            </table></td>
        </tr>'.$this->footer;

		}
		
		public function SendEmailApprovePhotoTitle(){
			return "Approve your photo";
		}
		public function SendEmailMsgForResetPassword($path){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear Sir/Madam,<br /><br />
					Please click the link <a href='.$path.'>here</a> to send new password to your email;
                  </td>
              </tr>
			 <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  您好 ,<br /><br />
					請按這連結<a href='.$path.'>這裡</a> 要求傳送新密碼到的電郵;
                  </td>
              </tr>
            </table></td>
        </tr>'.$this->footer;
			
			
			
		}
		public function SendEmailTitleForResetPassword(){
			return "Email alert for your reset password";
		}
		public function SendEmailRejectFeedBack(){
			
		}
		public function SendEmailRejectFeedBackTitle(){
				
		}
		public function SendEmailApproveFeedBack(){
				
		}
		public function SendEmailApproveFeedBackTitle(){
				
		}
// 		public function ApproveOrRejectSendEmail(){
// 			return "Send email when approve or reject direct send request";
// 		}
		
// 		public function SendMessageSendEmail(){
// 			return "Send email when buyer send message to seller";
// 		}
// 		public function SendEmailWhenUpdatePassword(){
// 			return "Send email when you update your password";
// 		}
	}
?>