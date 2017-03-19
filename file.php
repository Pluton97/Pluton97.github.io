<?php 
$done = $_POST['done']; 
$alert = ''; 
$error = ''; 
if(isset($done)) { 
$_SESSION['name'] = $_POST['name']; 
$_SESSION['email'] = $_POST['email']; 
$_SESSION['tema'] = $_POST['tema']; 
$_SESSION['msg'] = $_POST['msg']; 
if(isset($_POST['name']) && !empty($_POST['name']) && 
filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && 
isset($_POST['email']) && !empty($_POST['email']) && 
isset($_POST['tema']) && !empty($_POST['tema']) && 
isset($_POST['msg']) && !empty($_POST['msg'])) { 
$tema = trim(htmlspecialchars($_POST['tema'])); 
$name = trim(htmlspecialchars($_POST['name'])); 
$mail = trim(htmlspecialchars($_POST['email'])); 
$msg = trim(htmlspecialchars($_POST['msg'])); 
$info = $_SERVER['HTTP_USER_AGENT']; 
} 
else 
$error = 1; 
if (!$error) { 
$alert = 'Сообщение успешно отправлено. Благодарим.'; 
$file = fopen('ArchiveMsg.txt', 'a+t'); 
fwrite($file, "Сообщение от пользователя \"$name\"\nТема сообщения: \"$tema\"\nE-mail: $mail\n \"$msg\"\nИнфа об отправителе: $info\n--------------------------------\n"); 
fclose($file); 
$_SESSION['name'] = ''; 
$_SESSION['email'] = ''; 
$_SESSION['tema'] = ''; 
$_SESSION['msg'] = ''; 
$token = 'не напишу'; 
$chatId = секретики; 
$text = "Сообщение от пользователя \"$name\"\nТема сообщения: \"$tema\"\nE-mail: $mail\n \"$msg\"\nИнфа об отправителе: $info\n------------------------------------\n"; 
$parameters = ['chat_id' => $chatId, 'text' => $text]; 
$url = 'https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($parameters); 
file_get_contents($url); 
} 
if($error) 
$error = 'Ошибка. Корректно введите данные.'; 
} 
?> 


