<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Update Inventory</h2>
        <br>
        <?php
        $url = site_url('/');
        ?>
        <input type="hidden" value="<?php echo $url ?>" id="url">
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" id="csrf"/>
        <!-- <form action="<?php echo $url.'updateinventory'; ?>" method="post">
            <div class="row">
                <div class="input-field col s12 m4">
                    <select id="whichstudyspace" name="whichstudyspace">
                        <?php foreach ($study_spacesud as $study_spacesuds): ?>
                            <option value=<?php echo $study_spacesuds?>><?php echo $study_spacesuds?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="type">Search Type</label>
                </div>
                <div class="col m4">
                    <button class="btn btn-small" name="add_button" type="submit" id="add" value="Add">Add</button>
                    <button class="btn btn-small" name="remove_button" type="submit" id="remove" value="Remove">Remove</button>
                </div>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" id="csrf"/>
            </div>
        </form>
        <?php
            if(isset($_POST['add_button'])){
                $_SESSION['whatdoyouwanttodo'] = 'add';
                $chosenstudyspaceid = $_POST['whichstudyspace'];
            }
            else if(isset($_GET['remove_button'])){
                $whatdoyouwanttodo = 'remove';
                $chosenstudyspaceid = $_POST['whichstudyspace'];
            }
        ?> -->
        <?php $this->view('study_spaces/update'); ?>
    </div>
    <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
</body>
</html>