<?php 

if (isset($_POST["submit"])) {
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // if modifying comment, only execute this part of code
    if (isset($_GET["mod"])) {
        $commentId = $_GET["mod"];
        $commentContent = $_POST["comment"];
        $eventId = $_POST["eventid"];
        modComment($conn, $commentId, $commentContent, $eventId);
    }
    $comment = $_POST["comment"];
    $eventId = $_POST["eventid"];
    $userId = $_POST["userid"];

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