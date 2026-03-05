<?php
    session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];
    try {
        require_once 'Database.php';
        $db = Database::getInstance();
        $users = $db->read("SELECT * FROM emp WHERE username = :username", [
            ":username" => $username
        ]);
        $user = $users ? $users[0] : null;
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