<script src="assets/js/comment.js"></script>
<script src="assets/js/actions.js"></script>

<form action="viewprofile.php" method="get">
<?php
session_start();
require(__DIR__ . '/../includes/config.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit;
}

$user    = $_SESSION['username'];
$loguser = $_SESSION['username'];

if (!isset($_GET['req'])) {
    exit;
}

$stmt = $conn->prepare(
    "SELECT photos.username, book_id, bookmark.pid, photos.datetime, users.profile, photos.source, photos.caption
     FROM bookmark JOIN photos JOIN users ON bookmark.pid = photos.pid
     WHERE bookmark.username = ? AND photos.username = users.username"
);
$stmt->bind_param("s", $user);
$stmt->execute();
$feed = $stmt->get_result();
?>
<style>
    .modal a.close-modal { position: absolute; top: 2.5px; right: 1px; }
    .modal { margin-top: 50px; height: 85vh; overflow: auto; }
    figure .profile { width:50px; height:50px; border-radius:50%; object-fit:cover; }
    .userimg img { height: 65vh; }
    .userimg { display:flex; justify-content:center; background-color:aliceblue; }
    .friend-info figure img { width:50px; height:50px !important; object-fit:cover; }
</style>
<?php
while ($row = $feed->fetch_assoc()) {
    $pid = $row['pid'];

    $stmt2 = $conn->prepare("SELECT * FROM comments WHERE pid = ?");
    $stmt2->bind_param("i", $pid);
    $stmt2->execute();
    $totalcomments = $stmt2->get_result()->num_rows;
<div class="central-meta item">
    <div class="user-post">
        <div class="friend-info">
            <figure>
                <img src="./uploads/profileimg/<?php echo htmlspecialchars($row['profile']); ?>" style="height:50px" alt="">
            </figure>
            <div class="friend-name">
                <ins><button type="button" name="viewprofile" value="<?php echo htmlspecialchars($row['username']); ?>"><?php echo htmlspecialchars($row['username']); ?></button></ins>
                <span>published: <?php echo htmlspecialchars($row['datetime']); ?></span>
            </div>
            <div class="post-meta">
                <div class="userimg">
                    <img src="uploads/posts/<?php echo htmlspecialchars($row['source']); ?>" height="100px" alt="">
                </div>
                <div class="we-video-info">
                    <ul>
                        <li>
                            <span class="save" data-toggle="tooltip" title="Save">
                                <?php
                                $stmt3 = $conn->prepare("SELECT * FROM bookmark WHERE username = ? AND pid = ?");
                                $stmt3->bind_param("si", $loguser, $pid);
                                $stmt3->execute();
                                $issaved = $stmt3->get_result()->num_rows;
                                ?>
                                <i class="fa <?php echo $issaved > 0 ? 'fa-bookmark' : 'fa-bookmark-o'; ?>"></i>
                                <input type="hidden" value="<?php echo $pid; ?>">
                            </span>
                        </li>
                        <li>
                            <span class="comment" data-toggle="tooltip" title="Comments">
                                <a href="#ex1" rel="modal:open">
                                    <i class="fa fa-comments-o"></i>
                                    <input type="hidden" value="<?php echo $pid; ?>">
                                </a>
                                <ins><?php echo $totalcomments; ?></ins>
                            </span>
                        </li>
                        <li>
                            <span class="like" data-toggle="tooltip" title="like">
                                <?php
                                $stmt4 = $conn->prepare("SELECT * FROM likes WHERE likedby = ? AND pid = ?");
                                $stmt4->bind_param("si", $loguser, $pid);
                                $stmt4->execute();
                                $isliked = $stmt4->get_result()->num_rows;

                                $stmt5 = $conn->prepare("SELECT * FROM likes WHERE pid = ?");
                                $stmt5->bind_param("i", $pid);
                                $stmt5->execute();
                                $totalliked = $stmt5->get_result()->num_rows;
                                ?>
                                <i class="fa <?php echo $isliked > 0 ? 'fa-heart' : 'fa-heart-o'; ?>"></i>
                                <a href="#likedby" class="likedby" rel="modal:open">liked by</a>
                                <input type="hidden" value="<?php echo $pid; ?>">
                                <span><?php echo $totalliked; ?></span>
                            </span>
                        </li>
                        <li>
                            <span data-toggle="tooltip" title="Share">
                                <a href="#sharepost" class="sharepost" rel="modal:open">
                                    <i class="fa fa-paper-plane"></i>
                                    <input type="hidden" class="postid" value="<?php echo htmlspecialchars($row['source']); ?>">
                                    <input type="hidden" class="selected" value="<?php echo htmlspecialchars($row['username']); ?>">
                                </a>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="description">
                    <p><?php echo htmlspecialchars($row['caption']); ?></p>
                </div>
            </div>
        </div>

        <div id="ex1" class="modal commentsmodal">
            <p>Comments</p>
            <input type="hidden" class="cmtpid" value="<?php echo $pid; ?>">
            <div class="coment-area">
                <ul class="we-comet">
                    <div class="top"></div>
                    <div class="bottom">
                        <li><hr></li>
                        <li class="post-comment">
                            <div class="comet-avatar">
                                <img style="height:30px;width:50px" src="uploads/profileimg/<?php echo htmlspecialchars($_SESSION['profile']); ?>" alt="">
                            </div>
                            <div class="post-comt-box">
                                <div style="display:flex">
                                    <textarea placeholder="Post your comment" name="cmtmsg" id="cmtmsg"></textarea>
                                    <button type="button" class="btn btn-primary commentbtn">post</button>
                                </div>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>
        </div>

        <div id="likedby" class="modal"></div>

        <div id="sharepost" class="modal">
            <?php
            $stmt6 = $conn->prepare(
                "SELECT * FROM users WHERE users.username IN (SELECT following FROM followings WHERE followings.username = ?) AND users.username <> ?"
            );
            $stmt6->bind_param("ss", $loguser, $loguser);
            $stmt6->execute();
            $shareResult = $stmt6->get_result();
            while ($shareRow = $shareResult->fetch_assoc()) {
            ?>
            <div class="d-flex">
                <figure style="width:55px"><img class="profile" src="./uploads/profileimg/<?php echo htmlspecialchars($shareRow['profile']); ?>" alt=""></figure>
                <div class="friend-meta">
                    <h4><?php echo htmlspecialchars($shareRow['username']); ?></h4>
                    <p><?php echo htmlspecialchars($shareRow['name']); ?></p>
                </div>
                <a href="#" rel="modal:close">
                    <button class="btn btn-primary sharebtn" type="button" value="<?php echo htmlspecialchars($shareRow['username']); ?>">Share</button>
                    <input type="hidden" name="selected" value="<?php echo htmlspecialchars($shareRow['username']); ?>">
                </a>
            </div>
            <hr>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
</form>
