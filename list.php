<?php 
    include_once 'header.php'; 
    include_once 'includes/dbh.inc.php'; 
    include_once 'includes/functions.inc.php'; 
?>
<h1>Upcoming Events</h1>
<div class='createdmsg'>
    <?php
        if (isset($_GET["create"])) {
            if ($_GET["create"] == "event") {
                echo "<p>Event Created!</p>";
            }
            else if ($_GET["create"] == "rso") {
                echo "<p>RSO Created!</p>";
            }
            else if ($_GET["create"] == "university") {
                echo "<p>University Created!</p>";
            }
        }
    ?>
</div>
<div class='create'>
    <?php 
        if (isset($_SESSION["userlevel"])) {
            // if admin or super
            if ($_SESSION["userlevel"] < 3 && $_SESSION["userlevel"] > 0) {
                echo "<a href='create.php?=event'>Create Event</a><br />";
            }
        }
    ?>
</div>
<div class='event'>
        <h3><a href="event.php?id=0">Event Name</a></h3>
        <p>2022-4-22 8:00pm-9:00pm</p>
        <p>Event Description. This is a short description of the event</p>
</div>
<?php 
    // get all rsos at university
    $sql = "SELECT * FROM rso WHERE rsoUniv = ?";

    // prepare sql query
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../create.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["useruniv"]);

    // execute and store query results
    mysqli_stmt_execute($stmt);
    $rsoResultData = mysqli_stmt_get_result($stmt);

    // echo query results to page
    while ($rso = mysqli_fetch_array($rsoResultData,MYSQLI_ASSOC)) {
        // for every rso at the university
        $userEnrolledRso = userEnrolledRso($conn, $_SESSION["userid"], $rso["rsoName"]);

        // if user is enrolled
        if ($userEnrolledRso !== false) {
            // query events at rso
            $sql = "SELECT * FROM events WHERE eventHost = ? & eventIsPublic = 0";

            // prepare sql query
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../create.php?error=stmtfail");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "s", $rso["rsoName"]);

            // execute and store query results
            mysqli_stmt_execute($stmt);
            $eventResultData = mysqli_stmt_get_result($stmt);

            while ($event = mysqli_fetch_array($eventResultData,MYSQLI_ASSOC)) {
                echo "<div class='event'><h3><a href='event.php?id=" . $event["eventId"] . "'>" . $event["eventName"] . "</a></h3>";
                echo "<p>" . $event["eventDate"] . " " . $event["eventStart"] . "-" . $event["eventEnd"] . "</p></div>";
            }
        }
        else {
            echo "user not member of " . $rso["rsoName"];
        }
    }
?>
<?php include_once 'footer.php'; ?> 