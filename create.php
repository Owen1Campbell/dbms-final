<?php include_once 'header.php';
    include_once 'includes/dbh.inc.php';

    // superadmins can access all RSOs
    if ($_SESSION["userlevel"] === 2) {
        $sql = "SELECT * FROM rso";
    }
    // admins can create events for RSOs if they are the admin of that RSO
    else {
        $sql = "SELECT * FROM rso WHERE rsoAdminid = ?";
    }
    // students with no admin priviliges should be unable to access create event page

    // prepare sql query
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../create.php?error=stmtfail");
        exit();
    }

    // if admin, search criteria is users id matched with rso admin ids
    if ($_SESSION["userlevel"] === 1) {
        mysqli_stmt_bind_param($stmt, "i", $_SESSION["userid"]);
    }

    // execute and store query results
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
?>

<h2>Create Event</h2>
<form action="includes/create.inc.php" method="post">
    <input type="text" name="name" placeholder="Event Name"><br />
    <input type="date" name="date"><br />
    <label for="start">Start Time</label>
    <input type="time" name="start">
    <label for="end">End Time</label>
    <input type="time" name="end">
    <br />
    <input type="text" name="address" placeholder="Address"><br />
    <input type="text" name="email" placeholder="Contact Email"><br />
    <input type="text" name="phone" placeholder="Contact Phone #"><br />
    <textarea name="description" rows="5" placeholder="Event Description"></textarea><br />
    <label for="rso">RSO</label><br />
    <select name="rso" id="rso">
        <?php 
            // fill in RSOs that the user is allowed to access
            while ($rso = mysqli_fetch_array($resultData,MYSQLI_ASSOC)) {
                echo "<option value='" . $rso["rsoName"] . "'>" . $rso["rsoName"] . "</option>";
            }
        ?>
    </select>
    
    <br />
    <br />
    <label for="category">Category</label><br />
    <select name="category" id="category">
        <option value='academic'>Academic</option>
        <option value='arts'>Arts Exhibit</option>
        <option value='career'>Career/Jobs</option>
        <option value='concert'>Concert/Performance</option>
        <option value='ent'>Entertainment</option>
        <option value='health'>Health</option>
        <option value='holiday'>Holiday</option>
        <option value='meeting'>Meeting</option>
        <option value='openforum'>Open Forum</option>
        <option value='rec'>Recreation & Exercise</option>
        <option value='service'>Service & Volunteer</option>
        <option value='social'>Social Event</option>
        <option value='speaker'>Speaker/Lecture/Seminar</option>
        <option value='sports'>Sports</option>
        <option value='tour'>Tour/Open House/Info Session</option>
        <option value='unc' selected>Uncategorized/Other</option>
        <option value='workshop'>Workshop/Conference</option>
    </select>
    <br />
    <br />
    <input type="checkbox" id="public" name="public">
    <label for="public">Public Event?</label><br />
    <br />
    <button type="submit" name="submit" class='button'>Sign Up!</button>
</form>

<?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>* Fill in all fields</p>";
        }
        else if ($_GET["error"] == "invalidemail") {
            echo "<p>* Invalid email format</p>";
        }
        else if ($_GET["error"] == "stmtfail") {
            echo "<p>* Error, please try again</p>";
        }
        else if ($_GET["error"] == "none") {
            echo "</div><div class=createdmsg><p>Sign up successful!</p>";
        }
    }
?>

<?php include_once 'footer.php'; ?> 