<?php 

function emptyInputSignup($name, $email, $username, $pass, $passRepeat) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pass) || empty($passRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (preg_match()) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}