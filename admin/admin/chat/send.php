<?php
    session_start();
    require("config.php");
    $user = $_SESSION['username'];
    if(isset($_COOKIE['selected'])){
        $message = $_POST['message'];
        $selected = $_COOKIE['selected'];
        $sql = "insert into chat (username,user,message,status) values('$user','$selected','$message','sender')";
        $result = mysqli_query($conn,$sql);
        $sql = "insert into chat (username,user,message,status) values('$selected','$user','$message','receiver')";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            echo "failed";
        }
    }
?>