$(document).ready(function () {

    $.ajax({
        method: "POST",
        url: "api/total.php",
        success: function (html) { $(".total").html(html) },
        error: function () { alert("error") }
    })

    if (window.location.pathname.endsWith("/friends.php")) {
        $.ajax({
            method: "POST",
            url: "api/allfriends.php",
            success: function (html) { $("#frends").html(html) },
            error: function () { alert("error") }
        })
        $.ajax({
            method: "POST",
            url: "api/followers.php",
            success: function (html) { $("#frends-req").html(html) },
            error: function () { alert("error") }
        })
    }

    if (window.location.pathname.endsWith("/saved.php")) {
        $.ajax({
            method: "get",
            url: "api/bookmarkfeed.php",
            data: { req: 'saved' },
            success: function (html) { $(".load").html(html) },
            error: function () { alert("error") }
        })
    }

    $.ajax({
        method: "post",
        url: "api/friendlist.php",
        success: function (html) { $(".listbox").html(html) },
        error: function () { alert("error") }
    })

    $.ajax({
        method: "POST",
        url: "api/suggestionsdata.php",
        success: function (html) {
            $(".suggestions").html(html)
            $(".indexsugg").html(html)
        },
        error: function () { alert("error") }
    })

    var urlParams = new URLSearchParams(window.location.search)
    var username  = urlParams.get('viewprofile')

    if (username != null) {
        $.ajax({
            method: "get",
            url: "api/indexfeed.php",
            data: { viewprofile: username },
            success: function (html) { $(".loadMore").html(html) },
            error: function () { alert("error") }
        })
    } else {
        $.ajax({
            method: "POST",
            url: "api/indexfeed.php",
            success: function (html) { $(".loadMore").html(html) },
            error: function () { alert("error") }
        })
    }
})
