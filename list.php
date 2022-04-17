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
            }
        }
    ?>
</div>
<div class='event'>
        <h3>Event Name</h3>
        <p>2022-4-22 8:00pm-9:00pm</p>
        <p>Event Description. This is a short description of the event</p>
</div>
<?php include_once 'footer.php'; ?> 