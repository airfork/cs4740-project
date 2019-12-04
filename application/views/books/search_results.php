<?php
if (!empty($books)) { ?>
    <h3>Search Results:</h3>
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
            $checked_out = false;
            if($book['checked_out'] != 0) {
                $checked_out = true;
            }
            if ($checked_out) {
                echo '<tr class="search-list checkedOut" onclick="checkedOut(\'book\')">';
            } else {
                echo "<tr class=\"search-list\" onclick=\"bookCheckout('{$book['isbn']}')\">";
            }
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