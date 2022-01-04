<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <link rel="stylesheet" href="../assets/css/userDetailStyle.css">
</head>

<body>
    <div class="container">
        <h3>MY ACCOUNT</h3>
        <a href="../logout">Logout</a>
        <div>
            <?php
            if (!empty($data["users"]) && isset($data["users"])) {
                foreach ($data["users"] as $key => $value) {
                    $key = array_filter($data["users"]);
                }
            }
            ?>
            <div>
                <form id="form-upload" action="/update-user/<?php echo $value["id"]; ?>" method="post" enctype="multipart/form-data" user-id="<?php if (isset($value["id"])) {
                                                                                                                                                    echo $value["id"];
                                                                                                                                                } ?>" >
                    <input type="file" name="fileToUpload" id="fileToUpload" class="image-profile">
                    <h3 id="uploadStatus" style="color: red; font-family: monospace;"> </h3>
                    <?php
                    if (!empty($value['image_url'])) {
                        echo "<img src=\"" . $value["image_url"] . "\" id=\"image\" class=\"img-avt\" style=\"width: 150px; height : 150px; border-radius: 50%\" alt= ".$value['username'].">";
                    } else {
                        echo "<img src=\"../assets/images/default.jpg\" id=\"image\" class=\"img-avt\" style=\"width: 150px; height : 150px; border-radius: 50%\" alt= ".$value['username'].">";
                    } ?>

                    <div class="form-group">
                        <label for="use" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php if (isset($value["username"])) {
                                                                                                                                echo ($value["username"]);
                                                                                                                            } ?>">
                        <div class="messages"></div>
                    </div>
                    <div class="form-group">
                        <label for="user" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php if (isset($value["email"])) {
                                                                                                                        echo ($value["email"]);
                                                                                                                    } ?>">
                        <div class="messages"></div>
                    </div>
                    <button type="submit" id="btn-upload" class="btn-submit" value="Upload Image" name="submit"> Upload </button>
                </form>
            </div>

        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/updateUser.js"></script>
</body>

</html>