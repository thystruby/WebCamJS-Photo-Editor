var video = document.querySelector('#camera-stream'),
    error_message = document.querySelector('.errorMessage'),
    error_message_errorText = document.querySelector('#error-message'),
    image = document.querySelector('img#snap'),
    canvas = document.querySelector('#canvas'),
    context = canvas.getContext('2d'),
    download_photo_btn = document.querySelector('#download-photo'),
    upload_input = document.getElementById('upLoad'),
    backCanvas = document.getElementById('backCanvasElem'),
    backCanvasContext = backCanvas.getContext('2d'),
    backImage = new Image(),
    n = 0;

// подключение getUserMedia для различных браузеров
navigator.getMedia = ( navigator.getUserMedia ||
navigator.webkitGetUserMedia ||
navigator.mozGetUserMedia ||
navigator.msGetUserMedia );


// fullscreen

function cancelFullscreen() {
    if(document.cancelFullScreen) {
        document.cancelFullScreen();
    } else if(document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if(document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
    }
}

function launchFullScreen(element) {
    if(element.requestFullScreen) {
        element.requestFullScreen();
    } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if(element.webkitRequestFullScreen) {
        element.webkitRequestFullScreen();
    }
}

var onfullscreenchange =  function(e){
    var fullscreenEnabled =
        document.fullscreenEnabled ||
        document.mozFullscreenEnabled ||
        document.webkitFullscreenEnabled;
}

$('.full-screen-block.active').on('click', function () {
    cancelFullscreen();
});

$('.full-screen-block').on('click', function () {
    var body = document.querySelector('body');
    launchFullScreen(body);
    onfullscreenchange();
});


// смена языка

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

// ЛОГИН МЕНЮ

$('.login-active-menu').on('click', function () {
  if($('.active-popup').hasClass('active')){
    $('.active-popup').removeClass('active')
    $('.login-active-menu .arrow').removeClass('active');
  }else{
    $('.login-active-menu .arrow').addClass('active');
    $('.active-popup').addClass('active');
  }
});

$(document).mouseup(function (e){
		var activePopupElem = $(".active-popup");
    var LoginActive = $('.login-active-menu .arrow'); // тут указываем ID элемента
		if (!activePopupElem.is(e.target) // если клик был не по нашему блоку
		    && activePopupElem.has(e.target).length === 0) { // и не по его дочерним элементам
			activePopupElem.removeClass('active') && LoginActive.removeClass('active') ;
       // скрываем его
		}
	});

// Шаринг на соц сети

$('.share-button').on('click',function () {
  if ($('.share-block').hasClass('active')){
    $('.share-block').removeClass('active');
  }else{
    $('.share-block').addClass('active');
  }

})

$('div.useWebCam').on('click', function () {

    if(!navigator.getMedia){
        displayErrorMessage("Браузер не поддерживает navigator.getUserMedia.");
    }else{
        // Request the camera.
        navigator.getMedia(
            {
                video: true
            },
            // Success Callback
            function(stream){

                // Create an object URL for the video stream and
                // set it as src of our HTLM video element.
                video.src = window.URL.createObjectURL(stream);

                // Play the video element to start the stream.
                video.play();
            },
            // Error Callback
            function(err){
                displayErrorMessage( err.name, err);
            }
        );
    }
    $('.application-container').css('display','block');
    $('.start-application').css('display','none');
    hideUIstartApp();
});




document.querySelector('#back').addEventListener('click', function () {
    /*hideUIbackToMainMenu();*/
    location.reload();
});



function displayErrorMessage(error_msg, error){
    $('#snap').css({'display' : 'none'});
    $('#take-photo').addClass('disabled'); //
    $('#video3Sek').addClass('disabled');  // скрыть элементы управления
    $('#video5Sek').addClass('disabled');  //
    $('.stop-video').addClass('disabled');
    $('.app').css({'display' : 'none'});
    error = error || "";
    if(error){
        console.error(error);
    }
    error_message_errorText.innerText = error_msg;
    error_message.classList.add("visible");
}

// кнопка "Сделать фотографию"

$('#take-photo').click(function () {
   var snap = snapShot();

    image.setAttribute('src',snap);

    video.pause();

    $('#canvas').css({
        display : 'block'
    });

   /* $('#camera-stream').css({
       display : 'none'
    });*/

    $('div#take-photo').addClass('disabled');
    $('div#video3Sek').addClass('disabled');
    $('div#video5Sek').addClass('disabled');
    $('.stop-video').addClass('disabled');
    $('.editor-photo-icon').addClass('active');

    $('#download-photo').removeClass('disabled');
    $('#delete-photo').removeClass('disabled');

/*
    download_photo_btn.href = document.getElementById("canvas").toDataURL("image/png");
*/

});


// НОВАЯ ЗАГРУЗКА !!!!!!!

upload_input.addEventListener('change', handleFiles);

function handleFiles(e) {
    var reader = new FileReader;
    reader.onload = function(event) {
        var img = new Image;
        img.src = event.target.result;
        image.src = img.src;
        image.onload = function() {
            canvas.width = image.width;
            canvas.height = image.height;
            context.drawImage(image,0,0, canvas.width, canvas.height);
        };

    };
    reader.readAsDataURL(e.target.files[0]);

    $('.take-photo-form').css({
        'display' : 'none'
    });
    $('.start-application').css('display', 'none');
    $('.application-container').css('display', 'none');
    $('.center-block').css({
        'display':'block'
    })
    $('.photo-editor-container').css('display', 'flex');
}

//

// нажатие на кнопку редактирования
$('.editor-elem.edit').on('click', function () {
   $('.photo-editor-container .toolbar').css('display','block');
   $('.main-photo-editor-toolbar').css({
       'display' : 'none'
   });
    /*context.drawImage(backCanvas,0,0,canvas.width,canvas.height)*/
});


// нажатие на кнопку фильтров
$('.editor-elem.filters').on('click', function () {
    $('.photo-editor-container .photo-editor-filter').css('display','block');
    $('.main-photo-editor-toolbar').css({
        'display' : 'none'
    })
});


// нажатие на кнопку Рисования

// var sketcher;

$('#backToEditorMenuDraw').on('click',function () {
   /*Caman('#canvas', function () {
      this.reloadCanvasData();
   });*/
});


// Назад в меню редактирования -- replaceCanvas

var newCanvas;
var newCanvasContext;

function initCanvas(){
 newCanvas = document.createElement('canvas');
 newCanvasContext = newCanvas.getContext('2d');
}
    var oldCanvas;
function UpdataCanvas() {

    oldCanvas = canvas;


  var image2 = new Image();
  image2.src = canvas.toDataURL('image/png');

  image2.onload = function () {
 
    canvas = newCanvas;

    newCanvas.width = image2.width;
    newCanvas.height = image2.height;

    newCanvasContext.drawImage(image2,0,0,image2.width,image2.height);
    newCanvas.id = 'canvas'

    context = newCanvasContext;
  }

  Caman('#canvas',function () {
    this.replaceCanvas(newCanvas);
  });


    // var oldCanvas;
    // oldCanvas = this.canvas;
    // this.canvas = newCanvas;
    // this.context = this.canvas.getContext('2d');
    // this.width = this.canvas.width;
    // this.height = this.canvas.height;
    
    // oldCanvas.replaceWith(this.canvas);
    
    // return this.reloadCanvasData();
}

$('#backToEditorMenu,#backToEditorMenuFilter,#backToEditorMenuDraw,#backToEditorMenuAddText').click(function () {
    // event.preventDefault();
    initCanvas();
    UpdataCanvas();
    
    $('.photo-editor-container .toolbar').css('display','none');
    $('.photo-editor-filter').css('display', 'none');
    $('.photo-editor-paint').css('display','none');
    $('.photo-editor-text').css('display','none');
    $('.main-photo-editor-toolbar').css({
        'display' : 'block'
    });
});

$('#backToEditorMenuMainToolbar').click(function () {

    var i = confirm('Вы уверены что хотите выйди в главное меню? Вся не сохраненная информация будет удалена')

    if (i) {
        location.reload();
    }
});



// селект меню

$(".custom-select").each(function() {
    var classes = $(this).attr("class"),
        id      = $(this).attr("id"),
        name    = $(this).attr("name");
    var template =  '<div class="' + classes + '">';
    template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
    template += '<div class="custom-options">';
    $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
    });
    template += '</div></div>';

    $(this).wrap('<div class="custom-select-wrapper"></div>');
    $(this).hide();
    $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
    $(this).parents(".custom-options").addClass("option-hover");
}, function() {
    $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function(event) {
    $('html').one('click',function() {
        $(".custom-select").removeClass("opened");
    });
    $(this).parents(".custom-select").toggleClass("opened");
    event.stopPropagation();
});
$(".custom-option").on("click", function() {
    $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
    $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
    $(this).parents(".custom-options").find(".custom-option").attr('id','');
    $(this).addClass("selection");
    $(this).attr('id', 'select-format');
    $(this).parents(".custom-select").removeClass("opened");
    $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
});


