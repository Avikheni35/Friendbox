<?php
    $conn = mysqli_connect("localhost", "root", "", "friendbox");

    if (!$conn) {
        error_log("Admin DB connection failed: " . mysqli_connect_error());
        die("Service temporarily unavailable.");
    }

    mysqli_set_charset($conn, "utf8mb4");

    $con = $conn;
?>