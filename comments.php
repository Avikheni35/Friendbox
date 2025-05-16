<?php
    require("config.php");
    session_start();
    $pid = "";
    $user = $_SESSION['username'];
    
    if(isset($_POST['cmt'])){
        $pid = $_POST['pid'];
        $sql = "SELECT users.username FROM photos join users WHERE pid = '$pid' and users.username = photos.username  ";
        $x = mysqli_query($conn,$sql);
        foreach($x as $row){
           $username = $row['username']; 
        }
        $cmt = $_POST['cmt'];
        $sql = "insert into comments (pid,username,commentby,comment) values('$pid','$username','$user','$cmt')";
        mysqli_query($conn,$sql);
    }
    if(isset($_POST['pid'])){
        $pid = $_POST['pid'];
        // setcookie()
        $sql = "SELECT *  FROM `comments` join users WHERE pid = '$pid' and users.username = comments.username order by cid desc";
        $comments = mysqli_query($conn,$sql);
    }
    
?>
<!-- <script src="comment.js"></script> -->


            <?php
        foreach($comments as $row){
            $commentby = $row['commentby'];
            $sql = "SELECT *  FROM users where username = '$commentby'";
            $data = mysqli_query($conn,$sql);
            foreach($data as $r){
                $profile = $r['profile'];
            }
            ?>
            <li>
                <div class="comet-avatar">
                    <img style="height:50px;width:50px" src="./userdata/profileimg/<?php echo $profile ?>" alt="">
                </div>
                <div class="we-comment">
                    <div class="coment-head">
                        <h5><a href="" title=""><?php echo $comment ?></a></h5>
                        <h5><a href="" title=""><?php echo $row['commentby'] ?></a></h5>
                        <span><?php echo $row['date_time']; ?></span>
                        <!-- <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a> -->
                    </div>
                    <p ><?php echo $row['comment'] ?></p>
                </div>
            </li>

            <?php
        }
        ?>

