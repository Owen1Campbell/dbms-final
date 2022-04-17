<?php include_once 'header.php'; ?>
<?php include_once 'includes/dbh.inc.php'; ?>
<h2>Create RSO</h2>
<form action="includes/createrso.inc.php" method="post">
    <input type="text" name="name" placeholder="RSO Name"><br />
    <?php 
        if (isset($_SESSION["userid"])) {
            echo "<p>RSO Admin: <b>" . $_SESSION["userfullname"] . "</b></p>";
            echo "<input type='hidden' id='adminid' name='adminid' value='" . $_SESSION["userid"] . "'>";

            // get admin's university from their id
            $sql = "SELECT universityName FROM university WHERE universityId = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: createrso.php?error=stmtfail");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "i", $_SESSION["useruniv"]);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $result = mysqli_fetch_assoc($result);
            $univName = $result["universityName"];

            echo "<p>RSO University: <b>" . $univName . "</b></p>";
            echo "<input type='hidden' id='univid' name='univid' value='" . $_SESSION["useruniv"] . "'>";
        }
        else {
            echo "<p class='sysmsg'>*Error: Current user data not found</p>";
        }
    ?>
    <textarea name="description" rows="5" placeholder="RSO Description"></textarea><br />
    
    <button type="submit" name="submit" class='button'>Create</button>
</form>
<div class = "sysmsg">
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>* Fill in all fields</p>";
            }
            else if ($_GET["error"] == "nametaken") {
                echo "<p>* Name taken</p>";
            }
            else if ($_GET["error"] == "stmtfail") {
                echo "<p>* Error, please try again</p>";
            }
        } 
    ?>
</div>
<?php include_once 'footer.php'; ?> 