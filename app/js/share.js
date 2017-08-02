var myShare = document.getElementById('share-test');


var share = Ya.share2(myShare, {
    content: {
        url: 'https://webcamjs.ru',
        title : 'WebCam JS - Онлайн инструмент для обработки ваших фотографий',
        image : 'https://4.downloader.disk.yandex.ru/disk/1ebe2cd707c395d8cbff159448eea80e03d8085ff77e22781b3a13579caf2377/592f4c52/wRpycXLernOU5BZXXcx79qirK5qNZItSSQOc2-oNwlb7BVk5fmAgd9fTHseKslkN2NM8_u5NFcvWovBcuaTczA%3D%3D?uid=0&filename=2017-05-31_22-04-49.png&disposition=inline&hash=&limit=0&content_type=image%2Fpng&fsize=301005&hid=86873f861b2afc1eb0798aba38b1d8e5&media_type=image&tknv=v2&etag=dca55c1333eaf5c9105a9144b0ee17b4'
    }
   // здесь вы можете указать и другие параметры
});

$('.share-vk-btn').on('click',function () {
  $('.ya-share2__item_service_vkontakte').click()
  $('.share-block').removeClass('active');
})

$('.share-facebook-btn').on('click',function () {
  $('.ya-share2__item_service_facebook').click()
  $('.share-block').removeClass('active');
})

$('.share-twitter-btn').on('click',function () {
  $('.ya-share2__item_service_twitter').click()
  $('.share-block').removeClass('active');
})
