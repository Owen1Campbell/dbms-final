<?php

function emptyInputSignup($name, $email, $username, $pass, $passRepeat, $level) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pass) || empty($passRepeat) || empty($level)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function passMatch($pass, $passRepeat) {
    $result;
    if ($pass !== $passRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?error=stmtfail");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
      return $row;
    }
    else {
      $result = false;
      return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pass, $level) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPass, usersLevel) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?error=stmtfail");
      exit();
    }

    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $username, $hashedPass, $level);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $pass) {
    $result;
    if (empty($username) || empty($pass)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pass) {
    $uidExists = uidExists($conn, $username, $username);

    if (uidExists === false) {
        header("location: ../signup.php?error=wronglogin");
        exit();
    }

    $passHashed = $uidExists["usersPass"];
    $checkPass = password_verify($pass, $passHashed);

    if ($checkPass === false) {
        header("location: ../signup.php?error=wrongpass");
        exit();
    }
    else if ($checkPass === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["userfullname"] = $uidExists["usersName"];
        $_SESSION["userlevel"] = $uidExists["usersLevel"];
        header("location: ../index.php");
        exit();
    }
}

function emptyInputCreateUniversity($name, $numstudents, $address) {
    $result;
    if (empty($name) || empty($numstudents || empty($address))) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function univNameTaken($conn, $name) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?error=stmtfail");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
      return $row;
    }
    else {
      $result = false;
      return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUniversity($conn, $name, $numStudents, $address) {
    $sql = "INSERT INTO university (universityName, universityNumStudents, universityAddress) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?error=stmtfail");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sis", $name, $numStudents, $address);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../list.php?create=university");
    exit();
}