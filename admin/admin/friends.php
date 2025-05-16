<?php 
    session_start();
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Friendbox</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="../css/main.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/color.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="main.js"></script>
    <script src="actions.js"></script>

    <style>
    .profilebtn {
        color: black;
        border: none;
        padding: 0;
        background-color: transparent;
    }

    .remove, .unfriend {
        right: 0px;
        top: 3px;
        position: absolute;
    }
    </style>
</head>

<body>

    <div class="theme-layout">


    <?php
    require("config.php");
    // session_start();
	if(isset($_GET['viewprofile'])){
		$user =  $_GET['viewprofile'];
		// echo $user;
	}else{
    $user = $_SESSION['username'];
	}

    
    $sql = "SELECT * from followers where username = '$user' ";
    $result = $conn->query($sql);
    $followers = mysqli_num_rows($result);

    $sql = "SELECT * from users where username = '$user' ";
    $data = $conn->query($sql);
    foreach($data as $row){
        $img = $row['profile'];
        $coverpic = $row['coverpic'];
        $src = "../../userdata/profileimg/".$img;
    }
   
?>
<style>
	.feature-photo figure{
		display:flex;
		justify-content:center;
		background-color:black;
		.coverpic{
			height:60vh;
			/* width:auto; */
			object-fit:cover
		}
	}
    .following,.follower{
        height: 50vh;
    overflow-y: scroll;
    }
    #frends{
        margin-bottom:50px
    }
</style>
            <?php
                include("userprofile.php");
            ?>
            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" id="page-contents">
                                <?php
								include("sidenav.php");
							?>
                                <div class="col-lg-9">
                                    <div class="central-meta">
                                        <div class="frnds">
                                            <ul class="nav nav-tabs total">
                                            <?php
                                                // session_start();
                                                // require("config.php");
                                                // $user = $_SESSION['username'];
                                                    
                                                $sql = "select * from followings INNER JOIN users where followings.username='$user' and users.username = followings.following";
                                                $followings = $conn->query($sql);
                                                $totalfollowing = mysqli_num_rows($followings); 
                                                $sql = "select * from followers INNER JOIN users where followers.username='$user' and users.username = followers.followedby";
                                                $followers = $conn->query($sql);
                                                $totalfollowers = mysqli_num_rows($followers); 
                                                ?>
                                                <li class="nav-item followings"><a class="active" href="#frends" data-toggle="tab">Followings</a>
                                                    <span><?php echo $totalfollowing; ?></span>
                                                </li>
                                                <li class="nav-item followers"><a class="" href="#frends-followers" data-toggle="tab">Followers</a>
                                                    <span><?php echo $totalfollowers; ?></span>
                                                </li>
    <!-- <script src="action.js"></script> -->

                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content" id="friendsdata">
                                                <div class="tab-pane active fade show " id="frends">
                                                        <!-- <script src="actions.js"></script> -->
                                                        <form action="friends.php" method="get" class="following">

                                                        <ul class="nearby-contct">
                                                            <?php
                                                            
                                                            // if(isset($_GET["viewprofile"])){
                                                            //     $user = $_GET['viewprofile'];
                                                            // }else{
                                                            // $user = $_SESSION['username'];
                                                            // }
                                                            $sql = "select * from followings INNER JOIN users where followings.username='$user' and users.username = followings.following";
                                                            $followings = $conn->query($sql);
                                                            $totalfollowing = mysqli_num_rows($followings); 

                                                        foreach($followings as $row){
                                                        ?>
                                                            <li>
                                                                <div class="nearly-pepls">
                                                                    <figure>
                                                                        <!-- <input type="hidden" name="viewprofile"
                                                                            value="<?php echo $row['username'] ?>"> -->
                                                                        <button type="submit" name="viewprofile"
                                                                            value="<?php echo $row['username'] ?>"
                                                                            class="profilebtn"><img style="height:9vh;"
                                                                                src="../..//userdata/profileimg/<?php echo $row['profile']; ?>"
                                                                                alt=""></button>
                                                                    </figure>
                                                                    <div class="pepl-info">
                                                                        <button type="submit" name="viewprofile"
                                                                            value="<?php echo $row['username'] ?>"
                                                                            class="profilebtn">
                                                                            <h5><?php echo $row['name'] ?></h5>
                                                                        </button>
                                                                        <span><?php echo $row['username'] ?></span>

                                                                        <button type="submit    " name="viewprofile"
                                                                            class="unfriend"
                                                                            value="<?php echo $row['username'] ?>">viewprofile</button>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                        </ul>
                                                        </form>

<!-- <div class="lodmore"><button class="btn-view btn-load-more"></button></div> -->
                                                </div>
                                                
                                           
                                                <div class="" id="frends-followers">
                                                <h2>followers</h2>
                                                <form action="friends.php" method="get" class="follower">

                                                <ul class="nearby-contct">
                                                    <?php
                                                    
                                                    // if(isset($_GET["viewprofile"])){
                                                    //     $user = $_GET['viewprofile'];
                                                    // }else{
                                                    // $user = $_SESSION['username'];
                                                    // }
                                                    $sql = "select * from followers INNER JOIN users where followers.username='$user' and users.username = followers.followedby";
                                                    $followings = $conn->query($sql);
                                                    // $totalfollowing = mysqli_num_rows($followings); 

                                                foreach($followings as $row){
                                                ?>
                                                    <li>
                                                        <div class="nearly-pepls">
                                                            <figure>
                                                                <!-- <input type="hidden" name="viewprofile"
                                                                    value="<?php echo $row['username'] ?>"> -->
                                                                <button type="submit" name="viewprofile"
                                                                    value="<?php echo $row['username'] ?>"
                                                                    class="profilebtn"><img style="height:9vh;"
                                                                        src="../..//userdata/profileimg/<?php echo $row['profile']; ?>"
                                                                        alt=""></button>
                                                            </figure>
                                                            <div class="pepl-info">
                                                                <button type="submit" name="viewprofile"
                                                                    value="<?php echo $row['username'] ?>"
                                                                    class="profilebtn">
                                                                    <h5><?php echo $row['name'] ?></h5>
                                                                </button>
                                                                <span><?php echo $row['username'] ?></span>

                                                                <button type="submit    " name="viewprofile"
                                                                    class="unfriend"
                                                                    value="<?php echo $row['username'] ?>">viewprofile</button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                                </ul>
                                                </form>

                                                <!-- <div class="lodmore"><button class="btn-view btn-load-more"></button></div> -->
                                                </div>
                                                    <!-- <button class="btn-view btn-load-more"></button> -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- centerl meta -->
                                
                                <?php
								// include("suggestions.php");
							?>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
		// include("footer.php");
	?>

    </div>
    
    <!-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="js/main.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/map-init.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</body>


</html>