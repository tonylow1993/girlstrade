  <div class="page-bottom-info">
      <div class="page-bottom-info-inner">
      
      	<div class="page-bottom-info-content text-center">
        	<h1>If you have any questions, comments or concerns, please call the Classified Advertising department at (000) 555-5555</h1>
            <a class="btn  btn-lg btn-primary-dark" href="tel:+000000000">
            <i class="icon-mobile"></i> <span class="hide-xs color50">Call Now:</span> (000) 555-5555   </a>
        </div>
      
      </div>
  </div>


  <div class="footer" id="footer">
    <div class="container">
      <div id="langError"></div>
      <ul class=" pull-left navbar-link footer-nav">
        <li><a href="index.html"> Home </a> 
            <a href="about-us.html"> About us </a> 
            <a href="#"> Terms and Conditions </a> 
            <a href="#"> Privacy Policy </a> 
            <a href="contact.html"> Contact us </a> 
            <a href="faq.html"> FAQ </a>
            <a id="lang" href="#"> 
                <?php echo $lang_label; ?>
            </a>
      </ul>
      <ul class=" pull-right navbar-link footer-nav">
        <li> &copy; 2015 Girlstrade </li>
      </ul>
    </div>
    
  </div>
  <!-- /.footer --> 
</div>
<!-- /.wrapper --> 

<!-- Le javascript
================================================== --> 

<!-- Placed at the end of the document so the pages load faster --> 
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"> </script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script> 

<!-- include carousel slider plugin  --> 
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script> 

<!-- include equal height plugin  --> 
<script src="<?php echo base_url();?>assets/js/jquery.matchHeight-min.js"></script> 

<!-- include jquery list shorting plugin plugin  --> 
<script src="<?php echo base_url();?>assets/js/hideMaxListItem.js"></script> 

<!-- include jquery.fs plugin for custom scroller and selecter  --> 
<script src="<?php echo base_url();?>assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js"></script>


<!-- include custom script for site  --> 
<script src="<?php echo base_url();?>assets/js/script.js"></script>


<!-- include toastr http://codeseven.github.io/toastr/demo.html-->
<link href="<?php echo base_url();?>assets/css/toastr.min.css" rel="stylesheet"/>
<script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>

<!-- include jquery autocomplete plugin  -->

<!--<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/autocomplete/jquery.mockjax.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/autocomplete/jquery.autocomplete.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/autocomplete/usastates.js"></script>

<!--<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/autocomplete/autocomplete-demo.js"></script>-->

<!-- 
<script  type="text/javascript">
            $(document).ready(function() {      
                                //var cname = 'switchLang/changeLang';
                               var base_url = '<?php echo site_url("switchLang/changeLang");?>';
                              
                                console.log(base_url);
                                $('#lang').click(function(event) {
                                    event.preventDefault();
                                        console.log(5 + 6);
                                        $.ajax({
                    'async': false,
                    'url' : base_url,
                    'type' : 'POST', //the way you want to send data to your URL
                    'dataType': 'json',
                    'data' : 'data',
                    'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                                console.log(data);
                                 if(data){
                                    location.reload(); 
                                }
                             },
                    'error': function(XMLHttpRequest, textStatus, errorThrown) { 
                            toastr.options.closeButton = true;
                            toastr.options.preventDuplicates = true,
                            toastr["error"]("Language cannot be switched at moment, please try again later.", "Error");
                    }           
                                    });
                                        
                                });
                        });
</script>
-->

</body>
</html>