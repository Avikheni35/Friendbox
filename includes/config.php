<?php
$conn = mysqli_connect("localhost", "root", "", "friendbox");

if (!$conn) {
    die("connection failed");
} else {
    error_reporting(E_ERROR | E_PARSE);
}

function validateUpload($file, $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp']) {
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) return false;
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $validMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mime, $validMimes)) return false;
    if ($file['size'] > 5 * 1024 * 1024) return false;
    return true;
}

function safeUpload($file, $dest) {
    if (!validateUpload($file)) return false;
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $newName = bin2hex(random_bytes(16)) . '.' . $ext;
    if (!move_uploaded_file($file['tmp_name'], $dest . '/' . $newName)) return false;
    return $newName;
}
