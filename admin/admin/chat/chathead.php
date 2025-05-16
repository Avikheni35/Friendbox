<?php
 session_start();
 require("config.php");
   if(isset($_COOKIE['selected'])){
     $selected = $_COOKIE['selected'];
     $sql = "select profile, username from users where username = '$selected'";  
     $result = mysqli_query($conn,$sql);
     foreach($result as $row){
       $username = $row['username'];
       $profile = $row['profile'];
     }
     
   }
?>

<div class="leftside">
                    <div class="profile-pic-person">
                        <img class="person-profile-pic" style="width: 40px; height: 40px" src="./userdata/profileimg/<?php echo $profile ?>" />
                        <div class="tooltip">Profile Details</div>
                    </div>
                    <div style="margin-left: 14px"><strong><?php echo $username ?></strong></div>
                </div>

                <div class="rightside">
                    <div class="tooltip-icon">
                        <ion-icon name="search-outline"></ion-icon>
                        <div class="tooltip">Search</div>
                    </div>

                    <div class="tooltip-icon">
                        <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                        <div class="tooltip">Menu</div>
                    </div>
                </div>