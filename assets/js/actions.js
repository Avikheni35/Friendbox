function reload() {
    $.ajax({ method: "POST", url: "api/total.php",        success: function (html) { $(".total").html(html) },      error: function () { alert("error") } })
    $.ajax({ method: "POST", url: "api/allfriends.php",   success: function (html) { $("#frends").html(html) },     error: function () { alert("error") } })
    $.ajax({ method: "POST", url: "api/followers.php",    success: function (html) { $("#frends-req").html(html) }, error: function () { alert("error") } })
    $.ajax({ method: "post", url: "api/friendlist.php",   success: function (html) { $(".listbox").html(html) },    error: function () { alert("error") } })
    $.ajax({
        method: "POST",
        url: "api/suggestionsdata.php",
        success: function (html) {
            $(".suggestions").html(html)
            $(".indexsugg").html(html)
        },
        error: function () { alert("error") }
    })
}

$(document).ready(function () {

    $(".like").on('click', function (e) {
        var liked    = e.target.nextElementSibling
        var likedpost = liked.nextElementSibling.value

        $.post("api/like.php", { pid: likedpost }, function () {
            var urlParams = new URLSearchParams(window.location.search)
            var username  = urlParams.get('viewprofile')

            if (window.location.pathname.endsWith("/saved.php")) {
                $.ajax({ method: "get", url: "api/indexfeed.php", data: { req: 'saved' },
                    success: function (html) { $(".loadMore").html(html) }, error: function () { alert("error") } })
            } else if (username != null) {
                $.ajax({ method: "get", url: "api/indexfeed.php", data: { viewprofile: username },
                    success: function (html) { $(".loadMore").html(html) }, error: function () { alert("error") } })
            } else {
                $.ajax({ method: "POST", url: "api/indexfeed.php",
                    success: function (html) { $(".loadMore").html(html) }, error: function () { alert("error") } })
            }
        })
    })

    $(".save").on('click', function (e) {
        var savedpost = e.target.nextElementSibling.value

        $.post("api/bookmark.php", { pid: savedpost }, function () {
            if (window.location.pathname.endsWith("/saved.php")) {
                $.ajax({ method: "get", url: "api/bookmarkfeed.php", data: { req: 'saved' },
                    success: function (html) { $(".load").html(html) }, error: function () { alert("error") } })
            } else {
                $.ajax({ method: "get", url: "api/indexfeed.php",
                    success: function (html) { $(".loadMore").html(html) }, error: function () { alert("error") } })
            }
        })
    })

    $(".addbtn").on("click", function (e) {
        $.post("api/addfriends.php", { user: e.target.value }, function () {
            reload()
        })
    })

    $(".unfriend").click(function (e) {
        $.post("api/unfriend.php", { user: e.target.value }, function () { reload() })
    })

    $(".remove").click(function (e) {
        $.post("api/remove.php", { remove: e.target.value }, function () {
            $.ajax({ method: "POST", url: "api/followers.php",
                success: function (html) { $("#frends-req").html(html) }, error: function () { alert("error") } })
            $.ajax({ method: "POST", url: "api/total.php",
                success: function (html) {
                    $(".total").html(html)
                    $('.followers a').addClass("active")
                    $('.followings a').removeClass("active")
                },
                error: function () { alert("error") }
            })
        })
    })

    $(".likedby").click(function (e) {
        var pid = e.target.nextElementSibling.value
        $.post("api/likedby.php", { pid: pid }, function (html) { $(".modal").html(html) })
    })

    $('.searchuser').keyup(function () {
        var search = $('.searchuser').val()
        $.ajax({
            method: "get",
            url: "api/usersearch.php",
            data: { search: search },
            success: function (html) { $(".userlist").html(html) },
            error: function () { alert("error") }
        })
    })
})
