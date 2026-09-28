<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

if (isset($_POST['user'])) {
    $user     = $_SESSION['username'];
    $username = trim($_POST['user']);
    if (empty($username) || $username === $user) exit;

    try {
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
    } catch (mysqli_sql_exception $e) {
        error_log("addfriends.php DB error: " . $e->getMessage());
        http_response_code(500);
    }
}
