<?php $title = "Operation Failed - GirlsTrade";  include("header.php");?>

    <SCRIPT LANGUAGE="JavaScript">

    var time_left = 5;
    var cinterval;
    var timestatus=1;

    function time_dec(){
        time_left--;
        document.getElementById('countdown').innerHTML = time_left;
        if(time_left == 0){
            clearInterval(cinterval);
            window.location.href='<?php 
            
         //   if(strpos($redirectToPHP,'loginPage') !== false)
         //   	$redirectToPHP=base_url();
            echo $redirectToPHP;?>'
        }
    }

    function resumetime()
    {
        //time_left = 50;
        clearInterval(cinterval);
        cinterval = setInterval('time_dec()', 1000);
    }

    function defaultstart()
    {
        time_left = 5;
        clearInterval(cinterval);
        cinterval = setInterval('time_dec()', 1000);
    }

    function stopstarttime()
    {
        if(timestatus==1)
	    {
	        clearInterval(cinterval);
	        document.getElementById('stopbutton').value="Start";
	        timestatus=0;
	    }
        else
	    {
	        clearInterval(cinterval);
	        cinterval = setInterval('time_dec()', 1000);
	        document.getElementById('stopbutton').value="Stop";
	        timestatus=1;
	    }
    }

    defaultstart();

    </SCRIPT>

    <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-12 page-content">
          <div class="inner-box category-content">
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-danger pgray  alert-lg" style="text-align: center;" role="alert">
					<i class="icon-cancel-circled" style="
						color: white;
						font-size: 200px;
						line-height: 200px;
					"></i>
					<br/>
					<h2 class="no-margin no-padding">&#10008; <?php echo $failedTitle; ?> <?php echo $error;?></h2>
					<br/>
					<h2><?php echo $this->lang->line("Redirecting");?> <span id="countdown">5</span> 
						<?php echo $this->lang->line("toReturn");?>
					 <?php echo $redirectToWhatPage;?></h2>
					<br/>
					<br/>
				    <h2><a href="<?php echo base_url();?>" > <?php echo $goToHomePage;?> </a> </h2>
                </div>
              </div>
            </div>
          </div>
          <!-- /.page-content --> 
          
        </div>
        <!-- /.row --> 
      </div>
      <!-- /.container --> 
    </div>
  </div>
  <!-- /.main-container -->
  
  
  
  
  <!-- /.main-container -->
  
  <?php include "footer1.php"; ?>

    <?php include "footer2.php"; ?>

