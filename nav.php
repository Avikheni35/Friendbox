<!-- <?php
	require("config.php");
	session_start();
	$user = $_SESSION['username'];
	$profile = $_SESSION['profile'];
?> -->
<style>
	.userlist{
		background-color:white;
		padding:10px;
		height:50vh;
		overflow-y:scroll;
		.searchuser{
			padding:10px 0px;
			display:flex;
			button{
				position:relative;
				right:0px;
				top:0px;
				color:#088dcd
			}
			
		}
		
	}
	.userlist .friend-meta{
		display:flex; 
		justify-content:space-between;
		width: -webkit-fill-available;
		h6{
			margin-bottom: 0px;
		}
		p{
			margin-bottom: 0px;
		}
	}
	.searched .form-search{
		/* border:1px solid black; */
	}
	

	.userlist .searchuser img{
		width:50px;
		border-radius:50%;
		height:50px;
	}
	.form-search{
		text-align:justify;
	}
</style>
<?php
	session_start();
	require("config.php");


?>

<div class="topbar stick">
		<div class="logo">
			<a title="" href=""><h2 style="font-family: cursive;">FRIENDBOX</h2></a>
		</div>
		
		<div class="top-area">
			
			<ul class="setting-area">
				<li>
					<i class="ti-search"></i>
					<div class="searched">
						<form method="get" action="viewprofile.php" class="form-search">
							<div>
								<input type="text" class="searchuser" placeholder="Search Friend">
								<button data-ripple type="submit"><i class="ti-search"></i></button>
							</div>
							<!-- <div class="searchlist"> -->
							<div style="list-style:none" class="userlist">
									
							</div>
							<!-- </div> -->
						</form>
						
					</div>
				</li>
				<li><a href="index.php" title="Home" data-ripple><i class="ti-home"></i></a></li>
				
				
			</ul>
			<div class="user-img">
				<img src="./userdata/profileimg/<?php echo $profile ?>" style="height:50px; width:50px" alt="">
				<span class="status f-online"></span>
				<!-- <div class="user-setting">
					<a href="#" title=""><i class="ti-user"></i> view profile</a>
					<a href="#" title=""><i class="ti-pencil-alt"></i>edit profile</a>
					<a href="#" title=""><i class="ti-settings"></i>account setting</a>
					<a href="#" title=""><i class="ti-power-off"></i>log out</a>
				</div> -->
			</div>
			<!-- <span class="ti-menu main-menu" data-ripple=""></span> -->
		</div>
	</div><!-- topbar -->
	<script>
    $('.ti-search').click(function(){
		if($('.searched').hasClass("active")){
			$('.searched').removeClass("active")
		}
		else{
			$('.searched').addClass("active")
					$.ajax({
				method:"get",
				url:"usersearch.php",
				success:function(html){
					$(".userlist").html(html)
				},
				error:function(){
					alert("error")
				}
			})
		}
    })
</script>