<?php include_once 'header.php'; ?>

    <section class="signup">
        <h2>Sign Up</h2>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="name" placeholder="Full Name"><br />
            <input type="text" name="email" placeholder="Email"><br />
            <input type="text" name="uid" placeholder="Username"><br />
            <input type="password" name="pass" placeholder="Password"><br />
            <input type="password" name="passrpt" placeholder="Confirm Password"><br />
            <br />
            <input type="radio" id="student" name="level" value="3">
            <label for="student">Student</label><br />
            <input type="radio" id="admin" name="level" value="1">
            <label for="admin">Admin</label><br />
            <input type="radio" id="super" name="level" value="2">
            <label for="super">SuperAdmin</label><br />
            <br />
            <button type="submit" name="submit" class='button'>Sign Up!</button>
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
    </section>

<?php include_once 'footer.php'; ?>    