
   function changeColorPen(penColor) {
    context.strokeStyle = penColor;
}

function changePenSize(penSize){
    context.lineWidth = penSize;
}

function clearDraw(){
    context.clearRect(0, 0, canvas.width, canvas.height);
    context.drawImage(imageForText,0,0,imageForText.width,imageForText.height);
}
$('.editor-elem.paint').on('click', function () {
var isDrawing;
     imageForText.src = canvas.toDataURL('image/png');

console.log(canvas.offsetTop);

function startDrawing(e) {
	// Начинаем рисовать
	isDrawing = true;
	context.lineCap = 'round';
	// Создаем новый путь (с текущим цветом и толщиной линии) 
	context.beginPath();
	
	// Нажатием левой кнопки мыши помещаем "кисть" на холст
	context.moveTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
}

function draw(e) {
	if (isDrawing == true)
	{
	  	// Определяем текущие координаты указателя мыши
		var x = e.clientX - canvas.offsetLeft;
		var y = e.clientY - canvas.offsetTop;
		
		// Рисуем линию до новой координаты
		context.lineTo(x, y);
		context.stroke();
	}
}

function stopDrawing() {
    isDrawing = false;	
}

function drawMouse() {
     canvas.onmousedown = startDrawing;
      canvas.onmouseup = stopDrawing;
      canvas.onmouseout = stopDrawing;
      canvas.onmousemove = draw;
}
    drawMouse();
    $('.photo-editor-container .photo-editor-paint').css('display','block');
    $('.main-photo-editor-toolbar').css({
        'display' : 'none'
    });
});

$('#resetButtonDraw').on('click', function(){
    clearDraw();
})
