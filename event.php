<?php 
    include_once 'header.php'; 
    include_once 'includes/dbh.inc.php';
?>
<h1>Event</h1>
<?php 
    if (isset($_GET["id"])) {
        $eventid = $_GET["id"];
        echo $eventid;
    }
?>
<?php include_once 'header.php'; ?>

