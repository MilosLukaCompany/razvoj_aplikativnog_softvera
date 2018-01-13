$(window).scroll(function() {
if ($(this).scrollTop() > 1){  
    $('nav').addClass("navigacija");
  }
  else{
    $('nav').removeClass("navigacija");
  }
});