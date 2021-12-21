<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    ?>
    <!-- 

    <form class="form-login" id="main" action="/update-user/" method="post" novalidate>
        <div>
          
            <h3 class="title">LOGIN</h3>
            <div class="form-group">
                <label for="use" class="form-label">Username</label>
                <input type="text" name="username" id="usernames" class="form-control" placeholder="Username">
                <?php echo (!empty($errors) && array_key_exists("username", $errors)) ? "<div class=\"messages\">" . $errors["username"] . "</div>" : false; ?>
                <div class="messages"></div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <?php echo (!empty($errors) && array_key_exists("password", $errors)) ? "<div class=\"messages\">" . $errors["password"] . "</div>" : false; ?>
                <div class="messages"></div>
            </div>

            <div>
                <button type="submit" class="btn-submit">Submit</button>
            </div>
            <div>
                <p class="signup">Already have account? <a href="/register">Sign up</a>.</p>

            </div>
    </form> -->

    <script src="../node_modules/validate.js/validate.js"></script>
    <script src="../js/login.js"></script>
</body>

</html>