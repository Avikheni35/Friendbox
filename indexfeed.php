<!-- <script src="main.js"></script> -->
<script src="comment.js"></script>
    
<form action="viewprofile.php" method="get">
<?php
session_start();
require("config.php");
$user = $_SESSION['username'];
$loguser = $_SESSION['username'];
if(isset($_GET['req'])){
    $sql = "select photos.username,book_id,bookmark.pid,users.profile,photos.source,photos.caption from bookmark join photos join users on bookmark.pid = photos.pid where bookmark.username = '$user' and photos.username = users.username ";
}
else if(isset($_GET['viewprofile'])){
    $user =  $_GET['viewprofile'];
    $sql = "SELECT * from photos join users where users.username = photos.username and photos.username = '$user' order by pid desc";
}
else{
    $sql = "select pid,uid,photos.username,users.name,source,caption,datetime,users.profile from photos JOIN users where photos.username IN (select following from followings where followings.username ='$user') and photos.username = users.username or (photos.username = '$user' and photos.username = users.username) ORDER BY pid desc";
}



$feed = $conn->query($sql);
$sql = "select * from likes where username = '$user'";
$likedpost = $conn->query($sql);
foreach($feed as $row){
    // <?php 
    $pid = $row['pid'];
    $sql = "select * from comments where pid = '$pid'";
    $comment = $conn->query($sql);
    $totalcomments = mysqli_num_rows($comment);
?>

<style>
    .modal a.close-modal {
    position: absolute;
    top: 2.5px ;
    right: 1px;
    }
    .modal{
    margin-top: 50px;
    height: 85vh;
    overflow: auto;
    }
    figure .profile{
        width:50px;
        height:50px;
        border-radius:50%;
        object-fit:cover;
    }
    .userimg img{
        height:65vh;
    }
    .userimg{
        display: flex;
    justify-content: center;
    background-color: aliceblue;
    }
    .friend-info figure img{
		width: 50px;
    height: 50px !important;
    object-fit: cover;
	}
</style>
<div class="central-meta item">
    <div class="user-post">
        <div class="friend-info">
            <figure>
                <img src="./userdata/profileimg/<?php echo $row['profile']?>" style = "height:50px" alt="">
            </figure>
            <div class="friend-name">
                <ins><button type="buttone" name="viewprofile" value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></button></ins>
                <span>published: <?php echo $row['datetime']; ?></span>
            </div>
            <div class="post-meta">
                <div class="userimg">
                <img src="userdata/posts/<?php echo $row['source']; ?>" height=100px alt="">
                </div>
                <div class="we-video-info">
                    <ul>
                    <li>
                            <span class="save" data-toggle="tooltip" title="Save"> 
                                <?php 
                                $pid = $row['pid'];
                                $sql = "select * from bookmark where username = '$loguser' and pid = '$pid'";
                                $saved = $conn->query($sql);
                                $issaved = mysqli_num_rows($saved);
                                if($issaved>0){
                                ?>
                                <i class="fa fa-bookmark"></i> 
                                <input type="hidden" value="<?php echo $row['pid'] ?>">
                                <?php 
                                }else{
                                ?>
                                <i class="fa fa-bookmark-o"></i> 
                                <input type="hidden" value="<?php echo $row['pid'] ?>">
                                <?php  
                                }
                                ?>
                            </span>
                        </li>
                        <li>
                            <span class="comment" data-toggle="tooltip"
                                title="Comments">
                                <a href="#ex1" rel="modal:open"><i class="fa fa-comments-o"></i>
                                <input type="hidden" value="<?php echo $row['pid'] ?>">
                            </a>
                                <ins><?php echo $totalcomments ?></ins>
                            </span>
                        </li>
                        <li>
                            <span class="like" data-toggle="tooltip"
                                title="like">
                                
                                <?php 
                                $pid = $row['pid'];
                                $sql = "select * from likes where likedby = '$loguser' and pid = '$pid'";
                                $likedpost = $conn->query($sql);
                                $isliked = mysqli_num_rows($likedpost);

                                $sql = "select * from likes where pid = '$pid'";
                                $result = $conn->query($sql);
                                $totalliked = mysqli_num_rows($result);
                                if($isliked>0){
                                ?>
                                <i class="fa fa-heart"></i> <a href="#likedby" class="likedby" rel="modal:open">liked by </a>
                                <input type="hidden" value="<?php echo $row['pid'] ?>">
                                <?php 
                                }else{
                                ?>
                                <i class="fa fa-heart-o"></i> <a href="#likedby" class="likedby" rel="modal:open">liked by </a>
                                <input type="hidden" value="<?php echo $row['pid'] ?>">
                                <?php  
                                }
                                ?>
                                <span><?php echo $totalliked ?></span>
                            </span>
                        </li>
                       
                        <li>
                            <span class="" data-toggle="tooltip" title="Save">  
                                <a href="#sharepost" class="sharepost" rel="modal:open"><i class="fa fa-paper-plane"></i> 
                                <input type="hidden" class= "postid" value="<?php echo $row['source'] ?>">
                                <input type="hidden" class= "selected" value="<?php echo $row['username'] ?>">

                            </a>
                            </span>
                        </li>

                    </ul>
                </div>
                <div class="description">
                    <p>
                        <?php echo $row['caption']; ?>
                    </p>
                </div>
            </div>
        </div>
        <div id="ex1" class="modal commentsmodal">
            <p>Comments</p>
            <input type="hidden" class="cmtpid" value="<?php echo $pid ?>">
                <div class="coment-area">
                    <ul class="we-comet">
                        <div class="top">
                            
                        </div>
                        <div class="bottom">

                            <li>
                                <hr>
                            </li>
                            <li class="post-comment">
                                <div class="comet-avatar">
                                    <img style = "height:30px;width:50px "src="userdata/profileimg/<?php echo $_SESSION['profile'] ?>" alt="">
                                </div>
                                <div class="post-comt-box">
                                    <!-- <form method="get" style="display:flex" class='commentform'> --> 
                                        <div style="display:flex">
                                        <textarea type="text" placeholder="Post your comment" value="" name="cmtmsg" id="cmtmsg"></textarea>
                                    
                                        <button type="button" class="btn btn-primary commentbtn">post</button>
                                        </div>
                                </div>
                            </li>
                        </div>

                    </ul>
                </div>
          
        </div>
        <div id="likedby" class="modal ">
                
                
        </div>
        <div id="sharepost" class="modal ">
                
                <?php
                    $sql = "SELECT * from users where users.username in(select following from followings where followings.username='$loguser')
                    and users.username <> '$loguser'";
                    $result = mysqli_query($conn,$sql);
                    foreach($result as $row){
                            ?>
                                <div class="d-flex">
                                <figure style="width:55px"><img class="profile" src="./userdata/profileimg/<?php echo $row['profile']; ?>" alt=""></figure>
                                <div class="friend-meta">
                                    <h4><a href="" title=""><?php echo $row['username'] ?></a></h4>
                                    <p><a href="" title=""><?php echo $row['name'] ?></a></p>
                                </div>
                                <a href="#" rel="modal:close"  ><button class="btn btn-primary sharebtn" type="button" name="sharepost" value="<?php echo $row['username']; ?>">Share</button>
                                <input type="hidden" name="selected" value="<?php echo $row['username']  ?>">
                                </a>
                                </div>
                                <hr>
                            <?php
                    }
                ?>
                .
        </div>
    </div>
</div>

<?php
}
?>
</form> 
<script src="actions.js"></script>


