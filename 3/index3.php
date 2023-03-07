<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('Спасибо, результаты сохранены.');
  }
  include('form.php');
  exit();
}

$errors = FALSE;

if (empty($_POST['fio'])) {
    print('Заполните имя.<br>');
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
if (empty($_POST['year'])) {
    print('Заполните год.<br>');
    $errors = TRUE;
}
else {
    $year = $_POST['year'];
    if (!(is_numeric($year) && intval($year) >= 1900 && intval($year) < 2020)) {
        print("Укажите корректный год.<br>");
        $errors = TRUE;
    }
}

$ability_data = ['immort', 'wall', 'levit', 'invis'];
if (empty($_POST['abilities'])) {
    print('Выберите способность<br>');
    $errors = TRUE;
}
else {
    $abilities = $_POST['abilities'];
    foreach ($abilities as $ability) {
        if (!in_array($ability, $ability_data)) {
            print('Недопустимая способность<br>');
            $errors = TRUE;
        }
    }
}
$ability_insert = [];
foreach ($ability_data as $ability) {
    $ability_insert[$ability] = in_array($ability, $abilities) ? 1 : 0;
}

if (empty($_POST['accept'])) {
    print("Вы не приняли соглашение!<br>");
    $errors = TRUE;
}

if ($errors) {
  exit();
}

$user = 'u52827';
$pass = '4296369';
$db = new PDO('mysql:host=localhost;dbname=study', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
  $stmt = $db->prepare("INSERT INTO users (name,year,sex,email,bio,limb,immort,wall,levit,invis,accept) VALUES (:name,:year,:sex,:email,:bio,:limb,:immort,:wall,:levit,:invis,:accept)");
  $stmt->bindParam(':name', $_POST['fio']);
  $stmt->bindParam(':year', intval($year));
  $stmt->bindParam(':sex', intval($_POST['sex']));
  $stmt->bindParam(':email', $_POST['email']);
  $stmt->bindParam(':bio', $_POST['text']);
  $stmt->bindParam(':limb', intval($_POST['limb']));
  $stmt->bindParam(':immort', $ability_insert['immort']);
  $stmt->bindParam(':wall', $ability_insert['wall']);
  $stmt->bindParam(':levit', $ability_insert['levit']);
  $stmt->bindParam(':invis', $ability_insert['invis']);
  $stmt->bindParam(':accept', intval($_POST['accept']));
  $stmt->execute();
}
catch(PDOException $e) {
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');
