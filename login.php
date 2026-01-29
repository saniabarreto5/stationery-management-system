<?php
session_start();
require 'db_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Query user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
    $stmt->execute([$email, $role]);
    $user = $stmt->fetch();

    if ($user && $user['password'] == $password) {
        $_SESSION['user'] = $user;

        if ($user['role'] == 'owner') {
            header("Location: owner_dashboard.php");
            exit;
        } elseif ($user['role'] == 'customer') {
            header("Location: customer_dashboard.php");
            exit;
        }
    } else {
        $error = "Invalid email, password, or role";
    }
}
?>


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STATIONARY MANAGEMENT LOGIN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">


    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            /*  Pink pastel background image */
            background: url("images/stationary.jpg") no-repeat center center fixed;
            background-size: cover ;
    

            font-family: Arial, sans-serif;
        }

        .login-box {
            background: ffffff(235, 155, 220, 0.69);
            padding: 30px;
            border-radius: 20px;
            width: 350px;
            text-align: center;
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 18px rgba(0,0,0,0.12);
        }

.login-box h2 {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    text-transform: 
    letter-spacing: 2px;    
}

        .login-title {
            font-size: 26px;
            font-weight: 700;
            color: #ffffffff; 
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        select, input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #dcdcdc;
            background: #fafafa;
            outline: none;
        }

     
        .login-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #ff4f7a;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .login-button:hover {
            background-color: #123e1391;
        }

         a {
            color: #edeeedff;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2 class="login-title">Stationery Management Login</h2>

        <?php if (!empty($error)) { ?>
            <div class="error"><?= $error ?></div>
        <?php } ?>

        <form action="login.php" method="POST">
            <select name="role" required>
                <option value="customer">Customer</option>
                <option value="owner">Owner</option>
            </select>

            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" class="login-button">LOGIN</button>
        </form>

        <p style="margin-top: 10px;">
            Don't have an account?
            <a href="signup.php">Sign Up</a>
        </p>
    </div>

</body>
</html>
