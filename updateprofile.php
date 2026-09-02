<?php
include("includes/config.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if (isset($_POST['update'])) {
    $olduser  = $_SESSION['username'];
    $name     = $_POST['name'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $bio      = $_POST['bio'];

    $destProfile = "./uploads/profileimg";
    $destCover   = "./uploads/coverimg";

    if (!empty($_FILES['file']['name'])) {
        $basename = safeUpload($_FILES['file'], $destProfile);
        if (!$basename) {
            echo '<script>alert("Profile image upload failed.")</script>';
            goto done;
        }
    } else {
        $stmt = $conn->prepare("SELECT profile FROM users WHERE username = ?");
        $stmt->bind_param("s", $olduser);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $basename = $row['profile'];
    }

    if (!empty($_FILES['cover']['name'])) {
        $basename2 = safeUpload($_FILES['cover'], $destCover);
        if (!$basename2) {
            echo '<script>alert("Cover image upload failed.")</script>';
            goto done;
        }
    } else {
        $stmt = $conn->prepare("SELECT coverpic FROM users WHERE username = ?");
        $stmt->bind_param("s", $olduser);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $basename2 = $row['coverpic'];
    }

    $stmt = $conn->prepare("UPDATE users SET username=?, name=?, email=?, phone=?, profile=?, coverpic=?, bio=? WHERE username=?");
    $stmt->bind_param("ssssssss", $username, $name, $email, $phone, $basename, $basename2, $bio, $olduser);

    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        $_SESSION['profile']  = $basename;
        $_SESSION['coverpic'] = $basename2;
        $_SESSION['name']     = $name;
        header("location: photos.php");
        exit;
    } else {
        echo '<script>alert("Update failed. Username may already be taken.")</script>';
    }
    done:
}

$user = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$row  = $stmt->get_result()->fetch_assoc();
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
    <style>
        .suggestions { padding:0 !important; max-width:100% !important; }
        .sugg { width:100%; }
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
                                        <div class="editing-info">
                                            <h5 class="f-title"><i class="ti-info-alt"></i>Update Profile</h5>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group col-md-12">
                                                    <label>Name</label>
                                                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Username</label>
                                                    <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Email</label>
                                                    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Phone</label>
                                                    <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Bio</label>
                                                    <textarea name="bio"><?php echo htmlspecialchars($row['bio'] ?? ''); ?></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Profile Photo</label>
                                                    <input type="file" name="file" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Cover Photo</label>
                                                    <input type="file" name="cover" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" name="update" class="mtr-btn">Update</button>
                                                </div>
                                            </form>
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
