<?php
    session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=php_day3", "tohamy", "Arcane.xxx1");
        $stmt = $pdo->prepare("SELECT * FROM emp WHERE username = :username");
        $stmt->execute([
            ":username" => $username
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($password, $user["password"])){
            $_SESSION["user"] = $user["username"];
            header("Location: usersTable.php");
            exit();
        } else {
            header("Location: login.php?invalid=1");
        }
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>