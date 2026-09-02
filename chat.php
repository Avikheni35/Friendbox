<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}
$user = $_SESSION['username'];
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
    <script src="assets/js/chat.js"></script>
    <script src="assets/js/chatting.js"></script>
    <script src="assets/js/send.js"></script>
    <style>
        .message-list { height: 80vh; overflow-y: scroll; }
        .person-chat { height: 65vh; overflow-y: scroll; }
        .chat-window { height: 80vh; display: flex; flex-direction: column; }
    </style>
</head>
<body>
    <div class="theme-layout">
        <?php include("includes/nav.php"); ?>
        <section>
            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="central-meta">
                                <div class="inbox-heading">
                                    <h5>Inbox</h5>
                                    <input type="text" id="search" placeholder="Search" class="form-control" />
                                </div>
                                <div class="message-list"></div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="central-meta chat-window">
                                <div class="active-inbox-header"></div>
                                <div class="person-chat"></div>
                                <div class="chat-input" style="margin-top:auto;">
                                    <div style="display:flex; gap:10px;">
                                        <input type="text" id="message" placeholder="Type a message..." class="form-control">
                                        <button class="btn btn-primary send">Send</button>
                                    </div>
                                </div>
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
