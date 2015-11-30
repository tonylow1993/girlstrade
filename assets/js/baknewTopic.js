var base_url = '';
var loading_icon = '';
var image1 = {
    fileName:"", 
    image:null,
    timage:null, 
    status:"empty", 
    imgNum:"1"};
var image2 = {fileName:"", image:null, timage:null, status:"empty", imgNum:"2"};
var image3 = {fileName:"", image:null, timage:null, status:"empty", imgNum:"3"};
var image4 = {fileName:"", image:null, timage:null, status:"empty", imgNum:"4"};
var image5 = {fileName:"", image:null, timage:null, status:"empty", imgNum:"5"};
var imageArray = [image1,image2,image3,image4,image5];
$(document).ready(function() {      
            var this_js_script = $('script[src*=newTopic]');
            base_url = this_js_script.attr('data-my_var_1'); 
            loading_icon = this_js_script.attr('data-my_var_2');
            displayImageList();
 });
function displayImageList()
{
    var listOfImage = $("#listOfImage");
    var output = '<div class="list-group">';
    for( var i=0, len=imageArray.length; i<len; i++ ) {
        output += '<a href="" class="list-group-item" onclick="return false;">';
        if(imageArray[i].status != "empty")
        {
            if(imageArray[i].imgNum == "1")
            {
                output += '<span style="color:red" onclick="clearImage1();"><i class="icon-cancel-1 fa"></i></span>';
            }else if(imageArray[i].imgNum == "2")
            {
                output += '<span style="color:red" onclick="clearImage2();"><i class="icon-cancel-1 fa"></i></span>';
            }else if(imageArray[i].imgNum == "3")
            {
                output += '<span style="color:red" onclick="clearImage3();"><i class="icon-cancel-1 fa"></i></span>';
            }else if(imageArray[i].imgNum == "4")
            {
                output += '<span style="color:red" onclick="clearImage4();"><i class="icon-cancel-1 fa"></i></span>';
            }else if(imageArray[i].imgNum == "5")
            {
                output += '<span style="color:red" onclick="clearImage5();"><i class="icon-cancel-1 fa"></i></span>';
            }      
        }
        output += imageArray[i].imgNum+'. ';
        if(imageArray[i].status != "empty")
        {
            if(imageArray[i].imgNum == "1")
            {
                output += '<span onclick="showImage1()">'+ imageArray[i].fileName +'</span>';
            }else if(imageArray.imgNum == "2")
            {
                output += '<span onclick="showImage2()">'+ imageArray[i].fileName +'</span>';
            }else if(imageArray[i].imgNum == "3")
            {
                output += '<span onclick="showImage3()">'+ imageArray[i].fileName +'</span>';
            }else if(imageArray[i].imgNum == "4")
            {
                 output += '<span onclick="showImage4()">'+ imageArray[i].fileName +'</span>';
            }else if(imageArray[i].imgNum == "5")
            {
               output += '<span onclick="showImage5()">'+ imageArray[i].fileName +'</span>';
            }      
        }
        output += '</a>';
    }
    output += '</div>';
    listOfImage.html(output);
}
function showImage1()
{
    
}
function showImage2()
{
    
}
function showImage3()
{
    
}
function showImage4()
{
    
}
function showImage5()
{
    
}
function clearImage1()
{
    
}
function clearImage2()
{
    
}
function clearImage3()
{
    
}
function clearImage4()
{
    
}
function clearImage5()
{
    
}
function emptyImage(temp)
{
    temp.fileName = "";
    temp.image = null;
    temp.timage = null;
    temp.status = "empty";
    return temp;
}
function chooseFile() {
    document.getElementById("img1").click();
}
function setFileDisplay(name, status)
{
    var output = '';
    if(status == "loading")
    {
        output += '<img alt="loading..." src="' + loading_icon.toString() + '">';
    }
    output += name.toString();
    console.log(output);
    return output;
}
function setImageObj(pic, imgObj, callback)
{
    var filename = pic.name;
    filename = cutString(filename);
    imgObj.status = "loading";
    imgObj.fileName = filename;
    console.log("imgObj! " + imgObj.fileName);
    getResizeImage(pic,function(tempPic)
    {
        imgObj.image = tempPic;
        getResizeThumbnailImage(pic,function(tempTPic)
        {
            imgObj.timage = tempTPic;
            callback(imgObj);
        });
    });
}
function callbackInderstToArray(pic, j, imgObj, callback)
{
    if (imgObj.status == "empty")
    {
        setImageObj(pic, imgObj, function(newObj)
        {
            imageArray[j] = newObj; 
            callback(true);
        });
    }
    else
    {
        callback(false);
    }
}
function attemptToInsertToArray(currentPic, callback)
{
    var j = 0;
    var imgObj = imageArray[j];
    for (; callbackInderstToArray(currentPic, j, imgObj, function(isInserted)
            {
                if(isInserted == false)
                {
                    j++;
                    if(j < imageArray.length)
                    {    
                        imgObj = imageArray[j];
                        return true;
                    }
                    else
                    {
                        callback(false); 
                        return false;
                    }
                }
                else
                {
                    callback(true);
                    return false;
                }
            });
        )
    {} 
}
function setupImageArray(callback)
{
    
    var imgExp = $("#img1Exp");
    var fuData = document.getElementById('img1');
    var imgs= fuData.files;
    
    if(imgs && imgs[0]) 
    {
        var i = 0;
        var pic = imgs[i];
        for(; attemptToInsertToArray(pic,function(isInserted)
                {
                    if(isInserted == false)
                    {
                        var errorOutput ='<em><span style="color:red"> <strong> Error!</strong> Uploaded more than 5 files!</span></em>';
                        imgExp.html(errorOutput);
                        callback(imageArray);
                    }else
                    {
                        i++;
                        console.log("i " + i + "  imgs.length" + imgs.length);
                        if(i < imgs.length)
                        {
                            pic = imgs[i];
                            return true;
                        }else
                        {
                            callback(imageArray);
                            return false;
                        }
                    }
                    
                })
                ; )
        { }
    }
}
function ValidateFileUpload() {
    setupImageArray(function(data)
    {
        imageArray = data;
        displayImageList();
        //uploadFile();
    });
}
function getResizeImage(pic, callback)
{
    var reader = new FileReader();
    // Set the image once loaded into file reader
    reader.onload = function(e)
    {
        // Create an image
        //-----------------------------Image-------------------------
        var img = document.createElement("img");
        img.src = e.target.result;

        var canvas = document.createElement("canvas");
        //var canvas = $("<canvas>", {"id":"testing"})[0];
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);

        var MAX_WIDTH = 800;
        var MAX_HEIGHT = 800;
        var width = img.width;
        var height = img.height;

        if (width > height) {
            if (width > MAX_WIDTH) {
                height *= MAX_WIDTH / width;
                width = MAX_WIDTH;
            }
        } else {
            if (height > MAX_HEIGHT) {
                width *= MAX_HEIGHT / height;
                height = MAX_HEIGHT;
            }
        }
        canvas.width = width;
        canvas.height = height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, width, height);

        var dataurl = canvas.toDataURL("image/png");
        //document.getElementById('image').src = dataurl; 
        callback(dataurl);
    }
    reader.readAsDataURL(pic);
}
function getResizeThumbnailImage(pic, callback)
{
    var reader = new FileReader();
    // Set the image once loaded into file reader
    reader.onload = function(e)
    {
        // Create an image
        //-----------------------------Image-------------------------
        var img = document.createElement("img");
        img.src = e.target.result;

        var canvas = document.createElement("canvas");
        //var canvas = $("<canvas>", {"id":"testing"})[0];
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);

        var MAX_WIDTH = 200;
        var MAX_HEIGHT = 200;
        var width = img.width;
        var height = img.height;

        if (width > height) {
            if (width > MAX_WIDTH) {
                height *= MAX_WIDTH / width;
                width = MAX_WIDTH;
            }
        } else {
            if (height > MAX_HEIGHT) {
                width *= MAX_HEIGHT / height;
                height = MAX_HEIGHT;
            }
        }
        canvas.width = width;
        canvas.height = height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, width, height);

        var dataurl = canvas.toDataURL("image/png");
        //document.getElementById('image').src = dataurl; 
        callback(dataurl);
    }
    reader.readAsDataURL(pic);
}

