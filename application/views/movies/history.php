<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Checkout Date</th>
            <th>Return Date</th>
        </tr>
    </thead>
    <?php foreach ($movie_hist as $movie): ?>
    <tbody>
        <tr>
            <td><?php echo $movie['title']; ?></td>
            <td><?php echo $movie['checkout_date']; ?></td>
            <td><?php echo $movie['return_date']; ?></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>