<?php include_once 'header.php'; ?>
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
                echo "<a href='createrso.php'>Create RSO</a><br />";
            }
            // if superadmin only
            if ($_SESSION["userlevel"] === 2) {
                echo "<a href='createuni.php'>Create University</a><br />";
            }
        }
    ?>
    </div>
<?php include_once 'footer.php'; ?> 