<?php
	session_start();
    require("config.php");
    $user = $_SESSION['username'];
    $sql = "select * from users where username = '$user'";
    $data = mysqli_query($conn,$sql);
    foreach($data as $row){
        $name = $row['name'];
        $pass = $row['password'];
        $phone = $row['phone'];
        $email = $row['email'];
        $profile = $row['profile'];
        $coverpic = $row['coverpic'];
    }
    if(isset($_POST['update'])){
        $dest = "./userdata/profileimg";
        $dest2 = "./userdata/coverimg";
        $name = $_POST["name"];
		$username = $_POST["username"];
		$email = $_POST["email"];
		$pass = $_POST["password"];
		$phone = $_POST["phone"];
        $_SESSION['name'] = $name;
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $fileName = $_FILES["file"]['name'];
		    $fileTempName = $_FILES['file']['tmp_name'];
		    $basename =  basename($_FILES["file"]["name"]);
            move_uploaded_file($fileTempName,"$dest/$basename");
            $_SESSION['profile'] = $basename;
        }
        else{
            $basename =  $_POST['filedefault'];
        }

        if(is_uploaded_file($_FILES['cover']['tmp_name'])){
            $fileName = $_FILES["cover"]['name'];
		    $fileTempName = $_FILES['cover']['tmp_name'];
		    $basename2 =  basename($_FILES["cover"]["name"]);
            move_uploaded_file($fileTempName,"$dest2/$basename");
            $_SESSION['coverpic'] = $basename2;
        }
        else{
            $basename2 =  $_POST['coverdefault'];
        }
		$sql = "update users set username='$username', name = '$name' ,phone = '$phone', email = '$email' , password = '$pass', profile = '$basename' , coverpic = '$basename2' where username = '$user'";
		$update = mysqli_query($conn,$sql);
	}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="main.js"></script>
    <script src="actions.js"></script>
    <style>
    .static {
        position: sticky !important;
        top: 70px;
    }

    span {
        bottom: 15px !important;
    }
    .updateform{
        display:flex;
        .left , .right{
            width:30vw;
            padding:40px
        }
        
    }
    .central-meta form {
        h1{
            font-size: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #000;
            font-weight: 700;
            position:relative;
            margin-top: 10px;
            padding-bottom: 5px;
        }
        h1::after{
            background: #088dcd;
            bottom: 0;
            content: "";
            height: 2px;
            left: 0px;
            position: absolute;
            width: 15%;
        }
    }

    </style>
</head>

<body>

    <div class="theme-layout">
		
        <?php
			include("nav.php");
			include("profileheader.php");
			if(isset($_GET['viewprofile'])){
				$user =  $_GET['viewprofile'];
			}else{
				$user = $_SESSION['username'];
			}
			$sql = "SELECT * from photos where username = '$user' order by pid desc ";
    		$result = $conn->query($sql);
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
                                <div class="col-lg-9">
                                    <div class="central-meta">

                                        <form method="post" enctype="multipart/form-data">
                                            <h1>Your Profile</h1>
                                            <div class="updateform">
                                            <div class="left">
                                                <div class="form-group">
                                                    <input type="text" name="name" required="required" value='<?php echo($name) ?>' />
                                                    <label class="control-label" for="input">First & Last Name</label><i
                                                        class="mtrl-select"></i>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="username" required="required" value="<?php echo $user ?>" />
                                                    <label class="control-label" for="input">User Name</label><i
                                                        class="mtrl-select"></i>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="password" required="required"  value="<?php echo $pass ?>" />
                                                    <label class="control-label" for="input">Password</label><i
                                                        class="mtrl-select"></i>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="phone" required="required" value="<?php echo $phone ?>" />
                                                    <label class="control-label" for="input">Mobile No.</label><i
                                                        class="mtrl-select"></i>
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="form-group" style="display:flex; align-items:center;">
                                                    <label for="file" class="btn">Select profile</label>
                                                    <input type="text" hidden="hidden" name="filedefault" required="required" value="<?php echo $profile ?>"/>
                                                    <input type="file" name="file"/>
                                                </div>

                                                <div class="form-group" style="display:flex; align-items:center;">
                                                    <label for="cover" class="btn">Select Cover photo</label>
                                                    <input type="hidden" name="coverdefault" required="required" value="<?php echo $coverpic ?>" />
                                                    <input type="file" name="cover"/>

                                                </div>

                                                <div class="form-group">
                                                    <input type="text" name="email" required="required" value="<?php echo $email ?>"
                                                     />
                                                    <label class="control-label" for="input"><a
                                                            href="https://wpkixx.com/cdn-cgi/l/email-protection"
                                                            class="__cf_email__"
                                                            data-cfemail="6c29010d05002c">[email&#160;protected]</a></label><i
                                                        class="mtrl-select"></i>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="submit-btns" style="text-align:center">
                                                <button class="btn btn-primry" type="submit"
                                                    name="update"><span>Update</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php  include("footer.php"); ?>
    </div>


    <!-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="js/main.min.js"></script>-->
    <!-- <script src="js/script.js"></script>  -->

</body>


</html>