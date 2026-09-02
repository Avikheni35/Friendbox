<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

if (isset($_POST['remove'])) {
    $username = $_POST['remove'];

    $stmt = $conn->prepare("DELETE FROM followings WHERE username = ? AND following = ?");
    $stmt->bind_param("ss", $username, $user);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM followers WHERE username = ? AND followedby = ?");
    $stmt->bind_param("ss", $user, $username);
    $stmt->execute();
}
