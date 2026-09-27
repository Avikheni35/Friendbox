<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

if (isset($_POST['user'])) {
    $username = trim($_POST['user']);
    if (empty($username) || $username === $user) exit;

    $stmt = $conn->prepare("DELETE FROM followings WHERE username = ? AND following = ?");
    $stmt->bind_param("ss", $user, $username);
    if (!$stmt->execute()) {
        echo "error";
    }

    $stmt = $conn->prepare("DELETE FROM followers WHERE username = ? AND followedby = ?");
    $stmt->bind_param("ss", $username, $user);
    $stmt->execute();
}
