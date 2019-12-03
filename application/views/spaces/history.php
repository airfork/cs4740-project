<table>
    <thead>
        <tr>
            <th>Space Name</th>
            <th>Reserved Until</th>
        </tr>
    </thead>
    <?php foreach ($space_hist as $space): ?>
    <tbody>
        <tr>
            <td><?php echo $space['name']; ?></td>
            <td><?php echo $space['reservedUntil']; ?></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>