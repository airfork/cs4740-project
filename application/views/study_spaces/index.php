<?php
echo sizeof($study_spaces);
if (!empty($study_spaces)) { ?>
    <h3>Study Spaces:</h3>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($study_spaces as $study_space): ?>
            <!-- <?php
            $already_reserved = false;
            if($study_space['already_reserved'] != 0) {
                $already_reserved = true;
            }
            if ($reserved) {
                echo '<tr class="search-list already_reserved" onclick="alreadyReserved()">';
            } else {
                echo "<tr class=\"search-list\" onclick=\"reserveSpace('{$study_space['space_id']}')\">";
            }
            ?> -->
                <td>
                    <?php echo $study_space['name']; ?>
                </td>
                <td>
                    <?php echo $study_space['description']; ?>
                </td>
                <td>
                    <?php echo $study_space['location']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>