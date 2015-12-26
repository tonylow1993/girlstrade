<?php $title = "Girls' Trading Platform"; 
  include("header.php"); ?>
  
  <link href="<?php echo base_url();?>assets/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<style id="jsbin-css">
.progress-bar[aria-valuenow="1"],
.progress-bar[aria-valuenow="2"] {
  min-width: 3%;
}

.progress-bar[aria-valuenow="0"] {
  color: gray;
  min-width: 100%;
  background: transparent;
  box-shadow: none;
}

.progress-bar[aria-valuenow^="9"]:not([aria-valuenow="9"]) {
  background: red;
}
.panel-heading {
    cursor: pointer;
}

/* CSS Method for adding Font Awesome Chevron Icons */
 .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family:'FontAwesome';
    content:"\f146";
    float: right;
    color: inherit;
}
input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 10px;
}
.panel-heading.collapsed .accordion-toggle:after {
    /* symbol for "collapsed" panels */
    content:"\f0fe";
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-tagsinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-tagsinput.js"></script>
  
  
  
<div id="wrapper">
    <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <?php include("account_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
          <?php include("profile_header_upload.php");?>
          <div class="inner-box">
          	  <?php include("profile_visit.php");?>
           <div id="accordion" class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"> <a href="#collapseB1"  data-toggle="collapse"> <?php  echo $this->lang->line("My_Detail");?></a> </h4>
                </div>
                <div class="panel-collapse collapse in" id="collapseB1">
                  <div class="panel-body">
                  <form action="<?php echo base_url().MY_PATH.'home/updateProfile'?>" method="POST" >
     			      <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php echo $this->lang->line("FirstName");?></label>
                        <div class="col-sm-9">
                          <input name="firstName" type="text" class="form-control"  placeholder="<?php echo $firstName;?> ">
                      </div>
                      <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php  echo $this->lang->line("LastName");?></label>
                        <div class="col-sm-9">
                          <input name="lastName" type="text" class="form-control" placeholder="<?php echo $lastName; ?> ">
                        </div>
                      </div>
                      <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php echo $this->lang->line("Email");?></label>
                        <div class="col-sm-9">
                          <input name="email" type="email" disabled="disabled" class="form-control"  placeholder="<?php echo $email; ?> ">
                        </div>
                      </div>
                       <div class="form-group">
	                        <label  class="col-sm-3 control-label"><?php echo $this->lang->line("Country");?></label>
	                        <div class="col-sm-9">
	                          <input name="country" type="text" class="form-control" id="country" placeholder="HKG"  disabled="true">
	                        </div>
	                      </div>
	                    	                     
                      <div class="form-group">
                        <label for="Phone" class="col-sm-3 control-label"><?php echo $this->lang->line("Phone");?></label>
                        <div class="col-sm-9">
                          <input name="telNo" type="text" pattern="\d*" maxlength="8"  class="form-control" id="Phone" placeholder="<?php echo $telNo;?>">
                        	<div class="checkbox">
                          <label>
                            <input id="hidetelno" name='hidetelno' type="checkbox"  <?php  if($hidetelno==1) echo " checked "?> >
                            <small> <?php echo $HidePhoneNumber;?> </small> </label>
                        </div>
                        </div>
                      </div>
                      
                      <div class="form-group hide"> <!-- remove it if dont need this part -->
                        <label  class="col-sm-3 control-label">Facebook account map</label>
                        <div class="col-sm-9">
                          <div class="form-control"> <a class="link" href="fb.com">Jhone.doe</a> <a class=""> <i class="fa fa-minus-circle"></i></a> </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9"> </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-default"><?php echo $this->lang->line("btnUpdate");?></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"> <a href="#collapseB2"  data-toggle="collapse"> <?php echo $this->lang->line("Settings");?> </a> </h4>
                </div>
                <div class="panel-collapse collapse" id="collapseB2">
                  <div class="panel-body">
          	 	<h2>Change Password </h2>
          	    <form id="myForm" onSubmit="return setup1()" action="<?php echo base_url().MY_PATH.'home/updatePassword'?>" method="POST">
     			  <fieldset>
                  
     				          <div class="form-group">
               				<label class="col-md-3 control-label"><?php echo $this->lang->line("CurrentPassword");?></label>
     				<div class="col-md-8"><input height="20px" type="password" name="originalPassword" id="originalPassword" required="true"/>
					</div>
					</div>
			         <div class="form-group">
          		<br/>
					<label class="col-md-3 control-label"><?php echo $this->lang->line("NewPassword");?> </label>
					<div class="col-md-8">
					<input type="password" name="newPassword" id="newPassword"  required="true"/>
					</div><div id="passAjaxLoad"></div>
					</div>
					          <div class="form-group">
          		<br/>
					<label class="col-md-3 control-label"><?php echo $this->lang->line("ConfirmNewPassword");?>  </label>
					<div class="col-md-8"><input type="password" name="newReTypePassword" id="newReTypePassword"  required="true"/>
					</div><div id="retypeAjaxLoad"></div>
					</div>
				<br/>
				  <div class="form-group">
                    
				<div class="col-md-8">
				<button type="submit" class="btn btn-primary"><?php echo $this->lang->line("btnSubmit");?></button>
				</div>
				</div>
				</fieldset>
				</form>
				</div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"> <a href="#collapseB3"  data-toggle="collapse"> <?php echo $this->lang->line("Preferences");?> </a> </h4>
                </div>
                <div class="panel-collapse collapse" id="collapseB3">
                  <div class="panel-body">
                  <form action="<?php echo base_url().MY_PATH.'home/updateCheckBox'?>" method="POST" >
     			      
                    <div class="form-group">
                      <div class="col-sm-12">
                        <div class="checkbox">
                          <label>
                          <?php 
                          $str="";
                          	if($checkBox1==1)
                          		$str="checked";
                            echo "<input id=\"chk1\" name=\"chk1\" type=\"checkbox\" ".$str.">";
                           ?>
                            <?php echo $this->lang->line("Preferences_Desc1")?></label>
                        </div>
                        <div class="checkbox" >
                          <label>
                          <?php
                            $str2="";
                          	if($checkBox2==1)
                          		$str2="checked";
                            echo "<input id=\"chk2\" name=\"chk2\" type=\"checkbox\"  ".$str2.">";
                           ?><?php echo $this->lang->line("Preferences_Desc2")?>
                            </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
						<button type="submit" class="btn btn-primary"><?php  echo $this->lang->line("btnSubmit");?></button>
					</div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--/.row-box End--> 
            
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
<script src="<?php echo base_url();?>assets/js/script.js"></script>
<link href="<?php echo base_url();?>assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/js/fileinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/fileinput_locale_ch.js" type="text/javascript"></script>
  <script>
var img1 = null;
$("#image1").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif','jpeg','bmp'],
    //'elErrorContainer': '#errorBlock',
    'showUpload' : false,
    'maxFileCount':1,
    'maxFileSize': 10000000
    //'dropZoneEnabled' : false,
    //'uploadUrl': 'test.php'
});
function setup()
{
    var myform = document.getElementById("newPost");
	//check whether browser fully supports all File API
	
		
        if (window.File && window.FileReader && window.FileList && window.Blob)
        {
        	for(i=1;i<=1;i++)
    		{
	            //get the file size and file type from file input field
	            try {
	            var fsize = $('#image'+i)[0].files[0].size;
	            var ftype = $('#image'+i)[0].files[0].type;
	            var fname = $('#image'+i)[0].files[0].name;
	            } catch(err)
	            {
// 	            	 $("#uploadImgError"+i).html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Error!</span></em>');
// 	                 location.href = "#uploadImgError"+i;                 //Go to the target element.
// 	                 return false;
			     }
	            
	            if(fsize>8048576) //do something if file size more than 1 mb (1048576)
	            {
	            	 $("#uploadImgError"+i).html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Exceed File Size Limit!</span></em>');
	                 location.href = "#uploadImgError"+i;                 //Go to the target element.
	                 return false; 
	            }
                   switch(ftype)
                    {
                        case 'image/png':
                        case 'image/gif':
                        case 'image/bmp':
                        case 'image/jpeg':
                        case 'image/jpg':
                            break;
                        default:
                        	 $("#uploadImgError"+i).html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Unsupported File Type Images!</span></em>');
                       		location.href = "#uploadImgError"+i;                 //Go to the target element.
                        	return false; 
                    }
    		
    		}
        } else{

        	 $("#uploadImgError1").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Please upgrade your browser, because your current browser lacks some new features we need!</span></em>');
             location.href = "#uploadImgError";                 //Go to the target element.
             return false; 
        }
	
	if(!myform.checkValidity())
	{
		
	        document.getElementById("validate").click();
	        return false;
	}
    isEmptyUploadFile(function(r)
    {
        var up1 = document.getElementById('image1').value;
         img1=up1;
            
        if(up1 == "" )
        {
           $("#uploadImgError1").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Please Upload at least one image!</span></em>');
           location.href = "#uploadImgError1";                 //Go to the target element.
           return false; 
        }
        else //if(r == false)
        {
            $('#pleaseWaitDialog').modal('show');

            setForm(function(data)
            {
                console.log(data);
                if(data == true)
                {
                    document.getElementById("newPost").submit();
                }
                return data;
            });
        }
    });
}

