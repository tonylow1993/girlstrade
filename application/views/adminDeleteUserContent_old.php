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
 			   	
  				