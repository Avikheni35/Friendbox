<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

if (isset($_POST['shareto'])) {
    $source   = trim($_POST['source'] ?? '');
    $selected = trim($_POST['shareto']);
    if (empty($source) || empty($selected)) exit;

    $stmt = $conn->prepare("INSERT INTO chat (username, user, posts, status) VALUES (?, ?, ?, 'sender')");
    $stmt->bind_param("sss", $user, $selected, $source);
    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO chat (username, user, posts, status) VALUES (?, ?, ?, 'receiver')");
    $stmt->bind_param("sss", $selected, $user, $source);
    if (!$stmt->execute()) {
        echo "failed";
    }
} elseif (isset($_COOKIE['selected'])) {
    $message  = isset($_POST['message']) ? trim($_POST['message']) : '';
    if (empty($message)) {
        exit;
    }
    $selected = $_COOKIE['selected'];

    $stmt = $conn->prepare("INSERT INTO chat (username, user, message, status) VALUES (?, ?, ?, 'sender')");
    $stmt->bind_param("sss", $user, $selected, $message);
    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO chat (username, user, message, status) VALUES (?, ?, ?, 'receiver')");
    $stmt->bind_param("sss", $selected, $user, $message);
    if (!$stmt->execute()) {
        echo "failed";
    }
}
