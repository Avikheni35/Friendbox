$(document).ready(function () {
    var pid = 0
    var cmt = ''

    $(".comment").click(function (e) {
        pid = e.target.nextElementSibling.value
        $.post("api/comments.php", { pid: pid }, function (html) {
            $(".commentsmodal .top").html(html)
        })
        var commentEl = document.getElementById('cmtmsg')
        commentEl.addEventListener("input", function () {
            cmt = commentEl.value
        })
    })

    $(".commentbtn").click(function () {
        $.post("api/comments.php", { pid: pid, cmt: cmt }, function (html) {
            $(".commentsmodal .top").html(html)
        })
    })

    var source
    $(".sharepost").click(function (e) {
        source = e.target.nextElementSibling.value
    })

    $(".sharebtn").click(function (e) {
        var selected = e.target.nextElementSibling.value
        $.post("api/send.php", { source: source, shareto: selected })
    })
})
