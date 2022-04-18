<?php 
    include_once 'header.php'; 
    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';
?>
<?php 
    if (isset($_GET["id"])) {
        $eventid = $_GET["id"];

        $sql = "SELECT * FROM rso WHERE rsoId = ?";

        // prepare sql query
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../create.php?error=stmtfail");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $eventid);

        // execute and store query results
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($resultData);

        echo "<h2>" . $row["rsoName"] . "</h2>";
        echo "<p>" . $row["rsoDesc"] . "</p>";

        if (isset($_GET["join"])) {
            echo "<p><div class='createdmsg'>Success! You have joined this RSO</p></div>";
        }
        else if (isset($_GET["leave"])) {
            echo "<p><div class='createdmsg'>Success! You have left this RSO</p></div>";
        }

        $userEnrolledRso = userEnrolledRso($conn, $_SESSION["userid"], $row["rsoName"]);

        if ($userEnrolledRso === false) {
            echo "<div class='create'><a href='includes/join.inc.php?id=" . $_GET["id"] . "'>Join!</a></div><br />";
        }
        else {
            echo "<p><i>You are a member of this RSO!</i></p>";
            echo "<div class='create'><a href='includes/leave.inc.php?id=" . $_GET["id"] . "'>Leave RSO</a></div><br />";
        }
    }
    else {
        echo "<h2>RSO not found!</h2>";
    }
?>
<?php include_once 'header.php'; ?>