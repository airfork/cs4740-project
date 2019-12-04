<?php
if (!empty($books)) { ?>
    <h3>Deleted Results:</h3>
    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <?php
            if (strlen(trim($book['title'])) === 0 || strlen(trim($book['author'])) === 0) {
                continue;
            }
            echo "<tr class=\"search-list\" onclick=\"delete_book('{$book['isbn']}', this)\">";
            ?>
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