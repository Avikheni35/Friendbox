<?php
require(__DIR__ . '/config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_GET['viewprofile'])) {
    header("location: photos.php");
    exit;
}

$username = $_GET['viewprofile'];
$user     = $_SESSION['username'];

if ($username === $user) {
    header("location: photos.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM followers WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$totalfollowers = $stmt->get_result()->num_rows;

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$userdata = $stmt->get_result();

$stmt = $conn->prepare("SELECT * FROM followings WHERE username = ? AND following = ?");
$stmt->bind_param("ss", $user, $username);
$stmt->execute();
$isfriend = ($stmt->get_result()->num_rows !== 0);

$name    = '';
$uname   = '';
$img     = '';
$coverpic = '';
while ($row = $userdata->fetch_assoc()) {
    $name     = $row['name'];
    $uname    = $row['username'];
    $img      = $row['profile'];
    $coverpic = $row['coverpic'];
    $src      = "uploads/profileimg/" . $img;
}

if (isset($_POST['addfriend'])) {
    $viewusername = $_POST['addfriend'];
    $stmt = $conn->prepare("SELECT * FROM followings WHERE username = ? AND following = ?");
    $stmt->bind_param("ss", $user, $viewusername);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO followings (username, following) VALUES (?, ?)");
        $stmt->bind_param("ss", $user, $viewusername);
        $stmt->execute();
        $stmt = $conn->prepare("INSERT INTO followers (username, followedby) VALUES (?, ?)");
        $stmt->bind_param("ss", $viewusername, $user);
        $stmt->execute();
    }
    header("location: viewprofile.php?viewprofile=" . urlencode($viewusername));
    exit;
}
?>
<style>
    .followbtn {
        border-radius: 2px;
        color: #fff;
        display: inline-block;
        font-size: 14px;
        padding: 4px 20px;
    }

    .timeline-info .admin-name > span { bottom: 15px }

    .feature-photo figure {
        display: flex;
        justify-content: center;
        background-color: black;

        .coverpic {
            height: 60vh;
            object-fit: cover
        }
    }

    .user-avatar > figure > img {
        width: 100%;
        height: 12vw;
        background-position: center;
        object-fit: cover;
    }

    .nearly-pepls figure img,
    .followers figure img {
        width: 50px;
        height: 50px !important;
        object-fit: cover;
    }
</style>
<section>
    <div class="feature-photo">
        <figure><img class="coverpic" src="./uploads/coverimg/<?php echo htmlspecialchars($coverpic); ?>" alt=""></figure>
        <div class="add-btn">
            <form action="" method="post">
                <span style="color:white"><?php echo $totalfollowers; ?> followers</span>
                <?php if ($isfriend) { ?>
                    <button type="submit" class="followbtn">Following</button>
                <?php } else { ?>
                    <button type="submit" name="addfriend" value="<?php echo htmlspecialchars($username); ?>" class="followbtn">Add Friend</button>
                <?php } ?>
            </form>
        </div>
        <div class="container-fluid">
            <div class="row merged">
                <div class="col-lg-2 col-sm-3">
                    <div class="user-avatar">
                        <figure>
                            <img src="<?php echo htmlspecialchars($src); ?>" alt="">
                        </figure>
                    </div>
                </div>
                <div class="col-lg-10 col-sm-9">
                    <div class="timeline-info">
                        <ul>
                            <li class="admin-name">
                                <h5><?php echo htmlspecialchars($name); ?></h5>
                                <span><?php echo htmlspecialchars($uname); ?></span>
                            </li>
                            <li>
                                <?php $scriptName = $_SERVER['SCRIPT_NAME']; ?>
                                <a <?php if (str_ends_with($scriptName, 'viewprofile.php')) { ?> class="active" <?php } ?> href="viewprofile.php?viewprofile=<?php echo urlencode($uname); ?>" data-ripple="">Photos</a>
                                <a <?php if (str_ends_with($scriptName, 'userfriends.php')) { ?> class="active" <?php } ?> href="userfriends.php?viewprofile=<?php echo urlencode($uname); ?>" data-ripple="">Friends</a>
                                <a <?php if (str_ends_with($scriptName, 'detail.php')) { ?> class="active" <?php } ?> href="detail.php?viewprofile=<?php echo urlencode($uname); ?>" data-ripple="">Detail view</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
