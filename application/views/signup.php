<?php $title = "Girls' Trading Platform";  include("header.php"); echo $captchaJS;?>

<div id="wrapper">
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-8 page-content">
          <div class="inner-box category-content panel-bevel">
          <div class="text-center">
            <h2 class="inner-logo-title"> 
                <!-- Original Logo will be placed here  --> 
                <img width="50px" height="50px" src="<?php echo base_url();?>images/site/girlstrade_logo.png">
                Registration
			</h2>
			</div>
            <div class="row">
              <div class="col-sm-12">
                <form class="form-horizontal" onSubmit="return setup()" name="myForm" action="<?php echo base_url(); echo MY_PATH;?>home/signup" method="post" id="myForm">
                  <fieldset>
                  	<div id="error">
                    </div>
                  
                
                    <div id="usernameDiv" class="form-group required">
                      <label class="col-md-4 control-label" > <?php echo $Username;?> <font color="red">*</font></label>
                      <div class="col-md-6">
                        <input id="username" name="username" placeholder="At least 5 characters" class="form-control input-md" required="true" type="text"/>
                        <div id="usernameAjaxLoad" class="center">
                        <div id="usernameError" hidden="true"></div>
                        </div>
                      </div>
                      
                    </div>
                    
					 <div class="form-group required">
                      <label for="inputPassword3" class="col-md-4 control-label"> <?php echo $Password;?> <font color="red">*</font></label>
                      
                      <div class="col-md-6">
                        <input name="password" type="password" class="form-control" id="inputPassword3" required="true" placeholder="At least 8 characters">
                        <!--<em class="help-block">At least 6 characters</em>-->
						<div id="pwd1V"></div>
                      	<div id="password3AjaxLoad" class="center"></div>
                       </div>
                    </div>
                    
                    <!--<div id="retypeDiv" class="form-group required">
                      <label for="inputPassword4" class="col-md-4 control-label"> <?php echo $ReTypePassword;?> <font color="red">*</font></label>
                      <div class="col-md-6">
                        <input name="retype" type="password" class="form-control" id="inputPassword4" required="true" placeholder="Password">
                        <div id="retypeAjaxLoad" class="center">
                      </div>
                      </div>  
                    </div>-->
					
                    <!-- Text input-->
                    <div id="telDov"  class="form-group required">
                      <label class="col-md-4 control-label" > 
                      <?php echo $PhoneNumber;?> <font color="red">*</font></label>
                      <div class="col-md-6">
                        <input id="telno" name="telno" placeholder="HK Phone Number Only"
         type="tel"   class="form-control input-md"   
         type="text" required="true"  maxlength="8" pattern="(?!99999999)\d{8}">
<!--                         <div class="checkbox"> -->
<!--                           <label> -->
<!--                             <input id="hidetelno" name='hidetelno' type="checkbox" value="Yes"> 
                            <small> <?php echo $HidePhoneNumber;?> </small> </label> -->
<!--                         </div> -->
								<div id="telStatusVal" class="center"></div>
								<div id="telError" hidden="true"></div>
                      </div>
                    </div>
                    
                  
                    <div id="emailDiv" class="form-group required">
                      <label for="inputEmail3" class="col-md-4 control-label"> <?php echo $Email;?> <font color="red">*</font></label>
                      <div class="col-md-6">
                        <input name="email" type="email" class="form-control" id="inputEmail3" required="true" placeholder="Email">
                        <div id="emailAjaxLoad" class="center"></div>
                        <div id="emailError" hidden="true"></div>
                      </div>
                    </div>

                    <div id="retypeDiv" class="form-group required">
                      <label for="inputPassword4" class="col-md-4 control-label"> <?php echo $VerifyCaptcha;?></label>
                      <div class="col-md-6">
                         <div class="g-recaptcha" data-sitekey="6Lec9AYTAAAAAJC-W5gWsKM9QqxAoDweD_qPeB88"
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
					<div id="captchaError" class="center">
                    </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <label  class="col-md-4 control-label"></label>
                      <div class="col-md-8">
                        <div class="termbox mb10">
                          <label class="checkbox-inline" for="checkboxes-1">
                            <input name="checkboxes" id="checkboxes-1" value="1" type="checkbox">
                            I have read and agree to the <a href="terms-conditions.html">Terms & Conditions</a> </label>
                        </div>
                        <div style="clear:both"></div>
                        <input type="submit" id="register" class="btn btn-primary btn-pink" value="Register" disabled="true"/></div>
<!--                    		    <button id="validate" hidden="true" type="submit"></button> -->
                          
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.page-content -->
        <div class="col-md-4 reg-sidebar">
          <div class="reg-sidebar-inner text-center">
            <div class="promo-text-box"> <i class=" icon-pencil-circled fa fa-4x icon-color-4"></i>
              <h3><strong>Manage Items</strong></h3>
              <p> Easily post, edit or delete items. Promote ads and view order status. Provide a way for buyer and seller connect.</p>
            </div>
            <div class="promo-text-box"> <i class=" icon-lock-circled fa fa-4x icon-color-1"></i>
              <h3><strong>Personal Information</strong></h3>
              <p> Personal information will be protected using technical and administrative security. GirlsTrade will never disclose your personal information with any third parties without your express permission.</p>
            </div>
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.main-container -->
  <?php include "footer1.php"; ?>



<script type="text/javascript">
/*
$("#inputEmail3").blur(function() {
	console.log("blur");
	if($( "#inputEmail3" ).val()=="")
	{
	console.log("inside");
	$("#emailAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Email cannot be empty!</span></em>');
    location.href = "#emailAjaxLoad";                 //Go to the target element.
    return false; 
	}
});
*/
$( "#inputEmail3" ).blur(function() {
	$("#emailAjaxLoad").html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>home/validateEmail",
		data: { inputEmail3: $( "#inputEmail3" ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#error").html(result.message);
	    	$("#emailDiv").removeClass('has-success has-error').addClass(result.class);
	    	$("#emailAjaxLoad").html(result.icon);
	    	$("#emailError").html(result.err);
	    	}
	});
});

