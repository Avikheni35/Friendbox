<?php
if(isset($_POST['user'])){
    session_start();
    require("config.php");
    $user = $_SESSION['username'];
    $username = $_POST['user'];
    $query = "select * from followings where username='$user' and following = '$username'";
    $result = mysqli_query($conn,$query);
    $isfollowing = mysqli_num_rows($result);
    if(!$isfollowing){
        
        $query = "insert into followings(username,following) values('".$user."','".$username."') ";
        $result = mysqli_query($conn,$query);
        
        $query = "insert into followers(username,followedby) values('".$username."','".$user."') ";
        $result = mysqli_query($conn,$query);
    }
    // header("location:friends.php");
    // return $total;
}
?>