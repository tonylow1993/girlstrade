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
      <div class="row">
        <div class="col-md-9 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> <?php echo $NewPost;?><br/> (<?php echo $YouHaveRemainPost;?>)</strong> </h2>
            <div class="row">
              <div class="col-sm-12">
                <form id="newPost" class="form-horizontal" method="post" enctype="multipart/form-data"
                      action="<?php echo base_url(); echo MY_PATH;?>newPost/createNewPost/<?php echo $userID.'/'.$username.'?prevURL='.urlencode($prevURL); ?>">
                  <fieldset>
                      
                      <!-- Text input-->
                      <div class="form-group">
                          <label class="col-md-3 control-label text-center" for="Adtitle"><i class="icon-pencil"></i> <?php echo $TopicTitle;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <input id="Adtitle" name="Adtitle" class="form-control input-md" type="text" required="true"  maxlength="100"/>
<!--                        <span class="help-block">A great title needs at least 5 words </span> -->
                              <em>(A Great Title Needs At Least 5 Words) </em>
                          </div>
                      </div>  
                      
                      <!-- Select Basic -->
                      <div id="generalCat" class="form-group">
                          <label class="col-md-3 control-label text-center" > <?php echo $Category;?> <font color="red">*</font></label>
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
						            	if($value[0]->level==1)
						            		echo "<option value=\"$id\" style=\"background-color:#E9E9E9;font-weight:bold;\" > - $name - </option>";
						            	else 
						            		echo "<option value=\"$id\"> $name </option>";
						            	}
						            ?>
                              </select>
                          </div>
                      </div>
                               
                      
                      <!-- Select Basic -->
                      <div id="itemQuality" class="form-group">
                          <label class="col-md-3 control-label text-center" > <?php echo $ItemQuality;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <select name="itemQualityGroup" id="itemQualityGroup" class="form-control" required="true">
