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
input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 10px;
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
.panel-heading.collapsed .accordion-toggle:after {
    /* symbol for "collapsed" panels */
    content:"\f0fe";
}
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-tagsinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-tagsinput.js"></script>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

<!-- /.header -->
  <div id="wrapper">
   <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-9 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> <?php echo $NewPost;?></strong> </h2>
            <div class="row">
              <div class="col-sm-12">
                <form id="newPost" class="form-horizontal" method="post" enctype="multipart/form-data"
                      action="<?php echo base_url(); echo MY_PATH;?>newPost/editPost/<?php echo $postID;?>?prevURL=<?php  echo urlencode($prevURL); ?>">
                  <fieldset>
                      
                      <!-- Text input-->
                      <div class="form-group">
                          <label class="col-md-3 control-label" for="Adtitle"><i class="icon-pencil"></i> <?php echo $TopicTitle;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <input id="Adtitle" name="Adtitle" value="<?php echo $itemNameValue;?>" class="form-control input-md" type="text" required="true"  maxlength="100"/>
<!--                        <span class="help-block">A great title needs at least 5 words </span> -->
                              <em>(A Great Title Needs At Least 5 Words) </em>
                          </div>
                      </div>  
                      
                      <!-- Select Basic -->
                      <div id="generalCat" class="form-group">
                          <label class="col-md-3 control-label" > <?php echo $Category;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <select name="category-group" id="category-group" class="form-control" required="true">
                                  <?php 
                                  $str="";
                                  if($catIDValue=="" or $catIDValue==0)
                                  	$str=" selected='selected' ";
                                   
                                  	echo "<option ".$str." value=\"\" style=\"background-color:#E9E9E9;font-weight:bold;\"> - Please Select One Category - </option>";
                                  	
						            foreach ($result as $id=>$value)
						            {
						            	$str="";
						            	if(!isset($lang_label))
							            		$lang_label="";
						            	$name=$value[0]->name;
						            	if($lang_label<>"english")
						            		$name=$value[0]->nameCH;
						            	if($value[0]->level==1){
						            		if(strcmp($catIDValue,$id)==0)
						            			$str=" selected='selected' ";
						            		echo "<option ".$str." value=\"$id\" style=\"background-color:#E9E9E9;font-weight:bold;\"> - $name - </option>";
						            	}else 
						            	{
						            		if(strcmp($catIDValue,$id)==0)
						            			$str=" selected='selected' ";
						            		echo "<option ".$str." value=\"$id\"> $name </option>";
						            	}
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
                                  <?php
                                  $str="";
                                  if($newUsedValue=='')
                                  	$str=" selected='selected' ";
                                  echo "<option value=''".$str." style=\"background-color:#E9E9E9;font-weight:bold;\"> - Please Select - </option>";
                                  $str="";
                                  if($newUsedValue=='N')
                                  	$str=" selected='selected' ";
                                   echo "<option value=\"N\"". $str."> New </option>";
                                   $str="";
                                   if($newUsedValue=='U')
                                   	$str=" selected='selected' ";
                                   echo "<option value=\"U\"".$str."> Used </option>";
                                   ?>
                              </select>
                          </div>
                      </div>
					  
                      
                      
                      
                      <!-- Textarea -->
                      <div class="form-group">
                          <label class="col-md-3 control-label" for="textarea"> <?php echo $Description;?> <font color="red">*</font></label>
                          <div class="col-md-8">
                              <textarea class="form-control" id="descriptionTextarea" name="descriptionTextarea" rows="4"  required="true"  maxlength="450">
                              <?php echo htmlspecialchars($descriptionValue);?>
                              </textarea>
                          </div>
                      </div>
                    
                      <!-- Prepended text-->
                      <div class="form-group">
                          <label class="col-md-3 control-label" for="Price"><i class="icon-money"></i> <?php  echo $HKDPrice;?> <font color="red">*</font></label>
                          <div class="col-md-4">
                              <div class="input-group"> <span class="input-group-addon">$</span>
                                  <input id="price" name="price" value="<?php echo $itemPriceValue;?>" class="form-control" required="true" type="number" step="0.1" min=0>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="checkbox">
                                  <label>
                                  	<?php 
                                  		$str='';
                                  		if($infoDisplayStatus==1){
                                  			$str=" checked ";
                                  		}
                                  		echo "<input type=\"checkbox\" ".$str." id=\"negotiable\" name=\"negotiable\">";
                                  		echo $Negotiable;
                                  	?>
                                      
                                  </label>
                              </div>
                          </div>
                      </div>


                      <!-- photo -->
                      <div class="form-group">
                      	<label class="col-md-3 control-label" for="textarea"> 
                              <i class="icon-camera-1"></i><?php echo $Picture;?> 
                              <br /> ( Minimum 1 picture required.) 
                          </label>
                           <div class="col-md-8">
                              <div class="mb10">
                                  <input id="image1" name="image1" <?php echo $disableimage1;?> value="<?php echo $imageFile1;?>" class="file" type="file" accept="image/*">
                                    <?php if($imageFile1!='#'){?>
                              	   <img id="readImage1" src="<?php echo $imageFile1;?>" alt="readImage1" />
                              	   <?php }?>
                                    <div id="uploadImgError1">
                                    </div>
                              </div>
                              <div class="mb10">
                                  <input id="image2" name="image2" <?php echo $disableimage2;?> value="<?php echo $imageFile2;?>" class="file" type="file" accept="image/*">
                              	   <?php if($imageFile2!='#'){?>
                              	    <img id="readImage2" src="<?php echo $imageFile2;?>" alt="readImage2" />
                              	    <?php }?>
                                   <div id="uploadImgError2">
                                    </div>
                              </div>
                              <div class="mb10">
                                  <input id="image3" name="image3" <?php echo $disableimage3;?> value="<?php echo $imageFile3;?>" class="file" type="file" accept="image/*">
                              	  <?php if($imageFile3!='#'){?>
                              	    <img id="readImage3" src="<?php echo $imageFile3;?>" alt="readImage3" />
                              	    <?php }?>
                                 	<div id="uploadImgError3">
                                    </div>
                              </div>
                              <div class="mb10">
                                  <input id="image4" name="image4" <?php echo $disableimage4;?> value="<?php echo $imageFile4;?>" class="file" type="file" accept="image/*">
                              	   <?php if($imageFile4!='#'){?>
                              	   <img id="readImage4" src="<?php echo $imageFile4;?>" alt="readImage4" />
                              	   <?php }?>
                                 	<div id="uploadImgError4">
                                    </div>
                              </div>
                              <div class="mb10">
                                  <input id="image5" name="image5" <?php echo $disableimage5;?> value="<?php echo $imageFile5;?>" class="file" type="file" accept="image/*">
                              	   <?php if($imageFile5!='#'){?>
                              	   <img id="readImage5" src="<?php echo $imageFile5;?>" alt="readImage5" />
                                 	<?php }?>
                                 	<div id="uploadImgError5">
                                    </div>
                              </div>
                                  <p class="help-block">Add up to 5 photos. Use a real image of your product, not catalogs.</p>   
                          
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
				          
				          
				           <?php 
				            $str="";
                                  if($locIDValue=="" or $locIDValue==0)
                                  	$str=" selected='selected' ";
                                 echo "<option ".$str." value=\"\" style=\"background-color:#E9E9E9;font-weight:bold;\"> - Please Select Location - </option>";
                              
				            foreach ($resLoc as $id=>$value)
				            {
				            	if(!isset($lang_label))
					            		$lang_label="";
				            	$name=$value[0]->name;
				            	if($lang_label<>"english")
				            		$name=$value[0]->nameCN;
				            	if($value[0]->level==1){
				            		$str="";
				            		if(strcmp($locIDValue,$id)==0)
				            			$str=" selected='selected' ";
				            			echo "<option ".$str." value=\"$id\" style=\"background-color:#E9E9E9;font-weight:bold;\" disabled=\"disabled\"> - $name - </option>";
				            		}else {
				            			$str="";
				            			if(strcmp($locIDValue,$id)==0)
				            				$str=" selected='selected' ";
				            			echo "<option ".$str." value=\"$id\"> $name </option>";
				            		}
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


<?php include "footer1.php"; ?>


<script src="<?php echo base_url();?>assets/js/script.js"></script>
<link href="<?php echo base_url();?>assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/js/fileinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/fileinput_locale_ch.js" type="text/javascript"></script>
<!--<script  type="text/javascript" data-my_var_1="<?php echo base_url(); echo MY_PATH;?>newPost/uploadImg" data-my_var_2="<?php echo base_url();?>assets/img/loading.gif" src="<?php echo base_url();?>assets/js/newTopic.js"></script>-->

<script>
var img1 = null;
var img2 = null;
var img3 = null;
var img4 = null;
var img5 = null;


$("#image1").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif','bmp'],
    //'elErrorContainer': '#errorBlock',
    'showUpload' : false,
    'maxFileCount':1,
    'maxFileSize': 10000000
    //'dropZoneEnabled' : false,
    //'uploadUrl': 'test.php'
});

