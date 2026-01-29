<?php
session_start();
require 'db_connect.php';

if ($_SESSION['user']['role'] !== 'owner') exit;

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM inventory WHERE id=?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['item_name'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];

    $imagePath = $item['item_image'];

    if (!empty($_FILES['item_image']['name'])) {
      
        $imageName = $_FILES['item_image']['name'];
        $imageTemp = $_FILES['item_image']['tmp_name'];
        $imagePath = "uploads/" . uniqid() . "_" . $imageName;

        move_uploaded_file($imageTemp, $imagePath);
    }

    $update = $pdo->prepare("UPDATE inventory SET item_name=?, quantity=?, price=?, item_image=? WHERE id=?");
    $update->execute([$name, $qty, $price, $imagePath, $id]);

    header("Location: inventory_view.php");
    exit;
}
?>

<h2>Edit Item</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="item_name" value="<?= $item['item_name'] ?>"><br><br>
    <input type="number" name="quantity" value="<?= $item['quantity'] ?>"><br><br>
    <input type="text" name="price" value="<?= $item['price'] ?>"><br><br>

    <label>Current Image:</label><br>
    <img src="<?= $item['item_image'] ?>" width="100"><br><br>

    <label>Upload New Image (optional):</label><br>
    <input type="file" name="item_image" accept="image/*"><br><br>

    <button type="submit">Save</button>
</form>