// сохранение изображения

function savePhoto() {
    var imageFormat;
    var imageName = document.getElementById('fileNameToSave').value;

    if (imageName == ''){
        imageName = 'WebCamPhoto'
    }

    if ($('span[data-value = PNG]').hasClass('selection')){
        imageFormat = '.png'
        canvas.toBlob(function (blob) {
            saveAs(blob, imageName + imageFormat);
        })
    }else if($('span[data-value = JPG]').hasClass('selection')){
        imageFormat = '.jpg'
        canvas.toBlob(function (blob) {
            saveAs(blob, imageName + imageFormat);
        })
    }else {
        alert('Выберите необходимый формат изображения');
    }
}

 $('#downloadPhoto-btn').on('click', function () {
        savePhoto();
    });

$('#SaveButtonMainToolbar').on('click', function () {

    $('.saveFile-overlay').addClass('active');
    $('.saveFile-container').addClass('active');
    $('.saveFile-background').addClass('active');

    var canvasSave = document.getElementById('canvasSaveFile');
    var contextCanvasSave = canvasSave.getContext('2d');

    canvasSave.width = canvas.width;
    canvasSave.height = canvas.height;

    contextCanvasSave.drawImage(canvas,0,0, canvasSave.width, canvasSave.height);
});


//скачать фото

