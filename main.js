$(document).ready(function(){
    
    $.ajax({
        method:"POST",
        url:"total.php",
        success:function(html){
            $(".total").html(html)
            // alert("hello")
        },
        error:function(){
            alert("error")
        }
    })
    path = window.location.pathname
    if(path == "/Friendbox/friends.php"){
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
        if(path == "/Friendbox/friends.php"){
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
        }
    }

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

    const urlParams = new URLSearchParams(window.location.search);
    const username = urlParams.get('viewprofile');
    // const age = urlParams.get('age');
    // console.log(name)
    if(username!=null){
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

    
        
  });
//   console.log(window.location.href)
    
  