<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Add Items To Study Space</h2>
        <br>
        <?php
        $this->load->helper('form');
        $this->load->library('form_validation');
        $url = site_url('/');
        ?>
        <input type="hidden" value="<?php echo $url ?>" id="url">
        <!-- <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" id="csrf"/> -->
        <form action="<?php echo $url . 'addinventory'; ?>" method="POST">
            <div class="row">
                <div class="input-field col s12 m4">
                    <select id="whichstudyspace" name="whichstudyspace">
                        <?php foreach ($study_spacesadd as $study_spacesadds): ?>
                            <option value=<?php echo $study_spacesadds['space_id']?>><?php echo $study_spacesadds['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <select id="whichitem" name="whichitem">
                        <?php foreach ($itemsadd as $items): ?>
                            <option value=<?php echo $items['item_id']?>><?php echo $items['type']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col m4">
                    <button class="btn btn-small" name="add_button" id="add" value="Add" type="submit">Add</button>
                </div>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" id="csrf"/>
            </div>
        </form>

        <p class="text--center"><?php echo validation_errors() ?></p>
        <?php $data = array("chosenstudyspace"=>$_POST['whichstudyspace'], "chosenitem"=>$_POST['whichitem']);
            $this->view('study_spaces/additem', $data)
        ?>
        <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
    </div>
</body>
</html>