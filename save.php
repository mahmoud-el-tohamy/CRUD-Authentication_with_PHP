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
$created_at = date("Y-m-d H:i:s");

if ($fname && $lname && $address && $gender && $department && $skills && $code && $realcode) {
    if($code != $realcode){
        die("Wrong Verification Code");
    }
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=php_day3", "tohamy", "Arcane.xxx1");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO emp
        (fname, lname, address, country, gender, skills, username, password, department)
        VALUES
        (:fname, :lname, :address, :country, :gender, :skills, :username, :password, :department)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":fname"      => $fname,
            ":lname"      => $lname,
            ":address"    => $address,
            ":country"    => $country,
            ":gender"     => $gender,
            ":skills"     => $skills,
            ":username"   => $username,
            ":password"   => $password,
            ":department" => $department
        ]);
        header("Location: usersTable.php");
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
} else {
    echo "Fill All The Fields";
    exit();
}
?>