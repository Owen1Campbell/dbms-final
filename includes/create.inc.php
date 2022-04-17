<?php

// confirm user accessed page through form
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $date = $_POST["date"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $desc = $_POST["description"];
    $cat = $_POST["category"];
    $address = $_POST["address"];
    $host = $_POST["rso"];
    $isPublic = $_POST["public"];
    $start = $_POST["start"];
    $end = $_POST["end"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    if (empty($isPublic)) {
        $isPublic = 0;
    }

    // checks if inputs are completed
    if (emptyInputCreateRSO($name, $date, $email, $phone, $desc, $address, $start, $end) !== false) {
        header("location: ../create.php?error=emptyinput");
        exit();
    }
    // checks valid email format
    if (invalidEmail($email) !== false) {
        header("location: ../create.php?error=invalidemail");
        exit();
    }

    createEvent($conn, $name, $date, $email, $phone, $desc, $cat, $address, $host, $isPublic, $start, $end);

}
else {
    header("location: ../signup.php");
    exit();
}
