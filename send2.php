<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
$text = $_POST['text'];
try {
    $pdo = new PDO("mysql:host=tasks.test;dbname=text_list;", "root", "");
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $sql = "SELECT * FROM text_list.text WHERE text=:text";
    $statement = $pdo->prepare($sql);
    $statement->execute(['text' => $text]);
    $task = $statement->fetch(PDO::FETCH_ASSOC);

    if(!empty($task)) {
        $message = "You should check in on some of those fields below.";
        $_SESSION['danger'] = $message;

        header("Location: /task-10.php");
        exit;
    }


} catch (PDOException $e) {
    die($e->getMessage());                        }
$sql = "INSERT INTO text_list.text (text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);

$message = "Submut";
$_SESSION['success'] = $message;

header("Location: /task-10.php");

