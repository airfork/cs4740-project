<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Reserve</h2>
        <br>
        <?php
        $url = site_url('/');
        ?>
        <?php $this->view('study_spaces/index'); ?>
    </div>
    <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
</body>
</html>