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

        // set name to lowercase and remove whitespace (matches member db naming conventions)
        $name = str_replace(" ", "", $row["rsoName"]);
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

        echo "<h2>Members: " . mysqli_num_rows($resultData) . "</h2>";
        mysqli_stmt_close($stmt);
        while ($member = mysqli_fetch_array($resultData,MYSQLI_ASSOC)) {
            // declare query
            $sql = "SELECT * FROM users WHERE usersId = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: rsolist.php?error=stmtfail");
            exit();
            }

            mysqli_stmt_bind_param($stmt, "i", $member["memberId"]);
            mysqli_stmt_execute($stmt);

            $userResultData = mysqli_stmt_get_result($stmt);

            $user = mysqli_fetch_assoc($userResultData);
            mysqli_stmt_close($stmt);
            
            echo "<p> - " . $user["usersName"] . "</p>";
        }
    }
    else {
        echo "<h2>RSO not found!</h2>";
    }
?>
<?php include_once 'header.php'; ?>