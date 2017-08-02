// $('#signUpForm').submit(function(event){

//     var userName = $('input#user').val();
//     var userPassword = $('input#pass').val();
//     var userPassword2 = $('input#pass2').val();
//     var userEmail = $('input#email').val();
    
//     if (userName.length>20){
//         $('span#name').text("Слишком длинное имя! (До 20 символов)");
//           event.preventDefault(); // всплытие переменных
//     }else if (userName.length<3) {
//         $('span#name').text("Слишком короткое имя! (От 3 символов)");
//           event.preventDefault(); // всплытие переменных
//     }else {
//         event.preventDefault();
//          $('span#name').text('');
//     }

//     if  (userPassword.length<5){
//         $('span#password').text('Слишком простой пароль');
//           event.preventDefault(); // всплытие переменных
//     }else {
//         event.preventDefault();
//         $('span#password').text('');
//     }

//     if (userPassword!==userPassword2){
//         $('span#password2').text('Пароли не совпадают!');
//           event.preventDefault(); // всплытие переменных
//     }else {
//         event.preventDefault();
//         $('span#password2').text('');
//     }
// });

$('#signUpForm').submit(function(event){ 

var userName = $('input#user').val(); 
var userPassword = $('input#pass').val(); 
var userPassword2 = $('input#pass2').val(); 
var userEmail = $('input#email').val(); 

//Чтобы не регало, если есть другие ошибки
var error = false; 

if (userName.length>17){ 
$('span#name').text("Слишком длинное имя! (До 17 символов)"); 
error = true; 
event.preventDefault(); // всплытие переменных 
}else if (userName.length<3) { 
$('span#name').text("Слишком короткое имя! (От 3 символов)"); 
error = true; 
event.preventDefault(); // всплытие переменных 
}else { 
event.preventDefault(); 
$('span#name').text(''); 
} 

if (userPassword.length<5){ 
$('span#password').text('Слишком простой пароль'); 
error = true; 
event.preventDefault(); // всплытие переменных 
}else { 
event.preventDefault(); 
$('span#password').text(''); 
} 

if (userPassword!==userPassword2){ 
$('span#password2').text('Пароли не совпадают!'); 
error = true; 
event.preventDefault(); // всплытие переменных 
}else { 
event.preventDefault(); 
$('span#password2').text(''); 
} 

if (!(error)) { 
event.preventDefault(); 
$.post("/php/signup.php", {login: userName, password : userPassword, email: userEmail}, function (response) { 
if(response == '0') { 
$('.error-message-signup').css('display', 'block'); 
} else { 
window.location.href = "/index.php" 
} 
}); 
} 
}); 
//Авторизация 
$('#signInForm').submit(function (event) { 
event.preventDefault(); 
var login = $('#userLogin').val(); 
var password = $('#passLogin').val(); 
$.post("/php/signin.php", {login: login, password : password}, function (response) { 
if(response == '0') { 
$('.error-message').css('display', 'block'); 
} else { 
window.location.href = "/index.php" 
} 
}); 
});