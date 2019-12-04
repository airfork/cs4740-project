<?php $this->view('headers/default_header') ?>
<?php
$web = base_url();
if (getenv('PRODUCTION')) {
    $web = 'https://library4750.herokuapp.com/';
} ?>
<div class="container">
    <h3>Available Study Spaces</h3>
    <input type="hidden" value="<?php echo $web ?>" id="url">
    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" id="csrf"/>
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
            <?php
            $already_reserved = false;
            if ($study_space['already_reserved'] != 0) {
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
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="<?php echo $web . 'js/spaces.js'; ?>"></script>
</body>
</html>
