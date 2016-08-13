<?php $title = "Admin Send Email Config - GirlsTrade"; 
  include("header.php"); ?>
<div id="wrapper">
  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <?php include("account_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
           <div class="inner-box">
            <h2 class="title-2"><i class="fa fa-envelope-o fa-5"></i> <?php echo $this->lang->line("updateSendEmailConfig"); ?> </h2>
            	<?php if($mandatory!=null) { 
             			foreach($mandatory as $id=>$value){
             				if(strcmp($value["type"],"userID")==0)
             				{
             					continue;
             				}
             			?>
             		
             		<div class="form-group">
                        <div class="col-sm-9">
						  <div class="checkbox">
						  <label>
                            <input id="<?php echo $value["type"];?>" disabled name='<?php echo $value["type"];?>' type="checkbox" <?php  if($value["typeValue"]==1) echo " checked "?>>
                            <small> &nbsp;&nbsp;&nbsp;&nbsp;Show <?php echo $this->lang->line($value["type"]);?></small> </label>
                          </div>
					  </div>
					 </div>
            
             		<?php 	
             			}
             		}?>
            
            <form name="myForm" action="<?php echo base_url().MY_PATH;?>home/updateSendEmailConfig" method="POST">
             		<?php if($result!=null) { 
             			foreach($result as $id=>$value){
             				if(strcmp($value["type"],"userID")==0)
             				{
             					echo "<input type='hidden' id='userID' name='userID' value=".$value["typeValue"]." />";
             					continue;
             				}
             			?>
             		
             		<div class="form-group">
                        <div class="col-sm-9">
						  <div class="checkbox">
						  <label>
                            <input id="<?php echo $value["type"];?>" name='<?php echo $value["type"];?>' type="checkbox" <?php  if($value["typeValue"]==1) echo " checked "?>>
                            <small> &nbsp;&nbsp;&nbsp;&nbsp;Show <?php echo $this->lang->line($value["type"]);?></small> </label>
                          </div>
					  </div>
					 </div>
            
             		<?php 	
             			}
             		}?>
			 
			 <div class="form-group">
                        <div class="col-sm-9">
						  <button class="btn btn-primary" type="submit" value="Submit" >Submit</button>
					  </div>
					 </div>
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
