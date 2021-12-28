<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <form class="form-login" id="main" action="post-login" method="post" novalidate>
        <div>
            <?php echo !empty($data["msgLoginToPost"]) ? "<h3 style=\"color: red; text-align: center;\">" . $msgLoginToPost . "</h3>" : false; ?>

            <?php echo !empty($data["loginFail"]) ? "<h3 style=\"color: red; text-align: center;\">" . $loginFail . "</h3>" : false; ?>
            <?php echo !empty($errors) ? "<h3 style=\"color: red; text-align: center;\">" . $msg . "</h3>" : false; ?>
            <?php echo !empty($data["success"]) ? "<h3 style=\"color: green; text-align: center;\">" . $success . "</h3>" : false; ?>

            <h3 id="ok" style="color: green; text-align: center; font-family: monospace"> </h3>
            <h3 id="error" style="color: red; text-align: center; font-family: monospace;"> </h3>

            <h3 class="title">LOGIN</h3>
            <div class="form-group">
                <label for="use" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php if (!empty($errors) && isset($_POST["username"])) {
                                                                                                                        echo $_POST["username"];
                                                                                                                    } ?>">
                <?php echo (!empty($errors) && array_key_exists("username", $errors)) ? "<div class=\"messages\">" . $errors["username"] . "</div>" : false; ?>
                <div class="messages"></div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <?php echo (!empty($errors) && array_key_exists("password", $errors)) ? "<div class=\"messages\">" . $errors["password"] . "</div>" : false; ?>
                <div class="messages"></div>
            </div>
            <div class="form-group">
                <p>
                    <input type="checkbox" class="remember"> Remember me?
                </p>
            </div>
            <div>
                <button type="submit" class="btn-submit" id="btn-submit">Submit</button>
            </div>
            <div>
                <p class="signup">Already have account? <a href="/register">Sign up</a>.</p>

            </div>
    </form>

    <script src="../node_modules/validate.js/validate.js"></script>
    <script src="../js/login.js"></script>
    <script src="../assets/js/checkLogin.js"></script>
</body>

</html>