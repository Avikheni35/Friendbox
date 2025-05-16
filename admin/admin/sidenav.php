<link rel="stylesheet" href="nav.css">
<style>
    .gap{
        padding-bottom: 0;
    }
    .nearly-pepls figure img{
        width:50px !important;
        height:50px !important;
        object-fit:cover;
    }
</style>
<nav>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div class="upper">
        <div class="nav static">
            <div class="image">
                <img src="../assets/custom/images/admin.JPG" style="border-radius:50%/50%;" width=100px height=100 alt="">
            </div>
            <div class="menus">
                <ul>
                    <li <?php if($_SERVER['SCRIPT_NAME']=="/friendbox/admin/admin/users.php") { ?> class="active"
                        <?php   }  ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i><a
                            href="/friendbox/admin/admin/users.php">users</a></li>
                    <li <?php if($_SERVER['SCRIPT_NAME']=="/friendbox/admin/admin/block.php") { ?> class="active"
                        <?php   }  ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i><a
                            href="/friendbox/admin/admin/block.php">blocked users</a></li>
                    <li <?php if($_SERVER['SCRIPT_NAME']=="/friendbox/admin/admin/advertisement.php") { ?> class="active"
                        <?php   }  ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i><a
                    href="/friendbox/admin/admin/advertisement.php">Advertisement</a></li>

                    <!-- <li <?php if($_SERVER['SCRIPT_NAME']=="/friendbox/admin/admin/allbookings.php") { ?>  class="active"   <?php   }  ?>><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="/friendbox/admin/admin/allbookings.php">old bookings</a></li> -->
                </ul>
            </div>
        </div>
    </div>
</nav>