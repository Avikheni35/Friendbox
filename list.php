<?php
session_start();
require("includes/config.php");

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

if (isset($_GET['viewprofile'])) {
    $viewuser = $_GET['viewprofile'];
    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE users.username IN (SELECT following FROM followings WHERE followings.username = ?) AND users.username <> ?"
    );
    $stmt->bind_param("ss", $viewuser, $viewuser);
} else {
    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE users.username IN (SELECT following FROM followings WHERE followings.username = ?) AND users.username <> ?"
    );
    $stmt->bind_param("ss", $user, $user);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<ul class="followers">
    <?php while ($row = $result->fetch_assoc()) { ?>
    <li>
        <figure>
            <img src="./uploads/profileimg/<?php echo htmlspecialchars($row['profile']); ?>" alt="">
        </figure>
        <div class="friend-meta">
            <h4><?php echo htmlspecialchars($row['name']); ?></h4>
            <button class="view" type="button" name="viewprofile" value="<?php echo htmlspecialchars($row['username']); ?>">View Profile</button>
        </div>
    </li>
    <?php } ?>
</ul>
