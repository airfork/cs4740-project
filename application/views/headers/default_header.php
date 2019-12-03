<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--  Icons  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php if(getenv('PRODUCTION')){
        echo 'https://library4750.herokuapp.com/css/main.css';
    } else {
        echo base_url() . 'css/main.css';
    } ?>">
    <?php
    $favURL = base_url() . 'favicon_io';
    if (getenv('PRODUCTION')) {
        $favURL = 'https://library4750.herokuapp.com/favicon_io';
    }
    $web = base_url();
    if (getenv('PRODUCTION')) {
        $web = 'https://library4750.herokuapp.com/';
    }
    ?>

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $favURL.'/apple-touch-icon.png'; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $favURL.'/favicon-32x32.png'; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $favURL.'/favicon-16x16.png '; ?>">
    <link rel="manifest" href="<?php echo $favURL.'/site.webmanifest'; ?>">
    <title>THE Library</title>
</head>

<nav id="nav">
    <div class="nav-wrapper">
        <ul id="nav-mobile" class="right">
            <?php if (empty($homepage)) { ?>
                <li><a href="<?php echo $web ?>">Home</a></li>
            <?php } ?>
            <?php if (empty($searchpage)) { ?>
                <li><a href="<?php echo $web.'search'; ?>">Search</a><li>
            <?php } ?>
            <?php if ($logged_in) { ?>
                <li><a href="<?php echo site_url('/users/reserve'); ?>">Reserve</a></li>
            <?php } ?>
            <?php if (!empty($librarian)) { ?>
                <li><a href="<?php echo site_url('/users/remove_inventory'); ?>">Remove Items From Studyspace</a></li>
            <?php } ?>
            <?php if (!$logged_in) { ?>
                <li><a href="<?php echo $web.'login'; ?>">Login</a></li>
            <?php } ?>
            <?php if(!empty($librarian)) { ?>
                <li><a href="<?php echo $web.'register'; ?>">Register</a><li>
            <?php } ?>
            <?php if ($logged_in && empty($librarian) && empty($accountpage)) { ?>
                <li><a href="<?php echo $web.'accountpage'; ?>">Account</a><li>
            <?php } ?>
            <?php if ($logged_in) { ?>
                <li><a href="<?php echo $web.'logout'; ?>">Logout</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>