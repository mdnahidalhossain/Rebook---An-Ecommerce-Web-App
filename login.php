<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        
        .login-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        
        .login-form input[type="email"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #80bdff;
            outline: none;
        }
        
        .login-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        
        .login-form button[type="submit"] {
            background:#0E8388;
            color:white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .login-form button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <section>
        <div>
            <h2 class="text-center mt-5">Rebooked</h2>
        </div>
    </section>
    <div class="container">
        <div class="login-form">
            <h2 class="text-center">Login</h2>
            <p class="text-center">Welcome back! Please enter your credentials to log in.</p>
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="email" id="email" name="email"class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <select class="form-control" id="usertype" name="usertype">
                        <option value="" Disabled selected>Select</option>
                        <option value="user">User/Buyer</option>
                        <option value="seller">Seller</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php

    include "server.php";

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $email=$_POST["email"];
        $password=$_POST["password"];
        $role=$_POST["usertype"];

        if($role=="user"){
            $db= $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
            $db->bind_param("ss", $email, $password);
            $db->execute();
            $result=$db->get_result();

            if($result->num_rows==1){
                $result=$result->fetch_assoc();
                session_start();
                $_SESSION["name"]=$result["name"];
                $_SESSION["email"]=$result["email"];
                $_SESSION["id"]=$result["id"];
                $_SESSION["role"]=$result["role"];
                echo $_SESSION["id"];
                header("Location: index.php");
            }else{
                echo 'Invalid email and password';
                header("Location: login.php");
                exit;
            }

        }else if($role=="seller"){
            $db= $conn->prepare("SELECT * FROM seller WHERE email = ? AND password = ?");
            $db->bind_param("ss", $email, $password);
            $db->execute();
            $result=$db->get_result();

            if($result->num_rows==1){
                $result=$result->fetch_assoc();
                session_start();
                $_SESSION["name"]=$result["name"];
                $_SESSION["email"]=$result["email"];
                $_SESSION["id"]=$result["id"];
                $_SESSION["role"]=$result["role"];
                header("Location: index.php");

            }

        }else if($role=="admin"){
                $db= $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
                $db->bind_param("ss", $email, $password);
                $db->execute();
                $result=$db->get_result();

                if($result->num_rows==1){
                    $result=$result->fetch_assoc();
                    session_start();
                    $_SESSION["name"]=$result["name"];
                    $_SESSION["email"]=$result["email"];
                    $_SESSION["id"]=$result["id"];
                    $_SESSION["role"]=$result["role"];
                    header("Location:admin.php");




            }
            
            else{
                echo 'Invalid email and password';
                header("Location: login.php");
                exit;
            }

        }

    }


?>