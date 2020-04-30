$(document).ready(function () {
    $("#scrollbtn").click(function (event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });
});