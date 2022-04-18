<?php include_once 'header.php'; ?>

    <h2>COP 4710 Final Project</h2>
    <?php 
        if (isset($_SESSION["userid"])) {
            echo "<p class='welcome'>Welcome <b>" . $_SESSION["userfullname"] . "!</b></p>";
            // get university name from user id
            
            include_once 'includes/dbh.inc.php';
            $sql = "SELECT * FROM university WHERE universityId = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: rsolist.php?error=stmtfail");
            exit();
            }
        
            mysqli_stmt_bind_param($stmt, "i", $_SESSION["useruniv"]);
            mysqli_stmt_execute($stmt);
        
            $resultData = mysqli_stmt_get_result($stmt);
        
            $uuRow = mysqli_fetch_assoc($resultData);
            mysqli_stmt_close($stmt);
            echo "<div class='rsoentry'><p>View <a href='list.php'>Events</a> and <a href='rsolist.php'>RSOs</a> at <b>" . $uuRow["universityName"] . "!</b></p></div>";
        }
        else {
            echo "<div class='rsoentry'><p><a href='signup.php'>Sign up</a> or <a href='login.php'>Log in</a> to see events at your school!</p></div>";
        }
    ?>

<?php include_once 'footer.php'; ?>    