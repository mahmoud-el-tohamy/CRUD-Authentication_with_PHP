<?php
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=php_day3;charset=utf8", "tohamy", "Arcane.xxx1");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $id = $_POST["id"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $address = $_POST["address"];
        $gender = $_POST["gender"];
        $department = $_POST["department"];
        $skills = implode(",", $_POST["skills"]);

        

        $stmt = $pdo->prepare("UPDATE emp SET fname = ?, lname = ?, address = ?, gender = ?, department = ?, skills = ? WHERE id = ?");
        $stmt->execute([$fname, $lname, $address, $gender, $department, $skills, $id]);

        header("Location: usersTable.php");
        exit();

    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>