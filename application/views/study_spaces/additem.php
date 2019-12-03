<?php
    //echo "<div onload=\"addChosenItem('{$thing['chosenitem']}','{$thing['chosenstudyspace']}')\">";
    //echo "<div onload=\"addChosenItem($_POST["whichitem"], $_POST["whichstudyspace"])\">";
    echo $_POST["whichitem"];
    echo "<button onlick=\"addChosenItem({$_POST["whichitem"]},{$_POST["whichstudyspace"]})\">";
?>
