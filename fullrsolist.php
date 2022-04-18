<?php 
    include_once 'header.php'; 
    include_once 'includes/dbh.inc.php';
?>
<h1>All RSOs</h1>
<div class='createdmsg'>
    <?php
        if (isset($_GET["create"])) {
            if ($_GET["create"] == "rso") {
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
                echo "<a href='createrso.php'>Create RSO</a><br />";
            }
            // if superadmin only
            if ($_SESSION["userlevel"] === 2) {
                echo "<a href='createuni.php'>Create University</a><br />";
            }
        }
    ?>
</div>

<?php 
    $sql = "SELECT * FROM rso";

    // prepare sql query
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../create.php?error=stmtfail");
        exit();
    }

    // execute and store query results
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    // echo query results to page
    while ($rso = mysqli_fetch_array($resultData,MYSQLI_ASSOC)) {
        echo "<div class='rsoentry'><h3><a href='rso.php?id=" . $rso["rsoId"] . "'>" . $rso["rsoName"] . "</a></h3>";
        echo "<p>" . $rso["rsoDesc"] . "</p></div>";
    }
?>
<?php include_once 'footer.php'; ?> 