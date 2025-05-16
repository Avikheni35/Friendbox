$(document).ready(function(){

    var url = window.location.pathname;
  
     if(url=="/friendbox/admin/admin/users.php"){ 
        $.ajax({
            method:"POST",
            url:"data.php",
            data:{
                reqfrom:"users"
            },
            success:function(html){
                $(".user").html(html)
            }
            })

        $("#usersearch").keyup(function(){
        var searchval = $("#usersearch").val();
        $.ajax({
            method:"POST",
            url:"data.php",
            data:{
                reqfrom:"users",
                search:searchval
            },
            success:function(html){
                $(".user").html(html)
            }
            })
            })    
    }
    else if(url=="/friendbox/admin/admin/block.php"){ 
        $.ajax({
            method:"POST",
            url:"data.php",
            data:{
                blockusers:"users"
            },
            success:function(html){
                $(".user").html(html)
            }
            })

        $("#usersearch").keyup(function(){
        var searchval = $("#usersearch").val();
        $.ajax({
            method:"POST",
            url:"data.php",
            data:{
                blockusers:"users",
                search:searchval
            },
            success:function(html){
                $(".user").html(html)
            }
            })
            })    
    }
    


    
})