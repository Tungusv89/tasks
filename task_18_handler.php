<?php

$nameImage = uniqid();
move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $nameImage . '.jpg');

$pdo = new PDO("mysql:host=tasks.test;dbname=images", "root", "root");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO images (image) VALUES (:nameImage)";

$statement = $pdo->prepare($sql);
$statement->bindParam('nameImage', $nameImage, PDO::PARAM_STR);
$statement->execute(['nameImage' => $nameImage]);
$images = $statement->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT * FROM images";

$statement = $pdo->prepare($sql);
$statement->execute();
$images = $statement->fetch(PDO::FETCH_ASSOC);

$_SESSION['images'] = ['nameImage' => $images['image']];

header('location: /task_18.php' );

