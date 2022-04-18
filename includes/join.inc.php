<?php 
    session_start();
    include_once 'dbh.inc.php';
    include_once 'functions.inc.php';
    
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

        addToRso($conn, $row["rsoName"], $_SESSION["userid"], $_GET["id"]);
        header("location: ../create.php?error=stmtfail");
    }
?>