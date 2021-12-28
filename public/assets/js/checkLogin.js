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
            ok.html("Login succesfully!");
            setTimeout(checkUser, 3600000);
        })
        .catch((error) => {
            console.log(error);
            $("#error").html("Login fail! Please login again!");
        });

    function checkUser() {
        $.ajax({
                url: "check-user",
                method: "post",
                data: "type=logout",
            })
            .then((response) => {
                if (response == "logout") {
                    ok.html("");
                    $("#error").html("Phiên đăng nhập của bạn sắp hết hạn, vui lòng đăng nhập lại sau 5s");
                    setTimeout(function() {
                        window.location.href = "logout";
                    }, 5000);

                }
            })
            .catch((error) => {
                console.log(error);
            });
    }
});