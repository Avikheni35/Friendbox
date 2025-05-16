<p>Liked By</p>
<form action="viewprofile.php">
        <?php
            require("config.php");
            $pid = $_POST['pid'];
            $sql = "select likedby,users.name, users.username , users.profile from likes join users where likes.pid = '$pid' and likes.likedby = users.username";
            $result = $conn->query($sql);
            foreach($result as $row){
        ?>
            <div class="d-flex">
            <figure style="width:55px"><img class="profile" src="./userdata/profileimg/<?php echo $row['profile']; ?>" alt=""></figure>
            <div class="friend-meta">
                <h4><a href="" title=""><?php echo $row['username'] ?></a></h4>
                <p><a href="" title=""><?php echo $row['name'] ?></a></p>
            </div>
            <button class="view" type="submit" name="viewprofile" value="<?php echo $row['username']; ?>">View Profile</button>
            </div>
            <hr>
        <?php
            }
            ?>
            </form>