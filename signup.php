<?php include_once 'header.php'; ?>

    <section class="signup">
        <h2>Sign Up</h2>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="name" placeholder="Full Name">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pass" placeholder="Password">
            <input type="password" name="passrpt" placeholder="Confirm Password">
            <button type="submit" name="submit">Sign Up!</button>
        </form>
        <div class = "sysmsg">
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields</p>";
            }
            else if ($_GET["error"] == "invaliduid") {
                echo "<p>Invalid characters in username</p>";
            }
            else if ($_GET["error"] == "invalidemail") {
                echo "<p>Invalid email format</p>";
            }
            else if ($_GET["error"] == "passmismatch") {
                echo "<p>Passwords don't match</p>";
            }
            else if ($_GET["error"] == "usernametaken") {
                echo "<p>Invalid characters in username</p>";
            }
            else if ($_GET["error"] == "stmtfail") {
                echo "<p>Error, please try again</p>";
            }
            else if ($_GET["error"] == "none") {
                echo "<p>Sign up successful!</p>";
            }
        }
    ?>
    </div>
    </section>

<?php include_once 'footer.php'; ?>    