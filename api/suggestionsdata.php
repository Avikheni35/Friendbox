<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM users WHERE users.username NOT IN (SELECT following FROM followings WHERE followings.username = ?) AND users.username <> ?");
$stmt->bind_param("ss", $user, $user);
$stmt->execute();
$result = $stmt->get_result();
?>
<style>
    .flist .sugg .widget, .listbox { height: 40vh; overflow-y: scroll; }
</style>
<aside class="sidebar sugg static">
    <div class="widget">
        <h4 class="widget-title">Suggestions</h4>
        <form action="" method="post">
            <ul class="followers">
                <?php while ($row = $result->fetch_assoc()) { ?>
                <li>
                    <figure><img src="./uploads/profileimg/<?php echo htmlspecialchars($row['profile']); ?>" alt=""></figure>
                    <div class="friend-meta">
                        <h4><a href="./viewprofile.php?viewprofile=<?php echo urlencode($row['username']); ?>" title=""><?php echo htmlspecialchars($row['name']); ?></a></h4>
                        <button class="addbtn" type="button" name="addbtn" value="<?php echo htmlspecialchars($row['username']); ?>">Add Friend</button>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </form>
    </div>
</aside>
