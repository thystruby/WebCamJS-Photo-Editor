<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WebCamJS</title>
    <!--<link rel="stylesheet" href="/app/font-awesome-4.7.0/css/font-awesome.min.css">-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="app/css/style.min.css">
    <!--<link rel="stylesheet" href="app/css/normalize.css">-->
    <!--<link rel="stylesheet" href="app/css/cropper.css">-->
    <link rel="shortcut icon" href="app/img/photo-camera-titile-icon.png" type="image/png">
    <!-- http://img.pichold.ru/s/271cdca726bfe5404353ee6b79b33d91/ -->
</head>
<body>
<div class="saveFile-overlay">
  <div id="saveFile-bg" class="saveFile-background"></div>
  <div class="saveFile-container">
      <div id="share-test"></div>
      <div class="top-container">
          <span data-language="ru">Сохранить изображение:</span>
          <span data-language="en">Save File:</span>
          <img id="closeSaveFileContainer" src="app/img/icons/image-editor-icon/cancel.svg" alt="">
      </div>
      <div class="share-block">
        <div class="share-container">
          <div class="share-button">
                <img src="app/img/icons/share1.svg" alt="">
          </div>
          <div class="share-facebook-btn">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </div>
          <div class="share-vk-btn">
              <i class="fa fa-vk" aria-hidden="true"></i>
          </div>
          <div class="share-twitter-btn">
              <i class="fa fa-twitter" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="middle-container">
          <canvas id="canvasSaveFile"></canvas>
      </div>
      <div class="bottom-container">
          <div class="center">
              <select name="sources" id="sources" class="custom-select sources" placeholder="Выберите формат">
                  <option value="PNG">PNG</option>
                  <option value="JPG">JPG</option>
              </select>
          </div>
      </div>
      <div class="bottom-text-container">
          <div class="add-fileName-block">
              <span data-language="ru">Введите название файла:</span>
              <span data-language="en">Enter file name:</span>
              <input id="fileNameToSave" type="text" placeholder="WebCamPhoto">
          </div>

          <div class="download-bottom-block">
              <div id="wrap">
                  <a class="btn-slide2" id="downloadPhoto-btn">
                      <span class="circle2"><i class="fa fa-download"></i></span>
                      <span data-language="ru" class="title2">Скачать</span>
                      <span data-language="en" class="title2">Download</span>
                      <span data-language="ru" class="title-hover2">Нажми сюда</span>
                      <span data-language="en" class="title-hover2">Click here</span>
                  </a>
                  <form action="/php/uploadImage.php" method="post" enctype="multipart/form-data" id="upImgForm">
                      <input id="uplImg" type="text" name="newImg"  style="display: none;">
                      <a class="btn-slide2" id="SavePhotoToAccount-btn" style="<?php if (isset($_SESSION['user'])) {} else echo 'display:none'?>; width:259px;" onclick="$('#uplImg').attr('value',canvas.toDataURL() ); $('#upImgForm').submit() ">
                          <span class="circle2"><i class="fa fa-download"></i></span>
                          <span data-language="ru" class="title2">Сохранить в профиль</span>
                          <span data-language="en" class="title2">Save in account</span>
                          <span data-language="ru" class="title-hover2">Нажми сюда</span>
                          <span data-language="en" class="title-hover2">Click here</span>
                      </a>
                  </form>

              </div>
          </div>
      </div>
  </div>
</div>

