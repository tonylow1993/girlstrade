<?php $title = "Girls' Trading Platform";  include("header.php");?>

<script type="text/javascript">
function sendIt() {

// var i = document.getElementById("sortByPrice").value;
 var info = document.getElementById("sortHref").value;
   document.location.href=info; //.concat(i);
}
</script>


    <SCRIPT LANGUAGE="JavaScript">

    var time_left = 5;
    var cinterval;
    var timestatus=1;

    function time_dec(){
        time_left--;
        document.getElementById('countdown').innerHTML = time_left;
        if(time_left == 0){
            clearInterval(cinterval);
            window.location.href='<?php echo $redirectToPHP;?>'
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

<div id="wrapper">
  <div class="main-container">
     <div class="container">   
       <div class="row">
        <div class="col-sm-5 login-box">
          <div class="panel panel-default">
            <div class="panel-intro text-center">
            <div class="panel-body">
                <h2>Redirecting In <span id="countdown">5</span> to <?php echo $redirectToWhatPage;?></h2>
   				<input class="btn   btn-default btn-block" type="button" value="stop" id="stopbutton" onclick="stopstarttime()">
              	<br/>
              	<h2>Or</h2>
            	<br/>
           	    <a href="<?php echo base_url();?>"  class="btn   btn-default btn-block"> Go to Home Page </a> 
           </div>
           </div>
           </div>
           </div>
           </div>
          </div>
           

  </div>

  
  <!-- /.main-container -->
  
  <?php include "footer1.php"; ?>
  </div>
<div class="modal fade" id="contactAdvertiser1" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i> Contact advertiser </h4>
      </div>
      <div class="modal-body">
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/insertMessage/<?php echo $postID;?>/<?php echo $userID;?>?prevURL=<?php echo urlencode($prevURL);?>">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Name: <font color="red">*</font></label>
            <input class="form-control required" id="recipient-name" placeholder="Your name" data-placement="top" required="true" data-trigger="manual" data-content="Must be at least 3 characters long, and must only contain letters." type="text">
          </div>
          <div class="form-group">
            <label for="sender-email" class="control-label">E-mail: <font color="red">*</font></label>
            <input id="sender-email" type="text" data-content="Must be a valid e-mail address (user@gmail.com)" required="true" data-trigger="manual" data-placement="top" placeholder="email@you.com" class="form-control email">
          </div>
          <div class="form-group">
            <label for="recipient-Phone-Number"  class="control-label">Phone Number:</label>
            <input type="text"  maxlength="60" class="form-control" id="recipient-Phone-Number">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message <font color="red">*</font><span class="text-count">(300) </span>:</label>
            <textarea class="form-control" required="true" id="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
          </div>
          <div class="form-group">
            <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success pull-right" onclick="setup(); return false;">Send message!</button>
      	<button id="validate" hidden="true" type="submit"></button>
      </div>
    </div>
  </div>
</div>

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"> </script><script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script> 

<!-- include carousel slider plugin  --> 
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script> 

<!-- include equal height plugin  --> 
<script src="<?php echo base_url();?>assets/js/jquery.matchHeight-min.js"></script> 

<!-- include jquery list shorting plugin plugin  --> 
<script src="<?php echo base_url();?>assets/js/hideMaxListItem.js"></script> 

<!-- bxSlider Javascript file --> 
<script src="<?php echo base_url();?>assets/plugins/bxslider/jquery.bxslider.min.js"></script> 
<script>
$('.bxslider').bxSlider({
  pagerCustom: '#bx-pager'
});


</script> 
<!-- include form-validation plugin || add this script where you need validation   --> 
<script src="<?php echo base_url();?>assets/js/form-validation.js"></script> 
<!-- include jquery.fs plugin for custom scroller and selecter  --> 
<script src="<?php echo base_url();?>assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js"></script>
<!-- include custom script for site  --> 
<script src="<?php echo base_url();?>assets/js/script.js"></script>
    <?php include "footer2.php"; ?>

