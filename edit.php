<?php

    session_start();

    if(!isset($_SESSION["user"])){

        header("Location: login.php");
        exit();

    }

    if(!isset($_GET["id"])){
        die("Invalid Request");
    }
    require_once 'Database.php';
    $db = Database::getInstance();

    $id = $_GET["id"];
    $user = $db->read("SELECT * FROM emp WHERE id = ?", [$id]);
    $skills = explode("|", $user[0]["skills"]);

?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                padding: 0px;
                margin: 0px;
                overflow-x: hidden;
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
        
        <h2 style="width:fit-content; margin:30px auto">Edit User</h2>
        
        
        <form action="update.php" method="POST" enctype="multipart/form-data">
            <div style="text-align:center;margin-bottom:20px;">
                <img src="<?php echo $user[0]["image"]; ?>" width="120" height="120" style="border-radius:50%; object-fit:cover;">
            </div>
            Change Profile Picture:
            <input type="file" name="image" accept=".jpg,.png">
            <input type="hidden" name="id" value="<?php echo $id; ?>"><br><br>

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