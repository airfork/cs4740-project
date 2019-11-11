<?php
if (!empty($books)) { ?>
    <h3>Search Results:</h3>
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
            <tr onclick="bookCheckout(<?php echo $book['isbn']; ?>)">
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
<?php } ?>