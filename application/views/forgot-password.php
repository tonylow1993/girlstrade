<?php $title = "Girls' Trading Platform";  include("header.php"); ?>
 
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 login-box">
          <div class="panel panel-default">
            <div class="panel-intro text-center">
              <h2 class="logo-title"> 
                <!-- Original Logo will be placed here  --> 
                <span class="logo-icon"><i class="icon icon-hammer ln-shadow-logo shape-0"></i> </span> Girls Trade </h2>
            </div>
            <div class="panel-body">
              <form role="form" name="myForm" action="<?php echo base_url().MY_PATH; ?>home/forgetPassword"  method="post">
                <div id="error">
                    </div>
                <div class="form-group">
                  <label for="sender-email" class="control-label"> <?php echo $Email;?></label>
                  <div class="input-icon"> <i class="icon-user fa"></i>
                    <input id="sender-email" name="sender-email" type="text"  placeholder="Email" class="form-control email">
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block"><?php  echo $SendMeMyPassword;?></button>
                </div>
              </form>
            </div>
            <div class="panel-footer">
              <p class="text-center "> <a href="<?php echo base_url(); echo MY_PATH;?>home/loginPage"> <?php echo $BackToLogin;?> </a> </p>
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
 
<?php include "footer2.php"; ?>
