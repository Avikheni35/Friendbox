<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user = $_SESSION['username'];

try {
    if (isset($_GET['search']) && $_GET['search'] !== '') {
        $search = '%' . $_GET['search'] . '%';
        $stmt = $conn->prepare("SELECT username AS user, profile FROM users WHERE username LIKE ?");
        $stmt->bind_param("s", $search);
    } else {
        $stmt = $conn->prepare("SELECT username, user, message, cid, MAX(time) AS abc, time FROM chat WHERE username = ? GROUP BY user ORDER BY abc DESC");
        $stmt->bind_param("s", $user);
    }
    $stmt->execute();
    $result = $stmt->get_result();
} catch (mysqli_sql_exception $e) {
    error_log("chatlist.php DB error: " . $e->getMessage());
    exit;
}

while ($row = $result->fetch_assoc()) {
    $chatUser = $row['user'];
    $profile  = '';
    $lastchat = '';

    $stmt2 = $conn->prepare("SELECT users.profile, users.username FROM users JOIN chat WHERE users.username = ? ORDER BY chat.time DESC LIMIT 1");
    $stmt2->bind_param("s", $chatUser);
    $stmt2->execute();
    $r2 = $stmt2->get_result()->fetch_assoc();
    if ($r2) { $profile = $r2['profile']; }

    $stmt3 = $conn->prepare("SELECT message FROM chat WHERE username = ? AND user = ? ORDER BY time DESC LIMIT 1");
    $stmt3->bind_param("ss", $chatUser, $user);
    $stmt3->execute();
    $r3 = $stmt3->get_result()->fetch_assoc();
    if ($r3) { $lastchat = $r3['message']; }
    ?>
    <div class="chat-box">
        <input type="hidden" name="user" value="<?php echo htmlspecialchars($row['user']); ?>">
        <div class="person-pic">
            <img class="person-profile-pic" src="./uploads/profileimg/<?php echo htmlspecialchars($profile); ?>" alt="" />
        </div>
        <div class="chatbox-right-div">
            <div class="info">
                <p><?php echo htmlspecialchars($row['user']); ?></p>
                <div class="date"><?php echo htmlspecialchars($row['abc']); ?></div>
            </div>
            <div class="message">
                <ion-icon style="font-size:20px" name="checkmark-done-outline"></ion-icon>
                <div><p><?php echo htmlspecialchars($lastchat); ?></p></div>
            </div>
        </div>
    </div>
    <?php
}