<!DOCTYPE html> 
<html> 
<head> 
<meta charset = 'utf-8' /> 
<title>FeedBack от Витьки</title> 
<style> 
.cbalink {display: none;} 
</style> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.." integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.." integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> 
<link rel="icon" type="image/png" href="http://holyshit.kl.com.ua/favicon.ico" /> 
<style> 
.photo:hover { 
border: 1px solid red; 
} 
</style> 
</head> 
<body> 
<nav class = 'navbar navbar-default'> 
<div class = 'container-fluid'> 
<div class = 'navbar-header'> 
<a href = 'index.php' title = 'Вернуться на главную' class = 'navbar-brand'>Holyshit</a> 
</div> 
<div> 
<ul class = 'nav navbar-nav'> 
<li class = 'active'><a href = 'feedback.php' title = 'Обратная связь'>Обратная связь</a></li> 
<li><a href = 'calculator.php' title = 'PHP-калькулятор'>PHP-калькулятор</a></li> 
<li><a href = 'childs.php' title = 'Всякое о социальной инженерии'>Всякое о социальной инженерии</a></li> 
</ul> 
</div> 
</div> 
</nav> 
<div class = 'container'> 
<div class = 'col-xs-12 col-sm-12 col-md-8 col-lg-8'> 
<h2 style = 'text-align: center'>Обратная связь. Свяжитесь с нами!</h2> 
<form name = 'feedback' action = '' method = 'POST' role = 'form'> 
<div class = 'form-group'> 
<label for 'name'>Ваше имя</label> 
<input id = 'name' type = 'text' class = 'form-control' placeholder = 'Введите своё имя' name = 'name' maxlength = 100 value = "<?=$_SESSION['name']?>" /> 
<p class = 'help-block'>Внимание! Просим вводить сюда достоверные данные.</p> 
</div> 
<div class = 'form-group'> 
<label for 'email'>Ваш email</label> 
<input id = 'email' type = 'text' class = 'form-control' placeholder = 'Введите свой email' name = 'email' maxlength = 100 value = "<?=$_SESSION['email']?>" /> 
<p class = 'help-block'>Email нужен для того, чтобы впоследствии отправить вам свой ответ.</p> 
</div> 
<div class = 'form-group'> 
<label for 'tema'>Тема сообщения</label> 
<input id = 'tema' type = 'text' class = 'form-control' placeholder = 'Введите
тему вашего сообщения' name = 'tema' maxlength = 100 value = "<?=$_SESSION['tema']?>" /> 
<p class = 'help-block'>Здесь нужно как можно короче изложить смысл вашего сообщения.</p> 
</div> 
<div class = 'form-group'> 
<label for 'msg'>Ваше сообщение ... <span class = 'glyphicon glyphicon-pencil'></span> </label> 
<textarea id = 'msg' type = 'text' class = 'form-control' placeholder = 'Введите ваше сообщение' name = 'msg'><?=$_SESSION['msg']?></textarea> 
<p class = 'help-block'>Ваше сообщение должно нести хоть какой-то посыл.</p> 
</div> 
<input type = 'submit' class = 'btn btn-success' value = 'Отправить письмо' name = 'done' /><br /> 
<span class = 'text-success'><?=$alert?></span> 
<span class = 'text-danger'><?=$error?></span> 
</form> 
<br /> 
<a href = 'index.php' title = 'Вернуться на главную'>Вернуться на главную</a> 
</div> 
<div class = 'col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center'> 
<h2>Или же напишите ему в ВКонтакте</h2> 
<br /> 
<a href = 'https://vk.com/im?media=&sel=171010218'> 
<img class = 'img-responsive img-circle img-thumbnail photo' src="lnMjaEshb0Y.jpg" alt="Викторец"> 
</a> 
</div> 
<div class = 'text-center col-xs-12 col-sm-12 col-md-12 col-lg-12'> 
<h2>PHP-код</h2> 
<code> 
$done = $_POST['done'];<br /> 
$alert = '';<br /> 
$error = '';<br /> 
if(isset($done)) {<br /><br /> 
$_SESSION['name'] = $_POST['name'];<br /> 
$_SESSION['email'] = $_POST['email'];<br /> 
$_SESSION['tema'] = $_POST['tema'];<br /> 
$_SESSION['msg'] = $_POST['msg'];<br /><br /> 
if(isset($_POST['name']) && !empty($_POST['name']) && <br /> 
isset($_POST['email']) && !empty($_POST['email']) && <br /> 
filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && <br /> 
isset($_POST['tema']) && !empty($_POST['tema']) && <br /> 
isset($_POST['msg']) && !empty($_POST['msg'])) {<br /> 
$tema = trim(htmlspecialchars($_POST['tema']));<br /> 
$name = trim(htmlspecialchars($_POST['name']));<br /> 
$mail = trim(htmlspecialchars($_POST['email']));<br /> 
$msg = trim(htmlspecialchars($_POST['msg']));<br /> 
$info = $_SERVER['HTTP_USER_AGENT'];<br /> 
}<br /> 
else<br /> 
$error = 1;<br /><br /> 
if (!$error) {<br /> 
$alert = 'Сообщение успешно отправлено. Благодарим.';<br /> 
$file = fopen('ArchiveMsg.txt', 'a+t');<br /> 
fwrite($file, "Сообщение от пользователя \"$name\"\nТема сообщения: $tema\nE-mail: $mail\n $msg\nИнфа об отправителе: $info\n--------------------------------\n");<br /> 
fclose($file);<br /> 
$_SESSION['name'] = '';<br /> 
$_SESSION['email'] = '';<br /> 
$_SESSION['tema'] = '';<br /> 
$_SESSION['msg'] = '';<br /> 
$token = 'Здесь токен вашего бота';<br /> 
$chatId = ID вашего чата;<br /> 
$text = "Сообщение от пользователя \"$name\"\nТема сообщения: $tema\nE-mail: $mail\n $msg\nИнфа об отправителе: $info\n--------------------------------\n";<br /> 
$parameters = ['chat_id' => $chatId, 'text' => $text];<br /> 
$url = 'https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($parameters);<br /> 
file_get_contents($url);<br /> 
}<br /><br /> 
if($error)<br /> 
$error = 'Ошибка. Корректно введите данные.';<br /> 
} 
</code> 
</div> 
</div> 
</div> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.."></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap..." integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
</body> 
</html>