$('#download-photo').on('click', function () {

    $('.saveFile-overlay').addClass('active');
    $('.saveFile-container').addClass('active');
    $('.saveFile-background').addClass('active');

    var canvasSave = document.getElementById('canvasSaveFile');
    var  contextCanvasSave = canvasSave.getContext('2d');

    canvasSave.width = canvas.width;
    canvasSave.height = canvas.height;

    contextCanvasSave.drawImage(canvas,0,0, canvasSave.width, canvasSave.height);
});



// закрыть сохранение фото

$('#closeSaveFileContainer').on('click', function () {
    $('.saveFile-overlay').removeClass('active');
    $('.saveFile-container').removeClass('active');
    $('.saveFile-background').removeClass('active');
});

$('.saveFile-background').on('click', function () {
    $('.saveFile-overlay').removeClass('active');
    $('.saveFile-container').removeClass('active');
    $('.saveFile-background').removeClass('active');
    $('#saveFileContainerCrop').removeClass('active');
});


//


$('#video3Sek').click(function () {

  var initialCount 	= 4,
      count 			  = initialCount,
      i = 4;

    $('.timer').addClass('active');
    $('div#take-photo').addClass('disabled');
    $('div#video3Sek').addClass('disabled');
    $('div#video5Sek').addClass('disabled');
    $('.stop-video').addClass('disabled');

    function timer() {
          i--;
          console.log(i);
          if (i == 0){
            $('.timer').removeClass('active');
            clearInterval(timmes);
          }
    	  	count = count - 1;
    	  	if (count <= -1) {
    	  		  count = initialCount;
    	        var el = $(".circle-timer");
    	        el.before( el.clone(true) ).remove();
    	  	}
    	  	$(".timer .count").text(count);
    }

    var timmes = setInterval(timer, 1000);

    setTimeout(Timer3sek,1000);

  function Timer3sek() {
    setTimeout( function () {
          var snap = snapShot();

          video.pause();
          // Show image.
          image.setAttribute('src', snap);

          // Enable delete and save buttons
          $('#download-photo').removeClass('disabled');
          $('#delete-photo').removeClass('disabled');
          $('.editor-photo-icon').addClass('active');
          // Set the href attribute of the download button to the snap url.
          download_photo_btn.href = document.getElementById("canvas").toDataURL("image/png");

      },2900);
  }
});


