<?php
session_start();
include("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if (!isset($_GET['pid'])) {
    header("location: index.php");
    exit;
}

$pid  = $_GET['pid'];
$stmt = $conn->prepare("SELECT photos.*, users.profile, users.name FROM photos JOIN users ON photos.username = users.username WHERE photos.pid = ?");
$stmt->bind_param("i", $pid);
$stmt->execute();
$result = $stmt->get_result();
$row    = $result->fetch_assoc();

if (!$row) {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friendbox</title>
    <link rel="icon" href="assets/images/fav.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/color.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/actions.js"></script>
    <script src="assets/js/comment.js"></script>
</head>
<body>
    <div class="theme-layout">
        <?php include("includes/nav.php"); ?>
        <section>
            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" id="page-contents">
                                <?php include("includes/sidenav.php"); ?>
                                <div class="col-lg-6">
                                    <div class="central-meta item">
                                        <div class="user-post">
                                            <div class="friend-info">
                                                <figure>
                                                    <img src="./uploads/profileimg/<?php echo htmlspecialchars($row['profile']); ?>" alt="" style="height:50px; width:50px; object-fit:cover; border-radius:50%;">
                                                </figure>
                                                <div class="friend-name">
                                                    <ins><a href="viewprofile.php?viewprofile=<?php echo urlencode($row['username']); ?>"><?php echo htmlspecialchars($row['username']); ?></a></ins>
                                                    <span>published: <?php echo htmlspecialchars($row['datetime']); ?></span>
                                                </div>
                                                <div class="post-meta">
                                                    <img src="./uploads/posts/<?php echo htmlspecialchars($row['source']); ?>" alt="" style="max-width:100%;">
                                                    <div class="description">
                                                        <p><?php echo htmlspecialchars($row['caption']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php include("includes/suggestions.php"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include("includes/footer.php"); ?>
    </div>
    <script src="assets/js/main.min.js"></script>
</body>
</html>
