<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
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
    <style>
        .profilebtn { color: black; border: none; padding: 0; background-color: transparent; }
        .remove, .unfriend { right: 0px; top: 3px; position: absolute; }
    </style>
</head>
<body>
    <div class="theme-layout">
        <?php
        include("includes/nav.php");
        include("includes/profileheader.php");
        ?>
        <section>
            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" id="page-contents">
                                <?php include("includes/sidenav.php"); ?>
                                <div class="col-lg-6">
                                    <div class="central-meta">
                                        <div class="frnds">
                                            <ul class="nav nav-tabs total"></ul>
                                            <div class="tab-content" id="friendsdata">
                                                <div class="tab-pane active fade show" id="frends"></div>
                                                <div class="tab-pane fade" id="frends-req"></div>
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
