<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/listPost.css">
</head>

<body>
    <div class="container">
        <h2>List Post</h2>
        <?php
        if (empty($data["listPost"])) {
            echo "<p>0 Post</p>";
        }
        foreach ($data["listPost"] as $key => $postValue) {
            $key = array_filter($data["listPost"]);

            
            echo "
                <a href=\"../post-detail/" . $postValue["id"] . "\" class=\"post-title\">
                    " . $postValue["title"] . "
                </a>";
            echo "
                <div>
                <div class=\"post-content\">" . $postValue["content"] . "
                </div>";

            echo "
                <button class=\"btn-submit\">
                    <a class=\"link\" href=\"../edit-post/" . $postValue["id"] . "\">Update</a>
                </button> 
                <button class=\"btn-submit\">
                    <a class=\"link\" href=\"../delete-post/" . $postValue["id"] . "\">Delete</a>
                </button> 
                <hr>";
        }
        ?>
    </div>

</body>

</html>