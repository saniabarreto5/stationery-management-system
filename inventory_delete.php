<?php
session_start();
require 'db_connect.php';

if ($_SESSION['user']['role'] !== 'owner') exit;

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT item_image FROM inventory WHERE id=?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($item && file_exists($item['item_image'])) {
    unlink($item['item_image']); // delete file
}

$delete = $pdo->prepare("DELETE FROM inventory WHERE id=?");
$delete->execute([$id]);

header("Location: inventory_view.php");
exit;
