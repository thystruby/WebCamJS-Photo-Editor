function changeLanguage() {
    $('[data-language = en]').css({
        'display' : 'none'
    });

    $("[data-toggle]").click(function() {
        var target = $(".my-text");
        if($(this).prop('checked')) {
            target.html('EN');
            $('[data-language = ru]').css({
                'display' : 'none'
            });
            $('[data-language = en]').css({
                'display' : 'inline-block'
            })
            $('input#sources').attr('placeholder', 'Select the format');
            $('.language-flag').attr('src','app/img/icons/united-states.svg')
        } else {
             $('[data-language = ru]').css({
                'display' : 'inline-block'
            });
            $('input#sources').attr('placeholder', 'Выберите формат');
            $('[data-language = en]').css({
                'display' : 'none'
            });
            $('.language-flag').attr('src','app/img/icons/russia.svg')
            target.html('RU');
        }
    });
}

changeLanguage();

// fullscreen

function launchFullScreen(element) {
    if(element.requestFullScreen) {
        element.requestFullScreen();
    } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if(element.webkitRequestFullScreen) {
        element.webkitRequestFullScreen();
    }
}

$('.full-screen-block').on('click', function () {
    var body = document.querySelector('body');
    launchFullScreen(body);
    onfullscreenchange();
});


$('.forgotPassword').on('click',function () {
  $('.recovery-email-overlay').addClass('active');
  $('.recovery-password-background').addClass('active');
})

$('#closeRecoveryPasswordWindow').on('click',function () {
  $('.recovery-email-overlay').removeClass('active');
  $('.recovery-password-background').removeClass('active');
})

$('.recovery-password-background').on('click',function () {
  $('.recovery-email-overlay').removeClass('active');
  $('.recovery-password-background').removeClass('active');
})
