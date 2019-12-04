<?php
if (!empty($books)) { ?>
    <h3>Insert Results:</h3>
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
            
            echo "<tr class=\"search-list\" onclick=\"insert_book('{$book['isbn']}')\">";
            
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