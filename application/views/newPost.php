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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-tagsinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-tagsinput.js"></script>

<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.fileupload-ui.css">


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
                          <label class="col-md-3 control-label" for="Adtitle"><i class="icon-pencil"></i> <?php echo $TopicTitle;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <input id="Adtitle" name="Adtitle" class="form-control input-md" type="text" required="true"  maxlength="100"/>
<!--                        <span class="help-block">A great title needs at least 5 words </span> -->
                              <em>(A Great Title Needs At Least 5 Words) </em>
                          </div>
                      </div>  
                      
                      <!-- Select Basic -->
                      <div id="generalCat" class="form-group">
                          <label class="col-md-3 control-label" > <?php echo $Category;?> <font color="red">*</font></label>
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
                          <label class="col-md-3 control-label" > <?php echo $ItemQuality;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <select name="itemQualityGroup" id="itemQualityGroup" class="form-control" required="true">
<                                  <option value="" style="background-color:#E9E9E9;font-weight:bold;"> - Please Select - </option>
                                   <option value="N"> New </option>
                                   <option value="U"> Used </option>
                              </select>
                          </div>
                      </div>
					  
                      
                      
                      
                      <!-- Textarea -->
                      <div class="form-group">
                          <label class="col-md-3 control-label" for="textarea"> <?php echo $Description;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <textarea class="form-control" id="descriptionTextarea" name="descriptionTextarea" rows="4"  required="true"  maxlength="450"></textarea>
                          </div>
                      </div>
                    
                      <!-- Prepended text-->
                      <div class="form-group">
                          <label class="col-md-3 control-label" for="Price"><i class="icon-money"></i> <?php  echo $HKDPrice;?> <font color="red">*</font></label>
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
                      	<label class="col-md-3 control-label" for="textarea"> 
                              <i class="icon-camera-1"></i><?php echo $Picture;?> 
                              <br /> ( Minimum 1 picture required. Max picture file size is 4MB per each. First Picture is the default that will show to customer first) 
                          </label>
                           <div class="col-md-8">
                              <div class="mb10">
                                <span class="btn btn-success fileinput-button">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Add files...</span>
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="files[]" multiple>
                                </span>
                                <br>
                                <br>
                                <!-- The global progress bar -->
                                <div id="progress" class="progress">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                                <!-- The container for the uploaded files -->
                                <div id="files" class="files"></div>
                              </div>
                              <p class="help-block">Add up to 5 photos. Use a better image of your product, not catalogs.</p>   
                          
                          </div>
                      </div>
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  <div class="form-group">
					  <label class="col-md-3 control-label" for="textarea"><?php $Extra;?> </label>
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
                          <label class="col-md-3 control-label" for="textarea"><?php echo $SearchTags;?></label>
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
                          <label class="col-md-3 control-label" ><?php echo $lblLocation;?></label>
                         
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
                          <label class="col-md-3 control-label"></label>
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
<!--<script src="<?php echo base_url();?>assets/js/fileupload/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url();?>assets/js/fileupload/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo base_url();?>assets/js/fileupload/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo base_url();?>assets/js/fileupload/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!--<script src="<?php echo base_url();?>assets/js/fileupload/bootstrap.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url();?>assets/js/fileupload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url();?>assets/js/fileupload/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url();?>assets/js/fileupload/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url();?>assets/js/fileupload/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<!--<script src="<?php echo base_url();?>assets/js/fileupload/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<!--<script src="<?php echo base_url();?>assets/js/fileupload/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url();?>assets/js/fileupload/jquery.fileupload-validate.js"></script>
<script>
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    var maxFiles = 5;
    var counter = 0;
    var processCtr = 0;
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 4000000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        if(counter < maxFiles){
            counter++;
            data.context = $('<div/>').appendTo('#files');
            $.each(data.files, function (index, file) {
                var node = $('<p/>')
                        .append($('<span/>').text(file.name));
                if (!index) {
                    node
                        .append('<br>')
                        .append(uploadButton.clone(true).data(data));
                }
                node.appendTo(data.context);
            });
        }else {
            alert("The max number of files is "+maxFiles);
            return false;
        }
    }).on('fileuploadprocessalways', function (e, data) {
        if(processCtr < maxFiles){
          var index = data.index,
              file = data.files[index],
              node = $(data.context.children()[index]);
          if (file.preview) {
              node
                  .prepend('<br>')
                  .prepend(file.preview);
          }
          if (file.error) {
              node
                  .append('<br>')
                  .append($('<span class="text-danger"/>').text(file.error));
          }
          if (index + 1 === data.files.length) {
              data.context.find('button')
                  .text('Upload')
                  .prop('disabled', !!data.files.error);
          }
          processCtr++;
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>

<?php include "footer-no-jquery.php"; ?>


<!--<script src="<?php echo base_url();?>assets/js/script.js"></script>
<link href="<?php echo base_url();?>assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/js/fileinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/fileinput_locale_ch.js" type="text/javascript"></script>
<!--<script  type="text/javascript" data-my_var_1="<?php echo base_url(); echo MY_PATH;?>newPost/uploadImg" data-my_var_2="<?php echo base_url();?>assets/img/loading.gif" src="<?php echo base_url();?>assets/js/newTopic.js"></script>-->

<!--<script>
var img1 = null;
var img2 = null;
var img3 = null;
var img4 = null;
var img5 = null;


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

$("#image2").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif','jpeg', 'bmp'],
    'showUpload' : false,
    'maxFileCount':1,
    'maxFileSize': 10000000
});

$("#image3").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif', 'jpeg','bmp'],
    'showUpload' : false,
    'maxFileCount':1,
    'maxFileSize': 10000000
});


$("#image4").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif', 'jpeg','bmp'],
    'showUpload' : false,
    'maxFileCount':1,
    'maxFileSize': 10000000
});

$("#image5").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif','jpeg', 'bmp'],
    'showUpload' : false,
    'maxFileCount':1,
    'maxFileSize': 10000000
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
	            	$("#uploadImgError"+i).html('');
	            var fsize = $('#image'+i)[0].files[0].size;
	            var ftype = $('#image'+i)[0].files[0].type;
	            var fname = $('#image'+i)[0].files[0].name;
// 	            var fwidth=$('#image'+i)[0].files[0].clientwidth;
// 	            var fheigth=$('#image'+i)[0].files[0].clientheight;
	            var img=document.getElementById('image'+i);
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
					 $("#uploadImgError"+i).html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Image is too small and need greater than 500KB.</span></em>');
	                 location.href = "#uploadImgError"+i;                 //Go to the target element.
	                 return false; 
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

        }else{

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
        var up2 = document.getElementById('image2').value;
        var up3 = document.getElementById('image3').value;
        var up4 = document.getElementById('image4').value;
        var up5 = document.getElementById('image5').value;
        img1=up1;
        img2=up2;
        img3=up3;
        img4=up4;
        img5=up5;
        
        if((up1 == "" && up2 == "" && up3 == "" && up4 == "" && up5 == "") )
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
    if(img1 == null && img2 == null && img3 == null && img4 == null && img5 == null)
        callback(true);
    else
        callback(false);

}
    function clearErrorMessage()
    {
        $("#recaptchaError").html('');
    }

   
   
</script>--> 

<?php include "footer2.php"; ?>
  <!--/.footer--> 
  </div>
