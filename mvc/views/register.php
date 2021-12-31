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

    <form class="form-login" id="main" action="../post-register" method="post" novalidate>
        <div>
            <?php echo (!empty($fail) && isset($fail)) ? "<h3 style=\"color: red; text-align: center;\">" . $fail . "</h3>" : false; ?>

            <?php echo !empty($errors) ? "<h3 style=\"color: red; text-align: center;\">" . $msg . "</h3>" : false; ?>

            <h3 id="ok" style="color: green; text-align: center; font-family: monospace"> </h3>
            <h3 id="error" style="color: red; text-align: center; font-family: monospace;"> </h3>

            <h3 class="title">CREATE YOUR ACCOUNT</h3>
            <div class="form-group">
                <label for="use" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php if (!empty($errors) && isset($_POST["username"])) {
                                                                                                                        echo $_POST["username"];
                                                                                                                    } ?>">
                <?php echo isset($_SESSION['message']["username"]) ? "<div class=\"messages\">" . $_SESSION['message']["username"] . "</div>" : false;
                unset($_SESSION['message']["username"]) ?>

                <div class="messages"></div>
            </div>

            <div class="form-group">
                <label for="user" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php if (!empty($errors) && isset($_POST["email"])) {
                                                                                                                echo $_POST["email"];
                                                                                                            } ?>">
                <?php echo isset($_SESSION['message']["email"]) ? "<div class=\"messages\">" . $_SESSION['message']["email"] . "</div>" : false;
                unset($_SESSION['message']["email"]) ?>
                <div class="messages"></div>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <?php echo isset($_SESSION['message']["password"]) ? "<div class=\"messages\">" . $_SESSION['message']["password"] . "</div>" : false;
                unset($_SESSION['message']["password"]) ?>
                <div class="messages"></div>
            </div>

            <div class="form-group">
                <label for="conPassword" class="form-label">Confirm password</label>
                <input type="password" name="conPassword" id="conPassword" class="form-control">
                <?php echo isset($_SESSION['message']["conPassword"]) ? "<div class=\"messages\">" . $_SESSION['message']["conPassword"] . "</div>" : false;
                unset($_SESSION['message']["conPassword"]) ?>
                <div class="messages"></div>
            </div>

            <div>
                <button type="submit" class="btn-submit" id="btn-submit">Submit</button>
            </div>
            <div>
                <p class="signup">Already have account? <a href="/login">Sign in</a>.</p>

            </div>
    </form>

    <script src="../node_modules/validate.js/validate.js"></script>
    <script src="../js/register.js"></script>
</body>

</html>