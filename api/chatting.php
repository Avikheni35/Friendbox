<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

if (isset($_GET['selected'])) {
    $selected = $_GET['selected'];
    setcookie("selected", $selected, time() + 2 * 24 * 60 * 60);
} elseif (isset($_COOKIE['selected'])) {
    $selected = $_COOKIE['selected'];
} else {
    exit;
}

try {
    $stmt = $conn->prepare("SELECT * FROM chat WHERE username = ? AND user = ? ORDER BY cid DESC");
    $stmt->bind_param("ss", $user, $selected);
    $stmt->execute();
    $result = $stmt->get_result();
} catch (mysqli_sql_exception $e) {
    error_log("chatting.php DB error: " . $e->getMessage());
    exit;
}

while ($row = $result->fetch_assoc()) {
    $isSender = ($row['username'] === $user && $row['status'] === 'sender');
    $class    = $isSender ? 'my-message' : 'friendmsg';
    ?>
    <div class="<?php echo $class; ?>">
        <?php if ($row['message'] === NULL && $row['posts'] !== NULL) { ?>
            <img src="./uploads/posts/<?php echo htmlspecialchars($row['posts']); ?>" style="height:200px;width:auto">
        <?php } else {
            $time = '';
            if (!empty($row['time'])) {
                $date = new DateTime($row['time']);
                $time = $date->format("H:i");
            }
        ?>
            <p>
                <?php echo htmlspecialchars($row['message']); ?>
                <br />
                <span class="times"><?php echo $time; ?></span>
            </p>
        <?php } ?>
    </div>
    <?php
}
