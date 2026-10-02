<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

if (!isset($_COOKIE['selected'])) {
    exit;
}

$selected = $_COOKIE['selected'];

try {
    $stmt = $conn->prepare("SELECT profile, username FROM users WHERE username = ?");
    $stmt->bind_param("s", $selected);
    $stmt->execute();
    $result = $stmt->get_result();
} catch (mysqli_sql_exception $e) {
    error_log("chathead.php DB error: " . $e->getMessage());
    exit;
}

$username = '';
$profile  = '';
if ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $profile  = $row['profile'];
}
?>
<div class="leftside">
    <div class="profile-pic-person">
        <img class="person-profile-pic" style="width:40px;height:40px" src="./uploads/profileimg/<?php echo htmlspecialchars($profile); ?>" />
        <div class="tooltip">Profile Details</div>
    </div>
    <div style="margin-left:14px"><strong><?php echo htmlspecialchars($username); ?></strong></div>
</div>
<div class="rightside">
    <div class="tooltip-icon">
        <ion-icon name="search-outline"></ion-icon>
        <div class="tooltip">Search</div>
    </div>
    <div class="tooltip-icon">
        <ion-icon name="ellipsis-vertical-outline"></ion-icon>
        <div class="tooltip">Menu</div>
    </div>
</div>
