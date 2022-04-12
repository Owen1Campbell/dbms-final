<?php include_once 'header.php'; ?>

    <section class="signup">
        <h2>Log In</h2>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username or Email">
            <input type="password" name="pass" placeholder="Password">
            <button type="submit" name="submit">Log In</button>
        </form>
    </section>

<?php include_once 'footer.php'; ?>    