$("#image2").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif', 'bmp'],
    'showUpload' : false,
    'maxFileCount':1,
    'maxFileSize': 10000000
});

$("#image3").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif', 'bmp'],
    'showUpload' : false,
    'maxFileCount':1,
    'maxFileSize': 10000000
});


$("#image4").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif', 'bmp'],
    'showUpload' : false,
    'maxFileCount':1,
    'maxFileSize': 10000000
});

$("#image5").fileinput({
    'showPreview' : true,
    'allowedFileExtensions' : ['jpg', 'png','gif', 'bmp'],
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
	            var fsize = $('#image'+i)[0].files[0].size;
	            var ftype = $('#image'+i)[0].files[0].type;
	            var fname = $('#image'+i)[0].files[0].name;
	            } catch(err)
	            {
// 	            	 $("#uploadImgError"+i).html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i>Error!</span></em>');
// 	                 location.href = "#uploadImgError"+i;                 //Go to the target element.
// 	                 return false;
					continue;
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
                        case 'image/jpeg':
                        case 'image/pjpeg':
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
        
//         if((up1 == "" && up2 == "" && up3 == "" && up4 == "" && up5 == "") )
//         {
//            $("#uploadImgError1").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Please Upload at least one image!</span></em>');
//            location.href = "#uploadImgError1";                 //Go to the target element.
//            return false; 
//         }
//         else //if(r == false)
//         {
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
//         }
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

    function readURLimage1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#readImage1')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLimage2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#readImage2')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLimage3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#readImage3')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLimage4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#readImage4')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLimage5(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#readImage5')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
   
</script>

<?php include "footer2.php"; ?>
  <!--/.footer--> 
  </div>
