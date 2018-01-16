$(window).load(function () { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({'overflow': 'visible'});
});
$(document).ready(function () {

    $('#add_pic_input').tooltip();
    $('#back_arrow').tooltip();
    $('#add_pic_input').on('click', function() { $('#multiple_pics_div').append('<input class="form-control-file" type="file" name="file[]">'); });
    var option_value = "";
    $('#property_type1').change(function() {
        $('#property_form_next').removeAttr('disabled');
        option_value = $('#property_type1').val();
        $('#property_type2').val(option_value);
        if (option_value === 'Kuca') {
            $('#floor').fadeOut(50);
        } else if (option_value === 'Lokal') {
            $('#heat').fadeOut(50);
            $('#floor').fadeOut(50);
            $('#building_floors').fadeOut(50);
        } else if (option_value === 'Garaza') {
            $('#structure').fadeOut(50);
            $('#parking').fadeOut(50);
            $('#accommodation').fadeOut(50);
            $('#heat').fadeOut(50);
            $('#floor').fadeOut(50);
            $('#building_floors').fadeOut(50);
        }
    });
    $('#property_form_next').click(function() {
        $('#back_arrow').delay(200).fadeIn();    
        $('#before_new_property_form').delay(200).slideUp();
        $('#new_property_form').delay(500).slideDown(1000);
    });
    $('#back_arrow').click(function() {
        $('#property_type1').val("- - -");
        $('#floor').delay(1000).fadeIn(50);
        $('#heat').delay(1000).fadeIn(50);
        $('#floor').delay(1000).fadeIn(50);
        $('#building_floors').delay(1000).fadeIn(50);
        $('#structure').delay(1000).fadeIn(50);
        $('#parking').delay(1000).fadeIn(50);
        $('#accommodation').delay(1000).fadeIn(50);
        $('#heat').delay(1000).fadeIn(50);
        $('#floor').delay(1000).fadeIn(50);
        $('#building_floors').delay(1000).fadeIn(50);
        $('#property_form_next').prop('disabled', true);
        $('#new_property_form').delay(200).slideUp(1000);
        $('#before_new_property_form').delay(1100).slideDown();
        $('#back_arrow').delay(1100).fadeOut();  
    });
    
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-yellow',
        radioClass: 'iradio_square-yellow',
        increaseArea: '20%' // optional
    });


    $('.layout-grid').on('click', function () {
        $('.layout-grid').addClass('active');
        $('.layout-list').removeClass('active');

        $('#list-type').removeClass('proerty-th-list');
        $('#list-type').addClass('proerty-th');

    });

    $('.layout-list').on('click', function () {
        $('.layout-grid').removeClass('active');
        $('.layout-list').addClass('active');

        $('#list-type').addClass('proerty-th-list');
        $('#list-type').removeClass('proerty-th');

    });

});
$(document).ready(function () {
    $("#bg-slider").owlCarousel({
        navigation: false, // Show next and prev buttons
        slideSpeed: 100,
        autoPlay: 5000,
        paginationSpeed: 100,
        singleItem: true,
        mouseDrag: false,
        transitionStyle: "fade"
                // "singleItem:true" is a shortcut for:
                // items : 1, 
                // itemsDesktop : false,
                // itemsDesktopSmall : false,
                // itemsTablet: false,
                // itemsMobile : false 
    });
    $("#prop-smlr-slide_0").owlCarousel({
        navigation: false, // Show next and prev buttons
        slideSpeed: 100,
        pagination: true,
        paginationSpeed: 100,
        items: 3

    });
    $("#testimonial-slider").owlCarousel({
        navigation: false, // Show next and prev buttons
        slideSpeed: 100,
        pagination: true,
        paginationSpeed: 100,
        items: 3
    });

    $('#price-range').slider();
    $('#property-geo').slider();
    $('#min-baths').slider();
    $('#min-bed').slider();

    var RGBChange = function () {
        $('#RGB').css('background', '#FDC600')
    };

    // Advanced search toggle
    var $SearchToggle = $('.search-form .search-toggle');
    $SearchToggle.hide();

    $('.search-form .toggle-btn').on('click', function (e) {
        e.preventDefault();
        $SearchToggle.slideToggle(300);
    });

    setTimeout(function () {
        $('#counter').text('0');
        $('#counter1').text('0');
        $('#counter2').text('0');
        $('#counter3').text('0');
        setInterval(function () {
            var curval = parseInt($('#counter').text());
            var curval1 = parseInt($('#counter1').text().replace(' ', ''));
            var curval2 = parseInt($('#counter2').text());
            var curval3 = parseInt($('#counter3').text());
            if (curval <= 908) {
                $('#counter').text(curval + 1);
            }
            if (curval1 <= 529) {
                $('#counter1').text(sdf_FTS((curval1 + 20), 0, ' '));
            }
            if (curval2 <= 23) {
                $('#counter2').text(curval2 + 1);
            }
            if (curval3 <= 1022) {
                $('#counter3').text(curval3 + 1);
            }
        }, 2);
    }, 500);

    function sdf_FTS(_number, _decimal, _separator) {
        var decimal = (typeof (_decimal) != 'undefined') ? _decimal : 2;
        var separator = (typeof (_separator) != 'undefined') ? _separator : '';
        var r = parseFloat(_number)
        var exp10 = Math.pow(10, decimal);
        r = Math.round(r * exp10) / exp10;
        rr = Number(r).toFixed(decimal).toString().split('.');
        b = rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g, "\$1" + separator);
        r = (rr[1] ? b + '.' + rr[1] : b);

        return r;
    }

})

// Initializing WOW.JS

new WOW().init();