<!DOCTYPE html>
<html>

<head>
    <title>Whatsapp web</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/left-sidebar.css" />
    <link rel="stylesheet" href="css/right-sidebar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="chat.js"></script>
    <script src="chatting.js"></script>
    <script src="send.js"></script>

    <?php 
     
    ?>
    <!-- <style></style> -->
</head>

<body>
    <div class="container-flexbox">
        <div class="left-sidebar">
            <div class="header">
                <div><img class="profile-pic" src="Images/girl.jpg" /></div>

                <!-- <div class="icons">
                    <div class="icon-pic-div">
                        <ion-icon name="people-outline"></ion-icon>
                        <div class="tooltip">Communities</div>
                    </div>
                    <div class="icon-pic-div">
                        <ion-icon name="sync-circle-outline"></ion-icon>
                        <div class="tooltip">Status</div>
                    </div>

                    <div class="icon-pic-div">
                        <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                        <div class="tooltip">New chat</div>
                    </div>
                    <div class="icon-pic-div">
                        <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                        <div class="tooltip">Menu</div>
                    </div>
                </div> -->
            </div>

            <div class="search-flexbox">
                <div class="search-div">
                    <button class="search-button">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                    <input class="searchbar" id="search" type="search " placeholder="Search or start new chat " />
                </div>
                <div class="filter">
                    <ion-icon name="filter-outline"></ion-icon>
                    <div class="tooltip">Unread chat filter</div>
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