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
    $user = $db->read("SELECT * FROM emp WHERE id = ?", [$id]);

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
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        }

        .user-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
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
        .top-bar {
            width: 100%;
            background-color: #f2f2f2;
            border-bottom: 1px solid #ccc;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
        }

        .welcome {
            font-weight: bold;
            margin-left: 30px;
        }

        .logout-btn {
            padding: 6px 14px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 30px;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

    <body>
        <div class="top-bar">
            <div class="welcome">
                Welcome <?php echo $_SESSION["user"]; ?>
            </div>
            <div>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>


        <div class="user-card">
            <?php
            echo '<h2 style="text-align:center; margin-bottom: 30px;">User Details</h2>';
            echo '<div class="user-field"><label>ID:</label><span class="value">'.$id.'</span></div>';
            echo '<div style="text-align:center;margin-bottom:20px;"> <img src="'.$user[0]["image"].'" width="120" height="120" style="border-radius:50%; object-fit:cover;"> </div>';
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