<?php

session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

try {

    require_once 'Database.php';
    $db = Database::getInstance();

    $id = $_GET["id"];

    $users = $db->read("SELECT image FROM emp WHERE id = ?", [$id]);
    $user = $users ? $users[0] : null;

    if($user && file_exists($user["image"])){
        unlink($user["image"]);
    }

    $db->delete("DELETE FROM emp WHERE id = ?", [$id]);

    header("Location: usersTable.php");
    exit();

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>