$('#video5Sek').click(function () {

  var initialCount 	= 6,
      count 			  = initialCount,
      i = 6;

    $('.timer').addClass('active');
    $('div#take-photo').addClass('disabled');
    $('div#video3Sek').addClass('disabled');
    $('div#video5Sek').addClass('disabled');
    $('.stop-video').addClass('disabled');

    function timer() {
          i--;
          console.log(i);
          if (i == 0){
            $('.timer').removeClass('active');
            clearInterval(timmes);
          }
    	  	count = count - 1;
    	  	if (count <= -1) {
    	  		  count = initialCount;
    	        var el = $(".circle-timer");
    	        el.before( el.clone(true) ).remove();
    	  	}
    	  	$(".timer .count").text(count);
    }

    var timmes = setInterval(timer, 1000);

    setTimeout(Timer3sek,1000);

  function Timer3sek() {
    setTimeout( function () {
          var snap = snapShot();

          video.pause();
          // Show image.
          image.setAttribute('src', snap);

          // Enable delete and save buttons
          $('#download-photo').removeClass('disabled');
          $('#delete-photo').removeClass('disabled');
          $('.editor-photo-icon').addClass('active');

          // Set the href attribute of the download button to the snap url.
          download_photo_btn.href = document.getElementById("canvas").toDataURL("image/png");

      },4800);
  }
});


$('#delete-photo').on("click", function(){

  // удаляем изображение
  image.setAttribute('src', "");

      $('#canvas').css({
          display : 'none'
      });

      $('#camera-stream').css({
          display : 'block'
      });


  // если элемент stop-video имеет класс disables то удаляется этот класс
      $('div#take-photo').removeClass('disabled');
      $('div#video3Sek').removeClass('disabled');
      $('div#video5Sek').removeClass('disabled');
      $('.stop-video').removeClass('disabled visible');

      $('.editor-photo-icon').removeClass('active');

      $('#download-photo').addClass('disabled');
      $('#delete-photo').addClass('disabled');
  /*$('div.filters-panel').animate({width:"0"},1000);*/

  // возобновляем видео
  video.play();

});

// Функция снимка
function snapShot() {
    $(image).css({display : 'block'});

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    context.translate(canvas.width, 0);
    context.scale(-1, 1);

    context.drawImage(video,0,0,video.videoWidth,video.videoHeight); //рисуем элемент из видео в canvas

    return canvas.toDataURL('image/png'); // ?
}

// Перейти к редактированию из панель создания фотографии

$('#goToEditPhoto').on('click',function () {
    $('.take-photo-form').css({'display' : 'none'});
    $('.photo-editor-container').css({'display' : 'flex'});
})


// Остановка видео
$('.stop-video').toggle(function(){
        $('.stop-video').addClass('visible');
        video.pause();
    },
    function () {
        $('.stop-video').removeClass('visible');
        video.play();
});
