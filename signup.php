<?php
include 'db_connect.php';
$err = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(string:$_POST['name'] ?? '');
    $email = trim(string:$_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$name || !$email || !$password) $err = "Please fill all fields.";
    else {

      
$stmt = $pdo->prepare(query:"SELECT * FROM customers WHERE email = ?");
$stmt->execute(params:[$email]);

if ($stmt->fetch()) {
    $err = "Email already registered.";
} else {
    // save to customers
    $stmt = $pdo->prepare(query:"INSERT INTO customers (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute(params:[$name, $email, $password]);

    // save to users table
    $hash = password_hash(password:$password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare(query:"INSERT INTO users (name,email,password,role) VALUES (?,?,?, 'customer')");
    $stmt->execute(params:[$name,$email,$hash]);

    $success = "Account created. You can now login.";
}
    }
}
?>
<!doctype html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<meta charset="utf-8">
<title>STATIONARY MANAGEMENT LOGIN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">


    <style>
         body 
    

        {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background: url("images/stationary.jpg") no-repeat center center fixed;
            background-size: cover ;
    

            font-family: Arial, sans-serif;
        }


.box {
    background: ffffff;
    padding: 30px;
    border-radius: 20px;
    width: 350px;
    text-align: center;
    backdrop-filter: blur(8px);
    box-shadow: 0 4px 18px rgba(0,0,0,0.12);
}

.box h2 {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    text-transform: uppercase;  
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
            color: #f1f5f0ff;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }
        button[type="submit"] {
    width: 100%;
    padding: 12px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 10px;
    background-color: #ff4f7a;
    color: white;
    border: none;
    cursor: pointer;
    transition: 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #e63e6a;
}
    </style>
  
</head>
<body>
<div class="box">
  <h2>SignUp (Customer)</h2>
  <?php if($err): ?><div class="err"><?=$err?></div><?php endif; ?>
  <?php if($success): ?><div class="msg"><?=$success?></div><?php endif; ?>
  <form method="post">
    <input name="name" placeholder="Full name" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
  <button type="submit">Create Account</button>

  </form>
  <div class="msg">Already have account? <a href="login.php">Login</a></div>
</div>
</body>
</html>
