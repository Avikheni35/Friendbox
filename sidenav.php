<style>

	.viewstripe{
		display:none;
		.stripe{
			background-color: #088dcd;
			position: absolute;
			bottom: 0px;
			margin: auto;
			width: 100%;
			padding: 10px;
			color:white;
			text-align:center
		}
	}
</style>
<?php
require('config.php');
 $sql = "select * from advertise order by ad_id desc limit 1";
 $data = mysqli_query($conn,$sql);
 foreach($data as $row){
	 $brand = $row['brand'];
	 $image = $row['image'];
	 $link = $row['link'];
 }

?>
<div class="col-lg-3">
								<aside class="sidebar static" style="position:fixed;">
									<div class="widget">
										<h4 class="widget-title">Shortcuts</h4>
										<ul class="naves">
											<li>
												<i class="ti-clipboard"></i>
												<a href="index.php" title="">feed</a>
											</li>
											<!-- <li>
												<i class="ti-mouse-alt"></i>
												<a href="inbox.html" title="">Inbox</a>
											</li> -->
											<!-- <li>
												<i class="ti-files"></i>
												<a href="fav-page.html" title="">My pages</a>
											</li> -->
											<li>
												<i class="ti-user"></i>
												<a href="friends.php" title="">friends</a>
											</li>
											<li>
												<i class="ti-image"></i>
												<a href="photos.php" title="">images</a>
											</li>
											<!-- <li>
												<i class="ti-video-camera"></i>
												<a href="timeline-videos.html" title="">videos</a>
											</li> -->
											<li>
												<i class="ti-comments-smiley"></i>
												<a href="chat.php" title="">Messages</a>
											</li>
											<!-- <li>
												<i class="ti-bell"></i>
												<a href="notifications.html" title="">Notifications</a>
											</li> -->
											<li>
												<i class="fa fa-bar-chart-o"></i>
												<a href="saved.php" title="">Saved</a>
											</li>
											<li>
												<i class="ti-share"></i>
												<a href="updateprofile.php" title="">My Profile</a>
											</li>
											<li>
												<i class="ti-power-off"></i>
												<a href="login.php" title="">Logout</a>
											</li>
										</ul>
									</div><!-- Shortcuts -->

									<!-- recent activities -->
									<div class="widget advertisement">
										<h4 class="widget-title"><?php echo $brand ?></h4>
										<ul class="activities">
											<li>
												<div class="activity-meta">
													<img src="./admin/advertise/<?php echo $image ?>" alt="">
													<div class="viewstripe">
														<a href="<?php echo $link ?>" class="stripe">
															<span>Visit Website</span>
														</a>
													</div>
													
													<!-- <i>10 hours Ago</i>
													<span><a href="#" title="">Commented on Video posted </a></span>
													<h6>by <a href="time-line.html">black demon.</a></h6> -->
												</div>
											</li>
											
										</ul>
									</div>
								
								</aside>
							</div><!-- sidebar -->

<script>
	$(".advertisement").hover(function(){
		$('.viewstripe').css("display","block")
	},
	function(){
		$('.viewstripe').css("display","none")

	})
</script>