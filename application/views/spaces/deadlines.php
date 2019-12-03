<table>
    <thead>
        <tr>
            <th>Space Name</th>
            <th>Location</th>
        </tr>
    </thead>
    <?php foreach ($deadline_space as $space): ?>
    <tbody>
        <tr>
            <td><?php echo $space['name']; ?></td>
            <td><?php echo $space['location']; ?></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>