<div class="header">
    <div class="left-block">
      <div class="change-language-area">
        <h1 class="my-text">RU</h1>
        <input id="change-lang-checkbox" type="checkbox" class="toggler" data-toggle="button-toggle">
        <label for="change-lang-checkbox" class="button-toggle">
            <div class="handle">
                <div class="bars"></div>
            </div>
        </label>
      </div>
      <img src="app/img/icons/russia.svg" class="language-flag" alt="">
    </div>
    <div id="backToEditorMenuMainToolbar" class="center-block">
        <span data-language="en">Back to main menu</span>
        <span data-language="ru">Назад в главное меню</span>
      </div>
    <div class="right-block">
        <a href="login.html" class="login-form" style="<?php if (isset($_SESSION['user'])) {echo 'display:none';} else ?>">
          <img src="app/img/icons/users.svg" alt="">
        </a>
        <div class="login-active-menu" style="<?php if (isset($_SESSION['user'])) {} else echo 'display:none'?>">
          <img src="app/img/icons/users.svg" alt="">
          <img class="arrow" src="app/img/icons/arrow-down-sign-to-navigate.svg" alt="">
        </div>
        <div class="active-popup">
            <div class="arrow-top">
            </div>
              <div class="top-block">
                <div class="user-avatar-block">
                <img src="<?php echo $_SESSION['avatar']?>" id="userAvatar" alt="">
                </div>
                <div class="user-data-container">
                  <div class="user-data-block">
                    <!-- <div class="user-data-name"><span id="userNamePopup">User name</span></div> -->
                    <span class="user-data user-name"><?php echo $_SESSION['login']?></span>
                    <!-- <div class="user-data-email"><span id="userEmailPoput">thystruby@gmail.com</span></div> -->
                    <span class="user-data user-email"><?php echo $_SESSION['email']?></span>
                  </div>

                </div>
              </div>
              <div class="my-collection-container">
            <!-- <a class="phpAction" href="/personalAccount.php"> -->
                <div id="GoToAccount" class="middle-block">
                    <a href="/personalAccount.php" data-language="en">My Collection</a>
                    <a href="/personalAccount.php" data-language="ru">Моя коллекция</a>
                </div>
            <!-- </a> -->
          </div>
            <!-- <a href="/php/logout.php"> -->
                <div id="ExitFromAccount" class="bottom-block">
                    <div class="title">
                        <a href="/php/logout.php" data-language="en">Logout</a>
                        <a href="/php/logout.php" data-language="ru">Выйти</a>
                    </div>
                    <div class="logoutCloseIcon">
                        <img src="app/img/icons/image-editor-icon/cancel.svg" alt="">
                    </div>
                </div>
            <!-- </a> -->
        </div>
        <!--<div class="full-screen-block">
            <img id="fullScreenIcon" src="app/img/icons/image-editor-icon/switch-to-full-screen-button.svg" alt="">
        </div>-->
    </div>
</div>
<div class="start-application">
    <div class="center-container">
        <div class="logo-container">
            <p>
                <a href="/index.php">
                    WebCam  JS
                </a>
            </p>

        </div>
        <div class="action-container">
        <div class="upload-container">
            <label for="upLoad">
                <div class="loadPhoto">
                    <p data-language="ru">Загрузить</p>
                    <p data-language="en">Upload photo</p>
                    <div class="image-container">
                <img src="app/img/upload.svg" alt="">
                    </div>
                </div>
            </label>
        </div>
        <div class="useWebCam-container">
            <div class="useWebCam">
                <p data-language="ru" lang="ru">Сделать</p>
                <p data-language="en" lang="en">Take photo</p>
                <img src="app/img/photo-camera%20(1).svg" alt="">
            </div>
        </div>
        </div>
    </div>
