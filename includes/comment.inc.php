<?php 

if (isset($_POST["submit"])) {
    $comment = $_POST["comment"];
    $eventId = $_POST["eventid"];
    $userId = $_POST["userid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (empty($comment) !== false) {
        header("location: ../event.php?id=$eventId&error=emptyinput");
        exit();
    }

    postComment($conn, $userId, $eventId, $comment);
}
else {
    header("location: ../event.php");
    exit();
}