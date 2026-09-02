<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM followers INNER JOIN users WHERE followers.username = ? AND users.username = followers.followedby");
$stmt->bind_param("s", $user);
$stmt->execute();
$followers = $stmt->get_result();
?>
<form action="viewprofile.php" method="get">
<ul class="nearby-contct">
    <?php while ($row = $followers->fetch_assoc()) { ?>
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
                <button type="button" name="remove" class="remove" value="<?php echo htmlspecialchars($row['username']); ?>">remove</button>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>
</form>
