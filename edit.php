<?php

    session_start();

    if(!isset($_SESSION["user"])){

        header("Location: login.php");
        exit();

    }
    
    if(!isset($_GET["id"])){
        die("Invalid Request");
    }
    try {

        $pdo = new PDO("mysql:host=localhost;dbname=php_day3;charset=utf8", "tohamy", "Arcane.xxx1");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_GET["id"];
        $stmt = $pdo->prepare("SELECT * FROM emp WHERE id = ?");
        $stmt->execute([$id]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $skills = explode("|", $user[0]["skills"]);

    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        form {
            background: #fff;
            padding: 35px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], textarea, select{
            width: 100%;
            padding: 8px;
            margin: 4px 0 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #2196F3;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<h2 style="width:fit-content; margin:30px auto">Edit User</h2>

<form action="update.php" method="POST">

<input type="hidden" name="id" value="<?php echo $id; ?>">

First Name:
<input type="text" name="fname" value="<?php echo $user[0]["fname"]; ?>" required>

Last Name:
<input type="text" name="lname" value="<?php echo $user[0]["lname"]; ?>" required>

Address:
<textarea name="address" required><?php echo $user[0]["address"]; ?></textarea>

Gender:
<br>
<input type="radio" name="gender" value="male"
<?php if($user[0]["gender"]=="male") echo "checked"; ?>> Male

<input type="radio" name="gender" value="female"
<?php if($user[0]["gender"]=="female") echo "checked"; ?>> Female
<br><br>

Department:
<input type="text" name="department"
value="<?php echo $user[0]["department"]; ?>" readonly>

Skills:<br>
<?php 
$skillOptions = ["PHP", "MySQL", "J2SE", "PostgreSQL"];
foreach($skillOptions as $skill) {
    $checked = in_array($skill, $skills) ? "checked" : "";
    echo "<input type='checkbox' name='skills[]' value='$skill' $checked> $skill<br>";
}
?>

<br><br>

<input type="submit" value="Update">

</form>

</body>
</html>