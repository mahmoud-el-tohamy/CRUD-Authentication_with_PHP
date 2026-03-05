<?php
$fname      = $_POST["fname"];
$lname      = $_POST["lname"];
$address    = $_POST["address"];
$country    = $_POST["country"];
$gender     = $_POST["gender"];
$department = $_POST["department"];
$username   = $_POST["username"];
$password   = password_hash($_POST["password"], PASSWORD_DEFAULT);
$skills = isset($_POST["skills"])
            ? implode(",", $_POST["skills"])
            : "";
$code       = $_POST["code"];
$realcode   = $_POST["realcode"];

$image = $_FILES["image"];
$allowed = ["image/jpeg","image/png"];
if(!in_array($image["type"], $allowed)){
    die("Only JPG and PNG allowed");
}
if($image["size"] > 2000000){
    die("Image too large");
}
$folder = "uploads/";
$filename = time() . "_" . $image["name"];
move_uploaded_file($image["tmp_name"], $folder . $filename);


if ($fname && $lname && $address && $gender && $department && $skills && $code && $realcode && $username && $password && $image) {
    if($code != $realcode){
        header("Location: registration.php?invalid=1");
        exit();
    }
    try {
        require_once 'Database.php';
        $db = Database::getInstance();
        $sql = "INSERT INTO emp
        (fname, lname, address, country, gender, skills, username, password, department, image)
        VALUES
        (:fname, :lname, :address, :country, :gender, :skills, :username, :password, :department, :image)";
        $db->create($sql, [
            ":fname"      => $fname,
            ":lname"      => $lname,
            ":address"    => $address,
            ":country"    => $country,
            ":gender"     => $gender,
            ":skills"     => $skills,
            ":username"   => $username,
            ":password"   => $password,
            ":department" => $department,
            ":image" => $folder.$filename,
        ]);
        header("Location: usersTable.php");
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
} else {
    header("Location: registration.php?error=1");
}
?>