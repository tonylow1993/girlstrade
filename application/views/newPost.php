<?php $title = "New Topic";  include("header.php"); ?>
<!--input-->
<link href="<?php echo base_url();?>assets/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- Google Captcha-->
<?php echo $captchaJS;?>  

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

<!-- /.header -->
  <div id="wrapper">
   <div class="main-container">
    <div class="container">
     <?php //echo validation_errors("<div style='color:red;'>","</div>"); ?>
   <?php 
   //$attributes = array('id' => 'myform', 'enctype'=>"multipart/form-data");
   //$prevURLPATH = urlencode($prevURL); echo form_open('newPost/createNewPost/'.$userID.'/'.$username.'?prevURL='.$prevURLPATH, $attributes); //'?prevURL='.urlencode($prevURL)); ?>
      <div class="row">
        <div class="col-md-9 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> <?php echo $NewPost;?><?php echo $YouHaveRemainPost;?></strong> </h2>
            <div class="row">
              <div class="col-sm-12">
                    <form id="newPost" class="form-horizontal" method="post" 
                      action="<?php echo base_url(); echo MY_PATH;?>newPost/createNewPost/<?php echo $userID.'/'.$username.'?prevURL='.urlencode($prevURL); ?>"> 
                  <fieldset>
                      
                      <!-- Text input-->
                      <div class="form-group row">
                          <label class="col-md-3 control-label text-center" for="Adtitle"><i class="icon-pencil"></i> <?php echo $TopicTitle;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <input id="Adtitle" name="Adtitle" class="form-control input-md" value="<?php echo set_value('Adtitle'); ?>" type="text" required="true"  maxlength="70"/>
