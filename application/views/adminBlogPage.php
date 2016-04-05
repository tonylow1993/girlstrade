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
        <?php include("admin_sidebar.php");?>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
           <div class="inner-box">
            <h2 class="title-2"><i class="icon-star-circled"></i> <?php echo $this->lang->line("adminBlog"); ?> </h2>
             
             	<?php include("adminBlogContent.php");?>
				<?php include("adminBlogContentHistory.php");?>
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
  <div class="modal fade" id="deleteBlogPopup" tabindex="-1" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 id="modal-title-del" class="modal-title"><?php echo $this->lang->line("popupTitleDeleteAds");?></h2>
      </div>
      <div class="modal-body">
        <form role="form" id="itemDelete" method="post" action="<?php echo base_url(); echo MY_PATH;?>messages/deleteMyAds">
           <div class="form-group">
           		<input type="hidden" id="blogID" name="blogID" >   	
           		<input id="blogTitle" name="blogTitle"/>
           		<br/><input id="blogDescription" name="blogDescription" />	
           	</div>
        </form>
      </div>
      <div class="modal-footer">
		<button id="fwd-btn" class="btn btn-primary btn-tw" onclick="location.reload();" style="display: none;"><i class="fa fa-check"></i> Confirm</button>
      	<button id="cancel-btn" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="submit-btn" type="button" class="btn btn-success pull-right"   onclick="setupDeleteBlog(); return false;">Submit</button>
        	<button id="validate" hidden="true" type="submit"></button>
  
     	 </div>
    </div>
  </div>
</div>
  
  
  
  
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
function passToModal() {
    $('#deleteBlogPopup').on('show.bs.modal', function(event) {
        $("#blogID").val($(event.relatedTarget).data('id'));
        $("#blogTitle").val($(event.relatedTarget).data('title'));
        $("#blogDescription").val($(event.relatedTarget).data('description'));
    });

}
$(document).ready(passToModal());

function setupDeleteBlog()
{
	$("#modal-title-del").html("Processing...");
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); echo MY_PATH;?>getAdmin/deleteBlogByID",
		data: { 
			blogID: $("#blogID").val(),
		},
		success: function(response){
			$("#modal-title-del").html("Your blog has been deleted.");
			$('#fwd-btn').css("display", "block");
			$('#fwd-btn').css("margin", "auto");
			$('#cancel-btn').css("display", "none");
			$('#submit-btn').css("display", "none");
			
			console.log("success");
		}
	});


     //var myform = document.getElementById("itemDelete");
	  	//document.getElementById("itemDelete").submit();
    return false;
}
</script>


</div>



<?php include "footer2.php"; ?>
