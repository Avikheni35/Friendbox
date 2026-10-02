<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

try {
    $stmt = $conn->prepare("SELECT * FROM followings INNER JOIN users WHERE followings.username = ? AND users.username = followings.following");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $totalfollowing = $stmt->get_result()->num_rows;

    $stmt = $conn->prepare("SELECT * FROM followers INNER JOIN users WHERE followers.username = ? AND users.username = followers.followedby");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $totalfollowers = $stmt->get_result()->num_rows;
} catch (mysqli_sql_exception $e) {
    error_log("total.php DB error: " . $e->getMessage());
    $totalfollowing = 0;
    $totalfollowers = 0;
}
?>
<li class="nav-item followings"><a class="active" href="#frends" data-toggle="tab">Followings</a>
    <span><?php echo $totalfollowing; ?></span>
</li>
<li class="nav-item followers"><a class="" href="#frends-req" data-toggle="tab">Followers</a>
    <span><?php echo $totalfollowers; ?></span>
</li>
