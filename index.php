<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>THE Library</title>
</head>
<body>
    <h1>Welcome to the Library</h1>
    <p>Click <a href="login.php">here</a> to log in</p>
    <h3>Here is our list of books:</h3>
    <?php
    require "dbutil.php";
    $db = DbUtil::loginConnection();

    $stmt = $db->stmt_init();

    if($stmt->prepare("SELECT * FROM Book") or die(mysqli_error($db))) {
        $stmt->execute();
        $stmt->bind_result($ISBN, $title, $author);
        echo "<table border=1><th>ISBN</th><th>Title</th><th>Author</th>\n";
        while($stmt->fetch()) {
            echo "<tr><td>$ISBN</td><td>$title</td><td>$author</td></tr>";
        }
        echo "</table>";

        $stmt->close();
    }

    $db->close();
    ?>
</body>
</html>

