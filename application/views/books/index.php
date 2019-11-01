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
    <h2>Book List</h2>
    <p>Here is a list of books:</p>
    <table>
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td>
                        <?php echo $book['isbn']; ?>
                    </td>
                    <td>
                        <?php echo $book['title']; ?>
                    </td>
                    <td>
                        <?php echo $book['author']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
