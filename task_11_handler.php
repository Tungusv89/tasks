<?php
session_start();
$email = $_POST['email'];
echo password_hash($_POST['password'], PASSWORD_DEFAULT);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $pdo = new PDO("mysql:host=tasks.test;dbname=auth", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = "INSERT INTO auth.users (email, password) VALUES (:email,:password)";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email, 'password' => $password]);


if(!empty($email)) {
    $message = "Этот эл адрес уже занят другим пользователем";
    $_SESSION['danger'] = $message;
    header("Location: /task-11.php");
    exit;
}

header("Location: /task-11.php");