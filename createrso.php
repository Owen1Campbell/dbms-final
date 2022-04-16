<?php include_once 'header.php'; ?>
<h2>Create RSO</h2>
<form action="includes/createrso.inc.php" method="post">
    <input type="text" name="name" placeholder="RSO Name"><br />
    <textarea name="description" rows="5" placeholder="RSO Description"></textarea><br />
    
    <button type="submit" name="submit" class='button'>Create</button>
</form>
<div class = "sysmsg">
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>* Fill in all fields</p>";
            }
            else if ($_GET["error"] == "invaliduid") {
                echo "<p>* Invalid characters in username</p>";
            }
            else if ($_GET["error"] == "invalidemail") {
                echo "<p>* Invalid email format</p>";
            }
            else if ($_GET["error"] == "passmismatch") {
                echo "<p>* Passwords don't match</p>";
            }
            else if ($_GET["error"] == "usernametaken") {
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