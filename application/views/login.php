<?php $title = "Girls' Trading Platform";  include("header.php"); ?>
 <script>
window.onload = function(){
	   document.getElementById("sender-email").focus();
	};
</script>
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 login-box">
          <div class="panel panel-default panel-bevel">
            <div class="panel-intro text-center">
              <h2 class="inner-logo-title"> 
                <!-- Original Logo will be placed here  --> 
                <img width="50px" height="50px" src="<?php echo base_url();?>images/site/girlstrade_logo.png">
                <span id="login_signupTitle">
                Login
                </span>
            </div>
            <div class="panel-body">
              <form id="loginform" role="form" name="myForm" action="<?php echo base_url().MY_PATH; ?>home/loginUser?prevURL=<?php echo $PrevURL; ?>" method="post">
                <div id="error">
                    </div>
                <div class="form-group">
                <div id="usernameDiv">
                  <label for="sender-email" class="control-label"><?php echo $Username; ?></label>
                  <div class="input-icon"> <i class="icon-user fa"></i>
                    <input id="sender-email" type="text" name="username" required="true" class="form-control email">
                  	<div id="usernameAjax"></div>
                  </div>
                </div>
                </div>
                <div class="form-group">
                  <label for="user-pass"  class="control-label"><?php echo $Password;?></label>
                  <div class="input-icon"> <i class="icon-lock fa"></i>
                    <input type="password"  class="form-control" required="true" name="password" id="user-pass">
                  </div>
				  <div id="passwordAjax"></div>
				  <div id="loginAjax"></div>
                </div>
                <div class="form-group">
<!--                   <a  href="account-home.html" class="btn btn-primary  btn-block">Submit</a> -->
                  <input type="submit"  id="login" class="btn btn-primary btn-block btn-pink" value="Submit"/>
                </div>
              </form>
   
            </div>
            <div class="panel-footer">
              <p class="text-center pull-left"> <a href="<?php echo base_url(); echo MY_PATH;?>home/forgetPasswordPage"> <?php echo $LostYourPassword;?> </a> </p>
              <div style=" clear:both"></div>
            </div>
          </div>
          <div class="login-box-btm text-center">
            <p> Don't have an account? <br>
              <a href="<?php echo base_url(); echo MY_PATH;?>home/signupPage"><strong><?php echo $SignUp;?></strong> </a> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.main-container -->
  
<?php include "footer1.php"; ?>
<script type="text/javascript">

$( "#user-pass" ).blur(function() {
	if($("#user-pass").val().length < 8) {
        $("#passwordAjax").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Password must contain at least 8 characters</span></em>');
		//$("#inputPassword3").focus();
        return false;
    }else
	{
		$("#passwordAjax").html('');
	}
});

$("#loginform").on("submit",function() {
	$("#passwordAjax").html('');
	$("#loginAjax").html('<em><span> <i class="fa fa-refresh fa-spin"></i> Loading</span></em>');
	$.ajax({
		url : "<?php echo base_url().MY_PATH; ?>home/loginUser?prevURL=<?php echo $PrevURL; ?>",
		type : "POST",
		data : {username : $("#sender-email").val(), password : $("#user-pass").val()},	
		success : function(output){
			if (output == "Success"){
				$("#loginAjax").html('<em><span style="color:green"> <i class="icon-check fa"></i>Success</span></em>');
				if ("<?php echo $PrevURL; ?>" == "")
					window.location.href = "<?php echo base_url();?>";
				else if("<?php echo $PrevURL; ?>".indexOf('loginPage')>=0)
					window.location.href = "<?php echo base_url();?>";
				else if("<?php echo $PrevURL; ?>".indexOf('signupPage')>=0)
					window.location.href = "<?php echo base_url();?>";
				else window.location.href = "<?php echo $PrevURL; ?>";
			}
			else
				$("#loginAjax").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> '+ output + '</span></em>');
			
			console.log(output);
			
		}
// 		,
// 		error : function(){
// 			alert("Error");
// 		}
	})
	return false;
});
</script>

</script>
<?php include "footer2.php"; ?>

