<?php

// error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
// echo "line 2";
include "conn.php";
// echo "line 4";

if(isset($_POST['submit']))
{
    $username =$_POST['emp_name'];
    $password=$_POST['password'];

    $sql ="SELECT * register";
    if($conn->query($sql)){
        // $_SESSION['success']="Record successfully inserted";
        // header("location:register.php");
    }else{
        $_SESSION['error']="No record created!";
        header("location:display.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
        }

        .login-header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
        }

        .login-header h2 {
            margin: 0;
        }

        .login-form {
            padding: 20px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: inline-block;
            width: 80px;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group input {
            width: calc(100% - 90px);
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        .login-button,
        .register-button {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .login-button:hover,
        .register-button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST">
    <div class="login-container">
        <div class="login-header">
            <h2>Login</h2>
        </div>
        <div class="login-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="emp_name" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="login-button">Login</button>
            <button type="submit" class="register-button" onclick="window.location.href = 'register.php'">Register</button>
        </div>
    </div>
    </form>
    <?php
                if(isset($_SESSION['success'])){
                    echo  "<div style='background:green;color:#fff;padding:3px;border-radius:3px'>".$_SESSION['success']."</div>";
                    unset($_SESSION['success']);
                }
                if(isset($_SESSION['error'])){
                    echo  "<div style='background:red;color:#fff;padding:3px;border-radius:3px'>".$_SESSION['error']."</div>";
                    unset($_SESSION['error']);
                }
            ?>
</body>
</html>




