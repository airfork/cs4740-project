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
            <tr onclick="articleCheckout('<?php echo $article['title']; ?>', '<?php echo $article['ajauthor']; ?>', '<?php echo $article['pubDate']; ?>')">
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