/*	Table OF Contents
	==========================
	Carousel
	Ajax Tab
	List view , Grid view  and compact view
	Global Plugins
	Customs Script
	responsive cat-collapse for homepage
	*/
	

	
$(document).ready(function() {
    
    /*==================================
	 Carousel 
	====================================*/

    // Featured Listings  carousel || HOME PAGE
    var owlitem = $(".item-carousel");

    owlitem.owlCarousel({
        //navigation : true, // Show next and prev buttons
        navigation: false,
        pagination: true,
        items: 5,
		itemsDesktopSmall: 	[979,3],
		itemsTablet: [768, 3],
        itemsTabletSmall: [660, 2],
		itemsMobile: [400,1]


    });

    // Custom Navigation Events
    $("#nextItem").click(function() {
        owlitem.trigger('owl.next');
    })
    $("#prevItem").click(function() {
        owlitem.trigger('owl.prev');
    })

    // Featured Listings  carousel || HOME PAGE
    //var featuredListSlider = $(".featured-list-slider");
    
    var owlitem1 = $(".item1-carousel");
    
    //featuredListSlider.owlCarousel({
    owlitem1.owlCarousel({
        //navigation : true, // Show next and prev buttons
        navigation: false,
        pagination: true,
        items: 5,
		itemsDesktopSmall: 	[979,3],
		itemsTablet: [768, 3],
        itemsTabletSmall: [660, 2],
		itemsMobile: [400,1]


    });

    // Custom Navigation Events
    $("#nextItem1").click(function() {
        owlitem1.trigger('owl.next');
    })
    $("#prevItem1").click(function() {
        owlitem1.trigger('owl.prev');
    })
    
    var owlitem2 = $(".item2-carousel");

    owlitem2.owlCarousel({
        //navigation : true, // Show next and prev buttons
        navigation: false,
        //pagination: false,
        pagination: true,
        items: 5,
		itemsDesktopSmall: 	[979,3],
		itemsTablet: [768, 3],
        itemsTabletSmall: [660, 2],
		itemsMobile: [400,1]


    });

    // Custom Navigation Events
    //$(".featured-list-row .next").click(function() {featuredListSlider.trigger('owl.next');
    $("#nextItem2").click(function() {
        owlitem2.trigger('owl.next');
    })
    //$(".featured-list-row .prev").click(function() {featuredListSlider.trigger('owl.prev');
    $("#prevItem2").click(function() {
        owlitem2.trigger('owl.prev');
    })
    /*==================================
	 Ajax Tab || CATEGORY PAGE
	====================================*/

    //  item listing ajaxTabs 
    $('#ajaxTabs a').click(function(e) {
        e.preventDefault();

        var url = $(this).attr("data-url");
        var href = this.hash;
        var pane = $(this);

        // ajax load from data-url
        $(href).load(url, function(result) {
            pane.tab('show');
            // ajax pre-request callback function 
            //$('.tooltipHere').tooltip('hide');
            $('.tooltipHere').tooltip();
            $('.grid-view').click(function(e) {
                $(function() {
                    $('.item-list').matchHeight();
                    $.fn.matchHeight._apply('.item-list');
                });
            });

        });
    });

    // load first tab content
    $('#allAds').load($('.active a').attr("data-url"), function(result) {
        $('.active a').tab('show');
        // ajax pre-request callback function 
        $('.tooltipHere').tooltip();

        $('.grid-view').click(function(e) {
            $(function() {
            	//$('.tooltipHere').tooltip('hide');
                $('.item-list').matchHeight();
                $.fn.matchHeight._apply('.item-list');
            });
        });
    });

    /*==================================
	 List view clickable || CATEGORY 
	====================================*/

    // List view , Grid view  and compact view

    $('.list-view,#ajaxTabs li a').click(function(e) { //use a class, since your ID gets mangled
        e.preventDefault();
        $('.grid-view,.compact-view').removeClass("active");
        $('.list-view').addClass("active");
        $('.item-list').addClass("make-list"); //add the class to the clicked element
        $('.item-list').removeClass("make-grid");
        $('.item-list').removeClass("make-compact");
        $('.item-list .add-desc-box').removeClass("col-sm-9");
        $('.item-list .add-desc-box').addClass("col-sm-7");

        $(function() {
            $('.item-list').matchHeight('remove');
        });
    });

    $('.grid-view').click(function(e) { //use a class, since your ID gets mangled
        e.preventDefault();
        $('.list-view,.compact-view').removeClass("active");
        $(this).addClass("active");
        $('.item-list').addClass("make-grid"); //add the class to the clicked element
        $('.item-list').removeClass("make-list");
        $('.item-list').removeClass("make-compact");
        $('.item-list .add-desc-box').removeClass("col-sm-9");
        $('.item-list .add-desc-box').addClass("col-sm-7");

        $(function() {
            $('.item-list').matchHeight();
            $.fn.matchHeight._apply('.item-list');
        });

    });

    $(function() {
        $('.row-featured .f-category').matchHeight();
        $.fn.matchHeight._apply('.row-featured .f-category');
    });

    $(function() {
        $('.has-equal-div > div').matchHeight();
        $.fn.matchHeight._apply('.row-featured .f-category');
    });

    $('.compact-view').click(function(e) { //use a class, since your ID gets mangled
        e.preventDefault();
        $('.list-view,.grid-view').removeClass("active");
        $(this).addClass("active");
        $('.item-list').addClass("make-compact"); //add the class to the clicked element
        $('.item-list').removeClass("make-list");
        $('.item-list').removeClass("make-grid");
        $('.item-list .add-desc-box').toggleClass("col-sm-9 col-sm-7");

        $(function() {
            $('.adds-wrapper .item-list').matchHeight('remove');
        });

    });



    /*==================================
	Global Plugins || 
	====================================*/

    $('.long-list').hideMaxListItems({
        'max': 15,
        'speed': 500,
        'moreText': 'View More ([COUNT])'
    });

    /*
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
     */

    $('.tooltipHere').tooltip(); // bootstrap tooltip

    $(".scrollbar").scroller(); // custom scroll bar plugin

    $("select.selecter").selecter({ // custom scroll select plugin
        label: "Select An Item"
    });

    $(".selectpicker").selecter({ // category list Short by
        customClass: "select-short-by"
    });




    /*=======================================================================================
		cat-collapse Hmepage Category Responsive view  
	========================================================================================*/
	
	

    $(window).bind('resize load', function() {
	
	
		
        if ($(this).width() < 767) {

        $('.cat-collapse').collapse('hide');
		
            $('.cat-collapse').on('shown.bs.collapse', function() {
                $(this).prev('.cat-title').find('.icon-down-open-big').addClass("active-panel");
                //$(this).prev('.cat-title').find('.icon-down-open-big').toggleClass('icon-down-open-big icon-up-open-big');
            });

            $('.cat-collapse').on('hidden.bs.collapse', function() {
                $(this).prev('.cat-title').find('.icon-down-open-big').removeClass("active-panel");
            })

        } else {
			
		$('.cat-collapse').removeClass('out').addClass('in').css('height', 'auto');
           
        }
		
    });

    $(".tbtn").click(function() {
        $('.themeControll').toggleClass('active')
    })
    //$('.collapse-box').collapse("hide");
    $(window).bind('resize load', function() {
        if ($(this).width() < 767) {
            $('#ProfileMenuAds').removeClass('in');
            $('#ProfileMenuAds').addClass('out');
            
            $('#ProfileMenuEvaluate').removeClass('in');
            $('#ProfileMenuEvaluate').addClass('out');
            
            $('#ProfileMenuAccount').removeClass('in');
            $('#ProfileMenuAccount').addClass('out');
            
            //search left hand menu
            if(document.getElementById('leftMenuSearchPage'))
            	document.getElementById('leftMenuSearchPage').style.display = "none";
            if(document.getElementById('viewItemBottomOpt'))
            	document.getElementById('viewItemBottomOpt').style.display = "none";
        } else {
            //$('#ProfileMenuAds').removeClass('out');
            //$('#ProfileMenuAds').addClass('in');
            
            //$('#ProfileMenuEvaluate').removeClass('in');
            //$('#ProfileMenuEvaluate').addClass('out');
            
           // $('#ProfileMenuAccount').removeClass('in');
           // $('#ProfileMenuAccount').addClass('out');
        }
    });
    
    	if(document.getElementById('userStar'))
    	{
    		$('#userStar').raty({readOnly: true, score: 3 });
    	}
    $('.map').click(function () {
    	//console.log('test');
        //$('.map iframe').css("pointer-events", "auto");
    });
    var contactMsglines = 10;
    $('#contactUsMessage').keydown(function(e) {
        newLines = $(this).val().split("\n").length;
        if(e.keyCode == 13 && newLines >= contactMsglines) {
            return false;
        }
    });
    
    $('#descriptionTextarea').keydown(function(e) {
        newLines = $(this).val().split("\n").length;
        if(e.keyCode == 13 && newLines >= contactMsglines) {
            return false;
        }
    });
    $('#txtSendMessage').keydown(function(e) {
        newLines = $(this).val().split("\n").length;
        if(e.keyCode == 13 && newLines >= contactMsglines) {
            return false;
        }
    });
    //App.init();
    //App.initScrollBar();
    //MouseWheel.initMouseWheel(); <--ENABLE THIS LINE FOR PRICE SLIDER
    //StyleSwitcher.initStyleSwitcher();
    

}); // end Ready


	