<?php
	session_start();
	require("config.php");
	$user = $_SESSION['username'];
    $sql = "SELECT * from users where users.username in(select following from followings where followings.username='$user')
	and users.username <> '$user'";
    if(isset($_GET['viewprofile'])){
        $viewuser = $_GET['viewprofile'];
        $sql = "SELECT * from users where users.username in(select following from followings where followings.username='$viewuser')
        and users.username <> '$viewuser'";
    }
    $result = $conn->query($sql);
	
	
?>
<ul class="followers">
						<?php
							foreach($result as $row){
						?>
							<li>
							<figure><img src="./userdata/profileimg/<?php echo $row['profile']; ?>" alt=""></figure>
							<div class="friend-meta">
								<h4><a href="" title=""><?php echo $row['name'] ?></a></h4>
								<button class="view" type="submit" name="viewprofile" value="<?php echo $row['username']; ?>">View Profile</button>
							</div>
							</li>
						<?php
							}
							?>
				</ul>