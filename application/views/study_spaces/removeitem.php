<?php
if (!empty($study_spacesud)) { ?>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Space Inventory</th>
            <th>Inventory Description</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($study_spacesud as $study_spaced): ?>
            <?php
                echo "<tr class=\"search-list\" onclick=\"deleteChosenItem('{$study_spaced['item_id']}','{$study_spaced['space_id']}')\">";
            ?>
                <td>
                    <?php echo $study_spaced['name']; ?>
                </td>
                <td>
                    <?php echo $study_spaced['description']; ?>
                </td>
                <td>
                    <?php echo $study_spaced['location']; ?>
                </td>
                <td>
                    <?php echo $study_spaced['type']; ?>
                </td>
                <td>
                    <?php echo $study_spaced['itemdescription']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>