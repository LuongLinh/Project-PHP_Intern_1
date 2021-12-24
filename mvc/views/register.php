<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <form class="form-login" id="main" action="/post-register" method="post" novalidate>
        <div>
            <?php echo !empty($fail) ? "<h3 style=\"color: red; text-align: center;\">" . $fail . "</h3>" : false; ?>

            <?php echo !empty($errors) ? "<h3 style=\"color: red; text-align: center;\">" . $msg . "</h3>" : false; ?>

            <h3 class="title">CREATE YOUR ACCOUNT</h3>
            <div class="form-group">
                <label for="use" class="form-label">Username</label>
                <input type="text" name="username" id="usernames" class="form-control" placeholder="Username" value="<?php if (!empty($errors)) {
                                                                                                                            echo $_POST["username"];
                                                                                                                        } ?>">
                <?php echo (!empty($errors) && array_key_exists("username", $errors)) ? "<div class=\"messages\">" . $errors["username"] . "</div>" : false; ?>
                <div class="messages"></div>
            </div>

            <div class="form-group">
                <label for="user" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php if (!empty($errors)) {
                                                                                                                            echo $_POST["email"];
                                                                                                                        } ?>">
                <?php echo (!empty($errors) && array_key_exists("email", $errors)) ? "<div class=\"messages\">" . $errors["email"] . "</div>" : false; ?>
                <div class="messages"></div>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <?php echo (!empty($errors) && array_key_exists("password", $errors)) ? "<div class=\"messages\">" . $errors["password"] . "</div>" : false; ?>
                <div class="messages"></div>
            </div>

            <div class="form-group">
                <label for="conpassword" class="form-label">Confirm password</label>
                <input type="password" name="confirm-password" id="conpassword" class="form-control">
                <?php echo (!empty($errors) && array_key_exists("confirm-password", $errors)) ? "<div class=\"messages\">" . $errors["confirm-password"] . "</div>" : false; ?>
                <div class="messages"></div>
            </div>

            <div>
                <button type="submit" class="btn-submit">Submit</button>
            </div>
            <div>
                <p class="signup">Already have account? <a href="/login">Sign in</a>.</p>

            </div>
    </form>

    <script src="../node_modules/validate.js/validate.js"></script>
    <script src="../js/register.js"></script>
</body>

</html>