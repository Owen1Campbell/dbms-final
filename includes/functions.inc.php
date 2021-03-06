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

function createUser($conn, $name, $email, $username, $pass, $level, $univid) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPass, usersLevel, usersUnivId) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?error=stmtfail");
      exit();
    }

    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssii", $name, $email, $username, $hashedPass, $level, $univid);
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
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $passHashed = $uidExists["usersPass"];
    $checkPass = password_verify($pass, $passHashed);

    if ($checkPass === false) {
        header("location: ../login.php?error=wrongpass");
        exit();
    }
    else if ($checkPass === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["userfullname"] = $uidExists["usersName"];
        $_SESSION["userlevel"] = $uidExists["usersLevel"];
        $_SESSION["useruniv"] = $uidExists["usersUnivId"];
        header("location: ../index.php");
        exit();
    }
}

function emptyInputCreateUniversity($name, $numstudents, $address) {
    $result;
    if (empty($name) || empty($numstudents) || empty($address)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function univNameTaken($conn, $name) {
    $sql = "SELECT * FROM university WHERE universityName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../createuni.php?error=stmtfail");
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
      header("location: ../createuni.php?error=stmtfail");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sis", $name, $numStudents, $address);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../list.php?create=university");
    exit();
}

function emptyInputCreateRSO($name, $adminId, $univId, $desc) {
    $result;
    if (empty($name) || empty($adminId) || empty($univId) || empty($desc)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function rsoExists($conn, $name) {
    $sql = "SELECT * FROM university WHERE universityName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../createuni.php?error=stmtfail");
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

function createRSO($conn, $name, $adminId, $univId, $desc) {
    $sql = "INSERT INTO rso (rsoName, rsoAdminid, rsoUniv, rsoDesc) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../createrso.php?error=stmtfail");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "siis", $name, $adminId, $univId, $desc);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // create table for enrollment list
    $name = str_replace(" ", "", $name);
    $name = strtolower($name);
    $sql = "CREATE TABLE $name (memberId INT PRIMARY KEY);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../createrso.php?error=stmtfail1");
      exit();
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // enter admin id in table
    $sql = "INSERT INTO $name (memberId) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../createrso.php?error=stmtfail2");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $adminId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../list.php?create=rso");
    exit();
}

function emptyInputCreateEvent($name, $date, $desc, $start) {
    $result;
    if (empty($name) || empty($date) || empty($desc) || empty($start)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function createEvent($conn, $name, $date, $email, $phone, $desc, $cat, $address, $host, $isPublic, $start, $end) {
    $sql = "INSERT INTO events (eventName, eventDate, eventEmail, eventPhone, eventDesc, eventCategory, eventAddress, eventHost, eventIsPublic, eventStart, eventEnd) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../create.php?error=stmtfail");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssssiss", $name, $date, $email, $phone, $desc, $cat, $address, $host, $isPublic, $start, $end);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../list.php?create=event");
    exit();
}

function userEnrolledRso($conn, $id, $name) {
    // set name to lowercase and remove whitespace (matches member db naming conventions)
    $name = str_replace(" ", "", $name);
    $name = strtolower($name);

    // declare query
    $sql = "SELECT * FROM $name WHERE memberId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: rsolist.php?error=stmtfail");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
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

function addToRso($conn, $name, $userId, $rsoId) {
    // set name to lowercase and remove whitespace (matches member db naming conventions)
    $name = str_replace(" ", "", $name);
    $name = strtolower($name);

    // generate query statement
    $sql = "INSERT INTO $name (memberId) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../rso.php?id=$rsoId&error=stmtfail");
      exit();
    }
    //echo $stmt;
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../rso.php?id=$rsoId&join=true");
    exit();
}

function leaveRso($conn, $name, $userId, $rsoId) {
    // set name to lowercase and remove whitespace (matches member db naming conventions)
    $name = str_replace(" ", "", $name);
    $name = strtolower($name);

    // generate query statement
    $sql = "DELETE FROM $name WHERE memberId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../rso.php?id=$rsoId&error=stmtfail");
      exit();
    }
    //echo $stmt;
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../rso.php?id=$rsoId&leave=true");
    exit();
}

function postComment($conn, $userId, $eventId, $comment) {
  $sql = "INSERT INTO comments (commentUserId, commentEventId, commentContent) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../event.php?id=$eventId&error=stmtfail");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "iis", $userId, $eventId, $comment);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../event.php?id=$eventId");
  exit();
}

function deleteComment($conn, $commentId, $eventId) {
  $sql = "DELETE FROM comments WHERE commentId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: event.php?id=$eventId&error=stmtfail");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $commentId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: event.php?id=$eventId");
  exit();
}

function modComment($conn, $commentId, $commentContent, $eventId) {
  $sql = "UPDATE comments SET commentContent = ? WHERE commentId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../event.php?id=$eventId&error=stmtfail");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "si", $commentContent, $commentId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../event.php?id=$eventId");
  exit();
}

function getRsoMembers($conn, $name) {
  // set name to lowercase and remove whitespace (matches member db naming conventions)
  $name = str_replace(" ", "", $name);
  $name = strtolower($name);

  // declare query
  $sql = "SELECT * FROM $name;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: rsolist.php?error=stmtfail");
    exit();
  }

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

function getRsoNumStudents($conn, $name) {
  // set name to lowercase and remove whitespace (matches member db naming conventions)
  $name = str_replace(" ", "", $name);
  $name = strtolower($name);

  $result = mysqli_num_rows($name);
}