<                                  <option value="" style="background-color:#E9E9E9;font-weight:bold;"> - Please Select - </option>
                                   <option value="N"> New </option>
                                   <option value="U"> Used </option>
                              </select>
                          </div>
                      </div>
                      <div id="itemQty" class="form-group">
                          <label class="col-md-3 control-label text-center" > Quantity <font color="red">*</font></label>
                          <div class="col-md-8">
                           
                              <select required="true" class="form-control" name="soldqty" id="soldqty">
		        				  <option value="1"> 1 </option>
		                                   <option value="2"> 2 </option>
		        					</select>
                          </div>
                      </div>
                      
                   
                      
                      
                      
                      <!-- Textarea -->
                      <div class="form-group">
                          <label class="col-md-3 control-label text-center" for="textarea"> <?php echo $Description;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <textarea class="form-control" id="descriptionTextarea" name="descriptionTextarea" rows="4"  required="true"  maxlength="450"></textarea>
                          </div>
                      </div>
                    
                      <!-- Prepended text-->
                      <div class="form-group">
                          <label class="col-md-3 control-label text-center" for="Price"><i class="icon-money"></i> <?php  echo $HKDPrice;?> <font color="red">*</font></label>
                          <div class="col-md-4">
                              <div class="input-group"> <span class="input-group-addon">$</span>
                                  <input id="price" name="price" class="form-control" required="true" type="number" step="0.1" min=0>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" id="negotiable" name="negotiable">
                                      <?php echo $Negotiable;?> 
                                  </label>
                              </div>
                          </div>
                      </div>


                      <!-- photo -->
                      <div class="form-group">
                      	<label class="col-md-3 control-label text-center" for="textarea"> 
                              <i class="icon-camera-1"></i><?php echo $Picture;?> 
                              <br /> ( Minimum 1 picture required. Max picture file size is 4MB per each. First Picture is the default that will show to customer first) 
                          </label>
                           <div class="col-md-8">
                              <div class="mb10">
                                  <input id="image" name="images[]" class="file" type="file" accept="image/*" multiple>
                                    <div id="uploadImgError">
                                    </div>
                              </div>
                              <!--<div class="mb10">
                                  <input id="image2" name="image2" class="file" type="file" accept="image/*">
                              		<div id="uploadImgError2">
                                    </div>
                              </div>
                              <div class="mb10">
                                  <input id="image3" name="image3" class="file" type="file" accept="image/*">
                              		<div id="uploadImgError3">
                                    </div>
                              </div>
                              <div class="mb10">
                                  <input id="image4" name="image4" class="file" type="file" accept="image/*">
                              		<div id="uploadImgError4">
                                    </div>
                              </div>
                              <div class="mb10">
                                  <input id="image5" name="image5" class="file" type="file" accept="image/*">
                              		<div id="uploadImgError5">
                                    </div>
                              </div>-->
                                  <p class="help-block">Add up to 5 photos. Use a better image of your product, not catalogs.</p>   
                          
                          </div>
                      </div>
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  <div class="form-group">
					  <label class="col-md-3 control-label text-center" for="textarea"><?php $Extra;?> </label>
					  <div class="col-md-8">
					  <div class="panel-group" id="accordion">
						  <div class="panel panel-info">
							<div class="panel-heading collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">
							  <h4 class="panel-title accordion-toggle">
								  <?php echo $ExtraInfo;?>
							  </h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse">
							  <div class="panel-body">
								
								
								
								
								
								
								 <!-- Textarea -->
                      <div class="form-group">
                          <label class="col-md-3 control-label text-center" for="textarea"><?php echo $SearchTags;?></label>
                          <div class="col-md-8">
                              <input class="form-control" data-role="tagsinput" id="tagsInput" name="tagsInput" />
                              <em>(Maximum: Five Tags Allowed)</em>
                          </div>
                      </div>
                     <script>
                            $('input').on('beforeItemAdd', function(event) {
                                var elt = $('#tagsInput');
                                //console.log("Input: " +event.item);
                                // event.item: contains the item
                                // event.cancel: set to true to prevent the item getting added
                                                    var $keywords = $("#tagsInput").siblings(".tagsinput").children(".tag");  
                                                    var tags = [];  
                                                    //console.log($keywords.length);
                                                    for (var i = $keywords.length; i--;) {  
                                                        tags.push($($keywords[i]).text().trim());  
                                                    }  
                                                    //console.log(tags);
                              });
                              $('input').on('itemAdded', function(event) {
                              //    var str =  $( this ).serialize() 
                              //    console.log(str);

                             //document.write($( this ).serialize());
                              });
                              $('input').on('beforeItemRemove', function(event) {
                                //document.write($( this ).serialize());
                                });
                      </script>

                      
								
								
								
								
								
								
								
								
								
								
								
								
								
								
						<div id="generalLocation" class="form-group">
                          <label class="col-md-3 control-label text-center" ><?php echo $lblLocation;?></label>
                         
                      <div class="col-md-8">
				          <select class="form-control" name="locID2" id="locID2" >
				            <option selected="selected" value=""><?php echo $lblAllLocations;?> </option>
				            <?php 
				            foreach ($resLoc as $id=>$value)
				            {
				            	if(!isset($lang_label))
					            		$lang_label="";
				            	$name=$value[0]->name;
				            	if($lang_label<>"english")
				            		$name=$value[0]->nameCN;
				            	if($value[0]->level==1)
				            		echo "<option value=\"$id\" style=\"background-color:#E9E9E9;font-weight:bold;\" disabled=\"disabled\"> - $name - </option>";
				            	else 
				            		echo "<option value=\"$id\"> $name </option>";
				            	}
				            ?>
				          </select>
				        </div>
				        </div>







						
								
								
								
								
								
								
								
								
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					  </div>
                     
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
                                          <!-- Button  -->
                      <div class="form-group">
                          <label class="col-md-3 control-label text-center"></label>
                          <div class="col-md-8"> 
                       	       <button type="submit" class="btn btn-primary btn-tw" onclick="setup(); return false;"><i class="glyphicon glyphicon-upload"></i>Submit</button>
                              <button id="validate" hidden="true" type="submit"></button>
                          </div>
                       </div>
                  </fieldset>
                    
          		  
                    <div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" tabindex="-1" role="dialog"  data-keyboard="false" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1>Processing...<?php echo $PleaseNotCloseBrowse;?> <img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif"></h1>
                                </div>
                                <div class="modal-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">   
                                        </div>
                                    </div>

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
            <div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
              <h3><strong>Post a Free Classified</strong></h3>
              <p> Post your free online classified ads with us. </p>
            </div>
            
            <div class="panel sidebar-panel">
              <div class="panel-heading uppercase"><small><strong>How to sell quickly?</strong></small></div>
              <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li> Use a brief title and  description of the item  </li>
                    <li> Make sure you post in the correct category</li>
                    <li> Add nice photos to your ad</li>
                    <li> Put a reasonable price</li>
                    <li> Check the item before publish</li>

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
<script src="<?php echo base_url();?>assets/js/fileinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/fileinput_locale_ch.js" type="text/javascript"></script>
<!--<script  type="text/javascript" data-my_var_1="<?php echo base_url(); echo MY_PATH;?>newPost/uploadImg" data-my_var_2="<?php echo base_url();?>assets/img/loading.gif" src="<?php echo base_url();?>assets/js/newTopic.js"></script>-->

<script>
var img = null;

$("#image").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif','jpeg','bmp'],
    //'elErrorContainer': '#errorBlock',
    'showUpload' : false,
    'maxFileCount':5,
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
	
	if(!myform.checkValidity())
	{
		
	        document.getElementById("validate").click();
	        return false;
	}
    isEmptyUploadFile(function(r)
    {
        var up = document.getElementById('image').value;
        img=up;
        
        if(up == "")
        {
           $("#uploadImgError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Please Upload at least one image!</span></em>');
           location.href = "#uploadImgError";                 //Go to the target element.
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
    if(img == null)
        callback(true);
    else
        callback(false);

}
    function clearErrorMessage()
    {
        $("#recaptchaError").html('');
    }

   
   
</script>

<?php include "footer2.php"; ?>
  <!--/.footer--> 
  </div>
