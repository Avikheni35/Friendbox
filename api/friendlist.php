<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

try {
    if (isset($_GET['viewprofile'])) {
        $viewuser = $_GET['viewprofile'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE users.username IN (SELECT following FROM followings WHERE followings.username = ?) AND users.username <> ?");
        $stmt->bind_param("ss", $viewuser, $viewuser);
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE users.username IN (SELECT following FROM followings WHERE followings.username = ?) AND users.username <> ?");
        $stmt->bind_param("ss", $user, $user);
    }
    $stmt->execute();
    $result = $stmt->get_result();
} catch (mysqli_sql_exception $e) {
    error_log("friendlist.php DB error: " . $e->getMessage());
    exit;
}
?>
<style>
    .addbtn { color: #088dcd; border: none; background-color: transparent; }
    .friendlist img { width: 50px; height: 50px; object-fit: cover; }
</style>
<h4 class="widget-title">friends</h4>
<form action="viewprofile.php" class="friendlist" method="get">
    <ul class="followers">
        <?php while ($row = $result->fetch_assoc()) { ?>
        <li>
            <figure><img src="./uploads/profileimg/<?php echo htmlspecialchars($row['profile']); ?>" alt=""></figure>
            <div class="friend-meta">
                <h4><a href="" title=""><?php echo htmlspecialchars($row['name']); ?></a></h4>
                <button class="view" type="submit" name="viewprofile" value="<?php echo htmlspecialchars($row['username']); ?>">View Profile</button>
            </div>
        </li>
        <?php } ?>
    </ul>
</form>
