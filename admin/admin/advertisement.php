<?php
    require('config.php');
    if(isset($_POST['advertise'])){
        $brand = $_POST['bname'];
        $link = $_POST['weblink'];
        $dest = '../advertise';
        $fileName = $_FILES["brandimg"]['name'];
		$fileTempName = $_FILES['brandimg']['tmp_name'];
		$basename =  basename($_FILES["brandimg"]["name"]);
		move_uploaded_file($fileTempName,"$dest/$basename");
        $sql = "insert into advertise (brand,image,link) values('$brand','$basename','$link')";
        $result = mysqli_query($conn,$sql);

    }

    $sql = "select * from advertise order by ad_id desc limit 1";
    $data = mysqli_query($conn,$sql);
    foreach($data as $row){
        $brand = $row['brand'];
        $image = $row['image'];
        $link = $row['link'];
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="login.css">

</head>
<style>
h1 {
    margin: 15px;
}

.addadv {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
}

form {
    width: 70vw;
    height: 70vh;
    background-color: white;
    display: flex;
    justify-content: space-around;
    box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
}

.current {
    h1{
    font-size: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #000;
    font-weight: 700;
    position:relative;
    margin-top: 10px;
    }
    h1::after{
        background: #e3b04b;
        bottom: 0;
        content: "";
        height: 2px;
        left: 0px;
        position: absolute;
        width: 50%;
    }
    h4{
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #000;
        font-weight: 600;
        position:relative;
    }
    h4::after{
        background: #e3b04b;
        bottom: 0;
        content: "";
        height: 2px;
        left: 0px;
        position: absolute;
        width: 10%;
    }

}
.advertisement{
    margin-top: 40px;
    border:1px solid black;
    padding:35px;
}
.activity-meta{
    img{
        height:32vh;
        width:auto
    }
}

.advertise {
    background-color: white;
    width: fit-content;
    display: flex;
    flex-direction: column;
    justify-content: center;

}
</style>

<body>
    <div class="content">
        <?php require("sidenav.php") ?>
        <div class="container-fluid">
            <div class="header">
                <h1>Advertisement</h1>
                <div class="profile">
                    <button><a href="logout.php">logout</a></button>
                </div>
            </div>
            <div class="addadv">

                <form action="" class="signin-form" method="post" enctype="multipart/form-data">
                    <div class="current">
                        <h1>current advertisement</h1>
                        <div class="advertisement">
                            <h4 class="widget-title"><?php echo $brand ?></h4>
                            <div class="activity-meta">
                                <img src="../advertise/<?php echo $image ?>" alt="">
                                <div class="viewstripe">
                                    <a href="<?php echo $link ?>" class="stripe">
                                        <span>Visit Website</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="advertise">
                        <div class="form-group mb-3">
                            <label class="label" for="bname">Brand Name :</label>
                            <input type="text" name="bname" class="form-control" placeholder="Brand Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="brandimg">Brand Photo :</label>
                            <input type="file" name="brandimg" class="form-control" placeholder="Brand Photo" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="weblink">Website Link :</label>
                            <input type="text" name="weblink" class="form-control" placeholder="Website Link" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="advertise"
                                class="form-control btn btn-primary rounded submit px-3">Advertise</button>
                        </div>
                    </div>
                </form>



            </div>

        </div>
    </div>

</body>

</html>