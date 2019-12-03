<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Checkout Date</th>
            <th>Return Date</th>
        </tr>
    </thead>
    <?php foreach ($book_hist as $book): ?>
    <tbody>
        <tr>
            <td><?php echo $book['title']; ?></td>
            <td><?php echo $book['checkout_date']; ?></td>
            <td><?php echo $book['return_date']; ?></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>