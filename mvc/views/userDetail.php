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
            <!-- user info -->
            <div>
                <p class="author"> Username: <?php if (isset($value["username"])) {
                                                    echo ($value["username"]);
                                                } ?>
                </p>
                <p class="author"> Email: <?php if (isset($value["email"])) {
                                                echo ($value["email"]);
                                            } ?>
                </p>
            </div>

            <!-- add post -->
            <form action="/add-post/<?php echo $value["id"]; ?>" method="post">
                <h3 id="error" style="color: red; font-family: monospace;"> </h3>

                <div class="form-group">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                </div>

                <div class="row">
                    <div>
                        <textarea id="content" class="textarea" name="content" placeholder="Write something.."></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <button type="button" user-id="<?php if (isset($value["id"])) {
                                                        echo $value["id"];
                                                    } ?>" class="btn-submit" id="btn-submit">Post</button>
                </div>
            </form>

            <!-- list post -->
            <p>LIST POST</p>
            <?php

            if (empty($data["postOfAuthor"])) {
                echo "<p>0 Post</p>";
            }
            if (!empty($data["postOfAuthor"]) && isset($data["postOfAuthor"])) {
                foreach ($data["postOfAuthor"] as $key => $postValue) {
                    $key = array_filter($data["postOfAuthor"]);

                    echo "
                <div id=\"show-post\">
                    <a href=\"../post-detail/" . $postValue["id"] . "\" class=\"post-title\" >
                        " . $postValue["title"] . " </a>  
                    <p class=\"post-content\" id=\"show-content\">" . $postValue["content"] . "</p>
                    <button class=\"btn-submit btn-showComment\" post-id='" . $postValue["id"] . "' type=\"button\">Comment</button>
                </div>";
                    // comment
                    echo "
                    <form action=\"/add-comment/" . $value["id"] . "/" . $postValue["id"] . " \" method=\"post\" class=\"form-comment\" form-comment=\"" . $postValue["id"] . "\">
                    <div class=\"form-group\">
                        <input class=\"comment\" type=\"text\" name=\"comment\" placeholder=\"comment ....\">
                    </div>
                    <br>
                    <div class=\"row\">
                        <button type=\"submit\" class=\"btn-submit\">Post Comment</button>
                    </div>
                    </form>
                    <hr>";
                }
            }
            ?>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/loadPost.js"></script>
</body>

</html>