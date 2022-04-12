<?php

// confirm user accessed page through form
if (isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pass = $_POST["pass"];
    $passRepeat = $_POST["passrpt"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // checks if inputs are completed
    if (emptyInputSignup($name, $email, $username, $pass, $passRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    // checks valid username format
    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    // checks valid email format
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    // checks if passwords match
    if (passMatch($pass, $passRepeat) !== false) {
        header("location: ../signup.php?error=passmismatch");
        exit();
    }
    // checks database to make sure username is not taken
    if (uidExists($conn, $username) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

}
else {
    header("location: ../signup.php");
    exit();
}