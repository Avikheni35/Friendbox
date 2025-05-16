$(document).ready(function(){
    $(".comment").click(function(e){
        pid = e.target.nextElementSibling.value
        // console.log(pid)
        $.post("comments.php",
        {
            pid:pid
        },
        function(html){
            $(".commentsmodal .top").html(html)   
        }
        ) 
        var comment = document.getElementById('cmtmsg')
        comment.addEventListener("input", function(e){
            cmt = comment.value
        });
    })
    

    $(".commentbtn").click(function(e){
        $.post("comments.php",
        {
            pid:pid,
            cmt:cmt
        },
        function(html){
            $(".commentsmodal .top").html(html)  
        }
        ) 
    })

    
    var source
    $(".sharepost").click(function(e){
        source = e.target.nextElementSibling.value
        // console.log(source)
        
    })

    $(".sharebtn").click(function(e){
        selected = e.target.nextElementSibling.value
        console.log(selected)
        console.log(source)
        $.post("send.php",
        {
            source:source,
            shareto:selected
        },
        function(html){
            // $(".commentsmodal .top").html(html)   
        }
        ) 
    })

})