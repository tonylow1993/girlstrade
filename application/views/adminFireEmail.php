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
            <h2 class="title-2"><i class="icon-star-circled"></i> <?php echo $this->lang->line("approveitemComment"); ?> </h2>
            <form name="myForm" action="<?php echo base_url().MY_PATH;?>getAdmin/sendEmail" method="POST">
             
             <div class="table-responsive">
             <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                   <div  class="form-group">
                	<label class="col-md-3 control-label" >To email:</label>
                		<div class="col-md-8">
                		<input type="text" id="ToEmail"  name="ToEmail"  class="form-control" >
                 </div></div>
                 
                 <div  class="form-group">
                	<label class="col-md-3 control-label" >Subject</label>
                		<div class="col-md-8">
                		<input type="text" id="subject"  name="subject"  class="form-control" >
                 </div></div>
                 
                   <div  class="form-group">
                	<label class="col-md-3 control-label" >Content</label>
                		<div class="col-md-8">
                		<textarea  id="content"  name="content"  maxlength="300"  rows="5" columns="30"   class="form-control" >
                		</textarea>
                 </div></div>
                </thead>
                <tbody>
                
                </tbody>
              </table>
              
             	
           
            </div>
             <br/><button  type="submit" value="Submit" >Submit</button>
             </form>   
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
