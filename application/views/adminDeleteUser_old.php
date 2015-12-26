<?php $title = "Girls' Trading Platform"; 
  include("header.php"); ?>
  
  <link rel="stylesheet" type="text/css" href="css/blitzer/jquery-ui-1.8.2.custom.css">
 
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
<div id="wrapper">
  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <?php include("admin_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
           <div class="inner-box">
            <h2 class="title-2"><i class="icon-star-circled"></i> <?php echo $this->lang->line("updatePost"); ?> </h2>
             <div class="table-responsive">
             
             	<?php  // include("adminDeleteUserContent.php");?>
             <script>
var form=document.getElementsById("myForm");
form.elements.userID.onchange=function() {
	var option=this.options[this.selectedIndex];
	this.form.elements.sellerID.value=option.value;
	this.form.elements.username.value=option.innerHTML;
	
}
  </script>
  
  
   <form role="form" id="item" method="post" action="<?php echo base_url().MY_PATH;?>getAdmin/deleteUserAdmin">
                      <div  class="form-group">
                	<label class="col-md-3 control-label" >Select username:</label>
                		<div class="col-md-8">
             <?php $itemList['#'] = 'Please Select'; ?>

                <?php echo form_dropdown('user_id', $itemList, '#', 'class="form-control" style="font-size:1.3em" id="userID" name="userID"'); ?>
                </div></div>
                <input type="hidden"  name="sellerID >
                <input type="hidden" name="username">
                <br/>
<!--                 <br/> -->
<!--                <div class="user-ads-action"> <a href="#contactAdvertiser"  -->
<!--                 	 data-toggle="modal" class="btn   btn-default btn-block"><i class=" icon-mail-2"></i> Delete User </a> </div> -->
                                 
               		<button  type="submit" value="Submit" >Submit</button>
             </form>
 			   	
  				
            </div>
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
<div class="modal fade" id="dialog" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class=" icon-mail-2"></i> Delete User</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label  class="control-label">Name: <div id="username" /> </label>
            
          </div>
      </div>
      
    </div>
  </div>
</div>
<script>

$(function(){       
            
    $('#dialog').dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        resizable: false,
        buttons: {
            "Submit Form": function() {
                document.item.submit();
            },
            "Cancel": function() {
                $(this).dialog("close");
            }
        }
    });
     
    $('form#item').submit(function(e){
        e.preventDefault();

        $("div#username").html($("input#username").val());
        $('#dialog').dialog('open');
    });
});
</script>

<?php include "footer2.php"; ?>
