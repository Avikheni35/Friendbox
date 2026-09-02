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

    $stmt = $conn->prepare("SELECT username FROM photos WHERE pid = ?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $r = $stmt->get_result()->fetch_assoc();
    $postOwner = $r ? $r['username'] : '';

    $stmt = $conn->prepare("SELECT * FROM likes WHERE likedby = ? AND pid = ?");
    $stmt->bind_param("si", $user, $pid);
    $stmt->execute();
    $isliked = $stmt->get_result()->num_rows;

    if ($isliked > 0) {
        $stmt = $conn->prepare("DELETE FROM likes WHERE likedby = ? AND pid = ?");
        $stmt->bind_param("si", $user, $pid);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO likes (username, likedby, pid) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $postOwner, $user, $pid);
        $stmt->execute();
    }
}
