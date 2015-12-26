<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

            <script type="text/javascript">// <![CDATA[
            function checkDate(ctrlValue1, ctrlName, ctrlErrName) {
            	$("#".concat(ctrlName)).html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
            	$.ajax({
            		method: "POST",
            		url: "<?php echo base_url(); echo MY_PATH;?>getAdmin/checkValidDate",
            		data: { dateStr: $( "#".concat(ctrlValue1) ).val() },
            		success: function(response){
            			var result = JSON.parse(response);
            	    	$("#".concat(ctrlName)).html(result.icon);
            	    	$("#".concat(ctrlErrName)).html(result.message);
            	    	}
            	});
            };
            $(document).ready(function(){      
                $('#userID').change(function(){ //any select change on the dropdown with id country trigger this code        
                   $("#postID").html("");
						 var user_id = 
              	  {
                            userID:$('#userID option:selected').val()   //$('#userID').val()  
                    };  
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('getAdmin/get_post'); ?>", //here we are calling our user controller and get_cities method with the country_id
                        data: user_id,
                        datatype : "json",
                        success: function(postList) //we're calling the response json array 'states'
                        {
                         
                             $.each(postList,function(key,val) //here we're doing a foeach loop round each city with id as the key and city as the value
                            {
                               $('#postID').append(val); //here we will append these new select options to a dropdown with the id 'states'
                            });
                            
                        }

                    });

                });

            });

          
    </script>  
  
  
  
             
             	
                <div  class="form-group">
                	<label class="col-md-3 control-label" >Select username:</label>
                		<div class="col-md-8">
             <?php $itemList['#'] = 'Please Select'; ?>

                <?php echo form_dropdown('user_id', $itemList, '#', 'class="form-control" style="font-size:1.3em" id="userID" name="userID"'); ?>
                </div></div><br/>
 			   <div  class="form-group">
                 	<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                 <tr>
                    <td style="width:20%"> <?php echo $this->lang->line("Photo");?> </td>
                    <td style="width:80%"> <?php echo $this->lang->line("Ads_Detail");?> </td>
                 </tr> 
                       </table>
                	<div id="postID"  name="postID">
                	
                	</div>
                	
                	
                </div>
   
      