<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Friendbox</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/left-sidebar.css" />
    <link rel="stylesheet" href="css/right-sidebar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="chat.js"></script>
    <script src="chatting.js"></script>
    <script src="send.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php 
     
    ?>
  
</head>

<body>
    <div class="container-flexbox">
        <div class="left-sidebar">
            <div class="header">
                <div>
                    <a href="http://localhost/Friendbox/index.php" style="color:white"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <div style="display:flex;align-items:center;gap:10px">
                    <h3><?php echo $_SESSION['username'] ?></h3>
                    <div><img class="profile-pic" src="./userdata/profileimg/<?php echo $_SESSION['profile']?>" /></div>
                </div>
                
            </div>

            <div class="search-flexbox">
                <div class="search-div">
                    <button class="search-button">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                    <input class="searchbar" id="search" type="search " placeholder="Search to start new chat " />
                </div>
                
            </div>

            <div class="message-list">

            </div>
        </div>

        <div class="right-sidebar">
            <div class="active-inbox-header">

            </div>

            <div class="chat">
                <div class="person-chat">

                </div>

                <div class="bottom-header">


                    <div class="searchbar-bottom-head">
                        <input class="searchbar-bottom-header" id="message" type="text " placeholder="Type a message" />
                    </div>
                    <div class="icon-bottom-header send" style="width: 50px">
                        <ion-icon name="paper-plane-outline"></ion-icon>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>