	$body = $("body");
//	$(document).on({
//    ajaxStart: function() { $body.addClass("loading");    },
//     ajaxStop: function() { $body.removeClass("loading"); }    
//	});
	$(document).ready(function() {      
            var this_js_script = $('script[src*=footer]');
            //var cname = 'switchLang/changeLang';
            //var base_url = '<?php echo MY_PATH;?>switchLang/changeLang';
             var base_url = this_js_script.attr('data-my_var_1'); 

            //console.log(base_url);
            $('#lang').click(function(event) {
                    var btn_val = $('#lang').val();
                    $('#lang').addClass("temp").val('').unbind('click');
                    event.preventDefault();
                            console.log(5 + 6);
                            $.ajax({
			'async': false,
			'url' : base_url,
			'type' : 'POST', //the way you want to send data to your URL
			'dataType': 'json',
			'data' : 'data',
			'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
						console.log(data);
						 if(data){
							//sleep(1000);
                                                        $('#lang').removeClass("temp").val(btn_val);
							location.reload(); 
						}
					 },
			'error': function(XMLHttpRequest, textStatus, errorThrown) { 
					toastr.options.closeButton = true;
					toastr.options.preventDuplicates = true,
					toastr["error"]("Language cannot be switched at moment, please try again later.", "Error");
			},
                        'complete': function() {
                             $('#lang').bind('click');
                        }
                            });

                    });
                    
                    
                    
      
//         var emptyFolderSrc = this_js_script.attr('data-my_var_2');
//         console.log(emptyFolderSrc);
//         
//         $.ajax(emptyFolderSrc, function(result) {
//            /* Do what ever you want to do of result*/
//               console.log(result);
//        });
         
         /*$.ajax({
            'async': false,
            'url' : emptyFolderSrc,
            'type' : 'POST', //the way you want to send data to your URL
            'data' : 'data',
            'success' : function(data){ 
                    console.log(data);

             }        
        });*/
    });
