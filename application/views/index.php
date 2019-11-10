<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>THE Library</title>
</head>
<body>
    <?php
        $this->load->helper('url_helper');
    ?>
    <h2>Welcome to the Library</h2>
    <p>This page is very much a work in progress!</p>
    <a href="<?php echo site_url('/login'); ?>">Login</a>
    <a href="<?php echo site_url('/register'); ?>">Register</a>
    <a href="<?php echo site_url('/books'); ?>">Book List</a>
    <a href="<?php echo site_url('/search'); ?>">Book Search</a>
    <a href="<?php echo site_url('/logout'); ?>">Logout</a>
</body>
</html>