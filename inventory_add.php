<?php
session_start();
require 'db_connect.php';

if ($_SESSION['user']['role'] !== 'owner') {
    header("Location: login.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['item_name'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];

    // IMAGE UPLOAD
    $imageName = $_FILES['item_image']['name'];
    $imageTemp = $_FILES['item_image']['tmp_name'];
    $imagePath = "uploads/" . uniqid() . "_" . $imageName;

    move_uploaded_file($imageTemp, $imagePath);

    $stmt = $pdo->prepare("INSERT INTO inventory (item_name, quantity, price, item_image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $qty, $price, $imagePath]);

    $message = "Item added successfully with image!";
}
?>

<h2>Add Inventory Item</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="item_name" placeholder="Item Name" required><br><br>
    <input type="number" name="quantity" placeholder="Quantity" required><br><br>
    <input type="text" name="price" placeholder="Price" required><br><br>

    <label>Upload Item Image:</label><br>
    <input type="file" name="item_image" accept="image/*" required><br><br>

    <button type="submit">Add Item</button>
</form>

<p><?php echo $message; ?></p>
