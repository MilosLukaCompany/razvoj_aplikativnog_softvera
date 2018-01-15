$(document).ready(function() {
    //skrol efekat
    $(document).scroll(function() {
        var scroll_pos = $(document).scrollTop() + 100;
        //posle koliko ce da krene sa menjanem css propertija
        if (scroll_pos > 350) {            
            $('.navbar').css({'height': '60px'});
            $('#nav_div').css({'padding-top': '0px'});
            $('.main-nav').css({'padding-top': '0px'});
            $('.button.navbar-right').css({'padding-top': '0px'});
            $('.navbar_link').addClass('changed');
            $('#big_logo').css({'margin-top': '-100px', 'opacity': '0'});
            $('#small_logo').css({'margin-top': '10px', 'opacity': '1'});            
        } else {
            $('.navbar').css({'height': '100px'});
            $('#nav_div').css({'padding-top': '15px'});
            $('.main-nav').css({'padding-top': '10px'});
            $('.button.navbar-right').css({'padding-top': '10px'});
            $('.navbar_link').removeClass('changed');
            $('#big_logo').css({'margin-top': '0px', 'opacity': '1'});
            $('#small_logo').css({'margin-top': '-100px', 'opacity': '0'});
        }         
    });
});