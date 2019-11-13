<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Account</h2>
        Hello.
        <br>
        <br>
        <?php if ($logged_in) { ?>
                <li><a href="<?php echo site_url('/books/deadlines'); ?>">Deadlines</a></li>
            <?php } ?>
    </div>
    
</body>
</html>