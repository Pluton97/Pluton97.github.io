$done = $_POST['done'];
$alert = '';
$error = '';
if(isset($done)) {

$_SESSION['name'] = $_POST['name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['tema'] = $_POST['tema'];
$_SESSION['msg'] = $_POST['msg'];

if(isset($_POST['name']) && !empty($_POST['name']) && 
isset($_POST['email']) && !empty($_POST['email']) && 
filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && 
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
$file = fopen('messages!!!.txt', 'a+t');
fwrite($file, "Сообщение от пользователя \"$name\"\nТелефонный номер: $tema\nE-mail: $mail\n $msg\nИнфа об отправителе: $info\n--------------------------------\n");
fclose($file);
$_SESSION['name'] = '';
$_SESSION['email'] = '';
$_SESSION['tema'] = '';
$_SESSION['msg'] = '';
$token = '356661647:AAGSPYV2bD2EdKQimLgCzwWuuHVPEMxGlgk'; 
$chatId = 356661647;
$text = "Сообщение от пользователя \"$name\"\nТема сообщения: $tema\nE-mail: $mail\n $msg\nИнфа об отправителе: $info\n--------------------------------\n";
$parameters = ['chat_id' => $chatId, 'text' => $text];
$url = 'https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($parameters);
file_get_contents($url);
}

if($error)
$error = 'Ошибка. Корректно введите данные.';
}
