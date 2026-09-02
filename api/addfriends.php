<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

if (isset($_POST['user'])) {
    $user     = $_SESSION['username'];
    $username = $_POST['user'];

    $stmt = $conn->prepare("SELECT * FROM followings WHERE username = ? AND following = ?");
    $stmt->bind_param("ss", $user, $username);
    $stmt->execute();
    $isfollowing = $stmt->get_result()->num_rows;

    if (!$isfollowing) {
        $stmt = $conn->prepare("INSERT INTO followings (username, following) VALUES (?, ?)");
        $stmt->bind_param("ss", $user, $username);
        $stmt->execute();

        $stmt = $conn->prepare("INSERT INTO followers (username, followedby) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $user);
        $stmt->execute();
    }
}
