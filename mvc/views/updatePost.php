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
        <h2>Update Post</h2>
        <?php
        foreach ($data["postDetail"] as $key => $value) {
            $key = array_filter($data["postDetail"]);
        }

        echo "<h2 class = \"post-title\" >" . $value["title"] . "</h2>";
        ?>

        <form id="form-update" action="/update-post/<?php echo $value["id"] ?> " method="post">
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
                <button type="submit" class="btn-submit">Update</button>
            </div>
        </form>
    </div>

</body>

</html>