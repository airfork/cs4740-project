<?php
require_once('./db_info.php');
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
// Check connection
if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .
        mysqli_connect_error());
    return null;
}

