<?php
    session_start();
    require("config.php");
    $user = $_SESSION['username'] ?? '';
    if (isset($_COOKIE['selected']) && !empty($user)) {
        $message  = trim($_POST['message'] ?? '');
        $selected = $_COOKIE['selected'];
        if (!empty($message)) {
            $stmt = $conn->prepare("INSERT INTO chat (username, user, message, status) VALUES (?, ?, ?, 'sender')");
            $stmt->bind_param("sss", $user, $selected, $message);
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO chat (username, user, message, status) VALUES (?, ?, ?, 'receiver')");
            $stmt->bind_param("sss", $selected, $user, $message);
            if (!$stmt->execute()) {
                echo "failed";
            }
        }
    }
?>