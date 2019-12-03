<?php
if (!empty($study_spaces)) { ?> <!-- if (!empty($study_spaces) and $logged_in) { ?> -->
    <h3>Study Spaces:</h3>
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
        <?php foreach ($study_spaces as $study_space): ?>
            <?php
            $already_reserved = false;
            if($study_space['already_reserved'] != 0) {
                $already_reserved = true;
            }
            if ($already_reserved) {
                echo '<tr class="search-list already_reserved" onclick="alreadyReserved()">';
            } else {
                echo "<tr class=\"search-list\" onclick=\"reserve('{$study_space['space_id']}')\">";
            }
            ?>
                <td>
                    <?php echo $study_space['name']; ?>
                </td>
                <td>
                    <?php echo $study_space['description']; ?>
                </td>
                <td>
                    <?php echo $study_space['location']; ?>
                </td>
                <td>
                    <?php echo $study_space['type']; ?>
                </td>
                <td>
                    <?php echo $study_space['itemdescription']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>