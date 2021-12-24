<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <link rel="stylesheet" href="../assets/css/listUser.css">
</head>

<body>
    <h2>List Post</h2>
    <div style="overflow-x: auto;">
        <table class="list-user">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            <?php

            foreach ($data["users"] as $key => $value) {
                $key = array_filter($data["users"]);
                echo "
                    <tr>
                        <th>" . $value["id"] . "</th>
                        <th>" . $value["username"] . "</th>
                        <th>" . $value["email"] . "</th>
                        <th>
                        <div>
                            <button class=\"update-user\">
                                <a class=\"link\" href=\"../user-detail/" . $value["id"] . "\">Detail</a>
                            </button>
                            <button class=\"del-user\">
                                <a class=\"link\" href=\"../delete-user/" . $value["id"] . "\">Delete</a>
                            </button>
                        </div>
                    </th>
                    </tr>
                    ";
            }
            ?>
        </table>
    </div>
</body>

</html>