<?php
require 'db_connect.php';
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'owner') header('Location: owner_dashboard.php');
    else header('Location: customer_dashboard.php');
} else {
    header('Location: login.php');
}
exit;
