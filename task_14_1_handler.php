<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
//$_SESSION['text'] = '';

$pdo = new PDO("mysql:host=tasks.test;dbname=auth_2", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = "SELECT * FROM users WHERE email=:email";

$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($user);

if(empty($user)) {
    $_SESSION['text'] = "Неверный логин или пароль";
    header("Location: /task_14.php");
    exit;
}
if(!password_verify($password, $user['password'])) {
    $_SESSION['text'] = "Неверный логин или пароль";
   header("Location: /task_14.php");
    exit;
}

$_SESSION['user'] = ['email' => $user['email'], 'id' => $user['id']];

unset($_SESSION['user']);
header("Location: /task_14.php");
exit;