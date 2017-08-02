/**
 * Created by thyst on 21.05.2017.
 */

 $('.editor-elem.crop').on('click', function () {
  //  event.preventDefault();
     /*var text = "Этот текст должен быть написан справа в самом низу.";
     var marginLeft = canvas.width - context.measureText(text).width;
     var marginTop = canvas.height - getFontHeight(context.font);
     context.fillText(text, marginLeft, marginTop);
     function getFontHeight(font) {
         var parent = document.createElement("span");
         parent.appendChild(document.createTextNode("height"));
         document.body.appendChild(parent);
         parent.style.cssText = "font: " + font + "; white-space: nowrap; display: inline;";
         var height = parent.offsetHeight;
         document.body.removeChild(parent);
         return height;
     }*/
     // $('.photo-editor-crop').css('display','block');
     $('.photo-editor-container').css('display','none');
     $('.cropp-image-container').css('display','flex');
     $('.center-block').css('display','none');
     $('#cropImageElem').attr('src',canvas.toDataURL("image/png") );


     var canvasCrop = document.getElementById('cropImageElem');


     var cropper = new Cropper(canvasCrop, {
       aspectRatio: 16 / 9,
       viewMode : 1,
       aspectRatio: 'free'
     });

     $('#cropImageMove').on('click', function () {
       cropper.setDragMode("move");
     });

     $('#cropImageCrop').on('click', function () {
       cropper.setDragMode("crop");
     });

     $('#cropImageRotateLeft').on('click',function() {
         cropper.rotate(90);
     });

     $('#cropImageRotateRight').on('click',function() {
         cropper.rotate(90);
     });

     $('#cropImageZoomPlus').on('click',function () {
       cropper.zoom(0.1);
     });

     $('#cropImageZoomMinus').on('click',function () {
       cropper.zoom(-0.1);
     });

     $('#cropImageScaleX').on('click', function () {
       if ($('#cropImageScaleX').hasClass('scaled')){
         $('#cropImageScaleX').removeClass('scaled');
         cropper.scaleX(1);
       }else{
         $('#cropImageScaleX').addClass('scaled');
         cropper.scaleX(-1);
       }
     });

     $('#cropImageScaleY').on('click', function () {
       if ($('#cropImageScaleY').hasClass('scaled')){
         $('#cropImageScaleY').removeClass('scaled');
         cropper.scaleY(1);
       }else{
         $('#cropImageScaleY').addClass('scaled');
         cropper.scaleY(-1);
       }
     })

     $('#cropImageReset').on('click', function () {
       cropper.reset();
     })

     $('#cropImageSaveImage').on('click', function () {
      //  cropper.getCroppedCanvas().toDataURL('image/jpeg')
      var canvasCropFinal = cropper.getCroppedCanvas();
      var canvasSaveFileCrop = document.getElementById('canvasSaveFileCrop');
      var contextCanvasSaveFileCrop = canvasSaveFileCrop.getContext('2d');

      canvasSaveFileCrop.width = canvasCropFinal.width;
      canvasSaveFileCrop.height = canvasCropFinal.height;

      contextCanvasSaveFileCrop.drawImage(canvasCropFinal,0,0,canvasCropFinal.width,canvasCropFinal.height)

      console.log(canvasCropFinal);
      $('.saveFile-overlay').addClass('active');
      $('.saveFile-background').addClass('active');
      $('#saveFileContainerCrop').addClass('active');

        $('#closeSaveFileCropContainer').on('click', function () {
            $('.saveFile-overlay').removeClass('active');
            $('.saveFile-background').removeClass('active');
            $('#saveFileContainerCrop').removeClass('active');
        });

        // $('.saveFile-background-crop').on('click',function () {
        //   $('.saveFile-overlay').removeClass('active');
        //   $('.saveFile-background').removeClass('active');
        //   $('#saveFileContainerCrop').removeClass('active');
        // })

        $('#downloadCropPhoto-btn').on('click', function () {
          // event.preventDefault();
          context.clearRect(0, 0, canvas.width, canvas.height);
          context.save();
          // Используем идентичную матрицу трансформации на время очистки
          context.setTransform(1, 0, 0, 1, 0, 0);
          context.clearRect(0, 0, canvas.width, canvas.height);
          // Возобновляем матрицу трансформации
          context.restore();

          canvas.width = canvasCropFinal.width;
          canvas.height = canvasCropFinal.height;

          // var TestCrop = $('#TestImage');

          // $('#TestImage').attr('src', canvasCropFinal.toDataURL('image/png'));

          context.drawImage(canvasCropFinal,0,0,canvasCropFinal.width,canvasCropFinal.height);

          $('.saveFile-overlay').removeClass('active');
          $('.saveFile-background').removeClass('active');
          $('#saveFileContainerCrop').removeClass('active');
          $('.photo-editor-container').css('display','flex');
          $('.center-block').css('display','block');
          $('.cropp-image-container').css('display','none');
          cropper.destroy();
        });
     })

     $('#cropImageBackToMenu').on('click', function () {
      //  event.preventDefault();
       cropper.destroy();
       $('.photo-editor-container').css('display','flex');
       $('.cropp-image-container').css('display','none');
     })

 });
