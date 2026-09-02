<?php
include("includes/config.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$sername     = '';
$servicename = '';
$desc        = '';

if (isset($_GET['servicename'])) {
    $sername = $_GET['servicename'];
    $stmt = $conn->prepare("SELECT * FROM services WHERE name = ?");
    $stmt->bind_param("s", $sername);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $servicename = $row['name'];
        $desc        = $row['desc'];
    }
}

if (isset($_GET['servicebook'])) {
    $service  = $_GET['service'] ?? '';
    $username = $_SESSION['username'];
    $name     = $_GET['name']   ?? '';
    $email    = $_GET['email']  ?? '';
    $mobile   = $_GET['mobile'] ?? '';
    $date     = $_GET['date']   ?? '';

    if (empty($username) || empty($email) || empty($mobile) || empty($date)) {
        echo "<script>alert('All fields are required')</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO booking (username, Name, service, email, mobile, date_time) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $name, $service, $email, $mobile, $date);
        $stmt->execute();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Friendbox</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/color.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="theme-layout">
        <?php include("includes/nav.php"); ?>

        <section id="booking-form">
            <div class="modal fade" id="book-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" align="center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                        <form>
                            <div class="control-group">
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name" />
                                    <div class="input-group-append"><div class="input-group-text"><i class="far fa-user"></i></div></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" />
                                    <div class="input-group-append"><div class="input-group-text"><i class="far fa-envelope"></i></div></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="input-group">
                                    <input type="text" name="mobile" class="form-control" placeholder="Mobile" />
                                    <div class="input-group-append"><div class="input-group-text"><i class="fa fa-mobile-alt"></i></div></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="input-group">
                                    <input type="date" name="date" class="form-control" placeholder="Date" />
                                    <div class="input-group-append"><div class="input-group-text"><i class="far fa-calendar-alt"></i></div></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="input-group">
                                    <input type="hidden" name="servicename" value="<?php echo htmlspecialchars($sername); ?>">
                                    <input type="text" class="form-control" name="service" value="<?php echo htmlspecialchars($sername); ?>" readonly />
                                    <div class="input-group-append"><div class="input-group-text"><i class="fa fa-cogs"></i></div></div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit" name="servicebook">Book Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <div class="wrapper" style="padding:40px 20px;">
            <div class="about-container">
                <div class="text-container">
                    <h1><?php echo htmlspecialchars($servicename); ?></h1>
                    <p><?php echo htmlspecialchars($desc); ?></p>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#book-modal">Get Service</a>
                </div>
            </div>
        </div>

        <?php include("includes/footer.php"); ?>
    </div>
    <script src="assets/js/main.min.js"></script>
</body>
</html>