</div>
<div class="take-photo-form">


  <div class="application-container">
    <div id="goToEditPhoto" class="editor-photo-icon">
      <div class="img-block">
        <img src="app/img/icons/pantone.svg" alt="">
      </div>
        <div class="text-block">
          <span data-language="en">Edit photo</span>
          <span data-language="ru">Редактировать</span>
        </div>
    </div>
  <div class="container">
    <div class="timer">
      <div class="timer-overlay"></div>
    <div class="circle-timer">
      <div class="count"></div>
    </div>
  </div>
      <div class="errorMessage">
          <svg version="1.1" id="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
  	 viewBox="0 0 567.41 567.41" xml:space="preserve">
  <g>
  	<path d="M316.967,341.622h-45.388c-57.483,0-104.253,45.988-104.253,102.806c0,7.435,6.034,13.351,13.468,13.351
  		c7.435,0,13.468-6.33,13.468-13.764c0-42.667,33.958-76.392,77.317-76.392h45.388c42.632,0,77.317,34.644,77.317,76.953
  		c0,7.434,6.034,13.587,13.468,13.587s13.468-5.739,13.468-13.173C421.221,387.829,374.45,341.622,316.967,341.622z"/>
  	<path d="M283.7,0c-41.203,0-80.856,8.643-117.968,25.651c-6.408-7.475-11.396-12.569-12.908-14.086
  		c-2.577-2.568-6.258-4.041-9.688-3.96c-3.627,0.036-7.084,1.535-9.589,4.157c-1.507,1.578-30.096,31.755-44.63,66.001
  		c-0.654,0.438-1.285,0.928-1.872,1.493C30.955,133.246,0.067,205.849,0.067,283.705c0,156.43,127.239,283.705,283.633,283.705
  		c156.403,0,283.642-127.275,283.642-283.705C567.342,127.266,440.103,0,283.7,0z M143.558,41.258
  		c14.573,16.826,35.296,44.84,37.792,66.147c1.598,13.585-0.278,23.489-5.567,29.442c-5.755,6.474-16.692,9.751-32.503,9.751
  		c-15.147,0-25.482-3.044-30.717-9.051c-5.019-5.782-6.573-15.821-4.624-29.846C111.315,83.638,131.365,56.1,143.558,41.258z
  		 M283.7,540.464c-141.543,0-256.696-115.181-256.696-256.759c0-57.812,18.832-112.423,53.631-157.16
  		c1.215,11.582,5.09,21.185,11.609,28.681c10.721,12.328,27.412,18.317,51.036,18.317c23.83,0,41.536-6.321,52.625-18.793
  		c10.631-11.942,14.734-28.93,12.211-50.488c-2.27-19.319-13.518-39.848-25.324-56.706c31.881-13.671,65.765-20.61,100.908-20.61
  		c141.543,0,256.706,115.181,256.706,256.759S425.243,540.464,283.7,540.464z"/>
  	<path d="M398.558,281.442c7.434,0,13.468-6.025,13.468-13.468c0-7.443-6.034-13.468-13.468-13.468
  		c-17.661,0-32.584-15.578-32.584-34.012c0-7.434-6.034-13.468-13.468-13.468c-7.434,0-13.468,6.034-13.468,13.468
  		C339.037,253.536,366.297,281.442,398.558,281.442z"/>
  	<path d="M226.792,221.203c0-7.443-6.034-13.468-13.468-13.468c-7.434,0-13.468,6.025-13.468,13.468
  		c0,17.67-15.569,32.593-33.994,32.593c-7.434,0-13.468,6.034-13.468,13.477s6.034,13.468,13.468,13.468
  		C198.886,280.742,226.792,253.473,226.792,221.203z"/>
  </g>
  </svg>
          <br>
          <h2 data-language="ru">Oops! Возникла ошибка.</h2>
          <h2 data-language="en">Oops! Error.</h2>
          <br>
          <p data-language="ru">Возможные проблемы и их решения:</p>
          <p data-language="en">Possible problems and their solution:</p>
          <br>
          <ul>
              <li data-language="ru">1) Проверьте разрешили ли Вы доступ к веб-камере в браузере.</li>
              <li data-language="en">1) Verify access to webcam in browser</li>
              <li data-language="ru">2) Проверьте правильность подключения веб-камеры к компьютеру.</li>
              <li data-language="en">2) Check the connection of the webcam to the computer.</li>
              <li data-language="ru">3) Ваш браузер не поддерживание getUserMedia API. Пожалуйста, обновите браузер.</li>
              <li data-language="en">3) Your browser does not support getUserMedia API. Please update your browser</li>
          </ul>
          <p data-language="ru" class="errorMessage-p">Подробные сведения об ошибке:</p>
          <p data-language="en" class="errorMessage-p">Detailed information about the error:</p>
          <p class="errorMessage-p" id="error-message"></p>
      </div>

    <div class="app">

      <a id="start-camera" class="visible">Нажмите для старта.</a>
      <video id="camera-stream" ></video>
      <img src="" id="snap">

    </div>

      <div id="change"></div>
  </div>
      <div class="controls">
          <div id="back" class="hideUI">
              <img src="app/img/left-arrow.svg" alt="Назад">
          </div>
          <div class="stop-video hideUI" ></div>
          <div class="controls-container">
              <div id="delete-photo" class="disabled"><img class="hideUI" src="app/img/trash.svg" alt="Удалить"></div>
              <div id="video3Sek" class="hideUI">
                  <img src="app/img/icons/stopwatch.svg" title="Сделать фото через 3 секунды" alt="Сделать фото через 3 секунды">
                  <p>3s</p></div>
              <div id="video5Sek" class="hideUI">
                <img src="app/img/icons/stopwatch.svg" title="Сделать фото через 3 секунды" alt="Сделать фото через 3 секунды">
                  <p>5s</p></div>
              <div id="take-photo" onclick="new Audio('app/audio/ZvukCamera.mp3').play(); return false;" ><img class="hideUI" src="app/img/camera-retro.svg" alt="Фото"></div>
              <div id="download-photo" class="disabled"><img id="savePhotoBtn" class="hideUI" src="app/img/download.svg" alt="Сохранить"></div>
          </div>
      </div>
  </div>
