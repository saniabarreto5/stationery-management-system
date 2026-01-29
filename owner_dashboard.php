<?php
session_start();

// Block access if user is not logged in or not owner

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Owner Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #a4e6ecff;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #ffffffff;
            padding: 20px;
            color: black;
            text-align: center;
        }
        .container p {
          color: #ff0000ff;
          font-size:larger;
        }

        .container h3 {
          color: #2900a5ff;
          font-size: xx-large;
        }

        .container a {
          color: #00b900ff;
        }
        .container {
            margin: 40px auto;
            width: 80%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #aaa;
        }
            box-shadow: 0 0 10px #aaa;
        }
        .logout {
            float: right;
            margin-top: -40px;
        }
        .logout a {
            background: red;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Owner Dashboard</h1>
</div>

<div class="container">
    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>

    
    <p>You are logged in as <strong>Owner</strong>.</p>

    <hr>

    <h3>📦 Inventory Management</h3>
<p><a href="inventory_add.php">➕ Add New Item</a></p>
<p><a href="inventory_view.php">📋 View Inventory</a></p>

<h3>👥 View All Customers</h3>
<p><a href="view_customers.php">👁 View Customers</a></p>


</div>

</body>
</html>
