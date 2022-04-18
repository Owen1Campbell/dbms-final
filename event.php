<?php 
    include_once 'header.php'; 
    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';
?>
<?php 
    if (isset($_GET["id"])) {
        $eventid = $_GET["id"];

        $sql = "SELECT * FROM events WHERE eventId = ?";

        // prepare sql query
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../event.php?error=stmtfail");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $eventid);

        // execute and store query results
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($resultData);

        echo "<h2>" . $row["eventName"] . "</h2>";
        echo "<div class='rsoentry'>";
        echo "<p><i>" . $row["eventDate"] . " " . $row["eventStart"] . "-" . $row["eventEnd"] . "</i></p>";
        echo "<p><u>Hosted by:</u> " . $row["eventHost"] . "</p>";
        echo "<p><u>Address:</u> " . $row["eventAddress"] . "</p>";
        echo "<p><u>Event Description:</u><br /><br /> " . $row["eventDesc"] . "</p>";
        echo "</div>";
        echo "<div class='event'><h3>Contact Info:</h3>";
        echo "<p>Phone: " . $row["eventPhone"] . "</p>";
        echo "<p>Email: " . $row["eventEmail"] . "</p>";
        echo "</div>";
        echo "<h2>Comments</h2>";
        echo "<form action='includes/comment.inc.php' method='post'>";
        echo "<textarea name='comment' rows=3 placeholder='Comment...'></textarea><br />";
        echo "<input type=hidden name='eventid' value='" . $eventid . "'></input>";
        echo "<input type=hidden name='userid' value='" . $_SESSION["userid"] . "'></input>";
        echo "<button type='submit' name='submit'>Post Comment</button><br /></form>";

        $sql = "SELECT * FROM comments WHERE commentEventId = ?";

        // prepare sql query
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: list.php?error=stmtfail1");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i", $eventid);
        // execute and store query results
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        // echo query results to page
        while ($comment = mysqli_fetch_array($resultData,MYSQLI_ASSOC)) {
            $sql = "SELECT * FROM users WHERE usersId = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: list.php?error=stmtfail2");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "i", $comment["commentUserId"]);
            // execute and store query results
            mysqli_stmt_execute($stmt);
            $userData = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($userData);
            echo "<div class='comment'><p><b>" . $user["usersName"] . "</b>";
            echo "<i> - @" . $user["usersUid"] . "</i></p>";
            echo "<p>" . $comment["commentContent"] . "</p></div>";
        }
    }
    else {
        echo "<h2>Event not found!</h2>";
    }
?>
<?php include_once 'header.php'; ?>