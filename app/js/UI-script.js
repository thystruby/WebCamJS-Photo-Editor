// svg

/*new Vivus('svg', {
    type:  'delayed',
    duration: 100,
    pathTimingFunction: Vivus.EASE
});*/


function hideUIstartApp() {

    $('.take-photo-form').css({
       'display' : 'flex'
    });

    $('div#video3Sek.hideUI').removeClass('hideUI');
    $('div#video3Sek').removeClass('disabled');

    $('div#video5Sek').removeClass('disabled');
    $('div#video5Sek.hideUI').removeClass('hideUI');

    $('div.stop-video.hideUI').removeClass('hideUI');

    $('img.hideUI').removeClass('hideUI');
    $('div#download-photo img.hideUI').removeClass('hideUI');

    $('div#take-photo img.hideUI').removeClass('hideUI');

    $('div#take-photo').removeClass('disabled');
    $('div#download-photo').addClass('disabled');
    $('div#delete-photo').addClass('disabled');

    $('div.loadPhoto').addClass('hide');
    $('div.useWebCam').addClass('hide');

    $('div#back.hideUI').removeClass('hideUI');


    $('.app video#camera-stream').css('display', 'block');
}


// возвращение в главное меню

function hideUIbackToMainMenu() {
    image.setAttribute('src', "");

    $('.take-photo-form').css({
       'display' : 'none'
    });

    $('.start-application').css('display', 'flex');
    $('.application-container').css('display', 'none');

    $('div#back').addClass('hideUI');

    $('div#video5Sek').addClass('hideUI');
    $('div#video3Sek').addClass('hideUI');
    $('div.stop-video').addClass('hideUI');
    $('div#take-photo').addClass('hideUI');
    $('div#download-photo').addClass('hideUI');

    $('div#take-photo img').addClass('hideUI');
    $('div#download-photo img').addClass('hideUI');
    $('div#delete-photo img').addClass('hideUI');

    $('div.loadPhoto').removeClass('hide');
    $('div.useWebCam').removeClass('hide');

    $('.app video#camera-stream').css('display', 'none');

   /* $('div.filters-panel').animate({width:"0"},1000);
    document.querySelector('div.filters-panel ul').style.display = 'none';*/

    error_message.classList.remove('visible');

}