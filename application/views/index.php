<?php $this->view('headers/default_header') ?>
<body>
    <?php
        $this->load->helper('url_helper');
    ?>
    <div class="container">
        <h2>Welcome to the Library</h2>
        <p>This page is very much a work in progress!</p>
        <a href="<?php echo site_url('/login'); ?>">Login</a>
        <a href="<?php echo site_url('/register'); ?>">Register</a>
        <a href="<?php echo site_url('/books'); ?>">Book List</a>
        <a href="<?php echo site_url('/search'); ?>">Book Search</a>
        <a href="<?php echo site_url('/logout'); ?>">Logout</a>
    </div>
</body>
</html>