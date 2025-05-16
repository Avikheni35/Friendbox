<?php
        session_start();
        require("config.php");
        $user = $_SESSION['username'];
        if(isset($_POST['pid'])){
          $pid = $_POST['pid'];
          $query = "select * from bookmark where username ='$user' and pid = '$pid' ";
		  $result = mysqli_query($conn,$query);
          $issaved = mysqli_num_rows($result);
          if($issaved>0){
            $query = "delete from bookmark where username ='$user' and pid = '$pid'";
		        $result = mysqli_query($conn,$query);
          }else{
            $query = "insert into bookmark(username,pid) values('".$user."','".$pid."') ";
            $result = mysqli_query($conn,$query);
          }
        } 
    ?>