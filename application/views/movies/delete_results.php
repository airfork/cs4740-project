<?php
if (!empty($movies)) { ?>
    <h3>Deleted Results:</h3>
    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Director</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($movies as $movie): ?>
            <?php
            if (strlen(trim($movie['title'])) === 0 || strlen(trim($movie['director'])) === 0) {
                continue;
            }
            $title = rawurlencode($movie['title']);
            echo "<tr class=\"search-list\" onclick=\"delete_movie('{$title}', this)\">";

            ?>
            <td>
                <?php echo $movie['title']; ?>
            </td>
            <td>
                <?php echo $movie['director']; ?>
            </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>