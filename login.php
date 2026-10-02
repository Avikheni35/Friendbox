<?php
include("includes/config.php");
session_start();

if (isset($_SESSION['username'])) {
    header("location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();

        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['profile']  = $row['profile'];
            $_SESSION['name']     = $row['name'];
            $_SESSION['coverpic'] = $row['coverpic'];
            header("location: index.php");
            exit;
        } else {
            echo '<script>alert("Invalid username or password")</script>';
        }
    } catch (mysqli_sql_exception $e) {
        error_log("login.php DB error: " . $e->getMessage());
        echo '<script>alert("Login failed. Please try again.")</script>';
    }
}

if (isset($_POST["register"])) {
    $dest  = "./uploads/profileimg";
    $dest2 = "./uploads/coverimg";
    $name     = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $email    = trim($_POST["email"]);
    $pass     = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $phone    = trim($_POST["phone"]);

    $basename = safeUpload($_FILES["file"], $dest);
    if (!$basename) {
        echo '<script>alert("Profile image upload failed. Only JPG/PNG/GIF/WEBP up to 5MB allowed.")</script>';
    } else {
        $basename2 = safeUpload($_FILES["cover"], $dest2);
        if (!$basename2) {
            echo '<script>alert("Cover image upload failed. Only JPG/PNG/GIF/WEBP up to 5MB allowed.")</script>';
        } else {
            try {
                $stmt = $conn->prepare("INSERT INTO users (username, name, password, email, phone, profile, coverpic) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $username, $name, $pass, $email, $phone, $basename, $basename2);
                if ($stmt->execute()) {
                    header("location: login.php");
                    exit;
                }
            } catch (mysqli_sql_exception $e) {
                error_log("login.php register DB error: " . $e->getMessage());
                echo '<script>alert("Registration failed. Username may already be taken.")</script>';
            }
        }
    }
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
</head>
<body>
    <div class="theme-layout">
        <div class="container-fluid pdng0">
            <div class="row merged">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="land-featurearea">
                        <div class="land-meta">
                            <h1>Friendbox</h1>
                            <p>Friendbox is free to use for as long as you want with two active projects.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="login-reg-bg">
                        <div class="log-reg-area sign">
                            <h2 class="log-title">Login</h2>
                            <form method="post">
                                <div class="form-group">
                                    <input type="text" id="input" name="username" required="required" />
                                    <label class="control-label" for="input">Username</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="pwd" name="password" required="required" />
                                    <label class="control-label" for="pwd">Password</label><i class="mtrl-select"></i>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" checked="checked" /><i class="check-box"></i>Always Remember Me.
                                    </label>
                                </div>
                                <div class="submit-btns">
                                    <button class="mtr-btn signin" name="login" type="submit"><span>Login</span></button>
                                    <button class="mtr-btn signup" type="button"><span>Register</span></button>
                                </div>
                            </form>
                        </div>
                        <div class="log-reg-area reg">
                            <h2 class="log-title">Register</h2>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" name="name" required="required" />
                                    <label class="control-label" for="input">First &amp; Last Name</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" required="required" />
                                    <label class="control-label" for="input">User Name</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" required="required" />
                                    <label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" required="required" />
                                    <label class="control-label" for="input">Mobile No.</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group" style="display:flex; align-items:center;">
                                    <label for="file" class="btn">Select profile</label>
                                    <input type="file" name="file" id="file" required="required" />
                                </div>
                                <div class="form-group" style="display:flex; align-items:center;">
                                    <label for="cover" class="btn">Select Cover photo</label>
                                    <input type="file" name="cover" id="cover" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" required="required" />
                                    <label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" required /><i class="check-box"></i>Accept Terms &amp; Conditions
                                    </label>
                                </div>
                                <div class="submit-btns">
                                    <button class="btn btn-primry" type="submit" name="register"><span>Register</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/main.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
