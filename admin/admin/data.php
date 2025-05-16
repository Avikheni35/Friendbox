<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>

<?php
    require("config.php");
    error_reporting(E_ERROR | E_PARSE);
    


    if($_POST["reqfrom"]=="users"){
        ?>
<div class="users">
    <table>
        <thead>
            <tr>
                <th>user name</th>
                <th>password</th>
                <th>Name</th>
                <th>phone no.</th>
                <th>Email</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <?php
            require("config.php");
            if(isset($_POST["search"])){
                $search = $_POST["search"];
                $query="select * from users where username like '%$search%' ";

            }
            else{
                $query="select * from users";
            }
            $result = mysqli_query($conn,$query);
            foreach($result as $row){
                ?>
        <tr>
            <td><?php echo $row["username"] ?></td>
            <td><?php echo $row["password"] ?></td>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["phone"] ?></td>
            <td style="min-width:130px;"><?php echo $row["email"] ?></td>
            <?php if($row['status']=='blocked'){
                ?>
                <td ><form action="">
                <button name="block" type="button" value="<?php echo $row["username"] ?>">Blocked</button>
                </form></td>
                <?php
            }
            else{
                
                ?>
                <td ><form action="users.php">
                <button name="block" type="submit" value="<?php echo $row["username"] ?>">Block user</button>
                </form></td>
                <?php
            }
             ?>
            
            <td><form action="userfriends.php">
            <button name="viewprofile" type="submit" value="<?php echo $row["username"] ?>">View Profile</button>
            </form></td>
           

        </tr>
        <?php
            }
            ?>
    </table>
</div>
</div>

<?php
    }
?>

<?php               
    if($_POST["blockusers"]=="users"){
        ?>
<div class="users">
    <table>
        <thead>
            <tr>
                <th>user name</th>
                <th>password</th>
                <th>Name</th>
                <th>phone no.</th>
                <th>Email</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <?php
            require("config.php");
            if(isset($_POST["search"])){
                $search = $_POST["search"];
                $query="select * from users where username like '%$search%' and status = 'blocked' ";
            }
            else{
                $query="select * from users where status = 'blocked'";
            }
            $result = mysqli_query($conn,$query);

            foreach($result as $row){
                // $buser = $row['username'];
                // $sqli="select * from users where username = '$buser'  ";
                // $data = mysqli_query($conn,$sqli);
                // echo $buser;
                    // foreach($data as $r){
                    //     $name = $r['name'];
                    //     $phone = $r['phone'];
                    //     $email = $r['email'];
                        
                    // }
                
                ?>
        <tr>
            <td><?php echo $row["username"] ?></td>
            <td><?php echo $row["password"] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['password'] ?></td>
            <td style="min-width:130px;"><?php echo $row["email"] ?></td>
            <td ><form action="block.php">
                <button name="unblock" type="submit" value="<?php echo $row["username"] ?>">Unblock</button>
            </form></td>
            <!-- <td><form action="friends.php">
            <button name="viewprofile" type="submit" value="<?php echo $row["username"] ?>">View Profile</button>
            </form></td> -->
           

        </tr>
        <?php
            }
            ?>
    </table>
</div>
</div>

<?php
    }
?>