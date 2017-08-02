<?php session_start(); if(isset($_SESSION['user'])) {} else {header("Location: /login.php");} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Pragma" content="no-cache" />
  <link rel="stylesheet" href="app/css/personalAccount.css">
  <link rel="stylesheet" href="app/css/normalize.css">
  <link rel="stylesheet" href="app/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="app/img/photo-camera-titile-icon.png" type="image/png">
  <link rel="stylesheet" href="/app/css/lightgallery.min.css">
  <title>WebCamJS</title>
</head>
<body>
  <div class="update-password-overlay">
    <div class="update-password-background"></div>
    <div class="delete-image-block">
        <div class="top-block">
          <div id="" class="logoutCloseIcon closeRecoveryPasswordWindow">
            <img  src="/app/img/icons/image-editor-icon/cancel.svg" alt="">
          </div>
      </div>
      <div class="text-block">
        <img src="/app/img/icons/warning.svg" alt="">
        <span data-language="en">Are you sure you want to delete this image?</span>
        <span data-language="ru">Вы действительно хотите удалить это изображение?</span>
      </div>
      <div class="bottom-block">
          <span class="delete-image-btn" data-language="en">Confirm</span>
          <span class="delete-image-btn" data-language="ru">Подтвердить</span>
      </div>
    </div>
    <div class="update-password">
      <div class="top-block">
        <div id="" class="logoutCloseIcon closeRecoveryPasswordWindow">
          <img  src="/app/img/icons/image-editor-icon/cancel.svg" alt="">
        </div>
      </div>
      <div class="text-block">
        <img src="/app/img/icons/pin-code.svg" alt="">
        <span data-language="en">Enter new password</span>
        <span data-language="ru">Введите новый пароль</span>
      </div>
      <form class="" action="/php/changePassword.php" method="post" id="updatePasswordForm" autocomplete="off">
          <input type="password" name="new_password" value="">
          <label data-language="ru" for="changePasswordSubmit">Подтвердить</label>
          <label data-language="en" for="changePasswordSubmit">Confirm</label>
          <input type="submit" class="button" id="changePasswordSubmit"  value="Confirm">
      </form>
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
        <img src="/app/img/icons/russia.svg" class="language-flag" alt="">
      </div>
      <a href="/index.php">
      <div class="center-block">
        <span data-language="en">Back to main menu</span>
        <span data-language="ru">Назад в главное меню</span>
      </div>
      </a>
      <div class="right-block">
          <a href="login.html" class="login-form" style="<?php if (isset($_SESSION['user'])) {echo 'display:none';} else ?>">
            <img src="/app/img/icons/users.svg" alt="">
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
                    <form action="/php/uploadAvatar.php" method="post" enctype="multipart/form-data">
                        <label for="uploadAvatar">
                            <div class="uploadAvatarInnerBlock">
                                <span data-language="en">Change</span>
                                <span data-language="ru">Изменить</span>
                            </div>
                        </label>
                        <input onchange="this.form.submit();" id="uploadAvatar" type="file" name="avatar">
                    </form>
                </div>
                <div class="my-collection-container">
                  <!-- <a href="/personalAccount.php"> -->
                      <div id="GoToAccount" class="middle-block">
                          <a  href="/personalAccount.php" data-language="en">My Collection</a>
                          <a  href="/personalAccount.php" data-language="ru">Моя коллекция</a>
                      </div>
                  <!-- </a> -->
                </div>
                <div id="changePassword" class="middle-block">
                  <span data-language="en">Change password</span>
                  <span data-language="ru">Изменить пароль</span>
                </div>
              <!-- <a href="/php/logout.php"> -->
                  <div id="ExitFromAccount" class="bottom-block">
                      <div class="title">
                          <a href="/php/logout.php" data-language="en">Logout</a>
                          <a href="/php/logout.php" data-language="ru">Выйти</a>
                      </div>
                      <div class="logoutCloseIcon">
                          <img src="/app/img/icons/image-editor-icon/cancel.svg" alt="">
                      </div>
                  </div>
              <!-- </a> -->
          </div>
          <div class="full-screen-block">
              <img id="fullScreenIcon" src="/app/img/icons/image-editor-icon/switch-to-full-screen-button.svg" alt="">
          </div>
      </div>
  </div>
  <div class="personal-account-background">
    <div class="global-account-container">
      <div class="top-block">
        <div class="user-name">
          <span data-language="en">Hello,</span>
          <span data-language="ru">Привет,</span>
          <span id="user-name-personal-account"><?php echo $_SESSION['login']?></span>
        </div>
          <img src="<?php echo $_SESSION['avatar']?>" alt="">
      </div>
      <div class="middle-block">
        <div class="lightgallery">
          <!--            Загрузка картиночек циклом-->
          <?php foreach ($_SESSION['images'] as $imgPath):?>
            <span href="<?php echo $imgPath?>">
              <div class="delete-gallary-image"></div>
              <div class="image-gallery-overlay">
                    <i class="fa fa-search" aria-hidden="true"></i>
              </div>
              <img src="<?php echo $imgPath?>">
            </span>
            <?php endforeach ?>
        </span>
            </div>
      </div>
    </div>
  </div>

  <div class="footer"><span>&copy;
 Н.Д. Певнев, 2017</span><a href="https://github.com/thystruby"><i class="fa fa-github" aria-hidden="true"></i>thystruby</a></div>
<script src="app/js/vendor/jquery.min.js"></script>
<script src="/app/js/vendor/lightgallery/lightgallery.min.js"></script>
<script src="/app/js/vendor/lightgallery/lg-zoom.min.js"></script>
<script src="/app/js/vendor/lightgallery/lg-fullscreen.min.js"></script>
<script src="/app/js/vendor/lightgallery/lg-thumbnail.min.js"></script>
<script src="app/js/personalAccount.js"></script>
<script type="text/javascript">
  $('.lightgallery').lightGallery({
    thumbnail:true,
    animateThumb: false,
    showThumbByDefault: false,
    loop: true,
    mousewheel: true
});
</script>
</body>
</html>
