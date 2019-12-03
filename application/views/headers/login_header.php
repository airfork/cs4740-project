<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php if(getenv('PRODUCTION')){
        echo 'https://library4750.herokuapp.com/css/login.css';
    } else {
        echo base_url() . 'css/login.css';
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