<!--                        <span class="help-block">A great title needs at least 5 words </span> -->
                              <em>(A Great Title Needs At Least 5 Words) </em>
                          </div>
                      </div>  
                      
                      <!-- Select Basic -->
                      <div id="generalCat" class="form-group row">
                          <label class="col-md-3 control-label text-center" >
                          <i class="icon-layout"></i>
                           <?php echo $Category;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <select name="category-group" id="category-group" class="form-control" required="true">
                                  <option value="" style="background-color:#E9E9E9;font-weight:bold;"> - Please Select One Category - </option>
                                  <?php 
										foreach ($result as $id=>$value)
										{
											if(!isset($lang_label))
													$lang_label="";
											$name=$value[0]->name;
											if($lang_label<>"english")
												$name=$value[0]->nameCH;
											
											if($value[0]->level==1){
												if($id==$categoryID)
													echo "<option value=\"$id\" ".set_select('category-group', $id, ((null!=(set_select('category-group', $id)) )   ? TRUE : FALSE ))." style=\"background-color:#E9E9E9;font-weight:bold;\" selected> - $name - </option>";
												else
													echo "<option value=\"$id\" ".set_select('category-group', $id, ((null!=(set_select('category-group', $id)) )   ? TRUE : FALSE ))." style=\"background-color:#E9E9E9;font-weight:bold;\" > - $name - </option>";									
											}
											else 
												echo "<option value=\"$id\" ".set_select('category-group', $id, ((null!=(set_select('category-group', $id)) )   ? TRUE : FALSE ))."> $name </option>";
						            	}
						            ?>
                              </select>
                          </div>
                      </div>
                       
                       <div id="generalLoc" class="form-group row">
                          <label class="col-md-3 control-label text-center" >
                          <i class=" icon-location-2"></i>
                           <?php echo $lblLocation;?> </label>
                          <div class="col-md-8">
                              <select name="locID2" id="locID2"  class="form-control" >
                                  <option value="" style="background-color:#E9E9E9;font-weight:bold;"> - All Locations - </option>
                                  <?php 
						            foreach ($resLoc as $id=>$value)
						            {
							            if(!isset($lang_label))
						 	            		$lang_label="";
						             	$name=$value[0]->name;
						             	if($lang_label<>"english")
						             		$name=$value[0]->nameCN;
						             	if($value[0]->level==1){
						             		echo "<option  value='".$id."' ".set_select('locID2', $id, (null!=(set_select('locID2', $id))  ? TRUE : FALSE ))." style='background-color:#E9E9E9;font-weight:bold;'>".$name."</option>";
						             	}else if($value[0]->level==2)
						             	{
						            		echo "<option  value='".$id."' ".set_select('locID2', $id, (null!=(set_select('locID2', $id))  ? TRUE : FALSE ))." style='background-color:#E9E9E9;'>--".$name." </option>";
						             	}else if($value[0]->level==3)
						             	{
						              		echo "<option  value='".$id."' ".set_select('locID2', $id, ((null!=(set_select('locID2', $id)) )   ? TRUE : FALSE )).">----".$name." </option>";
						             	}
             						}
						            ?>
                              </select>
                          </div>
                      </div>    
                      
                      <!-- Select Basic -->
                      <div id="itemQuality" class="form-group row">
                          <label class="col-md-3 control-label text-center" > 
                          <i class="icon-eye-1"></i>
						            <?php echo $ItemQuality;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <select name="itemQualityGroup" id="itemQualityGroup" value="<?php echo set_value('itemQualityGroup'); ?>" class="form-control" required="true">
                                <!--   <option value="" style="background-color:#E9E9E9;font-weight:bold;"> - Please Select - </option>  -->
                                   <option value="N"> New </option>
                                   <option value="U"> Used </option>
                              </select>
                          </div>
                      </div>
                      <?php if(strcmp(SHOWQTY, 'Y')==0) {?>
                      <div id="itemQty" class="form-group row">
                          <label class="col-md-3 control-label text-center" > 
                          <i class="icon-flag"></i>
                          Quantity <font color="red">*</font></label>
                          <div class="col-md-8">
                           
                              <select required="true" class="form-control" name="soldqty" id="soldqty">
		        				<!--    <option value="" style="background-color:#E9E9E9;font-weight:bold;"> - Please Select - </option> -->
                                <?php 
		        				  	for ($x = 1; $x <= MAXSOLDQTY; $x++) 
		        				  		echo "<option value='$x'> $x </option>";
		        				  ?>
		        				 </select>
                          </div>
                      </div>
                      <?php }?>
                   
                      
                      
                      
                      <!-- Textarea -->
                      <div id="descriptionTextareaDiv" class="form-group row">
                          <label class="col-md-3 control-label text-center" for="textarea"> 
                          <i class="icon-clipboard"></i>
							<?php echo $Description;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <textarea class="form-control" style="vertical-align: top; horizontal-align: left; resize:none;" id="descriptionTextarea" name="descriptionTextarea" rows="4"  required="true"  maxlength="<?php echo DESCLENGTHINNEWPOST;?>"><?php echo set_value('descriptionTextarea'); ?></textarea>
	                          	<!--<div id="descriptionTextareaAjaxLoad" class="center"></div>
	                        	<div id="descriptionTextareaError" hidden="true"></div>-->
                          </div>
                      </div>
                    
                    
                    
                    
                      <!-- Prepended text-->
                      <div class="form-group row">
                          <label class="col-md-3 control-label text-center" for="Price"><i class="icon-money"></i> <?php  echo $HKDPrice;?> <font color="red">*</font></label>
                          <div class="col-md-4">
                              <div class="input-group"> <span class="input-group-addon">$</span>
                                  <input id="price" name="price" value="<?php echo set_value('price'); ?>" class="form-control" onblur="priceCheckValidate();" required type="number"  step="1"  min="<?php echo MINPRICERANGE;?>" max="<?php echo MAXPRICERANGE;?>" />
                              		<div id="priceAjaxLoad" class="center"></div>
                        			<div id="priceError" hidden="true"></div>
                        
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" value="<?php echo set_value('negotiable'); ?>" id="negotiable" name="negotiable">
                                      <?php echo $Negotiable;?> 
                                  </label>
                              </div>
                          </div>
                      </div>


                      <!-- photo -->
                      <div class="form-group row">
                      	<label class="col-md-3 control-label text-center" for="textarea"> 
                              <i class="icon-camera-1"></i><abbr title="Min. 1 picture required.&#013;Max. 5 pictures allowed.&#013;Max. picture file size 4MB per each.&#013;First Picture is the default that will show to customer first."><?php echo $Picture;?></abbr><font color="red">*</font></label>
                           <div class="col-md-8">
                              <div class="mb10">
                                  <input id="image" name="images[]" class="file" type="file" accept="image/*" multiple="multiple">
                                    <div id="uploadImgError">
                                    </div>
                              </div>
                                  <p class="help-block">Add up to 5 photos. Use a better image of your product, not catalogs.</p>   
                          
                          </div>
                      </div>
					    <div class="form-group row">
                          <label class="col-md-3 control-label text-center"></label>
                          <div class="col-md-8"> 
                           
                       	       <button id="submit-upload-form" onclick="setup();return false;" class="btn btn-primary btn-tw" ><i class="glyphicon glyphicon-upload"></i>Submit</button>
                              <button id="validate" hidden="true" type="submit"></button>
                          </div>
                       </div>
                  </fieldset>
                    
          		  
                    <div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" tabindex="-1" role="dialog"  data-keyboard="false" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 id ="modal-text">Processing...<?php echo $PleaseNotCloseBrowse;?> <img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif"></h1>
                                </div>
                                <div class="modal-body">
                                    <div id="progress-bar" class="progress">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar" id="upload-progress-bar"
                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">   
                                        </div>
                                    </div>
									<button id="fwd-btn" class="btn btn-primary btn-tw" onclick="backHomePage(); return false;" style="display: none;"><i class="fa fa-check"></i>Go to Homepage</button>
                                </div>
                            </div>
                        </div>
                    </div>
        
        
                 </form> 
                
                
              </div>
            </div>
          </div>
        </div>
        <!-- /.page-content -->

        <div class="col-md-3 reg-sidebar">
          <div class="reg-sidebar-inner text-center">
            <div class="promo-text-box"> <i class="icon-lightbulb ln-shadow-radius shape-2"></i>
              <h3><strong>Create a Post</strong></h3>
              <p> Hints for posting on GirlsTrade. </p>
            </div>
            
            <div class="panel sidebar-panel">
              <div class="panel-heading newPostHints"><small><strong>What are the Hints?</strong></small></div>
              <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li> No images required under Service</li>
                    <li> Make sure you post in the correct category</li>
                    <li> Post value higher than $20 (HKD)</li>
                    <li> No adult-oriented content allowed</li>

                  </ul>
                </div>
              </div>
            </div>
            <div class="promo-text-box"> <i class=" icon-clock-2 ln-shadow-radius shape-4"></i>
              <h3><strong>Approval Time</strong></h3>
              <p> Post will be published within next 24 hours! </p>
            </div>
            <div class="panel sidebar-panel">
              <div class="panel-heading newPostHints"><small><strong>How to pass the approval process?</strong></small></div>
              <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li> Ensure image(s) is/are taken directly by you  </li>
                    <li> Make sure it is a descriptive and appropriate in your title and description</li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div><!--/.reg-sidebar-->
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.main-container -->
  
  
<!-- /.wrapper --> 

