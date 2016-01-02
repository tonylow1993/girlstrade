<?php $title = "Girls' Trading Platform";  include("header.php"); echo $captchaJS;?>

<div id="wrapper">
  
  <!-- /.header -->
  
  <div class="intro-inner">
    <div class="contact-intro">
      <div class="w100 map">
      	<iframe src="https://www.google.com/maps/embed/v1/view?zoom=10&center=22.3964,114.1095&key=AIzaSyBvyKconGiUUPVREo1Gyvr0SYtrGdF775M" width="100%" height="350" frameborder="0" style="border:0"></iframe>
      
      </div>
    </div>
  </div>
  <!-- /.intro-inner -->
    <div class="main-container">
    <div class="container">
      <div class="row clearfix">
          <div class="col-md-4">
              <div class="contact_info">
                 <h5 class="list-title gray"><strong>Contact info</strong></h5>
                   
                     <div class="contact-info ">
                          <div class="address">
<!--                             <p class="p1">220 Fifth Ave</p> -->
<!--                             <p class="p1">2nd Flr. New York, NY 10001  </p> -->
                            <p>Email: contactus@girlstrade.com</p>
<!--                             <p>Toll Free: 212-633-1405</p> -->
                            <p>&nbsp;</p>
<!--                             <div> -->
                            
<!--                               <p><strong><a href="#">Get a Quote</a></strong></p> -->
<!--                                <p><strong> <a href="login.html">Client Area Login</a></strong></p> -->
<!--                                <p><strong> <a href="#skypeid" class="skype">Live Chat</a></strong></p> -->
<!--                               <p> <strong> <a href="faq.html">Knowledge Base</a></strong></p> -->
                              
<!--                               </div> -->
                          </div>
                        </div>
                    
              <div class="social-list"><a target="_blank" href="https://twitter.com/"><i  class="fa fa-twitter fa-lg "></i></a>
<a target="_blank" href="https://www.facebook.com/"><i  class="fa fa-facebook fa-lg "></i></a>
<a target="_blank" href="https://plus.google.com"><i  class="fa fa-google-plus fa-lg "></i></a>
<a target="_blank" href="https://www.pinterest.com/"><i  class="fa fa-pinterest fa-lg "></i></a></div>
              </div>
          </div>
          <div class="col-md-8">
                <div class="contact-form">
                                            <h5 class="list-title gray"><strong>Contact us</strong></h5>

             
                     <form name="contactForm" id="contactForm" class="form-horizontal" method="post" onSubmit="return contactAction()"
                     action="<?php echo base_url(); echo MY_PATH;?>contactUsSubmission">
                    <fieldset>
						<div class="row">
                            <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="name" name="name" type="text" placeholder="Name" class="form-control" required="true"
                                    maxlength="15">
                                </div>
                            </div>
                            </div>
                            
                             <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="number" name="number" type="text" placeholder="HK Phone Number"
                                    type="tel"   class="form-control "   
         							type="text" required="true"  maxlength="8" pattern="(?!99999999)\d{8}">
                                </div>
                            </div>
                            </div>
                            
                             <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="email" name="email" type="email" placeholder="Email Address" class="form-control ">
                                </div>
                            </div>
                            </div>
                            
                             <div class="col-sm-6">
                            <div class="form-group">
                            <div class="col-md-12">
                                <select name="category-group" id="category-group" class="form-control contactSelect" required="true">
                                  <option value="general" style="background-color:#E9E9E9;font-weight:bold;"> - General - </option>
                                  <?php /*
						            foreach ($result as $id=>$value)
						            {
						            	if(!isset($lang_label))
							            		$lang_label="";
						            	$name=$value[0]->name;
						            	if($lang_label<>"english")
						            		$name=$value[0]->nameCH;
						            	if($value[0]->level==1)
						            		echo "<option value=\"$id\" style=\"background-color:#E9E9E9;font-weight:bold;\" > - $name - </option>";
						            	else 
						            		echo "<option value=\"$id\"> $name </option>";
						            	}*/
						            ?>
                              </select>
                            </div>
                        </div>
                            </div>
                            
                            
                            
                       <div class="col-lg-12">
                            <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="form-control" id="contactUsMessage" name="message" 
                                placeholder="Enter your message here. We will get back to you within 2 business days." rows="7" maxlength="650"></textarea>
								<div id="contactUsMessageError" class="center"> </div>                            
                            </div> 
                        </div>
                        <div class="form-group">
                        <div class="col-md-12">
                        <div class="g-recaptcha" 
                            data-sitekey="6Lec9AYTAAAAAJC-W5gWsKM9QqxAoDweD_qPeB88"
           					data-type="image"></div>
							<noscript>
							  <div style="width: 302px; height: 352px;">
								<div style="width: 302px; height: 352px; position: relative;">
								  <div style="width: 302px; height: 352px; position: absolute;">
									<iframe src="https://www.google.com/recaptcha/api/fallback?k=6Lec9AYTAAAAAJC-W5gWsKM9QqxAoDweD_qPeB88"
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
							<div id="captchaError" class="center"></div>     
                            
                        
                        
                        
                        </div>
                        </div> 
                            
                            <div class="form-group">
                            <div class="col-md-12 ">
                                <button type="submit" onclick="contactAction(); return false;" class="btn btn-primary btn-pink">Submit</button>
                            	<input type="submit" style="display:none" name="submitButton">
                            </div>
                        	</div>
                        
                        
                        </div>
                        
                        </div>

                        
                    </fieldset>
                </form>
                    </div>
          </div>
      </div>
    </div>
  </div>
  <!-- /.main-container -->
  <div class="intro-inner-banner">
   <!--=== Collection Banner ===-->
    <div class="collection-banner">
        <div class="container">
            <div class="col-md-7 md-margin-bottom-50">
                <h2>Work Together</h2>
                <p>Get in touch to see how our service can help you. <br> Another way to deliever your business.</p><br>
                <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Let's Start</a>
            </div>
        </div>
    </div>
    <!--=== End Collection Banner ===-->
  </div>
  
  <?php include "footer1.php"; ?>
  <script type="text/javascript">
  function contactAction()
  {
	  var $contactForm = $('#contactForm');
	  if (!$contactForm[0].checkValidity()) {
		  //$contactForm.find(':submit').click();
		  document.contactForm.submitButton.click();
		  return;
	  }
  	var recaptcha = $("#g-recaptcha-response").val();
   	var isValid=true;
      if(recaptcha == ""){
  		event.preventDefault();
          $('#captchaError').html("<em><span style=\"color:red\"> <i class=\"icon-cancel-1 fa\"></i> Please check the recaptcha </span></em>");
          isValid= false;
      } else
      {
      	$('#captchaError').html('');
      }

      if(!$.trim($("#contactUsMessage").val())) {
      	$("#contactUsMessageError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Please fill in the message box</span></em>');
      	isValid= false;
      }
      else
      {
      	$('#contactUsMessageError').html('');
      }
  	

   	if(!isValid){
        return false;
  	}else
  	{			
  		document.getElementById("contactForm").submit();
  	}
  }
  </script>
  <!-- /.footer --> 
</div>
<?php include "footer2.php"; ?>
