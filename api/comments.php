<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user    = $_SESSION['username'];
$pid     = 0;
$comments = null;

if (isset($_POST['cmt']) && isset($_POST['pid'])) {
    $pid = (int)$_POST['pid'];
    $cmt = $_POST['cmt'];

    $stmt = $conn->prepare("SELECT users.username FROM photos JOIN users WHERE pid = ? AND users.username = photos.username");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $r        = $stmt->get_result()->fetch_assoc();
    $postOwner = $r ? $r['username'] : '';

    $stmt = $conn->prepare("INSERT INTO comments (pid, username, commentby, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $pid, $postOwner, $user, $cmt);
    $stmt->execute();
}

if (isset($_POST['pid'])) {
    $pid = (int)$_POST['pid'];
    $stmt = $conn->prepare("SELECT * FROM comments JOIN users WHERE pid = ? AND users.username = comments.username ORDER BY cid DESC");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $comments = $stmt->get_result();
}

if ($comments && $comments->num_rows > 0) {
    while ($row = $comments->fetch_assoc()) {
        $commentby = $row['commentby'];

        $stmt2 = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt2->bind_param("s", $commentby);
        $stmt2->execute();
        $data    = $stmt2->get_result();
        $profile = '';
        while ($r = $data->fetch_assoc()) {
            $profile = $r['profile'];
        }
        ?>
        <li>
            <div class="comet-avatar">
                <img style="height:50px;width:50px" src="./uploads/profileimg/<?php echo htmlspecialchars($profile); ?>" alt="">
            </div>
            <div class="we-comment">
                <div class="coment-head">
                    <h5><a href="" title=""><?php echo htmlspecialchars($row['commentby']); ?></a></h5>
                    <span><?php echo htmlspecialchars($row['date_time']); ?></span>
                </div>
                <p><?php echo htmlspecialchars($row['comment']); ?></p>
            </div>
        </li>
        <?php
    }
}
