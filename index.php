<?php
session_start();
require_once('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$query = "SELECT * FROM candidates";
$stmt = $conn->prepare($query);
$stmt->execute();
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Display candidates and allow voting -->
