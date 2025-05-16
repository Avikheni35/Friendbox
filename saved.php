<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Friendbox</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="main.js"></script>
	<script src="actions.js"></script>
    <style>
		.timeline-info .admin-name > span {
			bottom:15px
		}
        .static {
        position: sticky !important;
        top: 70px;
    }
	.friend-name button {
        background-color: transparent;
        color: black;
        margin: 0;
        padding: 0;
        font-size: medium;
		border:none
    }
	.top{
		height:55vh;
		max-height:55vh;
		overflow-y:scroll;
		margin-bottom:47px;
		li{
			margin:10px 10px 10px 0px;
		}
	}
    </style>
</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
		<?php
			// include("nav.php");
			// include("profileheader.php");  
		?>
		
	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">
							<?php
								include("sidenav.php");
							?>
							<div class="col-lg-6 loadMor load" >
                                
                            </div>
                            <?php
                            include("suggestions.php");
                        ?>
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

	<?php  include("footer.php"); ?>
</div>
	
	
	<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="js/main.min.js"></script>
	<script src="js/script.js"></script>


</body>	


</html>