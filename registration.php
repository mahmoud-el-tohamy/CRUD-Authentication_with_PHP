<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 35px;
            border-radius: 8px;
            max-width: 500px; 
            margin: auto; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="password"], textarea, select{
            width: 100%;
            padding: 8px;
            margin: 4px 0 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            margin-right: 10px; 
            background-color: #4CAF50;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="reset"] {
            background-color: #f44336;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2 style="width:fit-content; margin: 30px auto">Registration Form</h2>

<form action="save.php" method="POST">

First Name:
<input type="text" name="fname" required><br><br>

Last Name:
<input type="text" name="lname" required><br><br>

Address:<br>
<textarea name="address" required></textarea><br><br>

Country:
<select name="country" required>
    <option>Egypt</option>
    <option>USA</option>
    <option>Germany</option>
</select>
<br><br>

Gender:
<input type="radio" name="gender" value="male" required> Male
<input type="radio" name="gender" value="female"> Female
<br><br>

Skills:<br>
<input type="checkbox" name="skills[]" value="PHP"> PHP
<input type="checkbox" name="skills[]" value="MySQL"> MySQL
<input type="checkbox" name="skills[]" value="J2SE"> J2SE
<input type="checkbox" name="skills[]" value="PostgreSQL"> PostgreSQL
<br><br>

Username:
<input type="text" name="username" pattern="[A-Za-z0-9]+" required><br><br>

Password:
<input type="password" name="password" minlength="6" required><br><br>

Department:
<input type="text" name="department" value="OpenSource" readonly>
<br><br>

<?php
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $code = substr(str_shuffle($chars),0,5);
    echo $code;
?>

<br>
Please insert the code:
<input type="text" name="code" required>
<br><br>

<input type="hidden" name="realcode" value="<?php echo $code; ?>">

<input type="submit" value="Submit">
<input type="reset" value="Reset">

</form>

</body>
</html>