<!-- Le javascript
================================================== --> 


<?php include "footer1.php"; ?>


<script src="<?php echo base_url();?>assets/js/script.js"></script>
<link href="<?php echo base_url();?>assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/fileinput_locale_ch.js" type="text/javascript"></script>
<!--<script  type="text/javascript" data-my_var_1="<?php echo base_url(); echo MY_PATH;?>newPost/uploadImg" data-my_var_2="<?php echo base_url();?>assets/img/loading.gif" src="<?php echo base_url();?>assets/js/newTopic.js"></script>-->

<script>
var img = null;

var fileList = null;

function priceCheckValidate() {
 	if(!isInt($("#price").val())){
    	$("#priceAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Invalid price</span></em>');
		return false;
    }else if($("#price").val().trim().length==0) {
        $("#priceAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Price cannot be empty</span></em>');
        return false;
    }else if(parseInt($("#price").val())<<?php echo MINPRICERANGE;?> || parseInt($("#price").val())><?php echo MAXPRICERANGE;?>){
    	$("#priceAjaxLoad").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Invalid price range</span></em>');
    	return false;
    }else
	{
		$("#priceAjaxLoad").html('');
		return true;
	}
	
};

function isInt(value) {
	  var x;
	  if (isNaN(value)) {
	    return false;
	  }
	  x = parseFloat(value);
	  return (x | 0) === x;
	}

$( "#descriptionTextarea" ).blur(function() {
 
	$("#descriptionTextareaAjaxLoad").html('<img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif">');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>newPost/validateDescLength",
		data: { descTextarea: $( "#descriptionTextarea" ).val() },
		success: function(response){
			var result = JSON.parse(response);
	    	$("#error").html(result.message);
	    	$("#descriptionTextareaDiv").removeClass('has-success has-error').addClass(result.class);
	    	$("#descriptionTextareaAjaxLoad").html(result.icon);
	    	$("#descriptionTextareaError").html(result.err);
	    	}
	});
});

