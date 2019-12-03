<table>
    <thead>
        <tr>
            <th>Title</th>
        </tr>
    </thead>
    <?php foreach ($deadline as $book): ?>
    <tbody>
        <tr>
            <td><?php echo $book['title']; ?></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>