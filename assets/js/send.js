$(document).ready(function () {
    var msg = ''
    var message = document.getElementById('message')

    message.addEventListener("input", function () {
        msg = message.value
    })

    $('.send').on('click', function () {
        $.ajax({
            method: "post",
            url: "api/send.php",
            data: { message: msg },
            success: function () {
                message.value = ""
                $.ajax({
                    method: "POST",
                    url: "api/chatting.php",
                    success: function (html) { $(".person-chat").html(html) },
                    error: function () { alert("error") }
                })
                $.ajax({
                    method: "get",
                    url: "api/chatlist.php",
                    success: function (html) { $(".message-list").html(html) },
                    error: function () { alert("error") }
                })
            },
            error: function () { alert("error") }
        })
    })
})
