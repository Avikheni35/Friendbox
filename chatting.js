$(document).ready(function(){
    selected = ""
    $('.chat-box').on('click',function(e){
             selected = e.currentTarget.firstChild.nextElementSibling.value
            
            $.ajax({
                method:"get",
                url:"chatting.php",
                data:{
                    selected:selected
                },
                success:function(html){
                    
                    $(".person-chat").html(html)
                    $.ajax({
                        method:"get",
                        url:"chathead.php",
                        success:function(html){
                            $(".active-inbox-header").html(html)
                        },
                        error:function(){
                            alert("error")
                        }
                    })
                    $.ajax({
                        method:"get",
                        url:"chatlist.php",
                        success:function(html){
                            $(".message-list").html(html)
                        },
                        error:function(){
                            alert("error")
                        }
                    })

                },
                error:function(){
                    alert("error")
                }
            })
        
    })
    // if(selected!=null){
    // setInterval(chats,1000)
        function chats(){
            // console.log("first")
            // const selected = e.currentTarget.firstChild.nextElementSibling.value
            // console.log(selected)
            $.ajax({
                method:"get",
                url:"chatting.php",
                success:function(html){
                    $(".person-chat").html(html)
                },
                error:function(){
                    alert("error")
                }
            })
        }
    // }
})