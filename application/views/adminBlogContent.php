
          <div class="row">
            <div class="padding-left-30">
				
				
				<div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
				<form id="newPost" action="<?php echo base_url(); echo MY_PATH;?>getAdmin/uploadBlogPhoto" method="post" enctype="multipart/form-data">
					<div class="kv-avatar text-center" style="width:200px">
						<label>Picture 1</label>
						<input id="avatar1" name="avatar1" type="file" class="file-loading" accept="image/*">
						<div id="uploadImgError1"></div>
					</div>
					<div class="kv-avatar text-center" style="width:200px">
						<label>Picture 2</label>
						<input id="avatar2" name="avatar2" type="file" class="file-loading" accept="image/*">
						<div id="uploadImgError2"></div>
					</div>
					<div class="kv-avatar text-center" style="width:200px">
						<label>Picture 3</label>
						<input id="avatar3" name="avatar3" type="file" class="file-loading" accept="image/*">
						<div id="uploadImgError3"></div>
					</div>
					<br>
					<!-- include other inputs if needed and include a form submit (save) button -->
					<div style="width:400px">
						<label>Title</label>
						<textarea class="form-control" id="titleTextarea" name="titleTextarea" rows="4"  ><?php echo set_value('titleTextarea', $title); ?></textarea>
	                </div>
					<br>
	                <div style="width:400px">
						<label>Description</label>
						<textarea class="form-control" id="descriptionTextarea" name="descriptionTextarea" rows="4"  ><?php echo set_value('descriptionTextarea', $description); ?></textarea>
	                </div>
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
					<br/>
				    <button class="btn btn-primary" type="submit"  onclick="setup(); return false;">Submit</button>
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
				$("#avatar1").fileinput({
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
					defaultPreviewContent: '<img src="<?php echo base_url();?>images/upload.PNG" alt="Your Avatar" style="width:100px">',
					layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
					allowedFileExtensions: ["jpg", "png", "gif"]
				});
				$("#avatar2").fileinput({
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
					defaultPreviewContent: '<img src="<?php echo base_url();?>images/upload.PNG" alt="Your Avatar" style="width:100px">',
					layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
					allowedFileExtensions: ["jpg", "png", "gif"]
				});
				$("#avatar3").fileinput({
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
					defaultPreviewContent: '<img src="<?php echo base_url();?>images/upload.PNG" alt="Your Avatar" style="width:100px">',
					layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
					allowedFileExtensions: ["jpg", "png", "gif"]
				});
				function upload()
				{
					var myform = document.getElementById("newPost");

					//var fileNo1 = document.getElementById('avatar1').files.length;
					//var fileNo2 = document.getElementById('avatar2').files.length;
					//var fileNo3 = document.getElementById('avatar3').files.length;
					
					
					//if(fileNo1 == 0)
					//{
					//   $("#uploadImgError1").html('<em><span style="color:red"> <i class="icon-cancel-1 fa"></i> Please Upload at least one image!</span></em>');
					//   return false; 
					//}
					//else //if(r == false)
					//{
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
									url: "<?php echo base_url(); echo MY_PATH;?>getAdmin/uploadBlogPhoto",
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
				//}
				</script>
				
       
           	
            </div>
            </div>
         