<?php

session_start();

if(!isset($_SESSION["user"])){

    header("Location: login.php");
    exit();

}

try {

    $pdo = new PDO("mysql:host=localhost;dbname=php_day3;charset=utf8", "admin", "MySQL.xxx1");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id,fname,lname,department,image FROM emp ORDER BY id");

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            table {
                border-collapse: collapse;
                width: 95%;
                margin: 20px auto;
            }

            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #eee;
            }

            a {
                text-decoration: none;
                color: blue;
                font-weight: bold;
            }
            button {
                padding: 20px 30px;
                font-size: 20px;
                background-color: #2196F3;
                border: none;
                color: #fff;
                border-radius: 4px;
                cursor: pointer;
                margin-bottom: 20px;
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

<h2 align="center">Registered Users</h2>

<table border="1" cellpadding="10" align="center">

<tr>
    <th>ID</th>
    <th>Image</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Department</th>
    <th>View</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>

<?php

while($user = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo "<tr>";

    echo "<td>".$user["id"]."</td>";
    echo "<td><img src='".$user["image"]."' width='60' height='60' style='border-radius:50%; object-fit:cover;'></td>";
    echo "<td>".$user["fname"]."</td>";
    echo "<td>".$user["lname"]."</td>";
    echo "<td>".$user["department"]."</td>";

    echo "<td><a href='view.php?id=".$user["id"]."'>View</a></td>";
    echo "<td><a href='edit.php?id=".$user["id"]."'>Edit</a></td>";
    echo "<td><a href='delete.php?id=".$user["id"]."' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";

    echo "</tr>";
}

?>

</table>

</body>
</html>