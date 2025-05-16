// send message
$(document).ready(function(){


var message = document.getElementById('message')

message.addEventListener("input", function(e){
    msg = message.value
});
$('.send').on('click',function(){
    
    let x = msg
    $.ajax({
        method:"post",
        url:"send.php",
        data:{
            message:x
        },
        success:function(){
            message.value=""
            $.ajax({
                method:"POST",
                url:"chatting.php",
                success:function(html){
                    $(".person-chat").html(html)
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
})