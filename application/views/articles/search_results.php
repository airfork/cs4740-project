<?php
if (!empty($articles)) { ?>
    <h3>Search Results:</h3>
    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Publish Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article): ?>
            <?php
            if (strlen(trim($article['title'])) === 0 || strlen(trim($article['ajauthor'])) === 0 || strlen(trim($article['pubDate'])) === 0) {
                continue;
            }
            $checked_out = false;
            if($article['checked_out'] != 0) {
                $checked_out = true;
            }
            if ($checked_out) {
                echo '<tr class="search-list checkedOut" onclick="checkedOut(\'article/journal\')">';
            } else {
                echo "<tr class=\"search-list\" onclick=\"articleCheckout('{$article['title']}', '{$article['ajauthor']}', '{$article['pubDate']}')\">";
            }
            ?>
                <td>
                    <?php echo $article['title']; ?>
                </td>
                <td>
                    <?php echo $article['ajauthor']; ?>
                </td>
                <td>
                    <?php echo $article['pubDate']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>