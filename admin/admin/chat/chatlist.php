<!-- <script src="send.js"></script> -->
<script src="chatting.js"></script>

<?php
    session_start();
    require("../config.php");
    $user = $_SESSION['adminuser'];
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        if($search!=""){
            $sql = "select username as user , profile  from users where username like '%$search%'";
        }else{
        $sql = "SELECT  username,user,message, cid,MAX(time) as abc,time from chat  group by user order by abc desc ";

        }
        
    }
    else{
        $sql = "SELECT  username,user,message, cid,MAX(time) as abc,time from chat group by user order by abc desc";
    }
    $result = mysqli_query($conn,$sql);
    foreach($result as $row){
        $user = $_SESSION['username'];
        $x = $row['user'];
        $sql = "select users.profile,chat.time, users.username, chat.message  from users join chat where users.username = '$x' order by time desc limit 1";
        $data = mysqli_query($conn,$sql);
            foreach($data as $r){
                $profile = $r['profile'];
            }
        ?>
                <!-- documents chatbox -->
                <div class="chat-box" >
                    <input type="hidden" name="user" value="<?php echo $row['user'] ?>">
                    <div class="person-pic">
                        <img class="person-profile-pic" src="./userdata/profileimg/<?php echo $profile ?>" alt="" />
                    </div>

                    <div class="chatbox-right-div">
                        <div class="info">
                            <p><?php echo $row['user'] ?></p>

                            <div class="date">1/4/21</div>
                        </div>

                        <div class="message">
                            <ion-icon style="font-size: 20px" name="checkmark-done-outline"></ion-icon>
                            <img class="chatbox-icon" style="top: 0px" src="Images/document.png" alt="" />

                            <div>
                                <p>english.doc</p>
                            </div>
                        </div>
                    </div>
                </div>

  
                <?php
    }
?>