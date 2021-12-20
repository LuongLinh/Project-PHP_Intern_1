<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <link rel="stylesheet" href="../assets/css/postDetail.css">
</head>

<body>
    <div class="container">
        <h2>Post Detail</h2>
        <?php
        foreach ($data["postDetail"] as $key => $value) {
            $key = array_filter($data["postDetail"]);
        }

        echo "<h2 class=\"post-title\">" . $value["title"] . "</h2>";

        echo "
        <div>
        <div class=\"post-content\">" . $value["content"] . "
        </div>";
        ?>

        <div>
            <div class="list-comment">
                <?php
                echo "<p>Comment</p>";
                foreach ($data["postDetail"] as $key => $value) {
                    echo $value["message"];
                   
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>