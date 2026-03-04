<?php

session_start();

if(!isset($_SESSION["user"])){

    header("Location: login.php");
    exit();

}

try {

    $pdo = new PDO("mysql:host=localhost;dbname=php_day3;charset=utf8", "tohamy", "Arcane.xxx1");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM emp WHERE id = ?");
    $stmt->execute([$id]);

    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $skills = implode(", ", explode("|", $user[0]["skills"]));

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
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }

        .user-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .user-field {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .user-field label {
            font-weight: bold;
            color: #333;
        }

        .value {
            color: #666;
            margin-left: 10px;
        }
    </style>
</head>

    <body>
        <div style="text-align:right;">
            Logged in as: <?php echo $_SESSION["user"]; ?>
        </div>

        <div class="user-card">

            <?php
            echo '<h2 style="text-align:center; margin-bottom: 30px;">User Details</h2>';
            echo '<div class="user-field"><label>ID:</label><span class="value">'.$id.'</span></div>';
            echo '<div class="user-field"><label>First Name:</label><span class="value">'.$user[0]["fname"].'</span></div>';
            echo '<div class="user-field"><label>Last Name:</label><span class="value">'.$user[0]["lname"].'</span></div>';
            echo '<div class="user-field"><label>Username:</label><span class="value">'.$user[0]["username"].'</span></div>';
            echo '<div class="user-field"><label>Country:</label><span class="value">'.$user[0]["country"].'</span></div>';
            echo '<div class="user-field"><label>Address:</label><span class="value">'.$user[0]["address"].'</span></div>';
            echo '<div class="user-field"><label>Gender:</label><span class="value">'.$user[0]["gender"].'</span></div>';
            echo '<div class="user-field"><label>Department:</label><span class="value">'.$user[0]["department"].'</span></div>';
            echo '<div class="user-field"><label>Skills:</label><span class="value">'.$skills.'</span></div>';
            echo '<div class="user-field"><label>Created:</label><span class="value">'.$user[0]["created_at"].'</span></div>';
            ?>

        </div>

    </body>
</html>