<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
$text = $_POST['text'];
try {
    $pdo = new PDO("mysql:host=tasks.test;dbname=text_list;", "root", "");
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (PDOException $e) {
    die($e->getMessage());                        }
$sql = "INSERT INTO text_list.text (text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);

header("Location: /index.php");