$( "#telno" ).blur(function() {
	//console.log("BLUR");

	/*
	$("#telStatusVal").html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>home/validateTel",
		data: { telno: $( "#telno" ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#error").html(result.message);
	    	$("#telDiv").removeClass('has-success has-error').addClass(result.class);
	    	$("#telStatusVal").html(result.icon);
	    	$("#telError").html(result.err);
	    	}
	});
	*/
	var str = document.getElementById("telno").value;

	var patt = /^[0-9]{8}$/;
	var res = patt.test(str);
	var temp = '<em><span style="color:green"> <i class="icon-ok-1 fa"></i> Valid Phone Number</span></em>';
	 if(res!=true){
	    temp = '<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Invalid HK Phone Number</span></em>';
	 	$("#telError").html('Error');
	 }else
	 {
	 	$("#telError").html('');
	 }
	$("#telStatusVal").html(temp);
});

$( "#username" ).blur(function() {
	if($("#username").val().length < 5) {
        $("#usernameAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Username must contain at least 5 characters</span></em>');
		//$("#inputPassword3").focus();
        return false;
    }else
	{
		$("#usernameAjaxLoad").html('');
	}


	$("#usernameAjaxLoad").html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>home/validateUsername",
		data: { username: $( "#username" ).val() },
		success: function(response){
			var result = JSON.parse(response);
        	$("#error").html(result.message);
        	$("#usernameDiv").removeClass('has-success has-error').addClass(result.class);
        	$("#usernameAjaxLoad").html(result.icon);
        	$("#usernameError").html(result.err);
        	}
    });
    return false;
});

$( "#inputPassword3" ).blur(function() {
	$("#inputPassword4").val('');
	if($("#inputPassword3").val().length < 8) {
        $("#pwd1V").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Password must contain at least 8 characters</span></em>');
		//$("#inputPassword3").focus();
        return false;
    }else
	{
		$("#pwd1V").html('');
	}
});

$( "#inputPassword4" ).blur(function() {
	//$("#retypeAjaxLoad").html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	//console.log($("#inputPassword3").val());
	//console.log($("#inputPassword4").val());
	if($('#inputPassword3').val() != $('#inputPassword4').val())
	{
		$("#retypeAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Password does not match</span></em>');
		//$("#inputPassword4").focus();
		return false;
	}else
	{
		$("#retypeAjaxLoad").html('');
	}
	/*
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>home/validatePassword",
		data: { password: $("#inputPassword3").val(), retype : $("#inputPassword4").val()},
		success: function(response){
			var result = JSON.parse(response);
        	$("#error").html(result.message);
        	$("#retypeDiv").removeClass('has-success has-error').addClass(result.class);
        	$("#retypeAjaxLoad").html(result.icon);
        	}
    });*/
});
//captchaError
// $('#myForm').on('submit', function () {
// 	 var recaptcha = $("#g-recaptcha-response").val();
	 	
//     if(recaptcha == ""){
// 		event.preventDefault();
//         $('#captchaError').html("<em><span style=\"color:red\"> <i class=\"icon-cancel-1 fa\"></i> Please check the recaptcha </span></em>");
//         return false;
//     } else {
    	
//         return setup();
//     }
// });
function setup()
{
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

    if($("#username").val().length < 5) {
    	$("#usernameAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Username must contain at least 5 characters</span></em>');
    	isValid= false;
    }
    else
    {
    	$('#usernameAjaxLoad').html('');
    }
	
    if($("#inputPassword3").val().length < 8) {
        $("#pwd1V").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Password must contain at least 8 characters</span></em>');
		//$("#inputPassword3").focus();
        isValid= false;
    }
    else
    {
    	$('#pwd1V').html('');
    }
    // PASSWORD WITH RETYPE PASSWORD CHECKING 
    //if($('#inputPassword3').val() != $('#inputPassword4').val())
	//{
	//	$("#retypeAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Password does not match</span></em>');
		//$("#inputPassword4").focus();
	//	isValid= false;
	//}
    //else
    //{
    	//$('#retypeAjaxLoad').html('');
    //}
    
    $("#emailAjaxLoad").html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>home/validateEmail",
		data: { inputEmail3: $( "#inputEmail3" ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#error").html(result.message);
	    	$("#emailDiv").removeClass('has-success has-error').addClass(result.class);
	    	$("#emailAjaxLoad").html(result.icon);
	    	$("#emailError").html(result.err);
	    	}
	});

	$("#usernameAjaxLoad").html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>home/validateUsername",
		data: { username: $( "#username" ).val() },
		success: function(response){
			var result = JSON.parse(response);
        	$("#error").html(result.message);
        	$("#usernameDiv").removeClass('has-success has-error').addClass(result.class);
        	$("#usernameAjaxLoad").html(result.icon);
        	$("#usernameError").html(result.err);
        	}
    });
    if(!isValid)
        return false;
	if($('#captchaError').text()=='' &&
		//$("#retypeAjaxLoad").text()=='' &&
		$("#pwd1V").text()=='' &&
		$("#usernameError").text()=='' &&
		$("#telError").text()=='' &&
		$("#emailError").text()=='' &&
		$("#error").text()=='')
	{			
		document.getElementById("myForm").submit();
	}
	else
		return false;

}
$("#checkboxes-1").click(function() {
	  $("#register").attr("disabled", !this.checked);
	});

</script>
  <?php include "footer2.php"; ?>
  </div>

