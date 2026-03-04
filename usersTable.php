<?php

session_start();

if(!isset($_SESSION["user"])){

    header("Location: login.php");
    exit();

}

try {

    $pdo = new PDO("mysql:host=localhost;dbname=php_day3;charset=utf8", "tohamy", "Arcane.xxx1");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id,fname,lname,department FROM emp ORDER BY id");

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
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
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
    </style>
</head>

<body>

<div style="text-align:right;">
Logged in as: <?php echo $_SESSION["user"]; ?>
</div>

<h2 align="center">Registered Users</h2>

<button onclick="location.href='logout.php'">Logout</button>

<table border="1" cellpadding="10" align="center">

<tr>
    <th>ID</th>
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
    echo "<td>".$user["fname"]."</td>";
    echo "<td>".$user["lname"]."</td>";
    echo "<td>".$user["department"]."</td>";

    echo "<td><a href='view.php?id=".$user["id"]."'>View</a></td>";
    echo "<td><a href='edit.php?id=".$user["id"]."'>Edit</a></td>";
    echo "<td><a href='delete.php?id=".$user["id"]."'>Delete</a></td>";

    echo "</tr>";
}

?>

</table>

</body>
</html>