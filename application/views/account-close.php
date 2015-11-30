<?php $title = "Girls' Trading Platform"; 
  include("header.php"); ?>
<div id="wrapper">
  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <?php include("account_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
          <?php include("profile_header.php");?>
          <div class="inner-box">
          	  <?php include("profile_visit.php");?>
          	  
				
          	  
          <div class="col-md-8">
          <h2>Close account </h2>
          <p>You are sure you want to close your account?</p>
            
          <div>  <label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Yes
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> No
</label></div>
</div>
<br>
    
            
            
          </div>
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
  <!-- /.main-container -->

  <?php include "footer1.php"; ?>
  <!--/.footer--> 
</div>

 

<?php include "footer2.php"; ?>
