<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Checkout Date</th>
            <th>Return Date</th>
        </tr>
    </thead>
    <?php foreach ($aj_hist as $aj): ?>
    <tbody>
        <tr>
            <td><?php echo $aj['title']; ?></td>
            <td><?php echo $aj['checkout_date']; ?></td>
            <td><?php echo $aj['return_date']; ?></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>