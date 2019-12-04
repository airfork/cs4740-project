<table>
    <thead>
        <tr>
            <th>Title</th>
        </tr>
    </thead>
    <?php foreach ($deadline_aj as $aj): ?>
    <tbody>
        <tr>
            <td><?php echo $aj['title']; ?></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>