<?php

// confirm user accessed page through form
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $adminId = $_POST["adminid"];
    $univId = $_POST["univid"];
    $desc = $_POST["description"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // checks if inputs are completed
    if (emptyInputCreateRSO($name, $adminId, $univId, $desc) !== false) {
        header("location: ../createrso.php?error=emptyinput");
        exit();
    }
    // checks database to make sure username is not taken
    if (rsoExists($conn, $name) !== false) {
        header("location: ../createrso.php?error=nametaken");
        exit();
    }

    createRSO($conn, $name, $adminId, $univId, $desc);

}
else {
    header("location: ../signup.php");
    exit();
}
