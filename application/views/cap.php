<!DOCTYPE html>
<html lang="en">
  <head>
    <title>How to Integrate Google ��No CAPTCHA reCAPTCHA�� on Your Website</title>
	
    <!--js-->
    <script src='https://www.google.com/recaptcha/api.js?hl=zh-TW'></script>
	<!--<link type="text/css" rel="Stylesheet" href="<?php //echo CaptchaUrls::LayoutStylesheetUrl() ?>" />-->
  </head>
 
  <body>
 
    <form action="cap/validation" method="post">
 
      <label for="name">Name:</label>
      <input name="name" required><br />
 
      <label for="email">Email:</label>
      <input name="email" type="email" required><br />
	
      <div class="g-recaptcha" data-sitekey="6Le4uAYTAAAAAF21mGeouq5Okm7gaLuAu31pKGLc"
           data-type="image"></div>
		<noscript>
		  <div style="width: 302px; height: 352px;">
			<div style="width: 302px; height: 352px; position: relative;">
			  <div style="width: 302px; height: 352px; position: absolute;">
				<iframe src="https://www.google.com/recaptcha/api/fallback?k=your_site_key"
						frameborder="0" scrolling="no"
						style="width: 302px; height:352px; border-style: none;">
				</iframe>
			  </div>
			  <div style="width: 250px; height: 80px; position: absolute; border-style: none;
						  bottom: 21px; left: 25px; margin: 0px; padding: 0px; right: 25px;">
				<textarea id="g-recaptcha-response" name="g-recaptcha-response"
						  class="g-recaptcha-response"
						  style="width: 250px; height: 80px; border: 1px solid #c1c1c1;
								 margin: 0px; padding: 0px; resize: none;" value="">
				</textarea>
			  </div>
			</div>
		  </div>
		</noscript>
	<!--
	<?php //echo $captchaHtml; ?>
	<input type="text" name="CaptchaCode" id="CaptchaCode" value="" />
        -->
 
 
      <input type="submit" value="Submit" />
 
    </form>
 
 
  </body>
</html>