<?php include_once 'header.php'; ?>

    <section class="signup">
        <h2>Log In</h2>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username or Email">
            <br />
            <input type="password" name="pass" placeholder="Password">
            <br />
            <button type="submit" name="submit" class='button'>Log In</button>
        </form>
        <div class = "sysmsg">
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields</p>";
            }
            else if ($_GET["error"] == "wronglogin") {
                echo "<p>Invalid username or email</p>";
            }
            else if ($_GET["error"] == "wrongpass") {
                echo "<p>Incorrect password</p>";
            }
        }
    ?>
    </div>
    </section>

<?php include_once 'footer.php'; ?>    