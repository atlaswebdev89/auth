$(window).scroll(function() {
var top = $(document).scrollTop();
  if (top  > 350) {

    $('#menu').addClass('menu-fixed');
  } else {

    $('#menu').removeClass('menu-fixed');

  }

});

