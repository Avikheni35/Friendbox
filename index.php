<?php
include("includes/config.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if (isset($_POST["photopost"])) {
    $caption  = $_POST['caption'];
    $username = $_SESSION['username'];
    $dest     = "./uploads/posts";

    $basename = safeUpload($_FILES["file"], $dest);
    if ($basename) {
        $stmt = $conn->prepare("INSERT INTO photos (username, source, caption) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $basename, $caption);
        $stmt->execute();
    } else {
        echo '<script>alert("Upload failed. Only JPG/PNG/GIF/WEBP up to 5MB allowed.")</script>';
    }
}

$img  = $_SESSION['profile'];
$src  = "uploads/profileimg/" . $img;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="assets/js/main.js"></script>
    <script src="assets/js/actions.js"></script>
    <style>
        .static { position: sticky !important; top: 15px; }
        .friend-name button { background-color: transparent; color: black; margin: 0; padding: 0; font-size: medium; border: none }
        .suggestions { padding: 0 !important; max-width: 100% !important; }
        .sugg { width: 100% }
        .flist .sugg .widget, .listbox { height: 40vh; overflow-y: scroll; }
        .bottom form { display: flex; width: 97%; gap: 5px }
        .bottom li { margin-top: 20px; }
        .top { height: 55vh; max-height: 55vh; overflow-y: scroll; margin-bottom: 47px; li { margin: 10px 10px 10px 0px; } }
        .new-postbox img { width: 50px; height: 50px !important; object-fit: cover; }
        .followers figure img { width: 50px; height: 50px !important; object-fit: cover; }
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
                                        <div class="new-postbox">
                                            <figure>
                                                <img style="height:9vh;" src="<?php echo htmlspecialchars($src); ?>" alt="">
                                            </figure>
                                            <div class="newpst-input">
                                                <form method="post" enctype="multipart/form-data">
                                                    <textarea rows="2" name="caption" placeholder="write something"></textarea>
                                                    <div class="attachments">
                                                        <ul>
                                                            <li>
                                                                <i class="fa fa-image"></i>
                                                                <label class="fileContainer">
                                                                    <input class="postbox" type="file" name="file" required>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <button type="submit" name="photopost">Post</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loadMore"></div>
                                </div>
                                <div class="col-lg-3 flist">
                                    <aside class="sidebar static">
                                        <div class="widget listbox"></div>
                                        <div class="widget indexsugg"></div>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include("includes/footer.php"); ?>
    </div>

    <div class="side-panel">
        <h4 class="panel-title">General Setting</h4>
        <form method="post">
            <div class="setting-row"><span>use night mode</span><input type="checkbox" id="nightmode1" /><label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label></div>
            <div class="setting-row"><span>Notifications</span><input type="checkbox" id="switch22" /><label for="switch22" data-on-label="ON" data-off-label="OFF"></label></div>
            <div class="setting-row"><span>Notification sound</span><input type="checkbox" id="switch33" /><label for="switch33" data-on-label="ON" data-off-label="OFF"></label></div>
        </form>
    </div>

    <script src="assets/js/main.min.js"></script>
</body>
</html>
