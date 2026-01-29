<?php
try {
    $pdo = new PDO(
       dsn:"mysql:host=localhost;dbname=webproject;charset=utf8",
        username:"root",
        password:""
    );

    // Enable exceptions for errors (so you can debug)
    $pdo->setAttribute(PDO::ATTR_ERRMODE,value:PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Show a clean message (hide real DB info)
    die("Database connection failed.");
}
?>
