<?php
$host = 'sql304.infinityfree.com';
$username = 'if0_34985422';
$password = 'BDxJV7YH6aWJV9g';
$database = 'if0_34985422_main';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>