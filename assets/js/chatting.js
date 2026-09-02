$(document).ready(function () {
    var selected = ""

    $('.chat-box').on('click', function (e) {
        selected = e.currentTarget.firstChild.nextElementSibling.value

        $.ajax({
            method: "get",
            url: "api/chatting.php",
            data: { selected: selected },
            success: function (html) {
                $(".person-chat").html(html)
                $.ajax({
                    method: "get",
                    url: "api/chathead.php",
                    success: function (html) { $(".active-inbox-header").html(html) },
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
