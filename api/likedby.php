<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

if (!isset($_POST['pid'])) {
    exit;
}

$pid = (int)$_POST['pid'];
if ($pid <= 0) exit;

try {
    $stmt = $conn->prepare("SELECT likedby, users.name, users.username, users.profile FROM likes JOIN users WHERE likes.pid = ? AND likes.likedby = users.username");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
} catch (mysqli_sql_exception $e) {
    error_log("likedby.php DB error: " . $e->getMessage());
    exit;
}
?>
<p>Liked By</p>
<form action="viewprofile.php">
    <?php while ($row = $result->fetch_assoc()) { ?>
    <div class="d-flex">
        <figure style="width:55px"><img class="profile" src="./uploads/profileimg/<?php echo htmlspecialchars($row['profile']); ?>" alt=""></figure>
        <div class="friend-meta">
            <h4><a href="" title=""><?php echo htmlspecialchars($row['username']); ?></a></h4>
            <p><a href="" title=""><?php echo htmlspecialchars($row['name']); ?></a></p>
        </div>
        <button class="view" type="submit" name="viewprofile" value="<?php echo htmlspecialchars($row['username']); ?>">View Profile</button>
    </div>
    <hr>
    <?php } ?>
</form>
