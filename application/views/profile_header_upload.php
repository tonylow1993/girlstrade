<div class="inner-box">
          <div class="row">
            <div class="col-md-5 col-xs-4 col-xxs-12">
				
				
				<div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
				<form id="newPost" class="text-center" action="<?php echo base_url(); echo MY_PATH;?>home/uploadPhoto/<?php echo $userID.'/'.$userName; ?>" method="post" enctype="multipart/form-data">
					<div class="kv-avatar center-block" style="width:200px">
						<h3><?php echo $userName; ?> </h3>
						<input id="avatar" name="avatar" type="file" class="file-loading" accept="image/*">
						<div id="uploadImgError"></div>
					</div>
					<!-- include other inputs if needed and include a form submit (save) button -->
					
					<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" tabindex="-1" role="dialog"  data-keyboard="false" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h1 id="modal-text">Processing...<?php echo $this->lang->line("PleaseNotCloseBrowse");?> <img alt="loading..." src="<?php echo base_url();?>assets/img/loading.gif"></h1>
							</div>
							<div class="modal-body">
								<div class="progress">
									<div id="upload-progress-bar" class="progress-bar progress-bar-striped active" role="progressbar"
										 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">   
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				</form>
				<style>
				.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
					margin: 0;
					padding: 0;
					border: none;
					box-shadow: none;
					text-align: center;
					width: 100% !important;
				}
				.kv-avatar .file-input {
					display: block;
					max-width: 220px;
				}
				.file-preview-frame .file-preview-image{
					width: 100% !important;
					height: auto !important;
					max-width: 100%;
					max-height: 150px;
				}
				</style>
				<script src="<?php echo base_url();?>assets/js/fileinput2.js" type="text/javascript"></script>
				<script src="<?php echo base_url();?>assets/js/fileinput_locale_ch.js" type="text/javascript"></script>
				<script>
				var btnCust = '<button type="submit" class="btn btn-default" title="Upload your avatar" ' + 
					'onclick="upload(); return false;">' +
					'<i class="glyphicon glyphicon-upload"></i>' +
					'</button>'; 
				$("#avatar").fileinput({
					overwriteInitial: true,
					maxFileSize: 1500,
					showClose: false,
					showCaption: false,
					browseLabel: '',
					removeLabel: '',
					browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
					removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
					removeTitle: 'Cancel or reset changes',
					elErrorContainer: '#kv-avatar-errors',
					msgErrorClass: 'alert alert-block alert-danger',
					defaultPreviewContent: '<img src="<?php echo $userPhotoPath;?>" alt="Your Avatar" style="width:100px">',
					layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
					allowedFileExtensions: ["jpg", "png", "gif"]
				});
				
				function upload()
				{
					var myform = document.getElementById("newPost");

					var fileNo = document.getElementById('avatar').files.length;
					
					console.log(fileNo);
					
					if(fileNo == 0)
					{
					   $("#uploadImgError").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Please Upload at least one image!</span></em>');
					   return false; 
					}
					else //if(r == false)
					{
						$('#pleaseWaitDialog').modal('show');

						setForm(function(data)
						{
							if(data == true)
							{
								var formData = new FormData(myform);
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
										  }
										}, false);
										return xhr;
									},
									url: "<?php echo base_url(); echo MY_PATH;?>home/uploadPhoto/<?php echo $userID.'/'.$userName; ?>",
									data: formData,
									processData: false,
									contentType: false,
									type: 'POST',
									success:function(msg){
										$("#modal-text").html("Your avatar has been successfully uploaded.");
										setTimeout(function(){location.reload();}, 2000);
									}
								});
							}
							return data;
						});
					}
				}
				</script>
				
       
           	
            </div>
            <div class="col-md-7 col-xs-8 col-xxs-12">
              <div class="header-data text-center-xs"> 
                
                <!-- Traffic data -->
                <div class="hdata">
                  <div class="mcol-left"> 
                    <!-- Icon with red background --> 
                    <i class="fa fa-eye ln-shadow shape-8"></i> </div>
                  <div class="mcol-right"> 
                    <!-- Number of visitors -->
                    <p><a href="#"><?php echo $visitCount; ?></a> <em>visits</em></p>
                  </div>
                  <div class="clearfix"></div>
                </div>
                
                <!-- revenue data -->
                <div class="hdata">
                  <div class="mcol-left"> 
                    <!-- Icon with green background --> 
                    <i class="icon-th-thumb ln-shadow shape-4"></i> </div>
                  <div class="mcol-right"> 
                    <!-- Number of visitors -->
                    <p><a href="#"><?php echo $totalMyAdsCount;?></a><em>Ads</em></p>
                  </div>
                  <div class="clearfix"></div>
                </div>
                
                <!-- revenue data -->
                <div class="hdata">
                  <div class="mcol-left"> 
                    <!-- Icon with blue background --> 
                    <i class="fa fa-user ln-shadow shape-5"></i> </div>
                  <div class="mcol-right"> 
                    <!-- Number of visitors -->
                    <p><a href="#"><?php echo $favoriteAdsCount;?></a> <em>Favorites </em></p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
          </div>
   