$("#image").fileinput({
    allowedFileExtensions : ['jpg', 'png','gif','jpeg','bmp'],
    maxFileCount:5,
    maxFileSize: 10000000,
	
	showUpload: false,
	uploadAsync: true,
    uploadUrl: "<?php echo base_url(); echo MY_PATH;?>newPost/createNewPost/<?php echo $userID.'/'.$username.'?prevURL='.urlencode($prevURL); ?>"
});

function setup()
{
	var myform = document.getElementById("myform");
	//check whether browser fully supports all File API
	if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		for(i=1;i<=5;i++)
		{
			//get the file size and file type from file input field
			try {
				$("#uploadImgError").html('');
				var fsize = $('#image').item(i).size;
				var ftype = $('#image').item(i).type;
				var fname = $('#image').item(i).name;
// 	            var fwidth=$('#image'+i)[0].files[0].clientwidth;
// 	            var fheigth=$('#image'+i)[0].files[0].clientheight;
				var img=document.getElementById('image').item(i);
				var fwidth=img.clientWidth;
				var fheight=img.clientHeight;
// 	            alert(fwidth);
// 	            alert(fheight);
			} catch(err)
			{
// 	            	 $("#uploadImgError"+i).html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Error!</span></em>');
// 	                 location.href = "#uploadImgError"+i;                 //Go to the target element.
// 	                 return false;
				continue;
			}
// 	            if(fwidth<800 || fheight<800)
// 	            {
// 	            	$("#uploadImgError"+i).html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Image Resolution need greater than 800x800t!</span></em>');
// 	                 location.href = "#uploadImgError"+i;                 //Go to the target element.
// 	                 return false; 
// 	            }
			if(fsize<500000){
				 $("#uploadImgError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Image is too small and need greater than 500KB.</span></em>');
				 location.href = "#uploadImgError";                 //Go to the target element.
				 return false; 
			}
			if(fsize>8048576) //do something if file size more than 1 mb (1048576)
			{
				 $("#uploadImgError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Exceed File Size Limit!</span></em>');
				 location.href = "#uploadImgError";                 //Go to the target element.
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
						 $("#uploadImgError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Unsupported File Type Images!</span></em>');
						location.href = "#uploadImgError";                 //Go to the target element.
						return false; 
				}
		}
	}else{

		 $("#uploadImgError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Please upgrade your browser, because your current browser lacks some new features we need!</span></em>');
		 location.href = "#uploadImgError";                 //Go to the target element.
		 return false; 
	}
	
// 	if(!myform.checkValidity())
// 	{
		
// 	        document.getElementById("validate").click();
// 	        return false;
// 	}
	if(!priceCheckValidate()){
		location.href = "#priceAjaxLoad";                 //Go to the target element.
		 return false; 
	}
	isEmptyUploadFile(function(r)
    {
        var up = document.getElementById('image').value;
        img=up;
        var checkServiceCategory=document.getElementById('category-group').value;
        <?php
                $serviceCatList='';
                foreach ($result as $id=>$value)
                {
                	if($value[0]->newPostNotRequiredImg==1){
                		$serviceCatList=$serviceCatList.$id.",";
                	}
                }
                ?>
                
            var serviceCatList='<?php echo $serviceCatList;?>';
			var isServiceCat=0;
			var fields=serviceCatList.split(',');
            for(var i=0; i< fields.length; i++){
				if(fields[i]==checkServiceCategory){
					isServiceCat=1;
					break;
				}
            }  
        if((isServiceCat!=1) && ( fileList == null || fileList.length == 0))
        {
               $("#uploadImgError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Please Upload at least one image!</span></em>');
	           location.href = "#uploadImgError";                 //Go to the target element.
	           return false;
        }
        else if(r == false)
        { 
            //myform.submit();
            $('#pleaseWaitDialog').modal('show');

            setForm(function(data)
            {
                if(data == true)
                {
					var formData = new FormData(myform);
					for (var i=0; i<fileList.length; i++){
						formData.append('filelist[]', fileList[i]); 
					}
					$('#image').fileinput('clear');
					$('#image').fileinput('disable');
					$('#Adtitle').attr('disabled', 'disabled');
					$('#soldqty').attr('disabled', 'disabled');
					$('#descriptionTextarea').attr('disabled', 'disabled');
					$('#tagsInput').attr('disabled', 'disabled');
					$('#submit-upload-form').attr('disabled', 'disabled');
					$('#price').attr('disabled', 'disabled');
					//console.log (formData.get('image'));
					$.ajax({
						xhr: function()
						{
							var xhr = new window.XMLHttpRequest();
							//Upload progress
							xhr.upload.addEventListener("progress", function(evt){
							  if (evt.lengthComputable) {
								var percentComplete = evt.loaded / evt.total*100;
								//Do something with upload progress
								$("#upload-progress-bar").width(percentComplete+"%");
								console.log(percentComplete);
							  }
							}, false);
							return xhr;
						},
						url: "<?php echo base_url(); echo MY_PATH;?>newPost/createNewPost/<?php echo $userID.'/'.$username.'?prevURL='.urlencode($prevURL); ?>",
						data: formData,
						processData: false,
						contentType: false,
						type: 'POST',
						success:function(msg){
							$("#modal-text").html("Your post has been successfully uploaded.");
							setTimeout(function(){
								//if($remainCount<=5)
								//	$("#modal-text").html("Your post will be reviewed and go on live within the next 24 hours. You have remain ".concat($remainCount).concat(" times of post"));
								//else
									$("#modal-text").html("Your post will be reviewed and go on live within the next 24 hours.");
								$('#fwd-btn').css("display", "block");
								$('#fwd-btn').css("margin", "auto");
								$('#progress-bar').css("display", "none");
							}, 2000);
						}
					});
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
	var checkServiceCategory=document.getElementById('category-group').value;
		<?php
            $serviceCatList='';
            foreach ($result as $id=>$value)
            {
            	if($value[0]->newPostNotRequiredImg==1){
            		$serviceCatList=$serviceCatList.$id.",";
            	}
            }
            ?>
            var serviceCatList='<?php echo $serviceCatList;?>';
			var isServiceCat=0;
			var fields=serviceCatList.split(',');
            for(var i=0; i< fields.length; i++){
				if(fields[i]==checkServiceCategory){
					isServiceCat=1;
					break;
				}
            } 

      
  if((isServiceCat!=1) && (fileList == null || fileList.length == 0))
	    callback(true);
    else
        callback(false);

}

function clearErrorMessage()
{
	$("#recaptchaError").html('');
}

function backHomePage(){
	window.location = "<?php echo base_url();?>";
}

</script>

<?php include "footer2.php"; ?>
  <!--/.footer--> 
</div>