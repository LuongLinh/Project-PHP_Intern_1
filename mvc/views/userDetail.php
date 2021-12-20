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

        <div>
            <?php
            foreach ($data["users"] as $key => $value) {
                $key = array_filter($data["users"]);
            }
            ?>
            <!-- user info -->
            <div>
                <p class="author"> Username: <?php echo ($value["username"]); ?>
                </p>
                <p class="author"> Email: <?php echo ($value["email"]); ?>
                </p>
            </div>
            <!-- add post -->
            <form action="/add-post/<?php echo $value["id"]; ?>" method="post">
                <div class="form-group">
                    <input type="text" name="title" id="email" class="form-control" placeholder="Title">
                </div>

                <div class="row">
                    <div>
                        <textarea class="textarea" name="content" placeholder="Write something.."></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <button type="submit" class="btn-submit">Post</button>
                </div>
            </form>

            <!-- list post -->
            <p>LIST POST</p>
            <?php

            if (empty($data["postOfAuthor"])) {
                echo "<p>0 Post</p>";
            }
            foreach ($data["postOfAuthor"] as $key => $postValue) {
                $key = array_filter($data["postOfAuthor"]);

                echo "
            <a href=\"../post-detail/" . $postValue["id"] . "\" class=\"post-title\">
                " . $postValue["title"] . "
            </a>";
                echo "
            <div>
            <div class=\"post-content\">" . $postValue["content"] . "
            </div>";

                // <!-- comment -->
                echo "
            <form action=\"/add-comment/" . $value["id"] . "/" . $postValue["id"] . " \" method=\"post\">
            <div class=\"form-group\">
               
                    <input class=\"comment\" type=\"text\" name=\"comment\" placeholder=\"comment ....\">
            </div>
            <br>
            <div class=\"row\">

                <button type=\"submit\" class=\"btn-submit\">Post Comment</button>
            </div>
            </form>
            <hr>
            ";
            }
            ?>
        </div>

    </div>

    </div>
    </div>
</body>

</html>