</div>
<div class="photo-editor-container">
    <div class="main-photo-editor-toolbar">
        <div class="title">
            <h4 data-language="ru">Меню</h4>
            <h4 data-language="en">Menu</h4>
        </div>
        <div class="editor-container">
          <div class="editor-elem edit">
              <span data-language="ru">Редактирование</span>
              <span data-language="en">Edit</span>
          </div>
          <div class="editor-elem filters">
              <span data-language="ru">Фильтры</span>
              <span data-language="en">Filters</span>
          </div>
          <div class="editor-elem crop">
              <span data-language="ru">Обрезка изображения</span>
              <span data-language="en">Crop image</span>
          </div>
            <div class="editor-elem paint">
                <span data-language="ru">Рисовать</span>
                <span data-language="en">Draw</span>
            </div>
            <div class="editor-elem text">
                <span data-language="en">Add text</span>
                <span data-language="ru">Добавить текст</span>
                <!--<input id="textInput" type="text">
                <div id="text" style="width: 50px; height: 50px; background: #fff"></div>-->
            </div>
        </div>
        <div class="bottom-editor-button">
            <div class='container'>
                <button id="resetButtonMainToolbar" class='myButt five'>
                    <div data-language="ru" class='layer'>Сбросить</div>
                    <div data-language="en" class="layer">Reset</div>
                    <img src="app/img/icons/image-editor-icon/crossWhite.svg" alt="">
                </button>
                <button id="SaveButtonMainToolbar" class='myButt save'>
                    <div data-language="ru"  class='layer'>Сохранить</div>
                    <div data-language="en" class="layer">Save</div>
                    <img src="app/img/icons/image-editor-icon/checked.svg" alt="">
                </button>
                <!--<button id="backToEditorMenuMainToolbar" class='myButt backToEditorMenu'>
                    <div data-language="ru"  class='layer'>Назад</div>
                    <div data-language="en" class="layer">Back</div>
                    <img src="app/img/icons/image-editor-icon/backWhite.svg" alt="">
                </button>-->
            </div>
        </div>
    </div>
    <div class="photo-editor-crop">
        <div class="title">
            <h4 data-language="ru">Обрезка</h4>
            <h4 data-language="en">Crop</h4>
        </div>
        <div class="editor-container">

        </div>
    </div>
    <div class="photo-editor-paint">
            <div class="title">
                <h4 data-language="ru">Рисовать</h4>
                <h4 data-language="en">Draw</h4>
            </div>
        <div class="editor-container">
            <div class="editor-elem value">
                <label data-language="ru" for="valuePan">Размер:</label>
                <label data-language="en" for="valuePan">Size:</label>
                <output for="valuePan" class="all-output output_brigh"></output>
                <input value="2" id="valuePan" name="valuePan" step="0.1" oninput="changePenSize(parseFloat(event.target.value));" type="range" min="1" max="20">
            </div>

            <div class="editor-elem smoothing">
                    <span data-language="ru">Сглаживание:</span>
                    <span data-language="en">Smoothing</span>
                <label class="control-check1 control--checkbox">
                    <input type="checkbox" checked onchange="sketcher.smoothing = event.target.checked;" id="DrawSmoothCheck"/>
                    <div class="control__indicator"></div>
                </label>
            </div>
            <div class="editor-elem color">
                <span data-language="ru">Выберите цвет:</span>
                <span data-language="en">Select color:</span>
                <input type="color" onchange="changeColorPen(event.target.value);">
            </div>

        </div>
        <div class="bottom-editor-button">
            <div class='container'>
                <button id="resetButtonDraw" class='myButt five'>
                    <div data-language="ru"  class='layer'>Сбросить</div>
                    <div data-language="en" class='layer'>Reset</div>
                    <img src="app/img/icons/image-editor-icon/crossWhite.svg" alt="">
                </button>
                <button id="backToEditorMenuDraw" class='myButt backToEditorMenu'>
                    <div data-language="ru"  class='layer'>Назад</div>
                    <div data-language="en" class='layer'>Back</div>
                    <img src="app/img/icons/image-editor-icon/backWhite.svg" alt="">
                </button>
            </div>
        </div>
    </div>
    <div class="photo-editor-text">
        <div class="title">
                <h4 data-language="ru">Добавить текст</h4>
                <h4 data-language="en">Add text</h4>
        </div>
        <div class="editor-container">
            <div class="editor-elem select-fontSize">
                <span data-language="en">Font size:</span>
                <span data-language="ru">Размер шрифта:</span>
                <div class="select">
                <span class="placeholder" id="placeholder-fontSize">25pt</span>
                <ul>
                    <li data-value="de">16pt</li>
                    <li data-value="de">17pt</li>
                    <li data-value="de">18pt</li>
                    <li data-value="de">19pt</li>
                    <li data-value="de">20pt</li>
                    <li data-value="de">21pt</li>
                    <li data-value="de">22pt</li>
                    <li data-value="de">23pt</li>
                    <li data-value="de">24pt</li>
                    <li data-value="de">25pt</li>
                    <li data-value="de">26pt</li>
                    <li data-value="de">27pt</li>
                    <li data-value="de">28pt</li>
                    <li data-value="de">29pt</li>
                    <li data-value="de">30pt</li>
                    <li data-value="de">31pt</li>
                    <li data-value="de">32pt</li>
                    <li data-value="de">33pt</li>
                    <li data-value="de">34pt</li>
                    <li data-value="de">35pt</li>
                    <li data-value="de">36pt</li>
                    <li data-value="de">37pt</li>
                    <li data-value="de">38pt</li>
                    <li data-value="de">39pt</li>
                    <li data-value="de">40pt</li>
                    <li data-value="de">41pt</li>
                    <li data-value="de">42pt</li>
                    <li data-value="de">43pt</li>
                    <li data-value="de">44pt</li>
                    <li data-value="de">45pt</li>
                    <li data-value="de">46pt</li>
                    <li data-value="de">47pt</li>
                    <li data-value="de">48pt</li>
                    <li data-value="de">49pt</li>
                </ul>
                <input type="hidden" name="changeme"/>
            </div>
            </div>
            <div class="editor-elem select-fontFamily">
                <span data-language="en">Font family:</span>
                <span data-language="ru">Шрифт:</span>  
                <div class="select">
                <span class="placeholder" id="placeholder-fontFamily">Arial</span>
                    <ul>
                        <li data-value="es">Arial</li>
                        <li data-value="en">Tahoma</li>
                        <li data-value="fr">Verdana</li>
                        <li data-value="de"> Roman</li>
                        <li>Georgia</li>
                        <li>Lucida</li>
                    </ul>
                    <input type="hidden" name="changeme"/>
                </div>  
            </div>
            
            <div class="editor-elem select-position">
                <span data-language="en">Position:</span> 
                <span data-language="ru">Позиция:</span>
                <div class="position-box">
                    <div class="position-box-row top-line">
                        <div id="pos-top-left" class="box-elem top-left active">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                        <div id="pos-top-center" class="box-elem top-center">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                        <div id="pos-top-right" class="box-elem top-right">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="position-box-row middle-line">
                        <div id="pos-middle-left" class="box-elem middle-left">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                        <div id="pos-middle-center" class="box-elem middle-center">
                            <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                        </div>
                        <div id="pos-middle-right" class="box-elem middle-right">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="position-box-row bottom-line">
                        <div id="pos-bottom-left" class="box-elem bottom-left">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                        <div id="pos-bottom-center" class="box-elem bottom-center">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                        <div id="pos-bottom-right" class="box-elem bottom-right">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>   
            </div> 
            <div class="editor-elem color-text">
                <div class="color-text-text">
                    <span data-language="en">Color:</span>
                    <span data-language="ru">Цвет:</span>
                </div>
                <div class="color-text-input">
                    <input type="color" onchange="fontColor = event.target.value">
                </div>
            </div>
            <div class="editor-elem enterText">
                <div class="color-text-text">
                    <span data-language="en">Enter text:</span>
                    <span data-language="ru">Текст:</span>
                </div>
                <div class="color-text-input">
                    <input type="text" id="textCanvas">
                </div>
            </div>
            <div class="editor-elem select-typeText">
                <div class="select-typeText-container">
                <div id="boldText" class="typeText-elem bold">
                    <img src="app/img/icons/image-editor-icon/bold-text.svg" alt="">
                </div>
                <div id="typeText" class="typeText-elem type active">
                    <img src="app/img/icons/image-editor-icon/type-text.svg" alt="">
                </div>
                <div id="italicText" class="typeText-elem italic">
                    <img src="app/img/icons/image-editor-icon/italics-text.svg" alt="">
                </div>
                </div>
            </div>
            <div class="editor-elem applyAddText">
                <div class="applyAddText-button">
                    <span data-language="en">Apply</span>
                    <span data-language="ru">Применить</span>
                </div>  
            </div>
        </div>
        <div class="bottom-editor-button">
            <div class='container'>
                <button id="resetButtonAddText" class='myButt five'>
                    <div data-language="ru"  class='layer'>Сбросить</div>
                    <div data-language="en" class='layer'>Reset</div>
                    <img src="app/img/icons/image-editor-icon/crossWhite.svg" alt="">
                </button>
                <button id="backToEditorMenuAddText" class='myButt backToEditorMenu'>
                    <div data-language="ru"  class='layer'>Назад</div>
                    <div data-language="en" class='layer'>Back</div>
                    <img src="app/img/icons/image-editor-icon/backWhite.svg" alt="">
                </button>
            </div>
        </div>
    </div>
    <div class="photo-editor-filter">
        <div class="title">
            <h4 data-language="ru">Фильтры</h4>
            <h4 data-language="en">Filters</h4>
        </div>
        <div class="editor-container">
            <div class="filter-overlay"><div id="1997FilterBtn" class="editor-elem"><span>1997</span></div></div>
            <div id="ghotamFilterBtn" class="editor-elem"><span>Ghotam</span></div>
            <div id="hefeFilterBtn" class="editor-elem"><span>Hefe</span></div>
            <div id="lordkelvinFilterBtn" class="editor-elem"><span>Lord Kelvin</span></div>
            <div id="nashvilleFilterBtn" class="editor-elem"><span>NashVille</span></div>
            <div id="xproFilterBtn" class="editor-elem"><span>X-PRO</span></div>
            <div id="vintageFilterBtn" class="editor-elem"><span>Vintage</span></div>
            <div id="lomoFilterBtn" class="editor-elem"><span>Lomo</span></div>
            <div id="embossFilterBtn" class="editor-elem"><span>Emboss</span></div>
            <div id="tiltFilterBtn" class="editor-elem"><span>Tilt Shift</span></div>
            <div id="radialBlurFilterBtn" class="editor-elem"><span>Radial Blur</span></div>
            <div id="edgeFilterBtn" class="editor-elem"><span>Edge Enhance</span></div>
            <div id="posterizeFilterBtn" class="editor-elem"><span>Porterize</span></div>
            <div id="clarityFilterBtn" class="editor-elem"><span>Clarity</span></div>
            <div id="orangePellFilterBtn" class="editor-elem"><span>Orange Pell</span></div>
            <div id="sinCityFilterBtn" class="editor-elem"><span>Sin City</span></div>
            <div id="sunRiseFilterBtn" class="editor-elem"><span>Sun Rise</span></div>
            <div id="crossProcessFilterBtn" class="editor-elem"><span>Cross Process</span></div>
            <div id="hazyFilterBtn" class="editor-elem"><span>Hazy</span></div>
            <div id="loveFilterBtn" class="editor-elem"><span>Love</span></div>
            <div id="grungyFilterBtn" class="editor-elem"><span>Grungy</span></div>
            <div id="jarquesFilterBtn" class="editor-elem"><span>Jarques</span></div>
            <div id="pinHoleFilterBtn" class="editor-elem"><span>Pin Hole</span></div>
            <div id="oldBootFilterBtn" class="editor-elem"><span>Old Boot</span></div>
            <div id="glowSunFilterBtn" class="editor-elem"><span>Glow Sun</span></div>
            <div id="HDRFilterBtn" class="editor-elem"><span>HDR Effect</span></div>
            <div id="oldPaperFilterBtn" class="editor-elem"><span>Old Paper</span></div>
            <div id="pleasantFilterBtn" class="editor-elem"><span>Pleasant</span></div>
        </div>
        <div class="bottom-editor-button">
            <div class='container'>
                <button id="resetButtonFilter" class='myButt five'>
                    <div data-language="ru"  class='layer'>Сбросить</div>
                    <div data-language="en" class='layer'>Reset</div>
                    <img src="app/img/icons/image-editor-icon/crossWhite.svg" alt="">
                </button>
                <button id="backToEditorMenuFilter" class='myButt backToEditorMenu'>
                    <div data-language="ru"  class='layer'>Назад</div>
                    <div data-language="en" class='layer'>Back</div>
                    <img src="app/img/icons/image-editor-icon/backWhite.svg" alt="">
                </button>
            </div>
        </div>
    </div>
    <div class="toolbar">
        <div class="title">
            <h4 data-language="ru">Редактирование</h4>
            <h4 data-language="en">Edit</h4>
        </div>
        <div class="editor-container">
            <div class="editor-elem brightness">
                <label data-language="ru" for="brightness">Яркость</label>
                <label data-language="en" for="brightness">Brightness</label>
                <output for="brightness" class="all-output output_brigh"></output>
                <input value="0" id="brightness" name="brightness" class="editor-input" type="range" min="-100" max="100" oninput="fun1()">
            </div>
            <div class="editor-elem hue">
                <label data-language="ru" for="hue">Тон</label>
                <label data-language="en" for="hue">Hue</label>
                <output for="hue" class="all-output output_hue"></output>
                <input value="0" id="hue" class="editor-input" name="hue" type="range" min="0" max="100" oninput="fun2()">
            </div>
            <div class="editor-elem gamma">
                <label data-language="ru" for="gamma">Гамма</label>
                <label data-language="en" for="gamma">Gamma</label>
                <output for="gamma" class="all-output output_gamma"></output>
                <input value="1" id="gamma" class="editor-input" name="gamma" type="range" step="1" min="1" max="10" oninput="fun3()">
            </div>
            <div class="editor-elem contrast">
                <label data-language="ru" for="contrast">Контраст</label>
                <label data-language="en" for="contrast">Contrast</label>
                <output for="contrast" class="all-output output_contr"></output>
                <input value="0" id="contrast" class="editor-input" name="contrast" type="range" min="-10" step="1" max="25" oninput="fun4()">
            </div>
            <div class="editor-elem saturation">
                <label data-language="ru" for="saturation">Насыщенность</label>
                <label data-language="en" for="saturation">Saturation</label>
                <output for="saturation" class="all-output output_satur"></output>
                <input value="0" id="saturation" class="editor-input" name="saturation" type="range" min="-100" max="100" oninput="fun5()">
            </div>
            <div class="editor-elem exposure">
                <label data-language="ru" for="exposure">Экспозиция</label>
                <label data-language="en" for="exposure">Exposure</label>
                <output for="exposure" class="all-output output_exp"></output>
                <input value="0" id="exposure" class="editor-input" name="exposure" type="range" min="-50" max="100" oninput="fun6()">
            </div>
            <div class="editor-elem sepia">
                <label data-language="ru" for="sepia">Сепия</label>
                <label data-language="en" for="sepia">Sepia</label>
                <output for="sepia" class="all-output output_sepia"></output>
                <input value="0" id="sepia" class="editor-input" name="sepia" type="range" min="-50" max="100" oninput="fun7()">
            </div>
            <div class="editor-elem noise">
                <label data-language="ru" for="noise">Шум</label>
                <label data-language="en" for="noise">Noise</label>
                <output for="noise" class="all-output output_noise"></output>
                <input value="0" id="noise" class="editor-input" name="noise" type="range" min="0" max="100" oninput="fun8()">
            </div>
            <div class="editor-elem sharpen">
                <label data-language="ru" for="sharpen">Резкость</label>
                <label data-language="en" for="sharpen">Sharpen</label>
                <output for="sharpen" class="all-output output_sharpen"></output>
                <input value="0" id="sharpen" class="editor-input" name="sharpen" type="range" min="-50" max="100" oninput="fun9()">
            </div>
        </div>
        <div class="bottom-editor-button">
            <div class='container'>
                <button id="reset" class='myButt five'>
                    <div data-language="ru"  class='layer'>Сбросить</div>
                    <div data-language="en" class="layer">Reset</div>
                    <img src="app/img/icons/image-editor-icon/crossWhite.svg" alt="">
                </button>
                <button id="backToEditorMenu" class='myButt backToEditorMenu'>
                    <div data-language="ru"  class='layer backToEditorMenuButton'>Назад</div>
                    <div data-language="en" class="layer backToEditorMenuButton">Back</div>
                    <img src="app/img/icons/image-editor-icon/backWhite.svg" alt="">
                </button>
            </div>
        </div>
    </div>
    <div class="image-container"><canvas id="canvas"></canvas></div>
