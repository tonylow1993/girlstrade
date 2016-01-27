<?php $title = "Girls' Trading Platform"; 
  include("header.php"); ?>
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
             
             	<?php include("adminUpdatePostContent.php");?>
<!--               <div class="table-action"> -->
<!--                 <label for="checkAll"> -->
 <!--                  <input type="checkbox" onclick="checkAll(this)" id="checkAll"> -->
<!--                   Select: All | <a href="#" class="btn btn-xs btn-danger">Approve <i class="fa fa-reply "></i></a>  -->
<!--                   | <a href="#" class="btn btn-xs btn-danger">Reject <i class="fa fa-trash "></i></a> -->
<!--                   </label> -->
<!--                 <div class="table-search pull-right col-xs-7"> -->
<!--                   <div class="form-group"> -->
                    
<!--                   </div> -->
<!--                 </div> -->
<!--               </div> -->
           
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

<script>
function updatePost(ctrlValue1, ctrlValue2, ctrlName, ctrlErrName, postType, blockDate) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>getAdmin/updatePostAdmin",
		data: { messageID: $( "#".concat(ctrlValue1) ).val(),
		userID: $( "#".concat(ctrlValue2) ).val(),
		postType:  $( "#".concat(postType) ).val(),
		blockDate: $( "#".concat(blockDate) ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
};


</script>


<?php include "footer2.php"; ?>
