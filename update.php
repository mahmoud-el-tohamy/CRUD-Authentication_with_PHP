<?php

try {

    require_once 'Database.php';
    $db = Database::getInstance();

    $id = $_POST["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $department = $_POST["department"];
    $skills = implode(",", $_POST["skills"]);

    $users = $db->read("SELECT image FROM emp WHERE id=?", [$id]);
    $oldUser = $users ? $users[0] : null;
    $oldImage = $oldUser ? $oldUser["image"] : null;

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
        $db->update("UPDATE emp SET fname=?, lname=?, address=?, gender=?, department=?, skills=?, image=? WHERE id=?", 
            [$fname,$lname,$address,$gender,$department,$skills,$imagePath,$id]);
    } else {
        $db->update("UPDATE emp SET fname=?, lname=?, address=?, gender=?, department=?, skills=? WHERE id=?", 
            [$fname,$lname,$address,$gender,$department,$skills,$id]);
    }

    header("Location: usersTable.php");
    exit();

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>