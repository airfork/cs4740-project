<table>
    <thead>
        <tr>
            <th>Title</th>
        </tr>
    </thead>
    <?php foreach ($deadline_movie as $movie): ?>
    <tbody>
        <tr>
            <td><?php echo $movie['title']; ?></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>