  <div class="footer" id="footer">
    <div class="container">
      <div id="langError"></div>
      <ul class=" pull-left navbar-link footer-nav">
        <li><a href="<?php echo base_url();?>"> <?php if (!isset($Home)) $Home = 'Home'; echo $Home;?> </a> 
            <a href="<?php echo base_url().'home/getAboutUS';?>"> <?php if (!isset($About_us)) $About_us = 'About us'; echo $About_us;?></a> 
            <a href="<?php echo base_url().'home/getTerms';?>"> <?php if (!isset($Terms_and_Conditions)) $Terms_and_Conditions = 'Terms and Conditions'; echo $Terms_and_Conditions; ?> </a> 
            <a href="<?php echo base_url().'home/getPrivacy';?>"> <?php if (!isset($Privacy_Policy)) $Privacy_Policy = 'Privacy Policy'; echo $Privacy_Policy;?> </a> 
            <a href="<?php echo base_url().'home/getContactUS';?>"> <?php if (!isset($Contact_us)) $Contact_us = 'Contact us'; echo $Contact_us;?> </a> 
            <a href="<?php echo base_url().'home/getFQA';?>"> <?php if (!isset($FAQ)) $FAQ = 'FAQ'; echo $FAQ;?></a>
            <a id="lang" href=<?php 
            	   $pageURL = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
				
            echo base_url().MY_PATH."switchLang/changeLang_R1?prevURL=".urlencode(current_url());    
            	?>>            <?php 
                	//$lang_label=$this->session->userdata("language");
                	//if (!isset($lang_label)) 
                	//{
                	//	$lang_label = 'chinese';
                	//	$this->session->set_userdata("language", $lang_label);
                	//}	
                	echo $lang_label_text;
                	?>
            </a>
            </li>
      </ul>
      <ul class=" pull-right navbar-link footer-nav">
        <li> &copy; 2015 Girlstrade </li>
      </ul>
    </div>
    
  </div>
  <!-- /.footer --> 

<!-- /.wrapper --> 

<!-- Le javascript
================================================== --> 

<!-- Placed at the end of the document so the pages load faster --> 
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"> </script>

<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script> 

<!-- include carousel slider plugin  --> 
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script> 

<!-- include equal height plugin  --> 
<script src="<?php echo base_url();?>assets/js/jquery.matchHeight-min.js"></script> 

<!-- include jquery list shorting plugin plugin  --> 
<script src="<?php echo base_url();?>assets/js/hideMaxListItem.js"></script> 

<!-- include jquery.fs plugin for custom scroller and      --> 
<script src="<?php echo base_url();?>assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.fs.   /jquery.fs.   .js"></script>


<!-- include custom script for site  --> 
<script src="<?php echo base_url();?>assets/js/script.js"></script>


<!-- include toastr http://codeseven.github.io/toastr/demo.html-->
<link href="<?php echo base_url();?>assets/css/toastr.min.css" rel="stylesheet"/>
<script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>

<!-- include jquery autocomplete plugin  -->

<!--<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/autocomplete/jquery.mockjax.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/autocomplete/jquery.autocomplete.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/autocomplete/usastates.js"></script>-->

<!--<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/autocomplete/autocomplete-demo.js"></script>-->


<script  type="text/javascript" data-my_var_1="<?php echo base_url();?><?php echo MY_PATH;?>switchLang/changeLang" data-my_var_2="<?php echo base_url();?><?php echo MY_PATH;?>clearT/del" src="<?php echo base_url();?>assets/js/footer.js" >     
     //DO NOT EDIT THIS PART  -->
    
</script> 
 <div class="modal"></div> 