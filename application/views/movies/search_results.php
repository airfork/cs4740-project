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
            <tr onclick="movieCheckout('<?php echo $movie['title']; ?>', '<?php echo $movie['director']; ?>')">
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