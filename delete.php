<?php

session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

try {

    $pdo = new PDO("mysql:host=localhost;dbname=php_day3;charset=utf8", "admin", "MySQL.xxx1");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET["id"];

    $stmt = $pdo->prepare("SELECT image FROM emp WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && file_exists($user["image"])){
        unlink($user["image"]);
    }

    $stmt = $pdo->prepare("DELETE FROM emp WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: usersTable.php");
    exit();

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>