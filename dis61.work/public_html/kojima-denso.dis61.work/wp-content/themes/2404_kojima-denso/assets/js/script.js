
/*---------------------------------------------------------*/
/* アンカースクロール　                                         */
/*---------------------------------------------------------*/
$('a[href^="#"]').click(function() {
    let header = $(".header").innerHeight();
    let speed = 1000;
    let id = $(this).attr("href");
    let target = $("#" == id ? "html" : id);
    let position = $(target).offset().top;
    $("html, body").animate(
        {
        scrollTop: position
        },
        speed
    );
    return false;
});

/*---------------------------------------------------------*/
/* スマホメニュー開閉　                                         */
/*---------------------------------------------------------*/
$('.header__hamburger-button-link').on('click', function(){
    let header_height = $('.header').outerHeight();
    let window_height = window.innerHeight;
    let is_adminbar = $('body').hasClass('admin-bar');
    let hamburger = $('.header__hamburger');
    let body = $('body');

    console.log(window_height);

    if(body.hasClass('hamburger-open')){
        hamburger.css('height', '');
        body.removeClass('hamburger-open');
    }else{
        if(is_adminbar){
            hamburger.css('height', 'calc('+window_height+'px - '+header_height+'px - 46px)');
        }else{
            hamburger.css('height', 'calc('+window_height+'px - '+header_height+'px)');
        }
        body.addClass('hamburger-open');
    }
    $('body').removeClass('sp-navi-open');

    return false;
});


/*---------------------------------------------------------*/
/* スライダー　slick                                          */
/*---------------------------------------------------------*/