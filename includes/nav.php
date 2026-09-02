<style>
    .userlist {
        background-color: white;
        padding: 10px;
        height: 50vh;
        overflow-y: scroll;

        .searchuser {
            padding: 10px 0px;
            display: flex;

            button {
                position: relative;
                right: 0px;
                top: 0px;
                color: #088dcd
            }
        }
    }

    .userlist .friend-meta {
        display: flex;
        justify-content: space-between;
        width: -webkit-fill-available;

        h6 { margin-bottom: 0px; }
        p  { margin-bottom: 0px; }
    }

    .userlist .searchuser img {
        width: 50px;
        border-radius: 50%;
        height: 50px;
    }

    .form-search { text-align: justify; }
</style>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require(__DIR__ . '/config.php');
$profile = isset($_SESSION['profile']) ? $_SESSION['profile'] : '';
?>

<div class="topbar stick">
    <div class="logo">
        <a title="" href="index.php"><h2 style="font-family: cursive;">FRIENDBOX</h2></a>
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
                        <div style="list-style:none" class="userlist"></div>
                    </form>
                </div>
            </li>
            <li><a href="index.php" title="Home" data-ripple><i class="ti-home"></i></a></li>
        </ul>
        <div class="user-img">
            <img src="./uploads/profileimg/<?php echo htmlspecialchars($profile); ?>" style="height:50px; width:50px" alt="">
            <span class="status f-online"></span>
        </div>
    </div>
</div>

<script>
    $('.ti-search').click(function () {
        if ($('.searched').hasClass("active")) {
            $('.searched').removeClass("active")
        } else {
            $('.searched').addClass("active")
            $.ajax({
                method: "get",
                url: "api/usersearch.php",
                success: function (html) {
                    $(".userlist").html(html)
                },
                error: function () {
                    alert("error")
                }
            })
        }
    })
</script>
