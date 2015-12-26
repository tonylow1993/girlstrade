<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

            <script type="text/javascript">// <![CDATA[

            $(document).ready(function(){      
                $('#userID').change(function(){ //any select change on the dropdown with id country trigger this code        
                   $("#postID > option").remove();
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
                               var opt = $('<option />'); // here we're creating a new select option with for each city
                               opt.val(key);
                                opt.text(val);
                                $('#postID').append(opt); //here we will append these new select options to a dropdown with the id 'states'
                            });
                        }

                    });

                });

            });
    </script>  
  
  
  
  
  
  
   <form name="myForm" action="<?php echo base_url().MY_PATH;?>getAdmin/deleteUserAdmin" method="POST">
                	
                <div  class="form-group">
                	<label class="col-md-3 control-label" >Select username:</label>
                		<div class="col-md-8">
             <?php $itemList['#'] = 'Please Select'; ?>

                <?php echo form_dropdown('user_id', $itemList, '#', 'class="form-control" style="font-size:1.3em" id="userID" name="userID"'); ?>
                </div></div>
 			   
  					<button  type="submit" value="Submit" >Submit</button>
             </form>