     var imageForText = new Image();
 $('.editor-elem.text').on('click',function(){
     imageForText.src = canvas.toDataURL('image/png');
        $('.main-photo-editor-toolbar').css({
        'display' : 'none'
    })
        $('.photo-editor-text').css('display','block');
 })

// выпадающее меню

$('.select').on('click','.placeholder',function(){
  var parent = $(this).closest('.select');
  if ( ! parent.hasClass('is-open')){
    parent.addClass('is-open');
    $('.select.is-open').not(parent).removeClass('is-open');
  }else{
    parent.removeClass('is-open');
  }
}).on('click','ul>li',function(){
  var parent = $(this).closest('.select');
  parent.removeClass('is-open').find('.placeholder').text( $(this).text() );
  parent.find('input[type=hidden]').attr('value', $(this).attr('data-value') );
});

// Стиль текста

$('#boldText').on('click', function(){
    // fontWidth = 'bold';
    $('#typeText').removeClass('active');
    $('#boldText').addClass('active');
})

$('#typeText').on('click', function(){
    // fontWidth = '';
    $('#boldText').removeClass('active');
    $('#italicText').removeClass('active');
    $('#typeText').addClass('active');
})

$('#italicText').on('click', function(){
    // fontWidth = 'italic';
    $('#typeText').removeClass('active');
    $('#italicText').addClass('active');
})

var boldText = $('#boldText'),
    typeText = $('#typeText'),
    italicText = $('#italicText');


function fontsWidth(){
    if(boldText.hasClass('active')){
        fontWidth= 'bold';
    }else if(typeText.hasClass('active')){
        fontWidth= '';
    }else if(italicText.hasClass('active')){
        fontWidth= 'italic';
    }
    
     if(boldText.hasClass('active') && italicText.hasClass('active')){
        fontWidth= 'italic bold';
    }
}

// добавить текст 

var x = 30,
    y = 60,
    // dx = 5,
    // dy = 3,
    // dragok = false,
    fontSize =  $('#placeholder-fontSize'),
    fontFamily = $('#placeholder-fontFamily'),
    fontWidth = '',
    fontColor = '#000',
    textInput = document.getElementById('textCanvas'),
    inputVal;
    // test

    var marginLeft;
     var marginTop;
    // text,
    // textLength;

// отчистить канвас

function clearText(){
    context.clearRect(0, 0, canvas.width, canvas.height);
    context.drawImage(imageForText,0,0,imageForText.width,imageForText.height);
}

function getFontHeight(font) {
        var parent = document.createElement("span");
        parent.appendChild(document.createTextNode("height"));
        document.body.appendChild(parent);
        parent.style.cssText = "font: " + font + "; white-space: nowrap; display: inline;";
        var height = parent.offsetHeight;
        document.body.removeChild(parent);
        return height;
    }

// Позиция текста 

$('.box-elem').on('click', function(e){
    $('.box-elem').removeClass('active');
    e.currentTarget.classList.add('active');
})


function drawCanvas() {
    var fontSizeText = fontSize.text(),
        fontFamilyText = fontFamily.text(),
        inputVal = textInput.value;

        fontsWidth();
    if($('#pos-top-left').hasClass('active')){
        marginLeft = 40;
        marginTop = getFontHeight(context.font);
    }
    if($('#pos-top-center').hasClass('active')){
        marginLeft = (canvas.width / 2) - (context.measureText(inputVal).width /2 );
        marginTop = getFontHeight(context.font);
    }
    if($('#pos-top-right').hasClass('active')){
        marginLeft = canvas.width - ((context.measureText(inputVal).width) + 5);
        marginTop = getFontHeight(context.font);
    }
    if($('#pos-middle-left').hasClass('active')){
        marginTop = (canvas.height / 2) - (getFontHeight(context.font)/2);
        marginLeft = 40;
    }
    if($('#pos-middle-center').hasClass('active')){
        marginLeft = (canvas.width / 2) - (context.measureText(inputVal).width /2 );
        marginTop = (canvas.height / 2) - (getFontHeight(context.font)/2);
    }
    if($('#pos-middle-right').hasClass('active')){
        marginTop = (canvas.height / 2) - (getFontHeight(context.font)/2);
        marginLeft = canvas.width - ((context.measureText(inputVal).width) + 5);
    }
    if($('#pos-bottom-left').hasClass('active')){
        marginLeft = 40;
        marginTop = canvas.height - (getFontHeight(context.font)/2);
    }
    if($('#pos-bottom-center').hasClass('active')){
        marginLeft = (canvas.width / 2) - (context.measureText(inputVal).width /2 );
        marginTop = canvas.height - (getFontHeight(context.font)/2);
    }
    if($('#pos-bottom-right').hasClass('active')){
        marginLeft = canvas.width - ((context.measureText(inputVal).width) + 5);
        marginTop = canvas.height - (getFontHeight(context.font)/2);
    }

        clearText();
        
    context.font = fontWidth +' '+ fontSizeText +' '+ fontFamilyText;
    context.fillStyle = fontColor;
    context.strokeStyle = "#F00";
    context.fillText(inputVal,marginLeft,marginTop);
}

$('.applyAddText-button').on('click', function(){
    drawCanvas();
    drawCanvas();
})

// Сбросить

$('#resetButtonAddText').on('click',function(){
    clearText();
})