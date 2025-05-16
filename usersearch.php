<?php
    session_start();
    require("config.php");
    if(isset($_GET['search'])){
    
        $search = $_GET['search'];
        $sql = "select * from users where username like '%$search%' ";
        $result = mysqli_query($conn,$sql);
    }
    else{
        $sql = "select * from users";
        $result = mysqli_query($conn,$sql);
    }

    foreach($result as $row){   
?>


<div class="searchuser">
    <img src="./userdata/profileimg/<?php echo $row['profile'] ?>" alt="">
    <div class="friend-meta">
        <div>
            <h6><a href="" title=""><?php echo $row['username'] ?></a></h6>
            <p><?php echo $row['name']?></p>
        </div>
        <form action="viewprofile.php" method="get">
            <input type="hidden" name="viewprofile" value="<?php echo $row['username'] ?>">
        <button class="visit" type="submit">View Profile</button>
    </form>
    </div>
</div>
<hr>
<?php
    }
    ?>