function setForm(callback)
{
                          $('.progress-bar').css('width', 100+'%').attr('aria-valuenow', 100);
                            callback(true);
}

function isEmptyUploadFile(callback)
{
    if(img1 == null)
        callback(true);
    else
        callback(false);

}

   
</script>
</div>

<script>
 $( "#newPassword" ).blur(function() {
		$("#newReTypePassword").val('');
		if($("#newPassword").val().length < 8) {
	        $("#passAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Password must contain at least 8 characters</span></em>');
			//$("#inputPassword3").focus();
	        return false;
	    }else
		{
			$("#passAjaxLoad").html('');
		}
	});

	$( "#newReTypePassword" ).blur(function() {
		if($('#newPassword').val() != $('#newReTypePassword').val())
		{
			$("#retypeAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Password does not match</span></em>');
			return false;
		}else
		{
			$("#retypeAjaxLoad").html('');
		}
		
	})
function setup1()
{
		if($("#newPassword").val().length < 8) {
	        $("#passAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Password must contain at least 8 characters</span></em>');
			//$("#inputPassword3").focus();
	        return false;
	    }else
		{
			$("#passAjaxLoad").html('');
		}

		if($('#newPassword').val() != $('#newReTypePassword').val())
		{
			$("#retypeAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Error: Password does not match</span></em>');
			return false;
		}else
		{
			$("#retypeAjaxLoad").html('');
		}
		
		if($('#passAjaxLoad').text()=='' &&
			$("#retypeAjaxLoad").text()=='')			
		{			
			document.getElementById("myForm").submit();
		}
		else
			return false;

}
 </script>
<?php include "footer2.php"; ?>

