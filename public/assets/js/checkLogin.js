$("#btn-submit").on("click", function() {
    event.preventDefault();
    const username = $("#username").val();
    const password = $("#password").val();
    const ok = $("#ok");
    const error = $("#error");

    ok.html("");
    error.html("");

    if (username == "" || password == "") {
        error.html("username and password can't be blank");
        return false;
    }

    $.ajax({
            url: "post-login",
            method: "post",
            dataType: "json",
            data: { username: username, password: password },
        })
        .then((response) => {
            ok.html("Login successfully!");
        })
        .catch((error) => {
            $("#error").html("Login fail! Please login again!");
        });
});