<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$query = trim($_GET['search'] ?? '');
if ($query === '') {
    exit;
}

try {
    $search = '%' . $query . '%';
    $stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE ? LIMIT 20");
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
} catch (mysqli_sql_exception $e) {
    error_log("usersearch.php DB error: " . $e->getMessage());
    exit;
}

while ($row = $result->fetch_assoc()) {
?>
<div class="searchuser">
    <img src="./uploads/profileimg/<?php echo htmlspecialchars($row['profile']); ?>" alt="">
    <div class="friend-meta">
        <div>
            <h6><a href="" title=""><?php echo htmlspecialchars($row['username']); ?></a></h6>
            <p><?php echo htmlspecialchars($row['name']); ?></p>
        </div>
        <form action="viewprofile.php" method="get">
            <input type="hidden" name="viewprofile" value="<?php echo htmlspecialchars($row['username']); ?>">
            <button class="visit" type="submit">View Profile</button>
        </form>
    </div>
</div>
<hr>
<?php } ?>
