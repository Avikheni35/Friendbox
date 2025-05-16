function reload(){
    $.ajax({
        method:"POST",
        url:"total.php",
        success:function(html){
            $(".total").html(html)
        },
        error:function(){
            alert("error")
        }
    })
    $.ajax({
        method:"POST",
        url:"allfriends.php",
        success:function(html){
            $("#frends").html(html)
        },
        error:function(){
            alert("error")
        }
    })
    $.ajax({
        method:"POST",
        url:"followers.php",
        success:function(html){
            $("#frends-req").html(html)
        },
        error:function(){
            alert("error")
        }
    })
    $.ajax({
        method:"post",
        url:"friendlist.php",
        success:function(html){
            $(".listbox").html(html)
            // console.log(html)
        },
        error:function(){
            alert("error")
        }
    })

    $.ajax({
        method:"POST",
        url:"suggestionsdata.php",
        success:function(html){
            $(".suggestions").html(html)
        },
        error:function(){
            alert("error")
        }
    })

    

    $.ajax({
        method:"POST",
        url:"suggestionsdata.php",
        success:function(html){
            $(".indexsugg").html(html)
        },
        error:function(){
            alert("error")
        }
    })

    

}

$(document).ready(function(){
    path = window.location.pathname

// $(".sharepost").click(function(e){
//     alert(e.target.parentNode)
// })

// $(".sharebtn").click(function(e){
//     alert(e.target.value)
// })

$(".like").on('click',(e)=>{
    liked = e.target.nextElementSibling
    likedpost =liked.nextElementSibling.value
    console.log(likedpost)
    
    $.post("like.php",
    {
        pid:likedpost
    },
    function(){
        // console.log("success")
        const urlParams = new URLSearchParams(window.location.search);
                const username = urlParams.get('viewprofile');
                // const age = urlParams.get('age');
                // console.log(name)
                
                path = window.location.pathname
                if(path == "/Friendbox/saved.php"){
                    $.ajax({
                        method:"get",
                        url:"indexfeed.php",
                        data:{
                            req:'saved'
                        },
                        success:function(html){
                            $(".loadMore").html(html)
                        },
                        error:function(){
                            alert("error")
                        }
                    
                    })
                }
                else if(username!=null){
                    $.ajax({
                        method:"get",
                        url:"indexfeed.php",
                        data:{
                            viewprofile:username
                        },
                        success:function(html){
                            $(".loadMore").html(html)
                        },
                        error:function(){
                            alert("error")
                        }
                        })
                }
                else{
                    $.ajax({
                        method:"POST",
                        url:"indexfeed.php",
                        success:function(html){
                            $(".loadMore").html(html)
                        },
                        error:function(){
                            alert("error")
                        }
                        })
                }
    }
    
    )
   
})

$(".save").on('click',(e)=>{
    saved = e.target.nextElementSibling
    savedpost =saved.value
    console.log(savedpost)
    
    $.post("bookmark.php",
    {
        pid:savedpost
    },
    function(){
       
        path = window.location.pathname
        if(path == "/Friendbox/saved.php"){
            $.ajax({
                method:"get",
                url:"bookmarkfeed.php",
                data:{
                    req:'saved'
                },
                success:function(html){
                    $(".load").html(html)
                },
                error:function(){
                    alert("error")
                }
            
            })
        }
        else{
        $.ajax({
            method:"get",
            url:"indexfeed.php",
            success:function(html){
                $(".loadMore").html(html)
            },
            error:function(){
                alert("error")
            }
        
        })
        }

              
        }
    )
   
})

// add user
$(".addbtn").on("click",function(e){
    adduser = e.target.value
    $.post("addfriends.php",
    {
        user:adduser
    },
    function(){
       reload()
       console.log("added")
    }
    
    ) 
})

// unfriend user from followings

$(".unfriend").click((e)=>{
    removeuser = e.target.value
    // alert("unfriend")
    $.post("unfriend.php",
    {
        user:removeuser
    },
    function(){
        reload()
    }
    
    ) 
})

// remove user from followers

$(".remove").click((e)=>{
    removeuser = e.target.value
    $.post("remove.php",
    {
        remove:removeuser
    },
    function(){
        $.ajax({
            method:"POST",
            url:"followers.php",
            success:function(html){
                $("#frends-req").html(html)
            },
            error:function(){
                alert("error")
            }
        })
        $.ajax({
            method:"POST",
            url:"total.php",
            success:function(html){
                $(".total").html(html)
                $('.followers a').addClass("active")
                $('.followings a').removeClass("active")
            },
            error:function(){
                alert("error")
            }
        })
    }
    
    ) 
})

$(".likedby").click((e)=>{
    pid = e.target.nextElementSibling.value
    $.post("likedby.php",
    {
        pid:pid
    },
    function(html){
        $(".modal").html(html)
    }
    ) 
})

$('.searchuser').keyup(function(){
    var search = $('.searchuser').val()
    $.ajax({
        method:"get",
        url:"usersearch.php",
        data:{
            search:search
        },
        success:function(html){
            $(".userlist").html(html)
        },
        error:function(){
            alert("error")
        }
    })
})



})

