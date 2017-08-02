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

// Выпадающее меню

$('.login-active-menu').on('click', function () {
  if($('.active-popup').hasClass('active')){
    $('.active-popup').removeClass('active')
    $('.login-active-menu .arrow').removeClass('active');
  }else{
    $('.login-active-menu .arrow').addClass('active');
    $('.active-popup').addClass('active');
  }
})

$(document).mouseup(function (e){
		var activePopupElem = $(".active-popup");
    var LoginActive = $('.login-active-menu .arrow'); // тут указываем ID элемента
		if (!activePopupElem.is(e.target) // если клик был не по нашему блоку
		    && activePopupElem.has(e.target).length === 0) { // и не по его дочерним элементам
			activePopupElem.removeClass('active') && LoginActive.removeClass('active') ;
       // скрываем его
		}
	});

// Восстановление пароля

$('#changePassword').on('click',function () {
  $('.update-password-overlay').addClass('active');
  $('.update-password-background').addClass('active');
  $('.update-password').addClass('active');
  $('.active-popup').removeClass('active');
})

$('.closeRecoveryPasswordWindow').on('click',function () {
  $('.update-password-overlay').removeClass('active');
  $('.update-password-background').removeClass('active');
  $('.update-password').removeClass('active');
  $('.delete-image-block').removeClass('active');
})

$('.update-password-background').on('click',function () {
  $('.update-password-overlay').removeClass('active');
  $('.update-password-background').removeClass('active');
  $('.update-password').removeClass('active');
  $('.delete-image-block').removeClass('active');
})

// Удаление фотографии из профиля

$('.delete-gallary-image').on('click',function(event){
  event.stopPropagation();
  var d;
  d = $(this).parent();
  $('.delete-image-btn').on('click', function(){
      d.remove();
      $('.closeRecoveryPasswordWindow').click();
  })
  $('.update-password-overlay').addClass('active');
  $('.update-password-background').addClass('active');
  $('.delete-image-block').addClass('active');
})

$('.delete-gallary-image').click(function () { 
var span = $(this).parent(); 
var img = span.children('img'); 
var imgSrc = img.attr('src'); 

$('.delete-image-btn').click(function () { 
$.post("/php/delete.php",{ imgSrc: imgSrc } ,function(response) { 
}); 
}) 
});