</div>
<div class="cropp-image-container">
    
    
    <div id="saveFile-bg" class="saveFile-background-crop">

    </div>
    <div id="saveFileContainerCrop" class="saveFile-container-crop">
        <div class="top-container">
            <span data-language="ru">Обрезанное изображение:</span>
            <span data-language="en">Cropped image:</span>
            <img id="closeSaveFileCropContainer" src="app/img/icons/image-editor-icon/cancel.svg" alt="">
        </div>
        <div class="middle-container">
            <canvas id="canvasSaveFileCrop"></canvas>
        </div>
        <div class="bottom-text-container">
            <div class="download-bottom-block">
                <div id="wrap">
                    <a class="btn-slide2" id="downloadCropPhoto-btn">
                        <span class="circle2"><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span data-language="ru" class="title2">Применить</span>
                        <span data-language="en" class="title2">To apply</span>
                        <span data-language="ru" class="title-hover2">Нажми сюда</span>
                        <span data-language="en" class="title-hover2">Click here</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

  <img src="" id="cropImageElem" alt="">
  <div class="container-footer">
    <div class="footer-container">
      <div class="btn-group">
        <div class="container-elem elem-1" id="cropImageMove">
          <i class="fa fa-arrows" aria-hidden="true"></i>
        </div>
        <div class="container-elem elem-1" id="cropImageCrop">
        <i class="fa fa-crop" aria-hidden="true"></i>
      </div>
      </div>
      <div class="btn-group">
        <div class="container-elem elem-1" id="cropImageRotateLeft">
          <i class="fa fa-undo" aria-hidden="true"></i>
        </div>
        <div class="container-elem elem-1" id="cropImageRotateRight">
        <i class="fa fa-repeat" aria-hidden="true"></i>
      </div>
      </div>
      <div class="btn-group">
        <div class="container-elem elem-1" id="cropImageZoomPlus">
          <i class="fa fa-search-plus" aria-hidden="true"></i>
        </div>
        <div class="container-elem elem-1" id="cropImageZoomMinus">
        <i class="fa fa-search-minus" aria-hidden="true"></i>
      </div>
      </div>
      <div class="btn-group">
        <div class="container-elem elem-1" id="cropImageScaleX">
          <i class="fa fa-arrows-h" aria-hidden="true"></i>
        </div>
        <div class="container-elem elem-1" id="cropImageScaleY">
          <i class="fa fa-arrows-v" aria-hidden="true"></i>
        </div>
      </div>
      <div class="btn-group">
        <div class="container-elem elem-1" id="cropImageReset">
          <i class="fa fa-refresh" aria-hidden="true"></i>
        </div>
      </div>
      <div class="btn-group">
        <div class="container-elem elem-2" id="cropImageSaveImage">
          <i class="fa fa-check" aria-hidden="true"></i>
        </div>
        <div class="container-elem elem-1" id="cropImageBackToMenu">
          <i class="fa fa-caret-square-o-left" aria-hidden="true"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<input id="upLoad" type="file">

<canvas id="backCanvasElem"></canvas>
<img id="backImg" src="" alt="">
<img src="" id="TestImage" alt="">


<div class="footer"><span>&copy;
 Н.Д. Певнев, 2017</span><a href="https://github.com/thystruby"><i class="fa fa-github" aria-hidden="true"></i>thystruby</a></div>
<script src="https://yastatic.net/share2/share.js"></script>

<!--<script src="app/js/vendor/jquery.min.js"></script>
<script src="app/js/vendor/cropper.js"></script>
<script src="app/js/vendor/caman.full.min.js"></script>
<script src="app/js/vendor/FileSaver.min.js"></script>
<script src="app/js/vendor/atrament.min.js"></script>
<script src="app/js/vendor/sketchpad.js"></script>-->
<!--<script src="app/js/vendor/atrament.min.js"></script>-->
<script src="dist/js/libs-main.min.js"></script>
<script src="app/js/UI-script.js"></script>
<script src="app/js/drawJS.js"></script>
<script src="app/js/cropImage.js"></script>
<script src="app/js/script-new.js"></script>
<script src="app/js/canvas-filters.js"></script>
<script src="app/js/addText.js"></script>
<script src="app/js/share.js"></script>
</body>
</html>
