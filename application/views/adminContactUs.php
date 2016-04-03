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
            <h2 class="title-2"><i class="icon-star-circled"></i> <?php echo $this->lang->line("adminContactUs"); ?> </h2>
             <div class="table-responsive">
             
             

	<form name="myForm" action="<?php echo base_url().MY_PATH;?>getAdmin/updateContactUs" method="POST">
             
             <div class="table-responsive">
             <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                    <tr>
                    <th data-type="numeric" data-sort-initial="true"> </th>
                    <th> <?php echo $this->lang->line("From");?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Preview");?>  </th>
                    <th> <?php echo $this->lang->line("Action");?>  </th>
                   </tr>
                </thead>
                <tbody>
                <?php 
                $Num=0;
                
                if($itemList<>null)
            	{
            		foreach($itemList as $id=>$row)
                  	{
                  		$Num=$Num+1;
                  		$email=$row['email'];
                  		$phone=$row["phone"];
                  		$name=$row["name"];
                  		$message=$row["message"];
                  		$contactType=$row["contactType"];
                  		
                  		$createDate=$row['createDate'];
                  		$status=$row['status'];
                  		$contactID=$row['contactID'];
                  		
                		echo "<tr>";
                    	echo "<td style=\"width:5%\" class=\"add-img-selector\"><div class=\"checkbox\">";
                        echo "<label>";
                        echo "  <input type=\"checkbox\">";
                        echo "</label>";
                      	echo "</div></td>";
                    	echo "<td style=\"width:20%\">" ;
                  		if(isset($name) && strcmp($name, "")!=0)
                  			echo $name."<br/>";
                  		if(isset($email) && strcmp($email, "")!=0)
                  			echo $email."<br/>";
                  		if(isset($phone) && strcmp($phone, "")!=0)
                  			echo $phone;
                    	echo "</td>";
                    	echo "<td style=\"width:60%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                       echo "<h5>".$message."<br/>Posted On: ". $createDate."</h5>";
                      	 	echo "</div></td>";
                      	 	echo "<td style=\"width:10%\" class=\"action-td\"><div>";
                      	 		echo "<a class=\"btn btn-primary btn-xs\" href=\"#contactAdvertiser\" data-toggle=\"modal\"  id='$contactID' 
						  			email='$email' phone='$phone'   name='$name'> <i class=\"fa fa-edit\"></i> ".$this->lang->line('Reply')." </a>";
                      	 		$ctrlName1="AjaxLoad".$Num;
                      	 		$errorctrlName1="ErrAjaxLoad".$Num;
                      	 		$ctrlValue1="contactID".$Num;
                      	 		$clickLink="clickLink".$Num;
                      	 		
                      	 		echo "<br/> <div id='$ctrlName1' name='$ctrlName1' class='center'></div><div id='$errorctrlName1' name='$errorctrlName1' class='center'></div>";
                      	 		echo "<input name='$ctrlValue1' id='$ctrlValue1' type='hidden' value='$contactID' />";
                      	 		echo "<a class=\"btn btn-primary btn-xs\" href=\"javascript:markresponsed('$ctrlValue1', '$ctrlName1', '$errorctrlName1')\" id='$clickLink'> <i class=\"fa fa-reply\"></i> ".$this->lang->line('Approve')." </a>";
                      	 		
                echo "</div>";
                  echo "</td></tr>";
				}
               
            	}
				echo "<br/><input type='hidden' name='NumRec' value='".$Num."' ></input>";
              ?>  
               
                </tbody>
              </table>
              
             	
           
            </div>
             <br/><button  type="submit" value="Submit" >Submit</button>
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
  <div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i>  Reply contact</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="item" method="post" action="<?php echo base_url(); echo MY_PATH;?>getAdmin/replyMessage">
			<div class="form-group">
            <label  class="control-label">Name</label>
        	<input type='text' class="form-control" id="name"   name="name"   value="<?php echo $name;?>">
          </div>
          <div class="form-group">
          		<input type="hidden"  class="form-control"  id="contactid" name="contactid"  value="<?php  echo $id;?>">
          </div>
          <div class="form-group">
             <label  class="control-label">Phone</label>
        	<input type='text' class="form-control" id="phone"  name="phone" value="<?php echo$phone;?>">
        	</div>
          <div class="form-group">
          <label  class="control-label">Email</label>
        	<input type='text'  class="form-control" id="email"  name="email"  value="<?php  echo $email;?>">
               </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message <font color="red">*</font><span class="text-count">(300) </span>:</label>
            <textarea style="vertical-align: top; horizontal-align: left; resize:none;" class="form-control"  rows="5" columns="30"  required="true" id="message-text" name="message-text"  placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea>
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

<script>
// function passToModal() {
// 	   $("#contactAdvertiser").on("show.bs.modal", function(event) {
// 	        $("#email").val($(event.relatedTarget).data("email"));
// 	        $("#contactid").val($(event.relatedTarget).data("contactid"));
// 	        $("#phone").val($(event.relatedTarget).data("phone"));
// 	        $("#name").val($(event.relatedTarget).data("name"));
	        
// 	  //       $("#divSoldUser").html( jsbase64_decode($(event.relatedTarget).data("soldusers")));
// 	    });
// 	}
// 	$(document).ready(passToModal());
</script>
  <?php include "footer1.php"; ?>
  <!--/.footer--> 
  <script>
  function setup()
  {
          var myform = document.getElementById("item");
  	  	document.getElementById("item").submit();
         	return true;
  }
function markresponsed(ctrlValue1, ctrlName, ctrlErrName) {
	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>getAdmin/markresponsed",
		data: { contactID: $( "#".concat(ctrlValue1) ).val()},
		success: function(response){
			var result = JSON.parse(response);
	    	$("#".concat(ctrlName)).html(result.icon);
	    	$("#".concat(ctrlErrName)).html(result.message);
	    	}
	});
};
</script>
</div>



<?php include "footer2.php"; ?>
