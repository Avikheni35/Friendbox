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
    if ($pid <= 0) exit;

    try {
        $stmt = $conn->prepare("SELECT * FROM bookmark WHERE username = ? AND pid = ?");
        $stmt->bind_param("si", $user, $pid);
        $stmt->execute();
        $issaved = $stmt->get_result()->num_rows;

        if ($issaved > 0) {
            $stmt = $conn->prepare("DELETE FROM bookmark WHERE username = ? AND pid = ?");
            $stmt->bind_param("si", $user, $pid);
        } else {
            $stmt = $conn->prepare("INSERT INTO bookmark (username, pid) VALUES (?, ?)");
            $stmt->bind_param("si", $user, $pid);
        }
        $stmt->execute();
    } catch (mysqli_sql_exception $e) {
        error_log("bookmark.php DB error: " . $e->getMessage());
        http_response_code(500);
    }
}
