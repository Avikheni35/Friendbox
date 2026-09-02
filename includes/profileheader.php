<?php
require(__DIR__ . '/config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['viewprofile'])) {
    $user = $_GET['viewprofile'];
} else {
    $user = $_SESSION['username'];
}

$stmt = $conn->prepare("SELECT * FROM followers WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$followers = $stmt->get_result()->num_rows;

$img      = $_SESSION['profile'];
$coverpic = $_SESSION['coverpic'];
$username = $_SESSION['name'];
$src      = "uploads/profileimg/" . $img;
?>
<style>
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

    .sugg .widget { min-height: 40vh; }
</style>
<section>
    <div class="feature-photo">
        <figure><img class="coverpic" src="./uploads/coverimg/<?php echo htmlspecialchars($coverpic); ?>" alt=""></figure>
        <div class="add-btn">
            <a href="#" title="" data-ripple=""><?php echo $followers; ?> followers</a>
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
                                <h5><?php echo htmlspecialchars($user); ?></h5>
                                <span><?php echo htmlspecialchars($username); ?></span>
                            </li>
                            <?php
                            $scriptName = $_SERVER['SCRIPT_NAME'];
                            if (isset($_GET['viewprofile'])) {
                                $uname = $_GET['viewprofile'];
                            ?>
                            <li>
                                <a <?php if (str_ends_with($scriptName, 'photos.php')) { ?> class="active" <?php } ?> href="photos.php?viewprofile=<?php echo urlencode($uname); ?>" data-ripple="">Photos</a>
                                <a <?php if (str_ends_with($scriptName, 'userfriends.php')) { ?> class="active" <?php } ?> href="userfriends.php?viewprofile=<?php echo urlencode($uname); ?>" data-ripple="">Friends</a>
                                <a <?php if (str_ends_with($scriptName, 'detail.php')) { ?> class="active" <?php } ?> href="detail.php?viewprofile=<?php echo urlencode($uname); ?>" data-ripple="">Detail view</a>
                            </li>
                            <?php } else { ?>
                            <li>
                                <a <?php if (str_ends_with($scriptName, 'photos.php')) { ?> class="active" <?php } ?> href="photos.php" data-ripple="">Photos</a>
                                <a <?php if (str_ends_with($scriptName, 'friends.php')) { ?> class="active" <?php } ?> href="friends.php" data-ripple="">Friends</a>
                                <a <?php if (str_ends_with($scriptName, 'detail.php')) { ?> class="active" <?php } ?> href="detail.php?viewprofile=<?php echo urlencode($user); ?>" data-ripple="">Detail view</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
