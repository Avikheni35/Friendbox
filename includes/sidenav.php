<style>
    .viewstripe {
        display: none;
        .stripe {
            background-color: #088dcd;
            position: absolute;
            bottom: 0px;
            margin: auto;
            width: 100%;
            padding: 10px;
            color: white;
            text-align: center
        }
    }
</style>
<?php
require(__DIR__ . '/config.php');
$sql = "SELECT * FROM advertise ORDER BY ad_id DESC LIMIT 1";
$data = mysqli_query($conn, $sql);
$brand = '';
$image = '';
$link = '';
if ($data && mysqli_num_rows($data) > 0) {
    $row = mysqli_fetch_assoc($data);
    $brand = $row['brand'];
    $image = $row['image'];
    $link  = $row['link'];
}
?>
<div class="col-lg-3">
    <aside class="sidebar static" style="position:fixed;">
        <div class="widget">
            <h4 class="widget-title">Shortcuts</h4>
            <ul class="naves">
                <li><i class="ti-clipboard"></i><a href="index.php" title="">feed</a></li>
                <li><i class="ti-user"></i><a href="friends.php" title="">friends</a></li>
                <li><i class="ti-image"></i><a href="photos.php" title="">images</a></li>
                <li><i class="ti-comments-smiley"></i><a href="chat.php" title="">Messages</a></li>
                <li><i class="fa fa-bar-chart-o"></i><a href="saved.php" title="">Saved</a></li>
                <li><i class="ti-share"></i><a href="updateprofile.php" title="">My Profile</a></li>
                <li><i class="ti-power-off"></i><a href="logout.php" title="">Logout</a></li>
            </ul>
        </div>

        <div class="widget advertisement">
            <h4 class="widget-title"><?php echo htmlspecialchars($brand); ?></h4>
            <ul class="activities">
                <li>
                    <div class="activity-meta">
                        <img src="./admin/advertise/<?php echo htmlspecialchars($image); ?>" alt="">
                        <div class="viewstripe">
                            <a href="<?php echo htmlspecialchars($link); ?>" class="stripe">
                                <span>Visit Website</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
</div>

<script>
    $(".advertisement").hover(function () {
        $('.viewstripe').css("display", "block")
    }, function () {
        $('.viewstripe').css("display", "none")
    })
</script>
