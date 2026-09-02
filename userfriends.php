<?php
session_start();
include("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if (!isset($_GET['viewprofile'])) {
    header("location: photos.php");
    exit;
}

$viewuser = $_GET['viewprofile'];
$loguser  = $_SESSION['username'];

$stmt = $conn->prepare(
    "SELECT users.username, users.profile FROM users JOIN followings ON users.username = followings.following WHERE followings.username = ?"
);
$stmt->bind_param("s", $viewuser);
$stmt->execute();
$result = $stmt->get_result();
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
    <style>
        .profilebtn { color:black; border:none; padding:0; background-color:transparent; }
    </style>
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
                                    <div class="central-meta">
                                        <h5>Friends of <?php echo htmlspecialchars($viewuser); ?></h5>
                                        <div class="frnds">
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                            <div class="friend-box">
                                                <figure>
                                                    <img src="./uploads/profileimg/<?php echo htmlspecialchars($row['profile']); ?>" alt="" style="height:50px; width:50px; object-fit:cover; border-radius:50%;">
                                                </figure>
                                                <div class="friend-meta">
                                                    <h4>
                                                        <a href="viewprofile.php?viewprofile=<?php echo urlencode($row['username']); ?>">
                                                            <?php echo htmlspecialchars($row['username']); ?>
                                                        </a>
                                                    </h4>
                                                    <?php if ($row['username'] !== $loguser) { ?>
                                                    <button class="btn btn-primary addbtn" value="<?php echo htmlspecialchars($row['username']); ?>">Follow</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php } ?>
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
