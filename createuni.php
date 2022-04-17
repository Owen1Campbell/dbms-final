<?php include_once 'header.php'; ?>
<h2>Create University</h2>
<form action="includes/createuni.inc.php" method="post">
    <input type="text" name="name" placeholder="University Name"><br />
    <input type="text" name="location" placeholder="Address"><br />
    <input type="number" name="numstudents" placeholder="Number of Students" min="0"><br />
    
    <button type="submit" name="submit" class='button'>Create</button>
</form>
<div class = "sysmsg">
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>* Fill in all fields</p>";
            }
            else if ($_GET["error"] == "invalidnumberstudents") {
                echo "<p>* Number of students: Please enter numbers only</p>";
            }
            else if ($_GET["error"] == "nametaken") {
                echo "<p>* Username taken</p>";
            }
            else if ($_GET["error"] == "stmtfail") {
                echo "<p>* Error, please try again</p>";
            }
            else if ($_GET["error"] == "none") {
                echo "<p>* Sign up successful!</p>";
            }
        } 
    ?>
</div>
<?php include_once 'footer.php'; ?> 