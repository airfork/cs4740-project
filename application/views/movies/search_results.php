<?php
if (!empty($movies)) { ?>
    <h3>Search Results:</h3>
    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Directed By</th>
            <th>Release Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($movies as $movie): ?>
            <?php
            $checked_out = false;
            if($movie['checked_out'] != 0) {
                $checked_out = true;
            }
            if ($checked_out) {
                echo '<tr class="search-list checkedOut" onclick="checkedOut(\'movie\')">';
            } else {
                echo "<tr class=\"search-list\" onclick=\"movieCheckout('{$movie['title']}', '{$movie['director']}')\">";
            }
            ?>
                <td>
                    <?php echo $movie['title']; ?>
                </td>
                <td>
                    <?php echo $movie['director']; ?>
                </td>
                <td>
                    <?php echo $movie['releaseDate']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>