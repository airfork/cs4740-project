<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Add Items To Study Space</h2>
        <br>
        <?php
        $url = site_url('/');
        ?>
        <input type="hidden" value="<?php echo $url ?>" id="url">
        <!-- <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" id="csrf"/> -->
        <form action="../study_spaces/add_inventory" method="POST">
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
            <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" id="csrf"/>
        </form>
        <?php
            $thing = array();
            if(isset($_POST['add_button'])){
                $chosenstudyspace = $_POST['whichstudyspace'];
                $chosenitem = $_POST['whichitem'];
                $thing = array('chosenstudyspace' => $chosenstudyspace, 'chosenitem' => $chosenitem);
                $this->view('study_spaces/additem', array("chosenstudyspace"=>$chosenstudyspace, "chosenitem"=>$chosenitem));
            }
        ?>
        <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
    </div>
</body>
</html>