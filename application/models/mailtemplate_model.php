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
			return "A new buyer is interested in your post";
		}
		public function SendEmailMsgForDirectSendToSeller($username, $path, $title){
			return  $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br />
				  You have received a buyer request on your item ( '.$title.' ). <br/>
You may approve or reject the request by clicking on "Buyer List" under following link:
( <a href='.$path.'> Approve or Reject</a> ) <br/>
Once approved, this buyer will be able to view your contact information and contact you directly.
<br/>
If you experience any difficulties accessing the link, simply access your profile to view your messages.  
**To disable this email notification, please go to your profile page.<br/>
                  		
                
                  </td>
              </tr>
 				<tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  您好 '.$username.',<br />
                  		
                  		
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
		
		public function SendEmailTitleForDirectSendApproveFromSeller($title){
			return "Contact info for: ( ".$title. " ) ";
		}
		
		public function SendEmailMsgForDirectSendApproveFromSeller($username, $path, $title){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br />
		
              The owner of the post ( '.$title.' ) would like to share his/her \'s contact information with you.
				You may view seller\'s contact information using the link below:
				( '.$path.' )
				<br/>
				If you experience any difficulties accessing the link, simply access your profile to view your messages.  
				**To disable this email notification, please go to your profile page.

                  </td>
              </tr>
            </table></td>
        </tr> '.$this->footer;
				
		
		}
		
		public function SendEmailTitleForDirectSendRejectFromSeller($title){
			return "Your contact seller request of post (".$title.") has been rejected";
		}
		
		public function SendEmailMsgForDirectSendRejectFromSeller($username, $path, $title){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br />
		
				Unfortunately, the owner of the post ( '.$title.' ) has refused to give you his/her contact information.
				<br/>

If you experience any difficulties accessing the link, simply access your profile to view your messages.  
**To disable this email notification, please go to your profile page.

                  		
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
			return "Reset Your Girlstrade Account Password";
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
					<br/>Your password is '.$password.'.
					<br/>Please click the link below to login and change your password.
					<br/><a href="http://www.girlstrade.com/home/loginPage">login</a>
                  </td>
              </tr>
				<tr>
	                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
	                  您好 '.$username.',<br />
						你剛才重罝了你的密碼.
						<br/>你的新密碼是 '.$password.'.
						<br/>請按以下網址去登入和更改密碼:
						<br/><a href="http://www.girlstrade.com/home/loginPage">登入</a>
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
					Please click the link below and verify that the email address you registered belongs to you.
				  	<br />
				  <strong><a href="'.$path.'" target="_blank" style="color:#1f4f82; text-decoration:underline; font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left"><h1>Verify</h1></a></strong> <br>
                  <br />
				  *If the link above does not work, copy and paste the address below into a new browser window.	
				  		<br />'.$path.'
                 If you are still unable to verify your email address. 
				Please contact us and we will get back to you within the next 24 hours. 
				  				</td>
              </tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
               		您好 '.$username.',<br /><br />
				  
				  				你使用了這個電郵地址註冊GirlsTrade帳戶:'.$email.'<br>
				  				請按以下網址確認你的電郵.<br/>
				  				<strong><a href="'.$path.'" target="_blank" style="color:#1f4f82; text-decoration:underline; font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left"><h1>核實賬戶</h1></a></strong> <br>
				  					
				  						*如果以上網址有問題,請複製以下網址到瀏覽器:<br>'.$path.'
									
									<br/>	假如你的核實賬戶過程有任何問題,
									<br/>	請聯繫我們(一天之內答覆)
				  </td>
				 </tr>
				  				
				  				
				  				
				  				
            </table></td>
        </tr>'.$this->footer;
		}
		
		public function SendEmailRejectPost( $username, $rejectReason ,$rejectSpecifiedReason, $title){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br /><br />
				  		
<br/>
Unfortunately, You post ('.$title.') has been rejected!
You may view the reason of your rejected ad using the following link:
(Link to approve or reject page)
<br/>
If you experience any difficulties accessing the link, simply access your profile to view your messages.  
**To disable this email notification, please go to your profile page.
                  		</td>
              </tr>
            </table></td>
        </tr>'.$this->footer;

		}
		
		public function SendEmailRejectPostTitle($title){
			return "Your Ad (".$title.") has been rejected.";
		}
		
		public function SendEmailApprovePost($username, $title){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br /><br />
You post ('.$title.') has been approved!
You may view your item using the following link:
(Link to approve or reject page)
                  		
<br/>
If you experience any difficulties accessing the link, simply access your profile to view your messages.  
**To disable this email notification, please go to your profile page.


                  		</td>
              </tr>
            </table></td>
        </tr>'.$this->footer;

		}
		
		public function SendEmailApprovePostTitle($title){
			return "( ".$title." ) has been approved!";
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
		public function SendEmailMsgForResetPassword($path, $username){
			return $this->header.'
        <tr>
          <td valign="top" align="left" style="padding-left:25px; padding-right:25px; padding-bottom:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  Dear '.$username.',<br /><br />
					Someone recently asked to reset your GirlsTrade password.
					Please click the link <a href='.$path.'>here</a> to proceed to change your password.
							</br>
						If you have not requested, please ignore this email.
				 </td>
              </tr>
			 <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; padding-right:25px; padding-top:20px;" valign="top" align="left" >
                  您好 '.$username.',<br /><br />
						最近, 有人要求更改你的GirlsTrade密碼.
						請按這<a href='.$path.'>連結</a>這裡要求傳送新密碼到的電郵; 
						<br/>假如你沒有要求更改你的密碼，請忽略此電郵。
						
                  </td>
              </tr>
            </table></td>
        </tr>'.$this->footer;
			
			
			
		}
		public function SendEmailTitleForResetPassword(){
			return "Somebody requested a new password for your GirlsTrade account";
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