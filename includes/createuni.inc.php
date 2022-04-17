<?php

// confirm user accessed page through form
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $numstudents = $_POST["numstudents"];
    $address = $_POST["location"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // checks if inputs are completed
    if (emptyInputCreateUniversity($name, $numstudents, $address) !== false) {
        header("location: ../createuni.php?error=emptyinput");
        exit();
    }
    // checks database to make sure name is not taken
    if (univNameTaken($conn, $name) !== false) {
        header("location: ../createuni.php?error=nametaken");
        exit();
    }

    createUniversity($conn, $name, $numstudents, $address);

}
else {
    header("location: ../signup.php");
    exit();
}
