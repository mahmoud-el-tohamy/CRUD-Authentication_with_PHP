<?php

try {

    $pdo = new PDO("mysql:host=localhost;dbname=php_day3;charset=utf8", "admin", "MySQL.xxx1");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $department = $_POST["department"];
    $skills = implode(",", $_POST["skills"]);

    $stmt = $pdo->prepare("SELECT image FROM emp WHERE id=?");
    $stmt->execute([$id]);
    $oldUser = $stmt->fetch(PDO::FETCH_ASSOC);
    $oldImage = $oldUser["image"];

    $imagePath = null;
    if(isset($_FILES["image"]) && $_FILES["image"]["name"] != ""){
        $image = $_FILES["image"];
        $allowed = ["image/jpeg","image/png"];
        if(!in_array($image["type"], $allowed)){
            die("Only JPG and PNG allowed");
        }
        if($image["size"] > 2000000){
            die("Image too large");
        }
        $uploadFolder = "uploads/";
        $imageName = time() . "_" . $image["name"];
        move_uploaded_file($image["tmp_name"], $uploadFolder.$imageName);
        $imagePath = $uploadFolder.$imageName;
        if(file_exists($oldImage)){
            unlink($oldImage);
        }
    }

    if($imagePath){
        $stmt = $pdo->prepare("UPDATE emp SET fname=?, lname=?, address=?, gender=?, department=?, skills=?, image=? WHERE id=?");
        $stmt->execute([$fname,$lname,$address,$gender,$department,$skills,$imagePath,$id]);
    } else {
        $stmt = $pdo->prepare("UPDATE emp SET fname=?, lname=?, address=?, gender=?, department=?, skills=? WHERE id=?");
        $stmt->execute([$fname,$lname,$address,$gender,$department,$skills,$id]);
    }

    header("Location: usersTable.php");
    exit();

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>