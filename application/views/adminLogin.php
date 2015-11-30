<?php $title = "Girls' Trading Platform";  include("header.php"); ?>
<div id="wrapper">  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 login-box">
          <div class="panel panel-default">
            <div class="panel-intro text-center">
              <h2 class="logo-title"> 
                <!-- Original Logo will be placed here  --> 
                <span class="logo-icon"><i class="icon icon-hammer ln-shadow-logo shape-0"></i> </span> Girls<span>Trade </span> </h2>
            </div>
            <div class="panel-body">
              <form role="form" action="<?php echo base_url().MY_PATH; ?>getAdmin/loginUser"  method="post">
                <div class="form-group">
                  <label for="sender-email" class="control-label">Username:</label>
                  <div class="input-icon"> <i class="icon-user fa"></i>
                    <input id="sender-email" type="text" name="username" class="form-control email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="user-pass"  class="control-label">Password:</label>
                  <div class="input-icon"> <i class="icon-lock fa"></i>
                    <input type="password"  class="form-control" name="password" id="user-pass">
                  </div>
                </div>
                <div class="form-group">
<!--                   <a  href="account-home.html" class="btn btn-primary  btn-block">Submit</a> -->
                  <input type="submit" id="login" class="btn btn-primary btn-block" value="Submit"/>
                </div>
              </form>
            </div>
            
          </div>
         
        </div>
      </div>
    </div>
  </div>
  </div>
 
  <!-- /.main-container -->
</body>
</html>
