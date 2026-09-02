<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

if (isset($_POST['pid'])) {
    $pid = (int)$_POST['pid'];

    $stmt = $conn->prepare("SELECT * FROM bookmark WHERE username = ? AND pid = ?");
    $stmt->bind_param("si", $user, $pid);
    $stmt->execute();
    $issaved = $stmt->get_result()->num_rows;

    if ($issaved > 0) {
        $stmt = $conn->prepare("DELETE FROM bookmark WHERE username = ? AND pid = ?");
        $stmt->bind_param("si", $user, $pid);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO bookmark (username, pid) VALUES (?, ?)");
        $stmt->bind_param("si", $user, $pid);
        $stmt->execute();
    }
}
