<?php
    session_start();
    require("config.php");
    $user = $_SESSION['username'];
    if(isset($_GET['selected'])){
        $selected = $_GET['selected'];
        setcookie("selected", "$selected", time() + 2 * 24 * 60 * 60);
        $sql = "SELECT * FROM `chat` where username = '$user' and user = '$selected' order by cid desc";
        $result = mysqli_query($conn,$sql);
        foreach($result as $row){
            if($row['username']=="$user" and $row['status']=='sender' ){
            ?>
                <div class="my-message">
                    <p>
                    <?php echo $row['message'] ?>
                    <br />
                    <span class="times">6:32 Pm</span>
                    </p>
                </div>
            <?php
            }
            else{
            ?>
                <div class="friendmsg">
                    <p>
                    <?php echo $row['message'] ?><br />
                    <span class="times">6:32 Pm</span>
                    </p>
                </div>
            <?php
            }
        }
    }
    else{
        $selected = $_COOKIE['selected'];
        $sql = "SELECT * FROM `chat` where username = '$user' and user = '$selected' order by cid desc";
        $result = mysqli_query($conn,$sql);
        foreach($result as $row){
            if($row['username']=="$user" and $row['status']=='sender'){
            ?>
                <div class="my-message">
                    <p>
                    <?php echo $row['message'] ?>
                    <br />
                    <span class="times">6:32 Pm</span>
                    </p>
                </div>
            <?php
            }
            else {
            ?>
                <div class="friendmsg">
                    <p>
                    <?php echo $row['message'] ?><br />
                    <span class="times">6:32 Pm</span>
                    </p>
                </div>
            <?php
            }
        }
    }

?>