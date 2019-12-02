<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'css/main.css'; ?>">
    <!--  Icons  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <?php $url = site_url('/'); ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $url.'favicon_io/apple-touch-icon.png'; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $url.'favicon_io/favicon-32x32.png'; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $url.'favicon_io/favicon-16x16.png '; ?>">
    <link rel="manifest" href="<?php echo $url.'favicon_io/site.webmanifest'; ?>">
    <title>THE Library</title>
</head>

<nav id="nav">
    <div class="nav-wrapper">
        <ul id="nav-mobile" class="right">
            <?php if (empty($homepage)) { ?>
                <li><a href="<?php echo base_url() ?>">Home</a></li>
            <?php } ?>
            <?php if (empty($searchpage)) { ?>
                <li><a href="<?php echo site_url('/search'); ?>">Search</a><li>
            <?php } ?>
            <?php if (!$logged_in) { ?>
                <li><a href="<?php echo site_url('/login'); ?>">Login</a></li>
            <?php } ?>
            <?php if(!empty($librarian)) { ?>
                <li><a href="<?php echo site_url('/register'); ?>">Register</a><li>
            <?php } ?>
            <?php if ($logged_in && empty($librarian) && empty($accountpage)) { ?>
                <li><a href="<?php echo site_url('/accountpage'); ?>">Account</a><li>
            <?php } ?>
            <?php if ($logged_in) { ?>
                <li><a href="<?php echo site_url('/logout'); ?>">Logout</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>