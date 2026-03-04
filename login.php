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
                text-align: center;
            }
            form {
                background: #fff;
                padding: 35px;
                border-radius: 8px;
                max-width: 500px;
                margin: auto;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            input[type="text"],
            input[type="password"]{
                width: 100%;
                padding: 8px;
                margin: 4px 0 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            input[type="submit"]{
                padding: 10px 20px;
                background-color: #2196F3;
                border: none;
                color: #fff;
                border-radius: 4px;
                cursor: pointer;
            }
            input[type="submit"]:hover{
                background-color: #1976D2;
            }
            .register-link{
                display: block;
                margin-top: 15px;
                text-align: center;
            }
            .register-link a{
                text-decoration: none;
                color: white;
                background-color: #4CAF50;
                padding: 8px 16px;
                border-radius: 4px;
            }
            .register-link a:hover{
                background-color: #3d8b40;
            }
        </style>
    </head>

    <body>
        <?php if(isset($_GET["invalid"])){ ?>
            <p style="color:red; text-align:center;">Invalid username or password</p>
            <?php }
        ?>
        <h2>Login</h2>
        <form action="checkLogin.php" method="POST">
            Username:<br>
            <input type="text" name="username" required>
            <br><br>
            Password:<br>
            <input type="password" name="password" required>
            <br><br>
            <div class="register-link">
            <input type="submit" value="Login">
                <a href="registration.php">Back to Registration</a>
            </div>
        </form>
    </body>
</html>