<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

try {
    if (isset($_GET["viewprofile"])) {
        $viewuser = $_GET['viewprofile'];
        $stmt = $conn->prepare("SELECT * FROM followings INNER JOIN users WHERE followings.username = ? AND users.username = followings.following");
        $stmt->bind_param("s", $viewuser);
    } else {
        $stmt = $conn->prepare("SELECT * FROM followings INNER JOIN users WHERE followings.username = ? AND users.username = followings.following");
        $stmt->bind_param("s", $user);
    }
    $stmt->execute();
    $followings = $stmt->get_result();
} catch (mysqli_sql_exception $e) {
    error_log("allfriends.php DB error: " . $e->getMessage());
    exit;
}
?>
<form action="viewprofile.php" method="get">
<ul class="nearby-contct">
    <?php while ($row = $followings->fetch_assoc()) { ?>
    <li>
        <div class="nearly-pepls">
            <figure>
                <button type="submit" name="viewprofile" value="<?php echo htmlspecialchars($row['username']); ?>" class="profilebtn">
                    <img style="height:9vh;" src="./uploads/profileimg/<?php echo htmlspecialchars($row['profile']); ?>" alt="">
                </button>
            </figure>
            <div class="pepl-info">
                <button type="submit" name="viewprofile" value="<?php echo htmlspecialchars($row['username']); ?>" class="profilebtn">
                    <h5><?php echo htmlspecialchars($row['name']); ?></h5>
                </button>
                <span><?php echo htmlspecialchars($row['username']); ?></span>
                <button type="button" name="unfriend" class="unfriend" value="<?php echo htmlspecialchars($row['username']); ?>">unfriend</button>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>
</form>
