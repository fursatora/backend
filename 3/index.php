<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('Спасибо, результаты сохранены.');
  }
  include('form.php');
  exit();
}

$errors = FALSE;

//fio
if (empty($_POST['fio'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}
else if (!preg_match("/^[а-яА-Яa-zA-Z ]+$/u", $_POST['fio'])) {
    print('Недопустимые символы в имени.<br>');
    $errors = TRUE;
}
  
//email
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    print('Проверьте правильность ввода email<br>');
    $errors = TRUE;
}

//year
if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
  print('Заполните год.<br/>');
  $errors = TRUE;
}

//fio
if (empty($_POST['bio'])) {
  print('Заполните поле.<br/>');
  $errors = TRUE;
}

//accept
if (empty($_POST['accept'])) {
    print("Вы не приняли соглашение<br>");
    $errors = TRUE;
}


if ($errors) {
  exit();
}

  
$user = 'u52827'; 
$pass = '4296369'; 
$db = new PDO('mysql:host=localhost;dbname=u52827', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 

// Подготовленный запрос. Не именованные метки.
try {
  $stmt = $db->prepare("INSERT INTO application SET name = ?, year=?, sex=?,email=?,bio=?,limb=?");
  $stmt->execute([$_POST['fio'], $_POST['year'], $_POST['sex'],$_POST['email'], $_POST['bio'],$_POST['limb']]);
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
header('Location: ?save=1');

