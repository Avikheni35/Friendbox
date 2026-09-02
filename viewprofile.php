<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}
if (!isset($_GET['viewprofile'])) {
    header("location: photos.php");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="assets/js/main.js"></script>
    <script src="assets/js/actions.js"></script>
    <style>
        .friend-name button { background-color:transparent; color:black; margin:0; padding:0; font-size:medium; border:none; }
        .userimg img { height:65vh; }
        .userimg { display:flex; justify-content:center; background-color:aliceblue; }
        .friend-info figure img { width:50px; height:50px !important; object-fit:cover; }
    </style>
</head>
<body>
    <div class="theme-layout">
        <?php
        include("includes/nav.php");
        include("includes/profileheader.php");
        include("includes/userprofile.php");
        ?>
        <section>
            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" id="page-contents">
                                <?php include("includes/sidenav.php"); ?>
                                <div class="col-lg-6">
                                    <div class="loadMore"></div>
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
