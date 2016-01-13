var MouseWheel = function () {

    return {

        initMouseWheel: function () {
            jQuery('.slider-snap').noUiSlider({
                start: [ 800, 1900 ],
                snap: true,
                connect: true,
                range: {
                    'min': 0,
                    '5%': 100,
                    '10%': 200,
                    '15%': 400,
                    '20%': 600,
                    '25%': 800,
                    '30%': 1000,
                    '35%': 1200,
                    '40%': 1400,
                    '50%': 1500,
                    '60%': 1700,
                    '70%': 1900,
                    '80%': 2100,
                    '90%': 2300,
                    'max': 2500
                }
            });
            jQuery('.slider-snap').Link('lower').to(jQuery('.slider-snap-value-lower'));
            jQuery('.slider-snap').Link('upper').to(jQuery('.slider-snap-value-upper'));
        }

    };

}();        