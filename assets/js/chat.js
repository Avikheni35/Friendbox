$(document).ready(function () {

    $.ajax({
        method: "get",
        url: "api/chatlist.php",
        success: function (html) { $(".message-list").html(html) },
        error: function () { alert("error") }
    })

    $('#search').keyup(function () {
        var search = $('#search').val()
        $.ajax({
            method: "get",
            url: "api/chatlist.php",
            data: { search: search },
            success: function (html) { $(".message-list").html(html) },
            error: function () { alert("error") }
        })
    })
})
