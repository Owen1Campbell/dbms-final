<?php 
    include_once 'header.php'; 
    include_once 'includes/dbh.inc.php';
?>
<h2>RSOs at 
    <?php 
        $sql = "SELECT * FROM university WHERE universityId = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../rsolist.php?error=stmtfail");
          exit();
        }
    
        mysqli_stmt_bind_param($stmt, "i", $_SESSION["useruniv"]);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
    
        $uuRow = mysqli_fetch_assoc($resultData);
        mysqli_stmt_close($stmt);
        echo $uuRow["universityName"];
    ?>
</h2>
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
<div class='rsoentry'>
        <h3>RSO Name</h3>
        <p>RSO Description. This is a short description of the event</p>
</div>
<?php include_once 'footer.php'; ?> 