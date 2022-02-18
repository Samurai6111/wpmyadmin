$(function() {
    var url = new URL(window.location.href);
    var params = url.searchParams;
    var form = params.get("form");

    if (form) {
        var deletes = params.get("deletes");

        if (deletes) {
            var message = deletes + "件削除されました";
        }

        alert(message);

        setTimeout(function() {
            params.delete("form");
            history.replaceState("", "", url.pathname);
        }, 3000);
    }
});