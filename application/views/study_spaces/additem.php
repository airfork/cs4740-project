<?php
if (!empty($data)) { ?>
    <table>
        <thead>
        <tr>
            <th>Study Space Name</th>
            <th>Item</th>
        </tr>
        </thead>
        <tbody>
            <?php
                echo "<tr class=\"search-list\" onclick=\"addChosenItem('{$data['chosenitem']}','{$data['chosenstudyspace']}')\">";
            ?>
                <td>
                    <?php echo $study_spaced['name']; ?>
                </td>
                <td>
                    <?php echo $study_spaced['item']; ?>
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>