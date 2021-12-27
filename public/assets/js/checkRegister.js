$("#btn-submit").on("click", function() {
    event.preventDefault();

    const username = $("#username").val();
    const email = $("#email").val();
    const password = $("#password").val();
    const conPassword = $("#conpassword").val();
    const ok = $("#ok");
    const error = $("#error");

    ok.html("");
    error.html("");

    if (username == "" || password == "" || password == "" || conPassword == "") {
        error.html("username and password can't be blank");
        return false;
    }
    if (password !== conPassword) {
        error.html("Confirm Password should match with the Password");
        return false;
    }

    $.ajax({
            url: "post-register",
            method: "post",
            dataType: "json",
            data: {
                username: username,
                email: email,
                password: password,
                conPassword: conPassword,
            },
        })
        .then((response) => {
            ok.html("Create account successfully!");
        })
        .catch((error) => {
            $("#error").html("Something wrong! Please login again!");
        });
});