function uploadFile() {
    var fuData = document.getElementById('img1');
    var browsebtn = document.getElementById('btnImg1');
    var imgLoad = $("#img1Load");
    var imgExp = $("#img1Exp");
    var FileUploadPath = fuData.value;
    var maxUploadSize = 5000000;

    //To check if user upload any file
    if (FileUploadPath == '') {
        console.log("Please upload an image");

    } else {
        var Extension = FileUploadPath.substring(
                FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

    //The file uploaded is an image

    if (Extension == "gif" || Extension == "png" ||  Extension == "jpeg" || Extension == "jpg") {
            //browsebtn.style.display = "none";
            browsebtn.disabled = true;
            browsebtn.style.background = "lightgrey";
    // To Display
            if (fuData.files && fuData.files[0]) {
                
                var file = fuData.files[0];
                var filename = file.name;  
                filename = cutString(filename);
                imgLoad.html(setFileDisplay(filename,"loading"));
                //console.log(file.size);
                if(file.size > maxUploadSize)
                {
                     //console.log("Photo Exceeded the Maximum File Size: "+maxUploadSize);
                     var errorOutput ='<em><span style="color:red"> <i class="icon-cancel-1 fa"></i><strong> <?php echo "Error"?>!</strong> Photo Exceeded the Maximum File Size: '+maxUploadSize+'</span></em>';
                     imgExp.html(errorOutput);
                }else
                {
                    var progress = '<div class="progress1"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"aria-valuemin="0" aria-valuemax="100" style="width:100%;">LOADING</div></div>';
                    //$("#btnImg1").removeAttr("class");
                    //$("#btnImg1").removeAttr("onClick");
                    //$("#btnImg1").html("");
                    imgExp.html(progress);
                    var reader = new FileReader();
                    // Set the image once loaded into file reader
                    reader.onload = function(e)
                    {
                        // Create an image
                        //-----------------------------Image-------------------------
                        var img = document.createElement("img");
                        img.src = e.target.result;

                        var canvas = document.createElement("canvas");
                        //var canvas = $("<canvas>", {"id":"testing"})[0];
                        var ctx = canvas.getContext("2d");
                        ctx.drawImage(img, 0, 0);

                        var MAX_WIDTH = 800;
                        var MAX_HEIGHT = 800;
                        var width = img.width;
                        var height = img.height;

                        if (width > height) {
                          if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                          }
                        } else {
                          if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                          }
                        }
                        canvas.width = width;
                        canvas.height = height;
                        var ctx = canvas.getContext("2d");
                        ctx.drawImage(img, 0, 0, width, height);

                        var dataurl = canvas.toDataURL("image/png");
                        //document.getElementById('image').src = dataurl;   
                        
                        var form_data = new FormData();
                        var actualName =filename.split('.');
                        form_data.append('name', actualName[0]);
                        form_data.append('file', dataurl);
                        console.log(form_data);
                       
                        // Create a thumbnail
                        img = document.createElement("img");
                        img.src = e.target.result;

                        canvas = document.createElement("canvas");
                        //var canvas = $("<canvas>", {"id":"testing"})[0];
                        ctx = canvas.getContext("2d");
                        ctx.drawImage(img, 0, 0);

                        MAX_WIDTH = 150;
                        MAX_HEIGHT = 150;
                        width = img.width;
                        height = img.height;

                        if (width > height) {
                          if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                          }
                        } else {
                          if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                          }
                        }
                        canvas.width = width;
                        canvas.height = height;
                        ctx = canvas.getContext("2d");
                        ctx.drawImage(img, 0, 0, width, height);

                        dataurl = canvas.toDataURL("image/png");
                        //document.getElementById('image').src = dataurl;   

                        actualName =filename.split('.');
                        form_data.append('tname', "[thumbnail]"+actualName[0]);
                        form_data.append('tfile', dataurl);
                        console.log(form_data);

                        ajaxUploadCall1(form_data, browsebtn, imgExp);
                        
                    }
                    // Load files into file reader
                    reader.readAsDataURL(file);
//                    reader.readAsDataURL(fuData.files[0]);
                }
            }
        } 

        //The file upload is NOT an image
        else {
                console.log("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
                imgExp.html('<em><span style="color:red"><i class="icon-cancel-1 fa"></i><strong> ERROR!</strong> Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. </span></em>');
        }
    }
}
function test()
{
    console.log("I AM A ACTION");
}
function ajaxUploadCall1(form_data, browsebtn, imgExp)
{
    return $.ajax({
        xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',progress, false);
                }
                return myXhr;
        },
        url: base_url,  
        dataType: 'text',  
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            console.log(php_script_response); 
            var result = JSON.parse(php_script_response);
            console.log(php_script_response); 
            imgExp.html(result.status);
            //browsebtn.style.display = "";
            browsebtn.disabled = false;
            browsebtn.style.background = "";
        },error: function()
        {
            var errorOutput ='<em><span style="color:red"> <i class="icon-cancel-1 fa"></i><strong> Connection Error </span></em>';
            imgExp.html(errorOutput);
            //browsebtn.style.display = "";
            browsebtn.disabled = false;
            browsebtn.style.background = "";
        }
    });
}
function loadThumbNail()
{
       
}
function progress(e){

    if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;

        var Percentage = (current * 100)/max;
        console.log(Percentage);


        if(Percentage >= 100)
        {
           // process completed  
        }
    }  
 }

function cutString(text){ 
   // console.log(text);
    var wordsToCut = 30;
    if(text.length>wordsToCut){
        var strShort = text.substr(text.length-wordsToCut);
        return "..."+strShort;
    }else{
        return text;
    }
 };
function progress(e){
    if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;

        var Percentage = (current * 100)/max;
        console.log("PERCENTAGE!!!!"+Percentage);


        if(Percentage >= 100)
        {
           // process completed  
        }
    }  
 }